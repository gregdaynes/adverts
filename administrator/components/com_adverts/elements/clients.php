<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementClients extends JElement
{
	var $_name = 'clients';
	
	function fetchElement( $name, $value, &$node, $control_name )
	{		
		$db =& JFactory::getDBO();
		
		$sql = 'SELECT adverts_client_id, name '
		. ' FROM ' . $db->nameQuote( '#__adverts_clients' )
		;
		$db->setQuery($sql);
			
		$options[] = JHTML::_('select.option',  '0', JText::_( '- Select Client -' ), 'adverts_client_id', 'name' );
		$options = array_merge( $options, $db->loadObjectList() );
		return JHTML::_('select.genericlist', $options, $control_name . '[' . $name .']', null, 'adverts_client_id', 'name', $value );
	}
}