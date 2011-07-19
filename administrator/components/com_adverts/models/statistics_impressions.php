<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsModelStatistics_Impressions extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('advertisement',	'int')
            ->insert('campaign',		'int')
            ->insert('location',		'string')
            ->insert('time', 			'boolean')
            ;
    }
    
    protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	if ($this->_state->time) {
	    	$query->select('COUNT(tbl.advertisement_id) AS impressions');
    	}
    }
    
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        parent::_buildQueryWhere($query);
        
        $state = $this->_state;
        
        if (is_numeric($state->advertisement)) {
            $query->where('tbl.advertisement_id', '=', $state->advertisement);
        }
        
        if (is_numeric($state->campaign)) {
            $query->where('tbl.campaign_id', '=', $state->campaign);
        }
        
        if (is_string($state->location)) {
        	$query->where('tbl.location', '=', $state->location);
        }
    }
    
    protected function _buildQueryGroup(KDatabaseQuery $query)
    {
    	parent::_buildQueryGroup($query);
    	
    	if ($this->_state->time) {
    		$query->group('tbl.location');
    		$query->group('HOUR(tbl.datetime)');
    	}
    }
}