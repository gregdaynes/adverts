<tr>
	<td></td>
	<td class="indent one">
		<?= @escape($campaign->name); ?>
	</td>
	<td align="center">
		<?= @escape($campaign_stats['impressions'][$campaign->id]); ?>
		
		<? if ($campaign->impressions == 0) { $campaign->impressions = @text('Unlimited'); } ?>
		<?= ' '.@text('of').' '.@escape($campaign->impressions); ?>
		
		<? if (is_numeric($campaign->impressions)) : ?>
			(<?= $campaign->impressions - $campaign_stats['impressions'][$campaign->id].' '.@text('Remaining'); ?>)
		<? endif; ?>
	</td>
	<td align="center">
		<?= @escape($campaign_stats['clicks'][$campaign->id]); ?>
		
		<? if ($campaign->clicks == 0) { $campaign->clicks = @text('Unlimited'); } ?>
		<?= ' '.@text('of').' '.@escape($campaign->clicks); ?>
		
		<? if (is_numeric($campaign->clicks)) : ?>
			(<?= $campaign->clicks - $campaign_stats['clicks'][$campaign->id].' '.@text('Remaining'); ?>)
		<? endif; ?>
	</td>
	<td align="center">
		<? if ($campaign_stats['clicks'][$campaign->id] != 0 && $campaign_stats['impressions'][$campaign->id] != 0) {
			echo round($campaign_stats['clicks'][$campaign->id] / $campaign_stats['impressions'][$campaign->id], 3).@text('%');
		} else { echo @text('-'); } ?>
	</td>
	<td align="center">
		<?= @text('$').$revenue['calculated'][$campaign->id]; ?>
	</td>
</tr>