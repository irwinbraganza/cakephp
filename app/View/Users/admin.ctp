<?php echo $this->Html->script('date', array('inline' => false));?>
<div class="container">
  <div id="checkin-box">
    <div id="chb-header">
      <div class="logo pull-left">
        <h1>DC Office App</h1>
        <h2>Dashboard</h2>
      </div>
      <div class="time pull-right">
        <h1><?php echo date('l, d F Y');?></h1>
        <h3 class="timer"></h3>
         <?php if (isset($user['User']['role']) && $user['User']['role'] === 'admin'): ?>
          <span><?php echo $this->Html->link(__('ADMIN PANEL'), array('controller' => 'users', 'action' => 'index')); ?></span>
        <?php endif; ?>
      </div>
    </div>
    <div id = "chb"></div>
    <div class = "row rowstyleTryTwo">
      <div class = "col-md-5">
        <div class="row">
          <div class = "col-md-3 col-md-offset-1">
            <?php if (!empty($user['User']['upload'])): ?>
              <?php echo $this->Html->image('uploads/users/'.$user['User']['upload'], array("class" => 'img-circle profilepic','width'=>'150px','height'=>'80px')); ?>
            <?php else: ?>
              <?php echo $this->Html->image('default.jpg', array('class' => 'img-circle profilepic')); ?>
            <?php endif; ?>
          </div>
          <div class = "col-md-8 stats-col">
            <h3>Hi,<?php echo $this->Html->Link(__($user['User']['firstname']), array('controller' => 'users', 'action' => 'edit_profile',$user['User']['id']));?>
            </h3>
            <?php echo $this->Form->create('User', array('class' => 'form-auth'));?>
            <div id = "notify">
              <?php if ($user['User']['cupcakespending']>0 ): ?>
              <div id = "notify-step-one">I bought cupcakes today!</div>
              <?php endif; ?>
              <div id = "notify-step-two" style="display:none">
                <?php echo $this->Form->input('count', array('class' => 'form-control notify-admin', 'placeholder' => 'Number of CC you brought today', 'label' => false));?> 
                <div id="wrapper" class="clearfix">
                  <?php echo $this->Form->submit(__('Notify admin'), array('class' => 'btn btn-large btn-primary'));?>
                  <div id = "close-notify"  style="display:none";>
                   <span class = "close-notify">Close</span>
                  </div>
                </div>                
              </div>
            </div>
            <?php echo $this->Form->end();?>
            <div class="logout-btn">
            <?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('class' => 'dash-logout-style')); ?>
            </div>
            <?php // pr($notifications);?>
            <?php if($user['User']['cupcakesbought']>0)  :?>
            <div id ="cupcake">Waiting for approval on cupcakes bought !</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      
      <div class = "cp-format col-md-7"> <!-- New div starts here-->
        <div class="row">
          
          <div class = "col-md-4 text-center">
          <?php echo $this->Html->image('cupcake-bought.png',array(
                'width'=>'50px','height'=>'40px'));?>
            <!-- <span class = "glyphicon glyphicon-camera bigSize"></span> -->
            <h4>Cupcakes Bought</h4>
            <h1 class = "font-hundred"><?php echo $user['User']['monthlycupcakesbought'] ?></h1>
          </div>
          <div class = "col-md-4 text-center">
          <?php echo $this->Html->image('cupcake-pending.png',array(
                'width'=>'50px','height'=>'40px'));?>
            <!-- <span class = "glyphicon glyphicon-camera bigSize"></span> -->
            <h4>Cupcakes Pending</h4>
            <h1 class = "font-hundred"><?php echo $user['User']['cupcakespending'] ?></h1>
          </div>
          <div class = "col-md-4 text-center">
          <?php echo $this->Html->image('Leave_Icon.jpg',array(
                'width'=>'40px','height'=>'40px'));?>
            <!-- <span class = "glyphicon glyphicon-camera bigSize"></span> -->
            <h4>Leaves Remaining</h4>
            <h1 class = "font-hundred"><?php echo $user['User']['leavesremaining']; ?></h1>
          </div>
          
         
        </div>
      </div> <!-- new div ends here-->

    </div>

    <div class = "row rowTwoStyle">
      <div class = "col-md-12">
        <h2 class = "topBottom">Today's Office Updates</h2>
      </div>
    </div>
    <div class="row cp-updates">
      <ul class="list-unstyled update-entries">
        

           <?php if (!empty($appreciatearraycount)) : ?>
          <li> <!--Birthday updates -->
            <ul class="list-unstyled list-inline">
              <li><?php echo $this->Html->image('punctual.png',array(
                      'width'=>'60px'));?></span></li>
              <li>
               
                <?php echo 'badge has been awarded to '; ?>
                 <?php foreach($appreciatearray as &$val) :?>
                  <strong><?php echo $val .', ';?></strong>
              <?php endforeach;?>
                <?php echo ' for the month of '.date("F", strtotime("-1 months")) ?> 
              </li>
            </ul>
          </li>
        <?php endif;?>


        <?php if (!empty($notificationarray)) : ?>
          <?php foreach($notificationarray as &$value):?>
            <?php if($value[2] == "MEETING"):?>
                <li> 
                  <ul class="list-unstyled list-inline">
                    <li> <?php echo $this->Html->image('meeting.png',array(
                      'width'=>'50px','height'=>'40px'));?></li>
                    <li>
                      <span>
                          <strong><?php echo $value[1] .' meeting today at '.date('g:i a', strtotime($value[4])).' in '. $value[5] ;?></strong>
                        </span>  
                      </li>
                  </ul>
                </li>
            <?php else:?>
                <li>
                  <ul class="list-unstyled list-inline">
                    <li> <?php echo $this->Html->image('EventsCalendar_Icon.png',array('width'=>'50px','height'=>'40px'));?></li>
                    <li><span>
                          <strong><?php echo $value[1] .' event today at '.date('g:i a', strtotime($value[4])).' in '. $value[5] ;?></strong>
                        </span>  
                    </li>
                  </ul>
                </li>
            <?php endif;?>
          <?php endforeach;?>
        <?php endif;?>

        <?php if (!empty($bdayarray)) : ?>
          <li> <!--Birthday updates -->
            <ul class="list-unstyled list-inline">
              <li><span class = "glyphicon glyphicon-gift glyphsize"></span></li>
              <li>
                <?php foreach($bdayarray as &$value) :?>
                  <span><strong><?php echo $value .'\'s, ';?></strong></span>
                <?php endforeach;?>
                <span><strong> <font color = "magenta">birthday today!</font> lets all sing Happy Birthday!</strong></span>
              </li>
            </ul>
          </li>
        <?php endif;?>
        
        <?php if (!empty($latearraycount)): ?>
           <li> <!-- Late comers -->
            <ul class="list-unstyled list-inline">
              <li><span class = "glyphicon glyphicon-time glyphsize"></span></li>
              <li>
                <span><strong><?php echo $str = implode(', ', $latearray); ?></strong></span>
                  <?php $late = ($latearraycount > 1) ? 'were late' : 'was late'; ?>
                <span><strong><font color = "red"><?php echo $late ;?></font></strong> today, guess somebody got drunk last night!</span>
              </li>
            </ul>
          </li>
        <?php else :?>
          <li> <!-- All on time -->
            <ul class="list-unstyled list-inline">
              <li><span class = "glyphicon glyphicon-time glyphsize"></span></li>
              <li>All arrived on time!</li>
            </ul>
          </li>
        <?php endif;?>

        <?php if(!empty($eaglename) ):?>
          <li> <!-- Early Bird -->
            <ul class="list-unstyled list-inline">
              <li><span class = "glyphicon glyphicon-log-in glyphsize"></span></li>
              <li><span><strong>Early Eagle:</strong><font color = "blue"><strong> <?php echo $eaglename['User']['firstname'];?>!</strong></font> checked in at : <?php echo date('g:i a', strtotime($eagledatetime));?> on <?php echo date('F d, Y', strtotime($eagledatetime));?></span></li>
            </ul>
          </li>
        <?php endif;?>
        
        <?php if(!empty($owlname)):?>
          <li> <!-- Night Owl -->
            <ul class="list-unstyled list-inline">
              <li><span class = "glyphicon glyphicon-log-out glyphsize"></span></li>
              <li><span><strong>Night Owl:</strong><font color = "maroon"> <strong><?php echo $owlname['User']['firstname'];?>!</strong></font> checked out at : <?php echo date('g:i a', strtotime($owldatetime));?> on <?php echo date('F d, Y', strtotime($owldatetime));?></span></li>
            </ul>
          </li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</div>






