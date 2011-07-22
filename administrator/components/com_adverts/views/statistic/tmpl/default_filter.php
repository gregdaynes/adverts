<?php defined('KOOWA') or die( 'Restricted access' ); ?>

<? 
	$parts = array(
		'id'	=> KRequest::get('get.id', 'int'),
		'group'	=> $state->group,
		'time'	=> $state->time
	);
	
	$route = new stdClass();
	
	foreach($parts as $index => $value) {
		$route->$index = $index.'='.$value;
	}
?>

<div id="filter" class="group">
	<ul>
		<li class="<?= !is_numeric($state->group) ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->time.'&group=') ?>">
			    <?= @text('All') ?>
			</a> 
		</li>
		
		<li class="<?= ($state->group) == '1' ? 'active' : ''; ?> separator-right">
			<a href="<?= @route($route->id.'&'.$route->time.'&group=1') ?>">
			    <?= @text('Location') ?>
			</a>
		</li>  
	
		<li class="<?= !is_numeric($state->time) ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&time=') ?>">
			    <?= @text('Hour') ?>
			</a>
		</li>   
		           
		<li class="<?= $state->time == '1' ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&time=1') ?>">
			    <?= @text('Day') ?>
			</a> 
		</li>
		
		<li class="<?= $state->time == '2' ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&time=2') ?>">
			    <?= @text('Month') ?>
			</a> 
		</li>
		
		<li class="<?= $state->time == '3' ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&time=3') ?>">
			    <?= @text('Year') ?>
			</a> 
		</li>
		
	</ul>
</div>