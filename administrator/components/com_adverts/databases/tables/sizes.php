<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableSizes extends KDatabaseTableDefault
{
	public function _initialize(KConfig $config)
	{
		parent::_initialize($config);
						
		$config->append(array(

			'behaviors'	=> array('creatable', 'lockable'),
			'column_map'         => array(
			    'created_on' => 'created',
			    'locked_on'  => 'checked_out_time',
			    'locked_by'  => 'checked_out'
			)

		));
	}
}
			