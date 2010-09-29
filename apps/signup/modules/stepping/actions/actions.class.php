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
	
	public function executeGotoStep(sfWebRequest $request)  {
		$uid   = $this->getUser()->getAttribute('uid');
		$this->getUser()->setAttribute('idprospects',$uid);
		
		$prospects = Doctrine::getTable('Prospects')->find($uid);
		$this->getUser()->setAttribute('step',$prospects->getStep());
		
		$this->redirect("@stepping_form?action=step".$prospects->getStep());
	}
	
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
	
	/**
	* Executes step2 action
	*
	* @param sfRequest $request A request object
	*/
	public function executeStep2(sfWebRequest $request)
	{
		$this->stepCheck(2);
		$this->form = new ProspectsStep2ShortForm($this->prospect);	
	}
	
	/**
	* Executes step3 action
	*
	* @param sfRequest $request A request object
	*/
	public function executeStep3(sfWebRequest $request)
	{
		$this->getUser()->setAttribute('step',0);
		$this->stepCheck(3);
	}
	
	/**
	* Executes Create action which create a new Prospect entry
	*
	* @param sfRequest $request A request object
	*/
	public function executeCreate(sfWebRequest $request)
	{	
		$this->form = new ProspectsStep0ShortForm();
		$this->processForm($request, $this->form);	
		$this->setTemplate('step0');		
	}
	

	/**
	* Executes Update action which update an existing Prospect entry
	*
	* @param sfRequest $request A request object
	*/
	public function executeUpdate(sfWebRequest $request)
	{
		$this->redirectUnless($data = Doctrine::getTable('Prospects')->find($this->getUser()->getAttribute('idprospects')),'@errors_show?numero=3000');
		
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		
		$form_type    = $request->getPostParameter('form_type');		                                                                                                                                                   
		
		$this->form   = new $form_type($data);
		$submit       = $this->processForm($request, $this->form);							
		
		
		$this->setTemplate('step'.$this->getUser()->getAttribute('step'));								
		
		
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
			
			if($form->step == $form->getObject()->getStep() ){
				$step_next = $this->getUser()->getAttribute('step')+1;	
				$form->getObject()->setStep($step_next);	
			}
			else{ $step_next = $form->step+1; }	
							
			$form->save();	
			 $prospects_id_prospects = $form->getObject()->getIdProspects();
			
			
			// Mail management from step0 to the last step
			switch($form->step){
				case 0:
				
				  // Mail with autoconnection link to last step entered
				  $generated_url		= $this->getContext()->getRouting()->generate('stepping_gotostep', array(), $absolute = false);
				
				  $site_to_connect		= AccessSites::GetSecureConnexionURL($prospects_id_prospects,AccessSites::TimeOutLong,$generated_url);	
			      $auto_connection_link	= AccessSites::SiteSignup.$site_to_connect->URL;
					
					$message = Swift_Message::newInstance()
						->setFrom('from@artworks.com')
						->setTo($form->getObject()->getEmail())
						->setSubject('Subject')						
						->setBody($this->getPartial('emails/beginSignupMail', array('auto_connection_link'=> $auto_connection_link)), 'text/html');
					
					$this->getMailer()->send($message);
					break;
				case 3:
				
					// Mail with congratulations and signup report 
					$message = Swift_Message::newInstance()
						->setFrom('from@artworks.com')
						->setTo($form->getObject()->getEmail())
						->setSubject('Subject')
						->setBody($this->getPartial('emails/endSignupMail', array(
									'password'=>$request->getPostParameter('prospects[password]'),
									'email'=>$form->getEmail()
									)), 'text/html');
					
					$this->getMailer()->send($message);
				break;
			}
			
			$this->getUser()->setAttribute('step', $step_next);	
			$this->getUser()->setAttribute('idprospects',$prospects_id_prospects);	
			
			$this->redirect('@stepping_form?action=step'.$step_next);
			
		} 
		
		else{
			foreach ($form->getErrorSchema() as $field => $error)
			{				
				if ($error instanceof sfValidatorErrorSchema){              
								
				}		
				//echo $error->getMessage();
				if($error->getMessage() === 'email [I18N_NOT_UNIQUE_PROSPECT]'){
					$email = $request->getPostParameter('prospects[email]');
					
					$prospects_id_prospects = Doctrine::getTable('Prospects')->findOneByEmail($email)->getIdProspects();
					
					// Mail with autoconnection link 
					$generated_url		= $this->getContext()->getRouting()->generate('stepping_gotostep', array(), $absolute = false);
					
					$site_to_connect		= AccessSites::GetSecureConnexionURL($prospects_id_prospects,AccessSites::TimeOutLong,$generated_url);	
					$auto_connection_link	= AccessSites::SiteSignup.$site_to_connect->URL;
					
					$message = Swift_Message::newInstance()
						->setFrom('from@artworks.com')
						->setTo($email)
						->setSubject('Recovery')						
						->setBody($this->getPartial('emails/recoverySignupMail', array('auto_connection_link'=> $auto_connection_link)), 'text/html');
					
					$this->getMailer()->send($message);
					
					$this->redirect('@errors_show?numero=3000');                                            
				}	
				
				if($error->getMessage() === 'email [I18N_NOT_UNIQUE_CUSTOMER]'){
					$submit = $request->getParameter('prospects');
					$this->getUser()->setAttribute('email_reprise',$submit['email']);
					$this->redirect('@errors_show?numero=3000');                                            
				}			
				
				$errors[$field] =  stripslashes($error);
			} 
			return  $errors;
		}
	}

	protected function stepCheck($step)
	{	
		$this->redirectUnless($this->prospect = Doctrine_Core::getTable('Prospects')->find($this->getUser()->getAttribute('idprospects')),'@errors_show?numero=3000' ) ;
		$this->redirectUnless($this->prospect->getStep() >= $step ,'@stepping_form?action=step'.$this->prospect->getStep());		
		$this->getUser()->setAttribute('step', $step);     	
	}
	
}
