<?php
class lib_functions_createfile{
	public function create($c, $filename, $jsondata){
		$myfile = fopen($c["website.json"].$filename, "w"); 
		fwrite($myfile, $jsondata);
		fclose($myfile);
	}
}
?>