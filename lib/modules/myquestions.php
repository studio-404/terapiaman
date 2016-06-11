<?php
class lib_modules_myquestions{
	public $countall; 

	public function ques($c){
		$lib_database_myquestions = new lib_database_myquestions();
		$select = json_decode($lib_database_myquestions->select($c),true);

		$out = '';
		if(!empty($select)){
			foreach ($select as $v) {
				$this->countall = $v['countall'];
				$out .= '<tr>';
				$out .= '<td>';
				$out .= $v['id'];
				$out .= '</td>';
				
				$out .= '<td>';
				$out .= $v['question'];
				$out .= '</td>';

				$out .= '<td>';
				$out .= '<a href="'.$c['website.base'].'კითხვა-პასუხი/'.$v['id'].'">გადასვლა</a>';
				$out .= '</td>';

				$out .= '</tr>';
			}
		}else{
			$out .= '<tr>';
			$out .= '<td colspan="3">';
			$out .= 'მონაცემები ვერ მოიძებნა !';
			$out .= '</td>';
			$out .= '</tr>';
		}
		return $out;

	}
}
?>