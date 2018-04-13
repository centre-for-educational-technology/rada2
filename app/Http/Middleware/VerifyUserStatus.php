<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class VerifyUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::check() && !Auth::user()->isVerified() )
        {
            Auth::logout();
            return redirect('/login')->with('warning', trans('general.messages.warnings.account-email-not-verified'));
        }
        else if ( Auth::check() && Auth::user()->blocked() )
        {
            Auth::logout();
            return redirect('/login')->with('warning', trans('general.messages.warnings.account-blocked'));
        }

        return $next($request);
    }
}
