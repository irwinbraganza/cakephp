
<style type="text/css">
#eventdata{
    display: none;
    position: fixed;
    
    width: 100%;
    height: 100%;
        
    top:  0px;
    left: 0px;
    right:500px;
    
    background: url(/cakephp/img/opac.png);
    z-index: 10000 !important;
}
</style>

<div class="leaves index">


<script type='text/javascript'>
    $(document).ready(function() {
        $('#calendar').fullCalendar({


        	events: "<?=Router::url(array('controller' => 'leaves', 'action' => 'feeds'))?>",

            dayClick: function(date, allDay, jsEvent, view){
                $("#eventdata").show();
                $("#eventdata").load("<?=Router::url(array('controller' => 'leaves', 'action' => 'add'))?>/"+allDay+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm"));
            },
            eventClick: function(calEvent, jsEvent, view){
                $("#eventdata").show();
                $("#eventdata").load("<?=Router::url(array('controller' => 'leaves', 'action' => 'edit'))?>/"+calEvent.id);
            },
            header: {
                left:'title',
                right: 'prevYear, prev, today, month, next, nextYear'
            },
            editable: true,
            eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
                event.dayDelta = dayDelta;
                event.minuteDelta = minuteDelta;
                event.drag = true;
                
                $.post('<?=Router::url(array('controller' => 'leaves', 'action' => 'save'))?>', {data: event}, function(data) {
                    handleResponse(data);
                });
            },
            eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
                event.dayDelta = dayDelta;
                event.minuteDelta = minuteDelta;
                event.drop = true;
                
                $.post('<?=Router::url(array('controller' => 'leaves', 'action' => 'save'))?>', {data: event}, function(data) {
                    handleResponse(data);
                });
            },

            
            axisFormat: 'HH:mm',
            timeFormat: {
                // for agendaWeek and agendaDay
                agenda: 'HH:mm{ - HH:mm}', // 5:00 - 6:30
                minTime: '09:30',
                // for all other views
                '': 'HH:mm{ - HH:mm}'      // 7p


                
            },



            
        });
    });
    
    function handleResponse(data){    
        if (data.success == false){
            $('#LeaveReason').after('<div class="error-message">'+data.fields.title+'</div>');

        }else{
            $('#eventdata').hide();
            $('#calendar').fullCalendar('refetchEvents');
			$('#leavedata').load("<?=Router::url(array('controller' => 'leaves', 'action' => 'loaddata'))?>");
            $('#leavedata').show();
        }  
    }
</script>
<div id="leavedata">

	
<h2> 
	<?php  if (!empty($userId)): ?>
		<table>
			<thead>
			<tr>
				<?php if($savebuffer>0):?>
				<th><?php echo ('Buffer'); ?>&nbsp;</th>
				<?php endif; ?>

                <?php if($paid<=0):?>
				<th><?php echo ('Balance'); ?></th>
                <?php endif; ?>

				<th><?php echo ('Taken'); ?></th>
		        
				<?php if($paid>0):?>
		        <th><?php echo ('Paid'); ?></th>
		        <?php endif; ?>

                <th><?php echo ('Total'); ?></th>

		       
		    </tr>
			</thead>
			<tbody>
			<tr>
				<?php if($savebuffer>0):?>
				<th><?php echo h($savebuffer); ?>&nbsp;</th>
				<?php endif; ?>
				
                <?php if($paid<=0):?>
				<th><?php echo h($balance); ?>&nbsp;</th>
                <?php endif; ?>

				<th><?php echo h($intialtaken); ?>&nbsp;</th>
		        
		        <?php if($paid>0):?>
		        <th><?php echo h($paid); ?>&nbsp;</th>
				<?php endif; ?>

                <th><?php echo h($total); ?>&nbsp;</th>

		       
			</tr>
			</tbody>
		</table>
	<?php endif; ?>
</h2>
</div>


<div id="calendar"></div>
<div id="eventdata"></div>

<table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('Name'); ?></th>
                <th><?php echo $this->Paginator->sort('Taken'); ?></th>
                <th><?php echo $this->Paginator->sort('Balance'); ?></th>
                <th><?php echo $this->Paginator->sort('Paid'); ?></th>
                <th><?php echo $this->Paginator->sort('Buffer'); ?></th>
                <th><?php echo $this->Paginator->sort('Total'); ?></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userRecords as $users): ?>
        
                    <tr>
                        <th><?php echo h($users['User']['firstname']); ?>&nbsp;</th>
                        <?php  if (!empty($userId)){ ?>
                        <th><?php echo h($intialtaken); ?>&nbsp;</th>
                        <th><?php echo h($balance); ?>&nbsp;</th>
                        <th><?php echo h($paid); ?>&nbsp;</th>
                        <th><?php echo h($savebuffer); ?>&nbsp;</th>
                        <th><?php echo h($total); ?>&nbsp;</th>

                        <?php  }else{ ?>
                        <th><?php echo h($users['User']['leavestaken']); ?>&nbsp;</th>
                        <th><?php echo h($users['User']['leavesremaining']); ?>&nbsp;</th>
                        <th><?php echo h($users['User']['leavespay']); ?>&nbsp;</th>
                        <th><?php echo h($users['User']['leavesbuff']); ?>&nbsp;</th>
                        <th><?php echo h($users['User']['leavesentitled']); ?>&nbsp;</th>
                        
                        <?php  } ?>
                         
                    </tr> 
                    <tr>
                        <td></td>
                        <td><?php echo $this->Paginator->sort('reason'); ?></td>
                        <td><?php echo $this->Paginator->sort('startdate'); ?></td>
                        <td><?php echo $this->Paginator->sort('enddate'); ?></td>
                        <td><?php echo $this->Paginator->sort('Total Days'); ?></td>
                        <td></td>
                        
                    </tr>
                        <?php foreach ($users['Leave'] as $leave): ?>
                            <tr>  
                                     <?php $sdate = $leave['start'];
                                            $edate = $leave['end'];
                                            $start = $users['User']['leavestart'];
                                            $end = $users['User']['leaveend'];
                                            ?>

                                    <?php if((strtotime($sdate) < strtotime($start) && strtotime($edate) >= strtotime($start))
                                        ||(strtotime($start) <= strtotime($sdate) && strtotime($edate) < strtotime($end))
                                        ||(strtotime($sdate) < strtotime($end) && strtotime($edate) > strtotime($end))):?>
                                            <td></td>
                                            <td><?php echo h($leave['reason']); ?>&nbsp;</td>
                                            <td><?php echo date("d-M-Y", strtotime($leave['start'])); ?>&nbsp;</td>
                                            <td><?php echo date("d-M-Y", strtotime($leave['end'])); ?>&nbsp;</td>
                                            <?php if($leave['totaldays']==0.5):?>
                                            <td><?php echo 'Half-day'; ?>&nbsp;</td>
                                            <?php else:?>
                                            <td><?php echo h($leave['totaldays']); ?>&nbsp;</td>
                                            <?php endif;?>
                                            <td></td>
                                    <?php endif;?>
                            </tr>
                        <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, 
		showing {:current} records out of {:count} total, 
		starting on record {:start}, 
		ending on {:end}')
	));
	?>	
	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h2><?php echo __('Leaves'); ?></h2>
	<?php echo $this->Form->create(); ?>
		<?php echo $this->Form->input('user_id',array('id'=>'user-dropdown-leave','type' => 'select','label'=>'','empty' => 'SELECT EMPLOYEE')); ?>
		<?php echo $this->Form->end(); ?>
</div>


