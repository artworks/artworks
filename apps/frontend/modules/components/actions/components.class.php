<?php

/**
 * components actions.
 *
 * @package    artworks
 * @subpackage components
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class componentsComponents extends sfComponents
{

  public function executeMenu(sfWebRequest $request)
  {
   // $this->forward('default', 'module');
  }
  
  public function executeBasket(sfWebRequest $request)
  {
    $customers = Doctrine::getTable("Customers")->findOneBy("idcustomers", $this->getUser()->getUserId());
	$this->photos =  $customers->getMySelectionQuery(1)->execute();
	$this->pictures =  $customers->getMySelectionQuery(2)->execute();
  }
}
