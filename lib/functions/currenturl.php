<?php
class lib_functions_currenturl{
	public static function u(){
		$actual_link = "$_SERVER[REQUEST_URI]";
		$u = "http://$_SERVER[HTTP_HOST]".urldecode($actual_link);
		return $u;
	}
}
?>