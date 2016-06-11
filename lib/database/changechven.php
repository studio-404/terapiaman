<?php
class lib_database_changechven extends lib_database_connection{
	public function ch($c){
		$out['message'] = 'მოხდა შეცდომა !';
		$chv = lib_validate_request::method('POST','c');
		if(!empty($chv)){
			$conn = $this->conn($c); 
			$sql = 'UPDATE `menu` SET `text`=:text WHERE `id`=:id';
			$prepare = $conn->prepare($sql);
			$prepare->execute(array(
				":text"=>$chv, 
				":id"=>2
			));
			if($prepare->rowCount() > 0){
				$removeFiles = array(
					$c["website.json"].'pagedata_CvensSesaxeb.*' 
				);
				lib_functions_deletefiles::rem($removeFiles);
				$out['message'] = 'ტექსტი წარმატებით განახლდა !';
			}
		}
		return $out;
	}
}
?>