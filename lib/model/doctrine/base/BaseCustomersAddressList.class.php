<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CustomersAddressList', 'doctrine');

/**
 * BaseCustomersAddressList
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idcustomers_address_list
 * @property integer $fkidgeolocationfromaddresslist
 * @property integer $fkidcustomersfromaddresslist
 * @property integer $fkidaddress_type
 * @property AddressType $AddressType
 * @property Customers $Customers
 * @property Geolocation $Geolocation
 * 
 * @method integer              getIdcustomersAddressList()         Returns the current record's "idcustomers_address_list" value
 * @method integer              getFkidgeolocationfromaddresslist() Returns the current record's "fkidgeolocationfromaddresslist" value
 * @method integer              getFkidcustomersfromaddresslist()   Returns the current record's "fkidcustomersfromaddresslist" value
 * @method integer              getFkidaddressType()                Returns the current record's "fkidaddress_type" value
 * @method AddressType          getAddressType()                    Returns the current record's "AddressType" value
 * @method Customers            getCustomers()                      Returns the current record's "Customers" value
 * @method Geolocation          getGeolocation()                    Returns the current record's "Geolocation" value
 * @method CustomersAddressList setIdcustomersAddressList()         Sets the current record's "idcustomers_address_list" value
 * @method CustomersAddressList setFkidgeolocationfromaddresslist() Sets the current record's "fkidgeolocationfromaddresslist" value
 * @method CustomersAddressList setFkidcustomersfromaddresslist()   Sets the current record's "fkidcustomersfromaddresslist" value
 * @method CustomersAddressList setFkidaddressType()                Sets the current record's "fkidaddress_type" value
 * @method CustomersAddressList setAddressType()                    Sets the current record's "AddressType" value
 * @method CustomersAddressList setCustomers()                      Sets the current record's "Customers" value
 * @method CustomersAddressList setGeolocation()                    Sets the current record's "Geolocation" value
 * 
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCustomersAddressList extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('customers_address_list');
        $this->hasColumn('idcustomers_address_list', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('fkidgeolocationfromaddresslist', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fkidcustomersfromaddresslist', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fkidaddress_type', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AddressType', array(
             'local' => 'fkidaddress_type',
             'foreign' => 'idaddress_type'));

        $this->hasOne('Customers', array(
             'local' => 'fkidcustomersfromaddresslist',
             'foreign' => 'idcustomers'));

        $this->hasOne('Geolocation', array(
             'local' => 'fkidgeolocationfromaddresslist',
             'foreign' => 'idgeolocation'));
    }
}