<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Display welcome page
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome')->with([]);
    }
}
