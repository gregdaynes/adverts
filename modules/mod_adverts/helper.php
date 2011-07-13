<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ModAdvertsHelper
{
	var $_advertisements;
	var $_advertisement_id;
	var $_advertisement;
	public function getAdvert()
	{
		// get advertisement list
		$this->_advertisements = KFactory::tmp('admin::com.adverts.model.advertisements')
			->set('zone', '1')
			->set('enabled', '1')
			->set('pull', '1')
			->getList()
			;
		
		// check for advertisements
		if (count($this->_advertisements) >= 1) {
			$this->_advertisements = modAdvertsHelper::filterList();
		}
		
		// pick an advertisement
		$this->_advertisement_id = modAdvertsHelper::pickAdvertisement();
		
		// get advertisement data
		$this->_advertisement = modAdvertsHelper::getAdvertisementData();
		
		// process advertisement for rendering
		$advertisement = modAdvertsHelper::processAdvertisement();
				
		return $advertisement;
	}
	
	public function getAdvertisementData()
	{
		$advertisement = KFactory::tmp('admin::com.adverts.model.advertisements')
			->id($this->_advertisement_id)
			->getItem()
			;
		
		// add to previous selected advertisements
		$previous_advertisement[] = $advertisement->id;
		
		// add to previous selected campaigns
		$previous_campaigns[] = $advertisement->campaign_id;
		
		return $advertisement;
	}
	
	public function filterList()
	{
		foreach($this->_advertisements as $index => $advertisement)
		{
			
			// get impressions for campaign
			$campaign_impressions = KFactory::tmp('admin::com.adverts.model.stats_impressions')
				->set('campaign_id', $advertisement->campaign_id)
				->getTotal()
				;
			
			// get clicks for campaign
			$campaign_clicks = KFactory::tmp('admin::com.adverts.model.stats_clicks')
				->set('campaign_id', $advertisement->campaign_id)
				->getTotal()
				;
				
			// get impressions for advertisement
			$advertisement_impressions = KFactory::tmp('admin::com.adverts.model.stats_impressions')
				->set('advertisement_id', $advertisement->id)
				->getTotal()
				;
				
			// get clicks for advertisement
			$advertisement_clicks = KFactory::tmp('admin::com.adverts.model.stats_clicks')
				->set('advertisement_id', $advertisement->id)
				->getTotal()
				;
			
			// Campaign impressions reached
			if ($advertisement->campaign_impressions > 0)
			{
				if ($advertisement->campaign_impressions <= $campaign_impressions)
				{
					unset($this->_advertisement[$index]);
					// unpublish advertisement
					// unpublish campaign
				}
			}
			
			// campaign clicks reached
			if ($advertisement->campaign_clicks > 0)
			{
				if ($advertisement->campaign_clicks <= $campaign_clicks)
				{
					unset($this->_advertisement[$index]);
					// unpublish advertisement
					// unpublish campaign
				}
			}
			
			// advertisement impressions reached
			if ($advertisement->impressions > 0)
			{
				if ($advertisement->impressions <= $advertisement_impressions)
				{
					unset($this->_advertisement[$index]);
					// unpublish advertisement
					// unpublish campaign
				}
			}
			
			// advertisement clicks reached
			if ($advertisement->clicks > 0)
			{
				if ($advertisement->clicks <= $advertisement_clicks)
				{
					unset($this->_advertisement[$index]);
					// unpublish advertisement
					// unpublish campaign
				}
			}
		}
		
		return $this->_advertisements;
	}
	
	public function pickAdvertisement()
	{
		// weigh each advertisement
		$advertisements = array();
		
		foreach($this->_advertisements as $advertisement) {
			if ($advertisement->campaign_weight <= 1) {
				$advertisements[] = $advertisement->id;
			}
			else 
			{
				$n = $advertisement->campaign_weight;
				
				for ($i = 0; $i <= $n; $i++) {
					$advertisements[] = $advertisement->id;
				}
			}
		}
		
		// pick random ad from weight list
		$size = count($advertisements) ;
		if ($size > 1) {
			$pick = rand(0, $size -1);
		} else if ($size == 0) {
			return null;
		} else {
			$pick = 0;
		}
		
		return $advertisements[$pick];
	}
	
	public function processAdvertisement()
	{
		// count impression
		modAdvertsHelper::newImpression($this->_advertisement_id, '');
		
		$location = '';
		
		$this->_advertisement->click_url = 'index.php?option=com_adverts&controller=advertisement&task=setclick&aid[]='.$this->_advertisement->id.'&location='.$location;
		
		if ($this->_advertisement->type == 'html') {
			$this->_advertisement->custom_banner_code = str_replace( '{LINK}', $link, $this->_advertisement->custom_banner_code );
		}
		
		return $this->_advertisement;
	}
	
	public function newImpression($id = null, $location = null)
	{
		if ($id)
		{
			$visitor_ip = $_SERVER['REMOTE_ADDR'];
			// add blacklist filter

			KFactory::tmp('admin::com.adverts.database.row.stats_impressions')
				->setData(array(
					'campaign_id' => $this->_advertisement->campaign_id,
					'advertisement_id' => $this->_advertisement->id,
					'location'	=> date( 'Y-m-d H:i:s' ),
					'datetime'	=> '',
					'ip'		=> $visitor_ip
				))
				->save();
		}
		
		return false;
	}
	
	function isImage()
	{
		$result = preg_match( '#(\.bmp|\.gif|\.jpg|\.jpeg|\.png)$#i', $this->_advertisement->primary_file);
		return (bool) $result;
	}
	
	function isFlash()
	{
		$result = preg_match( '#\.swf$#i', $this->_advertisement->primary_file);
		return (bool) $result;
	}
}