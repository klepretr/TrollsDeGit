<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Missions;


class DashboardController extends Controller
{
    //
    public function index()
    {
      return view('dashboard.home');
    }

}
