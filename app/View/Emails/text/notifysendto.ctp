<?php if($type == "MEETING"){ ?>

<p>Hey Guys!!! </p>
<p><?php echo 'There will be a '.$title.' meeting' ?></p>
<p><?php echo ' on '.date("d-M-Y g:i A", strtotime($datetime))  ?></p>
<p><?php echo ' at '.$venue ?></p>
<p>Please be present in time for the meeting.</p>
<p><?php echo $details ?></p>

<br/>
<p>-Diet Code </p>

<?php }else{ ?>

<p>Hey Guys!!! </p>
<p><?php echo 'We are going to have a '.$title ?></p>
<p><?php echo ' on '.date("d-M-Y g:i A", strtotime($datetime))  ?></p>
<p><?php echo ' at '.$venue ?></p>
<p>Please Contact the HR to confirm your presence</p>
<p><?php echo $details ?></p>

<br/>
<p>-Diet Code </p>

<?php } ?>