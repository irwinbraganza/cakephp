<?php
$m = $datetime['month'];
$day = $datetime['day'];
$year = $datetime['year'];
$hour = $datetime['hour'];
$min = $datetime['min'];
$meridian = $datetime['meridian'];
$date = date($year.'-'.$m.'-'.$day, strtotime("now"));
$month = date("M", strtotime($date));

if($type == "MEETING"){ ?>

<p><?php echo 'Hey Guys!!!'?></p>
<p><?php echo 'There will be a '.$title.' meeting' ?></p>
<p><?php echo ' on '.$day.'-'.$month.'-'.$year.' '.$hour.':'.$min.' '.$meridian ?></p>
<p><?php echo ' at '.$venue ?></p>
<p><?php echo 'Please be present in time for the meeting.'?></p>
<p><?php echo $details ?></p>

<br/>
<p><?php echo '-Diet Code'?> </p>

<?php }else{ ?>

<p><?php echo 'Hey Guys!!!'?></p>
<p><?php echo 'We are going to have a '.$title ?></p>
<p><?php echo ' on '.$day.'-'.$month.'-'.$year.' '.$hour.':'.$min.' '.$meridian ?></p>
<p><?php echo ' at '.$venue ?></p>
<p><?php echo 'Please Contact the HR to confirm your presence' ?></p>
<p><?php echo $details ?></p>

<br/>
<p><?php echo '-Diet Code'?> </p>

<?php } ?>