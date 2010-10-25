<?php

/**
 * Subscribers form.
 *
 * @package    signup
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProspectsError3000ShortForm extends ProspectsForm
{
	
	public function configure()
	{	
		$this->useFields(array('email'));
		parent::configure();
		
		$this->validatorSchema['email'] = new sfValidatorAnd(
			array(new sfValidatorEmail(array(),array('invalid'=>'I18N_EMAIL_INVALID'))),
			array('halt_on_error'=>true,'trim'=>true,'required'=>true), array('required'=>'I18N_EMAIL_REQUIRED'));
		
	}

}
