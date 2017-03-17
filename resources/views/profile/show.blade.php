@extends('layouts.app')

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
                                    <i class="mdi mdi-pencil" aria-hidden="true"></i>
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
                                    @if ( $role->pivot->zoo )
                                        ({{ $role->pivot->zoo ? App\Activity::getZoo($role->pivot->zoo) : '' }})
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    </p>
                    <h3>{{ trans('general.date-time.created-at') }}</h3>
                    <p>{{ date(trans('general.date-time.formats.long'), strtotime($user->created_at)) }}</p>
                    <h3>{{ trans('general.date-time.updated-at') }}</h3>
                    <p>{{ date(trans('general.date-time.formats.long'), strtotime($user->updated_at)) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
