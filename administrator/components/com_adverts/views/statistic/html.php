<?php

class ComAdvertsViewStatisticHtml extends ComDefaultViewHtml
{
	var $_advertisement;
	var $_campaign;
	
	public function __construct(KConfig $config)
	{
		parent::__construct($config);
		
		$this->_advertisement = KRequest::get('get.id', 'int');
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
		
		$advertisement->tot_impressions = $this->_getImpressions();
		$advertisement->tot_clicks = $this->_getClicks();
			
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
		$statistics = $this->_getLocations();
		
		foreach($statistics as $statistic)
		{
			$statistic->impressions = $this->_getImpressions($statistic->location);
			$statistic->clicks		= $this->_getClicks($statistic->location);
			$statistic->revenue		= $this->_getRevenue($statistic->impressions, $statistic->clicks);
			$statistic->time		= $this->_getTime($statistic->location);
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
	
	private function _getImpressions($location = null)
	{
		$impression = null;

		$impressions = KFactory::tmp('admin::com.adverts.model.statistics_impressions')
			->set('advertisement',	$this->_advertisement)
			->set('location',		$location)
			->getTotal()
			;
		
		return $impressions;
	}
	
	private function _getClicks($location = null)
	{
		$clicks = null;

		$clicks = KFactory::tmp('admin::com.adverts.model.statistics_clicks')
			->set('advertisement',	$this->_advertisement)
			->set('location',		$location)
			->getTotal()
			;
		
		return $clicks;
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
		$times = null;
		
		if ($location)
		{
			$impressions = KFactory::tmp('admin::com.adverts.model.statistics_impressions')
				->set('advertisement',	$this->_advertisement)
				->set('location',		$location)
				->set('time',			true)
				->getList()
				;
			
			$clicks = KFactory::tmp('admin::com.adverts.model.statistics_clicks')
				->set('advertisement',	$this->_advertisement)
				->set('location', 		$location)
				->set('time',			true)
				->getList();
			
			$times = $this->_combineStatistics($impressions, $clicks);
		}
		 
		return $times;
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