
@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{ isset($pageTitle) ? ucwords($pageTitle) : trans('messages.list') }}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul class="nav flex-column nav-pills mb-3 nav-fill" id="tabs-text" role="tablist">

                                @if(in_array( $page,['profile_form','password_form']))
                                   
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('layout_page') }}?page=profile_form" data-target=".paste_here" class="nav-link {{$page=='profile_form'?'active':''}}"  data-toggle="tabajax" rel="tooltip"> Profile </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" data-href="{{ route('layout_page') }}?page=password_form" data-target=".paste_here" class="nav-link {{$page=='password_form'?'active':''}}"  data-toggle="tabajax" rel="tooltip"> Change Password </a>
                                    </li>
                                @endif
                                </ul>
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content" id="pills-tabContent-1">
                                    <div class="tab-pane active p-1" >
                                        <div class="paste_here"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
<script type="text/javascript">
$(document).ready(function(event)
{
    var $this = $('.nav-item').find('a.active');
    loadurl = '{{route('layout_page')}}?page={{ $page}}';
    targ = $this.attr('data-target');
    id = this.id || '';
    token="{{csrf_token()}}";
    
    $.post(loadurl,function(data) {
        $(targ).html(data);
        token="{{csrf_token()}}";
    });

    $this.tab('show');
    return false;
   
});



</script>

@endsection
