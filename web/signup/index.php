<?php


require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('signup', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
