<?= @helper('behavior.tooltip') ?>
<?= @helper('behavior.validator') ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />

<form action="<?= @route('id='.$size->id) ?>" method="post" class="-koowa-form" id="size-form">
		<div class="border-radius-4 name clearfix">
			<input class="inputbox border-radius-4" type="text" name="name" id="name" size="40" maxlength="255" value="<?= @escape($size->name) ?>" placeholder="<?= @text('Name') ?>" />

		</div>
		
		<div class="panel">
			<h3><?= @text('Details'); ?></h3>
			<table class="admintable">
				<tbody>
					<tr>
						<td valign="top" class="key">
							<label for="width">
								<?= @text('Width'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="width" id="width" size="2" maxlength="255" value="<?= @escape($size->width) ?>" placeholder="<?= @text('350') ?>" /> <?= @text('px'); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="height">
								<?= @text('Height'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="height" id="height" size="2" maxlength="255" value="<?= @escape($size->height) ?>" placeholder="<?= @text('200') ?>" /> <?= @text('px'); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="published">
								<?= @text('Published'); ?>
							</label>
						</td>
						<td>
							 <?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $size->enabled)) ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
 
</form>