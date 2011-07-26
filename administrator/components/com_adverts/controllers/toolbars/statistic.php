<?php

class ComAdvertsControllerToolbarStatistic extends ComDefaultControllerToolbarDefault
{
	public function getCommands()
	{
		$this->addClose()
			 ;
		 
		return parent::getCommands();
	}
	
	protected function _commandClose(KControllerToolbarCommand $command)
	{
		$view	 = KInflector::pluralize($this->_identifier->name);
	
	    $command->append(array(
	        'icon'       => 'icon-32-close',
	        'id'         => 'close',
	        'label'      => ucfirst('close'),
	        'disabled'   => false,
	        'title'		 => '', 
	        'attribs'    => array(
	            'href'     => JRoute::_('index.php?option=com_adverts&view='.$view )
	        )
	    ));
	}

}