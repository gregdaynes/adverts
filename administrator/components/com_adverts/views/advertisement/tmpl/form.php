<? /** $Id: form.php 795 2011-06-21 20:32:00Z media $ */ ?>
<? defined('KOOWA') or die('Restricted access'); ?>

<?= @helper('behavior.tooltip') ?>
<?= @helper('behavior.validator') ?>
<? JHTML::_('behavior.calendar'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<script src="media://com_adverts/js/advert.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />

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
					
					<? if ($advertisement->file_url != null): ?>
					<tr>
						<td valign="top" class="key">
							<label>
								<?= @text( 'Selected Advertisement' ) ?>
							</label>
						</td>
						<td>
							<?= @escape($advertisement->file_url); ?>
						</td>
					</tr>
					<? endif; ?>
					
					<? if ($advertisement->alt_file_url != null): ?>
					<tr>
						<td valign="top" class="key">
							<label>
								<?= @text( 'Selected Alternate Advertisement' ) ?>
							</label>
						</td>
						<td>
							<?= @escape($advertisement->alt_file_url); ?>
						</td>
					</tr>
					<? endif; ?>
					
					<? if ($advertisement->file_url == null): ?>
					<tr>
						<td valign="top" class="key file_upload">
							<label for="file_url">
								<?= @text( 'Upload Advertisement' ) ?>
							</label>
						</td>
						<td>
							<input name="file_url" type="file" />
							
							<? if (preg_match("#swf$#i", $advertisement->file_url )): ?>
							<input type="checkbox" name="uploadAlt" />
							<label for="uploadAlt">
								<?= @text( 'Upload as alternate advertisement' ) ?>
							</label>
							<? endif; ?>
						</td>
					</tr>
					<? endif; ?>
					
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
							        'buttons' => false,
							        //'options' => array('theme' => 'simple', 'pagebreak', 'readmore')
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