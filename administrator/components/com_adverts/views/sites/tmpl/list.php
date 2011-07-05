<?php /** $Id$ */ ?>
<?php // no direct acccess
defined('KOOWA') or die( 'Restricted access' ); ?>

<ul>
	<li class="<?= !is_numeric($state->website) ? 'active' : ''; ?>">
		<a href="<?= @route('website=' ) ?>">
		    <?= @text('All sites')?>
		</a>
	</li>
	<? foreach($sites as $site) : ?>
	<li class="<?= $state->website == $site->id ? 'active' : ''; ?>">
		<a href="<?= @route('website='.$site->id) ?>">
			<?= @escape($site->name) ?>
		</a>
	</li>
	<? endforeach ?>
</ul>