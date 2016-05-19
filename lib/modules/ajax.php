<?php
class lib_modules_ajax{
	public function recieverequest($c){
		$REQUEST = lib_validate_request::method("POST","func"); 

		switch ($REQUEST) {
			case 'insertuser': 
				$lib_database_insertuser = new lib_database_insertuser(); 
				$lib_database_insertuser->insert($c); 
				break;
			case 'signin': 
				$lib_database_signin = new lib_database_signin(); 
				$lib_database_signin->trysign($c); 
				break;
			case 'addFavourites': 
				$item = lib_validate_request::method("POST","item"); 
				if(isset($_SESSION[$c["session.prefix"]."id"]) && is_numeric($item)){
					$lib_database_favorites = new lib_database_favorites(); 
					echo $lib_database_favorites->add($c, $_SESSION[$c["session.prefix"]."id"], $item); 
				}else{
					echo "დამატებისას მოხდა შეცდომა !";
				}
				break;
			case 'addQuestion': 
				$q = lib_validate_request::method("POST","q"); 
				if(isset($_SESSION[$c["session.prefix"]."id"]) && !empty($q)){
					$lib_modules_addquestion = new lib_modules_addquestion();
					$lib_modules_addquestion->addqu($c,$q);  
				}else{
					echo "კითხვის დამატებისას მოხდა შეცდომა !";
				}
				break;
			case 'loadQuestions': 
				$f = lib_validate_request::method("POST","f"); 
				$t = lib_validate_request::method("POST","t"); 
				$lib_database_questions = new lib_database_questions(); 
				$query = $lib_database_questions->select($c,$f,$t); 
				echo json_encode($query); 
				break;
			case 'removeFavourites': 
				$item = lib_validate_request::method("POST","item"); 
				if(isset($_SESSION[$c["session.prefix"]."id"]) && is_numeric($item)){
					$lib_database_favorites = new lib_database_favorites(); 
					echo $lib_database_favorites->remove($c, $_SESSION[$c["session.prefix"]."id"], $item); 
				}else{
					echo "წაშლისას მოხდა შეცდომა !";
				}
				break;
			case 'signout': 
				session_destroy(); 
				echo "true"; 
				break;

			default:
				echo "მოხდა ფატალური შეცდომა !"; 
				break;
		}

	}
} 
?>