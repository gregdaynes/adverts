<?php /** $Id$ **/ ?>
<?php // no direct access
defined('KOOWA') or die('Restricted access'); ?>

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<?= @helper('behavior.tooltip'); ?>

<form action="<?= @route() ?>" method="get" class="-koowa-grid">
	<?= @template('default_filter'); ?>
        <table class="adminlist">
		<thead>
			<tr>
				<th width="5%"></th>
				<th>
				    <?= @helper('grid.sort', array('column' => 'name', 'title' => 'Website')); ?>
				</th>
				<th width="5%">
				    <?= @helper('grid.sort', array('column' => 'enabled', 'title' => 'Published')); ?>
				</th>
				<th>
				    <?= @helper('grid.sort', array('column' => 'url', 'title' => 'URL')); ?>
				</th>
				<th>
				    <?= @helper('grid.sort', array('column' => 'contact_name', 'title' => 'Contact Name')); ?>
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
				<td colspan="5">
				    <?= @helper('paginator.pagination', array('total' => $total)) ?>
				</td>
			</tr>
		</tfoot>
		
		<tbody>
			<? foreach ($sites as $site) : ?>
			<tr>
				<td align="center">
					<?= @helper('grid.checkbox', array('row' => $site)); ?>
				</td>
				<td align="left">
					<span class="editlinktip hasTip" title="<?= @text('Edit') ?> <?= @escape($site->name); ?>::<?= @escape(substr($site->notes, 0, 300)).'&hellip;'; ?>">
					    <a href="<?= @route('view=site&id='.$site->id); ?>">
					    <?= @escape($site->name); ?>
					</span>
				</td>
				<td align="center">
				     <?= @helper('grid.enable', array('row' => $site, 'option' => 'com_adverts', 'view' => 'site')) ?>
				</td>
				<td align="center">
				    <a href="<?= @escape($site->url); ?>">
                                        <?= @escape($site->url); ?>
				    </a>
				</td>
				<td align="center">
				    <?= @escape($site->contact_name); ?>
				</td>				
			</tr>
			<? endforeach; ?>
			
			<? if (!count($sites)) : ?>
				<tr>
				    <td colspan="5" align="center">
				    	<?= @text('No Sites Found'); ?>
				    </td>
				</tr>
			<? endif; ?>
		</tbody>
	</table>
</form>