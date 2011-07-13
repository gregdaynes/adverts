<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementZones extends JElement
{
	var $_name = 'zones';
	
	function fetchElement( $name, $value, &$node, $control_name )
	{		
		$db =& JFactory::getDBO();
		
		$sql = 'SELECT id, name '
		. ' FROM ' . $db->nameQuote( '#__jbanners_zones' )
		;
		$db->setQuery($sql);
			
		$options[] = JHTML::_('select.option',  '0', JText::_( '- Select Zone -' ), 'id', 'name' );
		$options = array_merge( $options, $db->loadObjectList() );
		return JHTML::_('select.genericlist', $options, $control_name . '[' . $name .']', null, 'id', 'name', $value );
	}
}