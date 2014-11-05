<div class="holidays form">
<?php echo $this->Form->create('Holiday'); ?>
	<fieldset>
		<h3><u><?php echo __('Edit Holiday'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('date',array('type'=>'date'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Holiday.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Holiday.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Holidays'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
