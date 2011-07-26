<?php ?>

<script src="media://lib_koowa/js/koowa.js" />
<script src="media://com_adverts/js/list.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_adverts/css/statistic.css" />

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
					<?= @text('$').$sums['revenue']; ?>
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
				<?= @template('default_campaign', array('campaign' => $campaign)); ?>
										
					<? foreach($advertisements[$campaign->id] as $advertisement) : ?>
					<?= @template('default_advertisement', array('advertisement' => $advertisement)); ?>
					
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