<?php

/**
 * artwork actions.
 *
 * @package    artworks
 * @subpackage artwork
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class artworkActions extends sfActions
{
	/**
	 * Executes view action
	 *
	 * show an article
	 * example : HOST/:sf_culture/artwork/:id
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeView(sfWebRequest $request)
	{
		$this->forward404Unless($data = $this->getRoute()->getObject());
		$this->artwork = $data;
		//  $this->forward('default', 'module');
	}

	/**
	 * Executes AddToSelection action
	 *
	 * show an article
	 * example : HOST/:sf_culture/artwork/:id
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeAddToSelection(sfWebRequest $request)
	{

		if($this->getUser()->isAuthenticated()){
			$userId = $this->getUser()->getUserId();
			$idArtworks = $request->getParameter('idartworks');
			$basketStatus = $request->getParameter('bastket_status');
			$isAjax = $this->getRequest()->isXmlHttpRequest();
			if($isAjax){ $this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');}
			else       { $this->getResponse()->setHttpHeader('Content-Type','text/plain; charset=utf-8');}


			if (!Doctrine::getTable('Basket')->isBasketSelectionDuplicate(
			$idArtworks,
			$userId,
			$basketStatus
			)){
				$basket = new Basket();
				$basket->setFkidartworksfrombasket($idArtworks);
				$basket->setFkidcustomersfrombasket($userId);
				$basket->setFkidbasketStatus($basketStatus);
				$basket->save();
				return $this->renderText(json_encode(array('status'=>'success')));
			}
			else {
				return $this->renderText(json_encode(array('status'=>'allready_selected')));
			}
		}
		else{
			if($request->hasParameter('nav')){
				$this->navCache = new NavCache($request->getParameter('nav'));
			}
			else{
				$this->navCache = new NavCache();				
			}
		}


	}



}
