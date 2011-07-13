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
			$where = ' WHERE id = ' . $value;
		}
		
		$sql = 'SELECT id, name '
		. ' FROM ' . $db->nameQuote( '#__jbanners_banners' )
		. $where
		;
		$db->setQuery($sql);
			
		$options[] = JHTML::_('select.option',  '0', JText::_( '- Select Banner -' ), 'id', 'name' );
		$options = array_merge( $options, $db->loadObjectList() );
		return JHTML::_('select.genericlist', $options, $control_name . '[' . $name .']', null, 'id', 'name', $value );
	}
}