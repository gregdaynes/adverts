<?php defined('KOOWA') or die('Restricted access'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<script src="media://com_adverts/js/list.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/list.css" />

<?= @template('default_sidebar'); ?>

<form action="<?= @route() ?>" method="get" class="-koowa-grid">
     <?= @template('default_filter'); ?>
     <table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
				
				</th>
				<th>
					<?= @text('Client Name'); ?>
				</th>
				<th>
					<?= @text('Impressions'); ?>
				</th>
				<th>
					<?= @text('Click Throughs'); ?>
				</th>
				<th>
					<?= @text('CTR'); ?>
				</th>
				<th>
					<?= @text('Revenue'); ?>
				</th>
			</tr>
			<tr> 
				<td></td>
				<td></td>
				<td align="center">
					<?= $sums['impressions']; ?>
				</td>
				<td align="center">
					<?= $sums['clicks']; ?>
				</td>
				<td align="center">
					<?= $sums['ctr'].@text('%'); ?>
				</td>
				<td align="center">
					$sum Revenue @TODO
				</td>
			</tr>
		</thead>
		
		<tfoot>
			<tr>
				<td colspan="6">
				    <?= @helper('paginator.pagination', array('total' => $total)) ?>
				</td>
			</tr>
		</tfoot>
		
		<tbody>		
			<? foreach ($clients as $client) : ?>
				<tr>
					<td></td>
					<td>
						<?= @escape($client->name); ?>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				
				<? foreach($campaigns[$client->id] as $campaign) : ?>
					<tr>
						<td></td>
						<td>
							<?= @(' ::: ').@escape($campaign->name); ?>
						</td>
						<td align="center">
							<?= @escape($campaign_stats['impressions'][$campaign->id]); ?>
							<em> <?= @text(' of ').@escape($campaign->impressions); ?></em>
						</td>
						<td align="center">
							<?= @escape($campaign_stats['clicks'][$campaign->id]); ?>
							<em> <?= @text(' of ').@escape($campaign->clicks); ?></em>
						</td>
						<td align="center">
							<? if ($campaign_stats['clicks'][$campaign->id] != 0 && $campaign_stats['impressions'][$campaign->id] != 0) {
								echo round($campaign_stats['clicks'][$campaign->id] / $campaign_stats['impressions'][$campaign->id], 3).@text('%');
							} else { echo @text('-'); } ?>
						</td>
						<td align="center">
							@todo
						</td>
					</tr>
					<? foreach($advertisements[$campaign->id] as $advertisement) : ?>
						<tr>
							<td></td>
							<td>
								<?= @(' ::: ::: ').@escape($advertisement->name); ?>
							</td>
							<td align="center">
								<?= @escape($advertisement_stats['impressions'][$advertisement->id]); ?>
								<em> <?= @text(' of ').@escape($advertisement->impressions); ?>
							</td>
							<td align="center">
								<?= @escape($advertisement_stats['clicks'][$advertisement->id]); ?>
								<em> <?= @text(' of ').@escape($advertisement->clicks); ?>
							</td>
							<td align="center">
								<? if ($advertisement_stats['clicks'][$advertisement->id] != 0 && $advertisement_stats['impressions'][$advertisement->id] != 0) {
									echo round($advertisement_stats['clicks'][$advertisement->id] / $advertisement_stats['impressions'][$advertisement->id], 3).@text('%');
								} else { echo @text('-'); } ?>
							</td>
							<td align="center">
								@todo
							</td>
						</tr>
					<? endforeach; ?>
				
				<? endforeach; ?>
	
			<? endforeach; ?>
			
			<? if (!count($clients)) : ?>
				<tr>
				    <td colspan="6" align="center">
				    	<?= @text('No Statistics Found'); ?>
				    </td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</form>