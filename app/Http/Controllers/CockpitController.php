<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Auth;
use DB;

class CockpitController extends Controller
{
    //
    public function index()
    {

      $alert = Message::orderBy('id', 'desc')->where('receiver_id', NULL)->first();
      return view('cockpit.home', ['alert'=>$alert]);
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

        return response()->json(['msg' => 'Ok, mode nuit modifié']);
    }
}
