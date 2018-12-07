<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mission;

use App\Models\User;
use App\Models\Stuff;



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
      $agents=User::where("role", User::AGENT)->get();
      return view('dashboard.agent',["agents"=>$agents]);
    }
    public function gestionMateriel()
    {
      return view('dashboard.materiel');
    }
    public function createMission()
    {
      $agents=User::where("role",User::AGENT)->get();
      $materiels=Stuff::get();

      return view('dashboard.new_mission',["agents"=>$agents,"materiels"=>$materiels]);
    }

    public function createMissionAction(Request $request)
    {
      $name=$request->input('mission_name');
      $date=$request->input('mission_date');

     dd($request);
    }


    
}
