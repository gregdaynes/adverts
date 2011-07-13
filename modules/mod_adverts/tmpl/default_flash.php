<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access'); ?>

<script>
	window.addEvent('domready', function() {
		var adSwiff = new Swiff('/media/com_adverts/attachments/<?= @escape($advertisement->primary_file); ?>', {
			container: $('advert_<?= $unique; ?>'),
			width: 300,
			height: 250
		});
	});
</script>

<noscript>
	<a href="<?=@route('view=advertisement&id='.$advertisement->id)?>" title="<?= $advertisement->name ?>">
		<img src="/media/com_adverts/attachments/<?= $advertisement->alternative_file ?>" alt="<?= $advertisement->alt_text ?>"/>
	</a>
</noscript>