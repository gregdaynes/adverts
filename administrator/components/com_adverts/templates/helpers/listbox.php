<?php

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
			'name' 		=> 'sizes'
		))->append(array(
			
			'value'		=> 'id',
			'text'		=> 'name',
		))->append(array(
			'prompt'    => '- Select -',
			'deselect'	=> true,
			'column'    => $config->value,
		));
		
		$list = KFactory::tmp('admin::com.adverts.model.sizes')
					->getColumn($config->column);
				
        $options   = array();
 		if($config->deselect) {
         	$options[] = $this->option(array('text' => JText::_($config->prompt)));
        }
		
 		foreach($list as $item) {
			$options[] =  $this->option(array('text' => $item->{$config->text}, 'value' => $item->{$config->value}));
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
	
	public function client($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'model'		=> 'clients',
			'name' 		=> 'adverts_client_id',
			'attribs'	=> $config->attribs
		))->append(array(
			'value'		=> $config->name,
			'selected'	=> $config->selected
		))->append(array(
			'text'		=> $config->value,
			'deselect'  => true
		));
				
		$model = KFactory::tmp('admin::com.adverts.model.clients');
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
	
	public function sales_person($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'app'		=> 'admin',
			'package'	=> 'contact',
			'model'		=> 'contacts',
			'name' 		=> 'id',
			'attribs'	=> $config->attribs
		))->append(array(
			'value'		=> $config->name,
			'selected'	=> $config->selected
		))->append(array(
			'text'		=> $config->value,
			'deselect'  => true
		));
				
		$app		= $config->app;
		$package	= $config->package;
		
		$identifier = $app.'::com.'.$package.'.model.'.($config->model ? $config->model : KInflector::pluralize($package));
		
		$model = KFactory::tmp($identifier);
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
	
	public function price_model($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'deselect'  => true,
			'prompt'	=> '- Select -',
			'attribs'	=> $config->attribs
		))->append(array(
			'selected'	=> $config->selected
		));
				
		if($config->deselect) {
			$options[] =  $this->option(array('text' => JText::_($config->prompt)));
		}
		
		$options[] = $this->option(array('text' => 'CPM', 'value' => '1'));
		$options[] = $this->option(array('text' => 'CPC', 'value' => '2'));
		$options[] = $this->option(array('text' => 'Tenancy', 'value' => '3'));
				
		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}
	
	public function weight($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'attribs'	=> $config->attribs
		))->append(array(
			'selected'	=> $config->selected
		));
		
		// generate 1-10 list
		for ($i=1; $i<=10; $i++) {
			$options[] = $this->option(array('text' => $i, 'value' => $i));
		}
		
		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}
	
	public function zone_tree($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'value'		=> 'id',
			'text'		=> 'title',
			'attribs'    => array('id' => $config->name)
		));
			
		$sites = KFactory::tmp('admin::com.adverts.model.sites')
			->set('enabled', 1)
			->getList()
			;
						
		foreach($sites as $site)
		{
			$options[] = $this->option(array('text' => $site->name, 'value' => -1, 'attribs' => array('disabled' => 'disabled')));
							
			$zones = KFactory::tmp('admin::com.adverts.model.zones')
				->set('enabled', 1)
				->set('website', $site->id)
				->getList()
				;
			
			foreach($zones as $zone) {
				$options[] = $this->option(array('text' => $zone->name, 'value' => $zone->id));
			}
			
			$options[] = $this->option(array('text' => '&nbsp;', 'value' => -1, 'attribs' => array('disabled' => 'disabled')));
			
		}
				
		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}
	
	public function campaign($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'model'		=> 'campaigns',
			'name'		=> 'adverts_campaign_id',
			'value'		=> 'id',
			'text'		=> 'name',
			'attribs'	=> array(
				'id'		=> 'campaign_id',
			),
		))->append(array(
			'selected' => $config->selected,
			'deselect'  => true,
		));
		
		$identifier = 'admin::com.adverts.model.campaigns';
			
		$model = KFactory::tmp($identifier);
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
	
	public function target($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'deselect'  => true,
			'prompt'	=> '- Select -',
			'attribs'	=> $config->attribs
		))->append(array(
			'selected'	=> $config->selected
		));
				
		if($config->deselect) {
			$options[] =  $this->option(array('text' => JText::_($config->prompt)));
		}
		
		$options[] = $this->option(array('text' => '_blank', 'value' => '_blank'));
		$options[] = $this->option(array('text' => '_parent', 'value' => '_parent'));
		$options[] = $this->option(array('text' => '_self', 'value' => '_self'));
		$options[] = $this->option(array('text' => '_top', 'value' => '_top'));
				
		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}

	public function type($config = array())
	{
		$config = new KConfig($config);
		$config->append(array(
			'deselect'  => true,
			'prompt'	=> '- Select -',
			'attribs'	=> $config->attribs
		))->append(array(
			'selected'	=> $config->selected
		));
				
		if($config->deselect) {
			$options[] =  $this->option(array('text' => JText::_($config->prompt)));
		}
		
		$options[] = $this->option(array('text' => 'Image', 'value' => 'image'));
		$options[] = $this->option(array('text' => 'Flash', 'value' => 'flash'));
		$options[] = $this->option(array('text' => 'HTML', 'value' => 'html'));
				
		//Add the options to the config object
		$config->options = $options;
		
		return $this->optionlist($config);
	}
}