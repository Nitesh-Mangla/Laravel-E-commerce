<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;
use Session;
use DB;
class SocialAuthGoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $existUser = User::where('email',$googleUser->email)->first();
            if($existUser) {
                Auth::loginUsingId($existUser->id);               
                Session::put('username', $googleUser->email);
            }
            else {
                Session::put('username', $googleUser->email);
                $user = new User;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
                $user->google_id = $googleUser->id;
                $user->password = md5(rand(1,10000));	
                $user->save();
                Auth::loginUsingId($user->id);
                DB::table('userprofile')->insert(array('user_id' => $user->id, 'image' => $googleUser->avatar));
                
            }
            return redirect()->to('/');
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
