<?php 
namespace App\Helpers;

class Helpers {
	/*
	* Check exit email
	*/
	public static function checkUsernameOrEmail($str) {
		$check_is_email = strpos($str,'@');
		if (isset($check_is_email)) return true;
		return false;
	}
}
