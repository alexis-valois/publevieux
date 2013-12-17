<?php

/**
 * This file handles the retrieval and serving of news articles
 */
class Index_Controller
{
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'index';
	private $title = "Page d'Accueil";

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main(array $getVars, array $postVars)
	{
		$firephp = FirePHP::getInstance(true);

		//$firephp->log('Inside Index_Controller Main');
		//create a new view and pass it our template
		$master = new View_Model($this->template);
		
		
		$header = new View_Model('header');
		$rightPanel = new View_Model('rightPanel');
		$footer = new View_Model('footer');
		
		//$firephp->log('header is set and not null ? : ' . isset($header));
		//$firephp->log('rightPanel is set and not null ? : ' . isset($rightPanel));
		//$firephp->log('footer is set and not null ? : ' . isset($footer));
		
		//$firephp->log('Toute les vues créées pour Index');
		
		$master->assign('header', $header->render(FALSE));
				
		//$firephp->log('Après premier assign');
		
		$master->assign('rightPanel', $rightPanel->render(FALSE));
		$master->assign('footer', $footer->render(FALSE));
		$master->assign('title', $title);
		
		//$firephp->log('Tout les assign complété. Juste avant render()');
		$master->render();
	}
}

?>