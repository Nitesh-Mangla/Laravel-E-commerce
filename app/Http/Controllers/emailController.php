<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Mail;
class emailController extends Controller
{
    public function sendMail()
    {
    	$SENDGRID_API_KEY = '';
        $email = new \SendGrid\Mail\Mail(); 
		$email->setFrom("niteshmangla1992@gmail.com", "Nitesh Mangla");
		$email->setSubject("Sending with SendGrid is Fun");
		$email->addTo("niteshmangla1992@gmail.com", "sunil mangla");
		$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
		$email->addContent(
		    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
		);
		$sendgrid = new \SendGrid('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');
		try {
		    $response = $sendgrid->send($email);
		    echo "<pre>";
		    print $response->statusCode() . "\n";
		    print_r($response->headers());
		    print $response->body() . "\n";
		} catch (Exception $e) {
		    echo 'Caught exception: '. $e->getMessage() ."\n";
		}
 }   
}
