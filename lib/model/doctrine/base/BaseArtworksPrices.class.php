<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ArtworksPrices', 'doctrine');

/**
 * BaseArtworksPrices
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idartworks_prices
 * @property integer $fkidcurrencyfromartworks
 * @property integer $fkidartworksfromprices
 * @property decimal $price
 * @property Artworks $Artworks
 * @property Currency $Currency
 * 
 * @method integer        getIdartworksPrices()         Returns the current record's "idartworks_prices" value
 * @method integer        getFkidcurrencyfromartworks() Returns the current record's "fkidcurrencyfromartworks" value
 * @method integer        getFkidartworksfromprices()   Returns the current record's "fkidartworksfromprices" value
 * @method decimal        getPrice()                    Returns the current record's "price" value
 * @method Artworks       getArtworks()                 Returns the current record's "Artworks" value
 * @method Currency       getCurrency()                 Returns the current record's "Currency" value
 * @method ArtworksPrices setIdartworksPrices()         Sets the current record's "idartworks_prices" value
 * @method ArtworksPrices setFkidcurrencyfromartworks() Sets the current record's "fkidcurrencyfromartworks" value
 * @method ArtworksPrices setFkidartworksfromprices()   Sets the current record's "fkidartworksfromprices" value
 * @method ArtworksPrices setPrice()                    Sets the current record's "price" value
 * @method ArtworksPrices setArtworks()                 Sets the current record's "Artworks" value
 * @method ArtworksPrices setCurrency()                 Sets the current record's "Currency" value
 * 
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArtworksPrices extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('artworks_prices');
        $this->hasColumn('idartworks_prices', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('fkidcurrencyfromartworks', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('fkidartworksfromprices', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('price', 'decimal', 15, array(
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 15,
             'scale' => '2',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Artworks', array(
             'local' => 'fkidartworksfromprices',
             'foreign' => 'idartworks'));

        $this->hasOne('Currency', array(
             'local' => 'fkidcurrencyfromartworks',
             'foreign' => 'idcurrency'));
    }
}