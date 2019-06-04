<?php 
namespace App\Services;
use Auth;
use Session;
use App\User;
use App\order_placeds;
use App\card_details;
use DB;
use Sesssion;
class orderPlacedService
{
	public function orderInPending( $request, $transactionNo, $orderNo )
	{
		for ($i = 0; $i < count($request['product_name']); $i++) { 
			$product = DB::table('order_placeds')->where([ 'user_id' => Auth::id(), 'product_id' => $request['id'][$i], 'order_status' => 'pending' ])->get();
			if( count($product) == 0 ){
			$orderPlaced = new order_placeds();
			$orderPlaced->user_id = Auth::id();
			$orderPlaced->product_id = $request['id'][$i];
			$orderPlaced->transaction_no = $transactionNo;
			$orderPlaced->order_no = $orderNo;
			$orderPlaced->order_status = 'pending';
			$orderPlaced->payment_mode = 'paytm';
			$orderPlaced->quantity = $request['quantity'][$i];
			$orderPlaced->price = $request['price'][$i];
			$orderPlaced->totalPrice = $request['price'][$i];
			$orderPlaced->phoneNo = $request['phone'];
			$orderPlaced->address = $request['address'];
			$orderPlaced->save();
			}
		Session::forget('cardData');
		}
		
	}

	public function orderPlaceChangeStatus( $status )
	{
			$productDetails = order_placeds::where([ 'user_id' => Auth::id(), 'order_status' => 'pending' ])->get();
			$productDetails = json_decode($productDetails);
			if( isset( $status ) && $status == 'success')
			{
				$this->updateOrderStatus( $productDetails, 'success' );
				$this->updateCardStatus( $productDetails );
			}	
			else
			{
				$this->updateOrderStatus( $productDetails, 'failed' );
			}
	}


	public function updateOrderStatus( $productDetails, $status )
	{
			for ($i = 0; $i < count($productDetails) ; $i++) { 
					$product = order_placeds::where([ 'user_id' => Auth::id(), 'product_id' => $productDetails[$i]->product_id, 'order_status' => 'pending' ])->update(['order_status' => $status]);
			}
	}

	public function updateCardStatus( $productDetails )
	{
			for ($i = 0; $i < count($productDetails) ; $i++) { 
					$card = DB::table( 'card_details' )->where([ 'id' => $productDetails[$i]->product_id, 'email' => Auth::user()->email, 'status' => 0 ])->update(['status' => 1]);
			}
	}
}