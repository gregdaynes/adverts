 <? /** $Id$ **/ ?>
<?php defined('KOOWA') or die('Restricted access');

echo KFactory::tmp('site::mod.adverts.html', array(
	'params'	=> $params,
	'module'	=> $module,
	'attribs'	=> $attribs
))->display();