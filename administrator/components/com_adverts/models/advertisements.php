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
        		->select('GROUP_CONCAT(az.zid) AS zones');
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
    	
    	$state = $this->_state;
    	
    	if ($state->view == 'advertisements')
    	{
        	$query
        		->join('LEFT', 'adverts_advertisement_zones AS az', 'az.aid = tbl.adverts_advertisement_id');
        }
        
        if ($state->view == 'campaigns' && is_numeric($state->zone))
        {
    	    $query
    	    	->join('LEFT', 'adverts_advertisement_zones AS az', 'az.aid = tbl.adverts_advertisement_id');
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
        	$query->where('az.zid', '=', $state->zone);
        }
    }
}