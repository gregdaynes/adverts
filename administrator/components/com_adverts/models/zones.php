<?php defined('KOOWA') or die('Restricted access');

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
	
	protected function _buildQueryColumns(KDatabaseQuery $query)
	{
		parent::_buildQueryColumns($query);
		
		$state = $this->_state;
		
		if (is_numeric($state->populated)) {
			$query
				->select('GROUP_CONCAT(campaign.adverts_campaign_id) AS campaigns')
				->select('SUM(campaign.enabled) AS campaign_state')
				;
		}
	}
	
	protected function _buildQueryJoins(KDatabaseQuery $query)
	{
		parent::_buildQueryJoins($query);
		
		$state = $this->_state;
		
		if (is_numeric($state->populated)) {
			$query
				->join('LEFT', 'adverts_campaign_zones AS cz', 'cz.zid = tbl.adverts_zone_id')
				->join('LEFT', 'adverts_campaigns AS campaign', 'cz.cid = campaign.adverts_campaign_id')
				;
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
				
		}
	}
	
	protected function _buildQueryGroup(KDatabaseQuery $query)
	{
		parent::_buildQueryGroup($query);
		
		$query->group('tbl.adverts_zone_id');

	}
	
	protected function _buildQueryHaving(KDatabaseQuery $query)
	{
		parent::_buildQueryHaving($query);
		
		$state = $this->_state;
		
		if (is_numeric($state->populated)) {
			if($state->populated == 1) {
				$query
					->having('campaign_state > 0')
					;
			} else {
				$query
					->having('campaign_state = 0 OR campaigns IS NULL')
					;
			}
		}

	}
}