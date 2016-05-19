<?php
class lib_database_pagedata extends lib_database_connection{
	public function data($c,$slug){
		$u = lib_functions_geotoeng::trans($slug[0]);
		$conn = $this->conn($c); 
		if($u=="statia" && is_numeric($slug[1])){
			$json_file = $c["website.json"]."pagedata_".$u.$slug[1].".json"; 
			if(!file_exists($json_file)){
				$sql ='SELECT `title`, `meta_title`, `meta_desc` AS meta_description, `long_text` AS text  FROM `category_items` WHERE `id`=:id AND `status`!=1'; 
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":id"=>$slug[1] 
				)); 
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetch(PDO::FETCH_ASSOC);  
				}else{
					//lib_functions_redirect::url($c["website.base"]."გვერდი-404");
				}
				$json = json_encode($fetch); 
				$lib_functions_createfile = new lib_functions_createfile(); 
				$lib_functions_createfile->create($c, "pagedata_".$u.$slug[1].".json", $json); 
			}else{
				$json = file_get_contents($json_file);
			}
		}else{
			$json_file = $c["website.json"]."pagedata_".$u.".json"; 
			if(!file_exists($json_file)){
				$sql ='SELECT * FROM `menu` WHERE `slug`=:slug AND `status`!=1'; 
				$prepare = $conn->prepare($sql); 
				$prepare->execute(array(
					":slug"=>urldecode($slug[0])
				)); 
				if($prepare->rowCount() > 0){
					$fetch = $prepare->fetch(PDO::FETCH_ASSOC);  
				}else{
					//lib_functions_redirect::url($c["website.base"]."გვერდი-404");
				}
				$json = json_encode($fetch); 
				$lib_functions_createfile = new lib_functions_createfile(); 
				$lib_functions_createfile->create($c, "pagedata_".$u.".json", $json); 
			}else{
				$json = file_get_contents($json_file); 
			}
		}
		return $json;
	}
}
?>