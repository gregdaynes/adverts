# @TODO
### Sizes
Table for storing sizes - figured this would be best to "customize" the drop down lists, also for adding custom sizes to the lists.

### Statistics
*	advertiser
*	campaign
*	advertisement
	*	DoW, DoM filters to augment the statistics even more.
	*	preview
	*	zones
	*	notes
		* thought up something useful. How about a "Print w/ me" checkbox to show hide the notes field in printouts. That way it can be hidden if the printout/pdf/email (when it's done) will not show up to the client
	*	size
		* dependent on the sizes section - will probably work on next
	*	collapsible views
		* hours is a HUGE list - knew it would be - so let's make it cleaner
		* make each day collapse hours into accordion
		* make each month collapse into days
			* an ad should rarely run for more than a few months, let alone a few years, so no need to collapse further


### Dashboard

### Module
* re-factor completely and thoroughly test.
	* probably have to add some sort of cache-busting code probably a ?XXX to the filename.
* new templates/layouts

### General
* Required Fields
* redirect
	* seems very very broken in Nooku. Doesn't remember where you were last on save/apply/cancel - going to look into it