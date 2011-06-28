window.addEvent('domready', function() {
	
	// inputs object
	var inputs = new Object();
		inputs.size		= $(document).getElement('[name=size]');
		inputs.width	= $(document).getElement('[name=width]');
		inputs.height	= $(document).getElement('[name=height]');
		
	// convert to hash
	var inputs = new Hash(inputs);
	
	// add functions to inputs
	inputs.each(function(obj, name, hash)
	{
		
		// size select
		if (name === 'size')
		{
			
			// initialize state
			if (obj.get('value') == -1)
			{
				// custom
				inputs.width.removeProperty('readonly').removeClass('disabled');
				inputs.height.removeProperty('readonly').removeClass('disabled');
			}
			else
			{
				// non custom
				inputs.width.setProperty('readonly', true).addClass('disabled');
				inputs.height.setProperty('readonly', true).addClass('disabled');
			}
			
			// add event to select
			obj.addEvent('change', function()
			{
				
				if (this.get('value') == -1)
				{
					// select custom
					inputs.width.removeProperty('readonly').removeClass('disabled').focus();
					inputs.height.removeProperty('readonly').removeClass('disabled');
				}
				else
				{
					// non custom
					nameString = new String(this.getSelected().get('html')).split(' ');
					
					var dims = new Array;
					nameString.each(function(parts, i)
					{
						var part = parseFloat(parts);
						dims[i] = part;
					});
					
					inputs.width.set('value', dims[0]).setProperty('readonly', true).addClass('disabled');
					inputs.height.set('value', dims[2]).setProperty('readonly', true).addClass('disabled');
				}
			});
		}
	});
	
});