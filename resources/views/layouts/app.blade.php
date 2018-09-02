<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

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
        $url = substr(route($route, [], false), 1);
        ?>

        <li class="nav-item">
            <a class="nav-link {{ Request::is($url) ? 'active' : '' }}"
               href="{{ $route }}">
                {{ $text }}
            </a>
        </li>

        <?php endforeach; ?>
    </ul>

    @yield('content')
</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
