<?php

/**
 * myprofile actions.
 *
 * @package    artworks
 * @subpackage myprofile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class myprofileActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		$customer = Doctrine::getTable('Customers')->findOneByIdCustomers($this->getUser()->getUserId());
		$this->form = new CustomersProfileForm($customer);
			
	}

	/**
	 * Executes change password action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeChangePassword(sfWebRequest $request)
	{
		$customer = Doctrine::getTable('Customers')->findOneByIdCustomers($this->getUser()->getUserId());

		$this->form = new CustomersPasswordForm($customer);

	}

	/**
	 * Executes change password action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeChangeAddresses(sfWebRequest $request)
	{
		$this->customer = $customer = Doctrine::getTable('Customers')->findOneByIdCustomers($this->getUser()->getUserId());

		$this->form = new CustomersAddressForm();



	}

	public function executeAddAddress(sfWebRequest $request)
	{

		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($this->customer = Doctrine::getTable('Customers')->findOneByIdcustomers($this->getUser()->getUserId()));


		$form_type    = $request->getPostParameter('form_type');
		$this->form = new $form_type();
		$submit       = $this->processForm($request,$this->form );

		switch($form_type){
			case 'CustomersAddressForm' :
				$this->setTemplate("changeAddresses");
				break;
		}


	}

	public function executeUpdate(sfWebRequest $request)
	{

		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($data = Doctrine::getTable('Customers')->findOneByIdcustomers($this->getUser()->getUserId()));

		$form_type    = $request->getPostParameter('form_type');
		$this->form = new $form_type($data,array('sf_user'=>$this->getUser()));
		$submit       = $this->processForm($request,$this->form );

		switch($form_type){
			case 'CustomersPasswordForm' :
				$this->setTemplate("changePassword");
				break;
			case 'CustomersProfileForm' :
				$this->setTemplate("index");
				break;
			case 'CustomersAddressForm' :
				$this->setTemplate("changeAddresses");
				break;
		}


	}


	/**
	 * Executes logout action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeLogOut(sfWebRequest $request)
	{
		$this->getUser()->setAuthenticated(false);
		$this->redirect('@homepage');
	}


	/**
	 * Executes delete address action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeDeleteAddress(sfWebRequest $request)
	{

		$addressNode =  Doctrine_Query::create()
		->from('CustomersAddressList cal')
		->where('cal.idcustomers_address_list= ?',$request->getPostParameter('address'))
		->andWhere('cal.FKidcustomersfromaddresslist = ?', $this->getUser()->getUserId())->fetchOne();

		$addressNode->delete();

		return $this->renderText(json_encode(array('result'=>'success')));


	}

	/**
	 * Executes flag address action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeFlagAddress(sfWebRequest $request)
	{

		// set the flag off for the current flagged address
		Doctrine_Query::create()
		->update('CustomersAddressList cal')
		->set('FKidaddress_type','?',3)
		->where('cal.FKidaddress_type= ?',$request->getPostParameter('flag'))
		->andWhere('cal.FKidcustomersfromaddresslist = ?', $this->getUser()->getUserId())->fetchOne();


		// add the flag
		$addressNode =  Doctrine_Query::create()
		->from('CustomersAddressList cal')
		->where('cal.idcustomers_address_list= ?',$request->getPostParameter('address'))
		->andWhere('cal.FKidcustomersfromaddresslist = ?', $this->getUser()->getUserId())->fetchOne();

		$addressNode->setFkidaddressType($request->getPostParameter('flag'));
		$addressNode->save();
			
		return $this->renderText(json_encode(array('result'=>'success')));

	}

	/**
	 * Executes processForm which post a form
	 *
	 * @param sfRequest $request A request object
	 * @param sfForm $form A form object
	 *
	 */
	protected function processForm(sfWebRequest $request, sfForm $form)
	{

		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
				
				
			switch(get_class($form)){
				case 'CustomersPasswordForm' :
					$this->getUser()->setFlash('notice', sprintf('Your password has been changed.'));
					break;
				case 'CustomersProfileForm' :
						
					break;
				case 'CustomersAddressForm' :
					$this->forward404Unless($customer = Doctrine::getTable('Customers')->findOneByIdcustomers($this->getUser()->getUserId()));
						
					$buffer = GeolocationLib::httpWebservice($form->getValue('address').",".$form->getValue('town').",".$form->getValue('country') ,'json');
					$json_geo_datas = json_decode($buffer);
						
					$customer->addAddress(
					$json_geo_datas->results[$form->getValue('geo')]->geometry->location->lat,
					$json_geo_datas->results[$form->getValue('geo')]->geometry->location->lng);
						
					$this->getUser()->setFlash('notice', sprintf('Address added'));
						
					$this->redirect('@myprofile_change_addresses');
					break;
						
			}
			$form->save();
			$this->redirect('@homepage');

		}
		else{
			foreach ($form->getErrorSchema() as $field => $error)
			{
				$errors[$field] =  stripslashes($error);
			}
			return  $errors;
		}

	}
}
