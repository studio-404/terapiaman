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

	public function myfav($c,$s){		
		$session_id = $_SESSION[$c["session.prefix"]."id"]; 
		
		
		if(isset($s[2]) && is_numeric($s[2])){
			$limit = ($s[2]-1)*$c["per.page.myfavourites"].",".$c["per.page.myfavourites"]; 
			$the_file = "favourites_my".$session_id.$s[2].".json";
		}else{
			$limit = "0,".$c["per.page.myfavourites"];
			$the_file = "favourites_my".$session_id."0.json";
		}
		$json_file = $c["website.json"].$the_file;

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			`category_items`.`id`,
			`category_items`.`title`,
			`category_items`.`slug`, 
			(SELECT COUNT(`favourites`.`id`) FROM `favourites` WHERE  `favourites`.`user_id`=:user_id) AS favCounted 
			FROM 
			`favourites`, `category_items` 
			WHERE 
			`favourites`.`user_id`=:user_id AND 
			`favourites`.`item_id`=`category_items`.`id` AND 
			`category_items`.`status`!=1 ORDER BY `category_items`.`date` DESC LIMIT '.$limit; 
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
		$removeFiles = array(
			$c["website.json"].'favourites*.*', 
			$c["website.json"].'welcomeArticles*.*', 
			$c["website.json"].'allArticles*.*'
		);
		lib_functions_deletefiles::rem($removeFiles);
		return $out; 
	}

	public function remove($c, $session_id, $item_id){
		
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

		$removeFiles = array(
			$c["website.json"].'favourites*.*', 
			$c["website.json"].'welcomeArticles*.*', 
			$c["website.json"].'allArticles*.*'
		);
		lib_functions_deletefiles::rem($removeFiles);
		
		return $out; 
	}
}
?>