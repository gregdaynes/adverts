<?php

class ComAdvertsControllerToolbarAdvertisements extends ComDefaultControllerToolbarDefault
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