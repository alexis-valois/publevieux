<?php
/**
 * The MySQL Improved driver extends the Database_Library to provide
 * interaction with a MySQL database
 */
class MysqlImproved_Driver extends Database_Library
{
	/**
	 * Connection holds MySQLi resource
	 */
	private $connection;

	/**
	 * Query to perform
	 */
	private $query;

	/**
	 * Result holds data retrieved from server
	 */
	private $result;

	/**
	 * Create new connection to database
	 */
	public function connect()
	{
		$firephp = FirePHP::getInstance(true);
		
		//connection parameters
		$host = '127.0.0.1';
		$user = 'publevieux_dev';
		$password = 'publevieux_dev';
		$database = 'publevieux_dev';

		//your implementation may require these...
		$port = 3306;
		$socket = NULL;

		//create new mysqli connection
		/*
		$this->connection = new mysqli
		(
				$host , $user , $password , $database , $port , $socket
		);
		*/
		$this->connection = mysqli_connect
		(
				$host , $user , $password , $database , $port , $socket
		);
		if (!$this->connection)
		{
			die('Could not connect: ' . mysqli_connect_error());
		}
		
		if (!mysqli_set_charset($this->connection, "utf8")){
			$firephp->log('Erreur en chargeant le caraterset à utf8.' . mysqli_error($this->connection));
		}else{
			$firephp->log('Characterset actuel : ' . mysqli_character_set_name($this->connection));
		}
		return TRUE;
	}

    /**
     * Break connection to database
     */
    public function disconnect()
    {
        //clean up connection!
        $this->connection->close();    
    
        return TRUE;
    }

    /**
     * Prepare query to execute
     * 
     * @param $query
     */
    public function prepare($query)
    {
    	$firephp = FirePHP::getInstance(true);
    	
        //store query in query variable
        $this->query = $query;    
        $firephp->log('Inside Prepare, after affectation');
        return TRUE;
    }
    
    public function get_query()
    {
    	return $this->query;
    }

    /**
     * Execute a prepared query
     */
    public function query()
    {
        if (isset($this->query))
        {
            //execute prepared query and store in result variable
            $this->result = $this->connection->query($this->query);
            return TRUE;
        }
    
        return FALSE;        
    }

    /**
     * Fetch a row from the query result
     * 
     * @param $type
     */
    public function fetch($type = 'object')
    {
        if (isset($this->result))
        {
            switch ($type)
            {
                case 'array':
            
                	while ($ligne = $this->result->fetch_array()){
                		 
                		//echo $ligne['title'] . " - ";
                		$rows[] =  $ligne;
                	}
                    //fetch a row as array
                    //$row = $this->result->fetch_array();
            
                break;
            	/*
                case 'object':
            
                //fall through...
            
                default:
                
                    //fetch a row as object
                    $row = $this->result->fetch_object();    
                    
                break;
                */
            }
        
            return $rows;
        }
    
        return FALSE;
    }
    
    /**
     * Sanitize data to be used in a query
     *
     * @param $data
     */
    public function escape($data)
    {
    	return $this->connection->real_escape_string($data);
    }
}
?>