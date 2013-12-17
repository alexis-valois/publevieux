<?php
class database{
	
	private $dbname;
	private $username;
	private $password;
	private $host;
	
	public function __construct($pDbname, $pUsername, $pPassword, $pHost){
		$this->dbname = $pDbname;
		$this->username = $pUsername;
		$this->password = $pPassword;
		$this->host = $pHost; 
	}
	
	public function get_dbname() {
		return $this->dbname;
	}
	
	public function get_username() {
		return $this->username;
	}
	
	public function get_password() {
		return $this->password;
	}
	
	public function get_host() {
		return $this->host;
	}
}
?>