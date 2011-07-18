<?php

class ComAdvertsViewStatisticHtml extends ComDefaultViewHtml
{
	var $_advertisement;
	
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
		
		if ($location)
		{
			$impressions = KFactory::tmp('admin::com.adverts.model.statistics_impressions')
				->set('advertisement_id',	$this->_advertisement)
				->set('location',			$location)
				->getTotal()
				;
		}
		
		return $impressions;
	}
	
	private function _getClicks($location = null)
	{
		$clicks = null;
		
		if ($location)
		{
			$clicks = KFactory::tmp('admin::com.adverts.model.statistics_clicks')
				->set('advertisement_id',	$this->_advertisement)
				->set('location',			$location)
				->getTotal()
				;
		}
		
		return $clicks;
	}
	
	private function _getTime($location = null)
	{
		$times = null;
		
		if ($location)
		{
			$times = KFactory::tmp('admin::com.adverts.model.statistics_impressions')
				->set('advertisement_id',	$this->_advertisement)
				->set('location',			$location)
				->set('time',				true)
				->getList()
				;
		}
		
		return $times;
	}
}