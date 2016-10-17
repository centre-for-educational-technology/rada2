@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.login.form.heading') }}</div>
                <div class="panel-body">
                    <div class="col-md-8 col-md-offset-4">
                        <p class="text-justify">{{ trans('auth.login.form.text') }}</p>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ trans('auth.login.form.email') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="mdi mdi-email" aria-hidden="true"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ trans('auth.login.form.password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="mdi mdi-account-key" aria-hidden="true"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('auth.login.form.remember') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('auth.login.form.btn.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    {{ trans('auth.login.form.btn.reset') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {{ trans('auth.login.form.social_networks') }}:
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <a class="btn btn-default col-xs-12" href="{{ url('/auth/google') }}">
                                    <i class="mdi mdi-google" aria-hidden="true"></i>
                                    {{ trans('auth.login.form.btn.google') }}
                                </a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <a class="btn btn-default col-xs-12" href="{{ url('/auth/facebook') }}">
                                    <i class="mdi mdi-facebook-box" aria-hidden="true"></i>
                                    {{ trans('auth.login.form.btn.facebook') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
