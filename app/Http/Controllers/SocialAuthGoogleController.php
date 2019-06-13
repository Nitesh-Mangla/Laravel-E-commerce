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
               Session::put('id', $existUser->id);
               Session::put('email', $googleUser->email);
                $isVerified = user::select('email_verified_at')->where([ 'id' => $existUser->id ])->get();

                    if( empty($isVerified[0]->email_verified_at) )
                    {                        
                        Session::flash('message', 'Verifiy Your Account ');
                        return redirect('/login');
                        
                    }else{
                         Auth::loginUsingId($existUser->id); 
                        Session::put('username', $googleUser->email);
                        return redirect()->to('/');
                    }
                
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
                'body'   => '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <tbody><tr width="100%"> <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <table cellpadding="0" cellspacing="0" style="border:none;padding:0 18px;margin:50px auto;width:500px;"> <tbody> <tr style="background-color:#fff"> <td colspan="2" style="width:50%;padding: 20px;font-weight: 600;color: #443f3f;text-align: center;font-size: 21px;">NewsLetters</td></tr><tr style="background-color:#fff"> <td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Verify Your Account then Click here</td>  <td style="width:50%;padding: 12px 20px; color: #443f3f;"><a href="'.url('/verification').'?id='.$user->id.'" alt="verification">Click Here</a></td></tr><tr style="background-color:#f9c548"> <td colspan="2" style="width:50%;padding: 12px 20px; color: #443f3f;text-align: center;">© 2019 Mangla Store – All rights reserved.</td></tr></tr> </tbody></table> </td> </tr></tbody> </table>',
                'subject' => 'Verify Your Account'

            );

               if(SendMail( $emailInfo )){  
                    Session::flash('verify_mail', 'We have sent verification Mail to Verifiy Your Account');
                    return redirect('/login');
                }
                else{
                    return redirect()->to('/login');
                }
            }
            //return redirect()->to('/');
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendVerifiedEmail(  )
    {
        $emailInfo = array(
                'email' => Session::get('email'),
                'sender_name' =>'',
                'body'   => '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <tbody><tr width="100%"> <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <table cellpadding="0" cellspacing="0" style="border:none;padding:0 18px;margin:50px auto;width:500px;"> <tbody> <tr style="background-color:#fff"> <td colspan="2" style="width:50%;padding: 20px;font-weight: 600;color: #443f3f;text-align: center;font-size: 21px;">Account Verify</td></tr><tr style="background-color:#fff"> <td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Verify Your Account</td><td style="width:50%;padding: 12px 20px; color: #443f3f;"><a alt="" href="{{'.url("/verified").'}}"?id="'.Session::get('id').'" target="_blank">Click Here</a><form></form></td></tr><tr style="background-color:#f9c548"> <td colspan="2" style="width:50%;padding: 12px 20px; color: #443f3f;text-align: center;">© 2019 Mangla Store – All rights reserved.</td></tr></tr> </tbody></table> </td> </tr></tbody> </table>',

                'subject' => "verify Your Account"

            );

                if(SendMail( $emailInfo )){  
                    Session::flash('verify_mail', 'We have sent verification Mail to '.Session::get('email'));
                    return redirect('/login');
                }
                else{
                    return redirect()->to('/login');
                }
    }

    public function verifiedEmail( Request $request )
    {
        
        $verified = user::find($request->id);
        $verified->email_verified_at = 1;
        $verified->save();
      //  Session::destroy();

        return redirect()->to('/');
    }

}
