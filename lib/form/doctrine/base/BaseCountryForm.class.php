<?php

/**
 * Country form base class.
 *
 * @method Country getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCountryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcountry'          => new sfWidgetFormInputHidden(),
      'label'              => new sfWidgetFormInputText(),
      'fkiddelivery_areas' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryAreas'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcountry'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcountry')), 'empty_value' => $this->getObject()->get('idcountry'), 'required' => false)),
      'label'              => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fkiddelivery_areas' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryAreas'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

}
