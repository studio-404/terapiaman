<?php
class lib_modules_questioninside{
	public function q($c, $qid){
		$lib_database_qa = new lib_database_qa(); 
		$quesion = json_decode($lib_database_qa->select_one($c, $qid),true); 
		// echo '<pre>';
		// print_r($quesion); 
		// echo '</pre>';
		$out = '<h4 class="media-heading">'.date("d/m/Y",$quesion['date']).' | '.$quesion['usersName'].'</h4>';
		$out .= '<p>'.strip_tags($quesion['question']).'</p>';
		$out .= '<div class="actions-box">';
		$out .= '<a href=""><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;პასუხის მიწერა</a>';
		$out .= '<a href=""><i class="fa fa-gavel" aria-hidden="true"></i>&nbsp;&nbsp; გასაჩივრება</a>';
		$out .= '<a href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp; წაშლა</a>';
		$out .= '</div>';
		return $out;
	}	
}
?>