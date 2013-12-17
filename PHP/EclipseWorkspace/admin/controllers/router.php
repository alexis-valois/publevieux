<?php
$firephp = FirePHP::getInstance(true);
//$firephp->log('Hello World');
//Automatically includes files containing classes that are called
function __autoload($className)
{  
	$exceptionArray = array (
				"FirePHP",
				"FB"
			);
	//var_dump(!(in_array($className, $exceptionArray)));
	if (!(in_array($className, $exceptionArray))){

	    // Parse out filename where class should be located
	    // This supports names like 'Example_Model' as well as 'Example_Two_Model'
	    list($suffix, $filename) = preg_split('/_/', strrev($className), 2);
	    $filename = strrev($filename);
	    $suffix = strrev($suffix);
	    
	       
	    //select the folder where class should be located based on suffix
	    switch (strtolower($suffix))
	    {    
	        case 'model':
	        
	            $folder = '/models/';
	        
	        break;
	    
	        case 'library':
	    
	            $folder = '/lib/';
	        
	        break;
	    
	        case 'driver':
	    
	            $folder = '/lib/drivers/';
	    
	        break;
	        
	        case 'config':
	        
	        	$folder = '/';
	        	$filename = '/config';
	        break;
	        
	        case 'entity':
	        	$folder = '/entities/';
	        	
	        break;
	        
	    }
	
	    //compose file name
	    $file = ADMIN_SERVER_ROOT . $folder . strtolower($filename) . '.php';
	
	    //fetch file
	    if (file_exists($file))
	    {
	        //get file
	        include_once($file);        
	    }
	    else
	    {
	        //file does not exist!
	        die("File '$filename' containing class '$className' not found in
	'$folder'.");    
	    }
    
	}
}

//fetch the passed request
$request = $_SERVER['QUERY_STRING'];
//$postArgs = $_POST['updatedArtist'];

//$firephp->log('Post/updateArtist arg: ' . $postArgs);

$post = $_POST;

$string = file_get_contents("php://input");
$firephp->log('php://input --> ' . $string);
$firephp->log('$post --> ' . print_r($post, true));

if ($request == null){
	$page = "index";
}else{
	//parse the page request and other GET variables
	$parsedGetVars = explode('&' , $request);
	
	$page = array_shift($parsedGetVars);
}

$postVars = array();
if ($post != null){
	foreach ($post as $key => $value)
	{
		$postVars[$key] = urldecode($value);
		$firephp->log('$key --> ' . $key);
		$firephp->log('$value --> ' . $value);
	}
}




//the rest of the array are get statements, parse them out.
$getVars = array();
foreach ($parsedGetVars as $argument)
{
	//split GET vars along '=' symbol to separate variable, values
	list($variable , $value) = split('=' , $argument);
	$getVars[$variable] = urldecode($value);
}


//compute the path to the file
$target = ADMIN_SERVER_ROOT . '/controllers/' . $page . '.php';

//get target
if (file_exists($target))
{
	//$firephp->log('Got inside file_exists with file: ' . $target);
    include_once($target);
  
    //modify page to fit naming convention
    $class = ucfirst($page) . '_Controller';
	
    //instantiate the appropriate class
    if (class_exists($class))
    {
    	//$firephp->log('Got inside class_exists with class: ' . $class);
        $controller = new $class;
        //$firephp->log('Controller:' . $controller);
       // $firephp->log('After controller creation, controller is set and not null ? : ' . isset($controller));
    }
    else
    {
        //did we name our class correctly?
        die('class does not exist!');
    }
}
else
{
    //can't find the file in 'controllers'! 
    die('page does not exist!');
}

//once we have the controller instantiated, execute the default function
//pass any GET varaibles to the main method
//$firephp->log('Just before the call to the main method of Controller:' . $controller);
//$firephp->log('Before controller->main');
$firephp->log('getVars:' . $getVars);
$firephp->log('postVars:' . $postVars);
$controller->main($getVars, $postVars);
//$firephp->log('After controller->main');

?>