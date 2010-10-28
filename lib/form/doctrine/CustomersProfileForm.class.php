<?php

/**
 * CustomersProfile form.
 *
 * @package    artworks
 * @subpackage form
 * @author     Belazar Mohamed
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CustomersProfileForm extends CustomersForm
{
  public function configure()
  {
  	parent::configure();
  	$this->useFields(array('company','email','surname','fkidgender','name','fkiddialing_codefromcustomers','phone'));
  	
  		$this->validatorSchema['company']->setOption('required','true');
		$this->validatorSchema['name']->setOption('required','true');
		$this->validatorSchema['surname']->setOption('required','true');
		$this->validatorSchema['phone']->setOption('required','true');
		$this->validatorSchema['phone']->setMessage('invalid','I18N_PHONE_ERROR');
		$this->validatorSchema['fkiddialing_codefromcustomers']->setOption('required','true');
		
			$this->widgetSchema['fkiddialing_codefromcustomers']->addOption('add_empty','SELECT');
		$this->widgetSchema['fkiddialing_codefromcustomers']->addOption('method','getCodeAndCountry');
		$this->widgetSchema['fkiddialing_codefromcustomers']->addOption('table_method','getCodeAndCountryPack');
		$this->widgetSchema['fkiddialing_codefromcustomers'] = new sfWidgetFormSelect (array('choices'=> $this->widgetSchema['fkiddialing_codefromcustomers']->getChoices() ));
		
  	
		$this->widgetSchema['fkidgender']->addOption('add_empty','SELECT');
		$this->widgetSchema['fkidgender']->addOption('method','getLabel');
		$this->widgetSchema['fkidgender'] = new sfWidgetFormSelect (array('choices'=> $this->widgetSchema['fkidgender']->getChoices() ));

		$this->widgetSchema->setLabels(array(
		'fkidgender'	=> 'I18N_GENDER_LABEL',
		'geo'					=> 'I18N_GEO_LABEL',
		'address'					=> 'I18N_ADDRESS_LABEL',
		'country'					=> 'I18N_COUNTRY_LABEL',
		'company'					=> 'I18N_COMPANY_LABEL',
		'fkiddialing_codefromcustomers'					=> 'I18N_DIALING_CODE_LABEL',	
		'phone'					=> 'I18N_PHONE_LABEL',	
		'surname'					=> 'I18N_SURNAME_LABEL',
		'name'					=> 'I18N_NAME_LABEL',	
		'town'					=> 'I18N_TOWN_LABEL',
		'email'					=> 'I18N_EMAIL_LABEL',	
		));	
  	
  }
}
