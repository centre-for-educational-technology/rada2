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
    <link href="/css/app.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }
    </style>

    <!-- Scripts -->
    <script>
        window.SmartZoos = <?php echo json_encode([
            'config' => [
                'base_url' => url('/'),
                'map' => [
                    'green_dotless_icon_url' => asset('img/map/spotlight-poi-dotless-green.png'),
                    'key' => config('services.maps.google.api_key'),
                ]
            ],
            'data' => [
                'activity' => $game_data,
            ],
        ]);
        ?>
    </script>
</head>
<body>
    <div id="sz-play-app">
        <div id="loading" v-if="isLoading()">
            <span>
                {{ trans('game.loading') }}
            </span>
        </div>

        <game-map v-if="!isLoading()" v-bind:latitude="latitude" v-bind:longitude="longitude"></game-map>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/play.js') }}"></script>

</body>
</html>
