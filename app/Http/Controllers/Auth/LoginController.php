<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    public function username()
    {
        return 'name';
    }

   
    protected function redirectTo()
    {

        if(Auth::user()->role==Auth::user()::SUPERVISEUR or Auth::user()->role==Auth::user()::ADMIN){
            return route('dashboard.index');
        } elseif(Auth::user()->role==Auth::user()::AGENT){
            return route('cockpit.index');
        }   

    }
    

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
