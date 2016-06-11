<?php
class lib_functions_alltagstotaglinks{
	public static function make($alltags){
		$out = '';
		$all = '';
		foreach ($alltags as $v) {
			$all .= $v['tags'].",";
		}
		$tags = explode(",",$all);
		foreach ($tags as $tag) {
			$rand = rand(9,22);
			if(!empty($tag)){
				$string = trim($tag,' ');
				$out .= '<a href="http://www.terapia.ge/ყველა-სტატია/?tags='.urlencode($string).'" class="f'.$rand.'">'.$string.'</a>';
			}
		}

		return $out;
	}
}
?>