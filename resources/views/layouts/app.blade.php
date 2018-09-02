<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <title>Cities - @yield('title')</title>
</head>
<body>

<div class="container">
    <ul class="nav justify-content-center">
        <?php
        $routes = [
            'places.index'  => 'List of Places',
            'places.create' => 'Create new Place',
        ];
        ?>

        <?php foreach ($routes as $route => $text): ?>

        <?php
        $url = route($route, [], false);
        ?>

        <li class="nav-item">
            <a class="nav-link {{ Request::is(substr($url, 1)) ? 'active' : '' }}"
               href="{{ $url }}">
                {{ $text }}
            </a>
        </li>

        <?php endforeach; ?>
    </ul>

    @yield('content')
</div>
</body>
</html>
