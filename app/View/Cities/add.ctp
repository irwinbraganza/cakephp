<div class="cities form">
<?php echo $this->Form->create('City'); ?>
	<fieldset>
		<h3><u><?php echo __('Add City'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		echo $this->Form->input('state_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
		
	</ul>
</div>
