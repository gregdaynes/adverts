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
		$sums = array();
		
		$clients = KFactory::tmp('admin::com.adverts.model.clients')
			->getList()
			;
	
		foreach($clients as $client)
		{
		
			$campaigns[$client->id] = KFactory::tmp('admin::com.adverts.model.campaigns')
				->set('client', $client->id)
				->getList()
				;
				
			foreach($campaigns[$client->id] as $campaign)
			{
				$campaign_stats['impressions'][$campaign->id] = KFactory::tmp('admin::com.adverts.model.stats_impressions')
					->set('campaign', $campaign->id)
					->getTotal()
					;
				
				$campaign_stats['clicks'][$campaign->id] = KFactory::tmp('admin::com.adverts.model.stats_clicks')
					->set('campaign', $campaign->id)
					->getTotal()
					;
			
				$advertisements[$campaign->id] = KFactory::tmp('admin::com.adverts.model.advertisements')
					->set('campaign', $campaign->id)
					->getList()
					;
					
				foreach($advertisements[$campaign->id] as $advertisement)
				{
					$advertisement_stats['impressions'][$advertisement->id] = KFactory::tmp('admin::com.adverts.model.stats_impressions')
						->set('advertisement', $advertisement->id)
						->getTotal()
						;
					
					$advertisement_stats['clicks'][$advertisement->id] = KFactory::tmp('admin::com.adverts.model.stats_clicks')
						->set('advertisement', $advertisement->id)
						->getTotal()
						;
				}
			}
		}
		
		// sum columns
		$sums['clicks'] = array_sum($advertisement_stats['clicks']);
		$sums['impressions'] = array_sum($advertisement_stats['impressions']);
		$sums['ctr'] = round(($sums['clicks'] / count($advertisement_stats['clicks'])) / ($sums['impressions'] / count($advertisement_stats['impressions'])), 3);
		
		$this->assign('clients', $clients);
		$this->assign('campaigns', $campaigns);
		$this->assign('campaign_stats', $campaign_stats);
		$this->assign('advertisements', $advertisements);
		$this->assign('advertisement_stats', $advertisement_stats);
		$this->assign('sums', $sums);
				
		return parent::display();
	}
}