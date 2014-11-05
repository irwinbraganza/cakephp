<?php
class AppController extends Controller {
    var $components = array('Session', 'RequestHandler',
        'Auth' => array(
            'authorize' => 'controller',
            #Authentication fields : email, password
            'fields' => array('username' => 'email', 'password' => 'password'),
            #login page is defined by users controller, action login
            'loginAction' => array('controller' => 'users', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'events', 'action' => 'index'),
            #after user logut, redirect them to home page
            'logoutRedirect' => '/',
            'loginError' => 'Invalid username/password !'
        )
    );
    
    function beforeFilter(){
    }
    
    function isAuthorized() {
        return $this->Auth->user();   
    }
}