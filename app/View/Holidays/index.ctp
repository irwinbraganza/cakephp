<div class="holidays index">
	<h2><?php echo __('Holidays'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			
			<th style="text-align: center;" class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($holidays as $holiday): ?>
	<tr>
		
		<td><?php echo h($holiday['Holiday']['name']); ?>&nbsp;</td>
		<td><?php 
			$date = date("M-d", strtotime($holiday['Holiday']['date']));
			echo h($date);
			?>&nbsp;
		</td>
		
		<td class="actions">
			
					    <?php echo $this->Html->image('edit.gif', array(
			            'width'=>'15px','height'=>'15px',
			            "alt" => "Edit",
			            'url' => array('action' => 'edit',  $holiday['Holiday']['id'])
			            ));?>
			            
			            <?php echo $this->Form->postLink(
			              $this->Html->image('delete.png', array('alt' => __('Delete'),'width'=>'15px','height'=>'15px')), //le image
			              array('action' => 'delete', $holiday['Holiday']['id']), //le url
			              array('escape' => false), //le escape
			              __('Are you sure you want to delete # %s?', $holiday['Holiday']['id']) //le confirm
			            ); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Holiday'), array('action' => 'add')); ?></li>
		
	</ul>
</div>
