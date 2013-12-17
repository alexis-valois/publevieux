<?php

require '../config.php';

class songManager{
	
	private $adminConfig;
	
	public function __construct(){
		
		$adminConfig = new adminConfig();
		
		$this->dbconnect();
	}
	
	private function dbconnect(){
		$db = $this->adminConfig->get_mainConfig()->get_db("devDB");
		
		$host = $db->get_host();
		$uName = $db->get_username();
		$psw = $db->get_password();
		$dbname = $db->get_dbname();
		
		echo "Hostname : " . $host . nl2br("\r\n",false);
		echo "User Name : " . $uName . nl2br("\r\n",false);
		echo "Password : " . $psw . nl2br("\r\n",false);
		echo "Database Name : " . $dbname . nl2br("\r\n",false);
	}
	
	private function dbclose(){
		
	}
	
	private function dbquery($query){
		
	}
	//coprs du document
	/*
	echo nl2br("Dev Database Name : \r\n", false);
	echo nl2br($mainConfig['db']['devDB']['dbname'] ."\r\n",false);
	*/

	/*
	$host = $mainConfig["db"]["devDB"]["host"];
	$uName = $mainConfig["db"]["devDB"]["username"];
	$psw = $mainConfig["db"]["devDB"]["password"];
	$h_dbname = $mainConfig["db"]["devDB"]["dbname"];
	*/
	/*	
	echo "Hostname : " . $host . nl2br("\r\n",false);
	echo "User Name : " . $uName . nl2br("\r\n",false);
	echo "Password : " . $psw . nl2br("\r\n",false);
	echo "Database Name : " . $h_dbname . nl2br("\r\n",false);
	*/
	/*
	$con = mysqli_connect($host,$uName,$psw, $dbName);
	if (!$con)
	{
		die('Could not connect: ' . mysqli_connect_error());
	}
	//echo nl2br("Connexion réussit .\r\n",false);
	
	$songsQuery = $adminConfig["queries"]["Song"];
	$artistQuery = $adminConfig["queries"]["Artists"];
	
	$result = mysqli_query($con,$artistQuery);
	
	while($row = mysqli_fetch_array($result))
	{
		echo $row["artist_name"] . nl2br("\r\n",false);
	}
	

	/*
	//if ($result = mysqli_query($con, "SELECT * FROM publevieux_dev.song;")) {
	//	echo "Select returned %d rows.\n", mysqli_num_rows($result);
	

	//	mysqli_free_result($result);
	}
	*/
	
	//mysqli_close($con);
	
}
?>
