<?php
class lib_database_tags extends lib_database_connection{
	public function all($c){
		$out = array();
		$json_file = $c["website.json"]."alltags.json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql = 'SELECT `tags` FROM `category_items` WHERE `status`!=:one ORDER BY `id` DESC LIMIT 10';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":one"=>1
			));
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "alltags.json", $json); 

		}else{
			$json = file_get_contents($json_file); 
		}
		return $json;
	}	
}
?>