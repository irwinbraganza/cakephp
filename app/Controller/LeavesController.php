<?php
App::uses('AppController', 'Controller');
/**
 * Leaves Controller
 *
 * @property Leave $Leave
 * @property PaginatorComponent $Paginator
 */
App::import('Sanitize');
class LeavesController extends AppController {

/**
 * Components
 *
 * @var array
 */
//var $helpers = array('Calendar.Calendar'); 

	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {

        date_default_timezone_set('Asia/Kolkata');
        $todays_date = date("Y-m-d ", strtotime("now"));

		$userId = null;
		
		if ($this->request->is('post')) {
			$userId = !empty($this->request->data['Leave']['user_id']) ? $this->request->data['Leave']['user_id'] : null;
			$this->Session->write('feedId', $userId);
            $this->Session->write('addId', $userId);
            $this->Session->write('saveId', $userId);
            $this->Session->write('deleteId', $userId);
            $this->Session->write('loaddataId', $userId);
            
		}

        $this->set("userId",$userId);
        
		if (!empty($userId)) {
			$this->paginate = array(
		        'User' => array(
		            'limit' => 20,
		            'contain' => 'Leave',
		            'conditions' => array('User.id' => $userId)
		        )
		    );
		} else {
			$this->paginate = array(
		        'User' => array(
		            'limit' => 20,
		            'contain' => 'Leave'
		        )
		    );
		}
		$users = $this->Leave->User->find('list', array(
			'fields' => array('User.id', 'User.firstname')
		));
	    $this->Paginator->settings = $this->paginate;
	    $userRecords = $this->Paginator->paginate('User');
		$this->set(compact('users', 'userRecords'));

    
        if (!empty($userId)) {
            $user = $this->Leave->User->find('all',array('conditions'=>array('User.id'=>$userId)));
        
            $start = date("Y-m-d", strtotime($user['0']['User']['leavestart']));
            $mid = date("Y-m-d", strtotime($user['0']['User']['leavemid']));
            $end = date("Y-m-d", strtotime($user['0']['User']['leaveend']));

            $leaves = $this->Leave->find('all',array('conditions'=>array('Leave.user_id'=>$userId)));
            $withinsix=0;
            $aftersix=0;

            foreach($leaves as $leave){

                $sdate = date("Y-m-d", strtotime($leave['Leave']['start']));
                $edate = date("Y-m-d", strtotime($leave['Leave']['end']));

               if(strtotime($start) <= strtotime($sdate) && strtotime($edate) < strtotime($mid)){
                    $w =$leave['Leave']['totaldays'];
                    $withinsix = $withinsix +$w;
                }

                if(strtotime($sdate) < strtotime($start) && strtotime($edate) >= strtotime($start) ){
                     $starting= date('Y-m-d', strtotime($start));
                    $ending= date('Y-m-d', strtotime($edate));
                    $s = new DateTime($starting);
                    $e = new DateTime($ending);
                    $days = $s->diff($e)->days;
                    $totaldays =  $days+1;

                    $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                    while (strtotime($starting) <= strtotime($ending)) {
                
                    foreach($holidays as $holiday){
                    if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                        $totaldays=$totaldays-1;
                    }
                    }
                    
                     //echo "$s\n";
                    $day=date ('l', strtotime($starting));
                    if($day=="Sunday"||$day=="Saturday"){
                         $totaldays=$totaldays-1;
                         //echo $day;
                    }

                    $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                    $day =date ('l', strtotime($starting));
                }

                $withinsix = $withinsix +$totaldays;
                }

                if(strtotime($sdate) < strtotime($mid) && strtotime($edate) >= strtotime($mid) ){
                     $starting= date('Y-m-d', strtotime($sdate));
                    $ending= date('Y-m-d', strtotime($mid));
                    $s = new DateTime($starting);
                    $e = new DateTime($ending);
                    $days = $s->diff($e)->days;
                    $totaldays =  $days;

                    $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                    while (strtotime($starting) <= strtotime($ending)) {
                
                    foreach($holidays as $holiday){
                    if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                        $totaldays=$totaldays-1;
                    }
                    }
                    
                     //echo "$s\n";
                    $day=date ('l', strtotime($starting));
                    if($day=="Sunday"||$day=="Saturday"){
                         $totaldays=$totaldays-1;
                         //echo $day;
                    }

                    $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                    $day =date ('l', strtotime($starting));
                }

                $withinsix = $withinsix +$totaldays;
                }

                


                if(strtotime($mid) <= strtotime($sdate) && strtotime($edate) < strtotime($end)){
                    $w =$leave['Leave']['totaldays'];
                    $aftersix = $aftersix + $w;
                }

                if(strtotime($sdate) < strtotime($mid) && strtotime($edate) >= strtotime($mid) ){
                    $starting= date('Y-m-d', strtotime($mid));
                    $ending= date('Y-m-d', strtotime($edate));
                    $s = new DateTime($starting);
                    $e = new DateTime($ending);
                    $days = $s->diff($e)->days;
                    $totaldays =  $days+1;

                    $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                    while (strtotime($starting) <= strtotime($ending)) {
                
                    foreach($holidays as $holiday){
                    if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                        $totaldays=$totaldays-1;
                    }
                    }
                    
                     //echo "$s\n";
                    $day=date ('l', strtotime($starting));
                    if($day=="Sunday"||$day=="Saturday"){
                         $totaldays=$totaldays-1;
                         //echo $day;
                    }

                    $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                    $day =date ('l', strtotime($starting));
                }

                $aftersix = $aftersix +$totaldays;
                }

                if(strtotime($sdate) < strtotime($end) && strtotime($edate) > strtotime($end) ){
                     $starting= date('Y-m-d', strtotime($sdate));
                    $ending= date('Y-m-d', strtotime($end));
                    $s = new DateTime($starting);
                    $e = new DateTime($ending);
                    $days = $s->diff($e)->days;
                    $totaldays =  $days;

                    $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                    while (strtotime($starting) <= strtotime($ending)) {
                
                    foreach($holidays as $holiday){
                    if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                        $totaldays=$totaldays-1;
                    }
                    }
                    
                     //echo "$s\n";
                    $day=date ('l', strtotime($starting));
                    if($day=="Sunday"||$day=="Saturday"){
                         $totaldays=$totaldays-1;
                         //echo $day;
                    }

                    $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                    $day =date ('l', strtotime($starting));
                }

                $aftersix = $aftersix +$totaldays;
                }


            }
            
            $intialtaken = $withinsix + $aftersix;
            $this->set("intialtaken",$intialtaken);
            

            $total = $user['0']['User']['leavesentitled'];
            $this->set("total",$total);

            $initialbalance = 22;
      
            $initialsubtaken = $user['0']['User']['leavessubtaken'];

            $buffer = $user['0']['User']['leavesbuffer'];

            $buff = $user['0']['User']['leavesbuff'];
          

            if($intialtaken <= $total){

                $paid = 0;
                    if($buff>0 && $buffer>0){
                        $cal = $buffer - $withinsix;
                        if($cal<0){
                                                                                  
                            $subtaken = $buffer;
                            $savebuffer = 0;

                            $taken = $intialtaken-$subtaken;
                            $balance = $initialbalance - $taken;

                        }else{
                            
                            $subtaken = $withinsix;
                            $savebuffer = $cal;

                            $taken = $intialtaken-$subtaken;
                            $balance = $initialbalance - $taken;
                        }
                    }else{

                        $savebuffer = 0;
                        $subtaken = $initialsubtaken;
                        $taken = $intialtaken-$initialsubtaken;
                        $balance = $initialbalance - $taken;
                    
                    }
               
                
            }else{

                $balance = 0;
                $paid = $intialtaken-$total;
                $savebuffer = 0;
                $subtaken = $initialsubtaken;
                
            }

            $this->set("savebuffer",$savebuffer);
            $this->set("balance",$balance);
            $this->set("paid",$paid);


            $leavedata = array('id'=> $userId,
            'leavestaken' => $intialtaken,
            'leavesremaining'=> $balance,
            'leavessubtaken' => $subtaken,
            'leavesbuff' =>  $savebuffer,
            'leavespay'=> $paid
            );
            $this->Leave->User->save($leavedata);
        }      
    }
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
/**
 * add method
 *
 * @return void
 */
	 function add($allday=null, $day=null, $month=null, $year=null, $hour=null, $min=null) {                            
        //Set default duration: 1hr and format to a leading zero.
        $useraddId = $this->Session->read('addId');
        $this->set('useraddId', $useraddId);


        $hour=9;
        $min=30;
        $hourPlus=intval($hour)+9;
        if (strlen($hourPlus)==1) {
            $hourPlus = '0'.$hourPlus;
        }
        //Create a time string to display in view. The time string
        //is either  "Fri 26 / Mar, 09 : 00 — 10 : 00" or
        //"All day event: (Fri 26 / Mar)"
        if ($allday == 'true') {
            $this->request->data['Leave']['allDay'] = 1;
            //$this->request->data['Leave']['totaldays'] = 0.5;
            $displayTime = '('
                . date('D',strtotime($day.'/'.$month.'/'.$year)).' '.
                $day.' / '. date("M", mktime(0, 0, 0, $month, 10)).')';

        } else {
            $this->request->data['Leave']['allDay'] = 0;
            //$this->request->data['Leave']['totaldays'] = 1;
            $displayTime = date('D',strtotime($day.'/'.$month.'/'.$year)).' '
                .$day.' / '.date("M", mktime(0, 0, 0, $month, 10)).
                ', '.$hour.' : '.$min.' &mdash; '.$hourPlus.' : '.$min;
        }

         


        $this->set("displayTime",$displayTime);

                
        //Populate the event fields for the add form
        $this->request->data['Leave']['start'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
        $this->request->data['Leave']['end'] = $year.'-'.$month.'-'.$day.' '.$hourPlus.':'.$min.':00';
 
        //Do not use a view template.
        $this->layout = false;

         
    }
    
    function edit ($id=null) {
        if ($id==null) {
            echo 'holiday';
            return;
        }
        $this->request->data = $this->Leave->findById($id);

        if ($this->request->data['Leave']['totaldays']==0.5) {
            $displayTime = 'Half day event';
        } else {
            $displayTime = date('Y-M-d H:i', strtotime($this->request->data['Leave']['start'])) . ' &mdash; ' . date('Y-M-d  H:i', strtotime($this->request->data['Leave']['end']));
        }
        
        $this->set('displayTime', $displayTime);
        $this->layout = false;
    }
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	function delete($id = null) {

        $userdeleteId = $this->Session->read('deleteId');
        $this->layout = 'ajax';
        $this->autoRender = false;
        
                $leavedays = $this->Leave->find('all', array( 
               'conditions'=>array('Leave.id'=>$id)));
                $daysadd = $leavedays['0']['Leave']['totaldays'];
                $lstart = $leavedays['0']['Leave']['start'];
                $lend = $leavedays['0']['Leave']['end'];

                $leavetaken = $this->Leave->User->find('all', array( 
               'conditions'=>array('User.id'=>$userdeleteId)));
                $buff = $leavetaken['0']['User']['leavesbuff'];
                $leavestart = $leavetaken['0']['User']['leavestart'];
                $leavemid = $leavetaken['0']['User']['leavemid'];
               

            if(strtotime($leavestart) <= strtotime($lstart) && strtotime($lend) < strtotime($leavemid)){
               $leavedata = array('id' => $userdeleteId ,
                'leavesbuff' => $buff+$daysadd,
                );
                $this->Leave->User->save($leavedata);
            }
        



        $this->Leave->delete($id);
        
        $response = array('success' => true);
        return json_encode($response);
    }





    function save(){
        
        $usersaveId = $this->Session->read('saveId');
          
        

        $this->layout = 'ajax';
        $this->autoRender = false;
        
        if ($this->request->is('ajax')){
            header('Content-type: application/json');
            
            //if grag, just modify the end of the event
            
            $td = $this->Leave->findById($this->data['id']);
            if (isset($this->data['drag']) && $td['Leave']['totaldays']!=0.5){
                $days_sign = $this->data['dayDelta'] > 0? '+' : '';
                $minutes_sign = $this->data['minuteDelta'] > 0? '+' : '';
                
                $event = $this->Leave->findById($this->data['id']);
                $this->request->data['end'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($event['Leave']['end'])) . $days_sign . ' '.$this->request->data['dayDelta'].' days '. $minutes_sign . ' '.$this->request->data['minuteDelta'].' minutes'));   
                

                $dataend = $this->request->data['end'];
                $start = date('Y-m-d', strtotime($event['Leave']['start']));
                $end = date('Y-m-d', strtotime($dataend));
                $start = new DateTime($start);
                $end = new DateTime($end);
                $days = $start->diff($end)->days;
                $totaldays =  $days+1;
                $s=$event['Leave']['start'];
                $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                while (strtotime($s) <= strtotime($dataend)) {
                

                    foreach($holidays as $holiday){
                    if( date("M-d", strtotime($s))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                        $totaldays=$totaldays-1;
                    }
                    }
                    
                     //echo "$s\n";
                    $day=date ('l', strtotime($s));
                    if($day=="Sunday"||$day=="Saturday"){
                         $totaldays=$totaldays-1;
                         //echo $day;
                    }

                    
                   


                    $s = date ('Y-M-d', strtotime("+1 day", strtotime($s)));
                    $day =date ('l', strtotime($s));

                   
                 }

                $totaldaysdata = array('id' => $this->data['id'] , 'totaldays' => $totaldays);
                $this->Leave->save($totaldaysdata);


                
                $daysadd = $event['Leave']['totaldays'];
                $lstart = $event['Leave']['start'];
                $lend = $event['Leave']['end'];

                $leavetaken = $this->Leave->User->find('all', array( 
               'conditions'=>array('User.id'=>$usersaveId)));
                $buff = $leavetaken['0']['User']['leavesbuff'];
                $leavestart = $leavetaken['0']['User']['leavestart'];
                $leavemid = $leavetaken['0']['User']['leavemid'];
               

            if(strtotime($leavestart) <= strtotime($lstart) && strtotime($lend) < strtotime($leavemid)){
               $leavedata = array('id' => $usersaveId,
                'leavesbuff' => $buff+$daysadd,
                );
                $this->Leave->User->save($leavedata);
            }


            } 
            
                
            
            //if drop, modify start and end of the event
            if (isset($this->data['drop'])){
                $days_sign = $this->data['dayDelta'] > 0? '+' : '';
                $minutes_sign = $this->data['minuteDelta'] > 0? '+' : '';
                
                $event = $this->Leave->findById($this->data['id']);
                $this->request->data['start'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($event['Leave']['start'])) . $days_sign . ' '.$this->request->data['dayDelta'].' days '. $minutes_sign . ' '. $this->request->data['minuteDelta'].' minutes')); 
                $this->request->data['end'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($event['Leave']['end'])) . $days_sign . ' '.$this->request->data['dayDelta'].' days '. $minutes_sign . ' '. $this->request->data['minuteDelta'].' minutes'));  
             
                $datastart= $this->request->data['start'];
                $dataend = $this->request->data['end'];
                $start = date('Y-m-d', strtotime($datastart));
                $end = date('Y-m-d', strtotime($dataend));
                $start = new DateTime($start);
                $end = new DateTime($end);
                $days = $start->diff($end)->days;
                $totaldays =  $days+1;
                $s=$datastart;
                $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                while (strtotime($s) <= strtotime($dataend)) {

                    foreach($holidays as $holiday){
                    if( date("M-d", strtotime($s))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                        $totaldays=$totaldays-1;
                    }
                    }
                     //echo "$start\n";
                    $day=date ('l', strtotime($s));
                    if($day=="Sunday"||$day=="Saturday"){
                         $totaldays=$totaldays-1;
                         //echo $day;
                    }

                    $s = date ('Y-m-d', strtotime("+1 day", strtotime($s)));
                    $day =date ('l', strtotime($s));

                   
                 }

            if ($event['Leave']['totaldays']!=0.5){
                $totaldaysdata = array('id' => $this->data['id'] , 'totaldays' => $totaldays);
                $this->Leave->save($totaldaysdata);
            }

             
                $daysadd = $event['Leave']['totaldays'];
                $lstart = $event['Leave']['start'];
                $lend = $event['Leave']['end'];

                $leavetaken = $this->Leave->User->find('all', array( 
               'conditions'=>array('User.id'=>$usersaveId)));
                $buff = $leavetaken['0']['User']['leavesbuff'];
                $leavestart = $leavetaken['0']['User']['leavestart'];
                $leavemid = $leavetaken['0']['User']['leavemid'];
               

            if(strtotime($leavestart) <= strtotime($lstart) && strtotime($lend) < strtotime($leavemid)){
               $leavedata = array('id' => $usersaveId,
                'leavesbuff' => $buff+$daysadd,
                );
                $this->Leave->User->save($leavedata);
            }

            }



            
            if (isset($this->request->data['allDay']) && $this->request->data['allDay'] != 'false') 
                $this->request->data['allDay'] = 1;
            else 
                $this->request->data['allDay'] = 0;


                              

            if (!empty($this->request->data) && $this->Leave->save($this->request->data)){
                    
        
                // Data to be sent as JSON response
                $response = array('success' => true);
                return json_encode($response);
            }else{
                $response = array('success' => false, 'fields' => $this->Leave->invalidFields());
                return json_encode($response);    
            }
        }
    }

    function loaddata()
    {   $userId = $this->Session->read('loaddataId');


        $this->layout = 'ajax';
        $this->autoRender = false;
        
        if ($this->request->is('ajax')){
            header('Content-type: application/json');
            
                if (!empty($userId)) {
                    $user = $this->Leave->User->find('all',array('conditions'=>array('User.id'=>$userId)));
                
                    $start = date("Y-m-d", strtotime($user['0']['User']['leavestart']));
                    $mid = date("Y-m-d", strtotime($user['0']['User']['leavemid']));
                    $end = date("Y-m-d", strtotime($user['0']['User']['leaveend']));

                    $leaves = $this->Leave->find('all',array('conditions'=>array('Leave.user_id'=>$userId)));
                    $withinsix=0;
                    $aftersix=0;

                    foreach($leaves as $leave){

                        $sdate = date("Y-m-d", strtotime($leave['Leave']['start']));
                        $edate = date("Y-m-d", strtotime($leave['Leave']['end']));

                       if(strtotime($start) <= strtotime($sdate) && strtotime($edate) < strtotime($mid)){
                            $w =$leave['Leave']['totaldays'];
                            $withinsix = $withinsix +$w;
                        }

                        if(strtotime($sdate) < strtotime($start) && strtotime($edate) >= strtotime($start) ){
                             $starting= date('Y-m-d', strtotime($start));
                            $ending= date('Y-m-d', strtotime($edate));
                            $s = new DateTime($starting);
                            $e = new DateTime($ending);
                            $days = $s->diff($e)->days;
                            $totaldays =  $days+1;

                            $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                            while (strtotime($starting) <= strtotime($ending)) {
                        
                            foreach($holidays as $holiday){
                            if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                                $totaldays=$totaldays-1;
                            }
                            }
                            
                             //echo "$s\n";
                            $day=date ('l', strtotime($starting));
                            if($day=="Sunday"||$day=="Saturday"){
                                 $totaldays=$totaldays-1;
                                 //echo $day;
                            }

                            $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                            $day =date ('l', strtotime($starting));
                        }

                        $withinsix = $withinsix +$totaldays;
                        }

                        if(strtotime($sdate) < strtotime($mid) && strtotime($edate) >= strtotime($mid) ){
                             $starting= date('Y-m-d', strtotime($sdate));
                            $ending= date('Y-m-d', strtotime($mid));
                            $s = new DateTime($starting);
                            $e = new DateTime($ending);
                            $days = $s->diff($e)->days;
                            $totaldays =  $days;

                            $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                            while (strtotime($starting) <= strtotime($ending)) {
                        
                            foreach($holidays as $holiday){
                            if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                                $totaldays=$totaldays-1;
                            }
                            }
                            
                             //echo "$s\n";
                            $day=date ('l', strtotime($starting));
                            if($day=="Sunday"||$day=="Saturday"){
                                 $totaldays=$totaldays-1;
                                 //echo $day;
                            }

                            $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                            $day =date ('l', strtotime($starting));
                        }

                        $withinsix = $withinsix +$totaldays;
                        }

                        


                        if(strtotime($mid) <= strtotime($sdate) && strtotime($edate) < strtotime($end)){
                            $w =$leave['Leave']['totaldays'];
                            $aftersix = $aftersix + $w;
                        }

                        if(strtotime($sdate) < strtotime($mid) && strtotime($edate) >= strtotime($mid) ){
                            $starting= date('Y-m-d', strtotime($mid));
                            $ending= date('Y-m-d', strtotime($edate));
                            $s = new DateTime($starting);
                            $e = new DateTime($ending);
                            $days = $s->diff($e)->days;
                            $totaldays =  $days+1;

                            $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                            while (strtotime($starting) <= strtotime($ending)) {
                        
                            foreach($holidays as $holiday){
                            if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                                $totaldays=$totaldays-1;
                            }
                            }
                            
                             //echo "$s\n";
                            $day=date ('l', strtotime($starting));
                            if($day=="Sunday"||$day=="Saturday"){
                                 $totaldays=$totaldays-1;
                                 //echo $day;
                            }

                            $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                            $day =date ('l', strtotime($starting));
                        }

                        $aftersix = $aftersix +$totaldays;
                        }

                        if(strtotime($sdate) < strtotime($end) && strtotime($edate) > strtotime($end) ){
                             $starting= date('Y-m-d', strtotime($sdate));
                            $ending= date('Y-m-d', strtotime($end));
                            $s = new DateTime($starting);
                            $e = new DateTime($ending);
                            $days = $s->diff($e)->days;
                            $totaldays =  $days;

                            $holidays = $this->Leave->Holiday->find('all', array('fields' => array('Holiday.id','Holiday.date')));

                            while (strtotime($starting) <= strtotime($ending)) {
                        
                            foreach($holidays as $holiday){
                            if( date("M-d", strtotime($starting))==date("M-d", strtotime($holiday['Holiday']['date'])) ){
                                $totaldays=$totaldays-1;
                            }
                            }
                            
                             //echo "$s\n";
                            $day=date ('l', strtotime($starting));
                            if($day=="Sunday"||$day=="Saturday"){
                                 $totaldays=$totaldays-1;
                                 //echo $day;
                            }

                            $starting = date ('Y-M-d', strtotime("+1 day", strtotime($starting)));
                            $day =date ('l', strtotime($starting));
                        }

                        $aftersix = $aftersix +$totaldays;
                        }


                    }
                    
                    $intialtaken = $withinsix + $aftersix;
                    $this->set("intialtaken",$intialtaken);
                    

                    $total = $user['0']['User']['leavesentitled'];
                    $this->set("total",$total);

                    $maintotal=$total;
                    $this->set("maintotal",$maintotal);

                    $initialbalance = 22;
              
                    $initialsubtaken = $user['0']['User']['leavessubtaken'];

                    $buffer = $user['0']['User']['leavesbuffer'];

                    $buff = $user['0']['User']['leavesbuff'];
                  

                    if($intialtaken <= $total){

                        $paid = 0;
                            if($buff>0 && $buffer>0){
                                $cal = $buffer - $withinsix;
                                if($cal<0){
                                                                                          
                                    $subtaken = $buffer;
                                    $savebuffer = 0;

                                    $taken = $intialtaken-$subtaken;
                                    $balance = $initialbalance - $taken;

                                }else{
                                    
                                    $subtaken = $withinsix;
                                    $savebuffer = $cal;

                                    $taken = $intialtaken-$subtaken;
                                    $balance = $initialbalance - $taken;
                                }
                            }else{

                                $savebuffer = 0;
                                $subtaken = $initialsubtaken;
                                $taken = $intialtaken-$initialsubtaken;
                                $balance = $initialbalance - $taken;
                            
                            }
                       
                        
                    }else{

                        $balance = 0;
                        $paid = $intialtaken-$total;
                        $savebuffer = 0;
                        $subtaken = $initialsubtaken;
                        
                    }

                    $this->set("savebuffer",$savebuffer);
                    $this->set("balance",$balance);
                    $this->set("paid",$paid);

                    
echo"<h2>";
    
        echo"<table>
                    <thead>
                    <tr>";
                if($savebuffer>0){
                echo"<th>";
                echo 'Buffer'; 
                echo"</th>";
                }

                if($paid<=0){
                echo"<th>";
                echo 'Balance'; 
                echo"</th>";
                }

                echo"<th>";
                echo 'Taken'; 
                echo"</th>";
                
               if($paid>0){
                echo"<th>";
                echo 'Paid'; 
                echo"</th>";
                }

                echo"<th>";
                echo 'Total'; 
                echo"</th>";

               
            echo"</tr>
                        </thead>
                        <tbody>
                        <tr>";
                if($savebuffer>0){
                echo"<th>";
                echo json_encode($savebuffer); 
                echo"</th>";
                }

                if($paid<=0){
                echo"<th>";
                echo json_encode($balance);
                echo"</th>";
                }

                echo"<th>";
                echo json_encode($intialtaken); 
                echo"</th>";
                
               if($paid>0){
                echo"<th>";
                echo json_encode($paid); 
                echo"</th>";
                }

                echo"<th>";
                echo json_encode($maintotal);
                echo"</th>";
               
            echo"</tr>
                        </tbody>
                    </table>";
    
    echo "</h2>";

                    
                    
                    
                    
                    

                    $leavedata = array('id'=> $userId,
                    'leavestaken' => $intialtaken,
                    'leavesremaining'=> $balance,
                    'leavessubtaken' => $subtaken,
                    'leavesbuff' =>  $savebuffer,
                    'leavespay'=> $paid
                    );
                    $this->Leave->User->save($leavedata);
                }

        }

    }

    function feeds() {

		$userId = $this->Session->read('feedId');
    	
        $events = $this->Leave->find('all');
        
        //1. Transform request parameters to MySQL datetime format.
        $start = date('Y-m-d H:i:s', $this->request->query('start'));
        $end = date('Y-m-d H:i:s', $this->request->query('end'));
        
        //2. Get the events corresponding to the time range
        $conditions = array('Leave.start BETWEEN ? AND ?' => array($start, $end), 'Leave.user_id' => $userId);
        $events = $this->Leave->find('all', array('conditions' => $conditions));
        $holidays = $this->Leave->Holiday->find('all');
        
        
        //3. Create the json array
        $rows = array();
        for ($a=0; count($events)> $a; $a++) {
            //Is it an all day event?
            //$all = ($events[$a]['Leave']['allDay'] == 1);
            
            //Create an event entry
            $rows[] = array(
                'id' => $events[$a]['Leave']['id'],
                'title' => $events[$a]['Leave']['reason'],
                'start' => date('Y-m-d H:i', strtotime($events[$a]['Leave']['start'])),
                'end' => date('Y-m-d H:i', strtotime($events[$a]['Leave']['end'])),
                //'allDay' => $all,
            );
        }
       
        $rowsh = array();
        for ($a=0; count($holidays)> $a; $a++) {
            //Is it an all day event?
            //$all = ($events[$a]['Leave']['allDay'] == 1);
            
            //Create an event entry
            $rowsh[] = array(
                'id' => $holidays[$a]['Holiday']['id'],
                'title' => $holidays[$a]['Holiday']['name'],
                'start' => date('Y-m-d', strtotime($holidays[$a]['Holiday']['date'])),
                'color' =>'red'
                
            );
        }
        $result = array_merge($rows,$rowsh);
        //4. Return as a json array
        Configure::write('debug', 0);
        $this->autoRender = false;
        $this->autoLayout = false;
        $this->header('Content-Type: application/json');
        echo json_encode($result);
	}
}
