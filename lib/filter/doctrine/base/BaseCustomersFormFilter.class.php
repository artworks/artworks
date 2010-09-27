<?php

/**
 * Customers filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCustomersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'company'             => new sfWidgetFormFilterInput(),
      'dialing_code'        => new sfWidgetFormFilterInput(),
      'email'               => new sfWidgetFormFilterInput(),
      'fkidgender'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gender'), 'add_empty' => true)),
      'fkidcustomer_status' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerStatus'), 'add_empty' => true)),
      'name'                => new sfWidgetFormFilterInput(),
      'phone'               => new sfWidgetFormFilterInput(),
      'password'            => new sfWidgetFormFilterInput(),
      'surname'             => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'company'             => new sfValidatorPass(array('required' => false)),
      'dialing_code'        => new sfValidatorPass(array('required' => false)),
      'email'               => new sfValidatorPass(array('required' => false)),
      'fkidgender'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gender'), 'column' => 'idgender')),
      'fkidcustomer_status' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CustomerStatus'), 'column' => 'idcustomer_status')),
      'name'                => new sfValidatorPass(array('required' => false)),
      'phone'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'password'            => new sfValidatorPass(array('required' => false)),
      'surname'             => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('customers_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Customers';
  }

  public function getFields()
  {
    return array(
      'idcustomers'         => 'Number',
      'company'             => 'Text',
      'dialing_code'        => 'Text',
      'email'               => 'Text',
      'fkidgender'          => 'ForeignKey',
      'fkidcustomer_status' => 'ForeignKey',
      'name'                => 'Text',
      'phone'               => 'Number',
      'password'            => 'Text',
      'surname'             => 'Text',
      'created_at'          => 'Date',
    );
  }
}
