<?php
class lib_database_countfavourites extends lib_database_connection{
	public function co($c,$i){
		$conn = $this->conn($c);
		$sql = 'SELECT COUNT(`id`) AS allx FROM `favourites` WHERE `item_id`=:itemid';
		$prepare = $conn->prepare($sql); 
		$prepare->execute(array(
			":itemid"=>$i
		)); 
		if($prepare->rowCount() > 0){
			$fetch = $prepare->fetch(PDO::FETCH_ASSOC); 
			$out = $fetch['allx'];
		}else{
			$out = 0;
		}
		return $out;
	} 
}
?>