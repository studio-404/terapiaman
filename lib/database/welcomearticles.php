<?php
class lib_database_welcomearticles extends lib_database_connection{
	public function articles($c){
		$json_file = $c["website.json"]."welcomeArticles.json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			`category_items`.`id` AS ci_id, 
			`category_items`.`date` AS ci_date, 
			`category_items`.`title` AS ci_title, 
			`category_items`.`short_text` AS ci_short_text, 
			`category_items`.`long_text` AS ci_long_text, 
			`category_items`.`slug` AS ci_slug, 
			`category_items`.`tags` AS ci_tags, 
			`category_items`.`view` AS ci_view, 
			(SELECT COUNT(`favourites`.`id`) FROM `favourites` WHERE `favourites`.`item_id`=`category_items`.`id`) AS ci_favourites, 
			(SELECT `categories`.`id` FROM `categories` WHERE `category_items`.`cat_id`=`categories`.`id`) AS c_id, 
			(SELECT `categories`.`title` FROM `categories` WHERE `category_items`.`cat_id`=`categories`.`id`) AS c_title, 
			(SELECT `categories`.`slug` FROM `categories` WHERE `category_items`.`cat_id`=`categories`.`id`) AS c_slug, 
			(SELECT `users`.`namelname` FROM `users` WHERE `category_items`.`auth_id`=`users`.`id`) AS u_name  
			FROM 
			`category_items` 
			WHERE 
			`category_items`.`status`!=1 
			ORDER BY `category_items`.`date` DESC LIMIT 3'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "welcomeArticles.json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}
}
?>