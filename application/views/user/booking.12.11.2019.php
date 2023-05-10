<?php
if(!empty($_GET)){ $name = $_GET['name']; $email = $_GET['email']; }
else{ /*die();*/ }
?>
<!doctype html>
<html>
<head>
<link href="<?php echo base_url() ?>static/css/my.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.timepicker.min.css">
<link href="<?php echo base_url(); ?>/static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/sweetalert2.css" rel="stylesheet">
<style>
.panel{width:80%;margin:0px 140px;}
#main-content{background:#FBFCFD;}
#main-content .panel{width:920px;margin:0 auto;}
#main-content .panel-section{background: #11b6ab;color: white;}
.modal-content {  border:1px solid #797a7d00;border-radius: 10px;overflow: hidden; }
.modal-header { height: 65px; }
#calendar{ width:100%;margin:-20px 0px; }
.modal-header { background: #1fb5ad; color: white;}
.modal-title { font-weight: 600; }
.modal-body { padding: 5px 40px; }
.modal-header .close { color: white;opacity: 1; }
.form-control { width:98%; }
#comment { width:100%;position:relative; }
#start_date2, #start_time, #end_time{ width: 90%; }
.control-label {color:#636060 !important;}
.ui-timepicker-container {z-index:9999 !important;}
.fc .fc-button-group .fc-button {border: 0; border-radius: 4px; color: #fff; transition: 0.2s; text-shadow: none; background: #5a6766 ; text-transform: capitalize; color:#fff;}
.fc .fc-button-group .fc-prev-button, .fc .fc-button-group .fc-next-button {border-radius:25px; height:27px; background:transparent !important; box-shadow:none;}
.fc .fc-button-group .fc-state-hover {background:#dadce0 !important; transition: 0.4s; color:#666 !important;}
.fc .fc-today-button {margin-left:10px; color:#5a6766; border-radius: 4px; background-color:#f3f3f3 !important; text-shadow: none; text-transform: capitalize; padding: 0px 13px 2px; border:1px solid #f3f3f3;}
.fc .fc-today-button.fc-state-hover:hover {background:#dadce0 !important; border:1px solid #666; color:#666 !important; box-shadow:none;}
.fc-month-view .fc-day-number {float:none; text-align:center;line-height:22px; margin:5px auto; font-weight:bold; border-radius:25px; width:22px; height:22px; cursor:pointer; background:#f1f3f4; font-size:11px;}
.fc-ltr .fc-basic-view .fc-day-hover .fc-day-number {background: #62CBC6;}
.fc-toolbar{ border:1px solid lightgray; }
#ignore_btn {color: white;background-color: #c7cbd6;border-color: #c7cbd6;}
#ignore_btn:hover {color: white;background-color: #b0b5b9;border-color: #b0b5b9;}
#confirm_btn {color: #fff;background-color: #1eb5ad;border-color: #1eb5ad;}
#confirm_btn:hover {color: #fff;background-color: #129e97;border-color: #129e97;}
#calendar .fc-time-grid-container.fc-scroller { overflow: auto;height:410px !important; }

#calendar .fc-toolbar {padding: 5px;background: gray;color: white;}

#calendar .fc-center h2 { font-size: 21px;color:#10b7ab; }
#calendar .fc-day-header {background-color: #dadce0;color: #808080;}
#calendar .fc-widget-content { border-color: #8080805c; }
.fc .fc-button-group .fc-button.fc-today-button { color: gray !important; }
.fc-button.fc-month-button { color: gray !important; text-transform: capitalize;}
.wrapper { padding: 40px 25px; }
.row.no-mg { margin:0;background: #f2f4f8; }
.left-bar, .right-bar {height:630px;background: white;}
.booking-details {margin-top:15px;}
.left-bar h4.company-title {margin:22px 0px 0px 22px;color:#4d505599;text-transform: capitalize;font-size:18px;}
.left-bar{border-right:0.1em solid #d3d3d36b;}
.left-bar h4 {margin:10px 0px 0px 22px;color:#4d505599;text-transform: capitalize;font-size:16px;}
.left-bar h4 i {margin-right: 5px;}
.left-bar h3 {margin:5px 0px 20px 20px;font-size: 20px; margin-bottom: 0px;}
.head{ width:185px;float:right; position: absolute;right: -6px;top: -6px;overflow: hidden;height: 150px;}
.calendar-badge { float: right;background: #10b7ab;text-align: center;width: 100%;color: white;transform: rotate(45deg);position: relative;top: 18px;left: 55px;letter-spacing:0.3px;box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);height:40px;cursor: pointer;}
.calendar-badge:hover{ background: #10b7abe0; transition: 0.4s; }
.calendar-badge:before {content: '';position: absolute;background: #10b7ab;height: 6px;width: 6px;top: 41px;transition: all 0.1s ease-in;z-index: 999;right: 164px;}
.calendar-badge:after {content: '';position: absolute;background: #10b7ab;height: 6px;width: 6px;top: 40px;transition: all 0.1s ease-in;z-index: 999;right: 17px;}
.calendar-powered-by {font-size: 8px;text-transform: uppercase;margin-top: 7px;margin-bottom: -2px;font-weight: 700;}
.calendar-title {font-weight: 700;letter-spacing: -0.6px;}
ul{ padding: 0; }
.features{ margin-top:100px; }
.features h3{margin:0;font-size: 24px;color: #10b7ab;}
.features h3 span { font-size: 40px; }
.features .row { font-size: 16px; padding: 10px 0px; }
.icon { color:orange;}
.li-icon { list-style: none;margin-top: 20px;font-size: 16px;color: #132751; position: relative;margin-left: 32px; }
.li-icon:before{ background-image: url("<?php echo base_url(); ?>assets/images/check.png");background-size: 25px 24px;display: inline-block;width: 24px;height: 24px;content:"";padding: 1px 17px;vertical-align: middle;background-repeat: no-repeat;position: absolute;left:-33px;}
.cal-title{ text-align: left;margin-left:20px;position: relative;top:-30px;color:#4d505599; }
.fc .fc-left .fc-prev-button, .fc .fc-right .fc-next-button { background: transparent;box-shadow: none; border: none; color:#11b6ab; }
.fc .fc-left .fc-prev-button:hover, .fc .fc-right .fc-next-button:hover{background: #d4f2ef !important; color: #10b7ab;border-radius: 50%;transition: 0.4s;  }
.fc .fc-left .fc-prev-button:hover, .fc .fc-right .fc-next-button:focus { border:none; }
#calendar .fc-toolbar {padding: 5px;background: white;color: #4d505599;border:none;margin-bottom: 20px;}
#calendar .fc-day-header {background-color: white;color: #4d505599;text-transform: uppercase;font-size: 13px;font-weight: 500;}
.fc-month-view div.fc-widget-header{ margin-bottom: 15px; }
.fc-month-view .fc-day-number { color:#4d505599;font-size: 16px;padding: 25px;font-weight: 500; }
.fc-month-view .fc-today, .fc-month-view .fc-future { color:#10b7ab;background: none !important;border:none !important; }
.fc-month-view thead ,.fc-month-view th, .fc-month-view td{ border:none; }
div:not(.fc-bg) .fc-month-view .fc-today, div:not(.fc-bg) .fc-month-view .fc-future{ position:relative;font-weight: 600; }
div:not(.fc-bg) .fc-month-view .fc-today:before, div:not(.fc-bg) .fc-month-view .fc-future:before{content: '';position: absolute;width: 45px;height: 45px;background: #10b7ab08;border-radius: 25px;opacity: 1;left: 50%;z-index: -1;top: 50%;margin: -22px;}
div:not(.fc-bg) .fc-month-view .fc-today:hover, div:not(.fc-bg) .fc-month-view .fc-future:hover { color:white; }
div:not(.fc-bg) .fc-month-view .fc-today:hover:before, div:not(.fc-bg) .fc-month-view .fc-future:hover:before { background: #10b7abc2 !important; }
td.fc-day-number.fc-past { cursor:not-allowed; }

#month-btn { position: relative;top: -15px;left: 190px;padding: 3px 10px;display: none;}
.btn-default{color: #10b7ab;background-color: #ffffff;border-color: #10b7ab;}
.btn-default:hover,.btn-default:active,.btn-default:focus{ color: #ffffff !important;background-color: #10b7ab !important;border-color: #10b7ab !important; }

.fc-agendaDay-view .fc-today, .fc-agendaDay-view .fc-future { border:none !important; }
.fc-agendaDay-view thead,.fc-agendaDay-view th,.fc-agendaDay-view td{ border:none; }
.fc-agendaDay-view .fc-slats td { /*border:none !important;*/border: 1px dotted white;border-color: #1fb5ad !important;}
.fc-agendaDay-view .fc-day-grid { display: none; }
.fc-agendaDay-view .fc-slats tr { border:1px dotted black; }
.fc-agendaDay-view .fc-time {position: relative;/*left: 60px;*/color: #10b7ab;font-size: 20px;text-transform: capitalize;}
.fc-agendaDay-view hr { display: none; }
.fc-agendaDay-view.fc-view { right:41px;width:568px; }
.fc-agendaDay-view .fc-day-header {background: #10b7abd9 !important;padding:10px !important;color: white !important;font-size: 17px !important;font-weight: 650 !important;letter-spacing: 0.7px;}
.m50{ margin:-50px 0px !important; }
.fc-agendaDay-view td.fc-widget-content:not(.fc-time) { padding-left: 60px; }
.fc-agendaDay-view div.fc-content .fc-time,.fc-agendaDay-view div.fc-content .fc-title{ display: inline-block !important;font-size: 15px;color:white; }
.fc-agendaDay-view td.fc-today { background: white; }
.fa{font-size: 17px;}
.ajax-load{float: right;width: 80px;margin: -23px -25px -24px -22px;display:none;}
.back-arrow{margin: 22px 0 0 22px;color: #10b8ab;border: 1px solid lightgray;width: 35px;padding: 7px;border-radius: 50%;height: 35px;}
.back-arrow:hover{background:#10b8ab36;}
.back-arrow i {font-size:19px;}
</style>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.timepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script> 
<!--main content start-->
</head>
<body>
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        <section class="panel">
            <div class="panel-section">
                <!-- <div class="increased popover-toggle silent" style="padding: 5px 0px;text-align:center;">
                    <h2 style="font-size: 25px; font-weight: 500;">Booking</h2>
                    
                </div> -->      
            </div>
            <div class="row no-mg">
                <div class="col-sm-4 left-bar">
                    <div class="back-arrow"><i class="fa fa-arrow-left"></i></div>
                    <h4 class="company-title">Anbruch.Inc</h4>
                    <div class="booking-details">
                        <h4><i class="fa fa-clock"></i>15 min</h4>
                        <h4><i class="fa fa-map-marker-alt"></i> https://anbruch.com/</h4>
                    </div>
                    <div class="features">
                        <h3><span>5</span> Good Reasons Why Anbruch</h3>
                        <ul>
                            <li class="li-icon"><span>Maximized savings & refunds</span></li>
                            <li class="li-icon"><span>Success fee-based compensation</span></li>
                            <li class="li-icon"><span>Non-intrusive value-driven process</span></li>
                            <li class="li-icon"><span>End-to-end personalized audit support service</span></li>
                            <li class="li-icon"><span>No risk, no out-of-pocket cost, no obligation!</span></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-sm-1"></div> -->
                <div class="col-sm-8 right-bar">
                    <!-- <div class="head">
                        <a href="https://www.anbruch.com" target='_blank'>
                            <div class="calendar-badge">
                                <div class="calendar-powered-by">Powered by</div>
                                <div class="calendar-title">Anbruch.Inc</div>
                            </div>
                        </a>
                    </div> -->
                    <div class="container" style="text-align: center;width:100%;margin-top:50px;">
                        <h4 class="cal-title">Select Date & Time</h4>
                        <button type="button" id="month-btn" class="btn btn-default">Month</button>
                        <div id="calendar"></div> 
                    </div>
                </div>
            </div>
        <!-- page end-->
        </section>
        
        <div class="modal fade" id="modalFollow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Booking Schedule</h4>
                    </div>
                    <form id="website-booking" name="websiteBooking" type="post" class="form-horizontal" action="<?php echo base_url(); ?>User/addWebBooking">
                        
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Date:</label>
                                        <input class="input-xlarge form-control datepicker" name="st_date" id="start_date2" type="text" placeholder="MM/DD/YYYY" required value="" autocomplete="off">                                              
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="width: 25%;">
                                    <div class="form-group">
                                        <label class="control-label" for="start_time">Start:</label>
                                        <input class="input-xlarge form-control timepicker" name="st_time" id="start_time" value="" type="text" placeholder="HH:MM" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12" style="width: 25%;">
                                    <div class="form-group">
                                        <label class="control-label" for="start_time">End:</label>
                                        <input class="input-xlarge form-control timepicker" name="end_time" id="end_time" value="" type="text" placeholder="HH:MM" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin:0;">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name:</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?php echo !empty($name) ? $name : ''; ?>" ></textarea> 
                                </div>
                            </div>
                            <div class="row" style="margin:0;">
                                <div class="form-group">
                                    <label class="control-label" for="name">Email:</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo !empty($email) ? $email :''; ?>" ></textarea> 
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" id="ignore_btn" type="button">Ignore</button>
                        <button class="btn btn-warning" id="confirm_btn" type="button">Confirm</button>
                        <img src="<?php echo base_url(); ?>assets/images/ajax-loader.gif" class="ajax-load">
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</section>
</body>
<!--main content end-->
<script type="text/javascript">
    $(document).ready(function(){
        $(".datepicker").datepicker({
            minDate: 0
        });
        $("input.timepicker").timepicker({
            timeFormat: 'h:mm a',
            interval: 15,
        });
         $('#calendar').fullCalendar({
            selectable: true,
            slotDuration :'00:15:00',
            nowIndicator: true,
            header: {
              left: 'prev',
              center: 'title',
              right: 'next'
            },
            height:510,
            eventLimit:true,
            scrollTime: "09:00:00",
            dayClick: function(date,jsEvent, view) {
                 if(view.name == 'month')
                 {
                    if(date.isAfter(moment()) || date.isSame(moment(), 'day'))
                    {
                        $("#month-btn").css('display', 'inline-block');
                        $("#calendar").addClass('m50');
                        $('#calendar').fullCalendar('changeView', 'agendaDay');
                        $('#calendar').fullCalendar('gotoDate', date.format('YYYY-MM-DD'));
                    }
                    else
                    {
                        $("#month-btn").css('display', 'none');
                        alert("Previous time can't be select");
                    }
                }
                else
                {
                    if (date.isAfter(moment()))
                    {
                        $("#month-btn").css('display', 'inline-block');
                        $('#start_time').val(date.format('h:mm a'));
                        $('#start_date2').val(date.format('MM/DD/YYYY'));
                        $('#end_date4').val(date.format('MM/DD/YYYY')); 
                            var endDate = date.add(15,"m");
                        $('#end_time').val(endDate.format('h:mm a'));
                        $("#modalFollow").modal();
                    }
                    else
                    {
                        $("#month-btn").css('display', 'inline-block');
                        alert("Previous time can't be select");
                    }
                }
            },
            eventSources: [{
                  events: function (start, end, timezone, callback) { 
                    /*$.ajax({
                        url: '<?php echo base_url() ?>User/getBookingTitle',
                        method:'post',
                        dataType: 'json',
                        success: function (msg) {
                          console.log(msg);
                          var events = msg.events;
                          console.log(events);
                          callback(events);
                          
                        }
                    });*/
                  },
                },               
              ],
          });
        $("#month-btn").click(function(){
            $('#calendar').fullCalendar('changeView', 'month');
            $('#calendar').fullCalendar('gotoDate', new Date());
            $("#calendar").removeClass('m50');
            $("#month-btn").css('display', 'none');
        });
        $("#confirm_btn").click(function(){
            var date  = $("#modalFollow #start_date2").val();
            var start_time = $("#modalFollow #start_time").val();
            var end_time = $("#modalFollow #end_time").val();
            var name = $("#modalFollow #name").val().trim();
            var email = $("#modalFollow #email").val().trim();
            var message = '';
            var status = false;
            if(!date)
            {
                message = "Please select a valid booking date.";
                status = true;
            }
            else if(!start_time)
            {
                message = "Please select valid start time.";
                status = true;
            }
            else if(!end_time)
            {
                message = "Please select valid end time.";
                status = true;
            }
            else if(!name)
            {
                message = "Please enter a valid name.";
                status = true;
            }
            else if(!email)
            {
                message = "Please enter a valid email address.";
                status = true;
            }
            if(status)
            {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: message,
                    customClass: {
                    popup: 'animated swing'
                    },
                    animation: false,  

                });
                return false;
            }
            $.ajax({
                url: "<?php echo base_url(); ?>user/checkBookingAvailabilityWEB",
                type:'post',
                data:{date:date, start_time:start_time, end_time:end_time},
                dataType:'json',
                beforeSend:function(){
                    $(".ajax-load").show();
                },
                success:function(data)
                {
                    if(data.success)
                    {
                        $("#website-booking").ajaxSubmit({
                            dataType:'json',
                            type:'post',
                            success:function(data)
                            {
                                $(".ajax-load").hide();
                                $("#modalFollow").modal('toggle');
                                if(data.success)
                                {
                                   Swal.fire({
                                        type: 'success',
                                        title: 'Success',
                                        text: 'Your request submitted successfully',
                                        customClass: {
                                        popup: 'animated swing'
                                        },
                                        animation: false,  

                                    }).then((result) => {
                                        window.location.href = "https://www.anbruch.com/home-draft";
                                    });
                                }
                                else
                                {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Error',
                                        text: 'Something went wrong to perform this action',
                                        customClass: {
                                        popup: 'animated swing'
                                        },
                                        animation: false,  

                                    });
                                }
                            }
                        });
                    }
                    else
                    {
                        $(".ajax-load").hide();
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: data.message,
                            customClass: {
                            popup: 'animated swing'
                            },
                            animation: false,  

                        });

                    }
                }
            });
            
        });
        $(".back-arrow").click(function(){
            window.location.href = "https://www.anbruch.com/home-draft";
        });
    });

</script>
</html>
<script src="<?php echo base_url();?>/static/js/fullcalendar/moment.min-new.js"></script>
<script src="<?php echo base_url();?>/static/js/fullcalendar/fullcalendar-new.js"></script>
<script src="<?php echo base_url();?>/assets/js/sweetalert2.all.min.js"></script>

