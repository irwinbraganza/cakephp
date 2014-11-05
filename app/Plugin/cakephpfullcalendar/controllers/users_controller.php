<?php
class UsersController extends AppController {	
    function beforeFilter(){
        parent::beforeFilter();
        
        $this->Auth->allow('*');
    }
    
	function login() {
	}
	
    function register() {
        if (!empty($this->data)) {
            if($this->User->save($this->data)){
                $this->redirect(array('action' => 'login')); 
            }
        }
    }
    
	function logout() {          
        $this->Session->delete('Auth');
        $this->redirect(array('action' => 'login'));            
    }
}
?>
