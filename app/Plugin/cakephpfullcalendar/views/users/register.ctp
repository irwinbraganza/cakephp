<div id="register" style="margin: 0 auto 0 auto; width: 500px;">
    <h2>Register</h2> 
    <?php
        echo $form->create('User', array('action' => 'register'));
        echo $form->input('email');
        echo $form->input('passwd', array('label' => 'Password'));
        echo $form->input('password_confirm', array('type' => 'password'));
        echo $form->submit();
        echo $form->end();
    ?>
</div>