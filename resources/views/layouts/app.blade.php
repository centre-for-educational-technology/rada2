<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SmartZoos') }}</title>

    <!-- Styles -->
    <link href="//cdn.jsdelivr.net/npm/animate.css@3.6.1/animate.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    @yield('header-styles')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/'),
            'apiUrl' => url('/api'),
            'locale' => App::getLocale(),
            'isLoggedIn' => Auth::check(),
            'unloadProtectionMessage' => trans('general.confirmations.unload-protection'),
        ]); ?>;
    </script>

    @yield('header-scripts')
</head>
<body>
    @include('includes.cookie-consent')

    <div id="app">
        @include('includes.navbar')

        @yield('content')
    </div>

    <footer>
        @include('includes.system-requirements')
        <!-- Scripts -->
        <script src="{{ elixir('js/app.js') }}"></script>

        @yield('footer-scripts')
        @include('services.analytics')
        @include('services.userreport')
    </footer>
</body>
</html>
