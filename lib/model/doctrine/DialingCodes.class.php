<?php

/**
 * DialingCodes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    artworks
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class DialingCodes extends BaseDialingCodes
{
	/**
	 * get dialing code and country name
	 *
	 * 
   */
   public function getCodeAndCountry()
	{
		return $this->getCountry()->getLabel()." ".$this->getCode();
	}
	
}