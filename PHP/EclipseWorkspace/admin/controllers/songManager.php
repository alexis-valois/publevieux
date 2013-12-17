<?php

/**
 * This file handles the retrieval and serving of news articles
 */
class SongManager_Controller
{
	
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'SongManager';

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main(array $getVars, array $postVars)
	{
		$firephp = FirePHP::getInstance(true);
		
		$songMgr = new SongManager_Model;
		$artistsModel = new Artists_Model;
		
		$artistJSON = $postVars['updatedArtist'];
		$firephp->log('$artistJSON: ' . $artistJSON);
		//$firephp->log('test');
		
		if ($artistJSON != null){
			$arrayUpdatedArtist = json_decode($artistJSON, true);
			//$firephp->log('$arrayUpdatedArtist: ' . implode(",", $arrayUpdatedArtist));
			$firephp->log('$arrayUpdatedArtist: ' . print_r($arrayUpdatedArtist, true));
			$artistsModel->update_artist($arrayUpdatedArtist);
			//$firephp->log('$artistJSON Decoded: ' . json_decode($artistJSON));
		}
		
		
		//get an article
		//$song = $songsModel->get_song($getVars['artist']);
		
		//create a new view and pass it our template
		$master = new View_Model($this->template);
		
		
		$header = new View_Model('header');
		$rightPanel = new View_Model('rightPanel');
		$footer = new View_Model('footer');
		
		$master->assign('header', $header->render(FALSE));
		$master->assign('rightPanel', $rightPanel->render(FALSE));
		$master->assign('footer', $footer->render(FALSE));
		
		//assign article data to view
		//$master->assign('songs' , $song);
		
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