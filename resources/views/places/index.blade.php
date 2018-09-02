@extends('layouts.app')
@section('title', 'List')

@section('content')
    <?php $requestKey = \App\Models\Place::ADDRESS ?>
    @foreach ($errors->all() as $error)
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endforeach

    <div class='filter'>
        <form method='GET'>
            <div class="input-group mb-3">
                <input type="text"
                       class="form-control"
                       id="address"
                       name="{{ $requestKey }}"
                       placeholder="Enter address"
                       value='{{ Request::get($requestKey) }}'>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    @if(Request::has($requestKey))
        @include('places.include.list_distance', compact(['placeFromFilter', 'places']))
    @else
        @include('places.include.list_simple', compact(['places']))
    @endif

    {{ $places->links() }}

    <script>
        $(document).ready(function () {
            $('button.delete-place').click(function (e) {
                let url = $(e.target).closest('.delete-place').data('url');

                $.ajax(url, {
                    type   : 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function (result) {
                    alert(result);
                    location.reload();
                }).fail(function () {
                    alert('Something went wrong');
                });
            })
        })
    </script>
@endsection
