<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableAdvertisementzones extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{	
		$config->append(array(
			'identity_column'	=> 'adverts_advertisement_zone_id',
			'base'				=> 'adverts_advertisement_zones',
			'name'				=> 'adverts_advertisement_zones'
		));

		parent::_initialize($config);
	}
}