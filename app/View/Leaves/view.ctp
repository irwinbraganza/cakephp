<div class="leaves view">
<h2><?php echo __('Leave'); ?></h2>
	<dl>
		
		<dt><?php echo __('Reason'); ?></dt>
		<dd>
			<?php echo h($leave['Leave']['reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Startdate'); ?></dt>
		<dd>
			<?php echo h($leave['Leave']['startdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enddate'); ?></dt>
		<dd>
			<?php echo h($leave['Leave']['enddate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Totaldays'); ?></dt>
		<dd>
			<?php echo h($leave['Leave']['totaldays']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Leave'), array('action' => 'edit', $leave['Leave']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Leave'), array('action' => 'delete', $leave['Leave']['id']), array(), __('Are you sure you want to delete # %s?', $leave['Leave']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Leaves'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Leave'), array('action' => 'add')); ?> </li>
	</ul>
</div>
