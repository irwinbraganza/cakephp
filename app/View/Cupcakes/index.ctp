<div class="cupcakes index">
	<h2><?php echo __('Cupcakes'); ?></h2>
<?php echo $this->Form->create(); ?>

<?php echo $this->Form->input('user_id' ,array('id'=>'user-dropdown','label'=>false,'empty' => 'SELECT EMPLOYEE'));?>
<?php echo $this->Form->end(); ?>
	<div id="Cupcakes">

	    <table cellpadding="0" cellspacing="0">
	    <thead>
			<tr>
				<th><?php echo $this->Paginator->sort('firstname'); ?></th>
				<th><?php echo $this->Paginator->sort('cupcakespending'); ?></th>
				<th><?php echo $this->Paginator->sort('cupcakesbought'); ?></th>
			</tr>
		</thead>
		<tbody>
	 	<?php foreach ($userRecords  as $user ): ?>
	           
		<tr>
	        <th><b><?php echo h($user['User']['firstname']); ?>&nbsp;</b></th>
	        <th><b><?php echo h($user['User']['cupcakespending']);?>&nbsp;</b></th>
	        <th><b><?php echo h($user['User']['cupcakesbought']); ?>&nbsp;</b></th>
	            
	    </tr> 
	        
	    <tr>
	        <?php if($user['User']['cupcakespending']>0):?>
					
			
	        <td><center><?php echo $this->Paginator->sort('datetime','Date'); ?></center></td>
	        <td><center><?php echo $this->Paginator->sort('Time'); ?></center></td>
			<td class="actions"><center><?php echo __('Actions'); ?></center></td>
			
			<?php endif; ?>
	    </tr>
		    <?php foreach ($user['Cupcake'] as $cupcake): ?>
				<tr>
					<?php if($user['User']['cupcakespending']>0):?>
					
			        <td><center><?php echo date("d-M-Y ", strtotime($cupcake['datetime'])); ?>&nbsp;</center></td>
			        <td><center><?php echo date("g:i A", strtotime($cupcake['datetime'])); ?>&nbsp;</center></td>
					<td class="actions">
									
							<!-- 		<?php echo $this->Html->image('view.png', array(
			            'width'=>'15px','height'=>'15px',
			            "alt" => "Edit",
			            'url' => array('action' => 'view',  $cupcake['id'])
			            ));?> -->

			            <?php echo $this->Html->image('edit.gif', array(
			            'width'=>'15px','height'=>'15px',
			            "alt" => "Edit",
			            'url' => array('action' => 'edit',  $cupcake['id'])
			            ));?>
			            
			            <?php echo $this->Form->postLink(
			              $this->Html->image('delete.png', array('alt' => __('Delete'),'width'=>'15px','height'=>'15px')), //le image
			              array('action' => 'delete', $cupcake['id']), //le url
			              array('escape' => false), //le escape
			              __('Are you sure you want to delete # %s?', $cupcake['id']) //le confirm
			            ); ?>
            
					</td>
					
					<?php endif; ?>
				</tr>
			        
			<?php endforeach; ?>
	    <?php endforeach; ?>
		</tbody>
		</table>
	</div >
	<p>
	<?php
	// echo $this->Paginator->counter(array(
	// 'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	// ));
	?>	</p>
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
		<li><?php echo $this->Html->link(__('New Cupcake'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Cupcakes'), array('action' => 'index')); ?></li>
	</ul>
</div>

