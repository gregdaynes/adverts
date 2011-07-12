<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ModAdvertsHelper
{
	var $_advertisements;
	
	public function getAdvert($params)
	{
		// get advertisement list
		$this->_advertisements = KFactory::tmp('admin::com.adverts.model.advertisements')
			->set('zone', '1')
			->set('enabled', '1')
			->set('pull', '1')
			->getList();
		
		// filter banners
		$advertisement = modAdvertsHelper::checkList();
		
		//return $advertisements;
		return $advertisement;
	}
	
	public function checkList()
	{
	
		// we haz ads
		if (count($this->_advertisements) >= 1)
		{
			
		}
		
	}
}