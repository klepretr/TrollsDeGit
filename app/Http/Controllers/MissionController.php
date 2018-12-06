<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;


class MissionController extends Controller
{
    
    public function getAllPastMission(){
      $missions = Mission::where('end_date','<',now())->get();
      return response()->json($missions);
    }
    public function getAllFutureMission(){
        $missions = Mission::where('start_date','>=',now())->get();
        return response()->json($missions);
      }

}
