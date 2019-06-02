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
    	$data = User::find( Auth::id() )->userprofile;
    	$phoneNo = $data->phone_no;
        $cardData = Session::get('cardData');   	
        $data = [];
            

        return view('confirmOrder', ['details' => $request, 'phoneNo' => $phoneNo, 'cardData' => $cardData, 'tprice' => checkoutAmount()]);
    }
}
