<?php

namespace App\Http\Controllers;

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComplainController extends Controller
{
    private $msg_limit = 15;

    public function userIndex () {
        $messages = DB::table('complains')->where("user_id", auth()->user()->id)->latest()->take($this->msg_limit)->get();
        $messages = $messages->reverse()->values();
        $user_id = "admin";
        $sender = auth()->user()->id;
        return view("complain.user-index", compact("messages", "user_id", "sender"));
    }

    public function adminIndex () {
        //$users = DB::select('SELECT complains.id,users.id, users.name, users.email,users.company_id,users.department, users.designation, COUNT(CASE WHEN complains.seen=0 THEN 1 ELSE NULL END) as unseen_msg FROM complains JOIN users ON users.id=complains.user_id WHERE complains.from="user" GROUP BY complains.user_id ORDER BY complains.id DESC');

        $users = DB::table('complains')
            ->join('users', 'users.id', '=', 'complains.user_id')
            ->select('users.id', 'users.name', 'users.email','users.company_id','users.department', 'users.designation')
            ->addSelect(DB::raw('COUNT(CASE WHEN complains.seen=0 THEN 1 ELSE NULL END) as unseen_msg'))
            ->where('complains.from','user')
            ->groupBy('complains.user_id')
            ->orderByDesc("unseen_msg")
            ->paginate(3);

        return view("complain.admin-index", compact("users"));
    }

    public function individualMsg ($user_id) {
        $messages = DB::table('complains')->where("user_id", $user_id)->latest()->take($this->msg_limit)->get();
        $messages = $messages->reverse()->values();
        $sender = "admin";
        return view("complain.individual-msg", compact("messages", "user_id", "sender"));
    }

    public function textStore (Request $request) {
        if(auth()->user()->user_type == "admin") {
            $data = [
                        'from' => 'admin',
                        'to' => 'user',
                        'admin_id' => auth()->user()->id,
                        'user_id' => $request->to,
                        'message_type' => 'text',
                        'message' => $request->msg,
                        'created_at' => now(),
                    ];
            DB::table('complains')->where(['from' => 'user', 'user_id' => $request->to, 'seen' => 0])->update(['seen' => 1]);
        } else if (auth()->user()->user_type == "user") {
            $data = [
                        'from' => 'user',
                        'to' => 'admin',
                        'user_id' => auth()->user()->id,
                        'message_type' => 'text',
                        'message' => $request->msg,
                        'created_at' => now(),
                    ];
            DB::table('complains')->where(['from' => 'admin', 'user_id' => $request->to, 'seen' => 0])->update(['seen' => 1]);
        }
        $msg_id = DB::table('complains')->insertGetId($data);
        //$item = DB::table('complains')->find($id);
        $message = [
            'id' => $msg_id,
            'from' => $data["from"],
            'to' => $data["to"],
            'user_id' => $data["user_id"],
        ];

        event(new Message(json_decode(json_encode($message))));

        return message_body_template (json_decode(json_encode($data)));
        
    }

    public function fileStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'attached_file' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx,txt|max:1024',
            'receiver' => 'required',
            'sender' => 'required',
        ], [
            'attached_file.max' => 'Your File should less than 10MB',
            'attached_file.mimes' => 'Only Image, PDF, Doc or Text files allowed',
        ]);

        if ($validator->fails()) {    
            return response()->json(["status"=> "error", "errors" => $validator->messages()], 200);
        } else {
            $fileName = time().rand(1000,9999).'.'.$request->attached_file->getClientOriginalExtension();
            if($request->attached_file->move(public_path('assets/complain/files'), $fileName)) {
                
                $msg_type = 'img';
                $file_type = $request->attached_file->getClientOriginalExtension();
                if($file_type == "pdf") $msg_type = "pdf";
                else if($file_type == "doc" || $file_type == "docx") $msg_type = "doc";
                else if($file_type == "txt") $msg_type = "txt";

                if(auth()->user()->user_type == "admin") {
                    $data = [
                                'from' => 'admin',
                                'to' => 'user',
                                'admin_id' => auth()->user()->id,
                                'user_id' => $request->receiver,
                                'message_type' => $msg_type,
                                'file_name' => $fileName,
                                'created_at' => now(),
                            ];
                    DB::table('complains')->where(['from' => 'user', 'user_id' => $request->to, 'seen' => 0])->update(['seen' => 1]);
                } else if (auth()->user()->user_type == "user") {
                    $data = [
                                'from' => 'user',
                                'to' => 'admin',
                                'user_id' => auth()->user()->id,
                                'message_type' => $msg_type,
                                'file_name' => $fileName,
                                'created_at' => now(),
                            ];
                    DB::table('complains')->where(['from' => 'admin', 'user_id' => $request->to, 'seen' => 0])->update(['seen' => 1]);
                }
                $msg_id = DB::table('complains')->insertGetId($data);
                $message = [
                    'id' => $msg_id,
                    'from' => $data["from"],
                    'to' => $data["to"],
                    'user_id' => $data["user_id"],
                ];
        
                event(new Message(json_decode(json_encode($message))));
        
                return message_body_template (json_decode(json_encode($data)));
            }

        }
    }

    public function getSingleMessage(Request $request) {
        $item = DB::table('complains')->find($request->msg_id);
        return message_body_template ($item);
    }

    public function getPreviousMessage(Request $request) {
        //return $request;
        if($request->sender=="admin") {
            $messages = DB::table('complains')->where("user_id", $request->receiver)->latest()->skip($this->msg_limit * $request->offset_no)->take($this->msg_limit)->get();
            $messages = $messages->reverse()->values();
            $html_template = "";

            foreach($messages as $message) {
                $html_template .= message_body_template($message);
            }

            return $html_template;
        }
        // $item = DB::table('complains')->find($request->msg_id);
        // return message_body_template ($item);
    }
}
