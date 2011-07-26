<?php /** $Id: form.php 795 2011-06-21 20:32:00Z media $ */ ?>
<?php ?>

<?= @helper('behavior.tooltip') ?>
<?= @helper('behavior.validator') ?>
<? JHTML::_('behavior.calendar'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<script src="media://com_adverts/js/campaign.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />

<form action="<?= @route('id='.$campaign->id) ?>" method="post" class="-koowa-form" id="edit-form">
	
	<div class="grid_8" >
		<div class="border-radius-4 name clearfix">
			<input class="inputbox border-radius-4" type="text" name="name" id="name" size="40" maxlength="255" value="<?= @escape($campaign->name) ?>" placeholder="<?= @text('Campaign Name') ?>" />
		
			<label for="alias">
				<?= @text( 'Alias' ) ?>
				<input class="inputbox border-radius-4" type="text" name="alias" id="alias" size="40" maxlength="255" value="<?= @escape($campaign->slug) ?>" title="<?= @text('ALIASTIP') ?>" placeholder="<?= @text('campaign-name') ?>"/>
			</label>
			
		</div>
		
		<div class="panel">
			<h3><?= @text('Details'); ?></h3>
			<table class="admintable">
				<tbody>
					<tr>
						<td valign="top" class="key">
							<label for="client">
								<?= @text( 'Client' ) ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.client',
								array(
									'name'		=> 'client_id',
									'selected'	=> $campaign->client_id,
									'value'		=> 'id',
									'text'		=> 'name'									
								)); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="sales_person">
								<?= @text( 'Sales Person' ) ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.sales_person',
								array(
									'name'		=> 'sales_id',
									'selected'	=> $campaign->sales_id,
									'value'		=> 'id',
									'text'		=> 'name'
								)); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="enabled">
								<?= @text('Published') ?>
							</label>
						</td>
						<td>
							<?= @helper('select.booleanlist', array('name' => 'enabled', 'selected' => $campaign->enabled)) ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<?= @text('Start Date') ?>
						</td>
						<td>
							<?= JHTML::_( 'calendar', $campaign->publish_up, 'publish_up', 'publish_up' ); ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<?= @text('End Date') ?>
						</td>
						<td>
							<?= JHTML::_( 'calendar', $campaign->publish_down, 'publish_down', 'publish_down' ); ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="model">
								<?= @text('Model') ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.price_model',
								array(
									'name'		=> 'price_model',
									'selected'	=> $campaign->price_model,
									'value'		=> 'id',
									'text'		=> 'name'
								)); ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="rate">
								<?= @text('Rate / Price') ?>
							</label>
						</td>
						<td>
							<input type="text" name="rate" size="20" maxlength="12" value="<?= @escape($campaign->rate) ?>" />
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="impressions">
								<?= @text('Impressions') ?>
							</label>
						</td>
						<td>
							<input type="text" name="impressions" size="20" maxlength="12" value="<?= @escape($campaign->impressions) ?>" />
							
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
							<input type="text" name="clicks" size="20" maxlength="12" value="<?= @escape($campaign->clicks) ?>" />
							
							<label for="clicks_unlimited">
								<?= @text('Unlimited') ?>
								<input type="checkbox" name="clicks_unlimited" />
							</label>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="weight">
								<?= @text('Weight') ?>
							</label>
						</td>
						<td>
							<?= @helper('admin::com.adverts.template.helper.listbox.weight',
									array(
										'name'		=> 'weight',
										'selected'	=> $campaign->weight
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
						'selected'	=> explode(',', $campaign->zones),
						'deselect'	=> false,
						'attribs'	=> array(
							'multiple'	=> 'multiple'
						)
					)); ?>
		</div>
		
		<div class="panel">
            <h3><?= @text('Notes') ?></h3>
            <textarea class="inputbox" style="box-sizing: border-box; margin: 0; resize: vertical; width: 100%" cols="70" rows="6" name="notes" id="notes" placeholder="<?= @text('Enter your notes in here') ?>"><?= @escape($campaign->notes) ?></textarea>
        </div>
        
	</div>	
</form>