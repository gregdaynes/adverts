<?	
$doc =& JFactory::getDocument();
$doc->addScript("https://www.google.com/jsapi");

$data_array = array();

// location groups
foreach($statistics as $statistic) {
	
	// time group
	foreach($statistic->time as $time) {
		
		if (isset($data_array[$time->datetime])) {
			$data_array[$time->datetime]->impressions += $time->impressions;
			$data_array[$time->datetime]->impressions += $time->clicks;
		} else {	
			$data_array[$time->datetime] = $time;
		}
	}
}

sort($data_array);

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