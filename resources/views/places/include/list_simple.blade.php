<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Address</th>
        <th scope="col">Latitude</th>
        <th scope="col">Longitude</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($places as $place)
        <tr>
            <th>{{ $place->id }}</th>
            <td>
                <a href='{{ route('places.show', ['place' => $place->id]) }}'>
                    {{ $place->address }}
                </a>
            </td>
            <td>{{ $place->lat }}</td>
            <td>{{ $place->lng }}</td>
            <td>
                <button type="button"
                        data-url='{{ route('places.destroy', ['place' => $place->id]) }}'
                        data-place-address='{{ $place->address }}'
                        class="close text-danger delete-place"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
