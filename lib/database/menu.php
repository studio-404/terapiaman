<?php
class lib_database_menu extends lib_database_connection{

	public function selectNavigation($c){
		$json_file = $c["website.json"]."selectNavigation.json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT `title`,`slug`,`type` FROM `menu` WHERE `status`!=1 AND `visibility`!=1 ORDER BY `position` ASC'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "selectNavigation.json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

}
?>