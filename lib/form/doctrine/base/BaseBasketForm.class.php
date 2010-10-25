<?php

/**
 * Basket form base class.
 *
 * @method Basket getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBasketForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idbasket'                => new sfWidgetFormInputHidden(),
      'fkidcustomersfrombasket' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customers'), 'add_empty' => true)),
      'fkidbasket_status'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BasketStatus'), 'add_empty' => true)),
      'fkidartworksfrombasket'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artworks'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idbasket'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idbasket')), 'empty_value' => $this->getObject()->get('idbasket'), 'required' => false)),
      'fkidcustomersfrombasket' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Customers'), 'required' => false)),
      'fkidbasket_status'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BasketStatus'), 'required' => false)),
      'fkidartworksfrombasket'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Artworks'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('basket[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Basket';
  }

}
