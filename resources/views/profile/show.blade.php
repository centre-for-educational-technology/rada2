@extends('layouts.app')

@section('footer-scripts')
<script src="https://backpack.openbadges.org/issuer.js"></script>
<script src="{{ elixir('js/profile.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-10">
                            {{ trans('pages.profile.heading', ['name' => $user->name]) }}
                        </div>

                        <div class="col-xs-2">
                            @can('update', $user)
                                <a href="{!! route('user.profile.edit', ['user' => $user->id]) !!}" class="btn btn-primary pull-right" title="{{ trans('general.actions.edit') }}">
                                    <i class="mdi mdi-account-edit" aria-hidden="true"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <h3>{{ trans('auth.register.form.name') }}</h3>
                    <p>{{ $user->name }}</p>
                    <h3>{{ trans('auth.general.email') }}</h3>
                    <p>
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                    </p>
                    <h3>{{ trans('pages.manage.users.index.accounts') }}</h3>
                    <p class="sz-account-types">
                        <i class="mdi mdi-account-key {{ $user->password ? ' active' : 'inactive' }}"></i>
                        @if( $user->social_accounts )
                            @foreach( $user->social_accounts as $social )
                                @if ( $social->isGoogle() )
                                    <i class="mdi mdi-google"></i>
                                @elseif ( $social->isFacebook() )
                                    <i class="mdi mdi-facebook-box"></i>
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <h3>{{ trans('pages.manage.users.index.roles') }}</h3>
                    <p>
                        @if ( $user->roles )
                            @foreach ( $user->roles as $role)
                                <span class="badge sz-role-badge">
                                    {{ trans('general.roles.' . $role->name) }}
                                    @if ( $role->hasZoo() )
                                        ({{ $role->pivot->zoo ? $role->getZoo() : '' }})
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    </p>
                    <h3>{{ trans('general.date-time.created-at') }}</h3>
                    <p>{{ date(trans('general.date-time.formats.long'), strtotime($user->created_at)) }}</p>
                    <h3>{{ trans('general.date-time.updated-at') }}</h3>
                    <p>{{ date(trans('general.date-time.formats.long'), strtotime($user->updated_at)) }}</p>
                    @if ( $user->badges )
                        @php ( $isCurrentUser = Auth::check() && Auth::user()->id === $user->id )
                        <div class="row">
                            <div class="col-xs-12 col-sm-8">
                                <h3>{{ trans('pages.profile.labels.badges-earned') }}</h3>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                @if ( count($user->badges) > 0 && $isCurrentUser )
                                    <!--button type="button" id="send-to-backpack" class="btn btn-primary pull-right"">
                                        <i class="mdi mdi-cube-send"></i>
                                        {{ trans('general.actions.send-to-backpack') }}
                                    </button-->
                                @endif
                            </div>
                        </div>
                        <div id="badges-earned">
                            @foreach ( $user->badges as $badge )
                                <div class="openbadge-container">
                                    <img
                                        class="media-object openbadge"
                                        src="{{ $badge->getImageUrl() }}"
                                        alt="image"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-trigger="hover"
                                        title="{{ $badge->name }}"
                                        data-content="{{ $badge->description . '<br><strong>' . date(trans('general.date-time.formats.medium'), strtotime($badge->pivot->created_at)) . '</strong>' }}"
                                        data-html="true">
                                    @if ( $isCurrentUser )
                                        @php ( $assertionUrl = route('api.badge.assertion', ['badge' => $badge->id, 'user' => $user->id]) )
                                        <div class="openbadge-actions text-center">
                                            <!--button
                                                class="btn btn-default btn-sm openbadge-download"
                                                title="{{ trans('general.actions.download-baked-badge') }}"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                data-assertion-url="{!! $assertionUrl !!}">
                                                <i class="mdi mdi-cloud-download" aria-hidden="true"></i>
                                            </button-->
                                            <a
                                                class="btn btn-default btn-sm openbadge-assertion-open"
                                                title="{{ trans('general.actions.assertion-open') }}"
                                                href="{!! $assertionUrl !!}"
                                                target="_blank"
                                                data-toggle="tooltip"
                                                data-placement="top">
                                                <i class="mdi mdi-json" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
