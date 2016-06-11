<?php
class lib_modules_mystatia{
	public $statCounted = 0;
	public function stat($c){
		$lib_database_selectstatia = new lib_database_selectstatia(); 
		$mystats = json_decode($lib_database_selectstatia->mystats($c),true);

		$out = '';
		if(!empty($mystats)){
			$this->statCounted = $mystats[0]["statCounted"];
			foreach ($mystats as $stat) {
				$out .= '<tr id="mystatsx_'.$stat['id'].'">';
				$out .= '<th scope="row">'.$stat['id'].'</th>';
				$out .= '<td><a href="'.$c["website.base"].'სტატია/'.$stat['id'].'/'.$stat['slug'].'">'.$stat['title'].'</a></td> ';
				$out .= '<td>';
				$out .= '<a href="'.$c["website.base"].'ჩემი-სტატიები/რედაქტირება/'.$stat['id'].'" data-itemid="'.$stat['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
				$out .= '<a href="javascript:void(0)" data-itemid="'.$stat['id'].'" class="deleteMyStatia" style="margin-left:10px;"><i class="fa fa-times" aria-hidden="true"></i></a>';
				$out .= '</td>';
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