<?php

/**
 * DeliveryPricingHistory filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDeliveryPricingHistoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'price'                           => new sfWidgetFormFilterInput(),
      'created_at'                      => new sfWidgetFormFilterInput(),
      'fkiddelivery_pricingfromhistory' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryPricing'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'price'                           => new sfValidatorPass(array('required' => false)),
      'created_at'                      => new sfValidatorPass(array('required' => false)),
      'fkiddelivery_pricingfromhistory' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeliveryPricing'), 'column' => 'iddelivery_pricing')),
    ));

    $this->widgetSchema->setNameFormat('delivery_pricing_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DeliveryPricingHistory';
  }

  public function getFields()
  {
    return array(
      'iddelivery_pricing_history'      => 'Number',
      'price'                           => 'Text',
      'created_at'                      => 'Text',
      'fkiddelivery_pricingfromhistory' => 'ForeignKey',
    );
  }
}
