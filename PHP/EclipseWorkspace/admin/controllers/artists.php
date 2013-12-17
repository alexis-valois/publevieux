<?php
$firephp = FirePHP::getInstance(true);
/**
 * This file handles the retrieval and serving of news articles
 */
class Artists_Controller
{
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'artists';

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main(array $getVars, array $postVars)
	{
		$artistsModel = new Artists_Model;
		
		$letter = $getVars['letter'];
		$artistId = $getVars['artistId'];
		//$updatedArtist = $_POST['updatedArtist'];
				
		//$firephp->log('Post/updateArtist arg: ' . $updatedArtist);
		
		if ($letter != null){
			$artists = $artistsModel->get_artists($letter);
		}
		
		
		//var_dump($getVars['letter']);
		
		if($artistId != null){
			$artist = $artistsModel->get_artist($artistId);
		}
		
		//var_dump($getVars['artistId']);
		
		if($updatedArtist != null){
			//$artistsModel->updated_artist($updatedArtist);
			//var_dump($updatedArtist);
			//echo "POST contains updatedArtist";
		}
		
		
		$master = new View_Model($this->template);
		
		$header = new View_Model('header');
		$rightPanel = new View_Model('rightPanel');
		$footer = new View_Model('footer');
		
		$master->assign('header', $header->render(FALSE));
		$master->assign('rightPanel', $rightPanel->render(FALSE));
		$master->assign('footer', $footer->render(FALSE));
		
		//assign article data to view
		$master->assign('artists' , $artists);
		$master->assign('artist' , $artist);
		
		$master->render();
		//this is a test , and we will be removing it later
		/*
		  
		print "We are in Songs!";
		print '<br/>';
		$vars = print_r($getVars, TRUE);
		print
		(
				"The following GET vars were passed to this controller:" .
				"<pre>".$vars."</pre>"
		);
		
		*/
	}
}

?>