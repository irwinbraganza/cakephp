<div class="CheckinCheckout form">
<?php echo $this->Form->create('CheckinCheckout'); ?>
	<fieldset>
		<h3><u><?php echo __('New Checkin/Checkout'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		
		echo $this->Form->input('user_id',array('label'=>false,'empty' => 'SELECT EMPLOYEE'));
		echo $this->Form->input('pin',array('type'=>'hidden'));
		echo $this->Form->input('status',array('options' => array( 'CHECK-IN' => 'CHECK-IN','CHECK-OUT' => 'CHECK-OUT')));
		echo $this->Form->input('date_time',array('separator' => str_repeat("&nbsp;", 10)));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List CheckinCheckout'), array('action' => 'index')); ?></li>

	</ul>
</div>