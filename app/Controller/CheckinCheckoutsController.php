<?php
App::uses('AppController', 'Controller','CakeEmail', 'Network/Email');
/**
 * CheckinCheckouts Controller
 *
 * @property CheckinCheckout $CheckinCheckout
 * @property PaginatorComponent $Paginator
 */
class CheckinCheckoutsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Security','Email');
 

    public function beforeFilter() {
    	parent::beforeFilter();
        
        $this->Auth->allow('add','forgetpin','changepin'); 
        if($this->action != 'edit')
        {
        	$this->Security->csrfUseOnce = true;
      		$this->Security->blackHoleCallback = 'blackhole';
      	}else{
      		$this->Security->csrfUseOnce = true;
      		$this->Security->blackHoleCallback = 'toindex';
      	}
    } 

    public function blackhole($type) {
        $this->redirect(array('action' => 'add'));
    }

    public function toindex($type) {
        $this->redirect(array('action' => 'index'));
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		
		$this->CheckinCheckout->recursive = 0;
		
		$this->Paginator->settings = array(
        'CheckinCheckout' => array(
            'limit' => 100,
            'order' => array('date_time' => 'desc')
            
        )
    	);
		$this->set('checkinCheckouts', $this->Paginator->paginate());
	}

	function changepin(){
		$this->layout = 'login';
		if ($this->request->is(array('post', 'put'))) {
			$oldpin=$this->request->data['CheckinCheckout']['oldpin'];
			$newpin=$this->request->data['CheckinCheckout']['newpin'];
			$reenterpin=$this->request->data['CheckinCheckout']['reenternewpin'];

			$check=$this->CheckinCheckout->User->find('first',array('conditions'=>array('User.CheckinCheckoutPin'=>$oldpin)));
			if($check){
				if($newpin==$reenterpin){
				$checkall=$this->CheckinCheckout->User->find('first',array('conditions'=>array('User.CheckinCheckoutPin'=>$newpin)));
					if($checkall){
						$this->Session->setFlash('Pin already taken');
					}else{
						$userId=$check['User']['id'];
						$name=$check['User']['firstname'];
						$changepin = array(
					            'id' => $userId,
					            'CheckinCheckoutPin'=> $newpin
					            );
					    $this->CheckinCheckout->User->save($changepin);
					    $this->Session->setFlash('Hey'.$name.'!! Your new pin has been saved');
					    return $this->redirect(array('action' => 'add'));
					}
				}else{
					$this->Session->setFlash('New Pins do not match');
				}
			}else{
				 $this->Session->setFlash('Invalid Old pin');
			}
		}

	}

	function forgetpin(){
        $this->layout = 'login';
       if(!empty($this->data))
        {
            if(empty($this->data['CheckinCheckout']['username']))
            {
                $this->Session->setFlash('Please Provide Your Email Adress that You used to Register with Us');
            }
            else
            {
                $email=$this->data['CheckinCheckout']['username'];
                $fu=$this->CheckinCheckout->User->find('first',array('conditions'=>array('User.username'=>$email)));
                if($fu)
                {
                    	$connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                		if($connected){
                        	$ms=$fu['User']['CheckinCheckoutPin'];
                        	//============Email================//
                            /* SMTP Options */
                            $this->Email->smtpOptions = array(
			                'port'=>'465',
			                'timeout'=>'30',
			                'host' => 'ssl://smtp.gmail.com',
			                'username'=>'irwin93jesus@gmail.com',
			                'password'=>'matterdont',
			                );
			                $this->Email->template = 'sendpin';
			                $this->Email->from    = 'Diet Code <irwin93jesus@gmail.com>';
			                $this->Email->to      = $this->request->data['CheckinCheckout']['username'].'<'.$this->request->data['CheckinCheckout']['username'].'>';
			                $this->Email->subject = 'Your Diet Code Checkin-Checkout Pin';
			                $this->Email->sendAs = 'both';
			                $this->Email->delivery = 'smtp';
			                $this->set('ms', $ms);
			                $this->Email->send();
			                $this->set('smtp_errors', $this->Email->smtpError);
			                $this->Session->setFlash(__('Please check your email for your Checkin-Chekout pin', true));
			                $this->redirect(array('action' => 'add'));
                            //============EndEmail=============//
			            }else{
			            	$this->Session->setFlash(__('You are not connected to the Internet'));
			            }

                    }
                    else
                    {
                        $this->Session->setFlash('Email does Not Exist');
                    }
            }
        
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
		if (!$this->CheckinCheckout->exists($id)) {
			throw new NotFoundException(__('Invalid checkin checkout'));
		}
		$options = array('conditions' => array('CheckinCheckout.' . $this->CheckinCheckout->primaryKey => $id));
		$this->set('checkinCheckout', $this->CheckinCheckout->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->layout = 'login';
		date_default_timezone_set('Asia/Kolkata');



		if ($this->request->is('post')) {
		$pin = null;
		$pin = $this->request->data['CheckinCheckout']['pin'];

		$userRecord = $this->CheckinCheckout->User->find('all');
		$status=0;
		foreach($userRecord as $user){
			if($user['User']['CheckinCheckoutPin']==$pin){
				
			$name = $user['User']['firstname'];
			$userId = $user['User']['id'];
			$prevcupcakes = $user['User']['cupcakespending'];
			$monthlylate = $user['User']['monthly_late'];

			$this->request->data['CheckinCheckout']['user_id'] = $user['User']['id'];
			$this->request->data['CheckinCheckout']['status']="CHECK-IN";
			$status=1;
			$this->request->data['CheckinCheckout']['date_time']=date ("Y-m-d H:i:s", strtotime("now"));

			$grace = 30+$user['User']['gracetime'];
			$starttime = date ("Y-m-d 09:".$grace.":s", strtotime("now"));
			$datetime1 = new DateTime($starttime);
			$datetime2 = new DateTime($this->request->data['CheckinCheckout']['date_time']);
			$interval = $datetime1->diff($datetime2);
			$hours = $interval->format('%h hours');
			$mins = $interval->format('%i minutes');
						

			$CheckinCheckoutRecord = $this->CheckinCheckout->find('all',array('conditions' => array('CheckinCheckout.user_id' => $userId)));
			foreach($CheckinCheckoutRecord as $check){
			
			if((date("Y-m-d",strtotime($check['CheckinCheckout']['date_time']))==
				date("Y-m-d",strtotime($this->request->data['CheckinCheckout']['date_time'])))
				&&($check['CheckinCheckout']['status']=="CHECK-IN"))
			{
				$this->request->data['CheckinCheckout']['status']="CHECK-OUT";
				$status=1;
				
			}else{
				if((date("Y-m-d",strtotime($check['CheckinCheckout']['date_time']))==
					date("Y-m-d",strtotime($this->request->data['CheckinCheckout']['date_time'])))
					&&$check['CheckinCheckout']['status']=="CHECK-OUT"){
					$status=3;
				}
				
			}

			}
			}
		}

		if($status==1){

					if($this->request->data['CheckinCheckout']['status']=="CHECK-IN"){
						
					if( date ("Y-m-d H:i", strtotime($this->request->data['CheckinCheckout']['date_time'])) >
						date ("Y-m-d H:i", strtotime($starttime)) ){
						$this->Session->setFlash(__('Hi '.$name.'!! You are late by '.$hours.' and '.$mins));
						$updateuser = array('id'=> $userId,
			            'cupcakespending' => $prevcupcakes+1,
			            'monthly_late' => $monthlylate+1
			            );
			            $this->CheckinCheckout->User->save($updateuser);

			            $this->loadModel('Cupcake');
						$generatecupcakes = array(
			            'user_id' => $userId,
			            'datetime'=> $this->request->data['CheckinCheckout']['date_time']
			            );
			            $this->Cupcake->save($generatecupcakes);


					}else{
						$this->Session->setFlash(__('Hi '.$name.'!! You are early today !!'));
					}	
					


					}else{
						$this->Session->setFlash(__('Goodbye '.$name.'!!'));
					}

					$this->CheckinCheckout->create();

					if ($this->CheckinCheckout->save($this->request->data)) {
						
						return $this->redirect(array('action' => 'add'));
					} else {
						$this->Session->setFlash(__('Please try again.'));
					}
					}else {
						$this->Session->setFlash(__('The pin is invalid Please, try again.'));
					}

		
		if($status==3){
			$this->Session->setFlash(__('Hi '.$name.' You Have already checked-out!!'));
			return $this->redirect(array('action' => 'add'));
		}
			}
		}

		public function add_new() {
			date_default_timezone_set('Asia/Kolkata');
			$users = $this->CheckinCheckout->User->find('list', array(
						'fields' => array('User.id', 'User.firstname')
					));
			$this->set(compact('users'));
			if ($this->request->is('post')) {
				$userId = !empty($this->request->data['CheckinCheckout']['user_id']) ? $this->request->data['CheckinCheckout']['user_id'] : null;
				
				if ($userId!=null){
					$newusercheckin = $this->CheckinCheckout->User->find('first',array('conditions' => array('User.id' => $userId)));
					$this->request->data['CheckinCheckout']['pin'] = $newusercheckin['User']['CheckinCheckoutPin'];
					$this->CheckinCheckout->create();
					if ($this->CheckinCheckout->save($this->request->data)){
						$this->Session->setFlash(__('The Checkin/Checkout has been saved.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The Checkin/Checkout could not be saved.'));
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
		if (!$this->CheckinCheckout->exists($id)) {
			throw new NotFoundException(__('Invalid checkin checkout'));
		}

		$editcheckin = array('conditions' => array('CheckinCheckout.' . $this->CheckinCheckout->primaryKey => $id));
		$checkin = $this->CheckinCheckout->find('first', $editcheckin);

      


		if ($this->request->is(array('post', 'put'))) {

		$time = $this->request->data['CheckinCheckout']['date_time'];
        $hour = $time['hour'];
        $min = $time['min'];
        $year = date("Y", strtotime($checkin['CheckinCheckout']['date_time']));
        $month = date("m", strtotime($checkin['CheckinCheckout']['date_time']));
        $day = date("d", strtotime($checkin['CheckinCheckout']['date_time']));
              
        $this->request->data['CheckinCheckout']['date_time'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';

		
			if ($this->CheckinCheckout->save($this->request->data)) {
				$this->Session->setFlash(__('The checkin checkout has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The checkin checkout could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CheckinCheckout.' . $this->CheckinCheckout->primaryKey => $id));
			$this->request->data = $this->CheckinCheckout->find('first', $options);
			
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
		$this->CheckinCheckout->id = $id;
		if (!$this->CheckinCheckout->exists()) {
			throw new NotFoundException(__('Invalid checkin checkout'));
		}


		$use = $this->CheckinCheckout->find('first',array( 
			'conditions' => array('CheckinCheckout.id' => $id)
		));

		$checkinid = $use['CheckinCheckout']['user_id'];
		$checkindate = date("Y-m-d", strtotime($use['CheckinCheckout']['date_time']));
		$type = $use['CheckinCheckout']['status'];
		
		$usercheck = $this->CheckinCheckout->find('all',array( 
			'conditions' => array('CheckinCheckout.user_id' => $checkinid)
		));
		$state=0;
		foreach($usercheck as $check){

			$userdate = date("Y-m-d", strtotime($check['CheckinCheckout']['date_time']));
			if($check['CheckinCheckout']['user_id']==$checkinid && $check['CheckinCheckout']['status']=="CHECK-OUT" && $userdate==$checkindate){
				$state=1;
			}else{
				$state=2;
			}
		}

		if($type=="CHECK-OUT"){
			$state=2;
		}

		if($state==2){
			$this->request->allowMethod('post', 'delete');
			if($this->CheckinCheckout->delete()) {
				$this->Session->setFlash(__('The checkin checkout has been deleted.'));
			} else {
				$this->Session->setFlash(__('The checkin checkout could not be deleted. Please, try again.'));
			}
		}else{
			


			$this->Session->setFlash(__('Please delete the corresponding checkout first!!!'));
		}

		
		
		return $this->redirect(array('action' => 'index'));
	}
}
