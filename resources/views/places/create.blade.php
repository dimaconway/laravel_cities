@extends('layouts.app')
@section('title', 'Create new Place')

@section('content')
    <?php
    $addressInputName = \App\Models\Place::ADDRESS;
    $latInputName = \App\Models\Place::LATITUDE;
    $lngInputName = \App\Models\Place::LONGITUDE;
    ?>

    @if (session()->has('errors'))
        <div class='alert alert-danger' role='alert'>
            <ul class='mb-0'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method='POST' action='{{ route('places.store') }}'>
        @csrf

        <div class="input-group mb-3">
            <input type="text"
                   class="form-control"
                   id="address"
                   name="{{ $addressInputName }}"
                   placeholder="Enter address"
                   value='{{ old($addressInputName) }}'>
            <div class="input-group-append">
                <button id='search-for-address' class="btn btn-primary" tabindex="-1">Search</button>
            </div>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text bg-secondary text-white">Latitude</span>
            </div>
            <input type="text"
                   class="form-control"
                   id="latitude"
                   name="{{ $latInputName }}"
                   readonly
                   value='{{ old($latInputName) }}'>
            <div class="input-group-prepend">
                <span class="input-group-text bg-secondary text-white">Longtidue</span>
            </div>
            <input type="text"
                   class="form-control"
                   id="longitude"
                   name="{{ $lngInputName }}"
                   readonly
                   value='{{ old($lngInputName) }}'>
        </div>

        <button id='submit-button' type="submit" class="btn btn-success btn-block btn-lg mb-3">Create</button>

        <div id="map"></div>
    </form>

    <script type="text/javascript" src="{{ asset('js/map.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=init">
    </script>
@endsection
