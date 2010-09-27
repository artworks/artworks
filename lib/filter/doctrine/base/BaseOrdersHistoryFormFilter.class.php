<?php

/**
 * OrdersHistory filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrdersHistoryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idorders'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fkidorder_status' => new sfWidgetFormFilterInput(),
      'fkidorder_type'   => new sfWidgetFormFilterInput(),
      'fkidbasket'       => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'idorders'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fkidorder_status' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fkidorder_type'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fkidbasket'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('orders_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'OrdersHistory';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'idorders'         => 'Number',
      'fkidorder_status' => 'Number',
      'fkidorder_type'   => 'Number',
      'fkidbasket'       => 'Number',
      'created_at'       => 'Date',
    );
  }
}
