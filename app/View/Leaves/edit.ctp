<div style="background: #efefef; width: 500px; margin: 10% auto 0 auto;">
    <?php 
    	echo __('Edit Leave');
        echo $this->Form->create('Leave', array('target'=> '_parent') ); 
        echo $this->Form->input('id', array('type'=>'hidden'));
        echo $this->Form->input('reason');
        echo 'When: ' .$displayTime; 
    ?>
    
    <?=$this->Js->submit(__('Submit', true), array('success' => 'handleResponse(data)', 'url' => array('action' => 'save')));?>
    
    
    <?php echo $this->Js->link('Delete', array('action' => 'delete', $this->data['Leave']['id']), array('success' => 'handleResponse(data)'));?>
    <a href="#" onclick="$('#eventdata').hide()">Cancel</a>
</div>

<?=$this->Js->writeBuffer(array('inline' => 'true'));?>