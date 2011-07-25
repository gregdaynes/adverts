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
            
            // filters
            ->insert('time', 			'int')
            ->insert('date',			'int')
            ;
    }
    
    protected function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	$state = $this->_state;

    	$query->select('COUNT(tbl.advertisement_id) AS impressions');
    		
    	if (!is_numeric($state->date)) {
    		$query->select('tbl.datetime + INTERVAL CASE WHEN EXTRACT(MINUTE_SECOND FROM tbl.datetime) BETWEEN 0 AND 5959 THEN + 0 - TIME_TO_SEC(EXTRACT(MINUTE_SECOND FROM tbl.datetime)) END SECOND AS datetime_filter');
    	}
    	
    	if ($state->date) {
    		
    		if ($state->date == 1) {
    			$query->select('DATE(tbl.datetime) AS datetime_filter');
    		}
    		
    		if ($state->date >= 2) {
    			$query->select('tbl.datetime AS datetime_filter');
    		}
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
        
        if (is_numeric($state->time)) {
        	$end_time = 3599; // one hour
        	
        	if ($state->date == 1) {
        		$end_time = 86399; // one day
        	}

        	if ($state->date == 2) {
        		$state->time = date('Y-m-01 00:00:00', $state->time);
        		$end_time = strtotime($state->time . '+1 month' );
        	}
        	
        	if ($state->date == 3) {
        		$state->time = date('Y-01-01 00:00:00', $state-time);
        		$end_time	= $strtotime($state->time . '+1 year');
        	}
        	
        	$query
        		->where('UNIX_TIMESTAMP(tbl.datetime)', '>=', $state->time)
        		->where('UNIX_TIMESTAMP(tbl.datetime)', '<=', ($state->time + $end_time))
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
    	
		if (!is_numeric($state->date)) {
			$query->group('datetime_filter');
		}
		
		if ($state->date == 1) {
			$query->group('DATE(tbl.datetime)');
		}
		
		if ($state->date == 2) {
			$query
				->group('YEAR(tbl.datetime)')
				->group('MONTH(tbl.datetime)')
				;
		}

		
    }
    
    protected function _buildQueryOrder(KDatabaseQuery $query) 
    {
    	parent::_buildQueryOrder($query);
    	
    	$query->order('tbl.datetime', 'DESC');
    }
}