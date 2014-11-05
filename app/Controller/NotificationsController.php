<?php
App::uses('AppController', 'Controller');

/**
 * Notifications Controller
 *
 * @property Notification $Notification
 * @property PaginatorComponent $Paginator
 */
class NotificationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Security');



    public function beforeFilter() {
    	parent::beforeFilter();
        $this->Security->csrfUseOnce = true;
      	$this->Security->blackHoleCallback = 'blackhole';
    } 

    public function blackhole($type) {
        $this->redirect(array('action' => 'index'));
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Notification->recursive = 0;

		$this->Paginator->settings = array(
		        'Notification' => array(
		            'limit' => 20,
		            'order' => array('datetime' => 'desc')
		        )
    	);
		
		$this->set('notifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
		$this->set('notification', $this->Notification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		App::uses('CakeEmail', 'Network/Email');

		date_default_timezone_set('Asia/Kolkata');
		if ($this->request->is('post')) {

			$this->Notification->create();
			if ($this->Notification->save($this->request->data)) {
				
				$title = $this->request->data['Notification']['event_name'];
                $type = $this->request->data['Notification']['type'];
                $details = $this->request->data['Notification']['details'];
                $datetime = $this->request->data['Notification']['datetime'];
                $venue = $this->request->data['Notification']['venue'];
				
				$this->loadModel('User');
				$usersnotify = $this->User->find('all');
											
				$emailids=array();
				
				foreach($usersnotify as $notify){
				array_push($emailids,$notify['User']['username']);
				}
				
				 $connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                if($connected){  
	                $this->Email = new CakeEmail('gmail');
	                $this->Email->template('notifymeetevents');
	                $this->Email->from(array('irwin93jesus@gmail.com' => 'Diet Code'));
	                $this->Email->bcc($emailids);
	                $this->Email->subject('Diet Code Notification');
	                $this->Email->emailFormat('both');
	                   
	                $this->Email->viewVars(array('title' => $title));
	                $this->Email->viewVars(array('type' => $type));
	                $this->Email->viewVars(array('details' => $details));
	                $this->Email->viewVars(array('datetime' => $datetime));
	                $this->Email->viewVars(array('venue' => $venue));
	                $this->Email->send();
					
					$this->Session->setFlash(__('The notification has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('You are not connected to the Internet.'));
				}

				
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		}
	}




	public function send_to($id = null) {

		App::uses('CakeEmail','Network/Email');

		date_default_timezone_set('Asia/Kolkata');

		// if (!$this->Notification->exists($id)) {
		// 	throw new NotFoundException(__('Invalid notification'));
		// }
		
		$this->loadModel('User');
		$users = $this->User->find('list', array(
						'fields' => array('User.id', 'User.firstname')
					));
		$this->set(compact('users'));



		$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
		$notification = $this->Notification->find('first', $options);
		$this->set('notification',$notification);
		
		if ($this->request->is('post')) {

				$userId = !empty($this->request->data['Notification']['user_id']) ? $this->request->data['Notification']['user_id'] : null;
				
				if ($userId!=null){
				$title = $notification['Notification']['event_name'];
                $type = $notification['Notification']['type'];
                $details = $notification['Notification']['details'];
                $datetime = $notification['Notification']['datetime'];
                $venue = $notification['Notification']['venue'];
				
				
				$usersnotify = $this->User->find('first',array('fields'=>array('User.username,User.firstname'),'conditions'=>array('User.id'=>$userId)));
					
				$connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                if($connected){   
	                $this->Email = new CakeEmail('gmail');
	                $this->Email->template('notifysendto');
	                $this->Email->from(array('irwin93jesus@gmail.com' => 'Diet Code'));
	                $this->Email->to($usersnotify['User']['username']);
	                $this->Email->subject('Diet Code Notification');
	                $this->Email->emailFormat('both');
	                   
	                $this->Email->viewVars(array('title' => $title));
	                $this->Email->viewVars(array('type' => $type));
	                $this->Email->viewVars(array('details' => $details));
	                $this->Email->viewVars(array('datetime' => $datetime));
	                $this->Email->viewVars(array('venue' => $venue));
	                $this->Email->send();
					
					$this->Session->setFlash(__('The notification has been sent to '.$usersnotify['User']['firstname']));
					return $this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('You are not connected to the Internet'));
				}

				
				}else{
					$this->Session->setFlash(__('Please Select an Employee'));
				}
			}
		
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {

		App::uses('CakeEmail', 'Network/Email');

		if (!$this->Notification->exists($id)) {
			throw new NotFoundException(__('Invalid notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			if ($this->Notification->save($this->request->data)) {

				$title = $this->request->data['Notification']['event_name'];
                $type = $this->request->data['Notification']['type'];
                $details = $this->request->data['Notification']['details'];
                $datetime = $this->request->data['Notification']['datetime'];
                $venue = $this->request->data['Notification']['venue'];
				
				$this->loadModel('User');
				$usersnotify = $this->User->find('all');
											
				$emailids=array();
				
				foreach($usersnotify as $notify){
				array_push($emailids,$notify['User']['username']);
				}
				  
                $connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                if($connected){
	                $this->Email = new CakeEmail('gmail');
	                $this->Email->template('notifymeeteventsedit');
	                $this->Email->from(array('irwin93jesus@gmail.com' => 'Diet Code'));
	                $this->Email->bcc($emailids);
	                $this->Email->subject('Diet Code Notification Update');
	                $this->Email->emailFormat('both');
	                   
	                $this->Email->viewVars(array('title' => $title));
	                $this->Email->viewVars(array('type' => $type));
	                $this->Email->viewVars(array('details' => $details));
	                $this->Email->viewVars(array('datetime' => $datetime));
	                $this->Email->viewVars(array('venue' => $venue));
	                $this->Email->send();
					
					$this->Session->setFlash(__('The notification has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('You are not connected to the Internet.'));
				}
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notification.' . $this->Notification->primaryKey => $id));
			$this->request->data = $this->Notification->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {

		date_default_timezone_set('Asia/Kolkata');
		App::uses('CakeEmail', 'Network/Email');

		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}

		$user = $this->Notification->find('first',array( 
			'conditions' => array('Notification.id' => $id)
		));

				$title = $user['Notification']['event_name'];
                $type = $user['Notification']['type'];
                $datetime = $user['Notification']['datetime'];
                $eventdate = $datetime;
                $venue = $user['Notification']['venue'];
				
				$this->loadModel('User');
				$usersnotify = $this->User->find('all');
											
				$emailids=array();
				
				foreach($usersnotify as $notify){
				array_push($emailids,$notify['User']['username']);
				}
				  
                

		$this->request->allowMethod('post', 'delete');
		if ($this->Notification->delete()) {

			if( $eventdate > date("Y-m-d h:i:s", strtotime("now")) ){

				$connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                if($connected){
					$this->Email = new CakeEmail('gmail');
	                $this->Email->template('notifymeeteventsdelete');
	                $this->Email->from(array('irwin93jesus@gmail.com' => 'Diet Code'));
	                $this->Email->bcc($emailids);
	                $this->Email->subject('Diet Code Notification Cancellation');
	                $this->Email->emailFormat('both');
	                   
	                $this->Email->viewVars(array('title' => $title));
	                $this->Email->viewVars(array('type' => $type));
	                $this->Email->viewVars(array('datetime' => $datetime));
	                $this->Email->viewVars(array('venue' => $venue));
	                $this->Email->send();
	                $this->Session->setFlash(__('The notification has been deleted.'));
	            }else{
	            	$this->Session->setFlash(__('You are not connected to the Internet'));
	            }
            }else{
                $this->Session->setFlash(__('The notification has been deleted, No e-mails sent.'));
            }

			
		} else {
			$this->Session->setFlash(__('The notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
