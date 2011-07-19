<?php /** $Id: form.php 795 2011-06-21 20:32:00Z media $ */ ?>
<?php defined('KOOWA') or die('Restricted access'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/form.css" />

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
							<?= @escape($advertisement->enabled); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<?= @text('Start Date') ?>
						</td>
						<td>
							<?= @escape($advertisement->publish_up); ?>
						</td>
					</tr>
					<tr>
						<td valign="top" class="key">
							<?= @text('End Date') ?>
						</td>
						<td>
							<?= @escape($advertisement->publish_down); ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="impressions">
								<?= @text('Impressions') ?>
							</label>
						</td>
						<td>
							<?= @escape($advertisement->impressions); ?>
						</td>
					</tr>
					
					<tr>
						<td valign="top" class="key">
							<label for="clicks">
								<?= @text('Clicks') ?>
							</label>
						</td>
						<td>
							<?= @escape($advertisement->clicks); ?>
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
	</div>
	
	<div class="grid_4">
		
		<div class="panel">
			<h3><?= @text('Zones') ?></h3>
			@advertisement->zones
		</div>
				
		<div class="panel">
	        <h3><?= @text('Notes') ?></h3>
	        <div id="notes"><?= @escape($advertisement->notes); ?></div>
	    </div>
	    
	</div>
	
	<div class="grid_12">
		<div class="panel">
			<h3><?= @text( 'Statistics' ); ?></h3>
			<table class="admintable" width="100%">
				<thead>
					<tr>
						<th>
							<?= @text('Location'); ?>
						</th>
						<th>
							<?= @text('Impressions'); ?>
						</th>
						<th>
							<?= @text('Clicks'); ?>
						</th>
						<th>
							<?= @text('CTR'); ?>
						</th>
						<th>
							<?= @text('Revenue'); ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<? foreach($statistics as $statistic) : ?>
					<tr>
						<td>
							<?= $statistic->location; ?>
						</td>
						<td>
							<?= $statistic->impressions; ?>
						</td>
						<td>
							<?= $statistic->clicks; ?>
						</td>
						<td>
							<? if ($statistic->clicks != 0 && $statistic->impressions != 0) {
								echo round(($statistic->clicks / $statistic->impressions) * 100, 3).@text('%');
							} else {
								echo @text('-');
							} ?>
						</td>
						<td>
							<?= $statistic->revenue; ?>
						</td>
					</tr>
					
					<? foreach($statistic->time as $time) : ?>
					<tr>
						<td>
							<?= $time->datetime; ?>
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
							<? if ($time->revenue != 0 ) {
								echo @text('$').$time->revenue;
							} else {
								echo @text('-');
							} ?>
						</td>
					</tr>
					<? endforeach; ?>
					<? endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</form>