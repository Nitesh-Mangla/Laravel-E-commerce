<?php

if( !function_exists( 'SendMail' ) )
{

	 function SendMail( $array )
	{
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
		    echo "<pre>";
		    if( $response->statusCode() == '202')
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