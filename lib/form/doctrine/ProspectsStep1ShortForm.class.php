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
			
		$this->useFields(array('fkidgenderfromprospect','company','name','surname','phone','fkiddialing_codefromprospects'));
			



		$this->widgetSchema['fkidgenderfromprospect']->addOption('add_empty','SELECT');
		$this->widgetSchema['fkidgenderfromprospect']->addOption('method','getLabel');
		$this->widgetSchema['fkidgenderfromprospect'] = new sfWidgetFormSelect (array('choices'=> $this->widgetSchema['fkidgenderfromprospect']->getChoices() ));
			
			
		$this->widgetSchema['country'] = new sfWidgetFormI18nChoiceCountry(array('culture' => 'fr','add_empty'=>true));


		$this->validatorSchema['company']->setOption('required','true');
		$this->validatorSchema['name']->setOption('required','true');
		$this->validatorSchema['surname']->setOption('required','true');
		$this->validatorSchema['phone']->setOption('required','true');
		$this->validatorSchema['fkiddialing_codefromprospects']->setOption('required','true');

		$this->widgetSchema['fkiddialing_codefromprospects']->addOption('add_empty','SELECT');
		$this->widgetSchema['fkiddialing_codefromprospects']->addOption('method','getCodeAndCountry');
		$this->widgetSchema['fkiddialing_codefromprospects'] = new sfWidgetFormSelect (array('choices'=> $this->widgetSchema['fkiddialing_codefromprospects']->getChoices() ));


		$this->widgetSchema['town'] = new sfWidgetFormInputText();
		$this->widgetSchema['address'] = new sfWidgetFormInputText();
		$this->widgetSchema['geo'] = new sfWidgetFormSelect(array('choices'=>array()));

		$this->validatorSchema['geo'] = new sfValidatorString(array('required'=>'true'),array('required'=>'I18N_EMPTY_GEO'));
		$this->validatorSchema['address'] = new sfValidatorPass();
		$this->validatorSchema['town'] = new sfValidatorPass();
		$this->validatorSchema['country'] = new sfValidatorPass();

		$this->widgetSchema->setLabels(array(
		'fkidgenderfromprospect'	=> 'I18N_GENDER_LABEL',
		'geo'					=> 'I18N_GEO_LABEL',
		'address'					=> 'I18N_ADDRESS_LABEL',
		'country'					=> 'I18N_COUNTRY_LABEL',
		'fkiddialing_codefromprospects'					=> 'I18N_DIALING_CODE_LABEL',	
		'phone'					=> 'I18N_PHONE_LABEL',	
		'surname'					=> 'I18N_SURNAME_LABEL',
		'name'					=> 'I18N_NAME_LABEL',	
		'town'					=> 'I18N_TOWN_LABEL',	
		));
			
		parent::configure();
			
	}

	public function updateObject($values = null)
	{
		$updateObject = parent::updateObject($values);

		$buffer = GeolocationLib::httpWebservice($this->getValue('address').",".$this->getValue('town').",".$this->getValue('country') ,'json');
		$json_geo_datas = json_decode($buffer);

			
		$geolocation = Doctrine::getTable('geolocation')->checkifGeoExists(
		$json_geo_datas->results[$this->getValue('geo')]->geometry->location->lat,
		$json_geo_datas->results[$this->getValue('geo')]->geometry->location->lng
		);



		if ($geolocation){
			$updateObject->setFKidgeolocationfromprospect($geolocation->getIdgeolocation());
		}
		else {
				
		 $geolocation =  new Geolocation();
		 //$geolocation->setXml($xml_geo_datas);
		 //$geolocation->setJson(json_encode($json_geo_datas));
		 $geolocation->setLongitude($json_geo_datas->results[$this->getValue('geo')]->geometry->location->lng);
		 $geolocation->setLattitude($json_geo_datas->results[$this->getValue('geo')]->geometry->location->lat);
		 $geolocation->save();
		 	
		 $updateObject->setFKidgeolocationfromprospect($geolocation->getIdgeolocation());
		 	
		}

		return $updateObject;
	}
}
