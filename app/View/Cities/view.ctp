<div class="cities view">
	<h3><u><?php echo __('View City'); ?></u></h3>
	<?php echo nl2br("\n"); ?>
	<table class="table table-striped">
	<tr>
		
		<td><b><?php echo __('State'); ?></b></td>
		<td>
			<?php echo $this->Html->link($city['State']['name'], array('controller' => 'states', 'action' => 'view', $city['State']['id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Name'); ?></b></td>
		<td>
			<?php echo h($city['City']['name']); ?>
			&nbsp;
		</td>
	</tr>
</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit City'), array('action' => 'edit', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete City'), array('action' => 'delete', $city['City']['id']), array(), __('Are you sure you want to delete # %s?', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add')); ?> </li>
		
	</ul>
</div>
