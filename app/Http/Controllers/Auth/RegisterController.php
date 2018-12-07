<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use App\Models\Registration;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {

        if(Auth::user()->role==Auth::user()::SUPERVISEUR or Auth::user()->role==Auth::user()::ADMIN){
            return route('dashboard.index');
        } elseif(Auth::user()->role==Auth::user()::AGENT){
            return route('cockpit.index');
        }   

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'gender' => ['required'],
            'phone_number' => ['required','string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'token_registration'=>['required', 'string'],
            'age'=>['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['token_registration'] == Registration::where('email', $data['email'])->first()->token){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'firstname'=>$data['firstname'],
                'lastname'=>$data['lastname'],
                'gender'=>$data['gender'],
                'phone_number'=>$data['phone_number'],
                'role'=>substr($data['token_registration'], 0, 1),
                'age'=>$data['age'],
                'password' => Hash::make($data['password']),
            ]);
            if($user) {
                Registration::where('token', $data['token_registration'])->delete();
                return $user;
            }
        } else {
            abort(403);
        }

    }
}
