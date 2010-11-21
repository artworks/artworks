<?php

class GeoLocationLib {

	const gmap_api_key = 'ABQIAAAAmo7k_03BNnO7sQ9vkOqt2RTDMo4bvKN1J3TjXGn3Q-EiYatQOhSeDY04pJDjdJvh4A2apUKpSkOL1A';
	
	public static function httpWebservice($address,$type='json')
	{
		$daurl = 'http://maps.google.com/maps/api/geocode/'.$type.'?address='.$address.'&sensor=false&key='.self::gmap_api_key;
		
		$buffer = file_get_contents($daurl);
		return $buffer;
	}
	
	/**
	 * Return an address by his lattitue and longitude
	 *
	 * @param float $lng longitude
	 * @param float $lat lattitude
	 * 
	 * @return string
	 */
	public static function httpWebserviceReverseGeocoding($lat,$lng,$type='json')
	{
		$daurl = 'http://maps.google.com/maps/api/geocode/'.$type.'?latlng='.$lat.','.$lng.'&sensor=false&key='.self::gmap_api_key;
		sfContext::getInstance()->getLogger()->notice($daurl);
		$buffer = file_get_contents($daurl);
		return $buffer;
	}
	
}

?>