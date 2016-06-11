<?php
class lib_modules_slideshow{
	public function slider($c){
		$lib_database_slider = new lib_database_slider(); 
		$json = json_decode($lib_database_slider->select($c),true); 
		$out = '';
		$x = 1;
		foreach ($json as $v) {
			if($x==1){ $active =' active'; }else{ $active = ''; }
			$out .= '<div class="item'.$active.'">';
			$out .= '<a href="'.$v['url'].'">';
          	$out .= '<img src="'.$c["website.base"].'slider/'.$v['id'].'" width="100%" alt="'.htmlentities($v['title']).'">'; 
          	$out .= '<div class="carousel-caption">';
            $out .= '<h3>'.$v['title'].'</h3>';
            $out .= '<p>'.$v['text'].'</p>';
          	$out .= '</div>'; 
          	$out .= '</a>'; 
			$out .= '</div>'; 
			$x++;
        }
        return $out;
	}
}
?>