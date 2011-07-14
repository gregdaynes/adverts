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
			->set('zone', $this->params->get('zone', 0))
			->set('enabled', '1')
			->set('pull', '1')
			->getList()
			;
		
		// check for advertisements
		if (count($this->_advertisements) >= 1) {
			$this->_advertisements = modAdvertsHelper::filterList();
		} else {
			// non to render
			return;
		}
		
		// pick an advertisement
		$this->_advertisement_id = modAdvertsHelper::pickAdvertisement();
		
		// get advertisement data
		$this->_advertisement = modAdvertsHelper::getAdvertisementData();
		
		// process advertisement for rendering
		$advertisement = modAdvertsHelper::processAdvertisement();
		
		// send back for render
		return $advertisement;
	}
	
	public function getAdvertisementData()
	{
		// get data for specific advertisement
		$advertisement = KFactory::tmp('admin::com.adverts.model.advertisements')
			->id($this->_advertisement_id)
			->getItem()
			;
		
		// check if we are filtering repeat advertisements
		if ($this->params->get('repeatadvertisement', true)) {
			// add to previous selected advertisements
			$_SESSION['previous_advertisment'][] = $advertisement->id;
		}
		
		// check if we are filtering repeat campaigns
		if ($this->params->get('repeatcampaign', true)) {
			// add to previous selected advertisements
			$_SESSION['previous_campaign'][] = $advertisement->campaign_id;
		}
		
		// return data
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
				if ($advertisement->campaign_impressions <= $campaign_impressions) {
					$this->_removeUnpublish($index);
				}
			}
			
			// campaign clicks reached
			if ($advertisement->campaign_clicks > 0)
			{
				if ($advertisement->campaign_clicks <= $campaign_clicks) {
					$this->_removeUnpublish($index);
				}
			}
			
			// advertisement impressions reached
			if ($advertisement->impressions > 0)
			{
				if ($advertisement->impressions <= $advertisement_impressions) {
					$this->_removeUnpublish($index);
				}
			}
			
			// advertisement clicks reached
			if ($advertisement->clicks > 0)
			{
				if ($advertisement->clicks <= $advertisement_clicks) {
					$this->_removeUnpublish($index);
				}
			}
		}
		
		return $this->_advertisements;
	}
	
	private function _removeUnpublish($index = null)
	{
		if ($index)
		{
			// remove advertisement from list
			unset($this->_advertisement[$index]);
			
			// unpublish advertisement
			// @TODO
			
			// unpublish campaign
			// @TODO
		}
	}
	
	public function pickAdvertisement()
	{
		// weigh each advertisement
		$weighed = array();
		
		// add an index for every weight increment
		foreach($this->_advertisements as $advertisement) {
			if ($advertisement->campaign_weight <= 1) {
				$weighed[] = $advertisement->id;
			}
			else 
			{
				$n = $advertisement->campaign_weight;
				
				for ($i = 0; $i <= $n; $i++) {
					$weighed[] = $advertisement->id;
				}
			}
		}
		
		// pick random index from weight list
		$size = count($weighed);
		if ($size > 1) {
			$pick = rand(0, $size -1);
		} else if ($size == 0) {
			return null;
		} else {
			$pick = 0;
		}
		
		return $weighed[$pick];
	}
	
	public function processAdvertisement()
	{
		// count impression
		modAdvertsHelper::newImpression($this->_advertisement_id);
		
		$location = $this->params->get('location', JText::_('Unknown'));

		$this->_advertisement->click_url = 'view=advertisement&id='.$this->_advertisement->id.'&l='.$location;
		
		if ($this->_advertisement->type == 'html') {
			$this->_advertisement->custom_banner_code = str_replace( '{LINK}', $link, $this->_advertisement->custom_banner_code );
		}
		
		return $this->_advertisement;
	}
	
	public function newImpression($id = null)
	{
		// must have an advertisement to add impression for
		if ($id)
		{
			// check to make sure we're supposed to load impressions for this space
			if ($this->params->get('loadimpression')) {
				
				// current visitor ip
				$visitor_ip = $_SERVER['REMOTE_ADDR'];
				
				// add blacklist filter
				/// @TODO
	
				KFactory::tmp('admin::com.adverts.database.row.stats_impressions')
					->setData(array(
						'campaign_id' => $this->_advertisement->campaign_id,
						'advertisement_id' => $this->_advertisement->id,
						'location'	=> $this->params->get('location', JText::_('Unknown')),
						'datetime'	=> date( 'Y-m-d H:i:s' ),
						'ip'		=> $visitor_ip
					))
					->save();
			}
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