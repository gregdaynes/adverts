<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsControllerToolbarMenubar extends ComDefaultControllerToolbarMenubar
{
    public function getCommands()
    {
        $name = $this->getController()->getIdentifier()->name;
        
        $this->addCommand('Sites', array(
                'href'   => JRoute::_('index.php?option=com_adverts&view=sites'),
                'active' => ($name == 'site')
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
        
                
        return parent::getCommands();
    }
}