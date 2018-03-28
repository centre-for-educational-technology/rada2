<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Responds with Terms and Consitions page
     * @return \Illuminate\Http\Response
     */
    public function termsAndConditions()
    {
        return view('legal.terms-and-conditions');
    }

    /**
     * Responds with Privacy Policy page
     * @return \Illuminate\Http\Response
     */
    public function privacypolicy()
    {
        return view('legal.privacy-policy');
    }
}
