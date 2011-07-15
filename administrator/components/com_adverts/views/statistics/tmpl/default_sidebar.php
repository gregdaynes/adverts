<?php defined('KOOWA') or die( 'Restricted access' ); ?>

<div id="sidebar" class="split">
	<div>
		<h3><?= @text('Clients')?></h3>
		<?= @template('admin::com.adverts.view.clients.list', array('clients' => KFactory::tmp('admin::com.adverts.model.clients')->getList())); ?>
	</div>
</div>