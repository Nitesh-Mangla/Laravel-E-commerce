<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userprofile;
use App\User;
use Auth;
use App\card_details;
use DB;
use Session;

class checkoutModel extends Controller
{
    protected $userProfile;
    public function __construct()
    {
    	$this->userProfile = new userprofile();
    }

    public function checkPageDirect( Request $request )
    {
    	$data          = User::find( Auth::id() )->userprofile;
    	$phoneNo       = $data->phone_no;
        $cardData      = Session::get('cardData');   
        $id            = $cardData['id'];
        $productName   = $cardData['product'];
        $quantity      = $cardData['quantity'];
        $Totalprice         = $cardData['price'];
        $data = array( array() );
        //$i = 0;
       
       for( $i = 0; $i<count($id); $i++ )
       {
            $data[$i]['id'] = $id[$i];
            $data[$i]['product'] = $productName[$i];
            $data[$i]['quantity'] = $quantity[$i];
            $data[$i]['total'] = $Totalprice[$i];
            $data[$i]['price'] = $Totalprice[$i]/$quantity[$i];
       }
       
        return view('confirmOrder', ['details' => $request, 'phoneNo' => $phoneNo, 'cardData' => $data, 'tprice' => checkoutAmount()]);
    }
}
