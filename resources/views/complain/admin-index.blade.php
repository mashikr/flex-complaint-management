@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Complains</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <table  class="table text-center w-100" id="userListTable">
                            <thead>
                                <tr>
                                    {{-- <th  title="Sr No.">Sr No.</th> --}}
                                    <th  title="Name">Name</th>
                                    <th  title="Company name">Company name</th>
                                    <th  title="Deparment">Deparment</th>
                                    <th  title="Designation">Designation</th>
                                    <th  title="Action">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($users as $key => $user)
                                    <tr id="user_id_{{$user->id}}">
                                        {{-- <td>{{ ++$key }}</td> --}}
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->company_id }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>{{ $user->designation }}</td>
                                        <td><a href="{{ route("admin.individual.msg", $user->id) }}" class="bg-light p-2 rounded" style="padding-top: 0.8rem !important;" title="View User" ><i class="far fa-comment-dots" style="font-size: 16px;"></i><sup class="badge badge-pill badge-danger">{{ $user->unseen_msg?  $user->unseen_msg: "" }}</span></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push("message-scripts")
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    $(document).ready(function() {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher('c73cd1b9dfff3358f39d', {
        cluster: 'ap2'
        });

        var channel = pusher.subscribe('message-channel');
        channel.bind('message', function(data) {
            if(data.message.to == "admin") {
                var user_row = $("#user_id_"+data.message.user_id);
                if(user_row) {
                    var count = user_row.find(".badge").text();
                    if(count) count = parseInt(user_row.find(".badge").text())+1;
                    else count = 1;
                    user_row.find(".badge").text(count);
                    $("#userListTable").prepend(user_row);
                }
               
            }
        });
    });
</script>
@endpush