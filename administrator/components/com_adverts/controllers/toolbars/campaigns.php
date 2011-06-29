<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsControllerToolbarCampaigns extends ComDefaultControllerToolbarDefault
{
	public function getCommands()
	{
		$this->addSeperator()
		     ->addEnable()
		     ->addDisable()
			 ;
		 
		return parent::getCommands();
	}
}