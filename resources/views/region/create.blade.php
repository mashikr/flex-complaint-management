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
                        {{ Form::model($region,['method' => 'POST','route'=>'region.store', 'data-toggle'=>"validator" ,'id'=>'region'] ) }}
                            {{ Form::hidden('diid') }}
                            <div class="form-group">
                                {{ Form::label('diname','Name'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('diname',old('diname'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('location','Location'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('location',old('location'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('distance','Distance'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('distance',old('distance'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('country','Country'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('country',old('country'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('city','City'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('city',old('city'),['class' =>'form-control','required']) }}
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
                            <a href="{{ route('region.index') }}" class="btn iq-bg-danger">cancle</a>
                        {{ Form::close() }}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
