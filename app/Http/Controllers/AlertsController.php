<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use Auth;

class AlertsController extends Controller
{
    //
    public function alerts()
    {
        $alerts = Message::orderBy('id', 'desc')->where('receiver_id', NULL)->take(5)->get();
        return view('dashboard.alert', ['alerts'=>$alerts]);
    }


    /**
     * Stores in db token with role and email in order to make someone able to register
     * @param  Request $request Illuminate\Http\Request
     * @return redirect
     */
    public function storeAlert(Request $request)
    {
    	$validation = Validator::make($request->all(), [
            'content' => ['required', 'string']
        ]);

        if($validation) {
        	Message::create(['content'=>$request->content, 'author_id'=>Auth::user()->id, 'receiver_id'=>NULL]);
        	return redirect(route('dashboard.index'))->with('status', 'Alerte envoyée à tout le monde');
        } else {
        	return redirect(route('dashboard.index'));
        }
    }



}
