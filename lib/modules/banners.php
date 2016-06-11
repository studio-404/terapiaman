<?php
class lib_modules_banners{
	public function load($c){

		$out = '<div class="banners" style="margin-top:0">';
		$out .= '<ul>';

		// $out .= '<li>';
		// $out .= '<a href="calc.php"><img src="img/banner1.png" alt=""></a>';
		// $out .= '</li>';

		$out .= '<li>';
		$out .= '<a href="https://play.google.com/store/apps/details?id=ge.terapia.bodymassindex&hl=en" target="_blank">';
		$out .= '<img src="img/banner2.jpg" alt="" />';
		$out .= '</a>';
		$out .= '</li>';

		$out .= '</ul>';
		$out .= '</div>';

		return $out;
	}
}
?>