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
		//$this->form = new SignInForm();
	}

	/**
	 * Executes SendCredentialConfirmation action
	 * just some congrat page after password recovery
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeSendCredentialsConfirmation(sfWebRequest $request)
	{

	}

	/**
	 * Executes SendCredentials action
	 * submit recovery form and send credentials to customer
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeSendCredentials(sfWebRequest $request)
	{
		$this->form = new PasswordRecoveryForm();
		$submit       = $this->processForm($request, $this->form);
		$this->setTemplate('passwordRecovery');
	}

	/**
	 * Executes Welcome action
	 * Redirected there if you have not signed in
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeWelcome(sfWebRequest $request)
	{
		if (!$request->getParameter('sf_culture'))
		{			
			$this->redirect('@homepage');
		}
		$this->form = new SignInForm();
	}

	public function executeSignin(sfWebRequest $request)
	{
		//$this->forward('default', 'module');
		$this->form = new SignInForm();
		$submit       = $this->processForm($request, $this->form);
		$this->setTemplate('welcome');
	}

	/**
	 * Executes PasswordRecovery action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executePasswordRecovery(sfWebRequest $request)
	{
		$this->form = new PasswordRecoveryForm();
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
			switch (get_class($form)){
				case 'SignInForm':
					// Authenticate the user and redirect to homepage
					$customer = Doctrine::getTable('Customers')->findOneByEmail($form->getValue('username'));
					$this->getUser()->setAuthenticated(true);
					$this->getUser()->setUserId($customer->getIdCustomers());
					$this->redirect('@homepage');
					break;
				case 'PasswordRecoveryForm':
					// Retrieve customer infos
					$taintedvalues = $form->getTaintedValues();
					$email= $taintedvalues['email'];
					$customer = Doctrine::getTable('Customers')->findOneByEmail($email);
						
					// Setup autoconnection link
					$generated_url		= $this->getContext()->getRouting()->generate('homepage', array(), $absolute = false);
					$this->logMessage('idcustomers : '.$customer->getIdcustomers(),'notice');
					$site_to_connect		= AccessSites::GetSecureConnexionURL($customer->getIdcustomers() ,AccessSites::TimeOutLong,$generated_url);
					$auto_connection_link	= AccessSites::SiteFrontend.$site_to_connect->URL;


					// Send autoconnection mail and redirect to confirmation message
					$message = Swift_Message::newInstance()
					->setFrom('from@artworks.com')
					->setTo($email)
					->setSubject('Autoconnect')
					->setBody($this->getPartial('emails/sendCredentialsMail',
					array('auto_connection_link'=> $auto_connection_link)),
											'text/html');

					$this->getMailer()->send($message);
					$this->redirect('@homepage_send_credentials_confirmation');
					break;
			}

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
