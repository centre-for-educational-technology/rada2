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
                <li class="{{ Request::is('activities', 'activities/*') ? 'active': '' }}">
                    <a href="{{ url('/activities') }}">{{ trans('navbar.activities') }}</a>
                </li>
                @if ( Auth::check() )
                    <li class="{{ Request::is('activity_items', 'activity_items/*') ? 'active': '' }}">
                        <a href="{{ url('/activity_items') }}">{{ trans('navbar.activity-items') }}</a>
                    </li>
                @endif
                <li class="{{ Request::is('badges')? 'active': '' }}">
                    <a href="{{ route('badge.index') }}">{{ trans('navbar.badges') }}</a>
                </li>
                <li class="{{ Request::is('discount_vouchers', 'discount_vouchers/*')? 'active': '' }}">
                    <a href="{{ route('discount_voucher.index') }}">{{ trans('navbar.discount_vouchers') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="mdi mdi-translate" aria-hidden="true"></i>
                        {{ trans('general.language') }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @php( $currentLocale = App::getLocale() )
                        @foreach( resolve('App\Options\LanguageOptions')->options() as $key => $option)
                        <li class="{{ ( $key === $currentLocale ) ? 'active' : '' }}">
                            <a href="{{ url('locale/' . $key) }}" class="sz-set-locale">{{ $option }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <form id="locale-form" action="" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">{{ trans('general.forms.buttons.login-or-register') }}</a></li>
                @else
                    @php( $discountVouchersCount = Auth::user()->getDiscountVouchersCount() )
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
                                    @if ( $discountVouchersCount > 0 )
                                        <span class="badge pull-right">{{ $discountVouchersCount }}</span>
                                    @endif
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
                                <li>
                                    <a href="{!! route('manage.statistics') !!}">
                                        <i class="mdi mdi-chart-pie" aria-hidden="true"></i>
                                        {{ trans('pages.manage.statistics.heading') }}
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
    </div>
</nav>
