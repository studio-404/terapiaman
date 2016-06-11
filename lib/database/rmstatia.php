<?php
class lib_database_rmstatia extends lib_database_connection{
	public function remove($c){
		$out["error"] = "true";
		$out["message"] = "მოხდა შეცდომა !";
		$item = lib_validate_request::method("POST","i");
		if(!is_numeric($item)){
			$out["message"] = "ვერ მოხერხდა სტატიის იდენთიფიკაცია !";
		}else if(!isset($_SESSION[$c["session.prefix"]."id"])){
			$out["message"] = "გთხოვთ გაიაროთ ავტორიზაცია !";
		}else{
			$conn = $this->conn($c); 
			$sql = 'UPDATE `category_items` SET `status`=1 WHERE `id`=:id AND `auth_id`=:auth_id';
			$prepare = $conn->prepare($sql); 
			$prepare->execute(array(
				":id"=>(int)$item, 
				":auth_id"=>$_SESSION[$c["session.prefix"]."id"] 
			));
			if($prepare->rowCount() > 0){
				$out["error"] = "false";
				$out["message"] = "სტატია წარმატებით წაიშალა !";
				$removeFiles = array(
					$c["website.json"].'allArticles*.*',
					$c["website.json"].'mystatia*.*',
					$c["website.json"].'welcomeArticles.*', 
					$c["website.json"].'statia*.*', 
					$c["website.json"].'categories.*',  
					$c["website.json"].'alltags.*' 
				);
				lib_functions_deletefiles::rem($removeFiles);
			}else{
				$out["error"] = "true";
				$out["message"] = "სტატია წარმატებით წაიშალა !";
			}
		}
		return $out;
	}
}
?>