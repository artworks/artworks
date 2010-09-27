<?php

/**
 * ArtworkType form base class.
 *
 * @method ArtworkType getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArtworkTypeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idartwork_type' => new sfWidgetFormInputHidden(),
      'label'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'idartwork_type' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idartwork_type')), 'empty_value' => $this->getObject()->get('idartwork_type'), 'required' => false)),
      'label'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('artwork_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArtworkType';
  }

}
