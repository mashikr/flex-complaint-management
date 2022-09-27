@extends('layouts.master')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Update Group</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                       <form action="{{ route("region.update", ['id' => $region->diid ])}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" value="{{ $region->diname }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control  @error('location') is-invalid @enderror" name="location" id="location" value="{{ $region->location }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="distance">Distance</label>
                                <input type="text" class="form-control  @error('distance') is-invalid @enderror" name="distance" id="distance" value="{{ $region->distance }}">
                                @error('distance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control  @error('country') is-invalid @enderror" name="country" id="country" value="{{ $region->country }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control  @error('city') is-invalid @enderror" name="city" id="city" value="{{ $region->city }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" cols="" rows="">{{ $region->notes }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option @if($region->status =='active') selected @endif value="active">Active</option>
                                    <option @if($region->status =='inactive') selected @endif value="inactive">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('region.index') }}" class="btn iq-bg-danger">cancle</a>
                       </form>
                    </div>
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
