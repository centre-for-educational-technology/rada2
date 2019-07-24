<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Options\ZooOptions;

class WelcomeController extends Controller
{
    /**
     * Display welcome page
     * @param  ZooOptions $zooOptions ZooOptions service
     * 
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome')->with([]);
    }
}
