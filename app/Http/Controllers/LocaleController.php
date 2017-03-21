<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Log;

class LocaleController extends Controller
{
    /**
     * [set description]
     * @param string $locale [description]
     */
    public function set(string $locale)
    {
        App::setLocale($locale);
        session(['locale' => App::getLocale()]);

        return back();
    }
}
