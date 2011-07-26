<?php ?>

<a href="<?=@route($advertisement->click_url)?>" title="<?= $advertisement->name ?>">
	<img src="/media/com_adverts/attachments/<?= $advertisement->primary_file ?>" alt="<?= $advertisement->alt_text ?>"/>
</a>
