<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsControllerToolbarSizes extends ComDefaultControllerToolbarDefault
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