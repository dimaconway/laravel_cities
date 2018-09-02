<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Address</th>
        <th scope="col">Distance, kms</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    <?php /** @var \App\Models\Place $place */?>
    @foreach ($places as $place)
        <tr>
            <th scope="row">{{ $place->id }}</th>
            <td>{{ $place->address }}</td>
            <td>{{ $place->getDistanceTo($placeFromFilter) }}</td>
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
