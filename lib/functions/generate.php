<?php
class lib_functions_generate{
	public static function random($length)
	{
	    $bytes = openssl_random_pseudo_bytes($length * 2);
	    return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
	}
}
?>