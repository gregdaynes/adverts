<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

// include helper
require_once( dirname( __FILE__ ).DS.'helper.php' );

echo KFactory::tmp('site::mod.adverts.view', array(
	'params'	=> $params,
	'module'	=> $module,
	'attribs'	=> $attribs
))->display();