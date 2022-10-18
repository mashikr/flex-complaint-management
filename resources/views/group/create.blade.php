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
                        {{ Form::model($group,['method' => 'POST','route'=>'group.store', 'data-toggle'=>"validator" ,'id'=>'group'] ) }}
                            {{ Form::hidden('crgid') }}
                            <div class="form-group">
                                {{ Form::label('crgname','Name'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('crgname',old('crgname'),['class' =>'form-control','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','Description'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::textarea('description', null, [
                                    'class'      => 'form-control',
                                    'rows'       => 1, 
                                    'name'       => 'description',
                                    'id'         => 'description',
                                    'required'   => 'required',
                                ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group">
                                {{ Form::label('status','Status'.' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], old('status'), [ 'id' => 'status' ,'class' =>'form-control select2js','required']) }}
                            </div>
                            {{ Form::submit('Submit', ['class'=>'btn btn-md btn-primary']) }}

                            <a href="{{ route('group.index') }}" class="btn iq-bg-danger">cancle</a>
                        {{ Form::close() }}
                    </div>
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
