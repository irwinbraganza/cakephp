<div class="holidays form">
<?php echo $this->Form->create('Holiday'); ?>
	<fieldset>
		<h3><u><?php echo __('New Holiday'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		echo $this->Form->input('name');
		echo __('Date & Month');
		echo nl2br("\n");
		echo $this->Form->day('day');
		echo $this->Form->month('month');
		echo $this->Form->date('date',array('type'=>'hidden'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Holidays'), array('action' => 'index')); ?></li>

	</ul>
</div>
