@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            {{ trans('pages.manage.users.index.heading') }}
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @if ( count($users) === 0 )
                        <div class="well">{{ trans('pages.manage.users.index.none-found') }}</div>
                    @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('auth.register.form.name') }}</th>
                                    <th>{{ trans('auth.general.email') }}</th>
                                    <th>{{ trans('general.date-time.created-at') }}</th>
                                    <th>{{ trans('general.date-time.updated-at') }}</th>
                                    <th>{{ trans('pages.manage.users.index.accounts') }}</th>
                                    <th>{{ trans('pages.manage.users.index.roles') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ date(trans('general.date-time.formats.short'), strtotime($user->created_at)) }}</td>
                                        <td>{{ date(trans('general.date-time.formats.short'), strtotime($user->updated_at)) }}</td>
                                        <td class="sz-account-types">
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
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
