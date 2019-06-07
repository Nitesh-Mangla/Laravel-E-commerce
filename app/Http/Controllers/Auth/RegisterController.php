<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\userProfile;
use Illuminate\Http\Request;
use Session;
use DB;
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
    protected $redirectTo = '/home';

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
    protected function validator(array $request)
    {
       
        $validator =  Validator::make($request, [
            'fname'    => 'required|string',
            'lname'    => 'required|string',
            'email'    => 'required|email|string|unique:users',
            'Password' => 'required|max:15|min:6|confirmed',
            'address'  => 'required|string|',
            'city'     => 'required|string',
            'state'    => 'required|string',
            'phone'    => 'required|numeric|min:12|max:15',
            'pin'      => 'required|numeric',
        ]); 
           
            return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::put('username', $data['email']);        
        $user =  User::create([
            'name' => $data['fname'].' '.$data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['Password']),
            
        ]);
        $this->insertIntoUserProfile( $data, $user->id );
        return $user;
    }

    public function insertIntoUserProfile( $data, $id )
    {       
            $data = DB::table('userprofiles')->insert(['user_id' => $id, 'address' => $data['address'], 'city' => $data['city'], 'state' => $data['state'], 'phone_no' => $data['phone'], 'image' => 'profile_pic.jpg']);     
        
    }
}
