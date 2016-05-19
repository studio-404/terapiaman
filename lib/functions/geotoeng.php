<?php
class lib_functions_geotoeng{
	public static function trans($string){
		$s = urldecode($string); 
		$out = str_replace(
			array("ა", "ბ", "გ", "დ", "ე", "ვ", "ზ", "თ", "ი", "კ", "ლ", "მ", "ნ", "ო", "პ", "ჟ", "რ", "ს", "ტ", "უ", "ფ", "ქ", "ღ", "ყ", "შ", "ჩ", "ც", "ძ", "წ", "ჭ", "ხ", "ჯ", "ჰ", "-"), 
			array("a", "b", "g", "d", "e", "v", "z", "T", "i", "k", "l", "m", "n","o", "p", "J", "r", "s", "t", "u", "f", "q", "R", "y", "S", "C", "c", "Z", "w", "W", "x", "j", "h", ""), 
			$s 
		);
		
		return $out;
	}
}
?>