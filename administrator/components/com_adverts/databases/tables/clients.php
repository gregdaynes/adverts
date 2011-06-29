<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseTableClients extends KDatabaseTableDefault
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
				'notes'	=> array('html', 'tidy')
			)
		));

		parent::_initialize($config);
	}
}