<?php

/**
 * CustomersProfile form.
 *
 * @package    artworks
 * @subpackage form
 * @author     Belazar Mohamed
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CustomersAddressForm extends sfForm
{
  public function configure()
  {
 	 	parent::configure();
 	 //$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputHidden();
  		$this->widgetSchema->getFormFormatter()->setTranslationCatalogue('profile');
		$this->widgetSchema->setNameFormat('address[%s]');
		
		$this->widgetSchema['country'] = new sfWidgetFormI18nChoiceCountry(array('culture' => 'fr','add_empty'=>true));
		
  		$this->widgetSchema['town'] = new sfWidgetFormInputText();
		$this->widgetSchema['address'] = new sfWidgetFormInputText();
		$this->widgetSchema['geo'] = new sfWidgetFormSelect(array('choices'=>array()));

		$this->validatorSchema['geo'] = new sfValidatorString(array('required'=>'true'),array('required'=>'I18N_EMPTY_GEO'));
		$this->validatorSchema['address'] = new sfValidatorPass();
		$this->validatorSchema['town'] = new sfValidatorPass();
		$this->validatorSchema['country'] = new sfValidatorPass();
		
		$this->widgetSchema->setLabels(array(
		'geo'					=> 'I18N_GEO_LABEL',
		'address'					=> 'I18N_ADDRESS_LABEL',
		'country'					=> 'I18N_COUNTRY_LABEL',
		'town'					=> 'I18N_TOWN_LABEL'	
		));	
  	
  }
}
