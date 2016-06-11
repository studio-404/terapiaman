<?php 
class lib_functions_geturl{

	public static function slugs($c){
		$out = '';
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$explode = explode($c["website.base"], $actual_link); 
		if(count($explode) > 1){
			$out = explode("/", $explode[1]);
		}
		return $out;
	}

	public static function num($c,$n){
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$explode = explode($c["website.base"], $actual_link); 
		if(count($explode) > 1){
			$out = explode("/", $explode[1]);
			if(!empty($out[$n])){
				return urldecode($out[$n]);
			}
			return false;
		}		
		return false;
	}
}
?>