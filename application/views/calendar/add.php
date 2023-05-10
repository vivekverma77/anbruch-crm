<!--calendar css-->
<link href="<?php echo base_url() ?>static/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.min.css">
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>
<link href="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.css"  rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.js"></script>

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
#add_calendar {background-color: #646464 !important;}
#calendar-listing-btn {color: #000;background-color: #fff;}
#calendar-listing.dropdown-menu li {padding: 7px;border: 1px solid #ddd;}
#calendar-listing.dropdown-menu li:hover {cursor: pointer;border-bottom:0; }
#calendar-listing.dropdown-menu li:active {filter: invert(100%);}
#calendar-listing.dropdown-menu li span {margin-left: 15px;}
.eventView-row {padding:8px 15px;}
.eventView-row + .eventView-row {border-top:1px solid #eee;}
.custom-row:nth-child(even) {background:#fafafa;}
.eventView-row .custom-row label {padding:0 7px; display:inline-block; float:left;}
.ui-timepicker-container {z-index: 9999 !important;}
.pac-container.pac-logo {z-index: 9999;}
</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        
        <?php $this->load->view('common/alert');?>
        
        <section class="panel">
            <header class="panel-heading selUser">Add Event
            </header>
            <div class="panel-body">
                <!-- page start-->
                <div class="row">
                  <aside class="col-lg-12">
                    <form action="<?php echo base_url('calendar/add');?>" method="post" id="addForm">
                    <div class="form-group">
                      <label for="title">Title:</label>
                      <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required="" value="<?php echo isset($eventData['title']) ? $eventData['title']:''; ?>">
                    </div>
                        <div class="row no-margin">
                        <div class="col-sm-8 col-xs-12 col-left">
                         <div class="form-group">
                          <label for="startDay">Start Date:</label>
                          <input type="text" class="form-control datepicker" id="startDay" placeholder="mm/dd/yy" name="startDay" required="" autocomplete="off" value="<?php echo isset($eventData['startDay']) ? $eventData['startDay']:''; ?>">
                        </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-right">
                         <div class="form-group">
                          <label for="startTime">Start Time:</label>
                          <input type="text" class="form-control timepicker" id="startTime" placeholder="HH:MM" name="startTime" required value="<?php echo isset($eventData['startTime']) ? $eventData['startTime']:''; ?>" autocomplete="off">
                        </div>
                        </div>
                    </div> <!-- /.row -->
                    <div class="row no-margin">
                        <div class="col-sm-8 col-xs-12 col-left">
                        <div class="form-group">
                          <label for="endDay">End Date:</label>
                          <input type="text" class="form-control datepicker" id="endDay" placeholder="mm/dd/yy" name="endDay" autocomplete="off" value="<?php echo isset($eventData['endDay']) ? $eventData['endDay']:''; ?>" >
                        </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 col-right">          
                        <div class="form-group">
                          <label for="endTime">End Time:</label>
                          <input type="text" class="form-control timepicker" id="endTime" placeholder="HH:MM" name="endTime" value="<?php echo isset($eventData['endTime']) ? $eventData['endTime']:''; ?>" autocomplete="off">
                        </div>
                        </div>
                    </div>
                   <div class="row no-margin"> 
                    <div class="col-sm-8 col-xs-12 col-left">
                     <div class="form-group"> 
                      <label for="timezones" >Time zone</label>
                      <?php $default = date_default_timezone_get();?>
                      <select class="form-control" name="timezones" id="timezones">
                       <?php foreach(tz_list() as $t) { ?>
                        <option value="<?php print $t['zone'] ?>" <?php echo ($default == $t['zone'] ? 'selected' : '');  ?>>
                          <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                        </option>
                      <?php } ?>
                      </select>
                     </div> 
                    </div>
                    <div class="col-sm-4 col-xs-12 col-right">
                     <div class="form-group text-left" style="    margin-top: 23px;">
                      <label><input type="checkbox" name="allDay" value="1" <?php echo isset($eventData['allDay']) && $eventData['allDay'] == 1 ? 'checked':''; ?> > All Day Event</label>
                     </div> 
                    </div>
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
                          <option value="<?php echo $estimator['id']?>" style="background: <?php echo $estimator['color'];?>;color: #fff;" <?php echo isset($eventData['estimator']) && $eventData['estimator'] == $estimator['id'] ? 'selected':''; ?>><?php echo $estimator['name'];?></option>
                        <?php    
                          }
                         }
                         ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="jobAddress">Location:</label>
                      <input type="text" class="form-control location-input location" id="location" placeholder="Add Location" name="jobAddress" value="<?php echo isset($eventData['jobAddress']) ? $eventData['jobAddress']:''; ?>">
                    </div>
                    <button type="submit" id="submit" class="btn btn-success">Save</button>
                  </form>
            </aside>                      
          </div>
          <!-- page end-->
          </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<?php
function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}
?>
<script src="<?php echo base_url(); ?>assets/js/jquery.timepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJvYo3Q_da2bW6u08Pf6MMGF49OQYGirE&libraries=places&callback=initAutocomplete"
        async defer></script> 
<script>
$(document).ready(function(){
$(".datepicker").datepicker();
$("#timezones").select2();
$("input.timepicker").timepicker({
    timeFormat: 'h:mm a',
    interval: 30,
    //minTime: '10',
  });
  $( "#addEvent" ).click(function() {
      //alert( "Valid: " + form.valid() );
      if(form.valid())
      {
       $('.ajax-load').show();
       $('#addForm').ajaxSubmit({
                  dataType: 'json',
                  success: function (data) {
                      if (typeof data != 'undefined' && typeof data.message != 'undefined' && data.message != 'undefined' && data.success == true) {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-success alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Success! </strong>'+ data.message + '</div></div>';
                          $('#dialog').modal("hide");
                          $('.flash-message').html(html);
                           autoDismissAlert();
                          $('#calendar').fullCalendar('refetchEvents');
                          $('#addForm')[0].reset();
                          $('#installer').val(null).trigger('change');
                          $('.ajax-load').hide();
                      }else if(typeof data != 'undefined'  && data.success != 'undefined' && data.success == false)
                      {
                        var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                           autoDismissAlert();
                          $('.ajax-load').hide();
                      }                        
                     
                  },
                  error: function(data){
                    if (typeof data != 'undefined') {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>There are some problems to perform this action.</div></div>';
                          $('.flash-message').html(html);
                           autoDismissAlert();
                          $('.ajax-load').hide();
                         } 
                  }  
              });
      }
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
