<?php
class lib_database_addstatia extends lib_database_connection{
	public function add($c){
		$out["error"] = "true";
		$out["message"] = "მოხდა შეცდომა !";
		$out["url"] = "false";
		$date = strtotime(urldecode(lib_validate_request::method("POST","d")));
		$category = lib_validate_request::method("POST","ca");
		$title = urldecode(lib_validate_request::method("POST","t"));
		$metatitle = urldecode(lib_validate_request::method("POST","mt"));
		$metadescription = urldecode(lib_validate_request::method("POST","md"));
		$shortdescription = urldecode(lib_validate_request::method("POST","sd"));
		$text = urldecode(lib_validate_request::method("POST","te"));
		$tags = urldecode(lib_validate_request::method("POST","ta"));
		if(!isset($_SESSION[$c["session.prefix"]."id"]) OR !is_numeric($_SESSION[$c["session.prefix"]."id"])){
			$out["error"] = "true";
			$out["message"] = "გთხოვთ გაიაროთ ავტორიზაცია !";
		}else if(empty($date) OR empty($category) OR empty($title) OR empty($metatitle) OR empty($metadescription) OR empty($shortdescription) OR empty($text) OR empty($tags)){
			$out["error"] = "true";
			$out["message"] = "ყველა ველი სავალდებულოა !";
		}else if(!is_numeric($category)){
			$out["error"] = "true";
			$out["message"] = "გთხოვთ აირჩიოთ კატეგორია !";
		}else{
			$conn = $this->conn($c);
			$slug = str_replace(" ", "-", strip_tags($title));
			$sql = 'INSERT INTO `category_items` SET 
			`date`=:datex, 
			`title`=:title, 
			`short_text`=:short_text, 
			`long_text`=:long_text, 
			`cat_id`=:cat_id, 
			`meta_title`=:meta_title, 
			`meta_desc`=:meta_desc, 
			`slug`=:slug, 
			`tags`=:tags, 
			`auth_id`=:auth_id 
			';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":datex"=>$date, 
				":title"=>$title, 
				":short_text"=>$shortdescription, 
				":long_text"=>$text, 
				":cat_id"=>(int)$category, 
				":meta_title"=>$metatitle, 
				":meta_desc"=>$metadescription,
				":tags"=>$tags,
				":slug"=>$slug,
				":auth_id"=>(int)$_SESSION[$c["session.prefix"]."id"]
			));
			if($prepare->rowCount() > 0){
				$removeFiles = array(
					$c["website.json"].'allArticles*.*',
					$c["website.json"].'mystatia*.*',
					$c["website.json"].'categories*.*',
					$c["website.json"].'welcomeArticles.*', 
					$c["website.json"].'alltags.*' 
				);
				lib_functions_deletefiles::rem($removeFiles);

				$insertId = $conn->lastInsertId();
				$out["error"] = "false";
				$out["message"] = "სტატია წარმატებით დაემატა !";
				$out["url"] = $c['website.base']."ჩემი-სტატიები/რედაქტირება/".$insertId;
			}

		}
		return $out;
	}
}
?>