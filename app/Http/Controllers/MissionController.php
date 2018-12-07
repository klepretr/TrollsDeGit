<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\User;
use App\Models\Stuff;
use App\Models\MissionsTask;


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

    public function createMission()
    {
      	$agents=User::where("role",User::AGENT)->get();
      	$materiels=Stuff::get();

      	return view('dashboard.new_mission',["agents"=>$agents,"materiels"=>$materiels]);
    }

    public function showMission($id)
    {
    	$mission = Mission::find($id);
    	return view('dashboard.showMission',['mission'=>$mission]);
    }

    public function storeMission(Request $request)
    {
    	$validation = Validator::make($request->all(), [
            'mission_name' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:registration'],
     		'mission_date' => ['required', 'date'],
     		'end_date'=>['date'],
     		'description' => ['required', 'string'],
        ]);

        if($validation) {
        	$mission = Mission::create(['name'=>$request->mission_name, 'description'=>$request->description, 'start_date'=>$request->mission_date, 'end_date'=>$request->end_date, 'state'=>'pending']);
        	if(isset($request->materiel) && count($request->materiel)) {
        		foreach($request->materiel as $stuff_id)
        		{
        			$mission->stuffs()->attach($stuff_id);
        		}
        	}
        	if(isset($request->agent) && count($request->agent)){
        		foreach($request->agent as $agent) {
        			$mission->user()->attach($agent);
        		}
        	}
        	if(isset($request->addtask) && count($request->addtask)){
        		foreach($request->addtask as $task_description) {
        			$mission->tasks()->create(['description'=>$task_description]);
        		}
        	}

        	return redirect(route('dashboard.index'))->with('status', 'Mission enregistrée avec succès !');
        } else {
        	return redirect(route('dashboard.index'));
        }
    }

}
