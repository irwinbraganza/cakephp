<?php
App::uses('AppController', 'Controller');
/**
 * Holidays Controller
 *
 * @property Holiday $Holiday
 * @property PaginatorComponent $Paginator
 */
class HolidaysController extends AppController {

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
	public function index() {
		$this->Holiday->recursive = 0;
		$this->set('holidays', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Holiday->exists($id)) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		$options = array('conditions' => array('Holiday.' . $this->Holiday->primaryKey => $id));
		$this->set('holiday', $this->Holiday->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Holiday->create();
			$year='2000';
			$month=$this->request->data['Holiday']['month'];
			$day=$this->request->data['Holiday']['day'];
			$datestring = $year . '-' .$month['month'] . '-' . $day['day'];
			$this->request->data['Holiday']['date'] = $datestring;
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlash(__('The holiday has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holiday could not be saved. Please, try again.'));
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
		if (!$this->Holiday->exists($id)) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlash(__('The holiday has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The holiday could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Holiday.' . $this->Holiday->primaryKey => $id));
			$this->request->data = $this->Holiday->find('first', $options);
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
		$this->Holiday->id = $id;
		if (!$this->Holiday->exists()) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Holiday->delete()) {
			$this->Session->setFlash(__('The holiday has been deleted.'));
		} else {
			$this->Session->setFlash(__('The holiday could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
