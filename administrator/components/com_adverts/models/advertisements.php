<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsModelAdvertisements extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('enabled', 'int')
            ->insert('client',	'int')
            ->insert('zone',	'int')
            ->insert('pull',	'int') // for pulling banner
            ->insert('view',	'string')
            ->insert('tmpl',	'string')
            ->insert('repeatAdvertisement',	'int')
            ->insert('repeatCampaign',	'int')
            ;
    }
    
    protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	$state = $this->_state;
    	
    	if ($state->view == 'advertisement')
    	{
        	$query
        		->select('GROUP_CONCAT(az.zid) AS zones');
        }
        
        if (is_numeric($state->pull))
        {
        	$query
        		->select('campaign.impressions AS campaign_impressions')
        		->select('campaign.clicks AS campaign_clicks')
        		->select('campaign.weight AS campaign_weight');
        }
    }
    
    protected function _buildQueryFrom(KDatabaseQuery $query)
    {
    	parent::_buildQueryFrom($query);
    	
    	$state = $this->_state;
    	
    	if ($state->view == 'advertisement' && is_numeric($state->zone) == false)
    	{
    		$query
    			->from('adverts_advertisement_zones AS az');
    	}
    }
    
    protected function _buildQueryJoins(KDatabaseQuery $query)
    {
    	parent::_buildQueryJoins($query);

        $query
        	->join('LEFT', 'adverts_advertisement_zones AS az', 'az.aid = tbl.adverts_advertisement_id')
        	->join('LEFT', 'adverts_campaigns AS campaign', 'tbl.campaign_id = campaign.adverts_campaign_id');
    }
    
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        parent::_buildQueryWhere($query);
        
        $state = $this->_state;
        
        if (is_numeric($state->enabled)) {
            $query->where('tbl.enabled', '=', $state->enabled);
        }
        
        if (is_numeric($state->client)) {
        	$query->where('tbl.client_id', '=', $state->client);
        }
        
        if (is_numeric($state->zone)) {
        	$query->where('az.zid', '=', $state->zone);
        }
        
        // pulling ad for render
        if (is_numeric($state->pull)) {
	        // repeat ad
	        if (is_numeric($state->repeatAdvertisement)) {
	        	if (isset($previous_advertisement)) {
	        		//$previousBanners = '(b.id != ' . implode( ' AND b.id != ', $previousBanners ) . ')';
	        	}
	        }
	        
	        // repeat campaign
	        if (is_numeric($state->repeatCampaign)) {
	        	if (isset($previous_campaigns)) {
	        		//$previousCampaigns = '(b.id != ' . implode( ' AND b.id != ', $previousBanners ) . ')';
	        	}
	        	
	        }
	        
	        // publish up
	        
	        // publish down
	    }
    }
}