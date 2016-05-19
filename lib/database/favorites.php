<?php
class lib_database_favorites extends lib_database_connection{
	public function select($c, $session_id){		
		$the_file = "favourites_".$session_id.".json";
		$json_file = $c["website.json"].$the_file; 

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT `item_id` FROM `favourites` WHERE `user_id`=:user_id'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":user_id"=>$session_id
			)); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}

			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, $the_file, $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

	public function add($c, $session_id, $item_id){
		$the_file = "favourites_".$session_id.".json";
		$json_file = $c["website.json"].$the_file;
		$json_file2 = $c["website.json"]."welcomeArticles.json";
		$json_file3 = $c["website.json"]."allArticles.json";

		$conn = $this->conn($c); 
		$check = 'SELECT `id` FROM `favourites` WHERE `item_id`=:item_id AND `user_id`=:user_id'; 
		$pre = $conn->prepare($check); 
		$pre->execute(array(
			":item_id"=>$item_id, 
			":user_id"=>$session_id 
		));
		if($pre->rowCount() <= 0){
			$sql = 'INSERT INTO `favourites` SET `ip`=:ip, `item_id`=:item_id, `user_id`=:user_id'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":ip"=>$_SERVER["REMOTE_ADDR"], 
				":item_id"=>$item_id, 
				":user_id"=>$session_id  
			)); 
			if($prepare->rowCount() > 0){
				$out = "სტატია წარმატებით დაემატა ფავორიტებში !";
			}else{
				$out = "დამატებისას მოხდა შეცდომა !";
			}
		}else{
			$out = "სტატია უკვე დამატებულია ფავორიტებში !";
		}
		if(file_exists($json_file)){ unlink($json_file); }
		if(file_exists($json_file2)){ unlink($json_file2); }
		if(file_exists($json_file3)){ unlink($json_file3); }
		return $out; 
	}

	public function remove($c, $session_id, $item_id){
		$the_file = "favourites_".$session_id.".json";
		$json_file = $c["website.json"].$the_file;
		$json_file2 = $c["website.json"]."welcomeArticles.json";
		$json_file3 = $c["website.json"]."allArticles.json";

		$conn = $this->conn($c); 
		$sql = 'DELETE FROM `favourites` WHERE `item_id`=:item_id AND `user_id`=:user_id'; 
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":item_id"=>$item_id, 
			":user_id"=>$session_id  
		)); 
		if($prepare->rowCount() > 0){
			$out = "სტატია წარმატებით წაიშალა ფავორიტებიდან !";
		}else{
			$out = "წაშლისას მოხდა შეცდომა !";
		}
		if(file_exists($json_file)){ unlink($json_file); }
		if(file_exists($json_file2)){ unlink($json_file2); }
		if(file_exists($json_file3)){ unlink($json_file3); }
		
		return $out; 
	}
}
?>