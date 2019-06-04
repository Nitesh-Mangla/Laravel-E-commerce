<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\userProfileDataService;
use DB;
use Session;
use Illuminate\Http\Request;
use Redirect;
use Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function shop()
    {
        $products = DB::table('product details')->offset(0)->limit(12)->get();
    	return view('shop', ['products' => $products, 'size' => count($products)]);
    }

     public function checkout( Request $request, userProfileDataService $profileData )
    {
        Session::forget('cardData');
        Session::put('cardData', $request->all());
        //dd(Session::get('cardData'));
    	return view('checkout', ['tprice' => checkoutAmount(), 'userProfile' =>  json_decode($profileData->getUserProfileDetails())]);
    }

    public function card( Request $request )
    {
        

        if(Auth::check()){

            if( $request->input('id') ){               
               
                return redirect()->route('addcard', ['id' => $request->input('id')]);
            }
            return redirect()->route('addcard');
           
        }else{
            return redirect('login');
        }
    }

     public function singleProduct(Request $request)
    {

        $product = DB::table('product details')
                    ->where('id' , $request->input('id'))
                    ->get();
                    
    	return view('singleProduct' ,[ 'product' => $product ]);
    }

    public function userProfile()
    {
        return redirect()->route('userProfileData');
    }
}
