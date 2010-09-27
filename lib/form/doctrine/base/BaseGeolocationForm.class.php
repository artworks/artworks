<?php

/**
 * Geolocation form base class.
 *
 * @method Geolocation getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGeolocationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idgeolocation' => new sfWidgetFormInputHidden(),
      'fkidcountry'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'json'          => new sfWidgetFormTextarea(),
      'xml'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'idgeolocation' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idgeolocation')), 'empty_value' => $this->getObject()->get('idgeolocation'), 'required' => false)),
      'fkidcountry'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'required' => false)),
      'json'          => new sfValidatorString(array('required' => false)),
      'xml'           => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('geolocation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Geolocation';
  }

}
