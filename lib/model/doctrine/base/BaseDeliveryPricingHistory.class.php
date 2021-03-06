<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DeliveryPricingHistory', 'doctrine');

/**
 * BaseDeliveryPricingHistory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $iddelivery_pricing_history
 * @property string $price
 * @property string $created_at
 * @property integer $fkiddelivery_pricingfromhistory
 * @property DeliveryPricing $DeliveryPricing
 * 
 * @method integer                getIddeliveryPricingHistory()        Returns the current record's "iddelivery_pricing_history" value
 * @method string                 getPrice()                           Returns the current record's "price" value
 * @method string                 getCreatedAt()                       Returns the current record's "created_at" value
 * @method integer                getFkiddeliveryPricingfromhistory()  Returns the current record's "fkiddelivery_pricingfromhistory" value
 * @method DeliveryPricing        getDeliveryPricing()                 Returns the current record's "DeliveryPricing" value
 * @method DeliveryPricingHistory setIddeliveryPricingHistory()        Sets the current record's "iddelivery_pricing_history" value
 * @method DeliveryPricingHistory setPrice()                           Sets the current record's "price" value
 * @method DeliveryPricingHistory setCreatedAt()                       Sets the current record's "created_at" value
 * @method DeliveryPricingHistory setFkiddeliveryPricingfromhistory()  Sets the current record's "fkiddelivery_pricingfromhistory" value
 * @method DeliveryPricingHistory setDeliveryPricing()                 Sets the current record's "DeliveryPricing" value
 * 
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDeliveryPricingHistory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('delivery_pricing_history');
        $this->hasColumn('iddelivery_pricing_history', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('price', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('created_at', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('fkiddelivery_pricingfromhistory', 'integer', 4, array(
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
        $this->hasOne('DeliveryPricing', array(
             'local' => 'fkiddelivery_pricingfromhistory',
             'foreign' => 'iddelivery_pricing'));
    }
}