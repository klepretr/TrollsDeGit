<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mission;

use App\Models\User;


class DashboardController extends Controller
{
    //
    public function index()
    {
      $missions_past = Mission::where('end_date','<',now())->limit(3)->orderBy('id', 'desc')->get();
      $missions_future= Mission::where('start_date','>=',now())->limit(3)->orderBy('id', 'desc')->get();

      return view('dashboard.home',["missions_past"=>$missions_past,"missions_future" =>$missions_future]);
    }

    public function report($id)
    {
      $mission= Mission::where('id','=',$id)->first();
      return view('dashboard.mission_results',["mission"=>$mission]);
    }

    public function gestionAgent()
    {
      return view('dashboard.agent');
    }
    public function gestionMateriel()
    {
      return view('dashboard.materiel');
    }
    public function createMission()
    {
      return view('dashboard.new_mission');
    }
}
