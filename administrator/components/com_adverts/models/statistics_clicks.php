<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsModelStatistics_Clicks extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('advertisement',	'int')
            ->insert('campaign',		'int')
            ->insert('location',		'string')
            
            // filters
            ->insert('time', 			'int')
            ;
    }
    
    protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	$state = $this->_state;

    	$query
    		->select('COUNT(tbl.advertisement_id) AS clicks')
    		->select('tbl.datetime + INTERVAL CASE WHEN EXTRACT(MINUTE_SECOND FROM tbl.datetime) BETWEEN 0 AND 5959 THEN + 0 - TIME_TO_SEC(EXTRACT(MINUTE_SECOND FROM tbl.datetime)) END SECOND AS datetime_hour');
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
        
        if (is_numeric($state->time)) {
        	$query
        		->where('UNIX_TIMESTAMP(tbl.datetime)', '>=', $state->time)
        		->where('UNIX_TIMESTAMP(tbl.datetime)', '<=', ($state->time + 3599))
        		;
        }
    }
    
    protected function _buildQueryGroup(KDatabaseQuery $query)
    {
    	parent::_buildQueryGroup($query);
    	
    	$state = $this->_state;
    	
    	if ($state->location) {
    		$query->group('tbl.location');
    	}
    	
		$query->group('datetime_hour');
		
    }
    
    protected function _buildQueryOrder(KDatabaseQuery $query) 
    {
    	parent::_buildQueryOrder($query);
    	
    	$query->order('tbl.datetime', 'DESC');
    }
}