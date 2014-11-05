<div class="login" style="margin: 0 auto 0 auto; width: 500px;"> 
<h2>Login</h2> 
    <?php echo $this->Session->flash('auth');?>    
    <?php echo $form->create('User', array('action' => 'login'));?> 
        <?php echo $form->input('email');?> 
        <?php echo $form->input('password');?> 
        <?php echo $form->submit('Login');?> 
    <?php echo $form->end(); ?> 
</div> 