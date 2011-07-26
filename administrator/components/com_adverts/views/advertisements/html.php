<?php

class ComAdvertsViewAdvertisementsHtml extends ComDefaultViewHtml
{
	public function display()
	{
		$advertisements = $this->getModel()->getList();
		$stats = array();
		
		foreach($advertisements as $advertisement)
		{
			// get impressions for advertisement
			$impressions = KFactory::tmp('admin::com.adverts.model.statistics_impressions')
				->set('advertisement_id', $advertisement->id)
				->getTotal()
				;
				
			$stats[$advertisement->id]->impressions = $impressions;
			
			// get clicks for advertisement
			$clicks = KFactory::tmp('admin::com.adverts.model.statistics_clicks')
				->set('advertisement_id', $advertisement->id)
				->getTotal()
				;
				
			$stats[$advertisement->id]->clicks = $clicks;
		}
		
		$this->assign('stats', $stats);
		
		return parent::display();
	}
}