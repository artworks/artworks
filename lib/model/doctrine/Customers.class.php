<?php

/**
 * Customers
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Customers extends BaseCustomers
{
	public function setUp()
	{
		parent::setUp();
		$this->actAs('Timestampable');
	}


/**
	 * Adds customer address
	 *
	 *
	 * @return boolean
	 */
	public function addAddress($lat,$lng)
	{		
			
		try {
		$geolocation = new Geolocation();
		$geolocation->setLattitude($lat);
		$geolocation->setLongitude($lng);
		$geolocation->save();
		
		$customer_address_list = new CustomersAddressList();
		$customer_address_list->setFkidcustomersfromaddresslist($this->idcustomers);
		$customer_address_list->setFkidgeolocationfromaddresslist($geolocation->idgeolocation);
		$customer_address_list->setFkidaddressType(3);
		$customer_address_list->save();
		
	
		return true;
		}catch (Exception$ex){}
	}
	

	public function getAddressesQuery($address_type)
	{
		return Doctrine_Query::create()
		->from('Geolocation g')
		->innerJoin('g.CustomersAddressList cal ON cal.fkidgeolocationfromaddresslist = g.idgeolocation' )
		->whereIn('cal.FKidaddress_type',$address_type)
		->andWhere('cal.FKidcustomersfromaddresslist = ?', $this->getIdcustomers());

	}

	
	/**
	 * Get all customer addresses
	 *
	 *
	 * @return array all customer addresses
	 */
	public function getAllMyAddresses()
	{
		$addresses_list = array();
		if (count($q=$this->getAddressesQuery(array(1,2,3))->fetchArray())){
			foreach ($q as $key=>$address){
			
			$buffer = GeolocationLib::httpWebserviceReverseGeocoding($address['lattitude'],$address['longitude'],'json');
			$geo_datas = json_decode($buffer);
	
			$addresses_list[$address['CustomersAddressList'][0]['idcustomers_address_list']]= $geo_datas->results[0]->formatted_address;
			}
		}

		return $addresses_list;
	}
	

	/**
	 * Get the customer delivery address
	 *
	 *
	 * @return string The customer delivery address
	 */
	public function getDeliveryAddress()
	{

		if (count($q=$this->getAddressesQuery(2)->fetchArray())){
			$buffer = GeolocationLib::httpWebserviceReverseGeocoding($q[0]['lattitude'],$q[0]['longitude'],'json');
			$geo_datas = json_decode($buffer);
			$geo_infos['address'] = $geo_datas->results[0]->formatted_address; 
			$geo_infos['idcustomers_address_list']=	$q[0]['CustomersAddressList'][0]['idcustomers_address_list'];
		}

		return !empty($geo_infos) ? $geo_infos : $this->getBillingsAddress() ;
	}


		/**
	 * Get the customer billings address
	 *
	 *
	 * @return string The customer billings address
	 */
	public function getBillingsAddress()
	{
		
		if (count($q=$this->getAddressesQuery(1)->fetchArray())){
			$buffer = GeolocationLib::httpWebserviceReverseGeocoding($q[0]['lattitude'],$q[0]['longitude'],'json');
			$geo_datas = json_decode($buffer);
			$geo_infos['address'] = $geo_datas->results[0]->formatted_address; 
			$geo_infos['idcustomers_address_list']=	$q[0]['CustomersAddressList'][0]['idcustomers_address_list'];
		}

		return !empty($geo_infos) ? $geo_infos : false ;

	}

	/**
	 * Sets the user password.
	 *
	 * @param string $password
	 */

	public function setPassword($password)
	{
		if (!$password && 0 == strlen($password))
		{
			return;
		}

		$salt = md5(rand(100000, 999999).$this->getEmail());
		$this->setPasswordHash($salt);
		$algorithm = 'sha1';

		$algorithmAsStr = is_array($algorithm) ? $algorithm[0].'::'.$algorithm[1] : $algorithm;
		if (!is_callable($algorithm))
		{
			throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithmAsStr));
		}

		$this->_set('password', call_user_func_array($algorithm, array($salt.$password)));
	}

	/**
	 * Returns whether or not the given password is valid.
	 *
	 * @param string $password
	 * @return boolean
	 * @throws sfException
	 */
	public function checkPassword($password)
	{
		$algorithm = 'sha1';
		if (false !== $pos = strpos($algorithm, '::'))
		{
			$algorithm = array(substr($algorithm, 0, $pos), substr($algorithm, $pos + 2));
		}
		if (!is_callable($algorithm))
		{
			throw new sfException(sprintf('The algorithm callable "%s" is not callable.', $algorithm));
		}

		return $this->getPassword() == call_user_func_array($algorithm, array($this->getPasswordHash().$password));
	}
	
	public function getMySelectionQuery($selection_type)
	{
		return Doctrine_Query::create()
		->from('Basket b')
		->innerJoin('b.Artworks a ON a.idartworks = b.fkidartworksfrombasket AND a.fkidartwork_type = ?',$selection_type )
		->innerJoin('a.ArtworksPrices ap ON a.idartworks = ap.fkidartworksfromprices' )
		->where('b.fkidcustomersfrombasket = ?',$this->getIdcustomers())
		->andWhere('b.fkidbasket_status = ?', 1);

	}
}