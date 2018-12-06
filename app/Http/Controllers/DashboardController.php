<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mission;


class DashboardController extends Controller
{
    //
    public function index()
    {
      $missions_past = Mission::where('end_date','<',now())->limit(3)->get();
      $missions_future= Mission::where('start_date','>=',now())->limit(3)->get();

      return view('dashboard.home',["missions_past"=>$missions_past,"missions_future" =>$missions_future]);
    }

}
