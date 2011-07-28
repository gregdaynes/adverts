<?	
$doc =& JFactory::getDocument();
$doc->addScript("https://www.google.com/jsapi");

$data_array = null;

// location groups
foreach($statistics as $location) {
		
	// time group
	foreach($location->time as $time) {
		
		$index = strtotime($time->datetime);
		
		if (isset($data_array[$index])) {
			$data_array[$index]->impressions += $time->impressions;
			$data_array[$index]->clicks += $time->clicks;
			
		} else {
			$data_array[$index]->impressions = $time->impressions;
			$data_array[$index]->clicks = $time->clicks;
			$data_array[$index]->datetime = $time->datetime;
		}
	}
}

// sort array by time
ksort($data_array);

// reindex array for js
$data_array = array_values($data_array);
?>

<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', '<?= @text('Timeline'); ?>');
		data.addColumn('number', '<?= @text('Imps'); ?>');
		data.addColumn('number', '<?= @text('Clicks'); ?>');
		data.addRows(<?= count($data_array); ?>);

		<? 
		foreach($data_array as $i => $data_point) {
			// column title
			echo 'data.setValue('.$i.', 0, "'.$data_point->datetime.'");';
			// impressions
			echo 'data.setValue('.$i.', 1, '.$data_point->impressions.');';
			// clicks
			echo 'data.setValue('.$i.', 2, '.$data_point->clicks.');';
		}
		?>

		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		chart.draw(data, { 
			height: 250,
			title: 'Statistics'
		});
	}
</script>

<div id="chart_div"></div>