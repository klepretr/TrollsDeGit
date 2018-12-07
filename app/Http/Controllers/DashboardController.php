<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Mission;
use App\Models\Registration;

class DashboardController extends Controller
{
    //
    public function index()
    {
      return view('dashboard.home');
    }

    public function registerToken()
    {
    	return view('dashboard.registerToken');
    }

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

}
