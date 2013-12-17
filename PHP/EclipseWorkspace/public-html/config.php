<?php
include '../ressources/config.php';
$publicConfig = array(
		"paths" => array(
				"resources" => "/path/to/resources",
				"images" => array(
						"content" => $_SERVER["DOCUMENT_ROOT"] . "/img/content",
						"layout" => $_SERVER["DOCUMENT_ROOT"] . "/img/layout"
				)
		)
);

?>