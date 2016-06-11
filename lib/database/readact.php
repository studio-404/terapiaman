<?php
class lib_database_readact extends lib_database_connection{
	public function up($c){
		$out["error"] = "true";
		$out["message"] = "მოხდა შეცდომა !";
		$id = lib_validate_request::method("POST","i");
		$conn = $this->conn($c); 
		$sql = 'UPDATE `activities` SET `read`=:read WHERE `id`=:id';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":read"=>1, 
			":id"=>$id
		));
		$out["error"] = "false";
		$out["message"] = "მონაცემი წარმატებით განახლდა !";
		
		if($prepare->rowCount() > 0){
			$removeFiles = array(
				$c["website.json"].'mylogs*.*' 
			);
			lib_functions_deletefiles::rem($removeFiles);
		}
		return $out;
	}
}
?>