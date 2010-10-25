<?php

/**
 * Orders filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrdersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkidorder_status' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderStatus'), 'add_empty' => true)),
      'fkidorder_type'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrderType'), 'add_empty' => true)),
      'fkidbasket'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Basket'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'fkidorder_status' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OrderStatus'), 'column' => 'idorder_status')),
      'fkidorder_type'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OrderType'), 'column' => 'idorder_type')),
      'fkidbasket'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Basket'), 'column' => 'idbasket')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('orders_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orders';
  }

  public function getFields()
  {
    return array(
      'idorders'         => 'Number',
      'fkidorder_status' => 'ForeignKey',
      'fkidorder_type'   => 'ForeignKey',
      'fkidbasket'       => 'ForeignKey',
      'created_at'       => 'Date',
    );
  }
}
