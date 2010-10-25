<?php

/**
 * DeliveryPricing form base class.
 *
 * @method DeliveryPricing getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDeliveryPricingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddelivery_pricing'       => new sfWidgetFormInputHidden(),
      'price'                    => new sfWidgetFormInputText(),
      'fkidcurrencyfromdelivery' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'iddelivery_pricing'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddelivery_pricing')), 'empty_value' => $this->getObject()->get('iddelivery_pricing'), 'required' => false)),
      'price'                    => new sfValidatorNumber(array('required' => false)),
      'fkidcurrencyfromdelivery' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Currency'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('delivery_pricing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DeliveryPricing';
  }

}
