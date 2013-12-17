<?php 	
	$admCfg = Admin_Config::get_Instance(); 
	$mainCfg = Main_Config::get_Instance();
	$jQueryUrl = $mainCfg->get_url("jQuery");
	$jQueryUIUrl = $mainCfg->get_url("jQueryUI");
	$jQueryUICSSUrl = $mainCfg->get_url("jQueryUICSS");
	$jSonUrl = $mainCfg->get_url("jSon");
	$jSonParseUrl = $mainCfg->get_url("jSonParse");
	$jSonParseStateUrl = $mainCfg->get_url("jSonParseState");
	$utilsUrl = $mainCfg->get_url("utils");
	
	//var_dump($jQuery);
	$cssPath = $admCfg->get_path("css");
	$jsPath = $admCfg->get_path("js");
	
?>

<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title></title>
<script type="text/javascript" src="<?php echo $jQueryUrl?>"></script>
<script type="text/javascript" src="<?php echo $jQueryUIUrl?>"></script>
<script type="text/javascript" src="<?php echo $utilsUrl?>"></script>
<script type="text/javascript" src="<?php echo $jsPath . "/songManager.js"?>"></script>
<script type="text/javascript" src="<?php echo $jSonUrl?>"></script>
<script type="text/javascript" src="<?php echo $jSonParseUrl?>"></script>
<script type="text/javascript" src="<?php echo $jSonParseStateUrl?>"></script>
<link href="<?php echo $cssPath . "/songManager.css"?>" type="text/css" rel="stylesheet">
<link href="<?php echo $jQueryUICSSUrl?>" type="text/css" rel="stylesheet">
</head>
<body>

<div name="loginInfo" class="centerBox">
<p>Login : </p>
</div>
<div class="centerBox">
<div id="radio">

    <input type="radio" id="LoginManager" name="radio"><label for="LoginManager">Login Manager</label>

    <input type="radio" id="KaraokeManager" name="radio"><label for="KaraokeManager">Karaoke Manager</label>

    <input type="radio" id="SongManager" name="radio"><label for="SongManager">Song Manager</label>

<script>

$( "#radio" ).buttonset();

$("#LoginManager").click(function( event ) {
	alert("Login Manager!");
	//event.preventDefault();
	
	});

$("#KaraokeManager").click(function( event ) {
	alert("Karaoke Manager!");
	//event.preventDefault();
	
	});

$("#SongManager").click(function( event ) {
	//alert("Song Manager!");
	//event.preventDefault();
	window.location = "index.php?songManager";
	
	});

</script>

</div>	
</div>

<?php

?>