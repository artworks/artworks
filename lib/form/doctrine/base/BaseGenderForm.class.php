<?php

/**
 * Gender form base class.
 *
 * @method Gender getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGenderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idgender' => new sfWidgetFormInputHidden(),
      'label'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idgender' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idgender')), 'empty_value' => $this->getObject()->get('idgender'), 'required' => false)),
      'label'    => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gender[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gender';
  }

}
