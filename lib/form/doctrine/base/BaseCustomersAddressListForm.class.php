<?php

/**
 * CustomersAddressList form base class.
 *
 * @method CustomersAddressList getObject() Returns the current form's model object
 *
 * @package    artworks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomersAddressListForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'idcustomers_address_list'       => new sfWidgetFormInputHidden(),
      'fkidgeolocationfromaddresslist' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Geolocation'), 'add_empty' => true)),
      'fkidcustomersfromaddresslist'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customers'), 'add_empty' => true)),
      'fkidaddress_type'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AddressType'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idcustomers_address_list'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('idcustomers_address_list')), 'empty_value' => $this->getObject()->get('idcustomers_address_list'), 'required' => false)),
      'fkidgeolocationfromaddresslist' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Geolocation'), 'required' => false)),
      'fkidcustomersfromaddresslist'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Customers'), 'required' => false)),
      'fkidaddress_type'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AddressType'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('customers_address_list[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomersAddressList';
  }

}
