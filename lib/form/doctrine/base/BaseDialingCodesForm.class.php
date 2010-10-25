<?php

/**
 * DialingCodes form base class.
 *
 * @method DialingCodes getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDialingCodesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'iddialing_code'              => new sfWidgetFormInputHidden(),
      'fkidcountryfromdialingcodes' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => false)),
      'code'                        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'iddialing_code'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('iddialing_code')), 'empty_value' => $this->getObject()->get('iddialing_code'), 'required' => false)),
      'fkidcountryfromdialingcodes' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'))),
      'code'                        => new sfValidatorString(array('max_length' => 64)),
    ));

    $this->widgetSchema->setNameFormat('dialing_codes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DialingCodes';
  }

}
