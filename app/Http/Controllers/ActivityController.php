<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ActivityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the activity page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activity');
    }
}
