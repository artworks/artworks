<?php


class GeolocationTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Geolocation');
    }
    
	protected function insertIntoGeo($xml)
	{
		
	}
	
	/**
 * Check if gps coords are in database.
 *
 * @package    artworks
 * @subpackage geo
 * @author     Belazar Mohamed
 */
	public function checkifGeoExists($lattitude,$longitude)
	{
		return $this->createQuery('u')
		->select('u.idgeolocation')		
		->where('u.longitude = ?', $longitude )
		->andWhere('u.lattitude = ?', $lattitude)->fetchOne();

	}
}