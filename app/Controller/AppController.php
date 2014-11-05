<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
   public $helpers = array('Html','Form','Js'=> array('prototype'),'Js','Time');
   
   public $components = array(
    'DebugKit.Toolbar',
    'RequestHandler',
    'Session',
    'Auth' => array(
        'loginRedirect' => array('controller' => 'users', 'action' => 'admin'),
        'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
        'authError' => 'You must be logged in to view this page.',
        'loginError' => 'Invalid Username or Password entered, please try again.',
        'authorize' => array('Controller') // Added this line
                   
       )      
                
      );
 
// only allow the login controllers only
public function beforeFilter() {
        $this->loadModel('User');
        $uid = $this->Auth->user('id');
        $this->set('uid',$uid);
        //$userId = !empty($this->request->data['User']['id']) ? $this->request->data['User']['id'] : null;
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $uid));
        $user = $this->User->find('first', $options);
        $this->set('user',$user);

       
}
 
public function isAuthorized($user) {
    // Admin can access every action
    if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }else{
        $this->Session->setFlash('Access denied');
        $this->redirect($this->Auth->redirectUrl());
        return false;
    }
}


public function favorites() {
    $this->request->onlyAllow('ajax'); // No direct access via browser URL - Note for Cake2.5: allowMethod()
    $this->viewClass = 'Tools.Ajax';
    $data = array(
        'content' => '...',
        'error' => '',
    );
    $this->set(compact('data')); // Pass $data to the view
    $this->set('_serialize', 'data'); // Let the JsonView class know what variable to use
}
}