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
			`questions`.`anonimus`, 
			(SELECT `users`.`namelname` FROM `users` WHERE `users`.`id`=`questions`.`user_id`) AS usersName 
			FROM 
			`questions` 
			WHERE 
			`questions`.`id`=:qid AND 
			`questions`.`status`!=1'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":qid"=>$qid
			)); 
			if($prepare->rowCount() > 0){
				$fetch = $prepare->fetch(PDO::FETCH_ASSOC);  
			}else{
				lib_functions_redirect::url($c['website.base']); 
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
			`question_answers`.`id`, 
			`question_answers`.`date`, 
			`question_answers`.`answer`, 
			`question_answers`.`user_id`, 
			(SELECT `users`.`namelname` FROM `users` WHERE `users`.`id`=`question_answers`.`user_id`) AS usersName,
			(SELECT `users`.`usertype` FROM `users` WHERE `users`.`id`=`question_answers`.`user_id`) AS userType,
			(SELECT `questions`.`anonimus` FROM `questions` WHERE `questions`.`id`=`question_answers`.`question_id`) AS anonimus 
			FROM 
			`question_answers` 
			WHERE 
			`question_answers`.`question_id`=:qid AND 
			`question_answers`.`status`!=1 ORDER BY `question_answers`.`date` DESC 
			'; 
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
		$search_detected = ''; 
		$perpage = $c["per.page.questions"];
		$currentpage = (int)lib_functions_geturl::num($c,2); 
		if($currentpage<=1){
			$currentpage = 0;
		}else{
			$currentpage = ($currentpage-1) * $perpage; 
		}
		$search = (lib_validate_request::method("GET","search")) ? urldecode(lib_validate_request::method("GET","search")) : '';
		$s = str_replace(" ", "", lib_functions_geotoeng::trans($search));

		if(!empty($search) && strlen($search) > 3){
			$string = preg_replace('/[^\p{L}\p{N}\s]/u', '', $search); 
			$search_detected = ' AND (
			`questions`.`question` LIKE "%'.$string.'" OR 
			`questions`.`question` LIKE "'.$string.'%" OR 
			`questions`.`question` LIKE "%'.$string.'%" )';
		}
		
		$json_file = $c["website.json"]."questions".$currentpage.$s.".json"; 
		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT 
			(SELECT COUNT(`id`) FROM `questions` WHERE `status`!=:one) AS countall, 
			`questions`.`id` AS q_id, 
			`questions`.`date` AS q_date, 
			`questions`.`question` AS q_question, 
			`questions`.`anonimus` AS q_anonimus, 
			`users`.`namelname` AS u_namelname, 
			(SELECT COUNT(`question_answers`.`id`) FROM `question_answers` WHERE `question_answers`.`question_id`=`questions`.`id` AND `question_answers`.`status`!=1) AS answer_counts 
			FROM 
			`questions`, `users` 
			WHERE 
			`questions`.`user_id`=`users`.`id` AND 
			`questions`.`status`!=:one '.$search_detected.'
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
			$lib_functions_createfile->create($c, "questions".$currentpage.$s.".json", $json); 
		}else{
			$json = file_get_contents($json_file); 
		}
		return $json;
	}

	public function removeQuestion($c, $qid){
		if(isset($_SESSION[$c["session.prefix"]."id"])){
			$conn = $this->conn($c); 
			$sql = 'SELECT `id` FROM `questions` WHERE `id`=:id AND `user_id`=:user_id';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":id"=>$qid, 
				":user_id"=>$_SESSION[$c["session.prefix"]."id"]
			));
			if($prepare->rowCount() > 0 || $_SESSION[$c["session.prefix"]."usertype"]=="administrator"){
				$update = 'UPDATE `questions` SET `status`=1 WHERE `id`=:id';
				$prepare2 = $conn->prepare($update); 
				$prepare2->execute(array(
					":id"=>(int)$qid
				));
				if($prepare2->rowCount() > 0){
					$answerfiel = 'answers_'.$qid.'.*';
					$removeFiles = array(
						$c["website.json"].$answerfiel, 
						$c["website.json"].'questions*.*', 
					);
					lib_functions_deletefiles::rem($removeFiles);
					return true;
				}
			}
		}
		return false;
	}

	public function removeAnswer($c, $a){
		if(isset($_SESSION[$c["session.prefix"]."id"])){
			$conn = $this->conn($c); 
			$sql = 'SELECT `id` FROM `question_answers` WHERE `id`=:id AND `user_id`=:user_id';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":id"=>(int)$a, 
				":user_id"=>$_SESSION[$c["session.prefix"]."id"]
			));
			
			if($prepare->rowCount() > 0 || $_SESSION[$c["session.prefix"]."usertype"]=="administrator"){
				$update = 'UPDATE `question_answers` SET `status`=1 WHERE `id`=:id';
				$prepare2 = $conn->prepare($update); 
				$prepare2->execute(array(
					":id"=>(int)$a
				));
				if($prepare2->rowCount() > 0){
					$answerfiel = 'answers_*.*';
					$removeFiles = array(
						$c["website.json"].$answerfiel, 
						$c["website.json"].'questions*.*', 
					);
					lib_functions_deletefiles::rem($removeFiles);
					return true;
				}
			}
		}
		return false;
	}
}
?>