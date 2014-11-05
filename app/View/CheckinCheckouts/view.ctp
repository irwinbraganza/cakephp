<div class="checkinCheckouts view">
<h2><?php echo __('Checkin Checkout'); ?></h2>
	<dl>
		
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($checkinCheckout['CheckinCheckout']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Time'); ?></dt>
		<dd>
			<?php echo h($checkinCheckout['CheckinCheckout']['date_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Checkin Checkout'), array('action' => 'edit', $checkinCheckout['CheckinCheckout']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Checkin Checkout'), array('action' => 'delete', $checkinCheckout['CheckinCheckout']['id']), array(), __('Are you sure you want to delete # %s?', $checkinCheckout['CheckinCheckout']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Checkin Checkouts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Checkin Checkout'), array('action' => 'add')); ?> </li>
	</ul>
</div>
