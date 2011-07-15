window.addEvent('domready', function() {
	var sidebar = $('sidebar');
	var sidebar_25 = $(document).getElements('[class=sidebar_25]');
	var sidebar_75 = $(document).getElements('[class=sidebar_75]');
	
	sidebar.setStyle('overflow-y', 'hidden');
		
	sidebar_25.setStyle('height', sidebar.getSize().y * .25);
	sidebar_75.setStyle('height', sidebar.getSize().y * .75);
	
});

window.addEvent('resize', function() {
	var sidebar = $('sidebar');
	var sidebar_25 = $(document).getElements('[class=sidebar_25]');
	var sidebar_75 = $(document).getElements('[class=sidebar_75]');
	
	sidebar.setStyle('overflow-y', 'hidden');
	
	sidebar_25.setStyle('height', sidebar.getSize().y * .25);
	sidebar_75.setStyle('height', sidebar.getSize().y * .75);
});