<?php
class lib_database_addquestion extends lib_database_connection{
	public function insert($c, $q, $an){
		$strlen = mb_strlen($q, 'UTF-8');
	
		if($strlen <= $c["post.max.length"]){
			$conn = $this->conn($c); 
			$session_id = $_SESSION[$c["session.prefix"]."id"]; 
			$sql = 'INSERT INTO `questions` SET `date`=:datex, `ip`=:ip, `user_id`=:user_id, `question`=:question, `anonimus`=:anonimus';
			$prepare = $conn->prepare($sql); 
			$d = time();
			$prepare->execute(array(
				":datex"=>$d, 
				":ip"=>$_SERVER["REMOTE_ADDR"], 
				":user_id"=>$session_id, 
				":question"=>$q, 
				":anonimus"=>$an 
			));
			if($prepare->rowCount() > 0){
				$removeFiles = array(
					$c["website.json"].'questions*.*',
					$c["website.json"].'myquestions*.*', 
					$c["website.json"].'mylogs*.*' 
				);
				lib_functions_deletefiles::rem($removeFiles);
				$insertId = $conn->lastInsertId(); 
				
				$sql2 = 'INSERT INTO `activities` SET 
				`date`=:datex, 
				`question_id`=:question_id, 
				`text`=:textx, 
				`user_id`=:user_id, 
				`read`=:read';
				$prepare2 = $conn->prepare($sql2); 
				$prepare2->execute(array(
					":datex"=>time(), 
					":question_id"=>$insertId, 
					":textx"=>"დაემატა კითხვა", 
					":user_id"=>$session_id, 
					":read"=>"0"
				));


				return true;
			}
		}
		return false;
	}
}
?>