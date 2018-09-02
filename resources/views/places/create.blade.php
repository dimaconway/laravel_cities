@extends('layouts.app')
@section('title', 'Create new Place')

@section('content')
    <form method='POST' action='{{ route('places.store') }}'>
        @csrf
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="{{ \App\Models\Place::ADDRESS }}" placeholder="Enter address">
        </div>
        <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="{{ \App\Models\Place::LATITUDE }}" placeholder="Enter latitude">
        </div>
        <div class="form-group">
            <label for="longitude">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="{{ \App\Models\Place::LONGITUDE }}" placeholder="Enter longitude">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
