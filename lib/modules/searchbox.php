<?php
class lib_modules_searchbox{
	public function search($c, $q = 1){
		$search = (lib_validate_request::method("GET","search")) ? urldecode(lib_validate_request::method("GET","search")) : '';

		$out = '<div class="search-box" style="margin-top:0px">';
		$out .= '<div class="search-header">ძიება</div>';
		$out .= '<div class="search-body">';
		$out .= '<form action="javascript:void(0)" method="post">';

		$out .= '<div class="input-group">';
    	$out .= '<select id="whereToSearch" name="whereToSearch">';
    	$out .= '<option value="1" '.(($q==1) ? 'selected="selected"' : '').'>ყველა სტატია</option>';
    	$out .= '<option value="2" '.(($q==2) ? 'selected="selected"' : '').'>კითხვა პასუხი</option>';
    	$out .= '</select>';
    	$out .= '</div>';

		$out .= '<div class="input-group">';
		$out .= '<input type="text" name="search" id="search" value="'.htmlentities($search).'" placeholder="საკვანძო სიტყვა" />';
		$out .= '</div>';  	
    	

    	$out .= '<a href="javascript:;" class="btn btn-primary" role="button" id="search-button">ძებნა</a>';


		$out .= '</form>';
		$out .= '</div>';
		// $out .= '<a href="">სხვა გამოკითხვები »</a>';
		$out .= '</div>';
		return $out;
	}
}
?>