<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LocaleDetect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(Cookie::get('lang'))) {
            App::setLocale('en');
        } elseif (Cookie::get('lang') == 'ru') {
            App::setLocale('ru');
        } elseif (Cookie::get('lang') == 'en') {
            App::setLocale('en');
        }
        return $next($request);
        /*
        $user_locale = Session::get('locale');
        if ($user_locale) {
            $locale = $user_locale;
        } else { 
            $locale = Config::get('app.locale');
        }
        App::setLocale($locale);
        return $next($request);
        */
    }
}