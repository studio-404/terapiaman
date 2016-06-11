<?php
class lib_functions_removefile{
	public static vanish($filepath){
		$out = false; 
		if(file_exists($filepath)){
			unlink($filepath);
			$out = true;
		}
		return $out;
	}
}
?>