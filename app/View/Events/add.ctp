<div style="background: #efefef; width: 500px; margin: 10% auto 0 auto;">
    <?php    
        echo $this->Form->create('Event');
        echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')));
        echo $this->Form->input('title' , array('label' => 'Event title'));
        echo '<br/>At: ' . $displayTime;
        echo $this->Form->input('start', array('type'=>'hidden'));
        echo $this->Form->input('end', array('type'=>'hidden'));
        echo $this->Form->input('allDay', array('value' => false,'type'=>'hidden'));
        //echo  $form->end(array('label'=>'Save' ,'name' => 'save'));
        
        
        echo $this->Js->submit(__('Submit', true), array('success' => 'handleResponse(data)', 'url' => array('action' => 'save')));
    ?>
    <a href="#" onclick="$('#eventdata').hide()">Cancel</a>
</div>

<?=$this->Js->writeBuffer(array('inline' => 'true'));?>