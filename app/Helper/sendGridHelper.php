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
		$sendgrid = new \SendGrid('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');
		try {
		    $response = $sendgrid->send($email);
		    
		    if( $response->statusCode() == '202' || $response->statusCode() == '200')
		    {
		    	return true;
		    }else{
		    	return false;
		    }
			    // print_r($response->headers());
			    // print $response->body() . "\n";
		  
		} catch (Exception $e) {
		    echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}
}