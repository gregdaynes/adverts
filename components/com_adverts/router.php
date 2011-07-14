<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

function AdvertsBuildRoute(&$query)
{
	$segments = array();
	
	if (isset($query['view'])) {
		$segments[] = $query['view'];
		unset($query['view']);
	}
	
	if (isset($query['id'])) {
		$segments[] = $query['id'];
		unset($query['id']);
	}
	
	if (isset($query['location'])) {
		$segments[] = $query['location'];
		unset($query['location']);
	}
	
	return $segments;
}

/* Formats:
 * index.php?/adverts/id/location
 * view/id/location
 */
function AdvertsParseRoute($segments)
{
	$vars = array();
	
	$count = count($segments);
	
	if ($count >= 3)
	{
		$count --;
		$segment = array_shift($segments);
		$vars['view'] = $segment;
	}
	
	if ($count == 2)
	{
		$count --;
		$segment = array_shift($segments);
		$vars['id'] = $segment;
	}
	
	if ($count == 1)
	{
		$count --;
		$segment = array_shift($segments);
		$vars['location'] = $segment;
	}
	
	return $vars;
}