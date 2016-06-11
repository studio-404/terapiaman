<?php
class lib_database_insertuser extends lib_database_connection{

	public function insert($c){
		$email = lib_validate_request::method("POST","e"); 
		$password = lib_validate_request::method("POST","p"); 
		$namelname = lib_validate_request::method("POST","n"); 

		$lib_validate_insertuser = new lib_validate_insertuser(); 
		$validate = $lib_validate_insertuser->validatex($c,$email, $password, $namelname);
		if(!$validate["error"]){ 
			$conn = $this->conn($c); 
			$sql = 'INSERT INTO `users` SET `ip`=:ip, `email`=:email, `password`=:password, `namelname`=:namelname';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":ip"=>$_SERVER["REMOTE_ADDR"], 
				":email"=>$email, 
				":password"=>sha1($password), 
				":namelname"=>$namelname 
			));
			echo "რეგისტრაცია წარმატებით დასრულდა !";
		}else{
			echo $validate["error"];
		}
	}

	public function insertFbUser($c, $fbid, $fbName){
		if(!empty($fbid) && !empty($fbName)){
			$sha1 = time().$fbid;
			$sha1 = sha1($sha1);
			$conn = $this->conn($c);
			$sql = 'INSERT INTO `users` SET `ip`=:ip, `email`=:email, `password`=:password, `namelname`=:namelname';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":ip"=>$_SERVER['REMOTE_ADDR'], 
				":email"=>$fbid, 
				":password"=>$sha1, 
				":namelname"=>$fbName
			));
			if($prepare->rowCount() > 0){
				return true;
			}
		}
		return false;
	}

}
?>