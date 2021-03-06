<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Customers', 'doctrine');

/**
 * BaseCustomers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idcustomers
 * @property string $company
 * @property string $email
 * @property integer $fkiddialing_codefromcustomers
 * @property integer $fkidgender
 * @property integer $fkidcustomer_status
 * @property string $name
 * @property integer $phone
 * @property string $password
 * @property string $password_hash
 * @property string $surname
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property DialingCodes $DialingCodes
 * @property CustomerStatus $CustomerStatus
 * @property Gender $Gender
 * @property Doctrine_Collection $Basket
 * @property Doctrine_Collection $CustomersAddressList
 * 
 * @method integer             getIdcustomers()                   Returns the current record's "idcustomers" value
 * @method string              getCompany()                       Returns the current record's "company" value
 * @method string              getEmail()                         Returns the current record's "email" value
 * @method integer             getFkiddialingCodefromcustomers()  Returns the current record's "fkiddialing_codefromcustomers" value
 * @method integer             getFkidgender()                    Returns the current record's "fkidgender" value
 * @method integer             getFkidcustomerStatus()            Returns the current record's "fkidcustomer_status" value
 * @method string              getName()                          Returns the current record's "name" value
 * @method integer             getPhone()                         Returns the current record's "phone" value
 * @method string              getPassword()                      Returns the current record's "password" value
 * @method string              getPasswordHash()                  Returns the current record's "password_hash" value
 * @method string              getSurname()                       Returns the current record's "surname" value
 * @method timestamp           getCreatedAt()                     Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()                     Returns the current record's "updated_at" value
 * @method DialingCodes        getDialingCodes()                  Returns the current record's "DialingCodes" value
 * @method CustomerStatus      getCustomerStatus()                Returns the current record's "CustomerStatus" value
 * @method Gender              getGender()                        Returns the current record's "Gender" value
 * @method Doctrine_Collection getBasket()                        Returns the current record's "Basket" collection
 * @method Doctrine_Collection getCustomersAddressList()          Returns the current record's "CustomersAddressList" collection
 * @method Customers           setIdcustomers()                   Sets the current record's "idcustomers" value
 * @method Customers           setCompany()                       Sets the current record's "company" value
 * @method Customers           setEmail()                         Sets the current record's "email" value
 * @method Customers           setFkiddialingCodefromcustomers()  Sets the current record's "fkiddialing_codefromcustomers" value
 * @method Customers           setFkidgender()                    Sets the current record's "fkidgender" value
 * @method Customers           setFkidcustomerStatus()            Sets the current record's "fkidcustomer_status" value
 * @method Customers           setName()                          Sets the current record's "name" value
 * @method Customers           setPhone()                         Sets the current record's "phone" value
 * @method Customers           setPassword()                      Sets the current record's "password" value
 * @method Customers           setPasswordHash()                  Sets the current record's "password_hash" value
 * @method Customers           setSurname()                       Sets the current record's "surname" value
 * @method Customers           setCreatedAt()                     Sets the current record's "created_at" value
 * @method Customers           setUpdatedAt()                     Sets the current record's "updated_at" value
 * @method Customers           setDialingCodes()                  Sets the current record's "DialingCodes" value
 * @method Customers           setCustomerStatus()                Sets the current record's "CustomerStatus" value
 * @method Customers           setGender()                        Sets the current record's "Gender" value
 * @method Customers           setBasket()                        Sets the current record's "Basket" collection
 * @method Customers           setCustomersAddressList()          Sets the current record's "CustomersAddressList" collection
 * 
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCustomers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('customers');
        $this->hasColumn('idcustomers', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('company', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('email', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('fkiddialing_codefromcustomers', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fkidgender', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fkidcustomer_status', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('phone', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('password', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('password_hash', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('surname', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('DialingCodes', array(
             'local' => 'fkiddialing_codefromcustomers',
             'foreign' => 'iddialing_code'));

        $this->hasOne('CustomerStatus', array(
             'local' => 'fkidcustomer_status',
             'foreign' => 'idcustomer_status'));

        $this->hasOne('Gender', array(
             'local' => 'fkidgender',
             'foreign' => 'idgender'));

        $this->hasMany('Basket', array(
             'local' => 'idcustomers',
             'foreign' => 'fkidcustomersfrombasket'));

        $this->hasMany('CustomersAddressList', array(
             'local' => 'idcustomers',
             'foreign' => 'fkidcustomersfromaddresslist'));
    }
}