<?php

require '../ressources/config.php';

class Admin_Config{
	
	private static $instance;
	
	private $paths;
	private $css;
	private $js;
	private $img;
	
	private $titles;
	
	private $queries;
	private $songs;
	private $artists;
	
	private $paramArtist;
	private $paramArtistId;
	private $paramSongId;
	private $paramLetter;
	
	private function __construct(){
		
		//paths
		$this->css = ADMIN_SITE_ROOT . "/css";
		$this->js = ADMIN_SITE_ROOT . "/js";
		//$this->titles = $this->mainConfig->get_url("baseUrl") . admin/content/titles.php;
		
		$this->paths = array(css	 => $this->css,
							 js		 => $this->js,
							 );
		
		//queries
		$this->queries = array("SongsPerArtistName" 		=> "SELECT Artist.artist_name, Song.title 
																FROM publevieux_dev.Song 
																INNER JOIN publevieux_dev.Artist
																ON Song.fk_id_artist = Artist.id_artist
																WHERE Artist.artist_name = '" . $this->get_paramArtist() . "';",
							   "SongsPerArtistId	" 		=> "SELECT Artist.artist_name, Song.title
																FROM publevieux_dev.Song
																INNER JOIN publevieux_dev.Artist
																ON Song.fk_id_artist = Artist.id_artist
																WHERE Artist.id_artist = '" . $this->get_paramArtistId() . "';",
							   "Artists"					=> "SELECT DISTINCT Artist.artist_name FROM publevieux_dev.Artist ORDER BY Artist.artist_name ASC LIMIT 10;");
		
		
	}
	
	public static function get_Instance()
	{
		$firephp = FirePHP::getInstance(true);
		$firephp->log('Inside getInstance');
		if (is_null(self::$instance)){
			$firephp->log('First Get Instance (self is null)');
			self::$instance = new Admin_Config();
		}
		$firephp->log('instance: ' . print_r(self::$instance,true));
		return self::$instance;
		
	}
	
	public function generate_query($queryName)
	{
		switch (strtolower($queryName))
		{
			case 'songsperartistname' :
				if (isset($this->paramArtist))
				{
					return "SELECT Artist.artist_name, Song.title, Song.langue 
							FROM publevieux_dev.Song 
							INNER JOIN publevieux_dev.Artist
							ON Song.fk_id_artist = Artist.id_artist
							WHERE Artist.artist_name = '" . $this->get_paramArtist() . "';";
				}
			case 'songsperartistid' :
				if (isset($this->paramArtistId))
				{
					return "SELECT Song.id_song, Song.title, Song.langue, Song.date_added, Song.date_modified
							FROM publevieux_dev.Song
							INNER JOIN publevieux_dev.Artist
							ON Song.fk_id_artist = Artist.id_artist
							WHERE Artist.id_artist = '" . $this->get_paramArtistId() . "';";
				}
			case 'artistsbyletter' :
				if (isset($this->paramLetter))
				{
					return "SELECT Artist.id_artist, Artist.artist_name
						FROM publevieux_dev.Artist
						WHERE Artist.artist_name 
						LIKE '" . $this->get_paramLetter() . "%';";
				}
			case 'artistbyid' :
				if (isset($this->paramArtistId))
				{
					return "SELECT Artist.id_artist, Artist.artist_name, Artist.date_added, Artist.date_modified
					FROM publevieux_dev.Artist
					WHERE Artist.id_artist = '" . $this->get_paramArtistId() . "';"; 
				}
			case 'songperid' :
				if (isset($this->paramSongId))
				{
					return "SELECT Song.id_song, Song.title, Song.date_added, Song.date_modified, Song.langue
					FROM publevieux_dev.Song
					WHERE Song.id_song = '" . $this->get_paramSongId() . "';";
				}
						
				
		}
	}
	
	public function generate_update($updateName)
	{
		switch (strtolower($updateName))
		{
			case 'artist' :
				if (isset($this->paramArtist) && isset($this->paramArtistId))
				{
					return "CALL updateArtist('" . $this->paramArtist . "', '" . $this->paramArtistId . "')";
				}
		}
	}
	
	public function set_paramArtist($param)
	{
		$this->paramArtist = $param;
	}
	
	public function get_paramArtist()
	{
		return $this->paramArtist;
	}
	
	public function set_paramNewArtist($param)
	{
		$this->paramNewArtist = $param;
	}
	
	public function get_paramNewArtist()
	{
		return $this->paramNewArtist;
	}
	
	public function set_paramArtistId($param)
	{
		$this->paramArtistId = $param;
	}
	
	public function get_paramArtistId()
	{
		return $this->paramArtistId;
	}

	public function set_paramSongId($param)
	{
		$this->paramSongId = $param;
	}
	
	public function get_paramSongId()
	{
		return $this->paramSongId;
	}
	
	public function set_paramLetter($param)
	{
		$this->paramLetter = $param;
	}
	
	public function get_paramLetter()
	{
		return $this->paramLetter;
	}
	
	public function get_path($pathName){
		return $this->paths[$pathName];
	}
	
	public function get_query($queryName){
			return $this->queries[$queryName];
	}

}
/*
include '../ressources/config.php';
$adminConfig = array(
		"paths" => array(
				"css" => $mainConfig["urls"]["baseUrl"] . "admin/css",
				"js" => $mainConfig["urls"]["baseUrl"] . "admin/js",
				"img" => array(
						"content" => $_SERVER["DOCUMENT_ROOT"] . "admin/img/content",
						"layout" => $_SERVER["DOCUMENT_ROOT"] . "admin/img/layout"
				),
				"titles" => $_SERVER["DOCUMENT_ROOT"] . "admin/content/titles.php",
		), 
		
		"queries" => array(
					"Song" => "SELECT Artist.artist_name, Song.title FROM publevieux_dev.Song INNER JOIN publevieux_dev.Artist ON Song.fk_id_artist = Artist.id_artist;",
					"Artists" => "SELECT DISTINCT Artist.artist_name FROM publevieux_dev.Artist ORDER BY Artist.artist_name ASC LIMIT 10;"
				
				
		),
		
		"titles" => array(
				"songManager.php" => "Song Manager"
		
		)
);

*/
?>