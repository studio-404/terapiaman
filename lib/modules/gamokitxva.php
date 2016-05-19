<?php
class lib_modules_gamokitxva{
	public function gamo($c){
		$out = '<div class="poll-box">';
		$out .= '<div class="poll-header">გამოკითხვა</div>';
		$out .= '<div class="poll-question">გაქვთ თუ არა სამედიცინო დაზღვევა ?</div>';
		$out .= '<div class="poll-answers">';
		$out .= '<div class="poll-answer" style="background-size:80% 20px; margin-top:0">';
		$out .= '<span class="text">კი 80%</span>';
		$out .= '</div>';
		$out .= '<div class="poll-answer" style="background-size:20% 20px">';
		$out .= '<span class="text">არა 20%</span>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '<a href="">სხვა გამოკითხვები »</a>';
		$out .= '</div>';
		return $out;
	}
}
?>