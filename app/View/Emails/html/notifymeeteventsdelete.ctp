<?php

 if($type == "MEETING"){ ?>

<p>Hey Guys!!! </p>
<p>Please Note,</p>
<p><?php echo 'The '.$title.' meeting' ?></p>
<p><?php echo ' scheduled on '.date("d-M-Y g:i A", strtotime($datetime)) ?></p>
<p><?php echo ' at '.$venue.' is cancelled. ' ?></p>

<br/>
<p>-Diet Code </p>

<?php }else{ ?>

<p>Hey Guys!!! </p>
<p>Please Note,</p>
<p><?php echo 'The '.$title ?></p>
<p><?php echo ' scheduled on '.date("d-M-Y g:i A", strtotime($datetime)) ?></p>
<p><?php echo ' at '.$venue.' is cancelled. ' ?></p>

<br/>
<p>-Diet Code </p>

<?php } ?>