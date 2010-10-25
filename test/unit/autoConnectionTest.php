<?php

include(dirname(__FILE__).'/../bootstrap/unit.php');

$configuration = ProjectConfiguration::getApplicationConfiguration( 'signup', 'test', true); 
new sfDatabaseManager($configuration); 
// initialize browser conf
$context = sfContext::createInstance($configuration);

// initialize test conf
$t = new lime_test(4, new lime_output_color());

$prospects_id_prospects = 1;
$generated_url		= $context->getRouting()->generate('stepping_gotostep', array(), $absolute = false);
$site_to_connect		= AccessSites::GetSecureConnexionURL($prospects_id_prospects,AccessSites::TimeOutLong,$generated_url);	
$auto_connection_link	= AccessSites::SiteSignup.$site_to_connect->URL;

//***********************************
$t->info('Verification de la clef serveur');
$t->is(sfConfig::get('app_key'),"qxnml7_de8647663asqdxKJHD8)@=+","app_key = qxnml7_de8647663asqdxKJHD8)@=+");
$t->is($generated_url,"qxnml7_de8647663asqdxKJHD8)@=+","app_key = qxnml7_de8647663asqdxKJHD8)@=+");



