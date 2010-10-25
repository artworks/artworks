<?php

/**
 * Subscribers form.
 *
 * @package    signup
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProspectsStep0ShortForm extends ProspectsForm
{
	
	public $step = 0;
	

	public function configure()
	{	
		
		$this->useFields(array('email'));
		parent::configure();
		$this->validatorSchema['email'] = new sfValidatorAnd(array(
			new sfValidatorEmail(array(),array('invalid'=>'I18N_EMAIL_INVALID')),
			new sfValidatorDoctrineUnique(array('model' => 'Prospects', 'column' => array('email')),array('invalid'=>'I18N_NOT_UNIQUE_PROSPECT')),
			new sfValidatorDoctrineUnique(array('model' => 'Customers', 'column' => array('email')),array('invalid'=>'I18N_NOT_UNIQUE_CUSTOMERS'))
			),
			array('halt_on_error'=>true,'trim'=>true,'required'=>true), array('required'=>'I18N_EMAIL_REQUIRED')
			);
		
			$this->widgetSchema->setLabels(array(
		'email'	=> 'I18N_EMAIL_LABEL',
		));
			
	}
	
	
}
