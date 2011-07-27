<? 
	$parts = array(
		'id'	=> KRequest::get('get.id', 'int'),
		'group'	=> $state->group,
		'date'	=> $state->date
	);
	
	$route = new stdClass();
	
	foreach($parts as $index => $value) {
		$route->$index = $index.'='.$value;
	}
?>

<div id="filter" class="group">
	<ul>
		<li class="<?= !is_numeric($state->group) ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->date.'&group=') ?>">
			    <?= @text('All') ?>
			</a> 
		</li>
		
		<li class="<?= ($state->group) == '1' ? 'active' : ''; ?> separator-right">
			<a href="<?= @route($route->id.'&'.$route->date.'&group=1') ?>">
			    <?= @text('Location') ?>
			</a>
		</li>  
	
		<li class="<?= !is_numeric($state->date) ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&date=') ?>">
			    <?= @text('Hour') ?>
			</a>
		</li>   
		           
		<li class="<?= $state->date == '1' ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&date=1') ?>">
			    <?= @text('Day') ?>
			</a> 
		</li>
		
		<li class="<?= $state->date == '2' ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&date=2') ?>">
			    <?= @text('Month') ?>
			</a> 
		</li>
		
		<li class="<?= $state->date == '3' ? 'active' : ''; ?>">
			<a href="<?= @route($route->id.'&'.$route->group.'&date=3') ?>">
			    <?= @text('Year') ?>
			</a> 
		</li>
		
	</ul>
</div>