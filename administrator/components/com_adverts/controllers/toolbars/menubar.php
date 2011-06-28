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
        
        return parent::getCommands();
    }
}