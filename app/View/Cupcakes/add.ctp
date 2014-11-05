<div class="cupcakes add form">
<?php echo $this->Form->create('Cupcake'); ?>
	<fieldset>
		<h3><u><?php echo __('Add Cupcake'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<?php
		echo $this->Form->input('user_id',array('id'=>'user-dropdown-add','empty' => 'SELECT EMPLOYEE','label'=>false));
		echo $this->Form->input('datetime',array('label'=>'Date & Time:'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cupcakes'), array('action' => 'index')); ?></li>
	</ul>
</div>
