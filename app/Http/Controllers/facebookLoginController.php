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
            $userExists = user::select('email_verified_at')->where(['email' => $user->email])->first();
            
            if( empty($userExists->email_verified_at)  )
            {               
                Session::put('id', $user->id);
                Session::put('email', $user->email);
                Session::flash('message', 'Verify Your Account');
                return redirect()->to('/login');
            }
            else
            {
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

                 if( $this->newUserVerificationEmail( $createdUser ) )
                 {
                    return  redirect()->to('/login');
                 }
            }
            return redirect()->to('/login');


        } catch (Exception $e) {


            return redirect('/login');


        }
    }

    public function newUserVerificationEmail( $facebookUser )
    {
        $emailInfo = array(
                'email' => $facebookUser->email,
                'sender_name' =>$facebookUser->name,
                'body'   => '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <tbody><tr width="100%"> <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <table cellpadding="0" cellspacing="0" style="border:none;padding:0 18px;margin:50px auto;width:500px;"> <tbody> <tr style="background-color:#fff"> <td colspan="2" style="width:50%;padding: 20px;font-weight: 600;color: #443f3f;text-align: center;font-size: 21px;">NewsLetters</td></tr><tr style="background-color:#fff"> <td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Verify Your Account then Click here</td>  <td style="width:50%;padding: 12px 20px; color: #443f3f;"><a href="'.url('/verification').'?id='.$facebookUser->id.'" alt="verification">Click Here</a></td></tr><tr style="background-color:#f9c548"> <td colspan="2" style="width:50%;padding: 12px 20px; color: #443f3f;text-align: center;">© 2019 Mangla Store – All rights reserved.</td></tr></tr> </tbody></table> </td> </tr></tbody> </table>',
                'subject' => 'Verify Your Account'

            );

               if(SendMail( $emailInfo )){ 

                    Session::flash('verify_mail', 'We have sent verification Mail to Verifiy Your Account'); 
                    return true;                   
                }
                else
                {
                    return false;
                }
               
    }
}
