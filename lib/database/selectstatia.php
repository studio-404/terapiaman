<?php
class lib_database_selectstatia extends lib_database_connection{
	public function select($c, $s){
		$json_file = $c["website.json"]."statia".$s[1].".json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT *	FROM `category_items` WHERE `status`!=1 AND `id`=:id'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":id"=>(int)$s[1] 
			)); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				lib_functions_redirect::url($c["website.base"]."გვერდი-404");
			}
			$json = json_encode($fetch); 
			$lib_functions_createfile = new lib_functions_createfile(); 
			$lib_functions_createfile->create($c, "statia".$s[1].".json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json; 
	}
}
?>