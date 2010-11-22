<?php

/**
 * Country filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCountryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'label'              => new sfWidgetFormFilterInput(),
      'fkiddelivery_areas' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DeliveryAreas'), 'add_empty' => true)),
      'country_code'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'label'              => new sfValidatorPass(array('required' => false)),
      'fkiddelivery_areas' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DeliveryAreas'), 'column' => 'iddelivery_areas')),
      'country_code'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

  public function getFields()
  {
    return array(
      'idcountry'          => 'Number',
      'label'              => 'Text',
      'fkiddelivery_areas' => 'ForeignKey',
      'country_code'       => 'Text',
    );
  }
}
