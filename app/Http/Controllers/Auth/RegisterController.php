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
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'fname' => 'required|string|max:255',
        //     'lname' => 'required|string|max:50',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'Password' => 'required|string|min:6|confirmed',
            

        // ]);
        return Validator::make($data,[
            // 'fname'    => 'required|string',
            // 'lname'    => 'required|string',
            // 'email'    => 'required|email|string|unique:users',
            // 'Password' => 'required|max:15|min:6|confirmed',
            // //'profile'  => 'required|image|mimes:jpg,JPEG,png,PNG,GIF|max:2048',
            // 'address'  => 'required|string|',
            // 'city'     => 'required|string',
            // 'state'    => 'required|string',
            // 'phone'    => 'required|numeric|min:12|max:15',
            // 'pin'      => 'required|numeric',
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
