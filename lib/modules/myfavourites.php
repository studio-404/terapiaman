<?php
class lib_modules_myfavourites{
	public $favCounted = 0;
	public function fav($c,$s){
		$lib_database_favorites = new lib_database_favorites(); 
		$myfavourites = json_decode($lib_database_favorites->myfav($c,$s),true);

		$out = '';
		if(!empty($myfavourites)){
			$this->favCounted = $myfavourites[0]["favCounted"];
			foreach ($myfavourites as $fav) {
				$out .= '<tr id="myfavx_'.$fav['id'].'">';
				$out .= '<th scope="row">'.$fav['id'].'</th>';
				$out .= '<td><a href="'.$c["website.base"].'სტატია/'.$fav['id'].'/'.$fav['slug'].'">'.$fav['title'].'</a></td> ';
				$out .= '<td><a href="javascript:void(0)" class="heart on" data-itemid="'.$fav['id'].'" data-signed="yes"><i class="fa fa-times" aria-hidden="true"></i></a></td>';
				$out .= '</tr>';
			}
		}else{
			$out .= '<tr>';
			$out .= '<td colspan="3">მონაცემი ვერ მოიძებნა !</td>';
			$out .= '</tr>';
		}
		return $out;
	}
}
?>