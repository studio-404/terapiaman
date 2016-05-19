<?php
class lib_database_addquestion extends lib_database_connection{
	public function insert($c, $q){
		$strlen = mb_strlen($q, 'UTF-8');
	
		if($strlen <= 800){
			$conn = $this->conn($c); 
			$session_id = $_SESSION[$c["session.prefix"]."id"]; 
			$sql = 'INSERT INTO `questions` SET `date`=:datex, `ip`=:ip, `user_id`=:user_id, `question`=:question';
			$prepare = $conn->prepare($sql); 
			$d = time();
			$prepare->execute(array(
				":datex"=>$d, 
				":ip"=>$_SERVER["REMOTE_ADDR"], 
				":user_id"=>$session_id, 
				":question"=>$q
			));
			if($prepare->rowCount() > 0){
				//@unlink($c["website.json"]."questions*.*");
				$mask = $c["website.json"]."questions*.*";
				array_map('unlink', glob($mask));
				return true;
			}
		}
		return false;
	}
}
?>