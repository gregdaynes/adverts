<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementLayoutoptions extends JElement
{
	var $_name = 'layoutoptions';
		
	function fetchElement( $name, $value, &$node, $control_name )
	{	
		$document =& JFactory::getDocument();
		$document->addScript( '../modules/mod_jbanners/elements/javascript/module.js' );

		return '<div id="layoutoptions"><hr /></div>';
	}
}