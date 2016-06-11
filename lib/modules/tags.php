<?php
class lib_modules_tags{
	public function allTags($c){
		$lib_database_tags = new lib_database_tags();
		$alltags = json_decode($lib_database_tags->all($c),true);
		$out = '<div class="tags-box">';
		$out .= '<div class="tags-header">ტეგები</div>';
		$out .= '<div class="tags-body">';
		$out .= lib_functions_alltagstotaglinks::make($alltags);
		$out .= '<div style="clear:both"></div></div>';
		$out .= '</div>';
		return $out;
	}
}
?>