<?php
class lib_validate_insertuser{
	public $message = "";
	public function validatex($c,$email, $password, $namelname){
		if(!empty($email) && !empty($password) && !empty($namelname)){

			$lib_database_checkuser = new lib_database_checkuser();
			if($lib_database_checkuser->check($c,$email)){
				$this->message["error"] = false;
			}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$this->message["error"] = "გთხოვთ გადაამოწმოთ ელ-ფოსტის ფორმატი !";
			}else{
				$this->message["error"] = "მომხმარებელი ელ-ფოსტით <b>".$email."</b> უკვე რეგისტრირებულია !";
			}
		}else{
			$this->message["error"] = "ყველა ველი სავალდებულოა !";
		}
		return $this->message;
	}

}
?>