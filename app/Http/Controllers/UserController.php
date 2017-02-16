<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class UserController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'auth.admin']);
    }

    /**
     * Display a listing of Users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage/users/index')->with('users', User::with(['social_accounts', 'roles'])->paginate( config('paginate.limit') ));
    }
}
