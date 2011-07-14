<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

echo KFactory::get('site::com.adverts.dispatcher')->dispatch();