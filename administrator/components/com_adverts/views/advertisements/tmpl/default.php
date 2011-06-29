<? /** $Id$ **/ ?>
<?php defined('KOOWA') or die('Restricted access'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<?= @helper('behavior.tooltip'); ?>

<?= @template('default_sidebar'); ?>

<form action="<?= @route() ?>" method="get" class="-koowa-grid">
	<?= @template('default_filter'); ?>
	<table class="adminlist">
		<thead>
			<tr>
				<th width="5%"></th>
				<th>
					<?= @helper('grid.sort', array('column' => 'name', 'title' => 'Name')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'campaign_id', 'title' => 'Campaign')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'link', 'title' => 'Link')); ?>
				</th>
				<th width="5%">
				    <?= @helper('grid.sort', array('column' => 'enabled', 'title' => 'Published')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'publish_up', 'title' => 'Start Date')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'impressions', 'title' => 'Impressions')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'clicks', 'title' => 'Clicks')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'type', 'title' => 'Type')); ?>
				</th>
			</tr>
			<tr>
			    <td align="center">
			        <?= @helper( 'grid.checkall'); ?>
			    </td>
			    <td>
			        <?= @helper( 'grid.search'); ?>
			    </td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <th><?= @helper('grid.sort', array('column' => 'publish_down', 'title' => 'Stop Date')); ?></th>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
		</thead>
		
		<tfoot>
			<tr>
				<td colspan="9">
					<?= @helper('paginator.pagination', array('total' => $total)) ?>
				</td>
			</tr>
		</tfoot>
		
		<tbody>
			<? foreach ($advertisements as $advertisement) : ?>
			<tr>
				<td align="center">
					<?= @helper('grid.checkbox', array('row' => $advertisement)); ?>
				</td>
				<td align="left">
					<span class="editlinktip hasTip" title="<?= @text('Edit') ?> <?= @escape($advertisement->name); ?>::<?= @escape(substr($advertisement->notes, 0, 300)).'&hellip;'; ?>">
						<a href="<?= @route('view=advertisement&id='.$advertisement->id); ?>">
							<?= @escape($advertisement->name); ?>
					</span>
				</td>
				<td align="center">
					<?= @escape($advertisement->campaign_id); ?>
				</td>
				<td align="center">
					<?= @escape($advertisement->link); ?>
				</td>
				<td align="center">
					<?= @helper('grid.enable', array('row' => $advertisement)) ?>
				</td>
				<td align="center">
					<?= @escape($advertisement->publish_up); ?>
					<br />
					<?= @escape($advertisement->publish_down); ?>
				</td>
				<td align="center">
					<?= @escape($advertisement->impressions); ?>
				</td>
				<td align="center">
					<?= @escape($advertisement->clicks); ?>
				</td>
				<td align="center">
					<?= @escape($advertisement->type); ?>
				</td>
			</tr>
			<? endforeach; ?>
			
			<? if (!count($advertisements)) : ?>
				<tr>
					<td colspan="9" align="center">
						<?= @text('No Advertisements Found'); ?>
					</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</form>