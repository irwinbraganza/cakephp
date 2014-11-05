<div class="notifications index">
	<h2><?php echo __('Notifications'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			
			<th><?php echo $this->Paginator->sort('event_name','Title'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('datetime','Date'); ?></th>
			<th><?php echo $this->Paginator->sort('Time'); ?></th>
			<th><?php echo $this->Paginator->sort('venue'); ?></th>
			<th class="actions"><center><?php echo __('Actions'); ?></center></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($notifications as $notification): ?>
	<tr>
		
		<td><?php echo h($notification['Notification']['event_name']); ?>&nbsp;</td>
		<td><?php echo h($notification['Notification']['type']); ?>&nbsp;</td>
		<td><?php echo date("d-M-Y", strtotime($notification['Notification']['datetime'])); ?>&nbsp;</td>
		<td><?php echo date("g:i A", strtotime($notification['Notification']['datetime'])); ?>&nbsp;</td>
		<td><?php echo h($notification['Notification']['venue']); ?>&nbsp;</td>
		<td class="actions">
			
						<?php echo $this->Html->image('mailto.png', array(
			            'width'=>'15px','height'=>'15px',
			            "alt" => "Mail To",
			            'url' => array('action' => 'send_to',  $notification['Notification']['id'])
			            ));?> 

						<?php echo $this->Html->image('view.png', array(
			            'width'=>'15px','height'=>'15px',
			            "alt" => "Edit",
			            'url' => array('action' => 'view',  $notification['Notification']['id'])
			            ));?> 

			            <?php echo $this->Html->image('edit.gif', array(
			            'width'=>'15px','height'=>'15px',
			            "alt" => "Edit",
			            'url' => array('action' => 'edit',  $notification['Notification']['id'])
			            ));?>
			            
			            <?php echo $this->Form->postLink(
			              $this->Html->image('delete.png', array('alt' => __('Delete'),'width'=>'15px','height'=>'15px')), //le image
			              array('action' => 'delete', $notification['Notification']['id']), //le url
			              array('escape' => false), //le escape
			              __('Are you sure you want to delete # %s?', $notification['Notification']['id']) //le confirm
			            ); ?>
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
		<li><?php echo $this->Html->link(__('New Notification'), array('action' => 'add')); ?></li>
	</ul>
</div>
