@extends('layouts.app')
@section('title', 'List')

@section('content')
    <?php $requestKey = \App\Models\Place::ADDRESS ?>

    @if (session()->has('success'))
        <div class="alert alert-success" role='alert'>
            {{ session()->get('success') }}
        </div>
    @endif

    @foreach ($errors->all() as $error)
        <div class='alert alert-danger' role='alert'>
            {{ $error }}
        </div>
    @endforeach

    <div class='filter'>
        <form method='GET'>
            <div class="input-group mb-3">
                <select name='{{ $requestKey }}' id='addresses' class="custom-select">
                    <option value="" selected disabled hidden>Choose address</option>
                    @foreach($addressessForFilter as $item)
                        <option value='{{ $item->address }}'
                                {{ Request::get($requestKey) === $item->address ? 'selected' : '' }}>
                            {{ $item->address }}
                        </option>
                    @endforeach;
                </select>
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
            $('#addresses').on('change', function () {
                let $form = $(this).closest('form');
                $form.submit();
            });

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
            });
        })
    </script>
@endsection
