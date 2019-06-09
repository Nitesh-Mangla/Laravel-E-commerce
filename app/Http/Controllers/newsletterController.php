<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\newsletter;
use Validator;
use Session;
class newsletterController extends Controller
{
    
    public function validation( Request $request )
    {
    	$validator = Validator::make( $request->all() ,[
    		'email' => 'required|email'
    	] );

    	if( $validator->fails() )
    	{

    		$message = $validator->messages()->first();
    		dd($message);
    	}
    	else
    	{
    		if( $this->subscribe( $request ) )
    		{
    			$message = 'You are now receive all news';	
    		}
    		else
    		{
    			$message = 'Somethings went wrong';
    		}
    	}

    	Session::flash('newsmessage', $message );
    	return redirect(url()->previous());
    }
    
    public function subscribe( $request )
    {
    	$exists = newsletter::where( ['email' => $request->email] )->get();
    	
    	if( COUNT( $exists ) > 0 )
    	{
    		return false;
    	}
    	else
    	{
    		$news = new newsletter();
    		$news->email = $request->email;
    		$insert = $news->save();
    		$id = $news->id;
    		if( $insert )
    		{
    			$emailInfo = array(
                'email' => $request->email,
                'sender_name' => '',
                'body'   => '<table cellspacing="0" cellpadding="0" border="0" style="color:#333;background:#fff;padding:0;margin:0;width:100%;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <tbody><tr width="100%"> <td valign="top" align="left" style="background:#eef0f1;font:15px/1.25em Helvetica Neue,Arial,Helvetica"> <table cellpadding="0" cellspacing="0" style="border:none;padding:0 18px;margin:50px auto;width:500px;"> <tbody> <tr style="background-color:#fff">	<td colspan="2" style="width:50%;padding: 20px;font-weight: 600;color: #443f3f;text-align: center;font-size: 21px;">NewsLetters</td></tr><tr style="background-color:#fff">	<td style="width:50%;padding: 12px 20px;font-weight: 600; color: #443f3f;">To Unsubscribe then Click here</td>	<td style="width:50%;padding: 12px 20px; color: #443f3f;"><form action="'.url('/unsubscribe').'" method="post"><input type="hidden" name="_token" value="'.csrf_token().'"><input type="hidden" value="'.$id.'" name="id"><button type="submit">Unsubscribe</button></form></td></tr><tr style="background-color:#f9c548">	<td colspan="2" style="width:50%;padding: 12px 20px; color: #443f3f;text-align: center;">© 2019 Mangla Store – All rights reserved.</td></tr></tr> </tbody></table> </td> </tr></tbody> </table>',

                'subject' => 'Thank you for subscribe'

            );
    			if(SendMail( $emailInfo ) && SendMail( $emailInfo, 'niteshmangla1992@gmail.com' )){   				
    				
    				return true;
    			}else{
    					
    				return false;	
    			}
    			
    			
    		}
    		else{
    			return false;
    		}
    	}
    }

    public function unSubscribe( Request $request )
    {
    	if( !empty($request->id) )
    	{
    		$news = newsletter::find( $request->id );
    		$news->status = '0';
    		$news->save();    		
    	}
    }
}
