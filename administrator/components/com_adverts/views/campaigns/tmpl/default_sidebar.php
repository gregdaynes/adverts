<?php defined('KOOWA') or die( 'Restricted access' ); ?>

<div id="sidebar" class="-koowa-box-scroll">
	<h3><?= @text('Zones')?></h3>
	<?= @template('admin::com.adverts.view.zones.list', array('zones' => KFactory::tmp('admin::com.adverts.model.zones')->getList())); ?>
	
	<h3><?= @text('Clients')?></h3>
	<?= @template('admin::com.adverts.view.clients.list', array('clients' => KFactory::tmp('admin::com.adverts.model.clients')->getList())); ?>	
</div>