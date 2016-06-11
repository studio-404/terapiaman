<?php 
class lib_database_slider extends lib_database_connection{
	public function select($c){
		$json_file = $c["website.json"]."slider.json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT `id`,`title`,`text`,`url`,`pic` FROM `slider` WHERE `status`!=1 ORDER BY `position` ASC'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "slider.json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

	public function select_image($c,$id){
		$image = "";
		$json_file = $c["website.json"]."slider.json"; 

		if(file_exists($json_file)){
			$fget = file_get_contents($json_file);
			$json = json_decode($fget, true); 
			foreach ($json as $v) {
				if($v['id']==$id){
					$image = $v['pic'];
					break;
				}
			}
		}
		return $image;
	}
}
?>