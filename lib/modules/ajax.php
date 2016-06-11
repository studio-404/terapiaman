<?php
class lib_modules_ajax{
	public function recieverequest($c){
		$REQUEST = lib_validate_request::method("POST","func"); 
		$POLL = lib_validate_request::method("GET","poll"); 
		$POLL_QID = lib_validate_request::method("GET","qid"); 
		$POLL_AID = lib_validate_request::method("GET","aid"); 
		$POLL_TOKEN = lib_validate_request::method("GET","polltoken"); 

		if($POLL=="true" && is_numeric($POLL_QID) && is_numeric($POLL_AID) && $_SESSION['poll_token']==$POLL_TOKEN){
			$this->ip = $_SERVER["REMOTE_ADDR"]; 
			$folder = sprintf("%squestion%s", $c["website.json.poll"], $POLL_QID); 
			if(!is_dir($folder)){
				mkdir($folder);
			}

			$removeFiles = array(
				$c["website.json.poll"].$this->ip.".*"
			);
			lib_functions_deletefiles::rem($removeFiles);


			$file = sprintf("%s/%s.json", $folder, $this->ip); 
			$fp = fopen($file, "w");
			$array = array("answer_id"=>$POLL_AID);
			fwrite($fp, json_encode($array));
			fclose($fp);
			exit();
		}

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
			case 'addReplay': 
				if(isset($_SESSION[$c["session.prefix"]."id"])){
					$q = lib_validate_request::method("POST","q"); // question id
					$r = lib_validate_request::method("POST","r"); // replay
					$strlen = mb_strlen($r, 'UTF-8');
					$lib_database_replay = new lib_database_replay(); 
					if(!$lib_database_replay->checkquestion($c,$q)){
						$out['success'] = "false";
						$out['error'] = "კითხვა აღნიშნული ს.კ. ვერ მოიძებნა !";
					}else if(!$lib_database_replay->checkuserright($c,$q)){
						$out['success'] = "false";
						$out['error'] = "თქვენ არ გაქვთ აღნიშნულ კითხვაზე პასუხის გაცემის უფლება !";
					}else if($strlen > $c["post.max.length"]){
						$out['success'] = "false";
						$out['error'] = "მოხდა შეცდომა, პასუხმა გადააჭარმა ლიმიტს !";
					}else{
						$insert = $lib_database_replay->insert($c,$q,$r); 
						if(!empty($insert['date'])){
							$out['success'] = $insert;
							$out['error'] = "false";
						}else{
							$out['success'] = "false";
							$out['error'] = "მოხდა შეცდომა !";
						}					
					}			
				}else{
					$out['success'] = "false";
					$out['error'] = "გთხოვთ გაიაროთ ავტორიზაცია !";
				}
				echo json_encode($out);
				break;
			case 'readActivity':
				if(isset($_SESSION[$c['session.prefix']."id"])){
					$lib_database_readact = new lib_database_readact();
					echo json_encode($lib_database_readact->up($c));
				}
				break;
			case 'removeQuestion': 
				$q = lib_validate_request::method("POST","q"); // question id
				if(!is_numeric($q)){
					$out['success'] = "false";
					$out['error'] = "მოხდა შეცდომა ! კითხვა აღნიშნული ს.კ. ვერ მოიძებნა !";
				}else if(!isset($_SESSION[$c["session.prefix"]."id"])){
					$out['success'] = "false";
					$out['error'] = "გთხოვთ გაიაროთ ავტორიზაცია !";
				}else{
					$lib_database_qa = new lib_database_qa(); 
					$result = $lib_database_qa->removeQuestion($c, $q);
					if($result){
						$out['success'] = "კითხვა წარმატებით წაიშალა !";
						$out['error'] = "false";
					}else{
						$out['success'] = "false";
						$out['error'] = "კითხვის წაშლა ვერ მოხერხდა ! <br />";
					}
				}
				echo json_encode($out);
				break;
				case 'removeAnswer': 
				$a = lib_validate_request::method("POST","a"); // question id
				if(!is_numeric($a)){
					$out['success'] = "false";
					$out['error'] = "მოხდა შეცდომა ! პასუხი აღნიშნული ს.კ. ვერ მოიძებნა !";
				}else if(!isset($_SESSION[$c["session.prefix"]."id"])){
					$out['success'] = "false";
					$out['error'] = "გთხოვთ გაიაროთ ავტორიზაცია !";
				}else{
					$lib_database_qa = new lib_database_qa(); 
					$result = $lib_database_qa->removeAnswer($c, $a);
					if($result){
						$out['success'] = "პასუხი წარმატებით წაიშალა !";
						$out['error'] = "false";
					}else{
						$out['success'] = "false";
						$out['error'] = "კითხვის წაშლა ვერ მოხერხდა ! <br />";
					}
				}
				echo json_encode($out);
				break;
			case 'addQuestion': 
				$q = lib_validate_request::method("POST","q"); 
				$an = lib_validate_request::method("POST","an"); 
				if(isset($_SESSION[$c["session.prefix"]."id"]) && !empty($q) && !empty($an)){
					$lib_modules_addquestion = new lib_modules_addquestion();
					$lib_modules_addquestion->addqu($c,$q,$an);  
				}else{
					echo "კითხვის დამატებისას მოხდა შეცდომა !";
				}
				break;
			case 'sendFeedback':
				$lib_database_savefeed = new lib_database_savefeed(); 
				echo json_encode($lib_database_savefeed->fb($c));
				break;
			case 'rsPaswd':
				$lib_database_changepass = new lib_database_changepass(); 
				echo json_encode($lib_database_changepass->ch($c));
				break;
			case 'updateChvenShesaxeb':
				$lib_database_changechven = new lib_database_changechven(); 
				echo json_encode($lib_database_changechven->ch($c));
				break;
			case 'recoverEmail':
				$lib_modules_recover = new lib_modules_recover(); 
				echo json_encode($lib_modules_recover->tryrecover($c)); 
				break;
			case 'loadQuestions': 
				$f = lib_validate_request::method("POST","f"); 
				$t = lib_validate_request::method("POST","t"); 
				$lib_database_questions = new lib_database_questions(); 
				$query = $lib_database_questions->select($c,$f,$t); 
				echo json_encode($query); 
				break;
			case 'addStatia':
				$lib_database_addstatia = new lib_database_addstatia(); 
				echo json_encode($lib_database_addstatia->add($c)); 
				break;
			case 'editStatia':
				$lib_database_editstatia = new lib_database_editstatia(); 
				echo json_encode($lib_database_editstatia->edit($c)); 
				break;
			case 'removeMyStatia':
				$lib_database_rmstatia = new lib_database_rmstatia(); 
				echo json_encode($lib_database_rmstatia->remove($c)); 
				break;
			case 'updateprofile':
				$lib_database_userdata = new lib_database_userdata(); 
				echo json_encode($lib_database_userdata->update($c)); 
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