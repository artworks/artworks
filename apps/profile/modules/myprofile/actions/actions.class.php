<?php

/**
 * myprofile actions.
 *
 * @package    artworks
 * @subpackage myprofile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myprofileActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
   // $this->forward('default', 'module');
   $this->form = new CustomersProfileForm(Doctrine::getTable('Customers')->findOneByIdCustomers($this->getUser()->getUserId()));
   
  }
}
