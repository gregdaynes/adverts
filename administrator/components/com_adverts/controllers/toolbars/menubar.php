<?php defined('KOOWA') or die('Restricted access');

class ComAdvertsControllerToolbarMenubar extends ComDefaultControllerToolbarMenubar
{
    public function getCommands()
    {
        $name = $this->getController()->getIdentifier()->name;
        
        $this->addCommand('Sites', array(
            'href'   => JRoute::_('index.php?option=com_adverts&view=sites'),
            'active' => ($name == 'site')
        ));
        
        $this->addCommand('Sizes', array(
        	'href'	=> JRoute::_('index.php?option=com_adverts&view=sizes'),
        	'active'	=> ($name == 'size')
        ));
        
        $this->addCommand('Zones', array(
            'href'   => JRoute::_('index.php?option=com_adverts&view=zones'),
            'active' => ($name == 'zone')
        ));
        
        $this->addCommand('Clients', array(
            'href'   => JRoute::_('index.php?option=com_adverts&view=clients'),
            'active' => ($name == 'client')
        ));
        
        $this->addCommand('Campaigns', array(
            'href'   => JRoute::_('index.php?option=com_adverts&view=campaigns'),
            'active' => ($name == 'campaign')
        ));
        
        $this->addCommand('Advertisements', array(
            'href'   => JRoute::_('index.php?option=com_adverts&view=advertisements'),
            'active' => ($name == 'advertisement')
        ));
        
        $this->addCommand('Statistics', array(
            'href'   => JRoute::_('index.php?option=com_adverts&view=statistics'),
            'active' => ($name == 'statistics')
        ));
                
        return parent::getCommands();
    }
}