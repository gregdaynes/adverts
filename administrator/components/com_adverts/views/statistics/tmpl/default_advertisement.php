cal<tr>
	<td></td>
	<td class="indent two">
		<a href="<?= @route('view=statistic&id='.$advertisement->id); ?>">
			<?= @escape($advertisement->name); ?>
		</a>
	</td>
	<td align="center">
		<?= @escape($advertisement_stats['impressions'][$advertisement->id]); ?>
		
		<? if ($advertisement->impressions == 0) { $advertisement->impressions = @text('Unlimited'); } ?>
		<?= ' '.@text('of').' '.@escape($advertisement->impressions); ?>
		
		<? if (is_numeric($advertisement->impressions)) : ?>
			(<?= $advertisement->impressions - $advertisement_stats['impressions'][$advertisement->id].' '.@text('left'); ?>)
		<? endif; ?>
	</td>
	<td align="center">
		<?= @escape($advertisement_stats['clicks'][$advertisement->id]); ?>
		
		<? if ($advertisement->clicks == 0) { $advertisement->clicks = @text('Unlimited'); } ?>
		<?= ' '.@text('of').' '.@escape($advertisement->clicks); ?>
		
		<? if (is_numeric($advertisement->clicks)) : ?>
			(<?= $advertisement->clicks - $advertisement_stats['clicks'][$advertisement->id].' '.@text('left'); ?>)
		<? endif; ?>
	</td>
	<td align="center">
		<? if ($advertisement_stats['clicks'][$advertisement->id] != 0 && $advertisement_stats['impressions'][$advertisement->id] != 0) {
			echo round($advertisement_stats['clicks'][$advertisement->id] / $advertisement_stats['impressions'][$advertisement->id], 3).@text('%');
		} else { echo @text('-'); } ?>
	</td>
	<td></td>
</tr>