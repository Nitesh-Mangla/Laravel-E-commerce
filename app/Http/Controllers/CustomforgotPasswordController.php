<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Validator;
use Illuminate\Support\Facades\Hash;

class CustomforgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function Validation( Request $request )
    {
        $validator = Validator::make( $request->all(), [
            'email' => 'required|string'
        ] );

        if( $validator->fails() )
        {
            Session::flash( 'message', $validator->messages()->first() );
        }
        else
        {
            $this->changePasswordLink( $request );
        }
        return redirect()->to('/forgetPassword');
    }

    public function changePasswordLink( $request )
    {
        if( !empty( $request->email ) )
        {
            $userExists =  User::where( ['email' => $request->email] )->first();
           
            if( $userExists )
            {
                if( $this->link( $userExists ) )
                {
                    Session::flash('message', 'Change Password Link has been sent ');
                }
                else
                {
                    Session::flash('message', 'Somethings Went worng! Try again ');
                }

            }
            else
            {
                Session::flash('message', 'Email does not exists in our records');
            }
           
        }
        

    }

    public function forgotPassword( Request $request )
    {
    	$validator = Validator::make( $request->all(), [
    		'password'  => 'required|min:6'
    	]);

    	if( $validator->fails() )
    	{
    		Session::flash( 'message', $validator->messages()->first() );
    		return view('changePassword', ['id' => $request->id]);
    	}
    	else
    	{
    		User::where(['id' => $request->id])->update( ['password' =>Hash::make( $request->password )  ]);
    		Session::flash('verify_mail', 'Password has been changed Successfully');
    	}

    	return redirect()->to('/login');
    }

    public function link( $userExists )
    {
        $emailInfo = array(
                'email' => $userExists->email,
                'sender_name' =>$userExists->name,
                'body'   => '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <tbody><tr width="100%"> <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <table cellpadding="0" cellspacing="0" style="border:none;padding:0 18px;margin:50px auto;width:500px;"> <tbody> <tr style="background-color:#fff"> <td colspan="2" style="width:50%;padding: 20px;font-weight: 600;color: #443f3f;text-align: center;font-size: 21px;">Change Password</td></tr><tr style="background-color:#fff"> <td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Click Here to change your password</td>  <td style="width:50%;padding: 12px 20px; color: #443f3f;"><a href="'.url('/forgetPassword').'?id='.$userExists->id.'" alt="verification">Click Here</a></td></tr><tr style="background-color:#f9c548"> <td colspan="2" style="width:50%;padding: 12px 20px; color: #443f3f;text-align: center;">© 2019 Mangla Store – All rights reserved.</td></tr></tr> </tbody></table> </td> </tr></tbody> </table>',
                'subject' => 'Change Password'

            );

        if(SendMail( $emailInfo ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
