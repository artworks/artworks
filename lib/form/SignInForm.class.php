<?php

/**
 * SignIn form.
 *
 * @package    global
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SignInForm extends sfForm
{
	public function configure()
	{


		parent::configure();

		$this->widgetSchema->getFormFormatter()->setTranslationCatalogue('stepping');
		$this->widgetSchema->setNameFormat('signin[%s]');
		$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['username'] = new sfWidgetFormInput();
		$this->widgetSchema['password'] = new sfWidgetFormInputPassword();

		$this->validatorSchema['username'] = new sfValidatorString(array('required'=>'true'),array('required'=>'I18N_EMPTY'));
		$this->validatorSchema['password'] = 	new sfValidatorString(array('required'=>'true'),array('required'=>'I18N_EMPTY'));

		$this->validatorSchema->setPostValidator(
		new sfValidatorCallback(array('callback' => array($this, 'checkCredentials')))
		);

		
		$this->widgetSchema->setLabels(array(
		'username'	=> 'I18N_USERNAME_LABEL',
		'password'	=> 'I18N_USERNAME_LABEL'		
			
		));
		
		//sfContext::getInstance()->getLogger()->notice($id);
		//$this->validatorSchema['password']  = new sfValidatorPass();

	}

	public  function checkCredentials($validator, $values)
	{
		$customer =false;

		if ($values['username']){
			$customer = Doctrine::getTable('Customers')->findOneByEmail($values['username']);
		}

		if (!$customer || !$customer->checkPassword($values['password']))
		{
			// password is not correct, throw an error
			throw new sfValidatorError($validator, 'I18N_INVALID_CREDENTIALS');
		}

		// password is correct, return the clean values
		return $values;


	}


}
