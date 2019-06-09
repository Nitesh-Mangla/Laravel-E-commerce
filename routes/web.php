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

	Route::GET('/','product_controller@fetchProducts');
	Auth::routes(['verify' => true]);
	// Route::GET('/email', 'emailcontroller')
	Route::get('auth/facebook', 'Auth\LoginController@redirectToFacebook');
	Route::get('auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
	Route::get('/redirect', 'SocialAuthGoogleController@redirect');
	Route::get('/callback', 'SocialAuthGoogleController@callback');
	Route::GET('/shop', 'Controller@shop')->name('shop');
	Route::GET('/singleproduct', 'Controller@singleProduct')->name('singleproduct');
	Route::GET('/card{id?}', 'Controller@card')->name('card');
	Route::POST('/paytmpayment', 'orderController@placeOrder')->name('paytmpayment');
	Route::POST('/paytmResponseCall', 'orderController@paytmResponseCallback')->name('paytmResponseCall');
	Route::Get('/facebookLogin', 'facebookLoginController@redirect')->name('facebookLogin');
	Route::Get('/facebookcallback', 'facebookLoginController@callback')->name('facebookCallback');

	Route::GET( '/contact', [
		'uses' => 'controller@contactForm',
		 'as'  => 'contact'
	] );

	Route::POST('/contactDetails', [
		'uses'  => 'contactModel@validatior',
		'as'    => 'contactForm'
	]);

	Route::POST('/newsletter', [
		'uses' => 'newsletterController@validation',
		'as'   => 'newsletter'
	]);

	Route::POST('/unsubscribe', [
		'uses'  => 'newsletterController@unSubscribe',
		'as'    => 'unSubscribe'
	]);

	Route::GET('/verified', [
		'uses'  => 'SocialAuthGoogleController@sendVerifiedEmail',
		'as'    => 'verified'
	]);

	Route::GET('/verifiedEmail', [
		'uses'  => 'SocialAuthGoogleController@verifiedEmail',
		'as'    => 'verifiedEmail'
	]);

	Route::GET('/forgetPassword', [
		'uses' => 'controller@forgetPassword',
		'as'   => 'forgetPassword'
	]);

	Route::POST('/changePasswordLink', [
		'uses' => 'CustomforgotPasswordController@Validation',
		'as'   => 'changePasswordLink'
	]);

	Route::POST('/changePassword', [
		'uses' => 'CustomforgotPasswordController@forgotPassword',
		'as'   => 'changePassword'
	]);
	
Route::Group(['middleware' => 'userAuth'], function(){	
	Route::get('/home', 'HomeController@index')->name('home');		

	Route::match(['GET', 'POST'], '/checkout', 'Controller@checkout')->name('checkout');	
	Route::GET('/addCard', 'AddCartCobtroller@addToCard')->name('addcard');

	Route::GET('/updateProductQuantities', 'AddCartCobtroller@updateProductQuantities')->name('updateProductQuantities');

	Route::GET('/deleteCardProduct', 'AddCartCobtroller@deleteCardProduct')->name('deleteCardProduct');

	Route::GET('/userprofile','Controller@userProfile')->name('userProfile');

	Route::GET('/profileData','userProfileController@userProfileData')->name('userProfileData');

	Route::GET('/editProfile', 'userProfileController@editUserProfile')->name('editUserProfile');

	Route::POST('/changeUserProfile', 'userProfileController@changeUserProfile')->name('changeUserProfile');

	Route::POST('/orderConfirmation', 'checkoutModel@checkPageDirect')->name('orderConfirmation');
});



