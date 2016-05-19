<?php
class lib_database_signin extends lib_database_connection{
	public function trysign($c){
		$conn = $this->conn($c); 
		$email = lib_validate_request::method("POST","e"); 
		$password = lib_validate_request::method("POST","p");
		$sql = 'SELECT `id`,`email` FROM `users` WHERE `email`=:email AND `password`=:password AND `status`!=:one';
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
			echo "true";
		}else{
			echo "მომხმარებლის ელ-ფოსტა ან პაროლი არასწორია ! <br /><br /><a href=\"\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm\">ავტორიზაცია</a>";
		}
	}
}
?>