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



	public function executeUpdate(sfWebRequest $request)
	{

		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($data = Doctrine::getTable('Customers')->findOneByIdcustomers($this->getUser()->getUserId()));

		$form_type    = $request->getPostParameter('form_type');
		$submit       = $this->processForm($request, new $form_type($data,array('sf_user'=>$this->getUser())));

		$this->setTemplate("index");

	}


	/**
	 * Executes logout action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeLogOut(sfWebRequest $request)
	{
		$this->getUser()->setAuthenticated(false);
		$this->redirect('@homepage');
	}


	/**
	 * Executes processForm which post a form
	 *
	 * @param sfRequest $request A request object
	 * @param sfForm $form A form object
	 *
	 */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{

		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$form->save();
			$this->redirect('@homepage');

		}
		else{
			foreach ($form->getErrorSchema() as $field => $error)
			{
				$errors[$field] =  stripslashes($error);
			}
			return  $errors;
		}

	}
}
