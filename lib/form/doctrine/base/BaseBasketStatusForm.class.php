<?php

/**
 * BasketStatus form base class.
 *
 * @method BasketStatus getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBasketStatusForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idbasket_status' => new sfWidgetFormInputHidden(),
      'label'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idbasket_status' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idbasket_status')), 'empty_value' => $this->getObject()->get('idbasket_status'), 'required' => false)),
      'label'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('basket_status[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BasketStatus';
  }

}
