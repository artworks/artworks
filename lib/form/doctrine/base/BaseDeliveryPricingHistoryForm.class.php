<?php

/**
 * DeliveryPricingHistory form base class.
 *
 * @method DeliveryPricingHistory getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDeliveryPricingHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddelivery_pricing_history'      => new sfWidgetFormInputHidden(),
      'price'                           => new sfWidgetFormInputText(),
      'created_at'                      => new sfWidgetFormInputText(),
      'fkiddelivery_pricingfromhistory' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryPricing'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddelivery_pricing_history'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddelivery_pricing_history')), 'empty_value' => $this->getObject()->get('iddelivery_pricing_history'), 'required' => false)),
      'price'                           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'created_at'                      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fkiddelivery_pricingfromhistory' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryPricing'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('delivery_pricing_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DeliveryPricingHistory';
  }

}
