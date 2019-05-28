<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::GET('/payamount' ,function(){
		return view('test');
	});

	Route::GET('/orderConfirmation' ,function(){
		return view('confirmOrder');
	});

	Route::GET('/','product_controller@fetchProducts');
	Auth::routes(['verify' => true]);
	Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
	Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
	Route::get('/redirect', 'SocialAuthGoogleController@redirect');
	Route::get('/callback', 'SocialAuthGoogleController@callback');
	Route::GET('/shop', 'Controller@shop')->name('shop');
	Route::GET('/singleproduct', 'Controller@singleProduct')->name('singleproduct');
	Route::GET('/card{id?}', 'Controller@card')->name('card');
	Route::POST('/paytmResponse', 'orderController@placeOrder')->name('paytmResponse');
	Route::POST('/paytmResponseCall', 'orderController@paytmResponseCallback')->name('paytmResponseCall');


Route::Group(['middleware' => 'userAuth'], function(){	
	Route::get('home', 'HomeController@index')->name('home');		
	Route::match(['GET', 'POST'], '/checkout', 'Controller@checkout')->name('checkout');	
	Route::GET('/addCard', 'AddCartCobtroller@addToCard')->name('addcard');
	Route::GET('/updateProductQuantities', 'AddCartCobtroller@updateProductQuantities')->name('updateProductQuantities');
	Route::GET('/deleteCardProduct', 'AddCartCobtroller@deleteCardProduct')->name('deleteCardProduct');
	Route::GET('/userprofile','Controller@userProfile')->name('userProfile');
	Route::GET('/profileData','userProfileController@userProfileData')->name('userProfileData');
	Route::GET('/editProfile', 'userProfileController@editUserProfile')->name('editUserProfile');
	Route::POST('/changeUserProfile', 'userProfileController@changeUserProfile')->name('changeUserProfile');
});



