<?php
class lib_database_mylogs extends lib_database_connection{
	public function select($c){
		$session_id = $_SESSION[$c["session.prefix"]."id"]; 
		$pn = (lib_validate_request::method("GET","pn")>0) ? (lib_validate_request::method("GET","pn")-1) : 0;
		$the_file = "mylogs_".$pn.$session_id.".json";
		$json_file = $c["website.json"].$the_file; 

		$perpage = $c["per.page.logs"]; 
		$from = $pn * $perpage; 

		$limit = 'LIMIT '.$from.','.$perpage;

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			*, 
			(SELECT COUNT(`activities`.`id`) FROM `activities` WHERE `activities`.`status`!=:one) AS countall, 
			(SELECT `users`.`namelname` FROM `users` WHERE `users`.`id`=`activities`.`user_id`) AS usersname  
			FROM 
			`activities` 
			WHERE 
			`status`!=:one 
			ORDER BY `date` DESC '.$limit; 
			
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":one"=>1 
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