<?php
class lib_database_replay extends lib_database_connection{
	public function checkquestion($c,$qid){
		$conn = $this->conn($c); 
		$sql = 'SELECT `id` FROM `questions` WHERE `id`=:id AND `status`!=1';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":id"=>(int)$qid
		)); 
		if($prepare->rowCount() > 0){
			return true;
		}
		return false;
	}

	public function checkuserright($c,$qid){
		$conn = $this->conn($c); 
		$sql = 'SELECT `id` FROM `questions` WHERE `id`=:id AND `user_id`=:user_id AND `status`!=1';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":id"=>(int)$qid, 
			":user_id"=>$_SESSION[$c["session.prefix"]."id"]
		)); 
		if($prepare->rowCount() > 0){
			return true;
		}else if($_SESSION[$c["session.prefix"]."usertype"]=="administrator"){
			return true;
		}
		return false;
	}

	public function insert($c,$qid,$rep){
		$conn = $this->conn($c); 
		$time = time();
		$sql = 'INSERT INTO `question_answers` SET `ip`=:ip, `date`=:datex, `question_id`=:question_id, `user_id`=:user_id, `answer`=:answer';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":ip"=>$_SERVER["REMOTE_ADDR"], 
			":datex"=>$time, 
			":question_id"=>(int)$qid, 
			":user_id"=>$_SESSION[$c["session.prefix"]."id"], 
			":answer"=>$rep 
		)); 
		if($prepare->rowCount() > 0){
			$out['insertid'] = $conn->lastInsertId();
			$out['date']["day"] = date("d",$time);
			$out['date']["month"] = lib_functions_geomonthname::month(date("m",$time));
			$out['date']["year"] = date("Y",$time);
			$out['date']["time"] = date("H:i",$time);
			$out['namelname'] = $_SESSION[$c["session.prefix"]."namelname"];
			$out['answer'] = $rep;
			$answerfiel = 'answers_'.$qid.'.*';
			$removeFiles = array(
				$c["website.json"].$answerfiel, 
				$c["website.json"].'questions*.*', 
				$c["website.json"].'mylogs*.*' 
			);
			lib_functions_deletefiles::rem($removeFiles);


				
			$sql2 = 'INSERT INTO `activities` SET 
			`date`=:datex, 
			`question_id`=:question_id, 
			`text`=:textx, 
			`user_id`=:user_id, 
			`read`=:read';
			$prepare2 = $conn->prepare($sql2); 
			$prepare2->execute(array(
				":datex"=>time(), 
				":question_id"=>(int)$qid, 
				":textx"=>"დაემატა პასუხი", 
				":user_id"=>$_SESSION[$c["session.prefix"]."id"], 
				":read"=>"0"
			));
			return $out;
		}
	}
}
?>