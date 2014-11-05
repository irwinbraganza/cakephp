<style type="text/css">
#eventdata{
    display: none;
    position: fixed;
    
    width: 100%;
    height: 100%;
        
    top:  0px;
    left: 0px;
    
    background: url(img/opac.png);
    z-index: 10000 !important;
}
</style>

<script type='text/javascript'>
    $(document).ready(function() {
        $('#calendar').fullCalendar({

            eventSources: [

            // source with no options
           "<?=Router::url(array('controller' => 'events', 'action' => 'feeds'))?>",

            // source with no options

            "<?=Router::url( $url='www.google.com/calendar/feeds/en.indian%23holiday%40group.v.calendar.google.com/public/basic')?>"
            
        ]
             ,
            dayClick: function(date, allDay, jsEvent, view){
                $("#eventdata").show();
                $("#eventdata").load("<?=Router::url(array('controller' => 'events', 'action' => 'add'))?>/"+allDay+"/"+$.fullCalendar.formatDate( date, "dd/MM/yyyy/HH/mm"));
            },
            eventClick: function(calEvent, jsEvent, view){
                $("#eventdata").show();
                $("#eventdata").load("<?=Router::url(array('controller' => 'events', 'action' => 'edit'))?>/"+calEvent.id);
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
                
                $.post('<?=Router::url(array('controller' => 'events', 'action' => 'save'))?>', {data: event}, function(data) {
                    handleResponse(data);
                });
            },
            eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
                event.dayDelta = dayDelta;
                event.minuteDelta = minuteDelta;
                event.drop = true;
                
                $.post('<?=Router::url(array('controller' => 'events', 'action' => 'save'))?>', {data: event}, function(data) {
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
            $('#EventTitle').after('<div class="error-message">'+data.fields.title+'</div>');
        }else{
            $('#eventdata').hide();
            $('#calendar').fullCalendar('refetchEvents');
        }  
    }
</script>
<div id="calendar"></div>
<div id="eventdata"></div>