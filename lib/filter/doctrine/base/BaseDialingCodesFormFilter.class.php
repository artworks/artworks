<?php

/**
 * DialingCodes filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDialingCodesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkidcountryfromdialingcodes' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'code'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'fkidcountryfromdialingcodes' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Country'), 'column' => 'idcountry')),
      'code'                        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dialing_codes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DialingCodes';
  }

  public function getFields()
  {
    return array(
      'iddialing_code'              => 'Number',
      'fkidcountryfromdialingcodes' => 'ForeignKey',
      'code'                        => 'Text',
    );
  }
}
