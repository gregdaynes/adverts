<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die( 'Restricted access' ); ?>

<div id="sidebar" class="-koowa-box-scroll">
	<h3><?= @text('Sites')?></h3>
	<?= @template('admin::com.adverts.view.sites.list', array('sites' => KFactory::tmp('admin::com.adverts.model.sites')->getList())); ?>
</div>