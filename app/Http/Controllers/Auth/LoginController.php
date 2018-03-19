<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Cache;
use Redis;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{



    protected function guard()
    {
        //dd(Auth::guard('web'));
        return Auth::guard('web');
        //return Auth::guard();
    }
     



    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        
        session(['users' => $user->name ]);
        //session(['users_id' => $user->id ]);
        //Redis::set("users{$user->id}" , $user->name . ' redis ');
        //dd($user);
    }



    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    
}
