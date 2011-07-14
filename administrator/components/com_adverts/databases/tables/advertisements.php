<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableAdvertisements extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{
		$sluggable = KDatabaseBehavior::factory('sluggable', array('columns' => array('name')));
		
		$config->append(array(

			'behaviors'	=> array('creatable', 'lockable', $sluggable),
			'column_map'         => array(
			    'created_on' => 'created',
			    'locked_on'  => 'checked_out_time',
			    'locked_by'  => 'checked_out'
			),
			'filters'	=> array(
				'notes'	=> array('html', 'tidy'),
				'custom_banner_code'	=> array('html', 'raw')
			)
		));

		parent::_initialize($config);
	}
}