<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerRelationGroup;
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
    public function create()
    {
        $new_id = Group::orderBy('crgid', 'desc')->first()->crgid;
        $new_id++;
        $new_id = str_pad($new_id,2,"0", STR_PAD_LEFT);

        return view("group.create", compact('new_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:2',
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("group.create")
                            ->withErrors($validator)
                            ->withInput();
        } else {
            Group::create([
                'crgid' => $request->id,
                'crgname' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'upstatus' => '',
                'dnstatus' => 'NEW',
                'usrid' => auth()->user()->id,
                'bid' => 101
            ]);

            return redirect()->route("group.all");
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

            return redirect()->route("group.all");
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
        return redirect()->route("group.all");
    }
}
