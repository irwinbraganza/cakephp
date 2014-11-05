<div class="checkinCheckouts form">
<?php echo $this->Form->create('CheckinCheckout'); ?>
	<fieldset>
		<h3><u><?php echo __('Edit Checkin/Checkout'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
			<?php
				echo $this->Form->input('id');
			 	echo $this->Form->input('date_time',array('label'=>'Time of Checkin/Checkout (Format 24 hours)','type'=>'time','timeFormat'=>'24' ));
			?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CheckinCheckout.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('CheckinCheckout.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Checkin Checkouts'), array('action' => 'index')); ?></li>
	</ul>
</div>
