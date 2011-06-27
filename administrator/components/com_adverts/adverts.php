<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

echo KFactory::get('admin::com.adverts.dispatcher')->dispatch();