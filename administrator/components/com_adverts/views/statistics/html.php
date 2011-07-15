<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsViewStatisticsHtml extends ComDefaultViewHtml
{
	public function display()
	{
		$clients = array();
		$campaigns = array();
		$campaign_stats = array();
		$advertisements = array();
		$advertisement_stats = array();
		
		$clients = KFactory::tmp('admin::com.adverts.model.clients')
			->getList()
			;
	
		foreach($clients as $client)
		{
			$campaigns[$client->id] = KFactory::tmp('admin::com.adverts.model.campaigns')
				->set('client_id', $client->id)
				->getList()
				;
				
			foreach($campaigns[$client->id] as $campaign)
			{
				$campaign_stats[$campaign->id]->impressions = KFactory::tmp('admin::com.adverts.model.stats_impressions')
					->set('campaign_id', $campaign->id)
					->getTotal()
					;
				
				$campaign_stats[$campaign->id]->clicks = KFactory::tmp('admin::com.adverts.model.stats_clicks')
					->set('campaign_id', $campaign->id)
					->getTotal()
					;
			
				$advertisements[$campaign->id] = KFactory::tmp('admin::com.adverts.model.advertisements')
					->set('campaign_id', $campaign->id)
					->getList()
					;
					
				foreach($advertisements[$campaign->id] as $advertisement)
				{
					$advertisement_stats[$advertisement->id]->impressions = KFactory::tmp('admin::com.adverts.model.stats_impressions')
						->set('advertisement_id', $advertisement->id)
						->getTotal()
						;
					
					$advertisement_stats[$advertisement->id]->clicks = KFactory::tmp('admin::com.adverts.model.stats_clicks')
						->set('advertisement_id', $advertisement->id)
						->getTotal()
						;
				}
			}
		}

		
		
			
		$this->assign('clients', $clients);
		$this->assign('campaigns', $campaigns);
		$this->assign('campaign_stats', $campaign_stats);
		$this->assign('advertisements', $advertisements);
		$this->assign('advertisement_stats', $advertisement_stats);
				
		return parent::display();
	}
}