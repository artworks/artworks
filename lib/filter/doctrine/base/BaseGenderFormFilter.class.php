<?php

/**
 * Gender filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGenderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'label'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'label'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gender_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gender';
  }

  public function getFields()
  {
    return array(
      'idgender' => 'Number',
      'label'    => 'Text',
    );
  }
}
