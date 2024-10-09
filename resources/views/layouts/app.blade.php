<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>COVID Vaccine Registration {{ isset($pageTitle) ? '| '. $pageTitle : '' }}</title>

    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('layouts.css')

    {{--    custome Css--}}
    @yield('css')
</head>
<body>
@include('layouts.navbar')

@yield('content')

@include('layouts.footer')

@include('layouts.js')
</body>
</html>
