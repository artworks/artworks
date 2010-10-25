<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$email = rand().'@'.rand().'.com';

$browser
	
	->info('/////////////')
	->info('TEST 404')
	->info('/////////////')
	
	->call('/fr/step6')
	->with('response')->begin()
	->isStatusCode(404)
	->end()
	
	->info('/////////////')
	->info('TEST step jump')
	->info('/////////////')
	
	->call('/fr/step1')
	->with('response')->begin()
	->isRedirected()  
	->isStatusCode(302)
	->followRedirect()
	->end()
	
	->info('/////////////')
	->info('STEP 0')
	->info('/////////////')
	
	->with('request')->begin()
	->isParameter('module', 'stepping')
	->isParameter('action', 'step0')
	->end()

	->with('user')
	->isCulture('fr')	
	
	->with('response')->begin()
	->isStatusCode(200)
	->end()
	
	->call('/fr/create', 'POST', array (
			'prospects' => 
			array (
				'email'	=> $email		
				)
			))  
	//->with('form')->debug()
	//->end()
     ->with('form')->begin()
	->hasErrors(false)	
	->end()
	->with('request')->begin()
	->isParameter('module', 'stepping')
	->isParameter('action', 'create')
	->end()
	->with('response')->begin()
	->isRedirected()  
	->isStatusCode(302)
	->followRedirect()
	->end()
	
	->info('/////////////')
	->info('STEP 1')
	->info('/////////////')
	
	->with('request')->begin()
	->isParameter('module', 'stepping')
	->isParameter('action', 'step1')
	->end()

	->with('user')
	->isCulture('fr')	
	
	->with('response')->begin()
	->isStatusCode(200)
	->end()
	
	->call('/fr/update', 'POST', array (
	'form_type'=>'ProspectsStep1ShortForm',
			'prospects' => 
			array (
			'fkidgenderfromprospect'	=> 1,	
			'fkiddialing_codefromprospects'	=> 1,	
			'company'	=> "_TEST_COMPANY_",	
			'name'	=> "_TEST_NAME_",	
			'surname'	=> "_TEST_SURNAME_",	
			'phone'	=> 10000,	
			'country'=>'AF',
			'geo'=> 0,
			'address'=>15,
			'town'=>'paris',			
			)))  
	//->with('form')->debug()
	//->end()
     ->with('form')->begin()
	->hasErrors(false)	
	->end()
	->with('request')->begin()
	->isParameter('module', 'stepping')
	->isParameter('action', 'update')
	->end()
	->with('response')->begin()
	->isRedirected()  
	->isStatusCode(302)
	->followRedirect()
	->end()
	
->info('/////////////')
	->info('STEP 2')
	->info('/////////////')
	
	->with('request')->begin()
	->isParameter('module', 'stepping')
	->isParameter('action', 'step2')
	->end()

	->with('user')
	->isCulture('fr')	
	
	->with('response')->begin()
	->isStatusCode(200)
	->end()
	
	->call('/fr/update', 'POST', array (
	'form_type'=>'ProspectsStep2ShortForm',
			'prospects' => 
			array (
			'password'	=> 'aaaaaa',	
			'password_bis'	=>  'aaaaaa'					
			)))  
	//->with('form')->debug()
	//->end()
     ->with('form')->begin()
	->hasErrors(false)	
	->end()
	->with('request')->begin()
	->isParameter('module', 'stepping')
	->isParameter('action', 'update')
	->end()
	->with('response')->begin()
	//->isRedirected()  
	->isStatusCode(200)
	//->followRedirect()
	->end()	;
	



