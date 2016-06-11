<?php
class lib_functions_deletefiles{
	public static function rem($mask){
		if(is_array($mask)){
			foreach ($mask as $v) {
				array_map('unlink', glob($v));
			}
		}else{
			array_map('unlink', glob($mask));
		}
	}
}
?>