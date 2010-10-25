<?php

/**
 * CustomersAddressList filter form base class.
 *
 * @package    artworks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCustomersAddressListFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fkidgeolocationfromaddresslist' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Geolocation'), 'add_empty' => true)),
      'fkidcustomersfromaddresslist'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customers'), 'add_empty' => true)),
      'fkidaddress_type'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AddressType'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fkidgeolocationfromaddresslist' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Geolocation'), 'column' => 'idgeolocation')),
      'fkidcustomersfromaddresslist'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Customers'), 'column' => 'idcustomers')),
      'fkidaddress_type'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AddressType'), 'column' => 'idaddress_type')),
    ));

    $this->widgetSchema->setNameFormat('customers_address_list_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustomersAddressList';
  }

  public function getFields()
  {
    return array(
      'idcustomers_address_list'       => 'Number',
      'fkidgeolocationfromaddresslist' => 'ForeignKey',
      'fkidcustomersfromaddresslist'   => 'ForeignKey',
      'fkidaddress_type'               => 'ForeignKey',
    );
  }
}
