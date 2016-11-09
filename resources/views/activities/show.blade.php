<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="200x200" href="{{ asset('img/logos/logo-square.png') }}">

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
    <script>
        window.SmartZoos = <?php echo json_encode([
            'config' => [
                'base_url' => url('/'),
                'map' => [
                    'green_dotless_icon_url' => asset('img/map/spotlight-poi-dotless-green.png'),
                ]
            ]
        ]);
        ?>
    </script>
</head>
<body>
    <div id="overlay" style="position:fixed;top:0;left:0;z-index:9999;height:100%;width:100%;background-color:grey;text-align:center;">
        <span style="display:inline-block;margin-top:150px;font-size:150%;">
            Loading, please wait ...
        </span>
    </div>
    <div id="map">
    </div>

    <!-- Scripts -->
    <script
    src="//code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/activity.js') }}"></script>
    <script src="//maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key') }}&amp;callback=initMap&amp;libraries=geometry" async defer></script>

</body>
</html>
