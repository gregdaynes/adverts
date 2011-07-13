<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsModelStats_Clicks extends ComDefaultModelDefault
{
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
        $this->_state
            ->insert('advertisement_id',	'int')
            ->insert('campaign_id',	'int')
            ;
    }
        
    protected function _buildQueryWhere(KDatabaseQuery $query)
    {
        parent::_buildQueryWhere($query);
        
        $state = $this->_state;
        
        if (is_numeric($state->advertisement_id)) {
            $query->where('tbl.advertisement_id', '=', $state->advertisement_id);
        }
        
        if (is_numeric($state->campaign_id)) {
            $query->where('tbl.campaign_id', '=', $state->campaign_id);
        }
    }
}