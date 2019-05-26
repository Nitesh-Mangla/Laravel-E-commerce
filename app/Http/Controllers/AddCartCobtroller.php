<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class AddCartCobtroller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function addToCard( Request $request )
    {

    	if( $request->input('id') )
    	{  
    		$product = DB::table('product details')
    					->where('id', $request->input('id'))   	
    					->get();
                       
            $product =json_decode($product);

            $exists = DB::table('card details')->select('status','quantity','price')
                            ->where(['email' => Session::get('username'), 'product id' => $request->input('id') ])->get();

            
             if( count($exists) > 0)
             {                
                if( $exists[0]->status == '1')
                {   

                    DB::table('card details')->where(['product id' => $request->input('id'), 'email' => Session::get( 'username')])->update(['status' => 0, 'quantity' => 1, 'price' => $product[0]->price]);
                }else{
                    
                    $qyt = $exists[0]->quantity + 1;
                    $price = $exists[0]->price + $product[0]->price;

                    DB::table('card details')->where(['product id' => $request->input('id'), 'email' => Session::get( 'username')])->update(['status' => 0, 'quantity' => $qyt, 'price' => $price]);
                }

             }  else{

                    $insert = DB::table('card details')->insert(['email' => Session::get('username'), 'quantity' => 1,'price' => $product[0]->price, 'product id' => $request->input('id')]); 
             }             
           
             
             
    	}
    	   
          $card  = DB::table('card details')->leftjoin('product details', 
                                        'card details.product id', '=', 'product details.id')
                                        ->select(DB::raw('sum(`card details`.price)  as total'),'card details.*', 'product details.id','product details.image','product details.product_name','product details.quantity as qyt')
                                        ->where('card details.email', Session::get('username') )
                                        ->where('status', 0)
                                        ->GROUPBY('product details.id')
                                        ->orderBy('product details.id','DESC')
                                        ->get();


          $count = $card->count();                              
          $totalPrice = $card->sum('price');  
            //Session::forget('id');        

          return view('/card',['products' => $card, 'number' => $count, 'totalPrice' => $totalPrice]); 
    }

    public function updateProductQuantities( Request $request )
    {          
        // define('id', $request->input('id')); 
        // $price = DB::table('product details')->select('price')->where('id', function($query){   
        //     $query->select('product id')->from('card details')->where('id', id);
        // })->get();

        $cardId = DB::table('card details')->select('id')->where(['email' => Session::get('username'),
                                    'product id' => $request->input('id'),])
                                    ->get();  
            
                
        $status = DB::table('card details')-> where('id' , $cardId[0]->id)->
                update(['quantity'=> $request->input('qyt'), 'price' => $request->input('price')]);

        if( $status )
        {
            echo 'updated';
        }else{
            echo 'not updated';
        }
            
    }

    public function deleteCardProduct(Request $request)
    {

         $cardId = DB::table('card details')->select('id')->where(['email' => Session::get('username'),
                                    'product id' => $request->input('id')])
                                    ->get();  

        $status = DB::table('card details')->where('id', $cardId[0]->id)
                            ->update(['status' => 1]);
        if( $status ){
            echo "Product is successfully Deleted";
        }                    
    }
}
