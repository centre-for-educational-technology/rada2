<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SmartZoos') }}</title>

    <!-- Styles -->
    <link href="//cdn.materialdesignicons.com/1.7.22/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        #map {
            height: 100%;
            width: 100%;
        }
    </style>

    <!-- Scripts -->
</head>
<body>
    <div id="map">
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/activity.js') }}"></script>
    <script src="//maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key')}}&amp;callback=initMap" async defer></script>
</body>
</html>
