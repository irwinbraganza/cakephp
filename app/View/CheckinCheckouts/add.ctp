<div class="container">
  <?php echo $this->Form->create('CheckinCheckout'); ?>
  <div id="checkin-boxx">      
    <div id="chb-headerr">          
      <div class="logo pull-left">
        <h1>DC Office App</h1>
        <h2>Check-in</h2>
      </div>
      <div class="time pull-right">
              <h1><?php echo date('l, d F Y');?></h1>
      <h3 class="timer"></h3>
      </div>
    </div>
    <div id = "chb">
    </div>
    <div id="chb-contentt">          
      <h4>Enter your 4 digit pin to checkin or checkout</h4>          
      <div id="checkin-formm">
        <?php 
        	
        	echo $this->Form->input('pin', array('class' => 'form-control input-lgg', 'placeholder' => 'PIN', 'type' => 'password', 'label' => false, 'maxLength' => 4));
	        echo $this->Form->input('user_id',array('type' => 'hidden'));
			echo $this->Form->input('status',array('type' => 'hidden'));
			echo $this->Form->input('date_time',array('type' => 'hidden'));
        ?>
        <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-success btn-lg btn-block chb-btn'));?>
      </div>
      <div class="chb-footerr">
        <?php echo $this->Html->link(__('Change my Pin'),array("controller"=>"CheckinCheckouts","action"=>"changepin"));?><br />
        <?php echo $this->Html->link(__('Oops! I forgot my pin'),array("controller"=>"CheckinCheckouts","action"=>"forgetpin"));?>
      </div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
</div>