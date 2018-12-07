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
        	if(count($request->materiel)) {
        		foreach($request->materiel as $stuff_id)
        		{
        			$stuff = Stuff::find($stuff_id);
        			$mission->stuffs()->save($stuff);
        		}
        	}
        	if(count($request->addtask)){
        		foreach($request->addTask as $task_description) {
        			$task = MissionsTask::create(['description'=>$task_description]);
        			$mission->tasks()->save($task);
        		}
        	}

        	return redirect(route('dashboard.index'))->with('status', 'Envoyer à '.$request->email.' le token d inscription suivant : '.$token);
        } else {
        	return redirect(route('dashboard.registerToken'));
        }
    }

}
