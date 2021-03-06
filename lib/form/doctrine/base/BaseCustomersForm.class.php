<?php

/**
 * Customers form base class.
 *
 * @method Customers getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcustomers'                   => new sfWidgetFormInputHidden(),
      'company'                       => new sfWidgetFormInputText(),
      'email'                         => new sfWidgetFormInputText(),
      'fkiddialing_codefromcustomers' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DialingCodes'), 'add_empty' => true)),
      'fkidgender'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gender'), 'add_empty' => true)),
      'fkidcustomer_status'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerStatus'), 'add_empty' => true)),
      'name'                          => new sfWidgetFormInputText(),
      'phone'                         => new sfWidgetFormInputText(),
      'password'                      => new sfWidgetFormInputText(),
      'password_hash'                 => new sfWidgetFormInputText(),
      'surname'                       => new sfWidgetFormInputText(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'idcustomers'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcustomers')), 'empty_value' => $this->getObject()->get('idcustomers'), 'required' => false)),
      'company'                       => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'email'                         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fkiddialing_codefromcustomers' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DialingCodes'), 'required' => false)),
      'fkidgender'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Gender'), 'required' => false)),
      'fkidcustomer_status'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CustomerStatus'), 'required' => false)),
      'name'                          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'phone'                         => new sfValidatorInteger(array('required' => false)),
      'password'                      => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'password_hash'                 => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'surname'                       => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('customers[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Customers';
  }

}
