<?	
$doc =& JFactory::getDocument();
$doc->addScript("https://www.google.com/jsapi");

$data_array = array();

// location groups
foreach($statistics as $statistic) {
	
	// time group
	foreach($statistic->time as $time) {
		
		$datetime = null;
		
		if (!is_numeric($state->date)) { 
			$datetime = strtotime(date("Y-m-d g:00:00", strtotime($time->datetime)));
		}
		
		if ($state->date == 1) {
			$datetime = strtotime(date("Y-m-d 00:00:00", strtotime($time->datetime)));
		}
		
		
		if ($state->date == 2) {
			$datetime = strtotime(date("Y-m-01 00:00:00", strtotime($time->datetime)));
		}
		
		if ($state->date == 3) {
			$datetime = strtotime(date("Y-01-01 00:00:00", strtotime($time->datetime)));
		}
		
		
		$key = array_search($datetime, $data_array->datetime);
		
		if ($key) {
			$data_array[$key]->impressions += $time->impressions;
			$data_array[$key]->clicks += $time->clicks;
			$data_array[$key]->datetime = $datetime;
		} else {
			$data_array[] = $time;
			$data_array[]->datetime = $datetime;
		}

	}
}

sort($data_array);
foreach($data_array as $index=>$data_point) {
	echo $data_point->datetime."\n";
}
exit;

?>

<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Hour');
		data.addColumn('number', 'Impressions');
		data.addColumn('number', 'Click Throughs');
		data.addRows(<?= count($data_array); ?>);

		<? 
		foreach($data_array as $index => $data_point) {
			// column title
			echo 'data.setValue('.$index.', 0, "'.$data_point->datetime.'");';
			// impressions
			echo 'data.setValue('.$index.', 1, '.$data_point->impressions.');';
			// clicks
			echo 'data.setValue('.$index.', 2, '.$data_point->clicks.');';
		}
		?>


		var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		chart.draw(data, { height: 250, title: 'Statistics'});
	}
</script>



<div id="chart_div"></div>
