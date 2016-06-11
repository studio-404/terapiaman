<?php
class lib_lancher_bootstrap{
	function __construct(){

	}

	public function lanch($c){
		$slug = lib_functions_geturl::slugs($c); 	
		
		$lib_lancher_template = new lib_lancher_template(); 
		$lib_lancher_template->loads($c, $slug); 
	}

}
?>