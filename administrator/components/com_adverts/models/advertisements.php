<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsModelAdvertisements extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('enabled', 'int')
            ->insert('client',	'int')
            ->insert('campaign',	'int')
            ->insert('advertisement',	'int')
            ->insert('zone',	'int')
            ->insert('pull',	'int') // for pulling banner
            ->insert('view',	'string')
            ->insert('tmpl',	'string')
            ;
    }
    
    protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	$state = $this->_state;
    	
    	if ($state->view == 'advertisement')
    	{
        	$query
        		->select('GROUP_CONCAT(az.zid) AS zones')
        		;
        }
        
        if ($state->view == 'advertisements')
        {
        	$query
        		->select('campaign.name AS campaign_name')
        		;
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
        
        if (is_numeric($state->client) && $state->client > 0) {
        	$query->where('tbl.client_id', '=', $state->client);
        } 
        
        if (is_numeric($state->campaign) && $state->campaign > 0) {
        	$query->where('tbl.campaign_id', '=', $state->campaign);
        }
        
        if (is_numeric($state->zone) && $state->zone > 0) {
        	$query->where('az.zid', '=', $state->zone);
        }
        
        if (is_numeric($state->advertisement) && $state->advertisement > 0) {
        	$query->where('tbl.adverts_advertisement_id', '=', $state->advertisement);
        }
        
        // pulling ad for render
        if (is_numeric($state->pull))
        {
	        // repeat advertisement
	        if (isset($_SESSION['previous_advertisement'])) {
	        	// @TODO
	        }
	        
	        // repeat campaign
	        if (isset($_SESSION['previous_campaign'])) {
	        	// @TODO
	        }
	        
	        // publish up
	        // @TODO
	        
	        // publish down
	    	// @TODO
	    }
    }
}