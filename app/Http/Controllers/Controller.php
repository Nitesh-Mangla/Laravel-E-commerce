<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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

     public function checkout( Request $request )
    {

        if( $request->input('id') )
        {
            Session::put('card_ids', $request->input('id'));
             $tPrice = 0;
            foreach ($request->input('price') as $key => $value) {
              
                $tPrice = $value + $tPrice;
            }
            return view('checkout', ['tprice' => $tPrice]);
             
        }
    	return view('checkout', ['tprice' => 0]);
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
