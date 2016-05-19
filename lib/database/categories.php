<?php
class lib_database_categories extends lib_database_connection{
	public function select($c){
		$json_file = $c["website.json"]."categories.json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			`categories`.`id`, 
			`categories`.`title`, 
			`categories`.`slug`, 
			`categories`.`icon`,
			(SELECT COUNT(`category_items`.`id`) FROM `category_items` WHERE `category_items`.`cat_id`=`categories`.`id` AND `category_items`.`status`!=1) AS count  
			FROM 
			`categories` 
			WHERE 
			`categories`.`status`!=1 
			ORDER BY `categories`.`position` ASC'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "categories.json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

	public function select_image($c,$id){
		$image = "";
		$json_file = $c["website.json"]."categories.json"; 

		if(file_exists($json_file)){
			$fget = file_get_contents($json_file);
			$json = json_decode($fget, true); 
			foreach ($json as $v) {
				if($v['id']==$id){
					$image = $v['icon'];
					break;
				}
			}
		}
		return $image;
	}
}
?>