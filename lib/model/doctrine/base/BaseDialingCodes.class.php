<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DialingCodes', 'doctrine');

/**
 * BaseDialingCodes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $iddialing_code
 * @property integer $fkidcountryfromdialingcodes
 * @property string $code
 * @property Country $Country
 * @property Doctrine_Collection $Customers
 * @property Doctrine_Collection $Prospects
 * 
 * @method integer             getIddialingCode()               Returns the current record's "iddialing_code" value
 * @method integer             getFkidcountryfromdialingcodes() Returns the current record's "fkidcountryfromdialingcodes" value
 * @method string              getCode()                        Returns the current record's "code" value
 * @method Country             getCountry()                     Returns the current record's "Country" value
 * @method Doctrine_Collection getCustomers()                   Returns the current record's "Customers" collection
 * @method Doctrine_Collection getProspects()                   Returns the current record's "Prospects" collection
 * @method DialingCodes        setIddialingCode()               Sets the current record's "iddialing_code" value
 * @method DialingCodes        setFkidcountryfromdialingcodes() Sets the current record's "fkidcountryfromdialingcodes" value
 * @method DialingCodes        setCode()                        Sets the current record's "code" value
 * @method DialingCodes        setCountry()                     Sets the current record's "Country" value
 * @method DialingCodes        setCustomers()                   Sets the current record's "Customers" collection
 * @method DialingCodes        setProspects()                   Sets the current record's "Prospects" collection
 * 
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDialingCodes extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dialing_codes');
        $this->hasColumn('iddialing_code', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('fkidcountryfromdialingcodes', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('code', 'string', 64, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 64,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Country', array(
             'local' => 'fkidcountryfromdialingcodes',
             'foreign' => 'idcountry'));

        $this->hasMany('Customers', array(
             'local' => 'iddialing_code',
             'foreign' => 'fkiddialing_codefromcustomers'));

        $this->hasMany('Prospects', array(
             'local' => 'iddialing_code',
             'foreign' => 'fkiddialing_codefromprospects'));
    }
}