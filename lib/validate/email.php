<?php
class lib_validate_email{
	public static function val($email){
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 return false; 
		}
		return true;
	}
}
?>