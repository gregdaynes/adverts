<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableStatsclicks extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{	
		$config->append(array(
			'identity_column'	=> 'adverts_advertisement_stats_clicks_id',
			'base'				=> 'adverts_advertisement_stats_clicks',
			'name'				=> 'adverts_advertisement_stats_clicks'
		));

		parent::_initialize($config);
	}
}