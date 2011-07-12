<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableStatsimpressions extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{	
		$config->append(array(
			'identity_column'	=> 'adverts_advertisement_stats_impressions_id',
			'base'				=> 'adverts_advertisement_stats_impressions',
			'name'				=> 'adverts_advertisement_stats_impressions'
		));

		parent::_initialize($config);
	}
}