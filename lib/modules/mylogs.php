<?php
class lib_modules_mylogs{
	public $countall; 

	public function logs($c){
		$lib_database_mylogs = new lib_database_mylogs();
		$select = json_decode($lib_database_mylogs->select($c),true);

		$out = '';
		if(!empty($select)){
			foreach ($select as $v) {
				$this->countall = $v['countall'];
				$out .= '<tr>';
				$out .= '<td>';
				$out .= $v['question_id'];
				$out .= '</td>';
				
				$out .= '<td>';
				$out .= date("d/m/Y H:m:s", $v['date']);
				$out .= '</td>';

				$out .= '<td>';
				$out .= '<a href="javascript:void(0)" data-acid="'.$v['id'].'" data-urllink="'.$c['website.base'].'კითხვა-პასუხი/'.$v['question_id'].'" class="readActivity">'.$v['text'].'</a>';
				$out .= '</td>';

				$out .= '<td>';
				$out .= $v['usersname'];
				$out .= '</td>';

				$out .= '<td>';
				$out .= ($v['read']==1) ? "<i class=\"fa fa-check\" aria-hidden=\"true\" style=\"color:#198b66\"></i>" : "<i class=\"fa fa-times-circle-o\" aria-hidden=\"true\" style=\"color:#ff0000\"></i>";
				$out .= '</td>';

				$out .= '</tr>';
			}
		}else{
			$out .= '<tr>';
			$out .= '<td colspan="4">';
			$out .= 'მონაცემები ვერ მოიძებნა !';
			$out .= '</td>';
			$out .= '</tr>';
		}
		return $out;

	}
}
?>