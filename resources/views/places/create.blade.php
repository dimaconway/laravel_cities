@extends('layouts.app')
@section('title', 'Create new Place')

@section('content')
    <form method='POST' action='{{ route('places.store') }}'>
        @csrf

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text"
                   class="form-control"
                   id="address"
                   name="{{ \App\Models\Place::ADDRESS }}"
                   placeholder="Enter address">
        </div>

        <input type="hidden" id="latitude" name="{{ \App\Models\Place::LATITUDE }}">
        <input type="hidden" id="longitude" name="{{ \App\Models\Place::LONGITUDE }}">

        <div id="map"></div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            let uluru = {lat: -25.344, lng: 131.036};
            // The map, centered at Uluru
            let map = new google.maps.Map(
                document.getElementById('map'),
                {
                    zoom: 4,
                    center: uluru
                }
            );
            // The marker, positioned at Uluru
            let marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=initMap">
    </script>
@endsection
