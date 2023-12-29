<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name', 'mobiililinja.fi') }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="{{ asset('_back/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('_back/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('_back/vendor/animate-css/vivify.min.css') }}">
<link rel="stylesheet" href="{{ asset('_back/css/site.min.css') }}">
</head>
<body class="theme-cyan font-krub light_version">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>
<div class="pattern">
    <span class="cyan"></span>
</div>

@yield('content')

@include ('_back._inc._scripts')
</body>
</html>