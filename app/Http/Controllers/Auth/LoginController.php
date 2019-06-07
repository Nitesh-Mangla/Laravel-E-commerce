<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;
use Exception;
use Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

   
    protected $redirectTo = '/';

   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();
            
            $userModel = new User;
            
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);


            //return redirect()->route('home');


        } catch (Exception $e) {


            return redirect('auth/facebook');


        }
    }
}
