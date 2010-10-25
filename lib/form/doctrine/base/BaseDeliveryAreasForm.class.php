<?php

/**
 * DeliveryAreas form base class.
 *
 * @method DeliveryAreas getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDeliveryAreasForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddelivery_areas'     => new sfWidgetFormInputHidden(),
      'fkiddelivery_pricing' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryPricing'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddelivery_areas'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddelivery_areas')), 'empty_value' => $this->getObject()->get('iddelivery_areas'), 'required' => false)),
      'fkiddelivery_pricing' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryPricing'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('delivery_areas[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DeliveryAreas';
  }

}
