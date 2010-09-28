<?php

/**
 * Subscribers form.
 *
 * @package    signup
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProspectsError3000ShortForm extends Prospects
{
	

	public $sf_user;
	
	public function __construct($sf_user = null)
	{
		//sfContext::getInstance()->getLogger()->log(get_class($sf_user));
		if($sf_user instanceof myUser){
			$this->sf_user = $sf_user;
		}			
		parent::__construct();					
		
	}
	
	
	public function configure()
  {	
		
		$this->disableLocalCSRFProtection();
		
		if($this->sf_user instanceof myUser){
			$culture = $this->sf_user->getCulture();
		}	
		else{
			$culture = 'fr';
		}
		
		$this->useFields(array('email'));
		
		parent::configure();
		
		$this->validatorSchema['email'] = new sfValidatorAnd(array(
			new sfValidatorEmail(array(),array('invalid'=>'EMAIL_INVALID'))
			),
			array('halt_on_error'=>true,'trim'=>true,'required'=>true), array('required'=>'NO_EMAIL')
			);
		$this->widgetSchema->setLabels(array(
			'email'			=> 'EMAIL'
			));
		
  }

}
