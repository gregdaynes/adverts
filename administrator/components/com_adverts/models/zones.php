<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsModelZones extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('enabled',		'int')
            ->insert('website',		'int')
            ->insert('populated',	'int')
            ;
    }
    
    protected function _buildQueryJoins(KDatabaseQuery $query)
    {
    	parent::_buildQueryJoins($query);
    	
    	$state = $this->_state;
    	
    	if (is_numeric($state->populated)) {
	    	$query->join('LEFT', 'adverts_campaigns AS campaign', 'FIND_IN_SET(tbl.adverts_zone_id,campaign.zones) > 0');
    	}
    }
    
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        parent::_buildQueryWhere($query);
        
        $state = $this->_state;
        
        if (is_numeric($state->enabled)) {
            $query->where('tbl.enabled', '=', $state->enabled);
        }
        
        if (is_numeric($state->website)) {
        	$query->where('tbl.site_id', '=', $state->website);
        }
        
        if (is_numeric($state->populated)) {
	        $tmp = 'IS NULL';
	        
	        if ($state->populated == 1) {
	        	$tmp = 'IS NOT NULL';
	       	}
	   
	        $query->where('campaign.zones', $tmp);
	        
	   }
    }
    
    protected function _buildQueryGroup(KDatabaseQuery $query)
    {
    	parent::_buildQueryGroup($query);
    	
    	$query->group('tbl.adverts_zone_id');
    }
}