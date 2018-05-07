<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class LegalController extends Controller
{
    /**
     * Detect if view exists or use the English version instead
     * @param  string $viewBase Path to base directory for the view
     * @return string           Localised path to view or English version
     */
    private static function detectViewForLocale(string $viewBase)
    {
        $locale = App::getLocale();
        $viewForLocale = "$viewBase.$locale";

        return ( View::exists($viewForLocale) ) ? $viewForLocale : "$viewBase.en";
    }

    /**
     * Responds with Terms and Consitions page
     * @return \Illuminate\Http\Response
     */
    public function termsAndConditions()
    {
        return view('legal.terms-and-conditions', [
            'view' => self::detectViewForLocale('legal.terms'),
        ]);
    }

    /**
     * Responds with Privacy Policy page
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicy()
    {
        return view('legal.privacy-policy', [
            'view' => self::detectViewForLocale('legal.policy'),
        ]);
    }
}
