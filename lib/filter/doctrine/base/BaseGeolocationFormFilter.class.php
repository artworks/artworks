<?php

/**
 * Geolocation filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGeolocationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkidcountry'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'json'          => new sfWidgetFormFilterInput(),
      'xml'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fkidcountry'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Country'), 'column' => 'idcountry')),
      'json'          => new sfValidatorPass(array('required' => false)),
      'xml'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('geolocation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Geolocation';
  }

  public function getFields()
  {
    return array(
      'idgeolocation' => 'Number',
      'fkidcountry'   => 'ForeignKey',
      'json'          => 'Text',
      'xml'           => 'Text',
    );
  }
}
