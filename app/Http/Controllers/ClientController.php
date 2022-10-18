<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\GroupDataTable;
use App\Client;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
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
        return $dataTable->render('client.index', compact('assets'));
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
            $pageTitle = 'Create Client';
                $new_id = Client::orderBy('crcid', 'desc')->first();
            if($new_id) {
                $new_id = $new_id->crcid;
            } else $new_id=0;
            $new_id++; 
            $new_id = str_pad($new_id,6,"0", STR_PAD_LEFT);
            $client = new Client;
            $client->crcid = $new_id;
        }else{
            $pageTitle = 'Update Client';
            $client = Client::where('crcid', $id)->first();
        }
        return view('client.create', compact('pageTitle' ,'client'));
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
            'crcid' => 'required',
            'crcname' => 'required',
            'designation' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {    
            return redirect()->route("client.create")
                            ->withErrors('errors', $validator->errors()->first())
                            ->withInput();
        } else {
            $data['upstatus'] = '';
            $data['dnstatus'] = 'CHANGED';
            $data['usrid'] = auth()->user()->id;
            $data['bid'] = 101;
            $result = Client::updateOrCreate(['crcid' => $data['crcid'] ],$data);
    
            $message = trans('messages.update_form',['form' => 'Client']);
            if($result->wasRecentlyCreated){
                Client::where('crcid', $data['crcid'])->update(['dnstatus' => 'NEW']);
                $message = trans('messages.save_form',['form' => 'Client']);
            }
            return redirect(route('client.index'))->withSuccess($message);
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
        // $client = Client::where('crcid', $id)->first();
        // return view('client.edit', compact('client'));
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
        //     'designation' => 'required',
        //     'mobile' => 'required',
        //     'email' => 'required',
        // ]);

        // if ($validator->fails()) {    
        //     return redirect()->route("client.edit", ['id' => $id])
        //                     ->withErrors($validator)
        //                     ->withInput();
        // } else {
        //     $client = Client::where('crcid', $id)->first();
        //     $client->update([
        //         'crcname' => $request->name,
        //         'designation' => $request->designation,
        //         'city' => $request->city,
        //         'country' => $request->country,
        //         'mobile' => $request->mobile,
        //         'email' => $request->email,
        //         'notes' => $request->notes,
        //         'status' => $request->status,
        //         'upstatus' => '',
        //         'udate' => now(),
        //         'dnstatus' => 'CHANGED',
        //     ]);

        //     return redirect()->route("client.index");
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
        $client = Client::where('crcid', $id)->first();
        $client->delete();
        return redirect()->route("client.index");
    }
}
