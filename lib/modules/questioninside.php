<?php
class lib_modules_questioninside{
	public $desc;
	public function q($c, $qid){
		$lib_database_qa = new lib_database_qa(); 
		$quesion = json_decode($lib_database_qa->select_one($c, $qid),true); 
		$this->desc = $quesion['question'];
		$usersName = ($quesion['anonimus']==2) ? "უცნობი" : $quesion['usersName'];
		$out = '<h4 class="media-heading">'.$usersName.' » '.date("d/m/Y H:m:s",$quesion['date']).'</h4>';
		$out .= '<p itemprop="name text">'.strip_tags($quesion['question']).'</p>';
		$out .= '<div class="actions-box">';
		$out .= '<a href="javascript:void(0);" class="replay-link" data-qid="'.$qid.'"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;პასუხის მიწერა</a>';
		$onoff = (isset($_SESSION[$c["session.prefix"]."id"]) ? "on" : "off");
		$out .= '<a href="javascript:void(0)" class="removeQuestion" data-qid="'.$qid.'" data-offon="'.$onoff.'"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp; წაშლა</a>';
		$out .= '</div>';
		return $out;
	}

	public function a($c,$qid){
		$lib_database_qa = new lib_database_qa(); 
		$answer = json_decode($lib_database_qa->select_answers($c, $qid),true); 
		$out = '';
		if(!empty($answer)){
			foreach ($answer as $v) {
				if($v['anonimus']==2 && $v['userType']!="administrator"){
					$usersName = "უცნობი";
				}else{
					$usersName = $v['usersName']; 
				}
				$out .= '<div class="media" id="i'.$v['id'].'" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">';
				$out .= '<div class="media-left" style="min-width:100px;">';
				$out .= '<div class="post-date">';
				$out .= '<div class="all">';
				$out .= '<span class="day">'.date("d", $v['date']).'</span>';
				$out .= '<span class="month">'.lib_functions_geomonthname::month(date("m", $v['date'])).'</span>';
				$out .= '<span class="year">'.date("Y", $v['date']).'</span>';
				$out .= '<span class="time">'.date("H:i", $v['date']).'</span>';
				$out .= '</div>';
				$out .= '</div>';
				$out .= '</div>';
				$out .= '<div class="media-body">';
				$out .= '<h4 class="media-heading">'.$usersName.'</h4>';
				$out .= '<p style="min-height:55px;" itemprop="text">'.$v['answer'].'</p>';
				$out .= '<div class="actions-box">';
				$onoff = (isset($_SESSION[$c["session.prefix"]."id"]) ? "on" : "off");
				$out .= '<a href="javascript:void(0)" class="removeAnswer" data-aid="'.$v['id'].'" data-offon="'.$onoff.'"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp; წაშლა</a>';
				$out .= '</div><div style="clear:both"></div>';
				$out .= '</div>';
				$out .= '</div><div style="clear:both"></div>';
			}
		}else{
			$out = '<div class="alert alert-danger" role="alert">* გთხოვთ დაელოდოთ ადმინისტრატორი შეძლებისდაგვარად მალე გიპასუხებთ !</div>';
		}
		return $out; 
	}	
}
?>