<?php

/**
 * Basket filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBasketFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkidcustomersfrombasket' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customers'), 'add_empty' => true)),
      'fkidbasket_status'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BasketStatus'), 'add_empty' => true)),
      'fkidartworksfrombasket'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artworks'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fkidcustomersfrombasket' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Customers'), 'column' => 'idcustomers')),
      'fkidbasket_status'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('BasketStatus'), 'column' => 'idbasket_status')),
      'fkidartworksfrombasket'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Artworks'), 'column' => 'idartworks')),
    ));

    $this->widgetSchema->setNameFormat('basket_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Basket';
  }

  public function getFields()
  {
    return array(
      'idbasket'                => 'Number',
      'fkidcustomersfrombasket' => 'ForeignKey',
      'fkidbasket_status'       => 'ForeignKey',
      'fkidartworksfrombasket'  => 'ForeignKey',
    );
  }
}
