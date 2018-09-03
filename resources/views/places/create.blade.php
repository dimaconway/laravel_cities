@extends('layouts.app')
@section('title', 'Create new Place')

@section('content')
    <form method='POST' action='{{ route('places.store') }}'>
        @csrf

        <div class="input-group mb-3">
            <input type="text"
                   class="form-control"
                   id="address"
                   name="{{ \App\Models\Place::ADDRESS }}"
                   placeholder="Enter address">
            <div class="input-group-append">
                <button id='search-for-address' class="btn btn-primary">Search</button>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-secondary text-white">Latitude</span>
            </div>
            <input type="text"
                   class="form-control"
                   id="latitude"
                   name="{{ \App\Models\Place::LATITUDE }}"
                   readonly>
            <div class="input-group-prepend">
                <span class="input-group-text bg-secondary text-white">Longtidue</span>
            </div>
            <input type="text"
                   class="form-control"
                   id="longitude"
                   name="{{ \App\Models\Place::LONGITUDE }}"
                   readonly>
        </div>

        <button id='submit-button' type="submit" class="btn btn-primary btn-block mb-3" disabled>Create</button>

        <div id="map"></div>
    </form>

    <script type="text/javascript" src="{{ asset('js/map.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=init">
    </script>
@endsection
