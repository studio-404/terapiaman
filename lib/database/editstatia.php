<?php 
class lib_database_editstatia extends lib_database_connection{
	public function edit($c){
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
		$stid = lib_validate_request::method("POST","stid");
		if(!isset($_SESSION[$c["session.prefix"]."id"]) OR !is_numeric($_SESSION[$c["session.prefix"]."id"])){
			$out["error"] = "true";
			$out["message"] = "გთხოვთ გაიაროთ ავტორიზაცია !";
		}else if(empty($date) OR empty($category) OR empty($title) OR empty($metatitle) OR empty($metadescription) OR empty($shortdescription) OR empty($text) OR empty($tags) OR empty($stid)){
			$out["error"] = "true";
			$out["message"] = "ყველა ველი სავალდებულოა !";
		}else if(!is_numeric($stid)){
			$out["error"] = "true";
			$out["message"] = "სტატიის იდენთიფიკაცია ვერ მოხერხდა !";
		}else if(!is_numeric($category)){
			$out["error"] = "true";
			$out["message"] = "გთხოვთ აირჩიოთ კატეგორია !";
		}else{
			$conn = $this->conn($c);
			$slug = str_replace(" ", "-", strip_tags($title));
			$sql = 'UPDATE `category_items` SET 
			`date`=:datex, 
			`title`=:title, 
			`short_text`=:short_text, 
			`long_text`=:long_text, 
			`cat_id`=:cat_id, 
			`meta_title`=:meta_title, 
			`meta_desc`=:meta_desc, 
			`slug`=:slug, 
			`tags`=:tags 
			WHERE 
			`id`=:statia_id
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
				":statia_id"=>$stid
			));
			if($prepare->rowCount() > 0){
				$removeFiles = array(
					$c["website.json"].'allArticles*.*',
					$c["website.json"].'mystatia*.*',
					$c["website.json"].'welcomeArticles.*', 
					$c["website.json"].'statia*.*', 
					$c["website.json"].'alltags.*' 
				);
				lib_functions_deletefiles::rem($removeFiles);
				$out["error"] = "false";
				$out["message"] = "სტატია წარმატებით განახლდა !";
			}

		}
		return $out;
	}
}
?>