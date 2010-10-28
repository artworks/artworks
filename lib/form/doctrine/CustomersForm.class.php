<?php

/**
 * Customers form.
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CustomersForm extends BaseCustomersForm
{
	public function setup()
	{
		sfValidatorBase::setDefaultMessage('required','I18N_ENTRY_REQUIRED');
		sfValidatorBase::setDefaultMessage('invalid', 'I18N_ENTRY_INVALID');
		
		parent::setup();
	}
	
	
	public function configure()
	{
		unset($this['idcustomers']);		
		$this->widgetSchema->getFormFormatter()->setTranslationCatalogue('profile');
		
		
	}
}
