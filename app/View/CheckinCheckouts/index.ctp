<div class="checkinCheckouts index">
	<h2><?php echo __('Checkin/Checkouts');	?></h2>
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
					
		            <th><?php echo $this->Paginator->sort('firstname'); ?></th>
					<th><?php echo $this->Paginator->sort('date_time','Check-In'); ?></th>
					<th class="actions"><center><?php echo __(''); ?></center></th>
					<th><?php echo $this->Paginator->sort('Check-out'); ?></th>
					<th class="actions"><center><?php echo __(''); ?></center></th>
			</tr>
		</thead>

		<tbody>
			<?php $buff = 0?>
		<?php foreach ($checkinCheckouts as $checkinCheckout): ?>


		<?php $init = date("d-M-Y", strtotime($checkinCheckout['CheckinCheckout']['date_time']));?>
		<?php if($buff!=$init):?>
			
		<tr>

		<th><?php echo h(date("d-M-Y", strtotime($checkinCheckout['CheckinCheckout']['date_time']))); ?>&nbsp;</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		</tr>
		
		<?php endif;?>
		<?php $buff = date("d-M-Y", strtotime($checkinCheckout['CheckinCheckout']['date_time']));?>	
		 <?php if($checkinCheckout['CheckinCheckout']['status']=="CHECK-IN"): ?>
			<tr>

				<?php 
				$check=$checkinCheckout['User']['id']; 
				
				;?>
						<td><?php echo h($checkinCheckout['User']['firstname']); ?>&nbsp;</td>
						

						<?php
						$grace = 30+$checkinCheckout['User']['gracetime'];
						$starttime = date ("Y-m-d 09:".$grace.":s", strtotime($checkinCheckout['CheckinCheckout']['date_time']));
						?>

						<?php if(date ("Y-m-d H:i", strtotime($checkinCheckout['CheckinCheckout']['date_time'])) >
						date ("Y-m-d H:i", strtotime($starttime)) ):?>
						<td><font color="red"><?php echo h(date(" g:i A ", strtotime($checkinCheckout['CheckinCheckout']['date_time']))); ?>&nbsp;</font></td>
						<?php else: ?>
						<td><?php echo h(date(" g:i A ", strtotime($checkinCheckout['CheckinCheckout']['date_time']))); ?>&nbsp;</td>
						<?php endif; ?>

						<td class="actions">
							
							<?php echo $this->Html->image('edit.gif', array(
						    'width'=>'15px','height'=>'15px',
						    "alt" => "Edit",
						    'url' => array('action' => 'edit', $checkinCheckout['CheckinCheckout']['id'])
							));?>
							
							<?php echo $this->Form->postLink(
							  $this->Html->image('delete.png', array('alt' => __('Delete'),'width'=>'15px','height'=>'15px')), //le image
							  array('action' => 'delete', $checkinCheckout['CheckinCheckout']['id']), //le url
							  array('escape' => false), //le escape
							  __('Are you sure you want to delete # %s?', $checkinCheckout['CheckinCheckout']['id']) //le confirm
							); ?>
							
						</td>

						<?php foreach($checkinCheckouts as $checkinCheckoutw):?>
						
						<?php $datecheck=date ("d-M-Y", strtotime($checkinCheckoutw['CheckinCheckout']['date_time']));?>
							
						<?php if($checkinCheckoutw['CheckinCheckout']['user_id']==$check && $checkinCheckoutw['CheckinCheckout']['status']=="CHECK-OUT" && $datecheck==$buff):?>

							<td><?php echo h(date(" g:i A ", strtotime($checkinCheckoutw['CheckinCheckout']['date_time']))); ?>&nbsp;</td>
							<td class="actions">
							
							<?php echo $this->Html->image('edit.gif', array(
						    'width'=>'15px','height'=>'15px',
						    "alt" => "Edit",
						    'url' => array('action' => 'edit', $checkinCheckoutw['CheckinCheckout']['id'])
							));?>
							<?php echo $this->Form->postLink(
							  $this->Html->image('delete.png', array('alt' => __('Delete'),'width'=>'15px','height'=>'15px')), //le image
							  array('action' => 'delete', $checkinCheckoutw['CheckinCheckout']['id']), //le url
							  array('escape' => false), //le escape
							  __('Are you sure you want to delete # %s?', $checkinCheckoutw['CheckinCheckout']['id']) //le confirm
							); ?>
												
						<?php endif;?>

						
						


						<?php endforeach;?>



						
			</tr>
		<?php endif;?>

			
		<?php endforeach; ?>
		</tbody>
	</table>
	<p>
		<?php
		// echo $this->Paginator->counter(array(
		// 'format' => __('Page {:page} of {:pages}, 
		// showing {:current} records out of {:count} total, 
		// starting on record {:start}, 
		// ending on {:end}')
		// ));
		?>	
	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Checkin Checkout'), array('action' => 'add_new')); ?></li>
	</ul>
</div>
