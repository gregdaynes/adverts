<?php /** $Id: default.php 795 2011-06-21 20:32:00Z media $ */ ?>
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
				<td align="center"><?= @helper('grid.checkall'); ?></td>
				<th>
					<?= @helper('grid.sort', array('column' => 'name', 'title' => 'Campaign Name')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'impressions', 'title' => 'Impressions')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'clicks', 'title' => 'Click Throughs')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'weight', 'title' => 'Weight')); ?>
				</th>
				<th width="5%">
				    <?= @helper('grid.sort', array('column' => 'enabled', 'title' => 'Published')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'publish_up', 'title' => 'Start Date')); ?>
				</th>
				<th>
					<?= @helper('grid.sort', array('column' => 'sales_person', 'title' => 'Sales Person')); ?>
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
			    <td></td>           
			    <td align="center"> 
			        <?= @helper('listbox.published', array('name' => 'enabled')); ?>
			    </td>                
			    <th>
			    	<?= @helper('grid.sort', array('column' => 'publish_down', 'title' => 'Stop Date')); ?>
			    </th>
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
			<? foreach ($campaigns as $campaign) : ?>
			<tr>
				<td align="center">
					<?= @helper('grid.checkbox', array('row' => $campaign)); ?>
				</td>
				<td align="left">
					<span class="editlinktip hasTip" title="<?= @text('Edit') ?> <?= @escape($campaign->name); ?>::<?= @escape(substr($campaign->notes, 0, 300)).'&hellip;'; ?>">
						<a href="<?= @route('view=campaign&id='.$campaign->id); ?>">
							<?= @escape($campaign->name); ?>
					</span>
				</td>
				<td align="center">
					<?= @escape($campaign->impressions); ?>
				</td>
				<td align="center">
					<?= @escape($campaign->clicks); ?>
				</td>
				<td align="center">
					<?= @escape($campaign->weight); ?>
				</td>
				<td align="center">
				    <?= @helper('grid.enable', array('row' => $campaign)) ?>
				</td>
				<td align="center">
					<?= @escape($campaign->publish_up); ?>
					<br />
					<?= @escape($campaign->publish_down); ?>
				</td>
				<td align="center">
					<? $model = KFactory::get('admin::com.contact.model.contacts')->set('id', $campaign->sales_person); ?>
					<?= $model->getItem()->name; ?>
				</td>
			</tr>
			<? endforeach; ?>
			
			<? if (!count($campaigns)) : ?>
				<tr>
					<td colspan="9" align="center">
						<?= @text('No Campaigns Found'); ?>
					</td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</form>