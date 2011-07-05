<?php /** $Id: form.php 795 2011-06-21 20:32:00Z media $ */ ?>
<?php defined('KOOWA') or die('Restricted access'); ?>

<?= @helper('behavior.tooltip') ?>
<?= @helper('behavior.validator') ?>

<script src="media://lib_koowa/js/koowa.js" />
<script src="media://com_adverts/js/zone.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />


<form action="<?= @route('id='.$zone->id) ?>" method="post" class="-koowa-form" id="zone-form">
	
	<div class="grid_8" >
		<div class="border-radius-4 name clearfix">
			<input class="inputbox border-radius-4" type="text" name="name" id="name" size="40" maxlength="255" value="<?= @escape($zone->name) ?>" placeholder="<?= @text('Zone') ?>" />
		</div>
		
		<div class="panel">
			<h3><?= @text('Details'); ?></h3>
			<table class="admintable">
				<tbody>
					<tr>
						<td valign="top" class="key">
							<label for="site">
								<?= @text('Site'); ?>
							</label>
						</td>
						<td>
							 <?= @helper('admin::com.adverts.template.helper.listbox.site',
								 	array(
								 		'name'		=> 'site_id',
								 		'selected'	=> $zone->site_id,
								 		'value'		=> 'id',
								 		'text'		=> 'name',
								 		'attribs'	=> array(
								 		//	'class'	=> 'required'	
								 		)
								 	)); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="published">
								<?= @text('Published'); ?>
							</label>
						</td>
						<td>
							 <?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $zone->enabled)) ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="size">
								<?= @text('Size'); ?>
							</label>
						</td>
						<td>
							 <?= @helper('admin::com.adverts.template.helper.listbox.size',
							 		array(
							 			'name' => 'size',
							 			'selected' => $zone->size
							 		)) ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="width">
								<?= @text('Dimensions'); ?>
							</label>
						</td>
						<td>
							<label for="width">
								<?= @text('Width'); ?>
							</label>
							
							<input class="inputbox" type="text" name="width" id="width" size="3" maxlength="11" value="<?= @escape($zone->width) ?>" title="<?= @text('wdth') ?>" /> <?= @text('px'); ?>

							<label for="height">
								<?= @text('Height'); ?>
							</label>
							
							<input class="inputbox" type="text" name="height" id="height" size="3" maxlength="11" value="<?= @escape($zone->height) ?>" title="<?= @text('height') ?>" /> <?= @text('px'); ?>
							
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="chained_zone">
								<?= @text('Chained Zone'); ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.zone',
								 	array(
								 		'name'		=> 'chained_zone_id',
								 		'selected'	=> $zone->chained_zone_id,
								 		'value'		=> 'id',
								 		'text'		=> 'name'
								 	)); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
	
	<div class="grid_4">
		
		<div class="panel">
	        <h3><?= @text('Notes') ?></h3>
	        <textarea class="inputbox" style="box-sizing: border-box; margin: 0; resize: vertical; width: 100%" cols="70" rows="6" name="notes" id="notes" placeholder="<?= @text('Enter your notes in here') ?>"><?= @escape($zone->notes) ?></textarea>
	    </div>
	    
	</div>
</form>