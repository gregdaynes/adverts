<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die( 'Restricted access' ); ?>

<div id="filter" class="group">
	<ul>
		<li class="<?= !is_numeric($state->enabled) ? 'active' : ''; ?> separator-right">
			<a href="<?= @route('enabled=' ) ?>">
			    <?= @text('All') ?>
			</a>
		</li>              
		<li class="<?= $state->enabled == '1' ? 'active' : ''; ?>">
			<a href="<?= @route('enabled=1' ) ?>">
			    <?= @text('Published') ?>
			</a> 
		</li>
		<li class="<?= $state->enabled == '0' ? 'active' : ''; ?> separator-right">
			<a href="<?= @route('enabled=0' ) ?>">
			    <?= @text('Unpublished') ?>
			</a> 
		</li>

	</ul>
</div>