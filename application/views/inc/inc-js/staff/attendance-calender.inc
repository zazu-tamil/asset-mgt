<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>asset/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  
<!-- fullCalendar -->
<script src="<?php echo base_url() ?>asset/bower_components/moment/moment.js"></script>
<script src="<?php echo base_url() ?>asset/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
 
<!-- Page specific script -->
<script>
  $(function () { 
    
    function datetimeLocal(datetime) {
        const dt = new Date(datetime);
        dt.setMinutes(dt.getMinutes() - dt.getTimezoneOffset());
        return dt.toISOString().slice(0, 16);
    }

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
     
      header    : {
        left  : '',
        center: 'title',
        //right : 'month,agendaWeek,agendaDay'
        right : ''
      },
      buttonText: { 
       // today: 'Today',
        //month: 'Month',
       //  week : 'week',
       //  day  : 'day'
      },
      //Random default events
     eventSources: [
     {
        url: '<?php echo site_url('get-calender-data');?>',
        type: 'POST',
        data: {
          custom_param1: 'leave-request-calender',
          custom_param2: '<?php echo $emp_id; ?>',
          custom_param3: '<?php echo $c_mon; ?>',
          custom_param4: '<?php echo $c_mon; ?>',
        },
        failure: function() {
          alert('there was an error while fetching events!');
        },
        
      }, 
      
      {
        url: '<?php echo site_url('get-calender-data');?>',
        type: 'POST',
        data: {
          custom_param1: 'holidays-list',
          custom_param2: '<?php echo $this->session->userdata(SESS_HD . 'ref_id'); ?>'
        },
        failure: function() {
          alert('there was an error while fetching events!');
        },
         
      },
      
      {
        url: '<?php echo site_url('get-calender-data');?>',
        type: 'POST',
        data: {
          custom_param1: 'attendance',
          custom_param2: '<?php echo $emp_id; ?>',
          custom_param3: '<?php echo $c_mon; ?>',
         // custom_param4: '<?php echo $c_mon; ?>'
        },
        failure: function() {
          alert('there was an error while fetching events!');
        },
         
      },
      
      {
        url: '<?php echo site_url('get-calender-data');?>',
        type: 'POST',
        data: {
          custom_param1: 'salary-advance',
          custom_param2: '<?php echo $emp_id; ?>',
          custom_param3: '<?php echo $c_mon; ?>',
        },
        failure: function() {
          alert('there was an error while fetching events!');
        },
         
      },
      
      ], 
      
      eventRender: function(eventObj, $el) {
        $el.popover({
          title: eventObj.title,
          content: eventObj.description,
          trigger: 'hover',
          placement: 'top',
          html: true,
          container: 'body'
        });
      },
      
      
      eventClick: function(calEvent, jsEvent, view) {

       // alert('Event: ' + calEvent.id);
       // alert('Event: ' + calEvent.tbl);
       // alert('Event: ' + calEvent.tbl);
     /*   if(calEvent.tbl == 'H'){
            
            var mdl_id = "#" + calEvent.tbl + "_modal";
            
            $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'holidays_info', id: calEvent.id },
                success: function(d) {                                 
                    // alert(d);
                    $(mdl_id + ' #holiday_id').val(d.holiday_id) ; 
                    $(mdl_id + ' #holiday_date').val(d.holiday_date) ; 
                    $(mdl_id + ' #holiday_det').val(d.holiday_det) ; 
                    $(mdl_id + ' input:radio[value="'+ d.status +'"]').prop('checked', true);  
                    $(mdl_id).modal('show'); 
                }
            }); 
            
        } */
        
        if((calEvent.tbl == 'A') ){ //alert(calEvent.id);
            
            var mdl_id = "#" + calEvent.tbl + "_modal"; //alert(mdl_id ); $(mdl_id).modal('show'); 
            
            $.ajax({ 
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'emp_attendance_info', id: calEvent.id },
                success: function(d) {                                 
                    // alert(d.employee_code + " || "  + d.in_time);
                    $(mdl_id + ' #emp_attendance_id').val(d.emp_attendance_id) ; 
                    $(mdl_id + ' #employee_code').val(d.employee_code) ; 
                    $(mdl_id + ' #in_time').val(datetimeLocal(d.in_time)) ; 
                    $(mdl_id + ' #out_time').val(datetimeLocal(d.out_time)) ;  
                    $(mdl_id).modal('show'); 
                }
            }); 
            
        }
       
        
        if((calEvent.tbl == 'L') && ((calEvent.status == 'Pending') || (calEvent.status == 'Revise'))){ //alert(calEvent.status );
            
            var mdl_id = "#" + calEvent.tbl + "_modal";
            
            $.ajax({
               // url: "send-enquiry.php",
                url: "<?php echo site_url('get-data');?>",
                type: "post",
                data: { tbl : 'staff_leave_request_info', id: calEvent.id },
                success: function(d) {                                 
                    // alert(d);
                    $(mdl_id + ' #leave_request_id').val(d.leave_request_id) ; 
                    $(mdl_id + ' #leave_date').val(d.leave_date) ; 
                    $(mdl_id + ' #reason').val(d.reason) ; 
                    $(mdl_id + ' #comments').val(d.comments) ; 
                    $(mdl_id + ' input:radio[value="'+ d.leave_type +'"]').prop('checked', true);  
                    $(mdl_id + ' input:radio[value="'+ d.status +'"]').prop('checked', true);  
                    $(mdl_id).modal('show'); 
                }
            }); 
            
        }
        
       // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
      //  alert('View: ' + view.name);
    
        // change the border color just for fun
        $(this).css('border-color', 'red');
    
      },
      
      /*  events : [
                {   
                    title:"Medical Leave",
                    start:"2024-10-16",
                    end:"2024-10-18T11:00:00"
                },
                {
                    title:"Casual Leave",
                    start:"2024-10-30",
                    end:"2024-10-31"
                }
        ],
         
     /*
       events : [
                    <?php if(isset($leave_req)) {?>
                    <?php foreach($leave_req as $info){ ?>
                     {
                        title          :  '<?php echo $info['title'] ;?>',
                        start          :  '<?php echo $info['start'] ;?>',
                        end            :  '<?php echo $info['end'] ;?>',
                        backgroundColor: '#800080',  
                        borderColor    : '#FFF'  
                      }, 
                    <?php  } }   ?>
                    ],
       */             
      // events    : [
        <?php /* foreach($room_booked as $info){ ?>
          {
            title          :  '<?php echo $info['room'] . " - " . $info['title'] ;?>',
            start          :  '<?php echo date('Y-m-d',strtotime($info['chkin_date']));?>',
            end            :  '<?php echo date('Y-m-d',strtotime($info['chkout_date']));?>',
            backgroundColor: '<?php echo  "#" . $info['bg']?>',  
            borderColor    : '#FFF'  
          },  
        <?php  }  */ ?>
        /*{
          title          : 'All Day Event',
          start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        {
          title          : 'Long Event',
          start          : new Date(y, m, d - 5),
          end            : new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
        {
          title          : 'Meeting',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }*/
     // ],
      //contentHeight: 1000,
      editable  : false,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      /*drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      } */
    });
     
      $('#calendar').fullCalendar( "gotoDate", '<?php echo $c_mon; ?>');

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>