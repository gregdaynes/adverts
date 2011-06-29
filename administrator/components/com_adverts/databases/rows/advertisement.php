<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseRowAdvertisement extends KDatabaseRowDefault
{
	public function save()
	{	

		if (is_array($this->zones)) {
			$this->zones = implode(',', $this->zones);
		}
		
		$result = parent::save();
		
		return (bool) $result;
		
	}
}