<?php /** $Id: form.php 795 2011-06-21 20:32:00Z media $ */ ?>
<?php defined('KOOWA') or die('Restricted access'); ?>

<?= @helper('behavior.tooltip') ?>
<?= @helper('behavior.validator') ?>
<?= @helper('behavior.modal') ?>
<?= @helper('behavior.mootools') ?>
<?php JHTML::_('behavior.calendar'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<script src="media://com_adverts/js/advert.js" />
<script src="media://com_adverts/js/size.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />

<? if ($advertisement->primary_file && $advertisement->primary_file_type == 'application/x-shockwave-flash') : ?>
	<script>
		window.addEvent('domready', function() {
			var adPreview = $(document).getElement('[class=advertisement_preview]')
			
			var swiffContainer = new Element('div');
			var adSwiff = new Swiff('/media/com_adverts/attachments/<?= @escape($advertisement->primary_file); ?>', {
				container: swiffContainer,
				width: 300,
				height: 250
			});
			
			adPreview.adopt(swiffContainer);
			
			<? if ($advertisement->alternative_file) : ?>
			
			var altImage = new Element('img', {
				'src': '/media/com_adverts/attachments/<?= @escape($advertisement->alternative_file); ?>',
				'class': 'hidden'
			});
			
			adPreview.adopt(altImage);
			
			var altButton = new Element('a', {
				'href': '#',
				'html': '<?= @text('Load alternate preview'); ?>',
				'styles': {
					'display': 'block'
				},
				'events' : {
					'click' : function() {
						swiffContainer.toggleClass('hidden', true);
						altImage.toggleClass('hidden', true);
					}
				}
			});
						
			adPreview.adopt(altButton);
			
			<? endif; ?>
		});
	</script>
<? endif; ?>

<form action="<?= @route('id='.$advertisement->id) ?>" method="post" class="-koowa-form" id="advertisement-form" enctype="multipart/form-data">
	
	<div class="grid_8" >
		<div class="border-radius-4 name clearfix">
			<input class="inputbox border-radius-4" type="text" name="name" id="name" size="40" maxlength="255" value="<?= @escape($advertisement->name) ?>" placeholder="<?= @text('Advertisement Name') ?>" />
		
			<label for="alias">
				<?= @text( 'Alias' ) ?>
				<input class="inputbox border-radius-4" type="text" name="slug" id="slug" size="40" maxlength="255" value="<?= @escape($advertisement->slug) ?>" title="<?= @text('ALIASTIP') ?>" placeholder="<?= @text('advertisement-name') ?>"/>
			</label>
			
		</div>
		
		<div class="panel">
			<h3><?= @text('Details'); ?></h3>
			<table class="admintable">
				<tbody>
					<tr>
						<td valign="top" class="key">
							<label for="client_id">
								<?= @text( 'Client' ) ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.client',
								array(
									'name'		=> 'client_id',
									'selected'	=> $advertisement->client_id,
									'value'		=> 'id',
									'text'		=> 'name'
								)); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="campaign_id">
								<?= @text( 'Campaign' ) ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.campaign',
								array(
									'name'		=> 'campaign_id',
									'selected'	=> $advertisement->campaign_id,
									'value'		=> 'id',
									'text'		=> 'name'
								)); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="type">
								<?= @text( 'Type' ) ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.type',
								array(
									'name'		=> 'type',
									'selected'	=> $advertisement->type,
									'value'		=> 'id',
									'text'		=> 'name'
								)); ?>
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
							 			'selected' => $advertisement->size
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
							
							<input class="inputbox" type="text" name="width" id="width" size="3" maxlength="11" value="<?= @escape($advertisement->width) ?>" title="<?= @text('wdth') ?>" /> <?= @text('px'); ?>

							<label for="height">
								<?= @text('Height'); ?>
							</label>
							
							<input class="inputbox" type="text" name="height" id="height" size="3" maxlength="11" value="<?= @escape($advertisement->height) ?>" title="<?= @text('height') ?>" /> <?= @text('px'); ?>
							
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	
		<div class="panel">
			<h3><?= @text('Publishing Options'); ?></h3>
			<table class="admintable">
				<tbody>
					<tr>
						<td valign="top" class="key">
							<label for="published">
								<?= @text( 'Published' ) ?>
							</label>
						</td>
						<td>
							<?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $advertisement->enabled)) ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<?= @text('Start Date') ?>
						</td>
						<td>
							<?= JHTML::_( 'calendar', $advertisement->publish_up, 'publish_up', 'publish_up' ); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<?= @text('End Date') ?>
						</td>
						<td>
							<?= JHTML::_( 'calendar', $advertisement->publish_down, 'publish_down', 'publish_down' ); ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="impressions">
								<?= @text('Impressions') ?>
							</label>
						</td>
						<td>
							<input type="text" name="impressions" size="20" maxlength="12" value="<?= @escape($advertisement->impressions) ?>" />
							
							<label for="impressions_unlimited">
								<?= @text('Unlimited') ?>
								<input type="checkbox" name="impressions_unlimited" />
							</label>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="clicks">
								<?= @text('Clicks') ?>
							</label>
						</td>
						<td>
							<input type="text" name="clicks" size="20" maxlength="12" value="<?= @escape($advertisement->clicks) ?>" />
							
							<label for="clicks_unlimited">
								<?= @text('Unlimited') ?>
								<input type="checkbox" name="clicks_unlimited" />
							</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="panel advertisement">
			<h3><?= @text('Advertisement'); ?></h3>
			<table class="admintable" width="100%">
				<tbody>
					
					<? if ($advertisement->primary_file) : ?>
					<tr>
						<td valgin="top" class="key">
							<label>
								<?= @text('Preview'); ?>
							</label>
						</td>
						<td>
							<div class="advertisement_preview">								
								<? if ($advertisement->primary_file && $advertisement->primary_file_type !== 'application/x-shockwave-flash') : ?>
									<img src="/media/com_adverts/attachments/<?= @escape($advertisement->primary_file); ?>" />
								<? endif; ?>
							</div>
						</td>
					</tr>
					<? endif; ?>
					
					<tr>
						<td valign="top" class="key file_upload">
							<label for="file_url">
								<?= @text( 'Upload Advertisement' ) ?>
							</label>
						</td>
						<td>
							<input type="file" name="file_upload" id="file_upload" />
							
							<? if ($advertisement->primary_file && $advertisement->primary_file_type == 'application/x-shockwave-flash') : ?>
								<input type="checkbox" name="alt_file_check" checked="checked" />
								<label for="alt_file_check">
									<?= @text('Upload as alternate file?'); ?>
								</label>
							<? endif; ?>
						</td>
					</tr>
					
					
					<tr>
						<td valign="middle" class="key custom_banner_code">
							<label for="custom_banner_code">
								<?= @text( 'Custom Banner Code' ) ?>
							</label>
						</td>
						<td>
							<?= @editor(array(
							        'name' => 'custom_banner_code',
							        'text' => $advertisement->custom_banner_code,
							        'width' => '100%',
							        'height' => '300',
							        'cols' => '60',
							        'rows' => '20',
							        'buttons' => false
							    ));
							?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="link">
								<?= @text('Link') ?>
							</label>
						</td>
						<td>
							<input class="inputbox" type="text" name="link" size="40" maxlength="255" value="<?= @escape($advertisement->link) ?>" title="<?= @text('Link') ?>" placeholder="<?= @text('http://advertisersite.com') ?>" />
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="target">
								<?= @text('Target') ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.target',
								array(
									'name'		=> 'target',
									'selected'	=> $advertisement->target,
									'value'		=> 'id',
									'text'		=> 'name',
									'deselect'	=> false,
									'attribs'	=> array(
									)
								)); ?>
						</td>
					</tr>
					
					
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="grid_4">
		
		<div class="panel">
			<h3><?= @text('Zones') ?></h3>
			<?= @helper('admin::com.adverts.template.helper.listbox.zone_Tree',
					array(
						'name'		=> 'zones[]',
						'selected'	=> explode(',', $advertisement->zones),
						'deselect'	=> false,
						'attribs'	=> array(
							'multiple'	=> 'multiple'
						)
					)); ?>
		</div>
				
		<div class="panel">
            <h3><?= @text('Notes') ?></h3>
            <textarea class="inputbox" style="box-sizing: border-box; margin: 0; resize: vertical; width: 100%" cols="70" rows="6" name="notes" id="notes" placeholder="<?= @text('Enter your notes in here') ?>"><?= @escape($advertisement->notes) ?></textarea>
        </div>
        
	</div>	
</form>