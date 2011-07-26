<?php

class ComAdvertsModelCampaigns extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('enabled', 'int')
            ->insert('client',	'int')
            ->insert('zone',	'int')
            ->insert('view',	'string')
            ;
	}
    
    protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	$state = $this->_state;
    	
    	if ($state->view == 'campaign')
    	{
	    	$query
	    		->select('GROUP_CONCAT(cz.zid) AS zones');
	    }
    }
    
    protected function _buildQueryFrom(KDatabaseQuery $query)
    {
    	parent::_buildQueryFrom($query);
    	
    	$state = $this->_state;
    	
    	if ($state->view == 'campaigns' && is_numeric($state->zone) == false)
    	{
    		$query
    			->from('adverts_campaign_zones AS cz');
    	}
    }
    
    protected function _buildQueryJoins(KDatabaseQuery $query)
    {
    	parent::_buildQueryJoins($query);
    	
    	$state = $this->_state;
    	
    	if ($state->view == 'campaign')
    	{
	    	$query
	    		->join('LEFT', 'adverts_campaign_zones AS cz', 'cz.cid = tbl.adverts_campaign_id');
	    }
	    
	    if ($state->view == 'campaigns' && is_numeric($state->zone))
	    {
		    $query
		    	->join('LEFT', 'adverts_campaign_zones AS cz', 'cz.cid = tbl.adverts_campaign_id');
		}
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
        	$query->where('cz.zid', '=', $state->zone);
        }
    }
}