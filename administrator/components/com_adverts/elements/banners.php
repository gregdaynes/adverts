<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementBanners extends JElement
{
	var $_name = 'banners';
	
	function fetchElement( $name, $value, &$node, $control_name )
	{		
		$db =& JFactory::getDBO();
		
		$where = '';
		if ($value)
		{
			$where = ' WHERE adverts_advertisement_id = ' . $value;
		}
		
		$sql = 'SELECT adverts_advertisement_id AS id, name '
		. ' FROM ' . $db->nameQuote( '#__adverts_advertisements' )
		. $where
		;
		$db->setQuery($sql);
			
		$options[] = JHTML::_('select.option',  '0', JText::_( '- Select Banner -' ), 'id', 'name' );
		$options = array_merge( $options, $db->loadObjectList() );
		return JHTML::_('select.genericlist', $options, $control_name . '[' . $name .']', null, 'id', 'name', $value );
	}
}