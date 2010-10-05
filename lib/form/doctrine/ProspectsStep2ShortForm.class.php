<?php

/**
 * Subscribers form.
 *
 * @package    signup
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProspectsStep2ShortForm extends ProspectsForm
{
	
	public $step = 2;
	

	public function configure()
	{	
			
		$this->useFields(array('password'));
		
		$this->widgetSchema['password']       = new sfWidgetFormInputPassword(array(),array('maxlength'=>'45'));
		$this->widgetSchema['password_bis']   = new sfWidgetFormInputPassword(array(),array('maxlength'=>'45'));
		
		
		$this->validatorSchema['password']     = new sfValidatorAnd(array(
			new sfValidatorRegex(
						array('pattern' =>'/^(\s+)?[\w-\#\/]+(\s+)?$/'),
						array('invalid'=>'I18N_PASSWORD_NO_SPECIAL_CHARACTERS')),		
					new sfValidatorString(
						array('min_length' => 6,'max_length' => 45), 
						array('min_length' => 'I18N_PASSWORD_MIN_LENGTH_ALERT',
							'max_length' => 'I18N_PASSWORD_MAX_LENGTH_ALERT'
							))),
			array('halt_on_error' => true,'required' => true,'trim'=>true),
			array('required'=>'I18N_PASSWORD_REQUIRED'	)			
			);
		
		$this->validatorSchema['password_bis'] = new sfValidatorPass();
		
		
		$this->validatorSchema->setPostValidator(
			new sfValidatorSchemaCompare(
					'password',"==",'password_bis',array(),
					array('invalid' => 'I18N_CHECK_PASSWORD_EQUALITY')));
		
		
		parent::configure();	

		
		

		
	}
	
	public function updateObject($values = null)
	{
		$updateObject = parent::updateObject($values);	
		
		//$updateObject->setPasswordHash(Password::generateHash("tttttt",sfConfig::get('app_key')));		

		return $updateObject;
	}


	
}
