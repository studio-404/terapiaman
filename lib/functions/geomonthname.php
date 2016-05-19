<?php
class lib_functions_geomonthname{
	public static function month($m){
		$array = array(
			"01"=>"იანვარი", 
			"02"=>"თებერვალი", 
			"03"=>"მარტი", 
			"04"=>"აპრილი", 
			"05"=>"მაისი", 
			"06"=>"ივნისი", 
			"07"=>"ივლისი", 
			"08"=>"აგვისტო", 
			"09"=>"სექტემბერი", 
			"10"=>"ოქტომბერი", 
			"11"=>"ნოემბერი", 
			"12"=>"დეკემბერი" 
		);
		if($array[$m]){
			return $array[$m];
		}else{
			return "false";
		}
	}
}
?>