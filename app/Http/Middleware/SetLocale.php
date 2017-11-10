<?php

namespace App\Http\Middleware;

use Closure;

use App\Options\LanguageOptions;

class SetLocale
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
        if ( $request->session()->has('locale') )
        {
            \App::setLocale($request->session()->get('locale'));
        }
        else
        {
            $preferredLanguage = $request->getPreferredLanguage(resolve(LanguageOptions::class)->keys());

            if ( $preferredLanguage )
            {
                \App::setLocale($preferredLanguage);
            }
        }

        return $next($request);
    }
}
