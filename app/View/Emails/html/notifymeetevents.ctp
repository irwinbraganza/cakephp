
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

<p>Hey Guys!!! </p>
<p><?php echo 'There will be a '.$title.' meeting' ?></p>
<p><?php echo ' on '.$day.'-'.$month.'-'.$year.' '.$hour.':'.$min.' '.$meridian ?></p>
<p><?php echo ' at '.$venue ?></p>
<p>Please be present in time for the meeting.</p>
<p><?php echo $details ?></p>

<br/>
<p>-Diet Code </p>

<?php }else{ ?>

<p>Hey Guys!!! </p>
<p><?php echo 'We are going to have a '.$title ?></p>
<p><?php echo ' on '.$day.'-'.$month.'-'.$year.' '.$hour.':'.$min.' '.$meridian ?></p>
<p><?php echo ' at '.$venue ?></p>
<p>Please Contact the HR to confirm your presence</p>
<p><?php echo $details ?></p>

<br/>
<p>-Diet Code </p>

<?php } ?>