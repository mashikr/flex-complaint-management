@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Create Client</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        {{ Form::model($client,['method' => 'POST','route'=>'client.store', 'data-toggle'=>"validator" ,'id'=>'client'] ) }}
                            {{ Form::hidden('crcid') }}
                            <div class="form-group">
                                {{ Form::label('crcname','Name'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('crcname',old('crcname'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('designation','Designation'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('designation',old('designation'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('city','City'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('city',old('city'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('country','Country'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('country',old('country'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('mobile','Mobile'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('mobile',old('mobile'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('email','Email'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::email('email',old('email'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('notes','Notes',['class'=>'form-control-label'], false ) }}
                                {{ Form::textarea('notes', null, [
                                    'class'      => 'form-control',
                                    'rows'       => 1, 
                                    'name'       => 'notes',
                                    'id'         => 'notes',
                                ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('status','Status'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], old('status'), [ 'id' => 'status' ,'class' =>'form-control select2js','required']) }}
                            </div>
                            {{ Form::submit('Submit', ['class'=>'btn btn-md btn-primary']) }}
                            <a href="{{ route('client.index') }}" class="btn iq-bg-danger">cancle</a>
                        {{ Form::close() }}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
