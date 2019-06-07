<?php 
namespace App\Services;
use App\User;
use Auth;
class userProfileDataService
{
	public function getUserProfileDetails()
    {
    	$UserProfileDetails = User::find(Auth::id())->userprofile;    	
    	return $UserProfileDetails;
    }
}
?>