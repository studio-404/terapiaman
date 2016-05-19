<?php
class lib_functions_redirect{
	public static function url($url=""){
		if(empty($url)){
			echo '<meta http-equiv="refresh" content="0"/>';
		}else{
			header("Location: ".$url."");
			echo '<meta http-equiv="refresh" content="0; url='.$url.'"/>';
		}
		exit();
	}
}
?>