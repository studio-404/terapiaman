<?php
class lib_database_selectstatia extends lib_database_connection{
	public function select($c, $s){
		$json_file = $c["website.json"]."statia".$s[1].".json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT *,
			(SELECT `users`.`namelname` FROM `users` WHERE `users`.`id`=`category_items`.`auth_id`) AS auther 
			FROM `category_items` WHERE `status`!=1 AND `id`=:id'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":id"=>(int)$s[1] 
			)); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				lib_functions_redirect::url($c["website.base"]);
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "statia".$s[1].".json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

	public function select_one($c, $s){
		$json_file = $c["website.json"]."statiaone".$s[2].".json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT *	FROM `category_items` WHERE `status`!=1 AND `id`=:id'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":id"=>(int)$s[2] 
			)); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetch(PDO::FETCH_ASSOC);  
			}else{
				lib_functions_redirect::url($c["website.base"]);
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "statiaone".$s[2].".json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}

	public function mystats($c){
		$session_id = $_SESSION[$c["session.prefix"]."id"];
		$pn = lib_validate_request::method("GET","pn");
		if(isset($pn) && is_numeric($pn)){
			$limit = ($pn-1)*$c["per.page.mystats"].",".$c["per.page.mystats"]; 
			$the_file = "mystatia".$session_id.$pn.".json";
		}else{
			$limit = "0,".$c["per.page.mystats"];
			$the_file = "mystatia".$session_id."0.json";
		}
		$json_file = $c["website.json"].$the_file;

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT *, 
			(SELECT COUNT(`category_items`.`id`) FROM `category_items` WHERE `category_items`.`status`!=1 AND `category_items`.`auth_id`=:auth_id) AS statCounted 
			FROM 
			`category_items` 
			WHERE 
			`category_items`.`status`!=1 AND 
			`category_items`.`auth_id`=:auth_id 
			ORDER BY `category_items`.`date` DESC LIMIT '.$limit; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":auth_id"=>(int)$session_id 
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
}
?>