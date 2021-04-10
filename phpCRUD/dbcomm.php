<?php
class Dbcomm {

	//database credentials
	private $db_host = "localhost";
	private $db_name = "inventorizerdaw";
	private $db_user = "root";
	private $db_pass = "";
	public $comm;

	// retrieve a connection
	public function getConnection(){
		
		$this->comm = null;
		
		try {
			$this->comm = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, $this->db_user, $this->db_pass);
			$this->comm->exec("set names utf8");
		} catch(PDOException $exce) {
			echo "Connection failed: " . $exce->getMessage() ;
		}
		
		return $this->comm;
	}

}
?>