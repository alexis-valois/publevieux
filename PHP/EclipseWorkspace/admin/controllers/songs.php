<?php
/**
 * This file handles the retrieval and serving of news articles
 */
class Songs_Controller
{
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'songs';

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main(array $getVars, array $postVars)
	{
		$songsModel = new Songs_Model;
		
		$songId = $getVars['songId'];
		$artistId = $getVars['artistId'];
		
		if ($songId != null){
			$song = $songsModel->get_song($songId);
		}
				
		//var_dump($getVars['letter']);
		
		if($artistId != null){
			$songs = $songsModel->get_songs($artistId);
		}
		
		//get an article
		//$song = $songsModel->get_songs($getVars['artistId']);
		
		//create a new view and pass it our template
		$master = new View_Model($this->template);
		
		$header = new View_Model('header');
		$rightPanel = new View_Model('rightPanel');
		$footer = new View_Model('footer');
		
		$master->assign('header', $header->render(FALSE));
		$master->assign('rightPanel', $rightPanel->render(FALSE));
		$master->assign('footer', $footer->render(FALSE));
		
		//assign article data to view
		$master->assign('songs' , $songs);
		$master->assign('song' , $song);
		
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