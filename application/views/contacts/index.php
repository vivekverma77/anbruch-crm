<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.min.css">
<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>

<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>

<style>
td.status_col span {font-size:0; padding:6px; position:relative; cursor:pointer; z-index:1; border-radius:50px;}
td.status_col .info-warning {background:#673AB7;}
td.status_col .info-danger {background:#ff5722;}
td.status_col span:before {content:'Cancelled'; font-size:13px; position:absolute; color:#fff; top:0px; background:#73879f; padding:4px 10px; border-radius:2px; left:-34px; letter-spacing:.5px; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
td.status_col .info-warning:before {content:'New'; left:-17px;}
td.status_col .info-success:before {content:'Confirmed'}
td.status_col span:hover:before {top:14px; opacity:1;}
.ui-datepicker-header {background:#fe832c;}
.panel-heading div {display: inline-block;}
td.no-record {text-align: center;font-size: 16px;}
.left {float: left;width: 50%;margin-bottom: 15px;margin-left: 75px;}
.pagination {vertical-align:middle;display: inline-block;padding-left: 0;margin: 5px 0;border-radius: 4px;}
.sel select {border: none;border-radius: 4px;background: #eff2f7;padding:7px 20px;}
header {top:0;}
#main-content section.wrapper {display:block;}
i.fa.fa-sort { float: right; }
.uper-total{margin:20px 10px 25px 0px;}
.btn-yellow-o {color: #ff9800;border: 1px solid #ff9800;background: #fff8e1;}
.btn-yellow-o:hover {color: #fff;background: #ff9800;}
.btn-yellow-o:focus {color: #fff;background: #ff9800;}
.btn-blue-o {color:#03a9f4;border: 1px solid #03a9f4;background:#03a9f42b;}
.btn-blue-o:hover {color: #fff;background: #03a9f4;}
.btn-blue-o:focus {color: #fff;background: #03a9f4;}
.btn-fill-blue {background: #03a9f4;}

#editClassScheduleNew .event-day-time, #addClassSchedule  .event-day-time{
margin-left: 1px;
}
#addClassSchedule .file_uploader, #editClassScheduleNew .file_uploader {border: 2px dashed #1eb5ad;background: #f1f3f4;padding: 6px;position: relative;text-align: center;top: -100px;left: 280px;font-size: 13px;width: 220px;color: #16514e;
}
#addClassSchedule .wrapper ,#editClassScheduleNew .wrapper{
position: absolute;right: 0;
}
#addClassSchedule .file_uploader input, #editClassScheduleNew .file_uploader input {position: absolute;width: 100%;height: 100%;left: 0;top: 0;opacity: 0;cursor: pointer;
}
#editClassScheduleNew span.close-modal:before,#addClassSchedule span.close-modal:before{top: 19px;left: 12px;
}
#editClassScheduleNew span.close-modal:after,  #addClassSchedule span.close-modal:after{ top: 19px;left: 12px;
}
#addClassSchedule .file_uploader, #editClassScheduleNew .file_uploader {border: 2px dashed #1eb5ad;background: #f1f3f4;padding: 6px;position: absolute;text-align: center;top: 3px;left: 315px;font-size: 13px;width: 220px;color: #16514e;
}
.close-div {position: relative;z-index: 130;top: 0px;cursor: pointer;width: 40px;height: 40px;float: left;font-size: 25px;left:0px;margin-left:-5px !important;
}
.save-btn {width: 100px;height: 45px;font-size: 135%;background-color:#fe832c;color: white;border: 0px;border-radius: 8%;color: #fff;margin-top:-5px;
}
.tab-title{color:#fe832c !important;}
.event-day-time input {width: 110px;margin-right: 8px;display: inline-block;
}
.location-div {padding-right: 0px !important;width: 92%;
}
.location-input {padding-right: 40px;
}.location-icon {float: right;margin-top: -33px;margin-right: 1px;color: #fff;background: #1eb5ad;height: 32px;width: 32px;text-align: center;line-height: 36px;font-size: 24px;cursor: pointer;opacity: .8;
}
.first-part{margin-top:20px;}
.event-day-time{margin-left:40px;}
.reminder-n-guests{margin-top:25px;}
.scroller{height:300px;min-height:300px;overflow-y:scroll;overflow-x:hidden;}
#bookingModal .close{font-size:35px;}
.scroller::-webkit-scrollbar {
width: 8px;
background-color:#fe832c; }
.scroller::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color:#fe832c; }
.ui-timepicker-container.ui-timepicker-standard{z-index:9999 !important;}.fc .fc-today-button {margin-left: 10px;color: #5a6766;border-radius: 4px;background-color: #f3f3f3 !important;text-shadow: none;text-transform: capitalize;padding: 0px 20px 2px;border: 1px solid #f3f3f3;
}
.fc .fc-state-disabled {background: #fff !important;color: #5a6766 !important;border: 1px solid;opacity: 1;
}
.fc-toolbar .fc-right .fc-button-group .fc-button {border: 1px solid #f3f3f3;
}
.fc .fc-button-group .fc-prev-button, .fc .fc-button-group .fc-next-button {border-radius: 25px;width: 27px;height: 27px;background: transparent !important;box-shadow: none;
}
.fc-toolbar h2 {font-size: 25px;color: #5a6766;
}
.fc-toolbar.fc-header-toolbar {padding: 15px 0px 0px;
}.fc-toolbar .fc-center {margin: 5px 14px;
}
.fc-view-container {margin-top: 60px !important;
}
.fc-scroller {overflow-y: scroll !important;height: 275px !important;
}
.fc-scroller::-webkit-scrollbar {
width: 8px;
background-color:#fe832c !important; }
.fc-scroller::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color:#fe832c !important; }
.select2-div{margin-top:39px;}
.has-toolbar.fc{margin-top:0px !important;}
button.fc-prev-button:hover, button.fc-next-button:hover {color: #fe832c !important;border-color: #fe832c !important;
}
.fc button .fc-icon{margin:0 -4px !important;}
.fc-today-button:hover {color: #fe832c !important;border-color: #fe832c !important;
}
.col-reminder .form-control{width:97% !important;}
/*.fc-axis.fc-widget-content{width:52px !important;}*/
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">
        <?php $this->load->view('common/alert'); ?>
        <div class="row">
			<div class="col-sm-12">
				<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Contacts </span></h3>
                <!-- panel start -->
				<section class="panel">
                    <div class="row uper-total">
                        <div class="col-sm-6">
                            <form name="frmDates" id="frmDates" method="get" action="<?php echo base_url();?>Contacts/index/1">
                                <input type="hidden" id="order_by" name="order_by" value="<?php echo $order_by; ?>" />
                                <input type="hidden" id="order" name="order" value="<?php echo $order; ?>" />
                                <div class="sel" style="display:inline;">
                                    <select name="sel" onchange="form.submit()">
                                        <option value="5" <?php if($sel == "5") echo "selected"; ?>>5</option>
                                        <option value="10" <?php if($sel == "10") echo "selected"; ?>>10</option>
                                        <option value="20" <?php if($sel == "20") echo "selected"; ?>>20</option>
                                        <option value="50"<?php if($sel == "50") echo "selected"; ?>>50</option>
                                        <option value="100"<?php if($sel == "100") echo "selected"; ?>>100</option>
                                    </select>
                                </div>
                                <a class="btn btn-round btn-yellow-o" title="Delete" href="javascript:void(0)" id="contact_delete_btn" style="font-size:1.1em;margin-left:5px"><i class="fa fa-trash"></i> Delete</a>
                                <a class="btn btn-round btn-blue-o" title="Add Booking" href="javascript:void(0)" id="add-to-booking" style="margin-left:5px;font-size:1.1em;"> <i class="fa fa-calendar"></i> Book Now</a>
                            </form>
                            
                        </div> 
					   <div class="col-sm-6" style='text-align:right;'>
						 <span style="padding:0 10px;"> Total Records: <?php echo $total_record;?> </span>
                          <?= $pagination; ?>
					   </div>
                    </div>

					
					<div class="panel-body">
                        <div style="overflow:auto; padding-bottom:20px; width:96%;margin:0 auto;">
                            <table class="display table new-table table-striped table-condensed" id="dynamic-table">
                                <thead>
                				    <tr>
                                    	<th nowrap="nowrap">
                                            <label style="cursor:pointer;">
                                                <input type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;">
                                                <span class="input-checkbox-icon" style="left:5px;top:8px; margin:0 6px 6px 0;"></span>
                                            </label>
                                        </th>
										<th nowrap="nowrap" >Name </i></th>
                                        <th nowrap="nowrap" >Company Name </i></th>
										<th nowrap="nowrap" >Email </th>
										<th nowrap="nowrap">Phone</th>
                                        <th nowrap="nowrap">Country</th>
                                        <th nowrap="nowrap">Meeting Date</th>
                                        <th nowrap="nowrap">Time Zone</th>					
                                        <th nowrap="nowrap">Created Time</th>                  
                                        <th nowrap="nowrap">Message</th>                  
                                    </tr>
							    </thead>

							    <tbody>
								<?php
								    $sno = $row+1;
						
    								foreach ($result_data as $key => $bkng)
    								{
    									?>
							 
									<tr>                   
                                        <td nowrap="nowrap"><?php //echo $sno; ?>
                                            <label style="cursor:pointer;">
                                                <input type="checkbox" class="data-check" value="<?php echo $bkng['form_id']; ?>" id="<?php echo $bkng['form_id']; ?>" style="position:absolute; opacity:0;">
                                                <span class="input-checkbox-icon" style="top:5px;left:4px; margin:0 6px 6px 0;"></span>
                                            </label>
                                        </td>
										<td nowrap="nowrap"><?php echo $bkng["contactname"]; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["companyname"]; ?></td>
										<td nowrap="nowrap"><?php echo $bkng["email"]; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["phonetext"]; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["selectcountry"]; ?></td>
                                        <td nowrap="nowrap"><?php echo date('m/d/Y', strtotime($bkng["Selectmeetingdate"])); ?></td>
                                        <td nowrap="nowrap"><?php echo !empty($bkng["timezone"]) && $bkng['timezone'] != 'Select Time Zone' ? $bkng["timezone"] : 'Estern Time : USA & Canada'; ?></td>
                                        <td nowrap="nowrap"><?php echo !empty($bkng['created_date']) ? date('m/d/Y H:i', strtotime($bkng["created_date"])) : ''; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["Message"]; ?></td>
                                    
                                    </tr>
						
								 <?php $sno++;
								    }
                                    if(count($result_data) == 0){
                                    echo "<tr>";
                                    echo "<td class='no-record' colspan='9'>No record found.</td>";
                                    echo "</tr>";
							        }
							     ?>
								
								</tbody>

                            </table>
                            <div align="center">
                                <img id="ajax-loader" style="position:absolute;top:35%;right:55%;z-index:99999;width:150px;height:150px;display:none;" src="<?php echo base_url(); ?>assets/images/ajax-loader.gif">
                            </div>
                        </div>

					               <!-- Paginate -->
					    <div style='margin:10px 25px 15px 0px; text-align: right;'>
                            <span style="padding:0 10px;"> Total Records: <?php echo $total_record;?> </span>
                            <?= $pagination; ?>
					    </div>
                    
                    </div>
				</section>
                <!-- panel end -->
                <!-- bookingModal -->
                <div id="bookingModal" class="modal fade" data-backdrop="static" data-keyboard="false"> 
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="row">
                        <div class="col-xs-8">
                            <form id="frmAddBooking" name="frmAddBooking" method="post" action="<?php echo base_url('contacts/addBooking');?>">  
                                <input type="hidden" name="created_for" id="created_for">
                                <!-- schedule body -->
                                <div id="classScheduleBody" class="modal-body">
                                    <div class="first-part">
                                        <div class="row">
                                            <span class="icon close-modal close-div" data-dismiss="modal">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </span>
                                            <div class="col-xs-8" style="margin-left:-30px;">
                                                <div class="form-group event-day-time">
                                                    <div class="controls">
                                                        <input type="text" class="input-xlarge form-control title" name="booking_title" id="booking_title" placeholder="Add title" style="width:100%">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                 <button class='add_schedule_timing btn save-btn big-modal' type="button">Book Now</button>
                                            </div>
                                        </div>


                                        <div class="row event-day-time" style="margin-left:30px;">
                                            <div class="col-xs-12">
                                                <input class="input-xlarge form-control datepicker" name="start_date" id="start_date"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off">

                                                <input class="input-xlarge form-control timepicker start_time_dv" name="start_time" id="start_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">

                                                <span style="margin-right:8px;"> to </span>

                                                <!-- <input class="input-xlarge form-control datepicker" name="end_date" id="end_date"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off"> -->

                                                <input class="input-xlarge form-control timepicker start_time_dv" name="end_time" id="end_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row reminder-n-guests flex-row">
                                        <div class="col-xs-12 col-sm-8 col-reminder">
                                            <div class="tab-title"> <span>Booking Details</span> </div>

                                                <div class="scroller">

                                                  <div class="row">
                                                    <div class="col-xs-12">
                                                         <i class="fa fa-user" style="font-size:20px;text-align:center;margin-top:3px;float:left;height:28px;width:28px;"></i>
                                                         <div class="col-xs-10 location-div" >
                                                            <input type="text" class="form-control location-input" id="contact_name" placeholder="Name" name="contact_name">
                                                        </div>
                                                    </div>          
                                                  </div>

                                                  <div class="row" style="margin-top:10px;">
                                                    <div class="col-xs-12">
                                                         <i class="fa fa-shield-alt" style="font-size:20px;margin-top:3px;text-align:center;float:left;height:28px;width:28px;"></i>
                                                         <div class="col-xs-10 location-div" >
                                                            <input type="text" class="form-control location-input" id="company" placeholder="Company" name="company">
                                                        </div>
                                                    </div>          
                                                  </div>

                                                  <div class="row" style="margin-top:10px;">
                                                    <div class="col-xs-12">
                                                         <i class="fa fa-envelope" style="font-size:20px;margin-top:3px;text-align:center;float:left;height:28px;width:28px;"></i>
                                                         <div class="col-xs-10 location-div" >
                                                            <input type="text" class="form-control location-input" id="email" placeholder="Email" name="email">
                                                        </div>
                                                    </div>          
                                                  </div>

                                                  <div class="row" style="margin-top:10px;">
                                                    <div class="col-xs-12">
                                                         <i class="fa fa-phone" style="font-size:20px;margin-top:3px;text-align:center;float:left;height:28px;width:28px;"></i>
                                                         <div class="col-xs-10 location-div" >
                                                            <input type="text" class="form-control location-input" id="phone" placeholder="Phone" name="phone">
                                                        </div>
                                                    </div>          
                                                  </div>

                                                  <div class="row" style="margin-top:10px;">
                                                    <div class="col-xs-12">
                                                         <i class="fa fa-map-marker-alt" style="font-size:20px;text-align:center;margin-top:3px;float:left;height:28px;width:28px;"></i>
                                                         <div class="col-xs-10 location-div" >
                                                            <input type="text" class="form-control location-input event_location" id="location" placeholder="Location" name="location">
                                                        </div>
                                                    </div>          
                                                  </div>

                                                  <div class="row" style="margin-top:10px;">
                                                        <i class="fa fa-bars" aria-hidden="true" style="margin-left:15px; font-size:20px;text-align:center;margin-top:3px; float:left;height:28px;width:28px;"></i>
                                                        <div class="col-xs-11" style="width:87%;">
                                                          <div class="form-group">
                                                            <div class="controls">
                                                              <input type="hidden" name="note" id="notes3">
                                                              <textarea name="notes" id="notes2" rows="2" cols="20" contenteditable="true"></textarea>        
                                                            </div>                
                                                          </div>
                                                        </div>          
                                                  </div>
                                                
                                                </div> <!-- /.scroller -->

                               
                                        </div> <!-- /.col-reminder -->
                              
                                        <div class="col-sm-4 col-xs-12 col-guests">

                                            <div class="tab-title"> <span>Guests</span> </div>
                                            
                                            <div class="row">         
                                              <div class="col-xs-12"> 
                                                <div class="form-group">
                                                  <label class="control-label" for="textfield" style="color:gray;font-size:1em;font-weight:600;">Invite company contacts and guests:</label>
                                                  <div class="guest-list-scroller">
                                                    <div class="invite_dv">


                                                    </div>
                                                  </div>                 
                                                   
                                                </div>
                                              </div>                
                                            </div>          
                                            
                                            <div class="row">
                                                <div class="col-xs-12">
                                                <div class="form-group">
                                                    <a  class="add_invite btn btn-round btn-yellow-o" title="Add More" href="javascript:;" style="text-transform:uppercase;"><i class="fa fa-plus"></i> Guests</a>      
                                                </div>
                                              </div>          
                                            </div>  
                                           
                                        </div> <!-- /.col-guests -->

                                    </div> <!-- /.reminder-n-guests -->
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-12">
                              <div class="select2-div"> 
                                <span>Bookings of</span>
                              <span>
                                 <select id="popular" name="own[]" class="popular-list" style="margin-top: -2px;margin-left: 5px;min-width: 15%; background: white; border-radius: 5px;">
                                      <?php foreach ($closerOpener as $option_key => $option) { if($option['user_id'] == $record_data['__21']){?>
                                        <option value="<?php echo $option['user_id']; ?>" selected><?php echo $option['first_name'].' '.$option['last_name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $option['user_id']; ?>" ><?php echo $option['first_name'].' '.$option['last_name']; ?></option>

                                      <?php } } ?>
                                </select> 
                              </span>
                              <img id="ajax-loader2" src="<?php echo base_url() ?>assets/images/ajax-loader.gif" style="display: none;position:absolute;left:60px;z-index: 999; top:180px;">
                              </div>
                                <div id="calendar" class="has-toolbar"></div>
                             </div>
                        </div>
                        </div>     
                        </div>
                    </div>
                </div>
                <!-- bookingModal -->
			</div>
		</div>
    </section>
</section>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery.timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script> 
<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min-new.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/fullcalendarv3.min.js"></script>
<script type="text/javascript">
    var checkAll = false;
    function selectAll(){
        if(checkAll){
            $('#dynamic-table input[type="checkbox"]').prop("checked", false);
            $(".input-checkbox-icon").removeClass( "btn-primary" );
            $('#checkboxSelect').text("Select All");
            checkAll = false;
            
        }else{
            $('#dynamic-table input[type="checkbox"]').prop("checked", true);
            $(".input-checkbox-icon").addClass( "btn-primary" );
            $('#checkboxSelect').text("Select All");
            checkAll = true;
        }
    }
    CKEDITOR.replace('notes2',{
        removePlugins : 'elementspath',
        resize_enabled : false,
          toolbar : [
           ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
           '/',
        ] ,
          height: '200px',
          contentsCss : 'body{background:#f1f3f4;font-family:sans-serif, Arial, Verdana, "Trebuchet MS"; font-size:12px;}',
    });
$(document).ready(function() {
    var user_id = '';
    var t = $('#dynamic-table123').dataTable({});
    $(".datepicker").datepicker({ minDate: 0 });
    $("input.timepicker").timepicker({
        timeFormat: 'h:mm a',
        interval: 15,
    });
    if(user_id == ''){
        user_id = $("#bookingModal #popular").val(); //'<?php //echo $openerCloser_id?>';
        $("#bookingModal #created_for").val(user_id);
    }
    else{
        $("#bookingModal #created_for").val(user_id);
    }
    $('#popular').on("change", function(e) { 
        user_id = $(this).val();
        if(user_id != ''){
            $("#bookingModal #created_for").val(user_id); 
            $('#calendar').fullCalendar('refetchEvents');
        }
    });
    $('#calendar').fullCalendar({
    selectable: true,
    defaultView: 'agendaDay',
    slotDuration :'00:15:00',
    header: {
      left: ' today',
      center: 'title',
      right: 'prev,next'
    },
    editable:true,
    droppable: true,
    eventDurationEditable:false,
    loading: function(isLoading, view)
    {
      isLoading == true ? $("#bookingModal #ajax-loader2").css('display', 'block') : $("#bookingModal #ajax-loader2").css('display', 'none');
    },
    dayClick: function(date,jsEvent, view) {
        $('#bookingModal #start_time').val(date.format('h:mm a'));
        $('#bookingModal #start_date').val(date.format('MM/DD/YYYY'));
        var endDate = date.add(15,"m");
        $('#bookingModal #end_time').val(endDate.format('h:mm a'));
    },
    eventSources: [{
            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: '<?php echo base_url() ?>Modules/getEvents1',
                    method:'post',
                    dataType: 'json',
                    data: {user_id:user_id,module:1},
                    success: function (msg) {
                      console.log(msg);
                      var events = msg.events;
                      console.log(events);
                      callback(events);
                    }
                });
            },
        },],
    });
    $(document).on('click','.add_invite',function(){
    
        var html = '<div class="controls" style="margin-bottom: 5px;"><input class="input-xlarge form-control invite auto-email" name="invite[]" type="text" value="" autocomplete="off" placeholder="Enter email" style="width:138px;display:inline-block;height:30px;">    <i class="fa fa-times remove_invite" aria-hidden="true" style="font-size:20px;margin:auto 5px;"></i>  <div class="show_avail" style="color:red;font-size: 12px;display: none;">User not available on this date time!</div> </div> ';     
        
        //console.log(html);
        $('.invite_dv').append(html);
    
    });
    $(document).on('click','.remove_invite',function(){   
        $(this).parent().remove();
        $('.add_invite').show();
        //$('.update_schedule_timing').attr('disabled', false);
    });
    $("#dynamic-table .data-check").click(function(){
        if($(this).parent().find(".input-checkbox-icon").hasClass('btn-primary'))
        {
            $(this).parent().find(".input-checkbox-icon").removeClass('btn-primary');
        }
    });
    $("#contact_delete_btn").click(function(){
        var form_ids = '';
        $('input[type=checkbox]:checked').each(function(){
            var id = $(this).val();
            if(id != 'on')
            form_ids += (form_ids == '') ? id : (','+id);
        });
        if(form_ids == '')
        {
            alert('No record has been selected, Please select record first');
            return;
        }
        else
        {
            if(window.confirm('Are you sure to delete this records ?'))
            {
                $.ajax({
                    type:'post',
                    url: "<?php echo base_url(); ?>contacts/delete",
                    dataType:'json',
                    data: {form_ids:form_ids},
                    beforeSend:function(data)
                    {
                        $("#ajax-loader").css('display', 'block');
                    },
                    success:function(data)
                    {
                        $("#ajax-loader").css('display', 'none');
                        window.location.reload();
                    }
                });
            }
        }
    });

    $("#add-to-booking").click(function(){
        var form_id = '';
        var flag = 0;
        $('input[type=checkbox]:checked').each(function(){
            var id = $(this).val();
            if(id != 'on'){
                form_id = id;
                flag++;
            }
        });
        if(flag > 1)
        {
            alert("Please select only one record at the time for booking.");
            return false;
        }
        if(form_id == '')
        {
            alert('No record has been selected, Please select record first');
            return;
        }
        else
        {
            $.ajax({
                type:'post',
                url: "<?php echo base_url(); ?>contacts/get",
                dataType:'json',
                data: {form_id:form_id},
                
                success:function(data)
                {
                    console.log(data[0]);
                    var time = getCurrentTime().split('T');
                    $("#bookingModal #booking_title").val(data[0].contactname);
                    $("#bookingModal #start_date").val(data[0].Selectmeetingdate);

                    $("#bookingModal #start_time").val(time[0]);
                    //$("#bookingModal #end_date").val(data[0].Selectmeetingdate);
                    $("#bookingModal #end_time").val(time[1]);
                    $("#bookingModal #contact_name").val(data[0].contactname);
                    $("#bookingModal #company").val(data[0].companyname);
                    $("#bookingModal #email").val(data[0].email);
                    $("#bookingModal #phone").val(data[0].phonetext);
                    $("#bookingModal #location").val(data[0].selectcountry);
                    CKEDITOR.instances.notes2.setData(data[0].Message);
                    $("#bookingModal").modal();
                    setTimeout(function(){
                        $('#calendar').fullCalendar('refetchEvents');
                        $('#calendar').fullCalendar('render');},1000);
                    
                    //window.location.reload();
                }
            });

        } 
    });
    $("#bookingModal .save-btn").click(function(){
        $("#bookingModal #notes3").val(CKEDITOR.instances.notes2.getData());
        $("#frmAddBooking").ajaxSubmit({
            dataType:'json',
            type:'post',
            beforeSend:function(data)
            {
                $("#ajax-loader").css('display', 'block');
            },
            success:function(data)
            {
                $("#ajax-loader").css('display', 'none');
                
                window.location.reload();
            }
        });
    });
    function getCurrentTime()
    {
     var date = new Date();
     var hr = date.getHours();
     var min = date.getMinutes();
     var ss = hr < 12 ? ' am' : ' pm';
     hr =+ hr % 12 || 12;
     min = parseInt(min);
     var hr1 = hr;
     var min1 = min;
     var ss1 = ss;
     var result = Math.floor(min/15);
     switch(result)
     {
       case 0:
        min = '15'; min1 = '30';
       break;
       case 1:
        min = '30'; min1 = '45';
       break;
       case 2:
        min = '45';
        if(hr == 11 && ss == ' am'){ hr1 = 12; min1 = '0'; ss1 = ' pm'; }
        else if(hr == 11 && ss == ' pm'){ hr1 = 12; min1 = '0'; ss1 = ' am'; }
        else if(hr == 12 && ss == ' am'){ hr1 = 1; min1 = '0'; }
        else if(hr == 12 && ss ==' pm'){ hr1 = 1; min1 = '0'; }
        else { hr1 = hr + 1; min1 = '0';}
       break;
       case 3:
        if(hr == 11 && ss == ' am')
        {
          hr = 12; min = '0'; ss = ' pm'; hr1 = 12; min1 = '15'; ss1 = ' pm';
        }
        else if( hr == 11 && ss == ' pm')
        {
          hr = 12; min = '0'; ss = ' am'; hr1 = 12; min1 = '15'; ss1 = ' am';
        }
        else
        {
          hr = hr1 = hr+1; min = '0'; min1 = '15';
        }
       break;
     }
     min = min < 1 ? '0'+min : min;
     min1 = min1 < 1 ? '0'+min1 : min1;
     return hr+':'+min+ss+'T'+hr1+':'+min1+ss1;
    }
});
</script>
