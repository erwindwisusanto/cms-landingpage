<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>CMS Landingpage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset("assets/assetsv2/images/favicon.ico") }}">

    <link href="{{ asset("assets/assetsv2/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/assetsv2/css/icons.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/assetsv2/css/app.min.css") }}" rel="stylesheet" type="text/css" />
</head>

<body id="body">
    <x-left-sidebar-tab />
    <x-top-bar />

    {{ $slot }}

    <script src="{{ asset("assets/assetsv2/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/assetsv2/libs/simplebar/simplebar.min.js") }}"></script>
    <script src="{{ asset("assets/assetsv2/libs/feather-icons/feather.min.js") }}"></script>

    <script src="{{ asset("assets/assetsv2/libs/apexcharts/apexcharts.min.js") }}"></script>
    <script src="{{ asset("assets/assetsv2/js/pages/analytics-index.init.js") }}"></script>

    <script src="{{ asset("assets/assetsv2/js/app.js") }}"></script>
</body>

</html>
