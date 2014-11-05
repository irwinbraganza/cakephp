<?php
App::uses('AppController', 'Controller');
/**
 * Cupcakes Controller
 *
 * @property Cupcake $Cupcake
 * @property PaginatorComponent $Paginator
 */
class CupcakesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
       // var $name = 'Cupcake';
        
        
	public function index($userId = null) {
				
		if ($this->request->is('post')) {
			$userId = !empty($this->request->data['Cupcake']['user_id']) ? $this->request->data['Cupcake']['user_id'] : null;
		}


		if (!empty($userId)) {
			$this->paginate = array(
		        'User' => array(
		            'limit' => 20,
		            'contain' => 'Cupcake',
		            'conditions' => array('User.id' => $userId)
		        )
		    );
		} else {
			$this->paginate = array(
		        'User' => array(
		            'limit' => 20,
		            'contain' => 'Cupcake'
		        )
		    );
		}
		$users = $this->Cupcake->User->find('list', array(
			'fields' => array('User.id', 'User.firstname')
		));
	    $this->Paginator->settings = $this->paginate;
	    $userRecords = $this->Paginator->paginate('User');
		$this->set(compact('users', 'userRecords'));
		
		if (!empty($userId)) {
		$count = $this->Cupcake->find('count',array( 'conditions' => array('Cupcake.user_id' => $userId)));
		$this->set("count",$count);

		$cupcakependingdata = array('id'=> $userId,
            'cupcakespending' => $count
            );
        $this->Cupcake->User->save($cupcakependingdata);
    	}
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cupcake->exists($id)) {
			throw new NotFoundException(__('Invalid cupcake'));
		}
		$options = array('conditions' => array('Cupcake.' . $this->Cupcake->primaryKey => $id));
		$this->set('cupcake', $this->Cupcake->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		date_default_timezone_set('Asia/Kolkata');
		$users = $this->Cupcake->User->find('list', array(
			'fields' => array('User.id', 'User.firstname')
		));
	    $this->set(compact('users'));

		$userId = null;
		
		if ($this->request->is('post')) {
			$userId = !empty($this->request->data['Cupcake']['user_id']) ? $this->request->data['Cupcake']['user_id'] : null;
			if ($userId != null) {
				$this->Cupcake->create();
				if ($this->Cupcake->save($this->request->data)){
					$count = $this->Cupcake->find('count',array( 'conditions' => array('Cupcake.user_id' => $userId)));
					$this->set("count",$count);
					$cupcakependingdata = array('id'=> $userId,
			            'cupcakespending' => $count
			            );
			        $this->Cupcake->User->save($cupcakependingdata);
			    	$this->Session->setFlash(__('The cupcake has been saved.'));
			    	return $this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('The cupcake could not be saved. Please, try again.'));
				}
			}else{
				$this->Session->setFlash(__('Please Select an Employee.'));
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
		if (!$this->Cupcake->exists($id)) {
			throw new NotFoundException(__('Invalid cupcake'));
		}

		$use = $this->Cupcake->find('all',array( 
			'conditions' => array('Cupcake.id' => $id)
		));

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cupcake->save($this->request->data)) {
				$this->Session->setFlash(__('The cupcake has been saved.'));
				return $this->redirect(array('action' => 'index',$use[0]['Cupcake']['user_id']));
			} else {
				$this->Session->setFlash(__('The cupcake could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cupcake.' . $this->Cupcake->primaryKey => $id));
			$this->request->data = $this->Cupcake->find('first', $options);
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
		$this->Cupcake->id = $id;
		if (!$this->Cupcake->exists()) {
			throw new NotFoundException(__('Invalid cupcake'));
		}
		
		$use = $this->Cupcake->find('all',array( 
			'conditions' => array('Cupcake.id' => $id)
		));

		$userdata = $this->Cupcake->User->find('all',array( 'conditions' => array('User.id' => $use[0]['Cupcake']['user_id'])));

		$cupcakesdelete = $userdata[0]['User']['cupcakesbought'];
		
		$this->request->allowMethod('post', 'delete');

		if ($this->Cupcake->delete()) {
			
					if (!empty($use[0]['Cupcake']['user_id'])) {			
						$count = $this->Cupcake->find('count',array( 'conditions' => array('Cupcake.user_id' => $use[0]['Cupcake']['user_id'])));
						$this->set("count",$count);
						if($cupcakesdelete>0){
							$cupcakependingdata = array('id'=>  $use[0]['Cupcake']['user_id'],
					            'cupcakespending' => $count,
					            'cupcakesbought' => $cupcakesdelete - 1
					            );
					        $this->Cupcake->User->save($cupcakependingdata);
					        
				    	}else{
				    		$cupcakependingdata = array('id'=>  $use[0]['Cupcake']['user_id'],
					            'cupcakespending' => $count,
					            'cupcakesbought' => 0
					            );
					        $this->Cupcake->User->save($cupcakependingdata);
				    	}
					}
		 	$this->Session->setFlash(__('The cupcake has been deleted.'));
			return $this->redirect(array('action' => 'index',$use[0]['Cupcake']['user_id']));		
		} else {
			$this->Session->setFlash(__('The cupcake could not be deleted. Please, try again.'));
		}
		
		
		
	}
       
   

}
