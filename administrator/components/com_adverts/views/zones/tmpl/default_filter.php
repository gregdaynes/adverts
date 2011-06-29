<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die( 'Restricted access' ); ?>

<div id="filter" class="group">
	<ul>
		<li class="<?= !is_numeric($state->enabled) && !is_numeric($state->populated) ? 'active' : ''; ?> separator-right">
			<a href="<?= @route('enabled=&populated=' ) ?>">
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
		
		<li class="<?= $state->populated == '1' ? 'active' : ''; ?>">
			<a href="<?= @route('populated=1' ) ?>">
			    <?= @text('Has Banners') ?>
			</a> 
		</li>
		<li class="<?= $state->populated == '0' ? 'active' : ''; ?> separator-right">
			<a href="<?= @route('populated=0' ) ?>">
			    <?= @text('Empty') ?>
			</a> 
		</li>
		
	</ul>
</div>