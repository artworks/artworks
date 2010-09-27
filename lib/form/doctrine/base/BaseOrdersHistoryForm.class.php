<?php

/**
 * OrdersHistory form base class.
 *
 * @method OrdersHistory getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrdersHistoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'idorders'         => new sfWidgetFormInputText(),
      'fkidorder_status' => new sfWidgetFormInputText(),
      'fkidorder_type'   => new sfWidgetFormInputText(),
      'fkidbasket'       => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'idorders'         => new sfValidatorInteger(array('required' => false)),
      'fkidorder_status' => new sfValidatorInteger(array('required' => false)),
      'fkidorder_type'   => new sfValidatorInteger(array('required' => false)),
      'fkidbasket'       => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('orders_history[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrdersHistory';
  }

}
