@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{ $pageTitle }}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                    {{ Form::model($team,['method' => 'POST','route'=>'team.store', 'data-toggle'=>"validator" ,'id'=>'team'] ) }}
                        {{ Form::hidden('eid') }}
                            <div class="form-group">
                                {{ Form::label('uname','Name'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('uname',old('uname'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('department','Department'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('department',old('department'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('designation','Designation'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('designation',old('designation'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('address','Address'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('address',old('address'),['class' =>'form-control','required']) }}
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
                            <a href="{{ route('team.index') }}" class="btn iq-bg-danger">cancle</a>
                        {{ Form::close() }}
                    </div>         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
