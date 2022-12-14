<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GroupDataTable;
use App\AdminGroup;
use Illuminate\Support\Facades\Validator;

class AdminGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GroupDataTable $dataTable)
    {
        // return Group::all();
        $assets = ['datatable'];
        return $dataTable->render('admin_group.index', compact('assets'));
        //return view("crgroup.group");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=-1)
    {
        if($id == '-1'){
            $pageTitle = 'Create Admin Group';
            $new_id = AdminGroup::orderBy('creid', 'desc')->first();
            if($new_id) {
                $new_id = $new_id->creid;
            } else $new_id=0;
            $new_id++;
            $new_id = str_pad($new_id,2,"0", STR_PAD_LEFT);
            $group = new AdminGroup;
            $group->creid = $new_id;
        }else{
            $pageTitle = 'Update Admin Group';
            $group = AdminGroup::where('creid', $id)->first();
        }
        return view('admin_group.create', compact('pageTitle' ,'group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'creid' => 'required',
            'crename' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("admin_group.create")
                            ->withErrors('errors', $validator->errors()->first())
                            ->withInput();
        } else {
            $data['upstatus'] = '';
            $data['dnstatus'] = 'CHANGED';
            $data['usrid'] = auth()->user()->id;
            $data['bid'] = 101;
            $result = AdminGroup::updateOrCreate(['creid' => $data['creid'] ], $data);
    
            $message = trans('messages.update_form',['form' => 'Admin Group']);
            if($result->wasRecentlyCreated){
                AdminGroup::where('creid', $data['creid'])->update(['dnstatus' => 'NEW']);
                $message = trans('messages.save_form',['form' => 'Admin Group']);
            }
            return redirect(route('admin.group.index'))->withSuccess($message);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $group = AdminGroup::where('creid', $id)->first();
        // return view('admin_group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'description' => 'required',
        //     'status' => 'required',
        // ]);

        // if ($validator->fails()) {    
        //     return redirect()->route("admin.group.edit", ['id' => $id])
        //                     ->withErrors($validator)
        //                     ->withInput();
        // } else {
        //     $group = AdminGroup::where('creid', $id)->first();
        //     $group->update([
        //         'crename' => $request->name,
        //         'description' => $request->description,
        //         'status' => $request->status,
        //         'dnstatus' => 'CHANGED',
        //     ]);

        //     return redirect()->route("admin.group.index");
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = AdminGroup::where('creid', $id)->first();
        $group->delete();
        return redirect()->route("admin.group.index");
    }
}
