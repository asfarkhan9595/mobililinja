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
<script src="{{ asset('_back/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('_back/bundles/vendorscripts.bundle.js') }}"></script>
<script src="{{ asset('_back/bundles/mainscripts.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
// jQuery validation
$(document).ready(function () {
    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6  // Change the minimum length as needed
            }
        },
        messages: {
            email: {
                required: 'Please enter your email',
                email: 'Please enter a valid email address'
            },
            password: {
                required: 'Please enter your password',
                minlength: 'Password must be at least 6 characters long'
            }
        }
    });
});
</script>
</body>
</html>
