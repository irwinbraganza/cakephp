<div style="background: #efefef; width: 500px; margin: 10% auto 0 auto;">
    <?php 
        echo $this->Form->create('Event', array('target'=> '_parent') ); 
        echo $this->Form->input('id', array('type'=>'hidden'));
        echo $this->Form->input('title');
        echo 'When: ' .$displayTime; 
    ?>
    
    <?=$this->Js->submit(__('Submit', true), array('success' => 'handleResponse(data)', 'url' => array('action' => 'save')));?>
    
    
    <?php echo $this->Js->link('Delete', array('action' => 'delete', $this->data['Event']['id']), array('success' => 'handleResponse(data)'));?>
    <a href="#" onclick="$('#eventdata').hide()">Cancel</a>
</div>

<?=$this->Js->writeBuffer(array('inline' => 'true'));?>