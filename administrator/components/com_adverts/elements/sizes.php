<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class JElementSizes extends JElement
{
	var $_name = 'sizes';
	
	function fetchElement( $name, $value, &$node, $control_name )
	{		
		$db =& JFactory::getDBO();
		
		$sql = 'SELECT size_name, width, height '
		. ' FROM ' . $db->nameQuote( '#__jbanners_zones' )
		. ' GROUP BY size_name, width, height '
		;
		$db->setQuery($sql);
		$sizes = $db->loadObjectList();

		foreach ($sizes as $size)
		{
			$query = 'SELECT id '
			. ' FROM ' . $db->nameQuote( '#__jbanners_zones' )
			. ' WHERE width = ' . $size->width
			. ' AND height = ' . $size->height
			;
			$db->setQuery( $query );
			$sizeids = $db->loadResultArray();
			$size->id = $sizeids[0];
			$size->value = implode( '|', $sizeids );
		}
		
		$options[] = JHTML::_('select.option',  '0', JText::_( '- Select Size -' ), 'id', 'size_name' );
		$options = array_merge( $options, $sizes );
		return JHTML::_('select.genericlist', $options, $control_name . '[' . $name .']', null, 'id', 'size_name', $value );
	}
}