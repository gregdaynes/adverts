<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsControllerAdvertisement extends ComDefaultControllerDefault
{
	public function _actionRead(KCommandContext $context)
	{
		$advertisement = parent::_actionRead($context);
		
		if ($advertisement->link)
		{
			// increment click through
			// current visitor ip
			$visitor_ip = $_SERVER['REMOTE_ADDR'];
			
			// add blacklist filter
			/// @TODO

			KFactory::tmp('admin::com.adverts.database.row.stats_clicks')
				->setData(array(
					'campaign_id' => $advertisement->campaign_id,
					'advertisement_id' => $advertisement->id,
					'location'	=> KRequest::get('get.location', 'string'),
					'datetime'	=> date( 'Y-m-d H:i:s' ),
					'ip'		=> $visitor_ip
				))
				->save();
			
			
			
			KFactory::get('lib.joomla.application')->redirect($advertisement->link);
			return true;
		}
		
		return $advertisement;
	}
}