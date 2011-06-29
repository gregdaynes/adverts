window.addEvent('domready', function() {
	
	// inputs object
	var inputs = new Object();
		inputs.impression = new Object();
			inputs.impression.checkbox = $(document).getElement('[name=impressions_unlimited]');
			inputs.impression.input	= $(document).getElement('[name=impressions]');
		inputs.click = new Object();
			inputs.click.checkbox	= $(document).getElement('[name=clicks_unlimited]');
			inputs.click.input		= $(document).getElement('[name=clicks]');
	
	// convert to hash
	var inputs = new Hash(inputs);
	
	// add function to inputs
	inputs.each(function(obj, name, hash) {
		
		// add check/uncheck to checkboxes
		obj.checkbox.addEvent('change', function() {
			if (this.getProperty('checked') === true) {
				obj.input.set('value', 0).setProperty('readonly', true).addClass('disabled');
			} else {
				obj.input.removeProperty('readonly').removeClass('disabled').focus();
			}
		});
		
		// auto check unlimited on new or 0 value
		if (obj.input.get('value') == 0) {
			obj.input.setProperty('readonly', true).addClass('disabled');
			obj.checkbox.set('checked', true);
		}
	});
	
});