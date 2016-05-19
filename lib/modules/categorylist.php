<?php
class lib_modules_categorylist{
	public function cat($c){
		$slug = lib_functions_geturl::slugs($c); 
		$lib_database_categories = new lib_database_categories(); 
		$json = json_decode($lib_database_categories->select($c),true); 
		$out = '';
		$x = 1;
		$out = '<nav itemscope itemtype="http://schema.org/SiteNavigationElement"><ul>'; 
		foreach ($json as $v) {
			if(!empty($slug[1]) && is_numeric($slug[1]) && $slug[1]==$v['id']){
				$active = ' class="active"';
			}else{ $active = ''; }
			$out .= '<li'.$active.'>';
	        $out .= '<a href="'.$c["website.base"]."ყველა-სტატია/".$v['id']."/".$v['slug'].'" itemprop="url" title="'.htmlentities($v['title']).'"><span style="background-image:url(\'img/'.$v['icon'].'\');"></span><font itemprop="name">'.$v['title'].'</font> ( '.$v['count'].' )</a>'; 
	        $out .= '</li>';
			$x++;
        }
        $out .= '</ul></nav>';

        return $out;
	}

	public function cat_footer($c){
		$lib_database_categories = new lib_database_categories(); 
		$json = json_decode($lib_database_categories->select($c),true); 
		$out = '';
		$x = 1;
		$out['left'] = '<ul itemscope itemtype="http://schema.org/SiteNavigationElement">'; 
		$out['right'] = '<ul itemscope itemtype="http://schema.org/SiteNavigationElement">'; 
		foreach ($json as $v) {
			if(($x%2)!=0){ 
				$out['left'] .= '<li>';
	      		$out['left'] .= '<a href="'.$c["website.base"]."ყველა-სტატია/".$v['id']."/".$v['slug'].'" itemprop="url" title="'.htmlentities($v['title']).'"><span itemprop="name">'.$v['title'].'</span></a>'; 
	       		$out['left'] .= '</li>';
	    	}else{
	       		$out['right'] .= '<li>';
	       		$out['right'] .= '<a href="'.$c["website.base"]."ყველა-სტატია/".$v['id']."/".$v['slug'].'" itemprop="url" title="'.htmlentities($v['title']).'"><span itemprop="name">'.$v['title'].'</span></a>'; 
	       		$out['right'] .= '</li>';
	    	}
			$x++;
        }
        $out['left'] .= '</ul>';
        $out['right'] .= '</ul>';

        return $out;
	}
}
?>