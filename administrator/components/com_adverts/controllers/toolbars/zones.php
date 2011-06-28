<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsControllerToolbarZones extends ComDefaultControllerToolbarDefault
{
	public function getCommands()
	{
		$this->addSeperator()
		     ->addEnable()
		     ->addDisable()
		     ->addSeperator()
		     ->addModal(array(
			'label'	 => 'Preferences',
			'height' => 88,
			'href'   => 'index.php?option=com_config&controller=component&component=com_adverts'
		));
		 
		return parent::getCommands();
	}
}