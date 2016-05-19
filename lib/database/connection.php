<?php 
class lib_database_connection{
	public $HANDLER;

	public function conn($c){
		try{
			$host = 'mysql:host=127.0.0.1;dbname='.$c["database.name"].';charset=UTF8'; 
			$this->HANDLER = new PDO($host,$c["database.user"],$c["database.pass"]); 
			$this->HANDLER->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->HANDLER->exec("set names UTF8"); 
		}catch(PDOException $e){
			die("Sorry, Database connection problem.."); 
		}
		return $this->HANDLER;
	}

}
?>