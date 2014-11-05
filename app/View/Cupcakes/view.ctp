<div class="cupcakes view">
<h2><?php echo __('Cupcake'); ?></h2>
	<dl>
		
		<dt><?php echo __('Datetime'); ?></dt>
		<dd>
			<?php echo h($cupcake['Cupcake']['datetime']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cupcake'), array('action' => 'edit', $cupcake['Cupcake']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cupcake'), array('action' => 'delete', $cupcake['Cupcake']['id']), array(), __('Are you sure you want to delete # %s?', $cupcake['Cupcake']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cupcakes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cupcake'), array('action' => 'add')); ?> </li>
	</ul>
</div>
