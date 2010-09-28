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
		$NumeroErreur=$request->getParameter('numero',null);   // on récupère le numéro de l'erreur
		// on enleve 1000 et on affiche le template d'erreur associé
		$this->setTemplate("error".$NumeroErreur);
		
		
		// Erreur session timeout
  switch($NumeroErreur)
  {
	case 3000:			
    case 3001: 	
				$this->form = new ProspectError3000ShortForm();

	break; 
	}// FIN Erreur session timeout
		
		
		
	}

	public function executeSendRecoveryForm(sfWebRequest $request)
	{	
		$template	= $request->getPostParameter('template');
		
		$this->form = new SubscribersError3000ShortForm();
		$this->processForm($request, $this->form);			
		
		if ($template == 3001){
			$this->setTemplate('error3001');
		}
		else{
			$this->setTemplate('error3000');
		}
	}
	
	
	protected function processForm(sfWebRequest $request, sfForm $form)
	{	
		
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		
		$this->MessageResult="";
		// formulaire posté
		if($form->isValid()){
			$email	= $request->getPostParameter('subscribers[email]');
			$member_group_id = Doctrine::getTable('Subscribers')->getMemberGroupIdByEmail($email);
			switch ($member_group_id) 
			{
				case 1:
					try
					{
						$send_reprise = Message::SendByEmail($email);
						$this->MessageResult="Consultez votre email, un message vous permettant de reprendre votre inscription vous a ete envoye.";
					}
					catch( exception $e)
					{
						$this->MessageResult="Une erreur est survenue, veuillez reessayez dans quelques minutes.";
					}
					break;
				
				case $member_group_id > 1:
					$this->redirect('@errors_show?numero=100'.$member_group_id);
					break;
				
				default:
					// TODO : Ajouter "Nous contacter".
					$this->MessageResult="Cette adresse email est introuvable.";
					break;
			}

		}
		else{
			foreach ($form->getErrorSchema() as $field => $error)
			{
				$errors[$field] =  stripslashes($error);
			} 
			
		}
	}

}
