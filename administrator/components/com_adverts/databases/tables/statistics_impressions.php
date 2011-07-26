<?php

class ComAdvertsDatabaseTableStatistics_impressions extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{	
		$config->append(array(
			'identity_column'	=> 'adverts_statistics_impression_id',
			'base'				=> 'adverts_statistics_impressions',
			'name'				=> 'adverts_statistics_impressions'
		));

		parent::_initialize($config);
	}
}