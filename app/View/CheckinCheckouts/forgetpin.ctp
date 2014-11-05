<div class="container">
  <?php echo $this->Form->create('CheckinCheckout', array('action' => 'forgetpin')); ?>
  <div id="checkin-boxx">      
    <div id="chb-headerr">          
      <div class="logo pull-left">
        <h1>DC Office App</h1>
        <h2>Forgot Pin</h2>
      </div>
      <div class="time pull-right">
              <h1><?php echo date('l, d F Y');?></h1>
      <h3 class="timer"></h3>
      </div>
    </div>
    <div id = "chb">
    </div>
    <div id="chb-contentt">          
              
      <div id="checkin-formm">

      	<?php
      		echo nl2br("\n");
       		echo nl2br("\n");
       		echo $this->Form->input('username',array('class' => 'form-control','placeholder' => 'Enter your e-mail-id','label'=>false)); ?>
		       
        <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-success btn-lg btn-block chb-btn'));?>
      </div>
      <div class="chb-footerr">
        <?php echo $this->Html->link(__('Take me back!'), array('action' => 'add')) ;?>
      </div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
</div>