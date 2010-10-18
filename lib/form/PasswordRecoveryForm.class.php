<?php

/**
 * PasswordRecovery form.
 *
 * @package    global
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PasswordRecoveryForm extends sfForm
{
	public function configure()
	{
		parent::configure();

		$this->widgetSchema->getFormFormatter()->setTranslationCatalogue('stepping');
		$this->widgetSchema->setNameFormat('recovery[%s]');
		$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputHidden();
		$this->widgetSchema['email'] = new sfWidgetFormInput();
		
		$this->validatorSchema['email'] = new sfValidatorAnd(array(
			new sfValidatorEmail(array(),array('invalid'=>'I18N_EMAIL_INVALID')),
			new sfValidatorDoctrineChoice(array('model' => 'Customers', 'column' => array('email')),array('invalid'=>'I18N_NOT_A_CUSTOMER')),
			),
			array('halt_on_error'=>true,'trim'=>true,'required'=>true), array('required'=>'I18N_EMAIL_REQUIRED')
			);
		
			$this->widgetSchema->setLabels(array(
		'email'	=> 'I18N_EMAIL_LABEL',
		));
		

	}

	

}
