<?php

/**
 * Prospects form base class.
 *
 * @method Prospects getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProspectsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idprospects'                 => new sfWidgetFormInputHidden(),
      'company'                     => new sfWidgetFormInputText(),
      'dialing_code'                => new sfWidgetFormInputText(),
      'email'                       => new sfWidgetFormInputText(),
      'fkidgeolocationfromprospect' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Geolocation'), 'add_empty' => true)),
      'name'                        => new sfWidgetFormInputText(),
      'phone'                       => new sfWidgetFormInputText(),
      'surname'                     => new sfWidgetFormInputText(),
      'password'                    => new sfWidgetFormInputText(),
      'step'                        => new sfWidgetFormInputText(),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'idprospects'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idprospects')), 'empty_value' => $this->getObject()->get('idprospects'), 'required' => false)),
      'company'                     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'dialing_code'                => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'email'                       => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fkidgeolocationfromprospect' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Geolocation'), 'required' => false)),
      'name'                        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'phone'                       => new sfValidatorInteger(array('required' => false)),
      'surname'                     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'password'                    => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'step'                        => new sfValidatorInteger(array('required' => false)),
      'created_at'                  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('prospects[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Prospects';
  }

}
