<?php
/**
 * The Songs Model does the back-end heavy lifting for the Songs Controller
 */
class SongManager_Model
{
    /**
     * Holds instance of database connection
     */
    //private $db;
    
	/*
    public function __construct()
    {
        $this->db = new MysqlImproved_Driver;
    }
    */
	
    /**
     * Fetches article based on supplied name
     * 
     * @param string $artist
     * 
     * @return array $song
     */
	/*
	public function update_Artist($artistJSON)
    {        
        //connect to database
        $this->db->connect();
    	
        
   		$artist = json_decode($artistJSON); 
        $admCfg = Admin_Config::get_Instance();   		
   		$admCfg->set_paramArtistId($artist[0]);
   		$admCfg->set_paramArtist($artist[1]);

   		
        //prepare query
        $this->db->prepare
        (
        	
        	$admCfg->generate_update('artist')
        
        );
        
    	//execute query
        $this->db->query();
    
        //$song = $this->db->fetch('array');
        //return $song;
    }
    */
    
}
?>