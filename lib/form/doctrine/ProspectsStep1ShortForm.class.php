<?php

/**
 * Subscribers form.
 *
 * @package    signup
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProspectsStep1ShortForm extends ProspectsForm
{
	
	public $step = 1;
	

	public function configure()
	{	
			
		$this->useFields(array('company','name','surname','phone','dialing_code'));
			
			
		$this->widgetSchema['country'] = new sfWidgetFormI18nChoiceCountry(array('culture' => 'fr'));
		
		$this->validatorSchema['company']->setOption('required','true');
		$this->validatorSchema['name']->setOption('required','true');
		$this->validatorSchema['surname']->setOption('required','true');
		$this->validatorSchema['phone']->setOption('required','true');
		$this->validatorSchema['dialing_code']->setOption('required','true');
		
		$this->validatorSchema['country'] = new sfValidatorPass();
		
		$this->widgetSchema['geo'] = new sfWidgetFormSelect(array('choices'=>array()));
		
		$this->validatorSchema['geo'] = new sfValidatorString(array('required'=>'true'),array('required'=>'I18N_EMPTY_GEO'));
		
		parent::configure();	

			
	}
	
	


	
}
