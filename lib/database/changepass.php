<?php
class lib_database_changepass extends lib_database_connection{
	public function ch($c){
		$out["message"] = 'მოხდა შეცდომა !';
		$out["error"] = 'true';
		$newpassword = lib_validate_request::method("POST","n"); 
		$comfirm = lib_validate_request::method("POST","c"); 
		$recover = lib_validate_request::method("POST","re"); 

		if(empty($newpassword) OR empty($comfirm)){
			$out["message"] = 'ყველა ველი სავალდებულოა !';
			$out["error"] = 'true';
		}else if(strlen($newpassword) < 6){
			$out["message"] = 'პაროლი უნდა აღემატებოდეს 5 სიმბოლოს !';
			$out["error"] = 'true';
		}else if($newpassword!=$comfirm){
			$out["message"] = 'პაროლები არ ემთხვევა ერთმანეთს !';
			$out["error"] = 'true';
		}else{
			$conn = $this->conn($c); 
			$sql = 'UPDATE `users` SET `password`=:password, `recover`=:emptyrecover WHERE `recover`=:recover';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":password"=>sha1($newpassword), 
				":recover"=>$recover, 
				":emptyrecover"=>""
			));
			if($prepare->rowCount() > 0){
				$out["message"] = 'პაროლი წარმატებით განახლდა !';
				$out["error"] = 'false';
			}
		}
		return $out;
	}
}
?>