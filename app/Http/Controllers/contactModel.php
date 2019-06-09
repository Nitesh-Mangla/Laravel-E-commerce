<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contactDetails;
use Validator;
use Session;
class contactModel extends Controller
{
	public function validatior( Request $request )
	{
			$validator = Validator::make( $request->all(), [
				'name'  => 'required|string',
				'email' => 'required|email',
				'phone' => 'required|numeric|min:10',
				'message' => 'required|string|min:50'
			] );

			if( $validator->fails() )
			{
				Session::flash('message', $validator->messages()->first());
				return redirect()->route('contact')->withInput();
			}
			else{
				if( $this->contactDetails( $request ) )
				{
					Session::flash('message', 'Email has been sent to admin');
					return redirect()->route('contact');
				}
				else{
					Session::flash('message', 'Somethings went wrong. Try again later');
					return redirect()->route('contact')->withInput();
				}
			}

			return redirect()->route('contact');

	} 

    public function contactDetails( $request )
    {
    	
    	$insert = contactdetails::insert( [ 'name' => $request->name, 'email' => $request->email, 'phoneNo' => $request->phone, 'message' => $request->message] );

    	if( $insert )
    	{
    		$emailInfo = array(
                'email' => $request->email,
                'sender_name' => $request->name,
                'body'   => '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <tbody><tr width="100%"> <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <table cellpadding="0" cellspacing="0" style="border:none;padding:0 18px;margin:50px auto;width:500px;"> <tbody> <tr style="background-color:#fff">	<td colspan="2" style="width:50%;padding: 20px;font-weight: 600;color: #443f3f;text-align: center;font-size: 21px;">Contact Details</td></tr><tr style="background-color:#fff">	<td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Date</td>	<td style="width:50%;padding: 12px 20px; color: #443f3f;">'.date("M,d,Y h:i:s A").'</td></tr><tr style="background-color:#fff">	<td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Name</td> <td style="width:50%;padding: 12px 20px; color: #443f3f;">'.$request->name.'</td></tr><tr style="background-color:#fff">	<td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Email</td>	<td style="width:50%;padding: 12px 20px; color: #443f3f;">'.$request->email.'</td></tr><tr style="background-color:#fff">	<td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Phone</td>	<td style="width:50%;padding: 12px 20px; color: #443f3f;">'.$request->phone.'</td></tr><tr style="background-color:#fff">	<td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">Message</td>	<td style="width:50%;padding: 12px 20px; color: #443f3f;">'.$request->message.'</td></tr><tr style="background-color:#f9c548">	<td colspan="2" style="width:50%;padding: 12px 20px; color: #443f3f;text-align: center;">© 2019 Mangla Store – All rights reserved.</td></tr></tr> </tbody></table> </td> </tr></tbody> </table>',

                'subject' => 'Contact Details'
            );
    		SendMail( $emailInfo );
    		SendMail( $emailInfo, 'niteshmangla1992@gmail.com' );
    		return true;
    	}
    	else{
    		return false;
    	}
    }
}
