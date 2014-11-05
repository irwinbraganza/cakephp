 <div class="container">
    	<?php	echo $this->Form->create('User', array('class' => 'form-auth'));?>
      <div id="checkin-box">      
        <div id="chb-header">          
          <div class="logo pull-left">
            <h1>DC Office App</h1>
            <h2>Register</h2>
          </div>
          <div class="time pull-right">
            <h1><?php echo date('l, d F Y');?></h1>
            <h3 class="timer"></h3>
          </div>
        </div>
        <div id="chb-content">          
          <h1>Lets get started</h1> 
          <p>Register your DC account</p>          
          <div id="checkin-form">
          	<?php echo $this->Form->input('username', array('class' => 'form-control input-lg', 'placeholder' => 'Enter your  email-id', 'label' => false)); ?></br>
          	<?php echo $this->Form->input('password', array('class' => 'form-control input-lg', 'placeholder' => 'Enter your password', 'label' => false)); ?></br>
          	<?php echo $this->Form->input('password_confirm', array('class' => 'form-control input-lg', 'placeholder' => 'Enter your password again', 'label' => false, 'type' => 'password')); ?>
          	<?php  echo $this->Form->input('CheckinCheckoutPin', array('type' => 'hidden'));
        			echo $this->Form->input( 'role', array( 'value' => 'member'  , 'type' => 'hidden') ); ?>
          	<?php echo $this->Form->submit(__('Register'), array('class' => 'btn btn-primary btn-lg btn-block chb-btn')); ?><br />
          </div>
          <div class="chb-footer">          
            <?php echo $this->Html->link(__('Take me to Login page'), array('controller' => 'users', 'action' => 'login')) ;?>
          </div>
        </div>
      </div>
      <?php echo $this->Form->end(); ?>
    </div>