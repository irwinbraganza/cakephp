<div class="notifications form">
<h3><u><?php echo __('Send Notification'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
<?php echo $this->Form->create('Notification'); ?>	
	
	
	<?php echo $this->Form->input('user_id',array('label'=>false,'empty' => 'SELECT EMPLOYEE'));?>
	<table class="table table-striped">
	<tr>	
		<td><b><?php echo __('Title'); ?></b></td>
		<td>
			<?php echo h($notification['Notification']['event_name']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Type'); ?></b></td>
		<td>
			<?php echo h($notification['Notification']['type']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Details'); ?></b></td>
		<td>
			<?php echo h($notification['Notification']['details']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Datetime'); ?></b></td>
		<td>
			<?php echo h($notification['Notification']['datetime']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Venue'); ?></b></td>
		<td>
			<?php echo h($notification['Notification']['venue']); ?>
			&nbsp;
		</td>
	</tr>
	</tr>
	</table>


<?php echo $this->Form->end(__('Submit')); ?>	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Notification'), array('action' => 'edit', $notification['Notification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Notification'), array('action' => 'delete', $notification['Notification']['id']), array(), __('Are you sure you want to delete # %s?', $notification['Notification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('action' => 'add')); ?> </li>
	</ul>
</div>
