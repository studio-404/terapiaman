<?php
class lib_functions_sendemail{
	public function init($c, $to, $subject, $message){
		$this->from = $c["server.email.address"];
		$this->cc = $c["server.email.address.cc"];
		if(is_array($to)){
			$this->to = implode(", ", $to);
		}else{
			$this->to = $to;
		}		
		$this->subject = $subject;
		$this->message = $message;

		if($this->send()){
			return true;
		}
		return false;
	}
	public function send(){
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8\r\n";
		$headers .= "From: <" . $this->from . ">\r\n";
		$headers .= "Cc: " . $this->cc . "\r\n";
		if(mail($this->to,$this->subject,$this->message,$headers)){
			return true;
		}
		return false;
	}
}
?>