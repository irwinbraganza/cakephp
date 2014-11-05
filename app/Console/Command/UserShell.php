<?php
class UserShell extends AppShell {
	public $uses = array('User','Leave');
      
    public function main(){

        App::uses('CakeEmail', 'Network/Email');
        date_default_timezone_set('Asia/Kolkata');
        $todays_date = date("Y-m-d ", strtotime("now"));

        $users = $this->User->find('all');
            
        foreach($users as $user){
            if( date("m-d", strtotime("now")) == date("m-d",strtotime($user['User']['doj'])) ){
                
                $start = date("Y-m-d", strtotime($todays_date));
                $mid = date("Y-m-d", strtotime($todays_date.' + 6 months'));
                $end = date("Y-m-d", strtotime($todays_date.' + 12 months'));
                                
                $leavesbuff = $user['User']['leavesremaining'];
                $leavesset = 22 +  $leavesbuff;

                $leavedata = array('id' => $user['User']['id'],
                'leavesentitled'=> $leavesset,
                'leavesremaining'=> 22,
                'leavesbuffer'=> $leavesbuff,
                'leavesbuff'=> $leavesbuff,
                'leavessubtaken'=>0,
                'leavestaken' => 0,
                'leavespay' => 0,
                'leavestart'=> $start,
                'leavemid'=> $mid,
                'leaveend'=> $end
                );
                $this->User->saveAll($leavedata);
            } 
            
            if( date("m-d", strtotime("now")) == date("m-d",strtotime($user['User']['doj'].' + 6 months')) ){
            
                
                    $subtaken = $user['User']['leavessubtaken'];
                    $leavessubset = 22 +  $subtaken;

                    $leave_buffer_data = array('id' => $user['User']['id'],
                    'leavesbuffer'=> 0,
                    'leavesentitled'=> $leavessubset
                    );
                    $this->User->saveAll($leave_buffer_data);
            }

            if( date("m-d", strtotime("now")) == date("m-d",strtotime($user['User']['dob'])) ){
            
                $fn=$user['User']['firstname'];
                $ln=$user['User']['lastname']; 
                $ei=$user['User']['username'];
                $usersnotify = $this->User->find('all');
                $emailids=array();
                
                foreach($usersnotify as $notify){
                array_push($emailids,$notify['User']['username']);
                }
                  
                $connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                if($connected){
                    $this->Email = new CakeEmail('gmail');
                    $this->Email->template('notifybday');
                    $this->Email->from(array('irwin93jesus@gmail.com' => 'Diet Code'));
                    $this->Email->bcc($emailids);
                    $this->Email->subject('Birthday Reminder From Diet Code');
                    $this->Email->emailFormat('both');
                   
                    $this->Email->viewVars(array('fn' => $fn));
                    $this->Email->viewVars(array('ln' => $ln));
                    $this->Email->viewVars(array('ei' => $ei));
                    $this->Email->send();
                }
            }
            if( date("m-d", strtotime("now")) == date("m-01", strtotime("now")) ){
            
                $fn=$user['User']['firstname'];
                $ln=$user['User']['lastname']; 
                $ei=$user['User']['username'];
                $ml=$user['User']['monthly_late'];
                
                if($ml==0){                 
                    
                    $late_data = array('id' => $user['User']['id'],
                        'latebuff'=>$ml,
                        'monthly_late'=> 0,
                        'monthlycupcakesbought'=>0
                    );
                    $this->User->saveAll($late_data);
                    $connected = @fsockopen("www.google.com", 443); 
                                        //website, port  (try 80 or 443)
                    if($connected){
                        $this->Email = new CakeEmail('gmail');
                        $this->Email->template('appreciate');
                        $this->Email->from(array('irwin93jesus@gmail.com' => 'Diet Code'));
                        $this->Email->to($ei);
                        $this->Email->subject('Appreciation From Diet Code');
                        $this->Email->emailFormat('both');
                       
                        $this->Email->viewVars(array('fn' => $fn));
                        $this->Email->viewVars(array('ln' => $ln));
                        $this->Email->send();
                    }
                }else{
                    $late_data = array('id' => $user['User']['id'],
                        'latebuff'=>$ml,
                        'monthly_late'=> 0,
                        'monthlycupcakesbought'=>0
                    );
                    $this->User->saveAll($late_data);
                }
            }
        }
    }
}
?>

