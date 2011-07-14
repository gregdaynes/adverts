<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableCampaignzones extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{	
		$config->append(array(
			'identity_column'	=> 'adverts_campaign_zone_id',
			'base'				=> 'adverts_campaign_zones',
			'name'				=> 'adverts_campaign_zones'
		));

		parent::_initialize($config);
	}
}