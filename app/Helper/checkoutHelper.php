<?php
use Illuminate\Support\Facades\Auth;
use App\user;
use App\card_details;

if( !function_exists( 'checkoutAmount' ) )
{
	 function checkoutAmount()
	{
		if( Auth::check() ){
			$cardData = DB::table('card_details')->where( ['status' => 0, 'email' => Auth::User()->email] )->get();
			$amount = 0;
			foreach ($cardData as $key => $value) {
				$amount = $amount + $value->price;
			}

			return $amount;
		}else{
			return 0;
		} 
		
	}
}

