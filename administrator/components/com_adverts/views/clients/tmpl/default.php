<?php ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<?= @helper('behavior.tooltip'); ?>

<form action="<?= @route() ?>" method="get" class="-koowa-grid">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="5%"></th>
				<th>
					<?= @helper('grid.sort', array('column' => 'name', 'title' => 'Company Name')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'contact_name', 'title' => 'Contact Name')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'email')); ?>
				</th>
			</tr>
			<tr>
				<td align="center"><?= @helper('grid.checkall'); ?></td>
				<td colspan="1" align="left">
					<?= @helper('grid.search'); ?>
				</td>
				<td></td>
				<td></td>
			</tr>
		</thead>
		
		<tfoot>
			<tr>
				<td colspan="4">
					<?= @helper('paginator.pagination', array('total' => $total)) ?>
				</td>
			</tr>
		</tfoot>
		
		<tbody>
			<? foreach ($clients as $client) : ?>
			<tr>
				<td align="center">
					<?= @helper('grid.checkbox', array('row' => $client)); ?>
				</td>
				<td align="left">
					<span class="editlinktip hasTip" title="<?= @text('Edit') ?> <?= @escape($client->name); ?>::<?= @escape(substr($client->notes, 0, 300)).'&hellip;'; ?>">
						<a href="<?= @route('view=client&id='.$client->id); ?>">
							<?= @escape($client->name); ?>
					</span>
				</td>
				<td align="center">
					<?= @escape($client->contact_name); ?>
				</td>
				<td align="center">
					<?= @escape($client->email); ?>
				</td>
			</tr>
			<? endforeach; ?>
			
			<? if (!count($clients)) : ?>
				<tr>
					<td colspan="5" align="center">
						<?= @text('No Clients Found'); ?>
					</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</form>