<?php
class lib_database_userdata extends lib_database_connection{
	public function select($c){
		$session_id = $_SESSION[$c["session.prefix"]."id"];
		$the_file = "userdata".$session_id.".json";
		$json_file = $c["website.json"].$the_file; 

		if(!file_exists($json_file)){
			$conn = $this->conn($c); 
			$sql ='SELECT * FROM `users` WHERE `id`=:user_id'; 
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":user_id"=>$session_id
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

	public function update($c){
		$out["error"] = "true";
		$out["message"] = "მოხდა შეცდომა !";
		$name = urldecode(lib_validate_request::method("POST","n"));
		$phone = strip_tags(lib_validate_request::method("POST","p"));
		$email = lib_validate_request::method("POST","e");
		if(empty($name)){
			$out["message"] = "სახელი გვარის ველი სავალდებულოა !";
		}else if(!isset($_SESSION[$c["session.prefix"]."id"])){
			$out["message"] = "გთხოვთ გაიარეთ ავტორიზაცია !";
		}else if(!empty($email) && !lib_validate_email::val($email)){
			$out["message"] = "გთხოვთ გადაამოწმოთ ელ-ფოსტის ველი !";
		}else{
			$conn = $this->conn($c);
			$sql ='UPDATE `users` SET `namelname`=:name, `contactphone`=:phone, `contactemail`=:email WHERE `id`=:user_id'; 	
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":name"=>$name, 
				":phone"=>$phone, 
				":email"=>$email, 
				":user_id"=>$_SESSION[$c["session.prefix"]."id"]
			));
			if($prepare->rowCount() > 0){
				$_SESSION[$c["session.prefix"]."namelname"] = $name;
				$removeFiles = array(
					$c["website.json"].'userdata*.*'
				);
				lib_functions_deletefiles::rem($removeFiles);
				$out["error"] = "false";
				$out["message"] = "მონაცემები წარმატებით განახლდა !";
			}else{
				$out["message"] = "განახლებისას მოხდა შეცდომა !";
			}
		}
		return $out;
	}
}
?>