<?php
class lib_database_myquestions extends lib_database_connection{
	public function select($c){
		$session_id = $_SESSION[$c["session.prefix"]."id"]; 
		$pn = (lib_validate_request::method("GET","pn")>0) ? (lib_validate_request::method("GET","pn")-1) : 0;
		$the_file = "myquestions_".$pn.$session_id.".json";
		$json_file = $c["website.json"].$the_file; 

		$perpage = $c["per.page.myquestions"]; 
		$from = $pn * $perpage; 

		$limit = 'LIMIT '.$from.','.$perpage;

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			`id`,
			`question`, 
			(SELECT COUNT(`questions`.`id`) FROM `questions` WHERE `questions`.`user_id`=:user_id AND `questions`.`status`!=1) AS countall 
			FROM 
			`questions` 
			WHERE 
			`user_id`=:user_id AND 
			`status`!=1 
			ORDER BY `date` DESC '.$limit; 
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
}
?>