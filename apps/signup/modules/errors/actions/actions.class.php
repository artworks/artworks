<?php

/**
 * errors actions.
 *
 * @package    artworks
 * @subpackage errors
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class errorsActions extends sfActions
{
	// Affiche le template 
	public function executeShow(sfWebRequest $request)
	{
		$error_num = $request->getParameter('numero',null);   // on récupère le numéro de l'erreur
		
		$this->form = new ProspectsError3000ShortForm();
			
		$this->setTemplate("error".$error_num);
	}
	
	public function executeHasSendRecoveryMail(sfWebRequest $request)
	{
	
	}

	public function executeSendRecoveryMail(sfWebRequest $request)
	{	
		$template	= $request->getPostParameter('template');
		
		$this->form = new ProspectsError3000ShortForm();
		$this->processForm($request, $this->form);			
		$this->setTemplate('error3000');
				
	}
	
	
	protected function processForm(sfWebRequest $request, sfForm $form)
	{	
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		
		$this->MessageResult="";
		// formulaire posté
		if($form->isValid()){
			$email	= $request->getPostParameter('subscribers[email]');		

		}
		else{
			foreach ($form->getErrorSchema() as $field => $error)
			{
				$errors[$field] =  stripslashes($error);
			} 
			
		}
	}

}
