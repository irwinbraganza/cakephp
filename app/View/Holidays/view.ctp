<div class="holidays view">
<h3><u><?php echo __('View Holiday'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
		<table class="table table-striped">
	<tr>
		
		<td><b><?php echo __('Name'); ?></b></td>
		<td>
			<?php echo h($holiday['Holiday']['name']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Date'); ?></b></td>
		<td>
			<?php 

			echo h(date("M-d", strtotime($holiday['Holiday']['date']))); ?>
			&nbsp;
		</td>
		</table>
	</tr>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Holiday'), array('action' => 'edit', $holiday['Holiday']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Holiday'), array('action' => 'delete', $holiday['Holiday']['id']), array(), __('Are you sure you want to delete # %s?', $holiday['Holiday']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Holidays'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Holiday'), array('action' => 'add')); ?> </li>
		
	</ul>
</div>
