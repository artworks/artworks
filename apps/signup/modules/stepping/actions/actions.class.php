<?php

/**
 * stepping actions.
 *
 * @package    artworks
 * @subpackage stepping
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class steppingActions extends sfActions
{
	
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward('default', 'module');
	}

	/**
	 * Executes step0 action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeStep0(sfWebRequest $request)
	{
		$this->getUser()->setAttribute('step',0);
		$this->form = new ProspectsStep0ShortForm();	
	}
	
	/**
	 * Executes step0 action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeStep1(sfWebRequest $request)
	{
		$this->stepCheck(1);
		$this->form = new ProspectsStep1ShortForm($this->prospect);		
	}
	
	
	public function executeCreate(sfWebRequest $request)
	{	
		$this->form = new ProspectsStep0ShortForm();
		$this->processForm($request, $this->form);	
		$this->setTemplate('step0');		
	}
	

	
	public function executeUpdate(sfWebRequest $request)
	{
		$this->redirectUnless($data = Doctrine::getTable('Prospects')->find($this->getUser()->getAttribute('idprospects')),'@errors_show?numero=3000');
		
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		
		$form_type    = $request->getPostParameter('form_type');		                                                                                                                                                   
		
		$this->form   = new $form_type($data);
		$submit       = $this->processForm($request, $this->form);							
		
		
		$this->setTemplate('step'.$this->getUser()->getAttribute('step'));								
		
		
	} 
	
	protected function processForm(sfWebRequest $request, sfForm $form)
	{	
		

		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		
		if ($form->isValid())
		{ 		
			
			if($form->step == $form->getObject()->getStep() ){
				$step_next = $this->getUser()->getAttribute('step')+1;	
				$form->getObject()->setStep($step_next);	
			}
			else{ $step_next = $form->step+1; }	
				
			
			
			$form->save();	
		
			
			switch($form->step){
				case 0:
					$message = Swift_Message::newInstance()
						->setFrom('from@artworks.com')
						->setTo($form->getObject()->getEmail())
						->setSubject('Subject')
						->setBody($this->getPartial('emails/beginSignupMail', array()));
					
					$this->getMailer()->send($message);
					break;
				case 1:
					$message = Swift_Message::newInstance()
						->setFrom('from@artworks.com')
						->setTo($form->getObject()->getEmail())
						->setSubject('Subject')
						->setBody($this->getPartial('emails/endSignupMail', array(
									'password'=>$request->getPostParameter('prospects[password]'),
									'email'=>$form->getEmail()
									)));
					
					$this->getMailer()->send($message);
				break;
			}
			
			$this->getUser()->setAttribute('step', $step_next);	
			$this->getUser()->setAttribute('idprospects',$form->getObject()->getIdProspects());	
			
			$this->redirect('@signup_form?action=step'.$step_next);
			
		} 
		
		else{
			foreach ($form->getErrorSchema() as $field => $error)
			{				
				if ($error instanceof sfValidatorErrorSchema){              
					if($error->key() === 'unique'){
						$submit = $request->getParameter('subscribers');						
						$member_group_id = Doctrine::getTable('Subscribers')->getMemberGroupIdByEmail($submit['email']);
						$this->getUser()->setUserEmail($submit['email']);
						$this->redirect('@errors_show?numero=100'.$member_group_id);                                            
					}
					
					if($error->key() === 'sponsoring_code'){						
						$this->redirect('@errors_show?numero=2000');                                            
					}
					
				}		
				
				$errors[$field] =  stripslashes($error);
			} 
			return  $errors;
		}
	}

	protected function stepCheck($step)
	{	
		$this->redirectUnless($this->prospect = Doctrine_Core::getTable('Prospects')->find($this->getUser()->getAttribute('idprospects')),'@errors_show?numero=3000' ) ;
		$this->redirectUnless($this->prospect->getStep() >= $step ,'@signup_form?action=step'.$this->prospect->getStep());		
		$this->getUser()->setAttribute('step', $step);     	
	}
	
}
