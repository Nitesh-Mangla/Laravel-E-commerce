<?php

if( !function_exists( 'SendMail' ) )
{

	 function SendMail( $array, $sender = '' )
	{
		if( !empty( $sender ) )
		{
			$array['email'] = $sender;
			$array['sender_name'] = 'Nitesh Mangla';
		}

		$SENDGRID_API_KEY = '';
        $email = new \SendGrid\Mail\Mail(); 
		$email->setFrom("niteshmangla1992@gmail.com", "Nitesh Mangla");
		$email->setSubject($array['subject']);
		$email->addTo($array['email'], $array['sender_name']);
		$email->addContent("text/plain",$array['body']);
		$email->addContent(
		    "text/html", "<strong>".$array['body']."</strong>"
		);
		$sendgrid = new \SendGrid('');
		try {
		    $response = $sendgrid->send($email);
		    
		    if( $response->statusCode() == '202' || $response->statusCode() == '200')
		    {
		    	return true;
		    }else{
		    	return false;
		    }
			   		  
		} catch (Exception $e) {
		    echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}
}