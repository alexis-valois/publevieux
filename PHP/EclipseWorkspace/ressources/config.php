<?php

require "/containers/database.php";

class Main_Config{
	
	private static $instance;
	
	private $devDB;
	private $tiDB;
	private $prodDB;
	
	private $baseUrl;
	private $urls;
	private $jQuery;
	private $jQueryUI;
	private $jQueryUICSS;
	private $jSonUrl;
	private $jSonParseUrl;
	private $jSonParseStateUrl;
	private $utils;
	
	private function __construct()
	{
		$jQuery = BASE_URL . "ressources/library/jquery-ui-1.10.0.custom/js/jquery-1.9.0.js";
		$jQueryUI = BASE_URL . "ressources/library/jquery-ui-1.10.0.custom/js/jquery-ui-1.10.0.custom.js";
		$jQueryUICSS = BASE_URL . "ressources/library/jquery-ui-1.10.0.custom/css/ui-lightness/jquery-ui-1.10.0.custom.css";
		$jSonParseUrl = BASE_URL .  "ressources/library/json/json_parse.js";
		$jSonUrl = BASE_URL . "ressources/library/json/json2.js";
		$jSonParseStateUrl = BASE_URL . "ressources/library/json/json_parse_state.js";
		$utils = BASE_URL . "ressources/library/utils.js";
		
		
		$this->urls = array("jQuery"		 =>		$jQuery,
							"jQueryUI"		 =>		$jQueryUI,
							"jQueryUICSS"    =>		$jQueryUICSS,
							"jSon"			 =>		$jSonUrl,
							"jSonParse"		 =>		$jSonParseUrl,
							"jSonParseState" =>		$jSonParseStateUrl,
							"utils" 		 =>		$utils);
		
		$this->dbname = "publevieux_dev";
		$this->username = "publevieux_dev";
		$this->password = "publevieux";
		$this->host = "localhost";
		
		$this->devDB = new database($dbname,$username,$password,$host);
		
		$this->dbname = "a3037766_ti";
		$this->username = "a3037766_ti";
		$this->password = "a3037766_ti";
		$this->host = "localhost";
		
		$this->tiDB = new database($dbname,$username,$password,$host);
		
		$this->dbname = "a3037766_karaoke";
		$this->username = "a3037766_usr";
		$this->password = "a3037766_usr";
		$this->host = "localhost";
		
		$this->prodDB = new database($dbname,$username,$password,$host);
		
	}
	
	public static function get_Instance()
	{
		if (is_null(self::$instance)){
			self::$instance = new Main_Config();
		}
		
		return self::$instance;
		
	}
	public function get_url($urlName){
		//var_dump($urlName);
		//var_dump($this->urls);
		return $this->urls[$urlName];
	}
	
	public function get_db($dbName){
		switch($dbName){
			case "devDB":
				return $this->devDB;
			case "tiDB":
				return $this->tiDB;
			case "prodDB":
				return $this->prodDB;
					
		}
	}
	
	
	
	/*
	var $mainConfig = array(
			"db" => array(
					"devDB" => array(
							"dbname" => "publevieux_dev",
							"username" => "publevieux_dev",
							"password" => "publevieux",
							"host" => "localhost"
					),
					
					"tiDB" => array(
							"dbname" => "a3037766_ti",
							"username" => "a3037766_ti",
							"password" => "a3037766_ti",
							"host" => "localhost"
					),
					
					"prodDB" => array(
							"dbname" => "a3037766_karaoke",
							"username" => "a3037766_usr",
							"password" => "a3037766_usr",
							"host" => "localhost"
					)
			),
			"urls" => array(
					//"baseUrl" => "http://publevieux.herobo.com"
					"baseUrl" => "http://localhost/",
					"jQuery" => "ressources/library/jquery-1.9.0.min.js"
			),
			"paths" => array(
					"resources" => "/path/to/resources",
					"images" => array(
							"content" => $_SERVER["DOCUMENT_ROOT"] . "/images/content",
							"layout" => $_SERVER["DOCUMENT_ROOT"] . "/images/layout"
					)
			)
	);
	*/
}
?>