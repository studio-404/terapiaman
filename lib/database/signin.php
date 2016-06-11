<?php
class lib_database_signin extends lib_database_connection{
	public function trysign($c){
		$conn = $this->conn($c); 
		$email = lib_validate_request::method("POST","e"); 
		$password = lib_validate_request::method("POST","p");
		$sql = 'SELECT `id`,`email`,`usertype`,`namelname` FROM `users` WHERE `email`=:email AND `password`=:password AND `status`!=:one';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":email"=>$email, 
			":password"=>sha1($password), 
			":one"=>1
		));
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
			$_SESSION[$c["session.prefix"]."id"] = $fetch["id"]; 
			$_SESSION[$c["session.prefix"]."email"] = $fetch["email"]; 
			$_SESSION[$c["session.prefix"]."namelname"] = $fetch["namelname"]; 
			$_SESSION[$c["session.prefix"]."usertype"] = $fetch["usertype"]; 
			echo "true";
		}else{
			echo "მომხმარებლის ელ-ფოსტა ან პაროლი არასწორია ! <br /><br /><a href=\"\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\">ავტორიზაცია</a>";
		}
	}

	public function selectUserInfo($c, $userEmailId){
		$conn = $this->conn($c);
		$sql = 'SELECT `id`,`email`,`usertype`,`namelname` FROM `users` WHERE `email`=:email AND `status`!=:one';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":email"=>$userEmailId, 
			":one"=>1
		));
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
			$_SESSION[$c["session.prefix"]."id"] = $fetch["id"]; 
			$_SESSION[$c["session.prefix"]."email"] = $fetch["email"]; 
			$_SESSION[$c["session.prefix"]."namelname"] = $fetch["namelname"]; 
			$_SESSION[$c["session.prefix"]."usertype"] = $fetch["usertype"]; 
			return true;
		}
		return false;
	}

	public function checkUserByEmail($c, $email){
		$conn = $this->conn($c); 
		$sql = 'SELECT `id` FROM `users` WHERE `email`=:email AND `status`!=:one';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":email"=>$email, 
			":one"=>1
		));
		if($prepare->rowCount() > 0){
			return true;
		}
		return false;
	}

	public function updateRecoverAndGenerate($c, $email){
		$conn = $this->conn($c); 
		$sql = 'UPDATE `users` SET `recover`=:recover WHERE `email`=:email AND `status`!=1';
		$random = lib_functions_generate::random(11);
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":recover"=>$random, 
			":email"=>$email 
		));
		if($prepare->rowCount() > 0){
			$get_url = $c["website.base"].'template/_plugin/email/index.php?title=პაროლის%20აღდგენა&text=0&link=www.terapia.ge/პაროლის-აღდგენა/?recover='.$random;
			$message = file_get_contents($get_url);
			
			$lib_functions_sendemail = new lib_functions_sendemail(); 			
			if($lib_functions_sendemail->init($c, $email, 'Terapia.ge » პაროლის აღდგენა', $message)){
				return true;
			} 
		}
		return false;
	}
}
?>