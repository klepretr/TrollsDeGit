<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class CockpitController extends Controller
{
    //
    public function index()
    {

      $alert = Message::orderBy('id', 'desc')->where('receiver_id', NULL)->first();
      return view('cockpit.home', ['alert'=>$alert]);
    }
}
