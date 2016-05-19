<?php
class lib_database_pagetype extends lib_database_connection{
	public function type($c,$slug){
		$conn = $this->conn($c); 
		$sql ='SELECT `type` FROM `menu` WHERE `slug`=:slug AND `status`!=1'; 
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":slug"=>urldecode($slug)
		)); 
		
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC);  
			return $fetch['type'];
		} 
		return false;
	}
}
?>