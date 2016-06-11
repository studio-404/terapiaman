<?php
class lib_lancher_template{
	public function loads($c, $s){

		$file_requested = ''; 
		if(!empty($s[0]) && !empty($s[1]) && $s[0]=="css"){
			/* CSS Load */
			$file_requested = $c["website.directory"].'/css/'.$s[1];
			if(file_exists($file_requested)){
				header("Content-type: text/css"); 
				echo file_get_contents($file_requested);
			}
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && $s[0]=="js"){
			/* JS Load */
			$file_requested = $c["website.directory"].'/js/'.$s[1]; 
			if(file_exists($file_requested)){
				header("Content-type: application/javascript"); 
				echo file_get_contents($file_requested);
			}
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && $s[0]=="_plugin"){
			/* JS Load */
			$last = end($s);
			$ext = explode(".",$last);
			$ext = end($ext); 
			$current_url = lib_functions_currenturl::u();
			$after_plugin = explode($c['website.base'], $current_url); 
			$file_requested = $c["website.directory"]."/".$after_plugin[1];
			if(file_exists($file_requested)){
				switch ($ext) {
					case 'js':
						header("Content-type: application/javascript"); 
						echo file_get_contents($file_requested);
						break;
					case 'css':
						header("Content-type: text/css"); 
						echo file_get_contents($file_requested);
						break;
					case 'woff':
						header("Access-Control-Allow-Origin: *"); 
						echo file_get_contents($file_requested);
						break;
					case 'ttf':
						header("Access-Control-Allow-Origin: *"); 
						echo file_get_contents($file_requested);
						break;
					default:
						# code...
						break;
				}
			}
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && $s[0]=="fonts"){
			/* Fonts Load */
			header('Access-Control-Allow-Origin: *');
			$file_requested = $c["website.directory"].'/fonts/'.$s[1]; 
			if(file_exists($file_requested)){
				echo file_get_contents($file_requested);
			}
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && $s[0]=="img"){
			/* Image Load */
			header('Access-Control-Allow-Origin: *');
			$file_requested = $c["website.directory"].'/img/'.$s[1]; 
			if(file_exists($file_requested)){
				echo file_get_contents($file_requested);
			}
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && is_numeric($s[1]) && $s[0]=="slider"){
			/* Image Load */
			header('Access-Control-Allow-Origin: *');
			$lib_database_slider = new lib_database_slider(); 
			$image = $lib_database_slider->select_image($c,$s[1]);
			$file_requested = $c["website.directory"].'/img/'.$image; 
			if(file_exists($file_requested)){
				echo file_get_contents($file_requested);
			}
			exit();
		}else if(!empty($s[0]) && urldecode($s[0])=="ajax"){
			$lib_modules_ajax = new lib_modules_ajax(); 
			$lib_modules_ajax->recieverequest($c);
			exit();
		}else if(!empty($s[0]) && urldecode($s[0])=="feed"){
			header("Content-type: text/xml");
			$lib_modules_feeds = new lib_modules_feeds(); 
			if(!empty($s[1]) && $s[1]=="sitemap"){
				echo $lib_modules_feeds->sitemap($c);
			}else{
				echo $lib_modules_feeds->news($c);
			}
			exit();
		}else if(!empty($s[0]) && $s[0]=="callback"){
			$lib_functions_facebook = new lib_functions_facebook();
			$lib_functions_facebook->userInfo($c);
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && urldecode($s[0])=="კატეგორია"){
			$file_requested = $c["website.directory"].'/category.php';
		}else if(!empty($s[0])){
			/* Load requested file */ 
			$url = lib_functions_geotoeng::trans($s[0]);

			if(urldecode($s[0])=="სტატია" && is_numeric($s[1])){ 
				$lib_modules_statia = new lib_modules_statia(); 
				$d = $lib_modules_statia->stat($c,$s);  
				$data['id'] = $d[0]["id"];
				$data['date'] = $d[0]["date"];
				$data['title'] = $d[0]["title"];
				$data['text'] = $d[0]["long_text"];
				$data['tags'] = $d[0]["tags"];
				$data['view'] = $d[0]["view"];
				$data['auther'] = $d[0]["auther"];
				$data['meta_description'] = $d[0]["meta_desc"];
				$file_requested = $c["website.directory"].'/'.$url.'.php'; 	
			}else if(urldecode($s[0])=="კითხვა-პასუხი" && !empty($s[1]) && is_numeric($s[1])){
				$data['title'] = "კითხვა პასუხი";
				$lib_modules_questioninside = new  lib_modules_questioninside(); 
				$data['qustions'] = $lib_modules_questioninside->q($c, $s[1]);
				$data['answers'] = $lib_modules_questioninside->a($c, $s[1]); 
				$data['meta_description'] = $lib_modules_questioninside->desc;
				$file_requested = $c["website.directory"].'/kitxvapasuxi_inside.php'; 
			}else if(urldecode($s[0])=="ჩემი-კითხვები" && isset($_SESSION[$c["session.prefix"]."id"])){
				$data['title'] = "ჩემი კითხვები";
				$data['meta_description'] = "ჩემი კითხვები";
				$lib_modules_myquestions = new lib_modules_myquestions();
				$data['myquestions'] = $lib_modules_myquestions->ques($c);
				$data['countall'] = $lib_modules_myquestions->countall;
				$file_requested = $c["website.directory"].'/Cemikitxvebi.php'; 
			}else if(urldecode($s[0])=="ლოგები" && isset($_SESSION[$c["session.prefix"]."id"])){
				$data['title'] = "ლოგები";
				$data['meta_description'] = "ლოგები";
				$lib_modules_mylogs = new lib_modules_mylogs();
				$data['mylogs'] = $lib_modules_mylogs->logs($c);
				$data['countall'] = $lib_modules_mylogs->countall;
				$file_requested = $c["website.directory"].'/logebi.php'; 
			}else if(urldecode($s[0])=="ყველა-სტატია"){
				$lib_database_pagedata = new lib_database_pagedata(); 
				$data = json_decode($lib_database_pagedata->data($c, $s),true);
				$lib_modules_allarticles = new lib_modules_allarticles(); 
				$data['articles'] = $lib_modules_allarticles->art($c, $s); 
				$file_requested = $c["website.directory"].'/yvelastatia.php'; 
         	}else if(urldecode($s[0])=="პროფილი" && is_numeric($s[1]) && isset($_SESSION[$c["session.prefix"]."id"])){
				$data['title'] = "პროფილი";
				$data['meta_description'] = "პროფილი";
				$lib_database_userdata = new lib_database_userdata(); 
				$data["user"] = json_decode($lib_database_userdata->select($c),true); 
				$file_requested = $c["website.directory"].'/profili.php'; 
         	}else if(urldecode($s[0])=="ფავორიტები" && isset($_SESSION[$c["session.prefix"]."id"])){
				$lib_modules_myfavourites = new lib_modules_myfavourites(); 
				$data["myfavourites"] = $lib_modules_myfavourites->fav($c,$s);
				$data["favouritesCounted"] = $lib_modules_myfavourites->favCounted;
               	$data['title'] = "ფავორიტები";
				$data['meta_description'] = "ფავორიტები";
				$file_requested = $c["website.directory"].'/favoritebi.php'; 
         	}else if(urldecode($s[0])=="ჩემი-სტატიები"){
         		if(isset($_SESSION[$c["session.prefix"]."id"])){
         			if(empty($s[1])){
						$lib_modules_mystatia = new lib_modules_mystatia(); 
						$data["mystatias"] = $lib_modules_mystatia->stat($c);
						$data["mystatiasCounted"] = $lib_modules_mystatia->statCounted;
						$data['title'] = "ჩემი სტატიები";
						$data['meta_description'] = "ჩემი სტატიები";
						$file_requested = $c["website.directory"].'/Cemistatiebi.php'; 	
         			}else if(!empty($s[1]) && urldecode($s[1])=="დამატება"){
         				$data['title'] = "სტატიის დამატება";
						$data['meta_description'] = "სტატიის დამატება";
						$file_requested = $c["website.directory"].'/statiisdamateba.php'; 	
         			}else if(!empty($s[1]) && urldecode($s[1])=="რედაქტირება" && !empty($s[2]) && is_numeric($s[2])){
         				$data['title'] = "სტატიის რედაქტირება";
						$data['meta_description'] = "სტატიის რედაქტირება";
						$lib_database_selectstatia = new lib_database_selectstatia(); 
						$data['form'] = json_decode($lib_database_selectstatia->select_one($c, $s),true);
						// echo '<pre>';
						// print_r($data['form']);
						// echo '</pre>';
						$file_requested = $c["website.directory"].'/statiisredaqtireba.php'; 	
         			}					
				}else{
					lib_functions_redirect::url($c["website.base"]);
				}
         	}else if(urldecode($s[0])=="პაროლის-აღდგენა"){

               	$data['title'] = "პაროლის აღდგენა";
				$data['meta_description'] = "პაროლის აღდგენა";

				$file_requested = $c["website.directory"].'/parolisaRdgena.php'; 
         	}else{
				$lib_database_pagedata = new lib_database_pagedata(); 
				$data = json_decode($lib_database_pagedata->data($c, $s),true);
				if(!empty($data['type']) && $data['type']=="textpage"){
					$file_requested = $c["website.directory"].'/text.php'; 
				}else{
					$file_requested = $c["website.directory"].'/'.$url.'.php'; 	
				}
				
			}
		}

		// echo $data['title']; 

		/* Check file existance */
		if(file_exists($file_requested)){
			@include($file_requested); 
		}else{
			$lib_database_pagedata = new lib_database_pagedata(); 
			$data = json_decode($lib_database_pagedata->data($c, array("მთავარი-გვერდი")),true); 
			@include($c["website.directory"].'/index.php'); 
		}

	}
}
?>