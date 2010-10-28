<?php

class frontendConfiguration extends sfApplicationConfiguration
{
	public function configure()
	{
	}
	// call the global plugin
	public function setup()
	{
		parent::setup();
		$this->enablePlugins('sfGlobalPlugin');
	}
}
