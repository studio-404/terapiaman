<?php
class lib_functions_facebook{
	
	public function __construct(){
		require('lib/facebook-php-sdk/src/facebook.php');
		$this->facebook = new Facebook(array(
			'appId'  => '1999692500254945',
			'secret' => 'b1f2f79ce3bc49d37714d5eb597ca718' 
		));
	}

	public function generateGoToUrl($c){
		$loginUrl = $this->facebook->getLoginUrl(array(
		    'redirect_uri'=>'http://www.terapia.ge/callback/', 
		));
		return $loginUrl;
	}

	public function userInfo($c){
		$user = $this->facebook->getUser();
		
		if($user) {
		  try {
		    $user_profile = $this->facebook->api('/me');
		   	$lib_database_checkuser = new lib_database_checkuser(); 
		    if($lib_database_checkuser->check($c,$user_profile['id'])){
		    	// user exists and save session
		    	$lib_database_signin = new lib_database_signin(); 
		    	if($lib_database_signin->selectUserInfo($c, $user_profile['id'])){
		    		lib_functions_redirect::url($c['website.base']);
		    	}
		    }else{
		    	// insert new user data
		    	$lib_database_insertuser = new lib_database_insertuser(); 
		    	if($lib_database_insertuser->insertFbUser($c, $user_profile['id'], $user_profile['name'])){
		    		// user exists and save session
		    		$lib_database_signin = new lib_database_signin(); 
		    		if($lib_database_signin->selectUserInfo($c, $user_profile['id'])){
		    			lib_functions_redirect::url($c['website.base']);
		    		}
		    	}
		    }

		  } catch (FacebookApiException $e) {
		    lib_functions_redirect::url($c['website.base']);
		  }
		}else{
			lib_functions_redirect::url($c['website.base']);
		}
	}
}
?>