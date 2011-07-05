<?php /** $Id$ */ ?>
<?php // no direct acccess
defined('KOOWA') or die( 'Restricted access' ); ?>

<ul>
	<li class="<?= !is_numeric($state->zone) ? 'active' : ''; ?>">
		<a href="<?= @route('zone=' ) ?>">
		    <?= @text('All Zones')?>
		</a>
	</li>
	<? foreach($zones as $zone) : ?>
	<li class="<?= $state->zone == $zone->id ? 'active' : ''; ?>">
		<a href="<?= @route('zone='.$zone->id) ?>">
			<?= @escape($zone->name) ?>
		</a>
	</li>
	<? endforeach ?>
</ul>