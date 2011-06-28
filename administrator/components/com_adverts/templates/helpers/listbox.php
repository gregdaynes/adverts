<? /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access');

class ComAdvertsTemplateHelperListbox extends ComDefaultTemplateHelperListbox
{
	public function site($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'model'		=> 'sites',
			'name' 		=> 'adverts_site_id',
			'attribs'	=> $config->attribs
		))->append(array(
			'value'		=> $config->name,
			'selected'	=> $config->selected
		))->append(array(
			'text'		=> $config->value,
			'deselect'  => true
		));
		
		$model = KFactory::tmp('admin::com.adverts.model.sites');

		$list = $model->getList($config->column);
		
		$options   = array();
		if($config->deselect) {
			$options[] = $this->option(array('text' => '- '.JText::_( 'Select').' -'));
		}
		
		foreach($list as $item) {
			$options[] =  $this->option(array('text' => $item->{$config->text}, 'value' => $item->{$config->value}));
		}
		
		//Add the options to the config object
		$config->options = $options;
	
		return $this->optionlist($config);
	}
	
	public function size($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'attribs'	=> $config->attribs
		))->append(array(
			'value'		=> $config->name,
			'selected'	=> $config->selected
		))->append(array(
			'text'		=> $config->value,
			'deselect'  => true
		));
			
		// default item
		if ($config->deselect) {
			$options[] =  $this->option(array('text' => JText::_($config->prompt)));
		}
		
		// parse sizes array
		$sizes = $this->_size_array();
		foreach ($sizes as $size) {
			// attribs allows for deselect
			if (!isset($size['attribs'])) {
				$size['attribs'] = null;
			}
			$options[] = $this->option(array('text' => $size['text'], 'value' => $size['value'], 'attribs' => $size['attribs']));
		}
				
		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}
	
	public function zone($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'model'		=> 'zones',
			'name' 		=> 'adverts_zone_id',
			'attribs'	=> $config->attribs
		))->append(array(
			'value'		=> $config->name,
			'selected'	=> $config->selected
		))->append(array(
			'text'		=> $config->value,
			'deselect'  => true
		));
		
		$model = KFactory::tmp('admin::com.adverts.model.zones');
		$list = $model->getList($config->column);
		
		$options   = array();
		if($config->deselect) {
			$options[] = $this->option(array('text' => '- '.JText::_( 'Select').' -'));
		}
		
		foreach($list as $item) {
			$options[] =  $this->option(array('text' => $item->{$config->text}, 'value' => $item->{$config->value}));
		}
		
		//Add the options to the config object
		$config->options = $options;
	
		return $this->optionlist($config);
	}
	
	public function fetch_size($config = array())
	{
		$config = new KConfig($config);
		$options = $this->_size_array();
		$size_name = $this->_size_search($options, 'value', $config->value);
		
		return $size_name[0]['text'];
	}
	
	private function _size_search($array, $key, $value) {
		$results = array();
		
		if (is_array($array))
		{
			if (isset($array[$key])) {
				if ($array[$key] == $value)
					$results[] = $array;
			}	
			
			foreach ($array as $subarray)
				$results = array_merge($results, $this->_size_search($subarray, $key, $value));
		}
		
		return $results;
	}
	
	private function _size_array()
	{
		$options = array();
		
		$options[] = array('text' => JText::_('Custom'), 'value' => -1);
		
		$options[] = array('text' => JTexT::_('Rectangles &amp; Popups'), 'value' => 0, 'attribs' => array('disabled' => 'disabled'));
		$options[] = array('text' => JText::_('300 x 250 IMU - Medium Rectangle'), 'value' => 1);
		$options[] = array('text' => JText::_('250 x 250 IMU - Square Pop-up'), 'value' => 2);
		$options[] = array('text' => JText::_('240 x 400 IMU - Vertical Rectangle'), 'value' => 3);
		$options[] = array('text' => JText::_('336 x 280 IMU - Large Rectangle'), 'value' => 4);
		$options[] = array('text' => JText::_('180 x 150 IMU - Rectangle'), 'value' => 5);
		$options[] = array('text' => JText::_('300 x 100 IMU - 3:1 Rectangle'), 'value' => 6);
		$options[] = array('text' => JText::_('720 x 300 IMU - Pop-under'), 'value' => 7);
		
		$options[] = array('text' => JText::_('Banners &amp; Buttons'), 'value' => 0, 'attribs' => array('disabled' => 'disabled'));
		$options[] = array('text' => JText::_('468 x 60 IMU - Full Banner'), 'value' => 8);
		$options[] = array('text' => JText::_('234 x 60 IMU - Half Banner'), 'value' => 9);
		$options[] = array('text' => JText::_('88 x 31 IMU - Micro Bar'), 'value' => 10);
		$options[] = array('text' => JText::_('120 x 90 IMU - Button 1'), 'value' => 11);
		$options[] = array('text' => JText::_('120 x 60 IMU - Button 2'), 'value' => 12);
		$options[] = array('text' => JText::_('120 x 240 IMU - Vertical Banner'), 'value' => 13);
		$options[] = array('text' => JText::_('125 x 125 IMU - Square Button'), 'value' => 14);
		$options[] = array('text' => JText::_('728 x 90 IMU - Leaderboard'), 'value' => 15);
		
		$options[] = array('text' => JText::_('Skyscrapers'), 'value' => 0, 'attribs' => array('disabled' => 'disabled'));
		$options[] = array('text' => JText::_('160 x 600 IMU - Wide Skyscraper'), 'value' => 16);
		$options[] = array('text' => JText::_('120 x 600 IMU - Skyscraper'), 'value' => 17);
		$options[] = array('text' => JText::_('300 x 600 IMU - Half Page Ad'), 'value' => 18);
		
		return (array) $options;
	}
}