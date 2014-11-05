<div  style="background: #efefef; width: 500px; margin: 10% auto 0 auto;">
			<?php 			
				echo $this->Form->create('Leave'); 	
		 		echo __('Add Leave'); 
				$uid=$useraddId;
				echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $uid ));
		        echo $this->Form->input('reason', array('label' => 'Leave Reason'));
		       	echo $this->Form->input('start', array('type'=>'hidden'));
        		echo $this->Form->input('end', array('type'=>'hidden'));
    			echo $this->Form->input('allDay', array('value' => false,'type'=>'hidden'));
        		echo $this->Form->checkbox('totaldays', array('value' => '0.5','hiddenField' => '1',));
        		echo __('Half Day'); 
				echo '<br/><br/>At: ' . $displayTime;
			?>
	
<?php  echo $this->Js->submit(__('Submit', true), array('success' => 'handleResponse(data)', 'url' => array( 'action' => 'save'))); ?>
<a href="#" onclick="$('#eventdata').hide()">Cancel</a>
</div>

<?=$this->Js->writeBuffer(array('inline' => 'true'));?>

