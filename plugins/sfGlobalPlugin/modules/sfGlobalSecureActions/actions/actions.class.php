<?php

/**
 * sfGlobalSecureActions Actions.
 *
 * @package    header
 * @subpackage header
 * @author     Your name here
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGlobalSecureActionsActions extends sfActions
{

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		if($this->getUser()->isAuthenticated()){
				
			if($this->getUser()->hasCredential('customer_regular')){				

			}
			else{
				$customer = Doctrine::getTable('Customers')->findOneByIdcustomers($this->getUser()->getUserId());

				if($customer->getFkidcustomerStatus()==1  ){
					$this->getUser()->addCredential('customer_regular');
				}

				if($customer->getFkidcustomerStatus()==2  ){
					$this->getUser()->addCredential('customer_vip');
				}

				$this->redirect( $request->getUri() );
			}

		}

		else{
			$this->redirect(sfConfig::get('app_frontend_host'));
		}

	}


}

