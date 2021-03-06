<?php
App::import('Sanitize');
class EventsController extends AppController  {
    var $helpers = array('Time', 'Js', 'Javascript');
    
    function beforeFilter(){
        parent::beforeFilter();
    }
    
    function index(){}
    
    function add($allday=null, $day=null, $month=null, $year=null, $hour=null, $min=null) {                            
        //Set default duration: 1hr and format to a leading zero.
        $hourPlus=intval($hour)+1;
        if (strlen($hourPlus)==1) {
            $hourPlus = '0'.$hourPlus;
        }
 
        //Create a time string to display in view. The time string
        //is either  "Fri 26 / Mar, 09 : 00 — 10 : 00" or
        //"All day event: (Fri 26 / Mar)"
        if ($allday=='true') {
            $this->data['Event']['allDay'] = 1;
            $displayTime = 'All day event: ('
                . date('D',strtotime($day.'/'.$month.'/'.$year)).' '.
                $day.' / '. date("M", mktime(0, 0, 0, $month, 10)).')';
        } else {
            $this->data['Event']['allDay'] = 0;
            $displayTime = date('D',strtotime($day.'/'.$month.'/'.$year)).' '
                .$day.' / '.date("M", mktime(0, 0, 0, $month, 10)).
                ', '.$hour.' : '.$min.' &mdash; '.$hourPlus.' : '.$min;
        }
        $this->set("displayTime",$displayTime);
 
        //Populate the event fields for the add form
        $this->data['Event']['start'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
        $this->data['Event']['end'] = $year.'-'.$month.'-'.$day.' '.$hourPlus.':'.$min.':00';
 
        //Do not use a view template.
        $this->layout = false;
    }
    
    function edit ($id=null) {
        if ($id==null) {
            //fail gracefully in case of error
            return;
        }
        $this->data = $this->Event->findById($id);

        if ($this->data['Event']['allDay']=='1') {
            $displayTime = 'All day event';
        } else {
            $displayTime = date('Y-m-d H:i', strtotime($this->data['Event']['start'])) . ' &mdash; ' . date('Y-m-d  H:i', strtotime($this->data['Event']['end']));
        }
        
        $this->set('displayTime', $displayTime);
        $this->layout = false;
    }
    
    function save(){
        $this->layout = 'ajax';
        $this->autoRender = false;
        
        if ($this->RequestHandler->isAjax()){
            header('Content-type: application/json');
            
            //if grag, just modify the end of the event
            if (isset($this->data['drag'])){
                $days_sign = $this->data['dayDelta'] > 0? '+' : '';
                $minutes_sign = $this->data['minuteDelta'] > 0? '+' : '';
                
                $event = $this->Event->findById($this->data['id']);
                $this->data['end'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($event['Event']['end'])) . $days_sign . ' '.$this->data['dayDelta'].' days '. $minutes_sign . ' '.$this->data['minuteDelta'].' minutes'));   
            } 
            //if drop, modify start and end of the event
            if (isset($this->data['drop'])){
                $days_sign = $this->data['dayDelta'] > 0? '+' : '';
                $minutes_sign = $this->data['minuteDelta'] > 0? '+' : '';
                
                $event = $this->Event->findById($this->data['id']);
                $this->data['start'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($event['Event']['start'])) . $days_sign . ' '.$this->data['dayDelta'].' days '. $minutes_sign . ' '. $this->data['minuteDelta'].' minutes')); 
                $this->data['end'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($event['Event']['end'])) . $days_sign . ' '.$this->data['dayDelta'].' days '. $minutes_sign . ' '. $this->data['minuteDelta'].' minutes'));  
            }
            
            if (isset($this->data['allDay']) && $this->data['allDay'] != 'false') 
                $this->data['allDay'] = 1;
            else 
                $this->data['allDay'] = 0;
            
            if (!empty($this->data) && $this->Event->save($this->data)){
                // Data to be sent as JSON response
                $response = array('success' => true);
                return json_encode($response);
            }else{
                $response = array('success' => false, 'fields' => $this->Event->invalidFields());
                return json_encode($response);    
            }
        }
    }
    
    function delete($id = null) {
        $this->layout = 'ajax';
        $this->autoRender = false;
        
        $this->Event->delete($id);
        
        $response = array('success' => true);
        return json_encode($response);
	}

    function feeds() {
        $events = $this->Event->find('all');
        
        //1. Transform request parameters to MySQL datetime format.
        $start = date('Y-m-d H:i:s', $this->params['url']['start']);
        $end = date('Y-m-d H:i:s', $this->params['url']['end']);
        
        //2. Get the events corresponding to the time range
        $conditions = array('Event.start BETWEEN ? AND ?' => array($start, $end), 'Event.user_id' => $this->Auth->user('id'));
        $events = $this->Event->find('all', array('conditions' => $conditions));
        
        //3. Create the json array
        $rows = array();
        for ($a=0; count($events)> $a; $a++) {
            //Is it an all day event?
            $all = ($events[$a]['Event']['allDay'] == 1);
            
            //Create an event entry
            $rows[] = array(
                'id' => $events[$a]['Event']['id'],
                'title' => $events[$a]['Event']['title'],
                'start' => date('Y-m-d H:i', strtotime($events[$a]['Event']['start'])),
                'end' => date('Y-m-d H:i', strtotime($events[$a]['Event']['end'])),
                'allDay' => $all,
            );
        }
        
        //4. Return as a json array
        Configure::write('debug', 0);
        $this->autoRender = false;
        $this->autoLayout = false;
        $this->header('Content-Type: application/json');
        echo json_encode($rows);
	}
}