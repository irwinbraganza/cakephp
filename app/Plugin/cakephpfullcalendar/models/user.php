<?php
class User extends AppModel {    
    
    var $validate = array(
        'email' => array(         
            'email' => array(
                'rule' => array('email', true),
                'message' => 'Invalid email address!'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Email already exist!',
                'last' => true
            )
        ),
        'password' => array(
            'min' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be at least 6 characters!'
            ),
            'required' => array(
                'rule' => 'notEmpty',
                'message'=>'Please enter a password!'
            ),
        ),
        'passwd' => array(
            'min' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be at least 6 characters!'
            ),
            'required' => array(
                'rule' => 'notEmpty',
                'message'=>'Please enter a password!'
            ),
        ),
        'password_confirm' => array(
            'match'=>array(
                'rule' => 'validatePasswordConfirm',
                'message' => 'Passwords do not match !'
            )
        )
	);
    
    function validatePasswordConfirm($data){
        if ($this->data['User']['passwd'] !== $data['password_confirm'])
            return false;

        return true;
    }
    
    function beforeSave(){
        if (isset($this->data['User']['passwd']))
            $this->data['User']['password'] =  Security::hash($this->data['User']['passwd'], null, true);
            
        return true;
    }
}
?>