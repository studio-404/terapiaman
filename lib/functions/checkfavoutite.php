<?php
class lib_functions_checkfavoutite{
	public function check($c,$session_id,$item_id){
		$lib_database_favorites = new lib_database_favorites();
		$favourites = json_decode($lib_database_favorites->select($c, $session_id),true);
		if($this->is_in_array($favourites, 'item_id', $item_id)=="yes"){
			return true;
		}
		return false;
	}

	public function is_in_array($array, $key, $key_value){
	    $within_array = 'no';
	    foreach( $array as $vv ){
	    	foreach ($vv as $k=>$v) {
	    		if( $v == $key_value && $k == $key ){
	            	$within_array = 'yes';
	            	break;
            	}
	    	}           
	    }
	    return $within_array;
	}
}
?>