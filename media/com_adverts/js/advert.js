window.addEvent('domready', function() {
	
	var zoneList = $(document).getElement('[name^=zone_id]');
	
	/**
	 * Functions
	 */
	var updateList = function(element, items) {
		
		// store selected for later use
		previouslySelected = zoneList.getSelected().get('value');
		
		// empty list
		zoneList.empty();
				
		items.each(function(el, i) {
			
			selectOption = new Element('option', {
				'value': el.value,
				'text': el.text,
			});
			
			if (el.attribs) {
				selectOption.setProperty('disabled', 'disabled');
			}
			
			zoneList.grab(selectOption);
		});
		
		// reselect zones
		previouslySelected.each(function(value) {
			$(document).getElement('option[value='+value+']').setProperty('selected', 'selected');
		});
	};
	
	
	/**
	 * Impression & Click
	 */
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
	
	/**
	 * Campaign Select
	 *
	 * update zones list when campaign is selected
	 */
	var campaignSelect = $(document).getElement('[name=campaign_id]');
	
	campaignSelect.addEvent('change', function() {
		
		var campaignId = this.getProperty('value');
				
		if (campaignId !== '') {
			campaignId = '&campaignId='+campaignId;
		}

		var xRequest = new Request.JSON({
			url: '/index.php',
			method: 'get',
			onComplete: function(response) {
				updateList(campaignSelect, response);
			}
		}).send('option=com_adverts&view=zones&format=json'+campaignId);
	});
	
	/**
	 * Type Select
	 *
	 * hide/display file chooser and wysiwyg
	 */
	var typeSelect = $(document).getElement('[name=type]');
	
	typeSelect.addEvent('change', function() {
		
		if (this.getProperty('value') == '') {
			$$('.panel.advertisement').addClass('hidden');
		}
		
		if (this.getProperty('value') == 1) {
			$$('.file_upload').getParent('tr').removeClass('hidden');
			$$('.panel.advertisement').removeClass('hidden');
			$$('.custom_banner_code').getParent('tr').addClass('hidden');
		}
		
		if (this.getProperty('value') == 2) {
			$$('.file_upload').getParent('tr').addClass('hidden');
			$$('.panel.advertisement').removeClass('hidden');
			$$('.custom_banner_code').getParent('tr').removeClass('hidden');
		}
	});
	
	if (typeSelect.getProperty('value') == '') {
		$$('.panel.advertisement').addClass('hidden');
	}
	
	if (typeSelect.getProperty('value') == '1') {
		$$('.custom_banner_code').getParent('tr').addClass('hidden');
	}
	
	if (typeSelect.getProperty('value') == '2') {
		$$('.file_upload').getParent('tr').addClass('hidden');
	}
});