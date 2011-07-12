<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ModAdvertsView extends ModDefaultView
{
	public function display()
	{	
		// set template from param
		$this->_layout->name = $this->params->get('layout');
	
		$this->output = $this->getTemplate()
		        ->loadIdentifier($this->_layout, $this->_data)
		        ->render();
		        
		return $this->output;
	}
}