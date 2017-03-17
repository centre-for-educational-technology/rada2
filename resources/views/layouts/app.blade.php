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
    <link href="//cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/1.8.36/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    @yield('header-styles')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/'),
            'apiUrl' => url('/api'),
        ]); ?>
    </script>

    @yield('header-scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img alt="{{ config('app.name', 'SmartZoos') }}" src="{{ asset('img/logos/logo.png') }}" class="sz-navbar-brand-logo">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('/')? 'active': '' }}">
                            <a href="{{ url('/') }}">{{ trans('navbar.home') }}</a>
                        </li>
                        <li class="{{ Request::is('activities')? 'active': '' }}">
                            <a href="{{ url('/activities') }}">{{ trans('navbar.activities') }}</a>
                        </li>
                        <li class="{{ Request::is('activity_items')? 'active': '' }}">
                            <a href="{{ url('/activity_items') }}">{{ trans('navbar.activity-items') }}</a>
                        </li>
                        <li class="{{ Request::is('trading-market')? 'active': '' }} disabled">
                            <a href="{{ url('/trading-market') }}">{{ trans('navbar.trading-market') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">{{ trans('auth.login.form.btn.login') }}</a></li>
                            <li><a href="{{ url('/register') }}">{{ trans('auth.register.form.btn.register') }}</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="mdi mdi-account-circle" aria-hidden="true"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{!! route('user.profile', [ 'profile' => Auth::user()->id ]) !!}">
                                            <i class="mdi mdi-face-profile" aria-hidden="true"></i>
                                            {{ trans('pages.profile.title') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{!! route('dashboard') !!}">
                                            <i class="mdi mdi-view-dashboard" aria-hidden="true"></i>
                                            {{ trans('pages.dashboard.title') }}
                                        </a>
                                    </li>
                                    @if ( Auth::user()->isAdmin() )
                                        <li>
                                            <a href="{!! route('manage.users') !!}">
                                                <i class="mdi mdi-account-multiple" aria-hidden="true"></i>
                                                {{ trans('pages.manage.users.index.heading') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-logout" aria-hidden="true"></i>

                                            {{ trans('auth.logout.form.btn.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ elixir('js/app.js') }}"></script>

    @yield('footer-scripts')
    @include('services.analytics')
    @include('services.userreport')
</body>
</html>
