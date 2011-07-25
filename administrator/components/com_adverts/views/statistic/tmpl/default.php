<?php /** $Id: form.php 795 2011-06-21 20:32:00Z media $ */ ?>
<?php defined('KOOWA') or die('Restricted access'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />
<style src="media://com_adverts/css/statistic.css" />
<style src="media://com_adverts/css/print.css" media="print" />

<form class="-koowa-form">
	<div class="grid_8" >
		<div class="border-radius-4 name clearfix">
			<span class="border-radius-4 name" id="name" ><?= @escape($advertisement->name); ?></span>
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
							<?= @escape($client->name); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="campaign_id">
								<?= @text( 'Campaign' ) ?>
							</label>
						</td>
						<td>
							<?= @escape($campaign->name); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<label for="size">
								<?= @text('Size'); ?>
							</label>
						</td>
						<td>
							<?= @escape($advertisement->size); ?>
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
							
							<?= @escape($advertisement->width); ?>

							<label for="height">
								<?= @text('Height'); ?>
							</label>
							
							<?= @escape($advertisement->height); ?>
						</td>
					</tr>
					<tr>
						<td align="top" class="key">
							<label for="notes">
								<?= @text('Notes'); ?>
							</label>
						</td>
						<td>
							<?= @escape($advertisement->notes); ?>
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
							<? if ($advertisement->enabled) {
								echo @text('Published');
							} else {
								echo @text('Unpublished');
							}
							?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<?= @text('Start Date') ?>
						</td>
						<td>							
							<? if ($advertisement->publish_up == '0000-00-00 00:00:00') {
									echo @text('Not set');
								} else {
								echo @helper('date.format', array('date' => $advertisement->publish_up));
							} ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<?= @text('End Date') ?>
						</td>
						<td>
							<? if ($advertisement->publish_down == '0000-00-00 00:00:00') {
									echo @text('Never');
								} else {
								echo @helper('date.format', array('date' => $advertisement->publish_down));
							} ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="impressions">
								<?= @text('Impressions') ?>
							</label>
						</td>
						<td>
							<? echo @escape($advertisement->tot_impressions).@text(' / ');
							
							if ($advertisement->impressions <= 0) {
								echo @text('Unlimited');
							} else {
								echo @escape($advertisement->impressions);
							} ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="clicks">
								<?= @text('Clicks') ?>
							</label>
						</td>
						<td>
							<? echo @escape($advertisement->tot_clicks).@text(' / ');
							
							if ($advertisement->clicks <= 0) {
								echo @text('Unlimited');
							} else {
								echo @escape($advertisement->clicks);
							} ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="panel advertisement">
			<h3><?= @text('Advertisement'); ?></h3>
			<table class="admintable" width="100%">
				<tbody>
					
					<tr>
						<td valgin="top" class="key">
							<label>
								<?= @text('Preview'); ?>
							</label>
						</td>
						<td>
							<div class="advertisement_preview">								
								@advertisement->preview
							</div>
						</td>
					</tr>			
				</tbody>
			</table>
		</div>
		
		<div class="panel">
			<h3><?= @text( 'Statistics' ) . @template('default_filter'); ?><div class="clear"></div></h3>
			<table class="adminlist" width="100%">
				<tbody>
					<tr class="table_head">
						<td align="left" width="100%">
							<?= @text('Location'); ?>
							
						</td>
						<td align="center">
							<?= @text('Impressions'); ?>
						</td>
						<td align="center">
							<?= @text('Clicks'); ?>
						</td>
						<td align="center">
							<?= @text('CTR'); ?>
						</td>
						<td align="center">
							<?= @text('Revenue'); ?>
						</td>
					</tr>
					<? foreach($statistics as $statistic) : ?>
					<tr>
						<td>
							<?= $statistic->group_name; ?>
						</td align="center">
						<td align="center">
							<?= $statistic->impressions; ?>
						</td>
						<td align="center">
							<?= $statistic->clicks; ?>
						</td>
						<td align="center">
							<? if ($statistic->clicks != 0 && $statistic->impressions != 0) {
								echo round(($statistic->clicks / $statistic->impressions) * 100, 3).@text('%');
							} else {
								echo @text('-');
							} ?>
						</td>
						<td align="center">
							<? if ($statistic->revenue != 0 ) {
								echo @text('$').$statistic->revenue;
							} else {
								echo @text('-');
							} ?>
						</td>
					</tr>
					
					<? foreach($statistic->time as $time) : ?>
					<tr>
						<td class="indent two">
							<?= @helper('date.format', array('date' => $time->datetime)) ?>
							
							<?= @text(' - '); ?>
							
							<?= date("g:i:s a", strtotime($time->datetime)); ?>
						</td>
						<td align="center">
							<?= $time->impressions; ?>
						</td>
						<td align="center">						
							<? if ($time->clicks != 0) {
								echo $time->clicks;
							} else {
								echo @text('-');
							} ?>
						</td>
						<td align="center">
							<? if ($time->clicks != 0 && $time->impressions != 0) {
								echo round(($time->clicks / $time->impressions) * 100, 3).@text('%');
							} else {
								echo @text('-');
							} ?>
						</td>
						<td align="center">
							<?= @text('-') ?>
						</td>
					</tr>
					<? endforeach; ?>
					<? endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	
	<div class="grid_4">
		
		<div class="panel">
			<h3><?= @text('Zones') ?></h3>
			@advertisement->zones
		</div>
	    
	</div>
	
</form>