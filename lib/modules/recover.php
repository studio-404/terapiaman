<?php
class lib_modules_recover{
	public function tryrecover($c){
		$out['error'] = "true";
		$out['message'] = "მოხდა შეცდომა !";
		$email = lib_validate_request::method("POST","e");
		if(empty($email)){
			$out['message'] = "ელ-ფოსტის ველი სავალდებულოა !";
		}else if(!lib_validate_email::val($email)){
			$out['message'] = "გთხოვთ გადაამოწმოთ ელ-ფოსტის ფორმატი !";
		}else{
			$lib_database_signin = new lib_database_signin(); 
			if($lib_database_signin->checkUserByEmail($c, $email)){
				if($lib_database_signin->updateRecoverAndGenerate($c, $email)){
					$out['message'] = "შეტყობინება გამოგეგზავნათ ელ-ფოსტაზე !";
					$out['error'] = "false";
				}else{
					$out['message'] = "შეტყობინების გაგზავნისას მოხდა შეცდომა !";
				}
			}else{
				$out['message'] = "მომხმარებელი აღნიშნული ელ-ფოსტით არ არის რეგისტრირებული !";
			}
		}
		return $out;
	}
}
?>