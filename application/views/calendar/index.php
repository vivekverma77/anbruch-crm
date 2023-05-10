<!--calendar css-->
<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.min.css">
<link href="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.css"  rel="stylesheet" type="text/css"/>
<style> 
#editClassSchedule .modal-content { 
    box-shadow: none;
    border: none;
    width: 800px;
    min-height: 500px;
    left: -100px;
}
.fc-event {
    border-style: none;
    cursor: pointer;
  }
  .service-box label {
   font-weight: 600;
   font-family: 'Open Sans',sans-serif;
   font-size: 1.6rem;
   color: #000;
   width: 35%;
}
.service-box span {
   font-size: 1.6rem;
   margin-bottom: 8px;
   display: inline-block;
}
.hr-4{
    border-top: 4px solid #1FB5AD;
  }
  
  .reassign button {
   padding: 0px 6px;
    font-size: 12px;
    margin-left: 5px;
}
.modal-backdrop + .modal-backdrop + .modal-backdrop.fade.in {
  z-index: 1050;
}
.modal.in + .modal.in + .modal.in {
  z-index: 1052;
}
#add_calendar {background-color: #646464 !important;margin-left: 10px;}
#calendar-listing-btn {color: #7f7675 !important;background-color: #fff !important;}
#calendar-listing.dropdown-menu li {padding: 7px;border: 1px solid #ddd;}
#calendar-listing.dropdown-menu li:hover {cursor: pointer;border-bottom:0; }
#calendar-listing.dropdown-menu li span {margin-left: 15px;}
.eventView-row {padding:8px 15px;}
.eventView-row + .eventView-row {border-top:1px solid #eee;}
.custom-row:nth-child(even) {background:#fafafa;}
.eventView-row .custom-row label {padding:0 7px; display:inline-block; float:left;}
.ui-timepicker-container {z-index: 9999 !important;}
.pac-container.pac-logo {z-index: 9999;}
.has-toolbar.fc {margin-top: 0;}
.fc-view-container .fc-view {margin-top: 10px !important;}
#cal-list {display: inline-block;margin-left: 0px;margin-bottom: -10px;}
</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        
        <?php $this->load->view('common/alert');?>
        
        <section class="panel">
            <header class="panel-heading selUser">
             <ul class="nav top-menu" id="cal-list"> 
              <li class="dropdown">
                  <a href="#" data-toggle="dropdown" class="btn dropdown-toggle" id="calendar-listing-btn" title="Choose calendar">My Calendars <i class="fa fa-caret-down"></i></a>
                  <ul class="dropdown-menu extended" id='calendar-listing'>
                    <li class="estimator-all" style="background: #000;"><input type="checkbox" class="check_all" value="all" checked /><span class="prevent-checkbox"></span><span>All</span></li>
                    <?php 
                     if(!empty($calendars))
                     {
                      foreach ($calendars as $key => $estimator) 
                      {
                      ?>
                      <li class="estimator-list" id="<?php echo 'estId_'.$estimator['id'];?>"  style="background: <?php echo $estimator['color'];?>"> <input type="checkbox" class="est_checkbox" value="<?php echo $estimator['id'] ?>" />
                        <span class="prevent-checkbox"></span>
                        <span><?php echo $estimator['name'];?></span>
                      </li>
                    <?php    
                      }
                     }
                     ?>
                  </ul>
             </li>
            </ul>                   
            <a class="btn add_calendar" id="add_calendar" href="<?php echo base_url('calendar/createcalendar');?>"><i class="fa fa-calendar-plus"> </i> Add Calendar</a>      
            <script type="text/javascript">
            $(document).ready(function() {
                //$("#own").select2();
                $('.popular-list').fSelect();
            });
            </script> 
            </header>
            <div class="panel-body">
                <!-- page start-->
                <div class="row">
                  
                    <aside class="col-lg-12">
                        <div id="calendar" class="has-toolbar"></div>
                    </aside>                   
                    
                </div>
                <!-- page end-->
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!-- Add Event Modal start-->
<div id="dialog" class="container modal fade" role="dialog">
<div class="modal-dialog">  
 <div class="modal-content">
  <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('assets/images/close-icon2.png');?>" width="25" title="close" alt="close"></button>
    <h4 class="modal-title">Add Event</h4> 
 </div>
 <div class="modal-body">
 <form action="<?php echo base_url('calendar/add');?>" method="post" id="addForm">
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required="">
    </div>
      <div class="row no-margin">
        <div class="col-sm-8 col-xs-12 col-left">
         <div class="form-group">
          <label for="startDay">Start Date:</label>
          <input type="text" class="form-control datepicker" id="startDay" placeholder="mm/dd/yy" name="startDay" required="" autocomplete="off">
        </div>
        </div>
        <div class="col-sm-4 col-xs-12 col-right">
         <div class="form-group">
          <label for="startTime">Start Time:</label>
          <input type="text" class="form-control timepicker" id="startTime" placeholder="HH:MM" name="startTime" required>
        </div>
        </div>
    </div> <!-- /.row -->
    <div class="row no-margin">
        <div class="col-sm-8 col-xs-12 col-left">
        <div class="form-group">
          <label for="endDay">End Date:</label>
          <input type="text" class="form-control datepicker" id="endDay" placeholder="mm/dd/yy" name="endDay" autocomplete="off">
        </div>
        </div>
        <div class="col-sm-4 col-xs-12 col-right">          
        <div class="form-group">
          <label for="endTime">End Time:</label>
          <input type="text" class="form-control timepicker" id="endTime" placeholder="HH:MM" name="endTime">
        </div>
        </div>
    </div>
    <div class="form-group text-center">
      <label><input type="checkbox" name="allDay" value="1"> All Day Event</label>
    </div>
     <div class="form-group">
      <label for="estimator">Calendar:</label>
      <select class="form-control" name="estimator" id="estimator">
         <?php 
         if(!empty($calendars))
         {
          foreach ($calendars as $key => $estimator) 
          {
          ?>
          <option value="<?php echo $estimator['id']?>" style="background: <?php echo $estimator['color'];?>;color: #fff;"><?php echo $estimator['name'];?></option>
        <?php    
          }
         }
         ?>
      </select>
    </div>
    <div class="form-group">
      <label for="jobAddress">Location:</label>
      <input type="text" class="form-control location-input location" id="location" placeholder="Add Location" name="jobAddress">
    </div>
    <!-- <div class="form-group">
      <label for="repeat">Repeat:</label>
      <select class="form-control" name="repeat" id="repeat">
        <option value="">None</option>
        <option value="1">Every day</option>
        <option value="2">Every week</option>
      </select>
    </div> -->
  </form>
  <img src="<?php echo base_url('assets/img/ajax-loader.gif');?>" class="loader upload-loader ajax-load" style="display: none;">
 </div> 
  <div id="submitEvent" class="modal-footer">
    <a type="button" class="moreOption btn btn-info">More options</a>  
    <button type="button" id="addEvent" class="btn btn-success">Save</button>
  </div>
 </div>
</div>
</div> 
<!-- Add Event Modal end-->
<!-- event view popup start-->
<div class="modal fade" id="eventView" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Event</h4>
      </div>
      <div class="modal-body">
         <div class="row eventView-row"> <label>Name :</label> <span class="jobName"></span> </div>
         <div class="row eventView-row"> <label>Location :</label> <span class="address"></span> </div>
         <div class="row eventView-row"> <label>Calendar :</label> <span class="estimator"></span> </div>
         <div class="row eventView-row"> <label>All Day Event :</label> <span class="allDay"></span> </div>
         <div class="row eventView-row"> <label>Repeat :</label> <span class="repeat"></span> </div>
         <div class="row eventView-row col-md-6"> <label>Start Date :</label> <span class="startDay"></span> </div>
         <div class="row eventView-row col-md-6"> <label>Start Time :</label> <span class="startTime"></span> </div>
         <div class="row eventView-row col-md-6"> <label>End Date :</label> <span class="endDate"></span> </div>
         <div class="row eventView-row col-md-6"> <label>End Time :</label> <span class="endTime"></span> </div>
         <div class="row eventView-row"> <label>Description :</label> <span class="jobNotes"></span> </div>
         <button data-target="#invitation-listing" data-toggle="collapse" title="See Invitations" class="btn btn-warning">See Invitations</button>
         <div id='all_invitations'>
            <div class="dropdown invitation-dropdown">
              <ul class="dropdown-menu invitation-listing" id='invitation-listing'></ul>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary eventEvent" data-dismiss="modal" data-toggle="modal" data-target="#dialog2">Edit Event</button>
        <button type="button" class="btn btn-danger deleteEvent">Delete Event</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/fullcalendarv3.min.js"></script>
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.js"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script src="<?php echo base_url('assets/js/jquery.minicolors.min.js');?>"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.timepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJvYo3Q_da2bW6u08Pf6MMGF49OQYGirE&libraries=places&callback=initAutocomplete"
        async defer></script> 
<script>
$(document).ready(function(){
var base_url = '<?php echo base_url();?>';  
var curSource = '<?php echo base_url() ?>calendar/getJobsEvent';
    $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
           // minTime: '7:00',
           // maxTime:"24:00:00",
            editable: false,
            droppable: false,
            dragRevertDuration: 0,
          eventDrop: function(event, delta, revertFunc) {
                if (!confirm("Are you sure about this change?")) {
                   revertFunc();
                }else{
                // alert(event.title + " was dropped on " + event.start.format());
                 var event_id = event.id;
                 var drop_on_date = event.start.format('YYYY-MM-DD');
                 var drop_on_time = event.start.format('h:mm a');
                 dropEvent(event_id,drop_on_date,drop_on_time);
                }   
            },    
            eventLimit: true, // for all non-agenda views
            eventSources: [
                {
                    events: function (start, end, timezone, callback) {
                        $.ajax({
                            url: curSource,
                            method:'post',
                            dataType: 'json',
                            data: {
                               // start: start.unix(),
                               // end: end.unix(), 
                                est_Ids: estimator_ids,
                            },

                            success: function (msg) {
                              //  console.log(msg);
                                var events = msg.events;
                                console.log(events);
                                callback(events);
                            }
                        });
            
                    }

                },
            ],
           /* events: [{
            id: 1,
            title:"Front End",
            start:'2019-01-16 10:00', 
            end:  '13:00', 
             dow: [2,4],
               }
            ],*/
             eventAfterRender:function( event, element, view ) {
               //console.log(event);
               //console.log(element);
             //  console.log(view);
             },
             eventClick: function(event) {  
              console.log(event);
                  $("#dialog2 #jobName").val(event.title);
                  $("#dialog2 #jobAddress2").val(event.job_address);
                  $("#dialog2 #arrivalTime").val(event.arrival_time);
                  var estimator_id = event.estimator_id;
                  $("#dialog2 #estimator option[value='"+estimator_id+"']").attr("selected","selected");
                  $("#dialog2 #viewStartDay").val(event.start.format('YYYY-MM-DD'));
                   $("#dialog2 #jobNotes").val(event.description);
                  $("#dialog2 #ViewEndDay").val(event.end_date);
                  $("#dialog2 #job_event_id").val(event.id);
                  if(event.allDayEvent == 1)
                  {
                     $("#dialog2 #allDay").attr("checked",true);
                  }
                  $("#dialog2 #startTime").val(event.startTime);
                  if(event.endTime)
                  {
                     $("#dialog2 #endTime").val(event.endTime);
                  }else
                  {
                    $("#dialog2 #endTime").val(event.endTime.add(1,"h"));
                  }
            
                $("#eventView .jobName").text(event.title);
                $("#eventView .address").text(event.job_address);
                $("#eventView .arrivalTime").text(event.arrival_time);
                var estimator_id = event.estimator_id;
                if(estimator_id > 0)
                {
                  var estimatorName = $("#dialog #estimator option[value='"+estimator_id+"']").text();
                 $("#eventView .estimator").text(estimatorName);
                }
                 $("#eventView .startDay").text(event.start.format('YYYY-MM-DD'));
                 $("#eventView .jobNotes").text(event.description);
                 $("#eventView .endDate").text(event.end_date);
                 if(event.allDayEvent == 1)
                 {
                   $("#eventView .allDay").text('Yes');
                 }else
                 {
                 $("#eventView .allDay").html('No');
                 } 
                $("#eventView .startTime").text(event.startTime);
                $("#eventView .endTime").text(event.endTime);
                $("#dialog2 #repeat option[value='"+event.repeat_type+"']").attr("selected","selected");
                $("#eventView").modal("show");
                console.log(event.invitations);
                var invitees = event.invitations;
                if(invitees.length)
                {
                  var html="";
                  $.each(invitees,function(index, data){
                    //$("#all_invitations")
                    var email = data.sent_email;
                    var name   = email.substring(0, email.lastIndexOf("@"));
                    html += '<li class="invite-list"><label class="email_id">'+name+': </label>';
                    switch(parseInt(data.status)) {
                                case 1:
                                  html += '<span class="email_status alert-info"> Pending</span>'
                                  break;
                                case 2:
                                   html += '<span class="email_status alert-success"> Accepted</span>'
                                  break;
                                case 3:
                                   html += '<span class="email_status alert-danger"> Rejected</span>'
                                  break;  
                                default:
                                  // code block
                              }
                    
                   html +=  '</li>'


                  });
                  
                }else
                {
                  html = '<li class="invite-list"><label class="no-invite">No invitation available.<li>'
                }
                $(".invitation-listing").html(html);
               // alert(event.repeat_type);
                switch(parseInt(event.repeat_type)) {
                  case 1:
                    $("#eventView .repeat").text("Every Day");
                    break;
                  case 2:
                      $("#eventView .repeat").text("Every Week");
                    break;
                  case 3:
                     //$("#eventView .repeat").text("Every Day");
                    break;  
                  default:
                   $("#eventView .repeat").text("None");
                }
              return false;
        },
        dayClick: function(date, jsEvent, view) {
           $("#dialog").modal("show");
           console.log(date);
          console.log('Clicked on: ' + date.format('h(:mm)t'));
          console.log('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
          console.log('Current view: ' + view.name);
          //$( "#dialog" ).dialog();
          $('#dialog .datepicker').val( date.format('MM/DD/YYYY'));
          $('#dialog #startTime').val( date.format('h:mm a'));
          var endDate = date.add(1,"h");
          $('#dialog #endTime').val( endDate.format('h:mm a'));
        },

    });
  var estimator_ids = [];  
$('.estimator-all').click(function(){
  $(this).find('input').click();
});
 $('.estimator-list').click(function(){
    var estId = $(this).attr('id');
    $('#'+estId).find('input').click();
    $(this).toggleClass('check');
  });
  /*Filter by estimators */
  $('.estimator-list input.est_checkbox').change(function()
  {
    $('.estimator-all .check_all').attr('checked',false);
    $(this).each(function()
    {
       if($(this).prop("checked") == true)
      {
        estimator_ids.push($(this).val());
      }else
      {
        estimator_ids.splice(estimator_ids.indexOf($(this).val()),1);
      }    
    });
    console.log(estimator_ids);
    $('#calendar').fullCalendar('refetchEvents');
  });
$(".datepicker").datepicker();
$("input.timepicker").timepicker({
    timeFormat: 'h:mm a',
    interval: 30,
    //minTime: '10',
  });
 /*More options*/
 $(".moreOption").click(function(){
  $("#addForm").attr("action",base_url+"calendar/eventadd");
  $("#addForm").submit();
 });
});

/*Google place Autocomplete */
var placeSearch, autocomplete;
  function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('location')),
        {types: ['geocode']});
  }

</script>
