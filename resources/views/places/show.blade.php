@extends('layouts.app')
@section('title', 'Show Place ' . $place->address)

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role='alert'>
            {{ session()->get('success') }}
        </div>
    @endif

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

    <div class="row mb-3">
        <div class="col">
            <a class="btn btn-primary btn-block btn-lg"
               href="{{ route('places.edit', ['place' => $place->id]) }}"
               role="button">Edit</a>
        </div>
        <div class="col">
            <a class="btn btn-danger text-white btn-block btn-lg delete-place"
               data-url='{{ route('places.destroy', ['place' => $place->id]) }}'
               data-place-address='{{ $place->address }}'
               role="button">Delete</a>
        </div>
    </div>



    <div id="map"></div>


    <script>
        $(document).ready(function () {
            $('.delete-place').click(function (e) {
                let placeAddress = $(e.target).closest('.delete-place').data('place-address');
                if (confirm('Delete Place ' + placeAddress + '?')) {
                    let url = $(e.target).closest('.delete-place').data('url');

                    $.ajax(url, {
                        type   : 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }).done(function (data) {
                        let result = $.parseJSON(data);
                        alert(result['message']);
                        location.replace(result.url);
                    }).fail(function () {
                        alert('Something went wrong');
                    });
                }
            });
        })
    </script>

    <script type="text/javascript" src="{{ asset('js/map.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&callback=init">
    </script>
@endsection
