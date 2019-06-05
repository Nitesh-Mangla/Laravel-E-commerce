<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Validation;
use Illuminate\Support\Facades\Hash;

class userProfileController extends Controller
{
    public function userProfileData()
    {
    	$userData = DB::table('users')->join('userprofiles', 'users.id' ,'=', 'userprofiles.user_id')
    		->select('users.*', 'userprofiles.*')->where('users.email', Session::get('username'))->get();

    	return view('userProfile', ['data' => $userData]);
    }

    public function editUserProfile( Request $request )
    {
    	$data = $request->input('data');
      
        if( !empty($data[4]['value']) )
        {
            DB::table('userprofiles as up')->join('users as u', 'up.user_id', '=', 'u.id')->where('up.id','=', $data[1]['value'])->update(['up.phone_no' => $data[2]['value'], 'u.password' => Hash::Make($data[6]['value']), 'address' => $data[3]['value'], 'city' => $data[5]['value'], 'state' => $data[4]['value']] );
        }else{
            DB::table('userprofile')->where('id','=', $data[1]['value'])->update(['phone_no' => $data[2]['value'], 'address' => $data[3]['value'], 'city' => $data[5]['value'], 'state' => $data[4]['value']] );   
        }    	
    } 

    public function changeUserProfile( Request $request )
    {
       $image =$_FILES['file']['name'];;
       $ext = explode('.', $image);
       $checktext = array( 'png', 'jpeg', 'jpg', 'PNG', 'JPG', 'JPEG' );
       if( !in_array($ext[1], $checktext) )
       {
            echo "File Must be in jpg, png format";
       }
       else
       {
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'profile_pic/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            if( $request->file('file')->move($dir, $filename))
            {
                DB::table('userprofiles')->where('id' , $request->input('id'))->update(['image' => $filename]);
                echo "Profile Pic Uploaded successfully";
            }else{
                echo "Error White Uploading Image";
            }

    }
}
}
