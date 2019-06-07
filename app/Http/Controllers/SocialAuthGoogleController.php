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
                DB::table('userprofiles')->insert(array('user_id' => $user->id, 'image' => $googleUser->avatar));

                $emailInfo = array(
                'email' => $googleUser->email,
                'sender_name' =>$googleUser->name,
                'body'   => 'Click on this to verify your account <a href="#" atl="">Click Here...</a>',
                'subject' => 'Verify Your Account'

            );

               if(SendMail( $emailInfo )){                  // verification mail
                    return redirect()->to('/');
                }else{
                    return redirect()->to('/login');
                }
            }
            return redirect()->to('/');
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
