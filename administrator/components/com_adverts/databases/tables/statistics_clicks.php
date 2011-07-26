<?php

class ComAdvertsDatabaseTableStatistics_Clicks extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{	
		$config->append(array(
			'identity_column'	=> 'adverts_statistics_click_id',
			'base'				=> 'adverts_statistics_clicks',
			'name'				=> 'adverts_statistics_clicks'
		));

		parent::_initialize($config);
	}
}