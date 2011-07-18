<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableStatistics_Impressions extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{	
		$config->append(array(
			'identity_column'	=> 'adverts_statistics_impressions_id',
			'base'				=> 'adverts_statistics_impressions',
			'name'				=> 'adverts_statistics_impressions'
		));

		parent::_initialize($config);
	}
}