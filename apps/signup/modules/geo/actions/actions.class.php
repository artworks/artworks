<?php

/**
 * geo actions.
 *
 * @package    artworks
 * @subpackage geo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class geoActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeGeoSearch(sfWebRequest $request)
	{
		$address = $request->getParameter('address');
		$town = $request->getParameter('town');
		$country = $request->getParameter('country');
		
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');  

		// Website url to open
		$daurl = 'http://maps.google.com/maps/api/geocode/json?address='.$address.','.$town.','.$country.'&sensor=false&key=ABQIAAAAmo7k_03BNnO7sQ9vkOqt2RTDMo4bvKN1J3TjXGn3Q-EiYatQOhSeDY04pJDjdJvh4A2apUKpSkOL1A';
		
		$buffer = file_get_contents($daurl);
		
		return $this->renderText($buffer);

	}
}
