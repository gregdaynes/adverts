<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsModelCampaigns extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('enabled', 'int')
            ->insert('client',	'int')
            ->insert('zone',	'int')
            ;
    }
    
    protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	$query
    		->select('GROUP_CONCAT(cz.zid) AS zones');
    }
    
    protected function _buildQueryJoins(KDatabaseQuery $query)
    {
    	parent::_buildQueryJoins($query);
    	
    	$query
    		->join('LEFT', 'adverts_campaign_zones AS cz', 'cz.cid = tbl.adverts_campaign_id');
    }
    
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        parent::_buildQueryWhere($query);
        
        $state = $this->_state;
        
        if (is_numeric($state->enabled)) {
            $query->where('tbl.enabled', '=', $state->enabled);
        }
        
        if (is_numeric($state->website)) {
        	$query->where('tbl.client_id', '=', $state->client);
        }
        
        if (is_numeric($state->zone)) {
        	$query->where('cz.zid', '=', $state->zone);
        }
    }
}