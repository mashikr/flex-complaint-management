@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Update Team</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                       <form action="{{ route("team.update", ['id' => $team->eid ])}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" value="{{ $team->uname }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control  @error('department') is-invalid @enderror" name="department" id="department" value="{{ $team->department }}">
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control  @error('designation') is-invalid @enderror" name="designation" id="designation" value="{{ $team->designation }}">
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" id="address" value="{{ $team->address }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control  @error('mobile') is-invalid @enderror" name="mobile" id="mobile" value="{{ $team->mobile }}">
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" value="{{ $team->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="" rows="">{{ $team->notes }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option @if($team->status =='active') selected @endif value="active">Active</option>
                                    <option @if($team->status =='inactive') selected @endif value="inactive">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('team.index') }}" class="btn iq-bg-danger">cancle</a>
                       </form>
                    </div>
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
