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
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($places as $place)
            <tr>
                <th scope="row">{{ $place->id }}</th>
                <td>{{ $place->address }}</td>
                <td>{{ $place->lat }}</td>
                <td>{{ $place->lng }}</td>
                <td>
                    <button type="button"
                            data-url='{{ route('places.destroy', ['place' => $place->id]) }}'
                            class="close text-danger delete-place"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $places->links() }}

    <script>
        $(document).ready(function () {
            $('button.delete-place').click(function (e) {
                let url = $(e.target).closest('.delete-place').data('url');

                $.ajax(url, {
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function (data) {
                    alert(data)
                    location.reload();
                }).fail(function () {
                    alert('Something went wrong');
                });
            })
        })
    </script>
@endsection
