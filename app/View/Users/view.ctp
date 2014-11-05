<div class="users view">
<h3><u><?php echo __('View User'); ?></u></h3>
		<?php echo nl2br("\n"); ?>
	<table class="table table-striped">
	<tr>
		<td><b><?php echo __('First Name'); ?></b></td>
		<td>
			<?php echo h($user['User']['firstname']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Last Name'); ?></b></td>
		<td>
			<?php echo h($user['User']['lastname']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Profile Picture'); ?></b></td>
		<td>
			<?php echo $this->Html->image('uploads/users/'.$user['User']['upload'], array('width'=>'100px','height'=>'115px')); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('City'); ?></b></td>
		<td>
			<?php echo $this->Html->link($user['City']['name'], array('controller' => 'cities', 'action' => 'view',$user['User']['city_id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('State'); ?></b></td>
		<td>
			<?php echo $this->Html->link($user['State']['name'], array('controller' => 'states', 'action' => 'view',$user['User']['state_id'])); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Country'); ?></b></td>
		<td>
			<?php echo $this->Html->link($user['Country']['name'], array('controller' => 'countries', 'action' => 'view',$user['User']['country_id'])); ?>
			&nbsp;
		</td>
	
	</tr>
	<tr>
		<td><b><?php echo __('Date of Birth'); ?></b></td>
		<td>
			<?php echo h($user['User']['dob']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Date of Joining'); ?></b></td>
		<td>
			<?php echo h($user['User']['doj']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Gracetime'); ?></b></td>
		<td>
			<?php echo h($user['User']['gracetime']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('e-mail id'); ?></b></td>
		<td>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Contact Number'); ?></b></td>
		<td>
			<?php echo h($user['User']['contact']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Role'); ?></b></td>
		<td>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Designation'); ?></b></td>
		<td>
			<?php echo h($user['User']['Designation']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>	
		<td><b><?php echo __('Leaves Remaining'); ?></b></td>
		<td>
			<?php echo h($user['User']['leavesremaining']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Leaves Entitled'); ?></b></td>
		<td>
			<?php echo h($user['User']['leavesentitled']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Cupcakes Pending'); ?></b></td>
		<td>
			<?php echo h($user['User']['cupcakespending']); ?>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td><b><?php echo __('Cupcakes Bought'); ?></b></td>
		<td>
			<?php echo h($user['User']['cupcakesbought']); ?>
			&nbsp;
		</td>
	</tr>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
