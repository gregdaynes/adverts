<?php defined('KOOWA') or die( 'Restricted access' ); ?>

<div id="filter" class="group">
	<ul>
		<li class="<?= !is_numeric($state->enabled) ? 'active' : ''; ?>">
			<a href="<?= @route('enabled=' ) ?>">
			    <?= @text('All') ?>
			</a>
		</li>              
	</ul>
</div>