<?php
class lib_database_allarticles extends lib_database_connection{
	public function articles($c, $s){
		$category_id = '';
		$tags_detected = ''; 
		$search_detected = ''; 
		$pn = (lib_validate_request::method("GET","pn")>0) ? (lib_validate_request::method("GET","pn")-1) : 0;
		$search = (lib_validate_request::method("GET","search")) ? urldecode(lib_validate_request::method("GET","search")) : '';
		$sx = str_replace(" ", "", lib_functions_geotoeng::trans($search));
		
		$addfilename = '_pn_'.$pn.$sx;
		$perpage = $c["per.page.questions"]; 
		$from = $pn * $perpage; 

		$limit = 'LIMIT '.$from.','.$perpage;
		
		if(!empty($s[1]) && is_numeric($s[1])){// კატეგორია არჩეულია
			$category_id = ' AND `category_items`.`cat_id`="'.(int)$s[1].'" ';
			$addfilename .= '_'.$s[1];
		}else if(lib_validate_request::method("GET","tags")){// ტეგით ძებნა 
			$tags = urldecode(lib_validate_request::method("GET","tags")); 
			$string = str_replace(" ", "", preg_replace('/[^\p{L}\p{N}\s]/u', '', $tags)); 
			$addfilename .= str_replace(" ", "", lib_functions_geotoeng::trans($string));
			$tags_detected = ' AND FIND_IN_SET("'.$string.'", REPLACE(`category_items`.`tags`, " ", "")) ';
		}else if(!empty($search) && strlen($search) > 3){
			$string = preg_replace('/[^\p{L}\p{N}\s]/u', '', $search); 
			$search_detected = ' AND (
			`category_items`.`title` LIKE "%'.$string.'" OR 
			`category_items`.`title` LIKE "'.$string.'%" OR 
			`category_items`.`title` LIKE "%'.$string.'%" OR 
			`category_items`.`short_text` LIKE "%'.$string.'" OR 
			`category_items`.`short_text` LIKE "'.$string.'%" OR 
			`category_items`.`short_text` LIKE "%'.$string.'%" OR 
			`category_items`.`long_text` LIKE "%'.$string.'" OR 
			`category_items`.`long_text` LIKE "'.$string.'%" OR 
			`category_items`.`long_text` LIKE "%'.$string.'%" )';
		}else{// ყველა სტატია
			//echo "Empty Detected";
		}
		$json_file = $c["website.json"]."allArticles".$addfilename.".json"; 
	 
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
			`category_items`.`status`!=1 '.$category_id.$tags_detected.$search_detected.'
			ORDER BY `category_items`.`date` DESC '.$limit; 
			
			$prepare = $conn->prepare($sql); 
			$prepare->execute(); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "allArticles".$addfilename.".json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

	public function allArticlesRss($c){
		$json_file = $c["website.json"]."allArticlesRSS.json"; 
	 
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
			(SELECT `categories`.`id` FROM `categories` WHERE `category_items`.`cat_id`=`categories`.`id`) AS c_id, 
			(SELECT `categories`.`title` FROM `categories` WHERE `category_items`.`cat_id`=`categories`.`id`) AS c_title, 
			(SELECT `users`.`namelname` FROM `users` WHERE `category_items`.`auth_id`=`users`.`id`) AS u_name  
			FROM 
			`category_items` 
			WHERE 
			`category_items`.`status`!=1 
			ORDER BY `category_items`.`date` DESC '; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				$fetch = array(); 
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "allArticlesRSS.json", $json);
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

	public function countArticles($c, $slug){
		$category_id = '';
		$tags_detected = '';
		if(is_numeric($slug[1])){// კატეგორია არჩეულია
			$category_id = ' AND `cat_id`="'.(int)$slug[1].'" ';
		}else if(lib_validate_request::method("GET","tags")){
			$tags = urldecode(lib_validate_request::method("GET","tags")); 
			$string = str_replace(" ", "",preg_replace('/[^\p{L}\p{N}\s]/u', '', $tags)); 
			$tags_detected = ' AND FIND_IN_SET("'.$string.'", REPLACE(`tags`, " ", "")) ';
		}
		$conn = $this->conn($c); 
		$counted = 0;
		$sql ='SELECT COUNT(`id`) AS counted FROM `category_items` WHERE `status`!=1'.$category_id.$tags_detected; 
		$prepare = $conn->prepare($sql); 
		$prepare->execute(); 
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
			$counted = $fetch['counted'];  
		}
		return $counted; 
	}
}
?>