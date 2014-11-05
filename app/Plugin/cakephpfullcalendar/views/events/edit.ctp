<div style="background: #efefef; width: 500px; margin: 10% auto 0 auto;">
    <?php 
        echo $form->create('Event', array('target'=> '_parent') ); 
        echo $form->input('id', array('type'=>'hidden'));
        echo $form->input('title');
        echo 'When: ' .$displayTime; 
    ?>
    
    <?=$this->Js->submit(__('Submit', true), array('success' => 'handleResponse(data)', 'url' => array('action' => 'save')));?>
    
    
    <?php echo $this->Js->link('Delete', array('action' => 'delete', $this->data['Event']['id']), array('success' => 'handleResponse(data)'));?>
    <a href="#" onclick="$('#eventdata').hide()">Cancel</a>
</div>

<?=$this->Js->writeBuffer(array('inline' => 'true'));?>