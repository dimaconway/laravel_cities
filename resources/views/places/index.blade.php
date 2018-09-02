@extends('layouts.app')
@section('title', 'List')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Address</th>
            <th scope="col">Latitude</th>
            <th scope="col">Longitude</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($places as $place)
            <tr>
                <th scope="row">{{ $place->id }}</th>
                <td>{{ $place->address }}</td>
                <td>{{ $place->lat }}</td>
                <td>{{ $place->lng }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $places->links() }}
@endsection
