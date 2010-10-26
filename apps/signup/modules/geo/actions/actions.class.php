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
		$address = urlencode( $request->getParameter('address'));
		$town = urlencode($request->getParameter('town'));
		$country = urlencode($request->getParameter('country'));
		
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');  

		// Website url to open
		$buffer = GeolocationLib::httpWebservice("$address,$town,$country",'json');
		$geo_datas = json_decode($buffer);
		
		
		
		return $this->renderText($buffer);

	}
}
