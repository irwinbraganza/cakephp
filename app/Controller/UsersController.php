<?php
App::uses('AppController', 'Controller','CakeEmail', 'Network/Email');

class UsersController extends AppController {
    
    var $helpers=array('Html','Form','Session');

    public $components = array('Paginator','Email','Session','Security');

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc') 
    );
     
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Security->csrfUseOnce = true;
        $this->Security->blackHoleCallback = 'blackhole';
        $this->Auth->allow('login','add','forgetpwd','reset','admin','logout','edit_profile'); 
    }

    public function blackhole() {
        $this->Session->setFlash('Next time please click only once!!');
        return $this->redirect('https://' . env('SERVER_NAME') . $this->here);
    }



    function forgetpwd(){
         
        $this->layout = 'login';
        $this->User->recursive=-1;
        
        if(!empty($this->data)){
            if(empty($this->data['User']['username'])){
                $this->Session->setFlash('Please Provide Your Email Adress that You used to Register with Us');
            }else{
                $email=$this->data['User']['username'];
                $fu=$this->User->find('first',array('conditions'=>array('User.username'=>$email)));
                if($fu){
                    $key = Security::hash(String::uuid(),'sha512',true);
                    $hash=sha1($fu['User']['username'].rand(0,100));
                    $url = Router::url( array('controller'=>'users','action'=>'reset'), true ).'/'.$key.'#'.$hash;
                    $ms=$url;
                    $ms=wordwrap($ms,1000);
                    //debug($url);
                    $fu['User']['tokenhash']=$key;
                    $this->User->id=$fu['User']['id'];
                    if($this->User->saveField('tokenhash',$fu['User']['tokenhash'])){

                        $connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                        if($connected){
                            //============Email================//
                            /* SMTP Options */
                            $this->Email->smtpOptions = array(
                            'port'=>'465',
                            'timeout'=>'30',
                            'host' => 'ssl://smtp.gmail.com',
                            'username'=>'irwin93jesus@gmail.com',
                            'password'=>'matterdont',
                            );
                            $this->Email->template = 'resetpw';
                            $this->Email->from    = 'Diet Code <irwin93jesus@gmail.com>';
                            $this->Email->to      = $fu['User']['firstname'].'<'.$fu['User']['username'].'>';
                            $this->Email->subject = 'Reset Your Diet Code Password';
                            $this->Email->sendAs = 'both';

                            $this->Email->delivery = 'smtp';
                            $this->set('ms', $ms);
                            $this->Email->send();
                            $this->set('smtp_errors', $this->Email->smtpError);
                            $this->Session->setFlash(__('Check Your Email To Reset your password', true));
                            //============EndEmail=============//
                        }else{
                            $this->Session->setFlash(__('You are not connected to the Internet', true));
                        }
                    }else{
                        $this->Session->setFlash("Error Generating Reset link");
                    }
                }else{
                    $this->Session->setFlash('Email does Not Exist');
                }
            }
        }
    }
     
    function reset($token=null){
        $this->layout = 'login';
        $this->User->recursive=-1;
        if(!empty($token)){
            $u=$this->User->findBytokenhash($token);
            if($u){
                $this->User->id=$u['User']['id'];
                if ($this->request->is('post')) {
                    if(!empty($this->request->data)){
                        $this->User->data=$this->request->data;
                        $this->User->data['User']['username']=$u['User']['username'];
                        $new_hash=sha1($u['User']['username'].rand(0,100));//created token
                        $this->User->data['User']['tokenhash']=$new_hash;
                       
                        if($this->User->save($this->User->data))
                        {
                            $this->Session->setFlash('Password Has been Updated');
                            $this->redirect(array('controller'=>'users','action'=>'login'));
                        }
                    }
                }
            }else{
                $this->Session->setFlash('Token Corrupted,Please retry. The reset link work only for once.');
            }
        }else{
            $this->redirect(array('action' => 'login'));
        }
    }
 
    public function login(){
         $this->layout = 'login';      
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome '. $this->Auth->user('firstname')));
                if($this->Session->check('Auth.User')){
                    $this->redirect( array('action' => 'admin'));      
                }
                $this->redirect($this->Auth->redirectUrl());
            }else{
                $this->Session->setFlash(__('Invalid username or password'));
            }
        } 
    }
 
    public function logout(){
        $this->redirect($this->Auth->logout());
    }
    
    public function admin($id=null){
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'login';
        $this->loadModel('User');
        $uid = $this->Auth->user('id'); 
        $this->set('uid',$uid);
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $uid));
        $user = $this->User->find('first', $options);
        $this->set('user',$user);
        if($uid!=null){  
            if ($this->request->is('post')){
                header('Content-type: application/json');
                $countbought = $this->request->data['User']['count'];
                if(!empty($countbought)){
                    $cupcakeboughtdata = array('id'=> $uid,
                        'cupcakesbought' => $user['User']['cupcakesbought'] + $countbought,
                        'monthlycupcakesbought' => $user['User']['monthlycupcakesbought'] + $countbought
                    );
                    $this->User->save($cupcakeboughtdata);
                    $this->redirect(array('action' => 'admin'));
                }
            }
        }else{
            $this->redirect(array('action' => 'login'));
        }

        $tdydate = date("m-d", strtotime("now"));
        $usersRecord = $this->User->find('all');

        $bdayarray=array();
        foreach($usersRecord as $singleuser){
            $userbday = date("m-d", strtotime($singleuser['User']['dob']));
            if($tdydate==$userbday){
                array_push($bdayarray,$singleuser['User']['firstname']);
            }
        }
        $this->set('bdayarray',$bdayarray);

        $appreciatearray=array();
        foreach($usersRecord as $dailyuser){
            $monthlycount = $dailyuser['User']['latebuff'];
            if($monthlycount==0){
                array_push($appreciatearray,$dailyuser['User']['firstname']);
            }
        }
        $this->set('appreciatearray',$appreciatearray);

        $appreciatearraycount = count($appreciatearray);
        $this->set('appreciatearraycount',$appreciatearraycount);

        $this->loadModel('CheckinCheckout');
        $checkinsRecord = $this->CheckinCheckout->find('all');
        $eagle='23:59';
        $owl='00:00';
        foreach($checkinsRecord as $singleusercheckin){
            $usercheckin = date("H:i", strtotime($singleusercheckin['CheckinCheckout']['date_time']));
            $checkinstatus = $singleusercheckin['CheckinCheckout']['status'];
            if(($usercheckin<$eagle) && ($checkinstatus=="CHECK-IN")){
                $eagle = $usercheckin;
                $eagleid = $singleusercheckin['CheckinCheckout']['user_id'];
                $eagledatetime = date("d-M-Y g:i A", strtotime($singleusercheckin['CheckinCheckout']['date_time']));
            }

            if(($usercheckin>$owl) && ($checkinstatus=="CHECK-OUT")){
                $owl = $usercheckin;
                $owlid = $singleusercheckin['CheckinCheckout']['user_id'];
                $owldatetime = date("d-M-Y g:i A", strtotime($singleusercheckin['CheckinCheckout']['date_time']));
            }
        }
        if(!empty($eagleid)){
           $eaglename = $this->User->find('first',array('conditions'=>array('User.id'=>$eagleid),'fields'=>array('User.firstname')));
           $this->set('eaglename',$eaglename);
           $this->set('eagledatetime',$eagledatetime);
        }
        if(!empty($owlid)){
            $owlname = $this->User->find('first',array('conditions'=>array('User.id'=>$owlid),'fields'=>array('User.firstname')));
            $this->set('owlname',$owlname);
            $this->set('owldatetime',$owldatetime);
        }

        $this->loadModel('Cupcake');
        $cupcakeRecord = $this->Cupcake->find('all');
        $todaydate = date("Y-m-d", strtotime("now"));
        $latearray = array();
        foreach($cupcakeRecord as $singleusercupcake){
            $usercupcake = date("Y-m-d", strtotime($singleusercupcake['Cupcake']['datetime']));
           
            if(($usercupcake==$todaydate)){
                $cupcakeid = $singleusercupcake['Cupcake']['user_id'];
                $cupcakename = $this->User->find('first',array('conditions'=>array('User.id'=>$cupcakeid),'fields'=>array('User.firstname')));
                array_push($latearray,$cupcakename['User']['firstname']);
            }
        }
        $latearraycount = count($latearray);
        $this->set('latearraycount',$latearraycount);
        $this->set('latearray',$latearray);

        $this->loadModel('Notification');
        $NotificationRecord = $this->Notification->find('all');
        $todaydate = date("Y-m-d", strtotime("now"));
        $singlenotificationarray = array();
        $notificationarray = array();
        foreach($NotificationRecord as $singlenotification){
            $notificationdate = date("Y-m-d", strtotime($singlenotification['Notification']['datetime']));
           
            if(($notificationdate==$todaydate)){
                $id = $singlenotification['Notification']['id'];
                $title = $singlenotification['Notification']['event_name'];
                $type = $singlenotification['Notification']['type'];
                $details = $singlenotification['Notification']['details'];
                $datetime = $singlenotification['Notification']['datetime'];
                $venue = $singlenotification['Notification']['venue'];
                
                array_push($singlenotificationarray,$id,$title,$type,$details,$datetime,$venue);
                array_push($notificationarray,$singlenotificationarray);
                $singlenotificationarray = array();
            }
        }
        $notificationarraycount = count($notificationarray);
        $this->set('notificationarraycount',$notificationarraycount);
        $this->set('notificationarray',$notificationarray);
    }

    public function index() {
        
        $this->User->recursive=1;

        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
         
        $this->loadModel('State');
        $states = $this->State->find('all');

        $this->loadModel('City');
        $cities = $this->City->find('all');
    }

    public function edit_profile($id = null){
   
        $this->layout = 'login';
        if (!$this->User->exists($id)){
            throw new NotFoundException(__('Invalid user'));
        }

        $this->loadModel('Country');
        $countries = $this->Country->find('list', array(
            'fields' => array('Country.id', 'Country.name')
        ));
        $this->set(compact('countries'));

        $this->loadModel('State');
        $states = $this->State->find('list', array(
            'fields' => array('State.id', 'State.name')
        ));
        $this->set(compact('states'));

        $this->loadModel('City');
        $cities = $this->City->find('list', array(
            'fields' => array('City.id', 'City.name')
        ));
        $this->set(compact('cities'));

        if ($this->request->is(array('post', 'put'))){
            $email = $this->User->find('first',array('fields'=>array('User.username,User.upload,User.state_id,User.city_id,User.country_id'),'conditions'=>array('User.id'=>$id)));
            if (is_uploaded_file($this->request->data['User']['upload']['tmp_name'])){
                    
                $random = substr(number_format(time() * mt_rand(),0,'',''),0,5); 
                $imagename = $email['User']['username'].'image'.$random.$this->request->data['User']['upload']['name'];
                
                move_uploaded_file(
                    $this->request->data['User']['upload']['tmp_name'],
                    'img/uploads/users/'.$imagename
                );
                $this->request->data['User']['upload'] = $imagename;// store the filename in the array to be saved to the db
            }else{
                $this->request->data['User']['upload'] = $email['User']['upload'];
            }

            if(!isset($this->request->data['User']['country_id'])||$this->request->data['User']['country_id']==null){
                $this->request->data['User']['country_id'] = $email['User']['country_id'];
            }
            if(!isset($this->request->data['User']['state_id'])||$this->request->data['User']['state_id']==null){
                $this->request->data['User']['state_id'] = $email['User']['state_id'];
            }
            if(!isset($this->request->data['User']['city_id'])||$this->request->data['User']['city_id']==null){
                $this->request->data['User']['city_id'] = $email['User']['city_id'];
            }

            if ($this->User->save($this->request->data)){
                $this->Session->setFlash(__('Your personal details have been saved'));
                return $this->redirect(array( 'action' => 'admin'));
            }else{
                $this->Session->setFlash(__('Your personal details could not be saved. Please, try again.'));
            }
        }else{
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }
 
 
    public function add() {
        $this->layout = 'login';
        date_default_timezone_set('Asia/Kolkata');
        if ($this->request->is('post')){
                         
            $random = substr(number_format(time() * mt_rand(),0,'',''),0,4); 
               
            $this->request->data['User']['CheckinCheckoutPin'] = $random;
            $ms = $this->request->data['User']['CheckinCheckoutPin'];   
            $this->User->create();
            if ($this->User->save($this->request->data)){

                $connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                if($connected){
                    $this->Email->smtpOptions = array(
                    'port'=>'465',
                    'timeout'=>'30',
                    'host' => 'ssl://smtp.gmail.com',
                    'username'=>'irwin93jesus@gmail.com',
                    'password'=>'matterdont',
                    );
                    $this->Email->template = 'sendpin';
                    $this->Email->from    = 'Diet Code <irwin93jesus@gmail.com>';
                    $this->Email->to      = $this->request->data['User']['username'].'<'.$this->request->data['User']['username'].'>';
                    $this->Email->subject = 'Your Diet Code Checkin-Checkout Pin';
                    $this->Email->sendAs = 'both';
                    $this->Email->delivery = 'smtp';
                    $this->set('ms', $ms);
                    $this->Email->send();
                    $this->set('smtp_errors', $this->Email->smtpError);
                    $this->Session->setFlash(__('Your account has been created, Please check your email for your Checkin-Chekout pin', true));
                    $this->redirect(array('action' => 'login'));
                }else{
                    $this->Session->setFlash(__('You are not connected to the Internet'));
                }

            }else{
                $this->Session->setFlash(__('The user could not be created. Please, try again.'));
            }   
        }
    }

	public function view($id = null) {
        $this->User->recursive=1;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

    function loads($countryId=null){
         
       if ($this->request->is('ajax')){
            header('Content-type: application/json');
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $this->loadModel('State');
            $states = $this->State->find('list', array(
                'fields' => array('State.id', 'State.name'),
                'conditions'=>array('State.country_id'=>$countryId)
            ));
            $this->set(compact ('states'));
            
            if (!empty($states)){
                echo '<option value="">' . __('Select State') . '</option>';
                foreach ($states as $k => $v) {
                    echo '<option value="' . $k . '">' . h($v) . '</option>';
                }
            }else{
                echo '<option value="0">' . __('No Options Available') . '</option>';
            }
        }
    }

    function loadc($stateId=null){
         
       if ($this->request->is('ajax')){
            header('Content-type: application/json');
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $this->loadModel('City');
            $cities = $this->City->find('list', array(
                'fields' => array('City.id', 'City.name'),
                'conditions'=>array('City.state_id'=>$stateId)
            ));
            
            $this->set(compact('cities'));

            if (!empty($cities)) {
                echo '<option value="">' . __('Select City') . '</option>';
                foreach ($cities as $k => $v) {
                    echo '<option value="' . $k . '">' . h($v) . '</option>';
                }
            }else{
                echo '<option value="0">' . __('No Options Available') . '</option>';
            }
        }
    }


  
	public function edit($id = null){
		if (!$this->User->exists($id)){
			throw new NotFoundException(__('Invalid user'));
		}

        date_default_timezone_set('Asia/Kolkata');
        
        $this->loadModel('Country');
        $countries = $this->Country->find('list', array(
            'fields' => array('Country.id', 'Country.name')
        ));
        $this->set(compact('countries'));

        $this->loadModel('State');
        $states = $this->State->find('list', array(
            'fields' => array('State.id', 'State.name')
        ));
        $this->set(compact('states'));

        $this->loadModel('City');
        $cities = $this->City->find('list', array(
            'fields' => array('City.id', 'City.name')
        ));
        $this->set(compact('cities'));

        if ($this->request->is(array('post', 'put'))) {

            $start = $this->request->data['User']['doj'];
            $day = $start['day'];
            $month = $start['month'];
         
            $today = date("Y-".$month."-".$day, strtotime("now"));

            $sixmonth = date("m", strtotime($today.' + 6 months'));
            $thisyear = date("Y", strtotime($today));
            $sixyear = date("Y", strtotime($today.' + 6 months'));
            $oneyear = date("Y", strtotime($today.' + 12 months'));
            
            $this->request->data['User']['leavestart'] = $thisyear . '-' .$month . '-' . $day;
            $this->request->data['User']['leavemid'] = $sixyear . '-' .$sixmonth . '-' . $day;
            $this->request->data['User']['leaveend'] = $oneyear . '-' .$month . '-' . $day;

            $email = $this->User->find('first',array(
                'fields'=>array('User.username,User.upload,User.state_id,User.city_id,User.country_id'),
                'conditions'=>array('User.id'=>$id)
                ));
			
            if (is_uploaded_file($this->request->data['User']['upload']['tmp_name'])){
                $random = substr(number_format(time() * mt_rand(),0,'',''),0,5); 

                $imagename = $email['User']['username'].'image'.$random.$this->request->data['User']['upload']['name'];

                move_uploaded_file(
                    $this->request->data['User']['upload']['tmp_name'],
                    'img/uploads/users/'.$imagename
                );// store the filename in the array to be saved to the db
                
                $this->request->data['User']['upload'] = $imagename;
            }else{
                $this->request->data['User']['upload'] = $email['User']['upload'];
            }


            if (!isset($this->request->data['User']['country_id'])||$this->request->data['User']['country_id']==null){
                $this->request->data['User']['country_id'] = $email['User']['country_id'];
            }
            if (!isset($this->request->data['User']['state_id'])||$this->request->data['User']['state_id']==null){
                $this->request->data['User']['state_id'] = $email['User']['state_id'];
            }
            if (!isset($this->request->data['User']['city_id'])||$this->request->data['User']['city_id']==null){
                $this->request->data['User']['city_id'] = $email['User']['city_id'];
            }

            if ($this->User->save($this->request->data)){
                $this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}else{
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

    public function delete($id=null) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete($id)){
            $this->Session->setFlash(
                __('The user with id: %s has been deleted.', h($id))
            );
            return $this->redirect(array('action' => 'index'));
        }
    }
}
?>
