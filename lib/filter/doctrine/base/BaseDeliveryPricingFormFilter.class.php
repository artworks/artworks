<?php

/**
 * DeliveryPricing filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDeliveryPricingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'price'                    => new sfWidgetFormFilterInput(),
      'fkidcurrencyfromdelivery' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'price'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fkidcurrencyfromdelivery' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Currency'), 'column' => 'idcurrency')),
    ));

    $this->widgetSchema->setNameFormat('delivery_pricing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DeliveryPricing';
  }

  public function getFields()
  {
    return array(
      'iddelivery_pricing'       => 'Number',
      'price'                    => 'Number',
      'fkidcurrencyfromdelivery' => 'ForeignKey',
    );
  }
}
