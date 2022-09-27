<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GroupDataTable;
use App\Region;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
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
        return $dataTable->render('region.index', compact('assets'));
        //return view("crgroup.group");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_id = Region::orderBy('diid', 'desc')->first();
        if($new_id) {
            $new_id = $new_id->diid;
        } else $new_id=0;
        $new_id++; 
        $new_id = str_pad($new_id,8,"0", STR_PAD_LEFT);

        return view("region.create", compact('new_id'));
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
            'country' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("region.create")
                            ->withErrors($validator)
                            ->withInput();
        } else {
            Region::create([
                'diid' => $request->id,
                'diname' => $request->name,
                'location' => $request->location,
                'distance' => $request->distance,
                'country' => $request->country,
                'city' => $request->city,
                'notes' => $request->notes,
                'upstatus' => '',
                'dnstatus' => 'NEW',
                'usrid' => auth()->user()->id,
                'bid' => 101
            ]);

            return redirect()->route("region.index");
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
        $region = Region::where('diid', $id)->first();
        return view('region.edit', compact('region'));
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
            'country' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("region.edit", ['id' => $id])
                            ->withErrors($validator)
                            ->withInput();
        } else {
            $group = Region::where('diid', $id)->first();
            $group->update([
                'diname' => $request->name,
                'location' => $request->location,
                'distance' => $request->distance,
                'country' => $request->country,
                'city' => $request->city,
                'notes' => $request->notes,
                'dnstatus' => 'CHANGED',
            ]);

            return redirect()->route("region.index");
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
