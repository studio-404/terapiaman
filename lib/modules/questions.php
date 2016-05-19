<?php
class lib_modules_questions{
	public $countall = 0;
	public function ques($c){
		$lib_database_qa = new lib_database_qa(); 
		$json = json_decode($lib_database_qa->questions($c),true);
		$this->countall = $lib_database_qa->countall;
		$out = '';
		$this->countall = $json[0]['countall']; 
		foreach ($json as $v) {
			$out .= '<a href="'.$c["website.base"].'კითხვა-პასუხი/'.$v['q_id'].'" class="question-box">';
	  		$out .= '<meta itemprop="datePublished" content="'.date("d/m/Y", $v['q_date']).'">';
	  		$out .= '<meta itemprop="author" content="'.htmlentities($v['u_namelname']).'">';
	   		$out .= '<h4 class="media-heading">'.htmlentities($v['u_namelname']).' | '.date("d/m/Y g:i:s", $v['q_date']).'</h4>';
	   		$out .= '<p itemprop="name text">'.strip_tags($v['q_question']).'</p>';
	   		$out .= '<p class="nounderline"># '.$v['q_id'].'</p>';
	   		if($v['answer_counts']>0){
	   			$out .= '<p class="nounderline"><i class="fa fa-comments" aria-hidden="true"></i> '.$v['answer_counts'].'</p>';
	   		}else{
	   			$out .= '<p class="nounderline"><i class="fa fa-comments-o" aria-hidden="true"></i> '.$v['answer_counts'].'</p>';
	   		}
    		$out .= '<p class="nounderline"><i class="fa fa-eye" aria-hidden="true"></i> 20</p>';
			$out .= '</a>';
		}
		return $out; 
	}
}
?>