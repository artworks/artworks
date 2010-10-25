<?php

/**
 * Orders form base class.
 *
 * @method Orders getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrdersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idorders'         => new sfWidgetFormInputHidden(),
      'fkidorder_status' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderStatus'), 'add_empty' => true)),
      'fkidorder_type'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderType'), 'add_empty' => true)),
      'fkidbasket'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Basket'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'idorders'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idorders')), 'empty_value' => $this->getObject()->get('idorders'), 'required' => false)),
      'fkidorder_status' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OrderStatus'), 'required' => false)),
      'fkidorder_type'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OrderType'), 'required' => false)),
      'fkidbasket'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Basket'), 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('orders[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orders';
  }

}
