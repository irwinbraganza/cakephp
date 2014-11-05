<div class="cupcakes form">
<?php echo $this->Form->create('Cupcake'); ?>
	<fieldset>
		<h3><u><?php echo __('Edit Cupcake'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('datetime',array('separator' => str_repeat("&nbsp;", 10)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cupcake.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Cupcake.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cupcakes'), array('action' => 'index')); ?></li>
	</ul>
</div>
