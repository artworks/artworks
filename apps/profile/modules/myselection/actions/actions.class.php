<?php

/**
 * myselection actions.
 *
 * @package    artworks
 * @subpackage myselection
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myselectionActions extends sfActions
{
 /**
  * Executes list action
  * 
  * list all selection by cat
  *
  * @param sfRequest $request A request object
  */
  public function executeList(sfWebRequest $request)
  {
  	$customers = Doctrine::getTable("Customers")->findOneBy("idcustomers", $this->getUser()->getUserId());
	$this->photos =  $customers->getMySelectionQuery(1)->execute();
	$this->pictures =  $customers->getMySelectionQuery(2)->execute();
   // $this->forward('default', 'module');
  }
  
 /**
  * Executes DeleteFromMySelection action
  * 
  * delete an item from my selection
  *
  * @param sfRequest $request A request object
  */
  public function executeDeleteFromMySelection(sfWebRequest $request)
  {

  	$basket = Doctrine::getTable("Basket")->deleteFromSelection(
  		$request->getParameter('idartworks'),
  		$this->getUser()->getUserId(),
  		$request->getParameter('basket_status'));

  	$isAjax = $this->getRequest()->isXmlHttpRequest();
		if($isAjax){ $this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');}
		else       { $this->getResponse()->setHttpHeader('Content-Type','text/plain; charset=utf-8');}
		
  	return $this->renderText(json_encode(array('status'=>'success')));
  		
   // $this->forward('default', 'module');
  }
}
