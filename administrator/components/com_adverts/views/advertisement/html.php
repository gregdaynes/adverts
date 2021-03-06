<?php /** $Id **/ ?>
<?php

class ComAdvertsViewAdvertisementHtml extends ComDefaultViewHtml
{
	public function display()
	{
		$id =KRequest::get('get.id', 'int');
		
		$impressions = KFactory::tmp('admin::com.adverts.model.statistics_impressions')
			->set('advertisement_id', $id)
			->getTotal()
			;
			
		$clicks = KFactory::tmp('admin::com.adverts.model.statistics_clicks')
			->set('advertisement_id', $id)
			->getTotal()
			;
		
		$this->assign('tot_impressions', $impressions);
		$this->assign('tot_clickthroughs', $clicks);
		
		return parent::display();
	}
}