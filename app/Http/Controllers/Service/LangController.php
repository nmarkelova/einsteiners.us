<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lang($locale)
    {
        App::setLocale($locale);
        return redirect()->back()->withCookie(Cookie::make('lang', $locale, 100));
    }

}
