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
    public function create($id=-1)
    {
        if($id == '-1'){
            $pageTitle = 'Create Region';
            $new_id = Region::orderBy('diid', 'desc')->first();
            if($new_id) {
                $new_id = $new_id->diid;
            } else $new_id=0;
            $new_id++; 
            $new_id = str_pad($new_id,8,"0", STR_PAD_LEFT);
            $region = new Region;
            $region->diid = $new_id;
        }else{
            $pageTitle = 'Update Region';
            $region = Region::where('diid', $id)->first();
        }
        return view("region.create", compact('pageTitle' ,'region'));
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
            'diid' => 'required',
            'diname' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("region.create")
                            ->withErrors('errors', $validator->errors()->first())
                            ->withInput();
        } else {
            $data['upstatus'] = '';
            $data['dnstatus'] = 'CHANGED';
            $data['usrid'] = auth()->user()->id;
            $data['bid'] = 101;
            $result = Region::updateOrCreate(['diid' => $data['diid'] ],$data);
            $message = trans('messages.update_form',['form' => 'Region']);
            if($result->wasRecentlyCreated){
                Region::where('diid', $data['diid'])->update(['dnstatus' => 'NEW']);
                $message = trans('messages.save_form',['form' => 'Region']);
            }
            return redirect(route('region.index'))->withSuccess($message);
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
        // $region = Region::where('diid', $id)->first();
        // return view('region.edit', compact('region'));
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
        //     'country' => 'required',
        //     'city' => 'required',
        // ]);

        // if ($validator->fails()) {    
        //     return redirect()->route("region.edit", ['id' => $id])
        //                     ->withErrors($validator)
        //                     ->withInput();
        // } else {
        //     $group = Region::where('diid', $id)->first();
        //     $group->update([
        //         'diname' => $request->name,
        //         'location' => $request->location,
        //         'distance' => $request->distance,
        //         'country' => $request->country,
        //         'city' => $request->city,
        //         'notes' => $request->notes,
        //         'dnstatus' => 'CHANGED',
        //     ]);

        //     return redirect()->route("region.index");
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
        $group = Region::where('diid', $id)->first();
        $group->delete();
        return redirect()->route("region.index");
    }
}
