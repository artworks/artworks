<?php

/**
 * DeliveryAreas filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDeliveryAreasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkiddelivery_pricing' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryPricing'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fkiddelivery_pricing' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeliveryPricing'), 'column' => 'iddelivery_pricing')),
    ));

    $this->widgetSchema->setNameFormat('delivery_areas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DeliveryAreas';
  }

  public function getFields()
  {
    return array(
      'iddelivery_areas'     => 'Number',
      'fkiddelivery_pricing' => 'ForeignKey',
    );
  }
}
