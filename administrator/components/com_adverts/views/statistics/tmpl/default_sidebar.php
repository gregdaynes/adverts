<?php defined('KOOWA') or die( 'Restricted access' ); ?>

<div id="sidebar" class="split">
	<div class="sidebar_25">
		<h3><?= @text('Zones')?></h3>
		<?= @template('admin::com.adverts.view.zones.list', array('zones' => KFactory::tmp('admin::com.adverts.model.zones')->getList())); ?>
	</div>
	
	<div class="sidebar_75">
		<h3><?= @text('Clients')?></h3>
		<?= @template('admin::com.adverts.view.clients.list', array('clients' => KFactory::tmp('admin::com.adverts.model.clients')->getList())); ?>
	</div>
</div>