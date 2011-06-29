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
			</tr>
			<tr>
			    <td align="center">
			        <?= @helper( 'grid.checkall'); ?>
			    </td>
			    <td>
			        <?= @helper( 'grid.search'); ?>
			    </td>
			</tr>
		</thead>
		
		<tfoot>
			<tr>
				<td colspan="2">
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
			</tr>
			<? endforeach; ?>
			
			<? if (!count($advertisements)) : ?>
				<tr>
					<td colspan="5" align="center">
						<?= @text('No Advertisements Found'); ?>
					</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</form>