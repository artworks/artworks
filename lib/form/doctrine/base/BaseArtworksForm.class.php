<?php

/**
 * Artworks form base class.
 *
 * @method Artworks getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArtworksForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idartworks'        => new sfWidgetFormInputHidden(),
      'fkidartists'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artists'), 'add_empty' => true)),
      'fkidartwork_style' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArtworkStyle'), 'add_empty' => true)),
      'fkidartwork_type'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArtworkType'), 'add_empty' => true)),
      'description'       => new sfWidgetFormTextarea(),
      'photo'             => new sfWidgetFormInputText(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'created_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'idartworks'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idartworks')), 'empty_value' => $this->getObject()->get('idartworks'), 'required' => false)),
      'fkidartists'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Artists'), 'required' => false)),
      'fkidartwork_style' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ArtworkStyle'), 'required' => false)),
      'fkidartwork_type'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ArtworkType'), 'required' => false)),
      'description'       => new sfValidatorString(array('required' => false)),
      'photo'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'updated_at'        => new sfValidatorDateTime(),
      'created_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('artworks[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Artworks';
  }

}
