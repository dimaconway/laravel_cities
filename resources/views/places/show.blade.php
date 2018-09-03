@extends('layouts.app')
@section('title', 'Show Place ' . $place->address)

@section('content')
    <div class="input-group mb-3">
        <input type="text"
               class="form-control"
               id="address"
               name="{{ \App\Models\Place::ADDRESS }}"
               readonly
               value='{{ $place->address }}'>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text bg-secondary text-white">Latitude</span>
        </div>
        <input type="text"
               class="form-control"
               id="latitude"
               name="{{ \App\Models\Place::LATITUDE }}"
               readonly
               value='{{ $place->lat }}'>
        <div class="input-group-prepend">
            <span class="input-group-text bg-secondary text-white">Longtidue</span>
        </div>
        <input type="text"
               class="form-control"
               id="longitude"
               name="{{ \App\Models\Place::LONGITUDE }}"
               readonly
               value='{{ $place->lng }}'>
    </div>

    <a class="btn btn-primary btn-block mb-3"
       href="{{ route('places.edit', ['place' => $place->id]) }}"
       role="button">Edit</a>

    <div id="map"></div>

    <script type="text/javascript" src="{{ asset('js/map.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=init">
    </script>
@endsection
