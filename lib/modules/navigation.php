<?php
class lib_modules_navigation{
	public function menu($c){
		$lib_database_menu = new lib_database_menu(); 
	    $menu = json_decode($lib_database_menu->selectNavigation($c), true);

	    $out = '<nav class="content" itemscope itemtype="http://schema.org/SiteNavigationElement">';
	    $out .= '<ul>';

		foreach ($menu as $m) {
			$active = ($m['slug']==lib_functions_geturl::num($c,0)) ? 'class="active"' : '';
			if($m['slug']=="მთავარი-გვერდი"){ // if main page
				$m['slug']=""; $active = (lib_functions_geturl::num($c,0)=="") ? 'class="active"' : ''; 
			}
			$out .= '<li><a href="'.$c["website.base"].$m['slug'].'" '.$active.' itemprop="url"><span itemprop="name">'.$m['title'].'</span></a></li>';
		}		
		
		$out .= '</ul>';
		$out .= '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>';
		$out .= '</nav>';
		return $out;
	}
}
?>