<?php
class lib_database_checkuser extends lib_database_connection{
	public function check($c,$users_email){
		$conn = $this->conn($c); 
		$sql = 'SELECT `id` FROM `users` WHERE `email`=:email AND `status`!=:one';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":email"=>$users_email, 
			":one"=>1
		));
		if($prepare->rowCount() > 0){
			return false;
		}else{
			return true; 
		}
	}
}
?>