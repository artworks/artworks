<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Gender', 'doctrine');

/**
 * BaseGender
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idgender
 * @property string $label
 * @property Doctrine_Collection $Customers
 * @property Doctrine_Collection $Prospects
 * 
 * @method integer             getIdgender()  Returns the current record's "idgender" value
 * @method string              getLabel()     Returns the current record's "label" value
 * @method Doctrine_Collection getCustomers() Returns the current record's "Customers" collection
 * @method Doctrine_Collection getProspects() Returns the current record's "Prospects" collection
 * @method Gender              setIdgender()  Sets the current record's "idgender" value
 * @method Gender              setLabel()     Sets the current record's "label" value
 * @method Gender              setCustomers() Sets the current record's "Customers" collection
 * @method Gender              setProspects() Sets the current record's "Prospects" collection
 * 
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGender extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('gender');
        $this->hasColumn('idgender', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('label', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Customers', array(
             'local' => 'idgender',
             'foreign' => 'fkidgender'));

        $this->hasMany('Prospects', array(
             'local' => 'idgender',
             'foreign' => 'fkidgenderfromprospect'));
    }
}