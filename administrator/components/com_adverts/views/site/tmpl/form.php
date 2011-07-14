<?php defined('KOOWA') or die('Restricted access'); ?>

<?= @helper('behavior.tooltip') ?>
<?= @helper('behavior.validator') ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />

<form action="<?= @route('id='.$site->id) ?>" method="post" class="-koowa-form" id="site-form">
	
	<div class="grid_8" >
		<div class="border-radius-4 name clearfix">
			<input class="inputbox border-radius-4" type="text" name="name" id="name" size="40" maxlength="255" value="<?= @escape($site->name) ?>" placeholder="<?= @text('Website') ?>" />
			
			<label for="alias">
				<?= @text( 'Alias' ) ?>
				<input class="inputbox border-radius-4" type="text" name="alias" id="alias" size="40" maxlength="255" value="<?= @escape($site->slug) ?>" title="<?= @text('ALIASTIP') ?>" placeholder="<?= @text('website-name') ?>"/>
			</label>

		</div>
		
		<div class="panel">
			<h3><?= @text('Details'); ?></h3>
			<table class="admintable">
				<tbody>
					<tr>
						<td valign="top" class="key">
							<label for="url">
								<?= @text('Url'); ?>
							</label>
						</td>
						<td>
							<input class="text_area" type="text" name="url" id="url" size="40" maxlength="255" value="<?= @escape($site->url) ?>" title="<?= @text('Url') ?>" placeholder="<?= @text('http://www.website.com') ?>" />
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="enabled">
								<?= @text('Published') ?>
							</label>
						</td>
						<td>
							<?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $site->enabled)) ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="contact_name">
								<?= @text('Contact Name'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox border-radius-4" type="text" name="contact_name" id="contact_name" size="40" maxlength="255" value="<?= @escape($site->contact_name) ?>" title="<?= @text('Contact Name') ?>" placeholder="<?= @text('John Doe') ?>" />
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="email">
								<?= @text('Email'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox border-radius-4" type="email" name="email" id="email" size="40" maxlength="255" value="<?= @escape($site->email) ?>" title="<?= @text('Email') ?>" placeholder="<?= @text('john.doe@website.com') ?>" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
	
	<div class="grid_4">
			
		<div class="panel">
	        <h3><?= @text('Notes') ?></h3>
	        <textarea class="inputbox" style="box-sizing: border-box; margin: 0; resize: vertical; width: 100%" cols="70" rows="6" name="notes" id="notes" placeholder="<?= @text('Enter your notes in here') ?>"><?= @escape($site->notes) ?></textarea>
	    </div>
	    
	</div>
</form>