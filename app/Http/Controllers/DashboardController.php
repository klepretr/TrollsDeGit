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
        	Registration::create(['email'=>$request->email, 'token'=>$request->token_registration]);
        	return redirect(route('dashboard.index'));
        } else {
        	return redirect(route('dashboard.registerToken'));
        }
    }

}
