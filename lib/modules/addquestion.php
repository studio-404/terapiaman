<?php
class lib_modules_addquestion{
	public function addqu($c,$q){
		$lib_database_addquestion = new lib_database_addquestion(); 
		$insert = $lib_database_addquestion->insert($c, $q);
		if($insert){
			echo 1; 
		}else{
			echo "კითხვის დამატებისას მოხდა შეცდომა !";
		}
	}
}
?>