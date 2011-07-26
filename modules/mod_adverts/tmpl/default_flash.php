<?php ?>

<script>
	window.addEvent('domready', function() {
		var adSwiff = new Swiff('/media/com_adverts/attachments/<?= @escape($advertisement->primary_file); ?>', {
			container: $('advert_<?= $unique; ?>'),
			width: 300,
			height: 250,
			vars: {clickTag: '<?= @route($advertisement->click_url); ?>'}
		});
	});
</script>

<noscript>
	<a href="<?=@route($advertisement->click_url)?>" title="<?= $advertisement->name ?>">
		<img src="/media/com_adverts/attachments/<?= $advertisement->alternative_file ?>" alt="<?= $advertisement->alt_text ?>"/>
	</a>
</noscript>