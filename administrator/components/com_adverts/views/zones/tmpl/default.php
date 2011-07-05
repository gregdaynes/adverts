<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die( 'Restricted access' ); ?>

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
					<?= @helper('grid.sort', array('column' => 'name', 'title' => 'Zone')); ?>
				</th>
				<th width="5%">
				    <?= @helper('grid.sort', array('column' => 'enabled', 'title' => 'published')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'size', 'title' => 'Size')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'width', 'title' => 'Width')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'size', 'title' => 'Height')); ?>
				</th>
			</tr>
			<tr>
			    <td align="center">
			        <?= @helper( 'grid.checkall'); ?>
			    </td>
			    <td>
			        <?= @helper( 'grid.search'); ?>
			    </td>              
			    <td align="center"> 
			        <?= @helper('listbox.published', array('name' => 'enabled')); ?>
			    </td>                
			    <td></td>
			    <td></td>
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
			<? foreach ($zones as $zone) : ?>
			<tr>
				<td align="center">
					<?= @helper('grid.checkbox', array('row' => $zone)); ?>
				</td>
				<td align="left">
					<span class="editlinktip hasTip" title="<?= @text('Edit') ?> <?= @escape($zone->name); ?>::<?= @escape(substr($zone->notes, 0, 300)).'&hellip;'; ?>">
						<a href="<?= @route('view=zone&id='.$zone->id); ?>">
							<?= @escape($zone->name); ?>
					</span>
				</td>
				<td align="center">
				    <?= @helper('grid.enable', array('row' => $zone)) ?>
				</td>
				<td align="center">
					<?= @helper('admin::com.adverts.template.helper.listbox.fetch_size', array('value' => $zone->size)) ?>
				</td>
				<td align="center">
					<?= $zone->width; ?><?= @text('px'); ?>
				</td>
				<td align="center">
					<?= $zone->height; ?><?= @text('px'); ?>
				</td>
			</tr>
			<? endforeach; ?>
			
			<? if (!count($zones)) : ?>
				<tr>
					<td colspan="6" align="center">
						<?= @text('No Zones Found'); ?>
					</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</form>