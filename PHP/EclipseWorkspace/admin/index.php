<?php

/**
 * Define document paths
 */

define('ADMIN_SERVER_ROOT', 'C:\Users\Alexis\Documents\PubLeVieux\svnShare\publevieux\web\PHP\EclipseWorkspace\admin');
define('SERVER_ROOT', 'C:\Users\Alexis\Documents\PubLeVieux\svnShare\publevieux\web\PHP\EclipseWorkspace');
define('ADMIN_SITE_ROOT','http://localhost/admin');
define('BASE_URL', 'http://localhost/');

include SERVER_ROOT . '/ressources/library/FirePHPCore/' . 'FirePHP.class.php';
include SERVER_ROOT . '/ressources/library/FirePHPCore/' . 'fb.php';

require_once(ADMIN_SERVER_ROOT . '/controllers/' . 'router.php');


//if(!@include(SERVER_ROOT . '/FirePHPCore/' . 'FirePHP.class.php')) echo "Failed to include 'FirePHP.class.php' <br />" ;
//if(!@include(SERVER_ROOT . '/FirePHPCore/' . 'fb.php')) echo "Failed to include 'fb.php'<br />";

$filename = SERVER_ROOT . '/ressources/library/FirePHPCore/' . 'FirePHP.class.php';

if (is_readable($filename)) {
	//echo "The file '" . $filename . "' is readable<br />";
} else {
	echo "The file '" . $filename . "' is NOT readable<br />";
}

$filename = SERVER_ROOT . '/ressources/library/FirePHPCore/' . 'fb.php';

if (is_readable($filename)) {
	//echo "The file '" . $filename . "' is readable<br />";
} else {
	echo "The file '" . $filename . "' is NOT readable<br />";
}

/*
//Include des configurations propres � la section admin
require 'config.php';

//Include des headers HTML et d�finition du titre de la page
include 'template/header.php';

//Include de la partie centrale
include 'content/songManager.php';

$smgr = new songManager();

//Include de la termination du body et du html
include 'template/footer.php'
*/
?>
