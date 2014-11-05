<div class="notifications form">
<?php echo $this->Form->create('Notification'); ?>
	<fieldset>
		<h3><u><?php echo __('Edit Notification'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('event_name', array('label' => 'Title'));
		echo $this->Form->input('type', array('options' => array('MEETING' => 'Meeting', 'EVENT' => 'Event')));
		echo $this->Form->input('details');
		echo $this->Form->input('datetime',array('separator' => str_repeat("&nbsp;", 10)));
		echo $this->Form->input('venue');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Notification.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Notification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?></li>
	</ul>
</div>
