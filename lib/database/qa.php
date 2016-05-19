<?php
class lib_database_qa extends lib_database_connection{
	public function select_one($c, $qid){
		$the_file = "qustion_".$qid.".json";
		$json_file = $c["website.json"].$the_file; 

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			`questions`.`date`, 
			`questions`.`question`, 
			(SELECT `users`.`namelname` FROM `users` WHERE `users`.`id`=`questions`.`user_id`) AS usersName 
			FROM 
			`questions` 
			WHERE 
			`questions`.`id`=:qid'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":qid"=>$qid
			)); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetch(PDO::FETCH_ASSOC);  
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

	public function select_answers($c, $qid){
		$the_file = "answers_".$qid.".json";
		$json_file = $c["website.json"].$the_file; 

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			`question_answers`.`date`, 
			`question_answers`.`answer`, 
			(SELECT `users`.`namelname` FROM `users` WHERE `users`.`id`=`question_answers`.`user_id`) AS usersName 
			FROM 
			`question_answers` 
			WHERE 
			`question_answers`.`question_id`=:qid'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":qid"=>$qid
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

	public function questions($c){
		$perpage = $c["per.page.questions"];
		$currentpage = (int)lib_functions_geturl::num($c,2); 
		if($currentpage<=1){
			$currentpage = 0;
		}else{
			$currentpage = ($currentpage-1) * $perpage; 
		}
		
		$json_file = $c["website.json"]."questions".$currentpage.".json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			(SELECT COUNT(`id`) FROM `questions` WHERE `status`!=:one) AS countall, 
			`questions`.`id` AS q_id, 
			`questions`.`date` AS q_date, 
			`questions`.`question` AS q_question, 
			`users`.`namelname` AS u_namelname, 
			(SELECT COUNT(`question_answers`.`id`) FROM `question_answers` WHERE `question_answers`.`question_id`=`questions`.`id`) AS answer_counts 
			FROM 
			`questions`, `users` 
			WHERE 
			`questions`.`user_id`=`users`.`id` AND 
			`questions`.`status`!=:one 
			ORDER BY `questions`.`date` DESC LIMIT '.$currentpage.','.$perpage.' 
			'; 
			// echo $sql;
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
			$lib_functions_createfile->create($c, "questions".$currentpage.".json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json;
	}
}
?>