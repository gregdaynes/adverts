<?php

class ComAdvertsViewStatisticHtml extends ComDefaultViewHtml
{
	var $_advertisement;
	var $_campaign;
	var $_state;
	
	public function __construct(KConfig $config)
	{
		parent::__construct($config);
		
		$this->_advertisement = KRequest::get('get.id', 'int');
		
		$this->_state = $this->getModel()->getState();		
	}
	
	public function display()
	{		
		$advertisement	= $this->_advertisement;
		$client			= null;
		$campaign		= null;
		$statistics		= null;
				
		/**
		 * get advertisement data
		 */
		$advertisement = KFactory::tmp('admin::com.adverts.model.advertisement')
			->set('id', $advertisement)
			->getItem()
			;
		
		$advertisement->tot_impressions = $this->_getStat('impressions');
		$advertisement->tot_clicks = $this->_getStat('clicks');
			
		/**
		 * get client data
		 */
		$client = KFactory::tmp('admin::com.adverts.model.client')
			->set('id', $advertisement->client_id)
			->getItem()
			;
		
		/**
		 * get campaign data
		 */
		$campaign = KFactory::tmp('admin::com.adverts.model.campaign')
			->set('id', $advertisement->campaign_id)
			->getItem()
			;
		
		$this->_campaign = $campaign;
		
		/**
		 * get statistics data
		 */
		$statistics = $this->statistics();
		
		$this->assign('advertisement',	$advertisement);
		$this->assign('client',			$client);
		$this->assign('campaign',		$campaign);
		$this->assign('statistics',		$statistics);
		
		return parent::display();
	}
	
	/**
	 * get list of impressions, clicks
	 * grouped by location, time (hour)
	 */
	public function statistics()
	{	
		$state = $this->_state;
		$statistics = null;
		
		// not grouped data
		if (is_numeric($state->group)) {
			// grouped data
			if ($state->group == '1') { // group by location
				$statistics = $this->_getLocations();
			}
		}
		
		if ($statistics) {
			if (is_object($statistics)) {
				
				foreach($statistics as $statistic)
				{
					$statistic->impressions = $this->_getStat('impressions', $statistic->location);
					$statistic->clicks		= $this->_getStat('clicks', $statistic->location);
					$statistic->revenue		= $this->_getRevenue($statistic->impressions, $statistic->clicks);
					$statistic->time		= $this->_getTime($statistic->location);
				}
				
			} 
		} else {
			
			$imps	= $this->_getStat('impressions');
			$clicks	= $this->_getStat('clicks');
			
			$statistic = array(
				'group_name'	=> JText::_('All'),
				'impressions'	=> $this->_getStat('impressions'),
				'clicks'		=> $this->_getStat('clicks'),
				'revenue'		=> $this->_getRevenue($imps, $clicks),
				'time'			=> $this->_getTime()
			);
			
			$statistic = (object) $statistic;
			$statistics = new stdClass;
			$statistics->new = $statistic;
		}
		
		return $statistics;
	}
	
	private function _getLocations()
	{	
		$locations = KFactory::tmp('admin::com.adverts.model.statistics_locations')
			->getList()
			;

		return $locations;
	}
	
	private function _getStat($type = null, $location = null)
	{
		$stat = null;
		
		$stat = KFactory::tmp('admin::com.adverts.model.statistics_'.$type)
			->set('advertisement',	$this->_advertisement)
			->set('location',		$location)
			->getTotal()
			;
		
		return $stat;
	}
	
	private function _getRevenue($impressions, $clicks)
	{
		$campaign	= $this->_campaign;
		$model		= $campaign->price_model;
		$rate		= $campaign->rate;
		$revenue	= 0;
		
		// cpm
		if ($model == 1) {
			$revenue = ($impressions / 1000) * $rate;
		}
		
		// cpc
		if ($model == 2) {
			$revenue = $clicks * $rate;
		}
		
		// tennancy
		if ($model == 3) {
			$revenue = $rate;
		}
		
		return $revenue;
	}
	
	private function _getTime($location = null)
	{
		$state = $this->_state;
		
		$impressions = KFactory::tmp('admin::com.adverts.model.statistics_impressions')
			->set('advertisement',	$this->_advertisement)
			->set('location',		$location)
			->set('time',			$state->time)
			->getList()
			;
		
		$clicks = KFactory::tmp('admin::com.adverts.model.statistics_clicks')
			->set('advertisement',	$this->_advertisement)
			->set('location', 		$location)
			->set('time',			$state->time)
			->getList();
		
		return $this->_combineStatistics($impressions, $clicks);
		
	}
	
	private function _combineStatistics($statistics, $clicks)
	{
		foreach($statistics as $statistic)
		{
			$key = $this->_array_search($statistic->datetime, $clicks);
			
			foreach($clicks as $index => $click)
			{
				if ($index == $key) {
					$statistic->clicks = $click->clicks;
					$statistic->revenue = $this->_getRevenue($statistic->impressions, $click->clicks);
				}
			}
		}
		
		return $statistics;
	}
	
	private function _array_search($needle, $haystack)
	{
		if (!isset($haystack['date time']))
		{
			foreach($haystack as $key => $value)
			{
				if ($value['datetime'] == $needle) {
					return $key;
				}
			}
		}
		
		return false;
	}
}