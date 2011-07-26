<? /** $Id$ **/ ?>
<?php

class ModAdvertsHtml extends ModDefaultView
{
	public function display()
	{
		$advertisement = ModAdvertsHelper::getAdvert();
		$this->assign('advertisement', $advertisement);
		
		return parent::display(); 
	}
}