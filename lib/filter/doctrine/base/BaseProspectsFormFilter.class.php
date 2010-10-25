<?php

/**
 * Prospects filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProspectsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'company'                     => new sfWidgetFormFilterInput(),
      'dialing_code'                => new sfWidgetFormFilterInput(),
      'email'                       => new sfWidgetFormFilterInput(),
      'fkidgeolocationfromprospect' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Geolocation'), 'add_empty' => true)),
      'name'                        => new sfWidgetFormFilterInput(),
      'phone'                       => new sfWidgetFormFilterInput(),
      'surname'                     => new sfWidgetFormFilterInput(),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'company'                     => new sfValidatorPass(array('required' => false)),
      'dialing_code'                => new sfValidatorPass(array('required' => false)),
      'email'                       => new sfValidatorPass(array('required' => false)),
      'fkidgeolocationfromprospect' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Geolocation'), 'column' => 'idgeolocation')),
      'name'                        => new sfValidatorPass(array('required' => false)),
      'phone'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'surname'                     => new sfValidatorPass(array('required' => false)),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('prospects_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prospects';
  }

  public function getFields()
  {
    return array(
      'idprospects'                 => 'Number',
      'company'                     => 'Text',
      'dialing_code'                => 'Text',
      'email'                       => 'Text',
      'fkidgeolocationfromprospect' => 'ForeignKey',
      'name'                        => 'Text',
      'phone'                       => 'Number',
      'surname'                     => 'Text',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
