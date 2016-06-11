<?php
class lib_modules_statia{
	public function stat($c,$s){
		$lib_database_selectstatia = new lib_database_selectstatia(); 
		$out = json_decode($lib_database_selectstatia->select($c, $s),true); 	

        return $out;
	}
}
?>