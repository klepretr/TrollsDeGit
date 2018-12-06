<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CockpitController extends Controller
{
    //
    public function index()
    {
      return view('cockpit.home');
    }
}
