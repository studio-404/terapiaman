<?php
class lib_database_savefeed extends lib_database_connection{
	public function fb($c){
		$out["message"] = 'მოხდა შეცდომა !';
		$out["error"] = 'true';
		$name = lib_validate_request::method("POST","n"); 
		$subject = lib_validate_request::method("POST","s"); 
		$email = lib_validate_request::method("POST","e"); 
		$message = lib_validate_request::method("POST","m"); 
		if(empty($name) OR empty($subject) OR empty($email) OR empty($message)){
			$out["message"] = 'ყველა ველი სავალდებულოა !';
			$out["error"] = 'true';
		}else if(!lib_validate_email::val($email)){
			$out["message"] = 'გთხოვთ გადაამოწმოთ ელ-ფოსტის ფორმატი !';
			$out["error"] = 'true';
		}else{
			$conn = $this->conn($c); 
			$sql = 'INSERT INTO `feedbacks` SET `date`=:datex, `ip`=:ip, `name`=:name, `subject`=:subject, `email`=:email, `message`=:message';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":datex"=>time(), 
				":ip"=>$_SERVER["REMOTE_ADDR"], 
				":name"=>$name, 
				":subject"=>$subject, 
				":email"=>$email, 
				":message"=>$message 
			));
			if($prepare->rowCount() > 0){
				$out["message"] = 'მესიჯი წარმატებით გაეგზავნა ადმინისტრატორს !';
				$out["error"] = 'false';
			}
		}
		return $out;
	}
}
?>