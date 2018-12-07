<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use App\Models\Mission;
use App\Models\Registration;
use Auth;
use DB;
use App\Models\User;
use App\Models\Stuff;



class DashboardController extends Controller
{
    //
    public function index()
    {
        $this->middleware('auth');
      $missions_past = Mission::where('end_date','<',now())->limit(3)->orderBy('id', 'desc')->get();
      $missions_future= Mission::where('start_date','>=',now())->limit(3)->orderBy('id', 'desc')->get();

      return view('dashboard.home',["missions_past"=>$missions_past,"missions_future" =>$missions_future]);
    }

    public function report($id)
    {
      $mission= Mission::where('id','=',$id)->first();
      return view('dashboard.mission_results',["mission"=>$mission]);

    }

    /**
     * Display the view linked with the registerToken method
     * @return void
     */
    public function registerToken()
    {
    	return view('dashboard.registerToken');
    }

    /**
     * Stores in db token with role and email in order to make someone able to register
     * @param  Request $request Illuminate\Http\Request
     * @return redirect
     */
    public function storeToken(Request $request)
    {
    	$validation = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:registration'],
     		'token_registration' => ['required', 'string']
        ]);

        if($validation) {
            $token = $request->role.$request->token_registration;
        	Registration::create(['email'=>$request->email,  'token'=>$token]);
        	return redirect(route('dashboard.index'))->with('status', 'Envoyer à '.$request->email.' le token d inscription suivant : '.$token);
        } else {
        	return redirect(route('dashboard.registerToken'));
        }
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
        return redirect(route('dashboard.index'))->with('status', 'Ok, mode nuit modifié');
    }

    public function gestionAgent()
    {
      $agents=User::where("role", User::AGENT)->get();
      return view('dashboard.agent',["agents"=>$agents]);
    }
    public function gestionMateriel()
    {
      $materiels=Stuff::get();
      return view('dashboard.materiel',["materiels"=>$materiels]);
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

     //dd($request);
    }
    public function editstuff($id)
    {
      $materiel=Stuff::where('id',$id)->first();
      return view('dashboard.editmateriel',["materiel"=>$materiel]);
    }

    public function editstuffAction(Request $request)
    {
      $name=$request->input('name');
      $description=$request->input('description');
      $type=$request->input('type');
      $state=$request->input('state');
      $id=$request->input('id');

      $materiel=Stuff::find($id);
      $materiel->name=$name;
      $materiel->description=$description;
      $materiel->type=$type;
      $materiel->state=$state;
      $materiel->save();
      return redirect(route("dashboard.gestionMateriel"));
    }
}
