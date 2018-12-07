<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use App\Models\User;
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
     * Store an alert that is broadcasting
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

    public function showMyAlerts()
    {
        $users = User::get();
        $alerts = Message::where('receiver_id', Auth::user()->id)->get();
        return view('dashboard.myAlerts', ['alerts'=>$alerts, 'users'=>$users]);
    }

    public function sendAlert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'content' => ['required', 'string'],
            'receiver_id' => ['required', 'exists|users,id'],
        ]);

        if($validation){
            Message::create(['content'=>$request->content, 'author_id'=>Auth::user()->id, 'receiver_id'=>$request->receiver_id]);
            return redirect(route('dashboard.index'))->with('status', 'Message envoyé');
        } else {
            return redirect(route('dashboard.index'));
        }
    }



}
