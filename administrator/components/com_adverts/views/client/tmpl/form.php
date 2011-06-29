<? /** $Id: form.php 790 2011-06-06 21:29:36Z media $ */ ?>
<? defined('KOOWA') or die('Restricted access'); ?>

<?= @helper('behavior.tooltip') ?>
<?= @helper('behavior.validator') ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />

<form action="<?= @route('id='.$client->id) ?>" method="post" class="-koowa-form" id="client-form">
	
	<div class="grid_8" >
		<div class="border-radius-4 name clearfix">
			<input class="inputbox border-radius-4" type="text" name="name" id="name" size="40" maxlength="255" value="<?= @escape($client->name) ?>" placeholder="<?= @text('Company Name') ?>" />
		
			<label for="alias">
				<?= @text( 'Alias' ) ?>
				<input class="inputbox border-radius-4" type="text" name="alias" id="alias" size="40" maxlength="255" value="<?= @escape($client->slug) ?>" title="<?= @text('ALIASTIP') ?>" placeholder="<?= @text('company-name') ?>"/>
			</label>
		</div>
		
		<div class="panel">
			<h3><?= @text('Contact Info'); ?></h3>
			<table class="admintable">
				<tbody>
					<tr>
						<td valign="top" class="key">
							<label for="contact_name">
								<?= @text('Contact Name'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox border-radius-4" type="text" name="contact_name" id="contact_name" size="40" maxlength="255" value="<?= @escape($client->contact_name) ?>" title="<?= @text('Contact Name') ?>" placeholder="<?= @text('John Doe') ?>" />
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="email">
								<?= @text('Email'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox border-radius-4" type="email" name="email" id="email" size="40" maxlength="255" value="<?= @escape($client->email) ?>" title="<?= @text('Email') ?>" placeholder="<?= @text('john.doe@website.com') ?>" />
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="phone_number">
								<?= @text('Phone Number'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox border-radius-4" type="tel" name="phone_number" id="phone_number" size="40" maxlength="255" value="<?= @escape($client->phone_number) ?>" title="<?= @text('Phone Number'); ?>" placeholder="<?= @text('1 800 555 5555') ?>" />
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="fax_number">
								<?= @text('Fax Number'); ?>
							</label>
						</td>
						<td>
							<input class="inputbox border-radius-4" type="tel" name="fax_number" id="fax_number" size="40" maxlength="255" value="<?= @escape($client->fax_number) ?>" title="<?= @text('Fax Number'); ?>"  placeholder="<?= @text('1 800 555 5556') ?>" />
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
	
	<div class="grid_4">
		
		<div class="panel">
            <h3><?= @text('Notes') ?></h3>
            <textarea class="inputbox" style="box-sizing: border-box; margin: 0; resize: vertical; width: 100%" cols="70" rows="6" name="notes" id="notes" placeholder="<?= @text('Enter your notes in here') ?>"><?= @escape($client->notes) ?></textarea>
        </div>
        
	</div>	
</form>