<?php

/**
 * CustomerStatus form base class.
 *
 * @method CustomerStatus getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomerStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcustomer_status' => new sfWidgetFormInputHidden(),
      'label'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idcustomer_status' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcustomer_status')), 'empty_value' => $this->getObject()->get('idcustomer_status'), 'required' => false)),
      'label'             => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('customer_status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomerStatus';
  }

}
