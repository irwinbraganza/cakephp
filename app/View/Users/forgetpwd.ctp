<div class="container">
  <?php echo $this->Form->create('User', array('action' => 'forgetpwd')); ?>
  <div id="checkin-boxx">      
    <div id="chb-headerr">          
      <div class="logo pull-left">
        <h1>DC Office App</h1>
        <h2>Forgot Password</h2>
      </div>
      <div class="time pull-right">
              <h1><?php echo date('l, d F Y');?></h1>
      <h3 class="timer"></h3>
      </div>
    </div>
    <div id = "chb">
    </div>
    <div id="chb-contentt">          
      <h4>Enter your email address</h4>          
      <div id="checkin-formm">
        <?php echo $this->Form->input('username', array('class' => 'form-control','label' => false));?>
        <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-success btn-lg btn-block chb-btn'));?>
      </div>
    </div>
  </div>
  <?php echo $this->Form->end(); ?>
</div>