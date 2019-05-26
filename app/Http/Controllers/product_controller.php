<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class product_controller extends Controller
{

    public function  fetchProducts()
    {
    	$products = DB::table('product details')
    			->select('id', 'image', 'product_name', 'description' , 'type', 'discount', 'price')
    			->offset(0)
    			->limit(9)
    			->get();

    	return view('home', ['products' => $products, 'size' => count($products)]);
    			
    }
}
