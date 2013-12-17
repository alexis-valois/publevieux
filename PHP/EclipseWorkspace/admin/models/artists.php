<?php
/**
 * The Songs Model does the back-end heavy lifting for the Songs Controller
 */
class Artists_Model
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
     * @param string $letter
     * 
     * @return array $artists
     */
    public function get_artists($letter)
    {        
        //connect to database
        $this->db->connect();
    	
        //sanitize data
   		$letter = $this->db->escape($letter);

   		$admCfg = Admin_Config::get_Instance();
   		$admCfg->set_paramLetter($letter);

   		
        //prepare query
        $this->db->prepare
        (
        	
        	$admCfg->generate_query('artistsbyletter')
        	
        );
        //var_dump($this->db->get_query());
    	//execute query
        $this->db->query();
    
        $artists = $this->db->fetch('array');
        //var_dump($artists);
        return $artists;
    }
    
    public function update_artist($arrayArtist){
    	//connect to database
    	$this->db->connect();
    	
    	//$artistEntity = new Artist_Entity($arrayArtist['id_artist'], $arrayArtist['name']);
    	//sanitize data
    	
    	$updatedName = $this->db->escape($arrayArtist['artist_name']);
    	$updatedId = $this->db->escape($arrayArtist['id_artist']);
    	
    	$firephp = FirePHP::getInstance(true);
    	$firephp->log('updatedName : ' . $updatedName);
    	$firephp->log('updatedId : ' . $updatedId);
    	
    	//$firephp->log('$arrayArtist : ' . $arrayArtist);
    	//var_dump($id);
    	
    	$admCfg = Admin_Config::get_Instance();
    	$admCfg->set_paramArtistId($updatedId);
    	$admCfg->set_paramArtist($updatedName);
    	
    	$firephp->log('Before prepare, generate_update value: ' . $admCfg->generate_update('artist'));
    	//prepare query
    	$this->db->prepare
    	(    	
    			$admCfg->generate_update('artist')
    	
    	);
    	
    	$firephp->log('update_artist --> ' . $this->db->get_query());
    	//var_dump($this->db->get_query());
    	//execute query
    	$firephp->log('Query Result: ' . $this->db->query());
    	
    	//$artist = $this->db->fetch('array');
    	//var_dump($artists);
    	//return $artist;
    }
    
    public function get_artist($id)
    {
    	//connect to database
    	$this->db->connect();
    	 
    	//sanitize data
    	$id = $this->db->escape($id);
    	//var_dump($id);
    
    	$admCfg = Admin_Config::get_Instance();
    	$admCfg->set_paramArtistId($id);
    
    	 
    	//prepare query
    	$this->db->prepare
    	(
    			 
    			$admCfg->generate_query('artistbyid')
    			 
    	);
    	//var_dump($this->db->get_query());
    	//execute query
    	$this->db->query();
    
    	$artist = $this->db->fetch('array');
    	//var_dump($artists);
    	return $artist;
    }
}
?>