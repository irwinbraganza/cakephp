<div class="container">
    <?php   echo $this->Form->create('User', array('class' => 'form-auth'));?>
    <div id="checkin-box">
        <div id="chb-header">
            <div class="logo pull-left">
                <h1>DC Office App</h1>
                <h2>Login</h2>
            </div>
            <div class="time pull-right">
                <h1><?php echo date('l, d F Y');?></h1>
                <h3 class="timer"></h3>
            </div>
        </div>
    <div id = "chb"></div>
        <div id="chb-content">
            <h1>Lets get started</h1> 
            <p>Enter your credentials and login to your DC Dashboard</p>     
            <div id="checkin-form">
                <?php echo $this->Form->input('username', array('class' => 'form-control input-lg', 'placeholder' => 'Enter your email-id', 'label' => false)); ?> </br>
                <?php echo $this->Form->input('password', array('class' => 'form-control input-lg', 'placeholder' => 'Enter your password', 'label' => false)); ?>  
                <?php echo $this->Form->submit(__('Login'), array('class' => 'btn btn-success btn-lg btn-block chb-btn')); ?><br />
            </div>
            <div class="chb-footer">
                <?php  echo $this->Html->link(__('Register me, I dont have an account'),array('action'=>'add')); ?><br />
                <?php echo $this->Html->link(__('Help, I forgot my password'), array("controller"=>"users","action"=>"forgetpwd")); ?>
            </div> 
        </div>
    </div>
   <?php echo $this->Form->end(); ?>
</div>