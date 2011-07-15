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
		$sums = array(
			'clicks'	=> JText::_('-'),
			'impressions'	=> JText::_('-'),
			'ctr'	=> JText::_('-'),
			'revenue'	=> JText::_('-')
		);
		$revenue = array();
				
		$clients = KFactory::tmp('admin::com.adverts.model.clients')
			->set('id', KRequest::get('get.client', 'int'))
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
				
				$revenue[$campaign->id]['model'] = $campaign->price_model;
				$revenue[$campaign->id]['rate'] = $campaign->rate;
				
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
		
		// revenue
		foreach($revenue as $campaign_id => $campaign)
		{
			$rev = 0;
			
			// cpm
			if ($campaign['model'] == 1)
			{
				// get impressions
				$imps = $campaign_stats['impressions'][$campaign_id];
				
				// get rate
				$rate = $campaign['rate'];
				
				// (impressions / 1000) * rate
				$rev = ($imps / 1000) * $rate;
			}
			
			// cpc
			if ($campaign['model'] == 2)
			{
				// get clicks
				$clicks = $campaign_stats['clicks'][$campaign_id];
				
				// get rate
				$rate = $campaign['rate'];
				
				// clicks * rate
				$rev = $clicks * $rate;
			}
			
			// tennancy
			if ($campaign['model'] == 3)
			{
				// clicks * rate
				$rev = $campaign['rate'];
			}
			
			$revenue['calculated'][$campaign_id] = $rev;
		}
		
		// sum columns
		if (count($advertisement_stats)) {
			$sums['clicks'] = array_sum($advertisement_stats['clicks']);
			$sums['impressions'] = array_sum($advertisement_stats['impressions']);
			$sums['ctr'] = round(($sums['clicks'] / count($advertisement_stats['clicks'])) / ($sums['impressions'] / count($advertisement_stats['impressions'])), 3);
			$sums['revenue'] = round(array_sum($revenue['calculated']), 3);
		}
			
		$this->assign('clients', $clients);
		$this->assign('campaigns', $campaigns);
		$this->assign('campaign_stats', $campaign_stats);
		$this->assign('advertisements', $advertisements);
		$this->assign('advertisement_stats', $advertisement_stats);
		$this->assign('sums', $sums);
		$this->assign('revenue', $revenue);
				
		return parent::display();
	}
}