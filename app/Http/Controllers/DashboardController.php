<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Mission;
use App\Models\Registration;
use Auth;
use DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
      return view('dashboard.home');
    }

    /**
     * Display the view linked with the registerToken method
     * @return void
     */
    public function registerToken()
    {
    	return view('dashboard.registerToken');
    }

    /**
     * Stores in db token with role and email in order to make someone able to register
     * @param  Request $request Illuminate\Http\Request
     * @return redirect
     */
    public function storeToken(Request $request)
    {
    	$validation = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:registration'],
     		'token_registration' => ['required', 'string']
        ]);

        if($validation) {
            $token = $request->role.$request->token_registration;
        	Registration::create(['email'=>$request->email,  'token'=>$token]);
        	return redirect(route('dashboard.index'))->with('status', 'Envoyer à '.$request->email.' le token d inscription suivant : '.$token);
        } else {
        	return redirect(route('dashboard.registerToken'));
        }
    }

    /**
     * Change the night_mode for the current user
     * @param  Request $request Illuminate\Http\Request
     * @return   redirect
     */
    public function changeTheme(Request $request)
    {
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['night_mode'=>$request->theme]);
        return redirect(route('dashboard.index'))->with('status', 'Ok, mode nuit modifié');
    }



}
