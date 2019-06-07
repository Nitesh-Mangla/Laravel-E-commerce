<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
// use App\Services\SocialFacebookAccountService;
use App\User;
use Auth;
use Redirect;
use DB;
use Session;
use userprofile;
class facebookLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {
       try {
            $user = Socialite::driver('facebook')->user(); 	 
            
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();
            $create['password'] = md5(rand(0, 999));
            Session::put('username', $user->getEmail());
            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);

            $userExists = DB::table('userprofiles')->where('user_id' , $createdUser->id)->get();

            if( count( $userExists ) <= 0 ){
            DB::table('userprofiles')->insert(['user_id' => $createdUser->id, 'image' => $user->avatar]);
        	}

            $emailInfo = array(
                'email' => $user->getEmail(),
                'sender_name' => $user->getName(),
                'body'   => 'Click on this to verify your account <a href="#" atl="">Click Here...</a>',
                'subject' => 'Verify Your Account'

            );
            if(SendMail( $emailInfo )){
                return redirect()->to('/');
            }else{
                return redirect()->to('/login');
            }
            return redirect()->to('/');


        } catch (Exception $e) {


            return redirect('/login');


        }
    }
}
