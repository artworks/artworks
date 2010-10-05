<?php

/**
 * homepage actions.
 *
 * @package    artworks
 * @subpackage homepage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homepageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->form = new SignInForm();
  }
  
  

  public function executeSignin(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->form = new SignInForm();
  	$submit       = $this->processForm($request, $this->form);
  	$this->setTemplate('index');			
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
		$this->logMessage( $form->isValid(),'notice');
		if ($form->isValid())
		{ 		
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
