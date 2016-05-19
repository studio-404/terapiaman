<?php
class lib_lancher_template{
	public function loads($c, $s){

		$file_requested = ''; 
		if(!empty($s[0]) && !empty($s[1]) && $s[0]=="css"){
			/* CSS Load */
			header("Content-type: text/css"); 
			$file_requested = $c["website.directory"].'/css/'.$s[1]; 
			echo file_get_contents($file_requested);
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && $s[0]=="js"){
			/* JS Load */
			header("Content-type: application/javascript"); 
			$file_requested = $c["website.directory"].'/js/'.$s[1]; 
			echo file_get_contents($file_requested);
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && $s[0]=="fonts"){
			/* Fonts Load */
			header('Access-Control-Allow-Origin: *');
			$file_requested = $c["website.directory"].'/fonts/'.$s[1]; 
			echo file_get_contents($file_requested);
			exit();
		}else if(!empty($s[0]) && !empty($s[1]) && $s[0]=="img"){
			/* Image Load */
			header('Access-Control-Allow-Origin: *');
			$file_requested = $c["website.directory"].'/img/'.$s[1]; 
			echo file_get_contents($file_requested);
			exit();
		}else if(!empty($s[0]) && is_numeric($s[1]) && $s[0]=="slider"){
			/* Image Load */
			header('Access-Control-Allow-Origin: *');
			$lib_database_slider = new lib_database_slider(); 
			$image = $lib_database_slider->select_image($c,$s[1]);
			$file_requested = $c["website.directory"].'/img/'.$image; 
			echo file_get_contents($file_requested);
			exit();
		}else if(!empty($s[0]) && urldecode($s[0])=="ajax"){
			$lib_modules_ajax = new lib_modules_ajax(); 
			$lib_modules_ajax->recieverequest($c);
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
				$data['meta_description'] = $d[0]["meta_desc"];
				$file_requested = $c["website.directory"].'/'.$url.'.php'; 	
			}else if(urldecode($s[0])=="კითხვა-პასუხი" && is_numeric($s[1])){
				$data['title'] = "კითხვა პასუხი";
				$data['meta_description'] = "კითხვა პასუხი";
				$file_requested = $c["website.directory"].'/kitxvapasuxi_inside.php'; 
			}else if(urldecode($s[0])=="ყველა-სტატია"){
			   $lib_database_pagedata = new lib_database_pagedata(); 
			   $data = json_decode($lib_database_pagedata->data($c, $s),true);
               
                $lib_modules_allarticles = new lib_modules_allarticles(); 
      			$data['articles'] = $lib_modules_allarticles->art($c, $s); 
               

               $file_requested = $c["website.directory"].'/yvelastatia.php'; 
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