<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseRowAdvertisement extends KDatabaseRowDefault
{
	public function save()
	{	
		$modified = $this->getModified();
		$result = parent::save();
		
		if (in_array('zones', $modified))
		{
			$table = KFactory::get('admin::com.adverts.database.table.advertisement_zones');
			
			// delete any existing entries for campaign
			$table->select(array('aid' => $this->id))->delete();
			
			if (is_array($this->zones))
			{
				foreach($this->zones as $zone)
				{
					$table
						->select(null, KDatabase::FETCH_ROW)
						->setData(array(
							'aid'	=> $this->id,
							'zid'	=> $zone
						))
						->save();
					
				}
			}
		}
			
		if (in_array('file_url', $modified))
		{
			$file = KRequest::get('files.file_url', 'filename');
			
			if ($file['name'] != '')
			{
				jimport('joomla.filesystem.file');
				jimport('joomla.filesystem.folder');
				
			}
		}
		
		return (bool) $result;
	}
}