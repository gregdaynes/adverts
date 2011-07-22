<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsModelStatistics_Locations extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
    	$config->append(array(
    	    'table' => 'admin::com.adverts.database.table.statistics_impressions'
    	));
    	
        parent::__construct($config);
        
        $this->_state
            ->insert('advertisement',	'int')
            ;
    }
    
    public function _buildQueryColumns(KDatabaseQuery $query)
    {
    	parent::_buildQueryColumns($query);
    	
    	$query->select('tbl.location AS group_name');
    }
    
    public function _buildQueryWhere(KDatabaseQuery $query)
    {
    	parent::_buildQueryWhere($query);
    	
    	$state = $this->_state;
    	
    	if (is_numeric($state->advertisement)) {
    		$query->where('tbl.advertisement_id', '=', $state->advertisement);
    	}
    }
    
    public function _buildQueryGroup(KDatabaseQuery $query)
    {
    	parent::_buildQueryGroup($query);
    	
    	$query
    		->group('tbl.location');
    }
}