<?php

// custom dispatcher
class ComAdvertsDispatcher extends ComDefaultDispatcher
{
	// load dashboards view
	protected function _initialize(KConfig $config)
	{		
		$config->append(array(
			'controller'	=> 'sites'
		));
	
		parent::_initialize($config);
	}
}