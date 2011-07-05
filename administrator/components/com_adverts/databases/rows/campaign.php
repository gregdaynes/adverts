<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsDatabaseRowCampaign extends KDatabaseRowDefault
{
	public function save()
	{	
		$modified = $this->getModified();
		$result = parent::save();
		
		if (in_array('zones', $modified))
		{
			$table = KFactory::get('admin::com.adverts.database.table.campaign_zones');
			
			// delete any existing entries for campaign
			$table->select(array('cid' => $this->id))->delete();
			
			if (is_array($this->zones))
			{
				foreach($this->zones as $zone)
				{
					$table
						->select(null, KDatabase::FETCH_ROW)
						->setData(array(
							'cid'	=> $this->id,
							'zid'	=> $zone
						))
						->save();
					
				}
			}
		}
		
		return (bool) $result;
	}
}