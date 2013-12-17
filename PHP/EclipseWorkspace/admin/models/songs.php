<?php
/**
 * The Songs Model does the back-end heavy lifting for the Songs Controller
 */
class Songs_Model
{
    /**
     * Holds instance of database connection
     */
    private $db;
    
    public function __construct()
    {
        $this->db = new MysqlImproved_Driver;
    }

    /**
     * Fetches article based on supplied name
     * 
     * @param string $artist
     * 
     * @return array $song
     */
    public function get_songs($artistId)
    {        
        //connect to database
        $this->db->connect();
    	
        //sanitize data
   		$artist = $this->db->escape($artistId);

   		$admCfg = Admin_Config::get_Instance();
   		$admCfg->set_paramArtistId($artistId);

   		
        //prepare query
        $this->db->prepare
        (
        	
        	$admCfg->generate_query('songsperartistid')
        
        );
        
    	//execute query
        $this->db->query();
    
        $song = $this->db->fetch('array');
        return $song;
    }
    
    public function get_song($songId)
    {
    	//connect to database
    	$this->db->connect();
    	 
    	//sanitize data
    	$artist = $this->db->escape($songId);
    
    	$admCfg = Admin_Config::get_Instance();
    	$admCfg->set_paramSongId($songId);
    
    	 
    	//prepare query
    	$this->db->prepare
    	(
    			 
    			$admCfg->generate_query('songperid')
    
    	);
    
    	//execute query
    	$this->db->query();
    
    	$song = $this->db->fetch('array');
    	return $song;
    }
}
?>