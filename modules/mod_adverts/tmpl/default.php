<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access'); 

$unique = md5(uniqid(rand(), true));
?>

<div id="advert_<?= $unique; ?>" class="advertisement">
	<?= @template('site::mod.adverts.default_'.$advertisement->type, array('unique' => $unique)); ?>
</div>