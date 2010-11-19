<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
	$this->getEventDispatcher()->connect(
		'form.validation_error',
		array('BaseForm', 'listenToValidationError')
		);
		$this->enablePlugins(array('sfDoctrinePlugin'));	
		sfConfig::set('sf_app_template_dir', sfConfig::get('sf_plugins_dir').'/sfGlobalPlugin/templates');
  
  }
  
  public function configure()
  {
  
  }
}
