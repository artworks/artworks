<?php

/**
 * Artists form base class.
 *
 * @method Artists getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArtistsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idartists' => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idartists' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idartists')), 'empty_value' => $this->getObject()->get('idartists'), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('artists[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Artists';
  }

}
