<?php /** $Id$ */ ?>
<?php // no direct acccess
defined('KOOWA') or die( 'Restricted access' ); ?>

<ul>
	<li class="<?= !is_numeric($state->client) ? 'active' : ''; ?>">
		<a href="<?= @route('client=' ) ?>">
		    <?= @text('All sites')?>
		</a>
	</li>
	<? foreach($clients as $client) : ?>
	<li class="<?= $state->client == $client->id ? 'active' : ''; ?>">
		<a href="<?= @route('client='.$client->id) ?>">
			<?= @escape($client->name) ?>
		</a>
	</li>
	<? endforeach ?>
</ul>