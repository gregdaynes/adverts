<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access'); ?>

<a href="<?=@route('view=advertisement&id='.$advertisement->id)?>" title="<?= $advertisement->name ?>">
	<img src="/media/com_adverts/attachments/<?= $advertisement->primary_file ?>" alt="<?= $advertisement->alt_text ?>"/>
</a>