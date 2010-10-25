<?php

class GeoLocationLib {

	public static function httpWebservice($address,$type='json')
	{
		$daurl = 'http://maps.google.com/maps/api/geocode/'.$type.'?address='.$address.'&sensor=false&key=ABQIAAAAmo7k_03BNnO7sQ9vkOqt2RTDMo4bvKN1J3TjXGn3Q-EiYatQOhSeDY04pJDjdJvh4A2apUKpSkOL1A';
		
		$buffer = file_get_contents($daurl);
		return $buffer;
	}
	
}

?>