<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GroupDataTable;
use App\Team;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
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
        return $dataTable->render('team.index', compact('assets'));
        //return view("crgroup.group");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_id = Team::orderBy('eid', 'desc')->first();
        if($new_id) {
            $new_id = $new_id->diid;
        } else $new_id=0;
        $new_id++; 
        $new_id = str_pad($new_id,8,"0", STR_PAD_LEFT);

        return view("team.create", compact('new_id'));
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
            'id' => 'required',
            'name' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("team.create")
                            ->withErrors($validator)
                            ->withInput();
        } else {
            Team::create([
                'eid' => $request->id,
                'uname' => $request->name,
                'department' => $request->department,
                'designation' => $request->designation,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'notes' => $request->notes,
                'status' => $request->status,
                'upstatus' => '',
                'dnstatus' => 'NEW',
                'usrid' => auth()->user()->id,
                'bid' => 101
            ]);

            return redirect()->route("team.index");
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
        $team = Team::where('eid', $id)->first();
        return view('team.edit', compact('team'));
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
            'department' => 'required',
            'designation' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("team.edit", ['id' => $id])
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $group = Team::where('eid', $id)->first();
            $group->update([
                'uname' => $request->name,
                'department' => $request->department,
                'designation' => $request->designation,
                'address' => $request->address,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'notes' => $request->notes,
                'status' => $request->status,
                'dnstatus' => 'CHANGED',
            ]);

            return redirect()->route("team.index");
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
        $group = Region::where('diid', $id)->first();
        $group->delete();
        return redirect()->route("region.index");
    }
}
