<? /** $Id$ **/ ?>
<?php defined('KOOWA') or die('Restricted access');

class ModAdvertsView extends ModDefaultView
{
	public function display()
	{
		$advertisement = ModAdvertsHelper::getAdvert();
		$this->assign('advertisement', $advertisement);
		
		return parent::display(); 
	}
}