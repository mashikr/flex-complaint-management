<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GroupDataTable;
use App\Group;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
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
        return $dataTable->render('group.index', compact('assets'));
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
            $pageTitle = 'Create Group';
            $new_id = Group::orderBy('crgid', 'desc')->first();
            if($new_id) {
                $new_id = $new_id->crgid;
            } else $new_id=0;
            $new_id++;
            $new_id = str_pad($new_id,2,"0", STR_PAD_LEFT);
            $group = new Group;
            $group->crgid = $new_id;
        }else{
            $pageTitle = 'Update Group';
            $group = Group::where('crgid', $id)->first();
        }
        return view('group.create', compact('pageTitle' ,'group'));
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
            'crgid' => 'required|max:2',
            'crgname' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("group.create")
                            ->with('errors', $validator->errors()->first())
                            ->withInput();
        } else {        
            $data['upstatus'] = '';
            $data['dnstatus'] = 'CHANGED';
            $data['usrid'] = auth()->user()->id;
            $data['bid'] = 101;
            $result = Group::updateOrCreate(['crgid' => $data['crgid'] ],$data);
    
            $message = trans('messages.update_form',['form' => 'Group']);
            if($result->wasRecentlyCreated){
                Group::where('crgid', $data['crgid'])->update(['dnstatus' => 'NEW']);
                $message = trans('messages.save_form',['form' => 'Group']);
            }
            return redirect(route('group.index'))->withSuccess($message);
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
        $group = Group::where('crgid', $id)->first();
        return view('group.edit', compact('group'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("group.edit", ['id' => $id])
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $group = Group::where('crgid', $id)->first();
            $group->update([
                'crgname' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'dnstatus' => 'CHANGED',
            ]);

            return redirect()->route("group.index");
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::where('crgid', $id)->first();
        $group->delete();
        return redirect()->route("group.index");
    }
}
