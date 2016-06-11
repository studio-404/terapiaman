<?php
class lib_modules_theme{ 

	public static function metadata($c, $data){
		$out = '<meta charset="utf-8">';
		$out .= "\r\n";
		$out .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
		$out .= "\r\n";
		$out .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
		$out .= "\r\n";
		$out .= '<title>'.htmlentities($data['title']).' '.$c["title.sufix"].'</title>';
		$out .= "\r\n";
		$out .= '<base href="'.$c["website.base"].'" />';
		$out .= "\r\n";
		$out .= '<meta property="fb:app_id" content="'.trim("1999692500254945"," ").'" />';
		$out .= "\r\n";
		$out .= '<meta property="og:title" content="'.trim(htmlentities($data['title']).' '.$c["title.sufix"],' ').'" />';
		$out .= "\r\n";
		$out .= '<meta property="og:type" content="website" />';
		$out .= "\r\n";
		$out .= '<meta property="og:url" content="'.trim(lib_functions_currenturl::u(),' ').'" />';
		$out .= "\r\n";
		$out .= '<meta property="og:image" content="'.$c["website.base"].'share.png" />';
		$out .= "\r\n";
		$out .= '<meta property="og:image:width" content="1600">';
		$out .= "\r\n";
		$out .= '<meta property="og:image:height" content="630">';
		$out .= "\r\n";
		$out .= '<meta property="og:site_name" content="'.trim($c["website.name"],' ').'"/>';
		$out .= "\r\n";
		$out .= '<meta property="og:description" content="'.htmlentities(strip_tags($data['meta_description'])).'"/>';
		$out .= "\r\n";
		$out .= '<meta name="description" content="'.htmlentities(strip_tags($data['meta_description'])).'">';
		$out .= "\r\n";
		$out .= '<meta name="keywords" content="'.htmlentities($c["keywords"]).'" />';
		$out .= "\r\n";
		$out .= '<meta name="author" content="'.$c['website.auther'].'" />';
		$out .= "\r\n";
		return $out;
	}

	public static function js($c){
		$slug = lib_functions_geturl::slugs($c);
		$out = '<script src="'.$c["website.base"].'js/jquery-1.11.3.min.js" type="text/javascript"></script>';
		$out .= "\r\n";
		$out .= '<script src="'.$c["website.base"].'js/bootstrap.min.js" type="text/javascript"></script>';
		$out .= "\r\n";
		$out .= '<script src="'.$c["website.base"].'js/geoKeyBoard.js" type="text/javascript"></script>';
		
		if(lib_validate_request::method('GET','edit')=="true" || (urldecode($slug[0])=="ჩემი-სტატიები" && (urldecode($slug[1])=="დამატება" || urldecode($slug[1])=="რედაქტირება"))){
			$out .= "\r\n";
			$out .= '<script src="'.$c["website.base"].'_plugin/tinymce/js/tinymce/tinymce.min.js"></script>';
			$out .= "\r\n";
			$out .= '<script>tinymce.init({ 
				selector:\'textarea\', 
				language: \'ka_GE\', 
				setup : function(ed) {
                  ed.on(\'keyup\', function(e) {
                     replaceTMContent(e, ed, ed.getContent());
                  });
            	}, 
            	plugins: "image, table, code, textcolor", 
            	extended_valid_elements : "iframe[src|width|height|name|align]"
			 });</script>';
		}
		return $out;
	}

	public static function links($c,$data){
		$out .= '<link rel="alternate" type="application/rss+xml" title="'.$data['title'].' '.$c["title.sufix"].'" href="'.$c["website.base"].'feed/" />';
		$out .= "\r\n";
		$out .= '<link rel="shortcut icon" href="'.$c["website.base"].'img/favicon.png" title="Favicon" />';
		$out .= "\r\n";
		$out .= '<link rel="stylesheet" type="text/css" href="'.$c["website.base"].'css/bootstrap.min.css" />';
		$out .= "\r\n";
		$out .= '<link rel="stylesheet" type="text/css" href="'.$c["website.base"].'css/bootstrap-theme.min.css" />';
		$out .= "\r\n";
		$out .= '<link rel="stylesheet" type="text/css" href="'.$c["website.base"].'css/general.css" />';
		$out .= "\r\n";
		$out .= '<link itemprop="logo" href="'.$c["website.base"].'img/logo.png" />';
		$out .= "\r\n";
		return $out;
	}	

}
?>