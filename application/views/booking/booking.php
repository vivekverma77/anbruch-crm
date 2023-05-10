<!--calendar css-->
<!-- <link href="<?php //echo base_url() ?>static/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" /> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.css" rel="stylesheet" />

<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet" />

<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.css" rel="stylesheet" />

<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/timepicker/') ?>jquery.timepicker.css" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>

<link href="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.css"  rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.js"></script>

<style> 
.ui-timepicker-wrapper{
  width: 110px !important;
}
::placeholder { /* Most modern browsers support this now. */
   color:    #909;
}
#reminder-popup.open {z-index: 11;}
.flex-row {display:flex; display:-webkit-flex; flex-wrap:wrap;}
.pac-container.pac-logo {z-index: 9999;}
.col-reminder .scroller {max-height:350px; overflow-y:scroll; overflow-x:hidden; margin:-25px -15px 0 0; padding:25px 15px 0 0;}
.guest-list-scroller {max-height:250px; overflow:auto;}
#editClassSchedule .guest-list-scroller.absolute {max-height:250px;overflow: hidden; overflow-y:auto;min-width: 95%;z-index: 1;position: absolute;}
.ajax-load {float:right; width:80px; margin:-25px -25px -21px -17px; display:none;}
/* width */ 
.guest-list-scroller::-webkit-scrollbar,
.fs-wrap.multiple .fs-dropdown::-webkit-scrollbar,
.scroller::-webkit-scrollbar {width: 4px;height: 4px;}
.modal .modal-dialog {box-shadow:0 4px 8px 0 rgba(0,0,0,0.5); border-radius:10px; overflow:hidden;}
header .fs-label-wrap .fs-label {padding: 7px 22px 7px 8px;font-size: 11px;}
header .fs-wrap.multiple .fs-arrow {top: 10px;}
/* Track */
.guest-list-scroller::-webkit-scrollbar-track,
.fs-wrap.multiple .fs-dropdown::-webkit-scrollbar-track,
.scroller::-webkit-scrollbar-track {
  background: #ddd; 
}
 
/* Handle */
.guest-list-scroller::-webkit-scrollbar-thumb,
.fs-wrap.multiple .fs-dropdown::-webkit-scrollbar-thumb,
.scroller::-webkit-scrollbar-thumb {
  background: #1fb5ad; border-radius:50px;
}

/* Handle on hover */
.guest-list-scroller::-webkit-scrollbar-thumb:hover,
.fs-wrap.multiple .fs-dropdown::-webkit-scrollbar-thumb:hover,
.scroller::-webkit-scrollbar-thumb:hover {
  background: #3c8c88; 
}

#editClassSchedule .modal-dialog {width:850px;}

#editClassSchedule .modal-content { 
    box-shadow: none;
    border: none;
    min-height: 500px;
}
.fc-event {
    border-style: none;
    cursor: pointer;
  }
  .service-box label,.service-box .label-col {
   font-weight: 600;
   font-family: 'Open Sans',sans-serif;
   font-size: 1.6rem;
   color: #000;
   width: 35%;
}
.service-box .label-col {float: left;}
.service-box .field-col {float:left; width:65%;}
.service-box span {
   font-size: 1.6rem;
   margin-bottom: 8px;
   display: inline-block;
   margin-top: 1px;
}

.check_rebooking, .check_rebooking:hover, .check_rebooking:focus {background:#03a9f4; color:#fff; padding:7px 10px; border-radius:5px; text-decoration:none; margin-right:5px;     margin-left: 15px;}
.check_rebooking:hover {background:#059bdf;}

.re_booking {background:#1fb5ad; color:#fff; padding:1.5px 10px; border-radius:5px; text-decoration:none; display:inline-block; cursor:pointer;}
.re_booking:hover {background:#13a19a;}
.re_booking span {margin:0;}

.re_booking_other {background:#1fb5ad; color:#fff; padding:1.5px 10px; border-radius:5px; text-decoration:none; display:inline-block; cursor:pointer;}
.re_booking_other:hover {background:#13a19a;}
.re_booking_other span {margin:0;}

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

/*.fc-event-container .fc-day-grid-event {box-shadow:0 2px 2px rgba(0,0,0,0.25), 0 1px 0 rgba(0,0,0,0.05); font-size:14px; padding:6px 25px 6px 6px; overflow:hidden; margin-bottom:4px; border-radius:25px;}*/
.fc-event-container .fc-day-grid-event:focus{color:#fff;}
.fc-event-container .fc-day-grid-event:hover {box-shadow:0 5px 5px rgba(0,0,0,0.5), 0 3px 0 rgba(0,0,0,0.15);font-size: 12px;}
.fc-event-container .fc-day-grid-event:hover:before {content:''; background:rgba(0, 0, 0, .2); position:absolute; width:100%; height:100%; left:0; top:0;}
.fc-event-container .fc-day-grid-event:not(.fc-not-end):after {content:'\f274'; font-family:"Font Awesome 5 Free"; position:absolute; right:3px; padding:4px; top:0; line-height:22px;}
.fc-event-container .fc-day-grid-event.booking_event.web_booking:not(.fc-not-end):after {content:'\f0ac' !important;font-weight:900 !important;}
.fc-event-container .reminder-event:not(.fc-not-end):after {content:'\f017' !important;font-weight:900 !important;}
.fc-event-container .fc-day-grid-event.booking_event:not(.fc-not-end):after {content:'\f02e';}
.fc-time-grid>.fc-bg{
  z-index: 0 !important;
}
/*#add_calendar {background-color: #646464 !important;}*/

#calendar-listing.dropdown-menu {padding:10px 0; color:#5a6766; font-weight:normal; text-transform:none;}
#calendar-listing.dropdown-menu li {cursor:pointer; padding:7px 17px;}
#calendar-listing.dropdown-menu li:hover {background:#f5f5f5;}
#calendar-listing.dropdown-menu li span {margin-left:15px; position:relative;}
#calendar-listing.dropdown-menu li input {position:absolute; height:0; width:0;}
#calendar-listing.dropdown-menu .prevent-checkbox{height:15px; background:transparent; display:inline-block; width:15px;margin-left:0; user-select:none;}
#calendar-listing.dropdown-menu li:hover input + .prevent-checkbox:before {content:''; position:absolute; width:100%; height:100%; background:#000; opacity:.25;}
#calendar-listing.dropdown-menu li.estimator-all:hover input + .prevent-checkbox:before {background:#fff;}
#calendar-listing.dropdown-menu input:checked + .prevent-checkbox:after {content:''; position:absolute; width:9px; height:6px; border:solid #fff; border-width:0 0 1px 1px; top:3px; left:3px; transform:rotatez(-45deg); -webkit-transform:rotatez(-45deg); -ms-transform:rotatez(-45deg); -o-transform:rotatez(-45deg); -moz-transform:rotatez(-45deg);}
#cal-list {display: inline-block;margin: 0px 10px -11px;}

#addClassSchedule .form-control,#editClassScheduleNew .form-control,#editClassSchedule .form-control {border:0; background-color:#f1f3f4;}
#addClassSchedule .modal-body label,#editClassScheduleNew .modal-body label,#editClassSchedule .modal-body label {font-weight: 600;color: #16514e;letter-spacing: 0.2px;padding: 4px 0;}
#addClassSchedule .add_invite,#addClassSchedule .add_reminder,#editClassScheduleNew .add_invite,#editClassScheduleNew .add_reminder,#editClassSchedule .add_invite,#editClassSchedule .add_reminder {text-transform: uppercase;background-color: #1eb5ad;color: #fff;padding: 7px 10px;font-weight: 700;}
#addClassSchedule .add_invite:hover,#addClassSchedule .add_reminder:hover,#editClassScheduleNew .add_invite:hover,#editClassScheduleNew .add_reminder:hover,#editClassSchedule .add_invite:hover,#editClassSchedule .add_reminder:hover {background-color: #646464;transition: 0.4s;}
#editClassScheduleNew .remove_invite,#editClassSchedule .remove_invite {color: #1eb5ad;}
#editClassScheduleNew .remove_invite:hover,#editClassSchedule .remove_invite:hover {color: #646464;}
#addClassSchedule .guest_checkbox,#editClassScheduleNew .guest_checkbox,#editClassSchedule .guest_checkbox {display: flex;}
#addClassSchedule .guest_checkbox .check,#editClassScheduleNew .guest_checkbox .check,#editClassSchedule .guest_checkbox .check {margin-right: 12px;}
#editClassScheduleNew button.add_schedule_timing,#editClassSchedule button.add_schedule_timing {border-radius: 0;font-weight: 700;border: none;}
.ui-timepicker-container {z-index: 9999 !important;}
.ui-autocomplete {z-index: 9999 !important;}
/*.fc-view-container {margin-top: 1px !important;}
*/#calendar {margin-top: 0 !important;}
/*.eventView-row {padding:8px 15px;}*/
.eventView-row {padding:8px 15px; margin-top: 5px;}
.panel-heading.selUser {z-index: 9;position: relative;}
/*.eventView-row + .eventView-row {border-top:1px solid #eee;}*/
.custom-row:nth-child(even) {background:#fafafa;}
.eventView-row .custom-row label {padding:0 7px; display:inline-block; float:left;}
.eventView-row.col-6 {width: 50%;float: left;}
.dropdown-menu.extended {left: -110px;}
/*header .fs-wrap.multiple {display: none;}*/

#eventViewModal .modal-footer {display:none;}


.file_uploader {border:2px dashed #ccc; background:#f1f3f4; padding:20px; position:relative; text-align:center; font-size:20px;}
.file_uploader:hover {background:#f0f0f0; border-color:#bbb;} 
.file_uploader input {position:absolute; width:100%; height:100%; left:0; top:0; opacity:0; cursor:pointer;}
.file_uploader .value:not(:empty) + .default {display:none;}

.invite_dv .controls {display:flex; display:-webkit-flex; flex-wrap:wrap;}
.invite_dv .controls input {flex-grow:1; width:auto; max-width:80%;}
.invite_dv .controls .remove_invite {padding:10px; width:34px; text-align:center; margin-left:10px; color:#767676; margin-right:-6px; cursor:pointer; border-radius:50px;}
.invite_dv .controls .remove_invite:hover {background:#f1f3f4;}

.share_calendar_user .fs-wrap {width:230px;}
.share_calendar_user .fs-label-wrap {border-radius:2px; cursor:pointer; border-color:#ddd; background:#f1f3f4;}
.share_calendar_user .fs-label {font-weight:bold; font-size:13.5px; padding-left:15px;}
.share_calendar_user .fs-wrap.multiple .fs-option.selected .fs-checkbox i {background-color:#1fb5ad;}

/*.modal-header {background:#fff; color:#333; border-radius:0; padding:0;}*/
.modal-header {background:#fff; color:#333; border-radius:0; padding:0; border: 0px;}
.modal-header .title {float:left; width:70%; text-align:left; padding:15px}
.modal-header .event-color {display:inline-block; width:13px; height:13px; border-radius:3px; margin-right:10px;}
.modal-header h4.modal-title {font-weight:400; letter-spacing:1px; display:inline-block;}

.modal-header .icons-plot {float:right; width:30%; text-align:right; padding:9px 15px;}

/*#eventViewModal .modal-header .title {width:59%;}*/
#eventViewModal .modal-header .title {width:26%;}
/*#eventViewModal .modal-header .icons-plot {width:41%;}*/
#eventViewModal .modal-header .icons-plot {width:65%;}


/*.icons-plot .icon {display:inline-block; border-radius:52px; width:37px; height:37px; line-height:37px; text-align:center; font-size:16px; cursor:pointer; position:relative; user-select:none; border:0; background:#fff;}*/
.icons-plot .icon {display:inline-block; border-radius:52px; width:40px; height:37px; line-height:37px; text-align:center; font-size:17px; cursor:pointer; position:relative; user-select:none; border:0; background:#fff;}

.icons-plot .icon i {color:#5f6368;}
.icons-plot .icon:hover {background:#f5f5f5;}
.icons-plot .hover-title {position:absolute; bottom:-22px; left:-6px; color:#fff; padding:4px 10px; line-height:normal; font-size:14px; background:#5f6368; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
.icons-plot .icon:hover .hover-title {bottom:-30px; opacity:1;}
.icons-plot .close-modal {margin-left:15px; mar}
 span.close-modal:before {content: "";width: 18px;height: 2px;position: absolute;background: #5f6368;transform: rotate(45deg);top:19px;left:18px;}
 span.close-modal:after {content: "";width: 18px;height: 2px;position: absolute;transform: rotate(-45deg);background: #5f6368;top:19px;left:18px;}

.modal-content {border-radius:0;}

#editClassSchedule .modal-content {box-shadow:none; border:none; min-height:500px;}
.bookingView-row {padding:12px 15px 4px;border:solid #eaeef1; border-width:0 0  1px;}

.eventView-row.row .fs-label{font-weight: 700 !important;
    color: #767676 !important;line-height: 35px;padding: 0 10px;font-size: 13px;}
#eventViewModal .eventView-row.row label,#share_modal .eventView-row.row label {font-weight: 500;font-size: 14px;letter-spacing: 0.2;}


/*#calendar-listing-btn {background:#f1f3f4 !important; border:1px solid #ddd; font-weight:400; color:#767676 !important; font-size:14px; padding:6px 13px; border-radius:4px;}*/
#calendar-listing-btn {background:#ffffff !important; border:2px solid #ddd; font-weight:400; color:#767676 !important; font-size:11px; padding:5px 10px 5px; border-radius:4px;}
#calendar-listing-btn:hover, #calendar-listing-btn:focus {color:#333 !important;}
#calendar-listing-btn i {margin-left:40px;}
#add_calendar {float:right; margin-left:10px;}
#add_calendar i {margin-right: 12px;}
header .fs-wrap.multiple {margin-left: 10px;}
#cal-list {margin: 0px 12px -12px;}
#share_btn {float:right;}
#share_btn i {margin-right: 12px;}
.fc-event {padding: 3px; margin-top: 4px;}
/*th.fc-day-header.fc-widget-header {color: white; padding: 10px;}*/
 th.fc-day-header.fc-widget-header {color: white; padding: 0px !important;}
/*#calendar .fc-tue, #calendar .fc-thu, #calendar .fc-sat {background-color: rgba(31, 181, 173, 0.03);}*/
#calendar .fc-day-header {background-color:#dadce0; color:#5a6766;}
.fc-icon-right-single-arrow:after, .fc-icon-left-single-arrow:after {content:'\279E'; font-family:fontawesome; font-size:22px; font-weight:normal;}
.fc .fc-button-group .fc-prev-button{transform: rotateY(180deg)!important;background-color: #ccc !important;}
.fc .fc-button-group .fc-next-button{background-color: #ccc !important;}

.fc-icon-left-single-arrow:after {content:'\279E';}
.fc-icon-left-single-arrow {left:-2px;}
.fc-month-view .fc-day-number {float:none; text-align:center; display:table; line-height:22px; margin:5px auto; font-weight:bold; border-radius:25px; width:22px; height:22px; cursor:pointer; background:#f1f3f4; font-size:11px;}
.fc-ltr .fc-basic-view .fc-day-top:not(.fc-today) .fc-day-number:hover {background:#1BAEA6; color:#fff;}
.fc-ltr .fc-basic-view .fc-day-top.fc-today .fc-day-number {background:#1fb5ad; color:#fff;}

.fc .fc-button-group .fc-button {border: 0; border-radius: 4px; color: #fff; transition: 0.2s; text-shadow: none; background: #5a6766 ; text-transform: capitalize; color:#5a6766;}
.fc .fc-button-group .fc-prev-button, .fc .fc-button-group .fc-next-button { width:35px; height:26px; box-shadow:none;top: 1px;}

.fc .fc-button-group .fc-state-hover {background:#dadce0 !important; transition: 0.4s; color:#666 !important;}
.fc .fc-button-group .fc-corner-right {margin: 0 0 0 10px;}
.fc .fc-button-group .fc-basicWeek-button {padding: 0 15px 2px;}
.fc .fc-button-group .fc-basicDay-button {padding: 0 15px 2px;}

.fc-toolbar.fc-header-toolbar {margin-bottom: 0px !important;}
.fc-ltr .fc-basic-view .fc-day-top .fc-day-number {
    float: none;
}
.fc-agendaDay-view{margin-top: 0px;}
#booking_calendar td.fc-day.fc-widget-content {
    background: #FCF8E3;
}
.fc-toolbar .fc-right .fc-button-group .fc-button {border:1px solid #f3f3f3}
.fc-toolbar .fc-right .fc-button-group .fc-state-hover {border-color:#666; box-shadow:none;}
.fc .fc-button-group .fc-button.fc-state-active {background:#fff !important; box-shadow:none; color:#5a6766 !important; border:1px solid;}
.fc .fc-button-group .fc-month-button {margin-right:12px;}
/* .fc .fc-button-group .fc-month-button {margin-right: 12px; padding: 0px 20px 2px; background-color: #5a6766 !important;transition: 0.2s;}
.fc .fc-button-group .fc-month-button:hover {background: #3c8c88 !important; transition: 0.4s;}*/
.fc .fc-today-button {margin-left:10px; color:#5a6766; border-radius: 4px; background-color:#f3f3f3 !important; text-shadow: none; text-transform: capitalize; padding: 0px 20px 2px; border:1px solid #f3f3f3;}
.fc .fc-today-button.fc-state-hover:hover {background:#dadce0 !important; border:1px solid #666; color:#666 !important; box-shadow:none;}
.fc .fc-state-disabled {background:#fff !important; color:#5a6766 !important; border:1px solid; opacity:1;}
.fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-list-view, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed th, .fc-unthemed thead {border-color: rgba(164, 177, 176, 0.72);}
.fc-unthemed td {border-color:#dadce0;}
.top-menu .dropdown-menu:after, .top-menu .dropdown-menu:before {left:55% !important;}
/*.fc-toolbar .fc-center {margin:5px 14px;}*/
.fc-toolbar h2 {font-size:16px; color:#5a6766;margin-top: 3px;}


.event-day-time input {width:110px; margin-right:8px; display:inline-block;}
.event-day-time .event-recurrence {cursor:pointer; user-select:none; width:130px; margin-top:5px;}
#calendar_type, #calendar_type2, #visibility {cursor:pointer; width:238px; background:#f1f3f4; border:0; border-radius:4px; margin-left:10px;}
.event-day-time .input-checkbox-icon {display:inline-block; width:17px; height:17px; border:2px solid #1fb5ad; border-radius:3px; margin:6px 6px 0 0; vertical-align:bottom; position:relative;}
.event-day-time input:checked + .input-checkbox-icon {background:#1fb5ad;}
.event-day-time input:checked + .input-checkbox-icon:before {content:''; width:12px; height:6px; border:solid #fff; border-width:0 0 2px 2px; transform:rotatez(-45deg); -webkit-transform:rotatez(-45deg); -ms-transform:rotatez(-45deg); -o-transform:rotatez(-45deg); -moz-transform:rotatez(-45deg); display:inline-block; position:absolute; left:0px; top:2px;}
.reminder-n-guests {margin-top:15px;}

.ui-timepicker-container {padding:0;}
.ui-timepicker.ui-widget-content {background:#fff; padding:0;}
.ui-timepicker.ui-widget-content .ui-state-hover {background:#eee; border-color:#eee; border-radius:0; cursor:pointer;}

.controls.remove_n.modal-backdrop.inotify .fa {cursor:pointer; text-align:center; font-size:20px; width:35px; line-height:35px; border-radius:50px;}
.controls.remove_n.modal-backdrop.inotify .fa:hover {background:#f1f3f4;}
.tab-title {font-size:14px; margin-bottom:25px; border-bottom:1px solid #ccc; font-weight:bold; color:#1fb5ad;}
.tab-title span {position:relative; padding-bottom:7px; display:inline-block;}
.tab-title span:before {content:''; border:1.5px solid; display:inline-block; width:100%; position:absolute; bottom:-1px; border-radius:3px 3px 0 0; background:#1fb5ad;}

.modal-footer .btn {background:none;}
.modal-footer .btn:hover {background:#d5d5d5;}
.modal-footer .btn-success {background:#1eb5ad; border-color:#1eb5ad;}
.modal-footer .btn-success:hover {background:#129e97; border-color:#129e97;}

.client_booking_status {color:#fff; font-size:11px; font-weight:bold; padding:2px 5px; margin-left:50px; border-radius:3px; letter-spacing:0.3px; font-family:sans-serif;}

td.fc-day:hover, .fc-unthemed td.fc-today, .fc-unthemed td.fc-day-hover {background:#E4F6F5; cursor:pointer; position:relative;}
.fc-ltr .fc-basic-view .fc-day-hover .fc-day-number {background:#62CBC6;}
.fc-day.fc-day-hover:before {content:'+'; position:absolute; left:50%; text-align:center; top:50%; font-size:45px; width:26px; height:26px; line-height:26px; margin-left:-13px;}
.check_booking {text-transform: uppercase;background-color: #1eb5ad;color: #fff;padding: 7px 10px; font-weight:700;}
.check_booking:hover, .check_booking:focus {background-color:#646464; transition:0.4s; color:#fff;}
.icons-plot .icon:hover {background: #f5f5f5;}
.icons-plot .icon[disabled] {opacity: .5;cursor: not-allowed;}
label.error {color: #a94442 !important;border-color: #ebcc;background: #ebcc;padding: 5px !important;border-radius: 6px;margin-top: 6px;}
.location-icon {float:right; margin-top:-33px; margin-right:1px; color:#fff; background:#1eb5ad; height:32px; width:32px; text-align:center; line-height:36px; font-size:24px; cursor:pointer; opacity:.8;}
.location-icon:hover {opacity:1;}
.location-input {padding-right:40px;}
.fc-event-container .fc-day-grid-event.gcal-event-hollydays:not(.fc-not-end):after {content: '\e814';font-family: "icon-anbruch";font-size: 24px;margin-right: -11px;margin-top: 3px;}
#calendar-listing.dropdown-menu li.divider {padding: 0;background: transparent;border: 0;border-top: 2px dashed #999;}
#calendar-listing.dropdown-menu li.dropdown-header {font-size: 14px;color: #000;font-weight: 700;}
#calendar-listing.dropdown-menu li.dropdown-header:hover {cursor: default;}
.fc-toolbar{
  margin-top: 20px;
}
.fc-left .fc-button-group{
margin-left: 20px !important;
}.fc-year-view .fc-event-container{/*display: none !important;*/
}
.fc-year-view .fc-year-month-border{display: none !important;
}
.fc-year-view .fc-year-month-separator{/*display: none;*/width: 1% !important;
}
.fc-year-view .fc-year-monthly-name{
text-align: center;font-size: 20px;
}
.fc-other-month{opacity: 0.5 !important;
}
.fc-year-view .fc-day-number{text-align: center !important;
}
.fc-year-view .fc-time{display: none !important;
}
.delete {display: inline-block;float: right;border-radius: 50%;width: 30px;height: 30px;
}
.detete:hover{background-color: red;
}
#share_modal  .modal-dialog {overflow: visible !important;
}
.intro {background-color: rgb(251, 233, 231) !important;border: 1px solid red;}/**/
.repeat{height: 40px !important;margin-bottom: 3px;margin-top: 13px;padding-left: 1px; margin-right: 20px;}
.repeat input{width: 125px !important; margin-left:8px; margin-right:10px;height: 35px;padding: 0px;background-color: #f1f3f4 !important;border: 0px;padding-left: 12px;color: #555 !important;}
.note {margin-top: 12px; width: 158px;margin-left: -29px !important;}
.note select{width: 128px;}
.get-notify1 .notification-via{cursor: pointer;color: #767676 !important;border-radius: 4px !important;border: 1px solid #d2dae1;/*margin-right: 10px;*/font-weight: 400 !important;width: 130px !important;margin-left: 0px !important;background: #f1f3f4;border: 0px;
}
.get-notify .notification-via{cursor: pointer;color: #767676 !important;border-radius: 4px !important;border: 1px solid #d2dae1;/* margin-right: 10px;*/font-weight: 400 !important;/*width: 130px !important;*/margin-left: 0px !important;
}
.notification-via :hover{background-color: #f5f5f5 !important;
}
.get-notify .close{margin-top: 35px;margin-right: 115px;border-radius: 50%;
}
.get-notify .close :hover{color: #000;text-decoration: none;cursor: pointer;  opacity: .5;
}
.notification_interval{margin-top: 30px;margin-left: -10px;cursor: pointer;
}
.notification_interval input{height: 37px;border: 0px;background: #f1f3f4;width: 144px;/* padding-left: 10px;*/
}
.notification_type {/*margin-top: 30px;margin-left: -38px;*/cursor: pointer;
}
.notification_type select{background: #f1f3f4;border: 0px;width: 100px;margin-left: 83px;margin-top: 30px;}
.notification_via{background: #f1f3f4;border: 0px;width: 125px;margin-top: 12px;
} 
.note1{margin-right: 10px !important;
}
.add-notification{margin-top: 15px;margin-bottom: 10px;
}
.get-notify2{margin-bottom: 10px;margin-top: 0px;margin-left: 23px;
}
#addClassSchedule1 .add-title{height: 30px;background-color: white !important;/*color: black !important;*/font-size: 30px !important;font-family: 'Google Sans',Roboto,Arial,sans-serif !important;/*margin-left: 20px;*/font-weight: 0px !important;border: 0px !important;border-bottom: 1px solid #f1f3f4 !important;
}
#addClassSchedule1 .title-div{margin-left: 50px;
}
#addClassSchedule1 .start-date {margin-left: 10px;border: 0px !important;width: 95px !important;height: 40px !important;/* background-color: white !important;*/font-size: 14px !important;margin-right: 0px !important;font-weight: 400 !important;/* padding: 0px !important; */
}#addClassSchedule1 .start-time{
/*background-color: white !important;*/width: 90px !important;border: 0px !important;height: 40px !important;font-size: 14px !important;margin: 0px !important;/* padding: 0px !important; *//* padding-left: 56px; */font-weight: 400 !important;
}
#addClassSchedule1 .end-date{/*margin-left: 10px;*/width: 100px !important;height: 40px !important;border: 0px !important;/*background-color: white !important;*/font-size: 14px !important;margin-right: 5px !important;font-weight: 500 !important;/* padding: 0px !important; */
}#addClassSchedule1 .end-time{
/* background-color: white !important;*/width: 89px !important;border: 0px !important;height: 40px !important;font-size: 14px !important;/* margin: 0px !important; */margin-left: -4px;/* padding: 0px !important; */font-weight: 400 !important;
}#addClassSchedule1 .modal-dialog{width: 40%;}
#addClassSchedule1 .location-icon1 {float: right;margin-top: 2px;margin-right: 0px;color: #fff;background: #1eb5ad;height: 32px;width: 32px;text-align: center;line-height: 36px;font-size: 24px;cursor: pointer;opacity: .8;
}
#addClassSchedule1 .location{border: 0px !important;width: 397px !important;margin-left: 13px !important;/*margin-top: 5px !important;*//* background-color: white !important;*/font-size: 14px !important;
}
#addClassSchedule1 .calendar{border: 0px !important;margin-top: 5px !important;margin-left: 20px !important;background-color: white !important;
}
#addClassSchedule1 .guest1{border: 0px !important;width: 397px !important;margin-left: 5px !important;/* margin-top: 10px !important;*//*background-color: white !important;*/font-size: 14px !important;  
}
#addClassSchedule1 .scroller1{margin-top: 5px !important;
}
#addClassSchedule1 .modal-footer{border-top: 0px !important;
}
#addClassSchedule1 .modal-footer{padding-top: 0px !important;
}
#addClassSchedule1 .save-btn{width: 93px;height: 35px;font-size: 135%;margin-right: 0px !important;}
#addClassSchedule1 #calendar_type, #calendar_type2, #visibility {cursor:pointer; width:237px; background:#f1f3f4; border:0; border-radius:4px; margin-left:10px;}
.save-btn{width: 95px;height: 40px;font-size: 135%;
}
#addClassSchedule1 .guest2{border: 0px !important;width: 88% !important;margin-left: 5px !important;margin-top: 10px !important;background-color: white !important;font-size: 18px !important;  
}
#addClassSchedule1 .start-date:hover{
background-color: #f1f3f4 !important;
}
#addClassSchedule1 .start-time:hover{
background-color: #f1f3f4 !important;
}
#addClassSchedule1 .end-date:hover{
background-color: #f1f3f4 !important;
}
#addClassSchedule1 .end-time:hover{
background-color: #f1f3f4 !important;
}
#addClassSchedule1 .guest1:hover{
background-color: #f1f3f4 !important;
/*border-bottom: 2px solid #1fb5ad !important;*/
}
#addClassSchedule1 .guest2:hover{
background-color: #f1f3f4 !important;
border-bottom: 2px solid #1fb5ad !important;
}
#addClassSchedule1 .location:hover{
/*border-bottom: 2px solid #1fb5ad !important; */
background-color: #f1f3f4 !important;
}#addClassSchedule1 .add-title:hover{
border-bottom: 2px solid #1fb5ad !important; }
#addClassSchedule .close, #editClassScheduleNew .close{position: absolute;margin-top: -28px;margin-left: 200px;
}
.title{/*width: 550px !important;*/height: 50px;background-color: white !important;font-size: 22px;border-bottom: 1px solid #f1f3f4 !important;
}
.first-part{
margin-left: 22px;
}
#addClassSchedule .add-notification{margin-top: 0px;margin-bottom: 15px;margin-left: 12px;
}#editClassScheduleNew .add-notification{margin-top: -25px;margin-bottom: 15px;margin-left: 39px;
}
/*.notes-div{margin-top: 15px; width: 95%;
}*/
.location-div{padding-right: 0px !important;width: 92%;}
.save-btn{width: 100px;height: 45px;font-size: 135%;background-color: #1eb5ad;color: white;border: 0px;border-radius: 8%;}
.edit-title{font-size: 22px;padding: 0px;
}
.event-icon{font-size: 20px;
}
.event-div{margin-top: 0px;margin-left: -40px;
}
.event-div .startDay, .endDate{padding: 0px;font-size: 13px;
}
.address-icon{font-size: 15px;padding: 0px;margin-left: 15px;
}
.event-address{padding: 0px;font-size: 14px;margin-left: -45px;
}
.edit-modal-width{max-width: 100%;width: 448px;
}#addClassSchedule1 .modal-body {padding-bottom: 0px !important;padding-top: 0px !important;
}
#addClassSchedule1 .add-title {font-size: 25px !important;font-weight: 400 !important;}
#addClassSchedule1 .start-date{
font-weight: 400 !important;
font-size: 14px !important;
width: 100px !important;
}
#eventViewModal .service-box span {font-size: 14px;margin-bottom: 8px;display: inline-block;
}
#eventViewModal .modal-body {padding: 0px 0px 0px 0px !important;
}
#eventViewModal .eventView-row {padding:5px 10px; margin-top: 0px;}
#eventViewModal .icons-plot .close-modal {margin-left:6px;}
/*.modal-backdrop.in{opacity: 0!important;
}*/
#eventViewModal .material-icons{
margin-left: -6px;
}
#eventViewModal .service-box label, .service-box .label-col{font-weight: 400;font-size: 14px;
}
.calendar-div{margin-bottom: 10px;
}
#editClassScheduleNew .notes-div .controls{width: 106%;
}#addClassSchedule .notes-div .controls{width: 109%;
}
.close-div{position: relative;z-index: 130;/* left: -338px; */top: 4px;cursor: pointer;/* display: inline-block; *//* background: #000; */width: 40px;height: 40px;float: left;font-size: 25px;left: -22px;margin-left: 4px !important;
}
#editClassScheduleNew .event-day-time, #addClassSchedule  .event-day-time{
margin-left: 1px;
}
.modal.fade:not(.in) .modal-dialog {-webkit-transform: translate3d(-25%, 0, 0);transform: translate3d(-25%, 0, 0);
}
#addClassSchedule .file_uploader, #editClassScheduleNew .file_uploader {border: 2px dashed #1eb5ad;background: #f1f3f4;padding: 6px;position: relative;text-align: center;top: -100px;left: 280px;font-size: 13px;width: 220px;color: #16514e;
}
#addClassSchedule .wrapper ,#editClassScheduleNew .wrapper{
position: absolute;right: 0;
}
#addClassSchedule .file_uploader input, #editClassScheduleNew .file_uploader input {position: absolute;width: 100%;height: 100%;left: 0;top: 0;opacity: 0;cursor: pointer;
}
.add-toogle-class{padding-top: 5px;/*height: 45px;*/border-bottom: 1px solid rgba(32,33,36,.1);margin-top: 5px;border-top: 1px solid rgba(32,33,36,.1);
}
#editClassScheduleNew .guest-list-scroller {max-height:110px; overflow:auto;}.add-background{background-color: #f1f3f4 !important;border-bottom: 1px solid red !important;
}
#editClassScheduleNew .attached_files .fa-paperclip{font-size: 24px;margin-left: 1px;margin-right: 10px;
}
#fullCalModal span.close-modal:before , #eventViewModal   span.close-modal:before{top: 18px;left: 11px;}
#fullCalModal span.close-modal:after ,#eventViewModal span.close-modal:after{top: 18px;left: 11px}
#eventViewModal .invited_dv{max-height: 145px;overflow: auto;
}
#fullCalModal .modal-header .icons-plot {width:50%;}#fullCalModal .title {width:45%;}
#fullCalModal .icons-plot .icon{margin-bottom: -12px;}
#fullCalModal .modal-body{padding: 0px;
}
#fullCalModal .event-address{margin-bottom: 0px !important;}
#fullCalModal .fa-clock{margin-left: -3px;}
.fa-clock{font-size: 18px !important;
}
#fullCalModal .tab-title{
margin-bottom: 0px !important;
}
.event-color{background-color: red;height: 14px;width: 14px;border-radius: 4px;margin-left: -2px;margin-top: 8px !important;
}
#eventViewModal .fa-download{display: none;
}
#eventViewModal .btn-link{margin-left: -14px;margin-top: -8px;}
/*#eventViewModal .modal-backdrop, #eventViewModal .modal-backdrop.fade.in{
opacity: 0;
}*/
.close-div:hover{background-color: #f1f3f4;border-radius: 30px;   
}
#editClassScheduleNew span.close-modal:before,#addClassSchedule span.close-modal:before{top: 19px;left: 12px;
}
#editClassScheduleNew span.close-modal:after,  #addClassSchedule span.close-modal:after{ top: 19px;left: 12px;
}/*Modal style start*/
#editClassSchedule .close-div {position: relative;z-index: 130;top: 4px;cursor: pointer;width: 40px;height: 40px;float: left;font-size: 25px;}
#editClassSchedule span.close-modal:before {content: "";width: 18px;height: 2px;position: absolute;background: #5f6368;transform: rotate(45deg);top: 19px;left: 11px;}
#editClassSchedule span.close-modal:after {content: "";width: 18px;height: 2px;position: absolute;transform: rotate(-45deg);background: #5f6368;top: 19px;left: 11px;}
#editClassSchedule .event-day-time {margin-left: 1px;}
#editClassSchedule .save-btn {width: 105px;height: 40px;font-size: 135%;background-color: #1eb5ad;color: white;order: 0px;border-radius: 8%;}
#editClassSchedule .event-day-time input {width: 110px;margin-right: 8px;display: inline-block;
}
#editClassSchedule .modal-body label{font-weight: 600;color: #16514e;letter-spacing: 0.2px;padding: 4px 0;
}
#editClassSchedule .event-day-time .input-checkbox-icon {display: inline-block;width: 17px;height: 17px;border: 2px solid #1fb5ad;border-radius: 3px;margin: 6px 6px 0 0;vertical-align: bottom;position: relative;
}
#editClassSchedule .form-control{border: 0;background-color: #f1f3f4;
}
#editClassSchedule .title {height: 50px;background-color: white !important;font-size: 22px;border-bottom: 1px solid #f1f3f4 !important;
}
#editClassSchedule .alert-true
{color:#3c763d;
}
#editClassSchedule .alert-false
{color:#a94442;
}
#editClassSchedule .get-notify{margin-bottom: 10px;margin-top: 0px;margin-left: 23px;
}
#editClassSchedule #add-notification-btn{margin-top: -26px;margin-bottom: 15px;margin-left: 40px;
}
#editClassSchedule .notification-via{
width:125px !important;
}
#editClassSchedule .repeat input{
width: 125px !important;
margin-left: 10px;
}
#editClassSchedule .note select{
width: 125px;
margin-left: 20px;
}
#editClassSchedule .get-notify .close
{
margin-right: 120px;}
#editClassSchedule .file_uploader {border: 2px dashed #1eb5ad;background: #f1f3f4;padding: 6px;position: relative;text-align: center;top: 3px;left: 270px;font-size: 12px;width: 105px;color: #16514e;
}
#editClassSchedule #cke_notes{ margin-top:-34px; width: 106%;}
#editClassSchedule .scrollers{ max-height: 350px;overflow-y: scroll;overflow-x: hidden;margin: -25px -15px 0 0;
}
#editClassSchedule .cke_reset{height:250px !important;
}
#editClassSchedule .note { margin-top:30px; }
#editClassSchedule .check_booking {text-transform: uppercase;background-color: #1eb5ad;color: #fff;padding: 5px 4px; font-weight:700; border-radius: 5px;}
#editClassSchedule .update_schedule_timing2 { width: 100px;height: 40px;font-size: 140%;background-color: #1eb5ad;color: white;order: 0px;border-radius: 8%; } 
#editClassSchedule .client_booking_status { margin-left:0px !important; }
#editClassSchedule .ajax-load {float:right; width:80px; margin:-24px -90px -21px -17px; display:none;}
/*Modal style end*/.fc-content:hover { font-weight: 700;  }
.fc-scroller {/*overflow-x: hidden !important;overflow-y: hidden !important;*/height: auto !important;
}
#calendar .fc-time-grid-container{height: 939px !important;overflow-y: scroll;
}
.fc-toolbar .fc-right .fc-button-group .fc-button{margin-right: 10px !important
}
#booking_calendar .fc-scroller{overflow-x: scroll;overflow-y: scroll !important;height: 300px !important;
}
.booking-modal{width: 75% !important;
}
#editClassSchedule .event-location{
margin-top: 20px !important;
}#editClassSchedule .location-div1 {padding-right: 19px !important;width: 85% !important;
}
#editClassSchedule #book_status strong{margin-right: 90px !important;
}
#editClassSchedule .notification-via{cursor: pointer;color: #c2c2c2 !important;border-radius: 4px !important;border: 1px solid #d2dae1;/* margin-right: 10px; */background: #f1f3f4 !important;border: 0px;font-weight: 700 !important;width: 77px !important;
}
#editClassSchedule .repeat input {cursor: pointer;color: #c2c2c2 !important;border-radius: 4px !important;border: 1px solid #d2dae1;/* margin-right: 10px; */background: #f1f3f4 !important;border: 0px;font-weight: 700 !important;width: 77px !important;}
#editClassSchedule .close {position: absolute;margin-top: 36px !important;/*margin-right: 30px !important;*/margin-left: -52px !important;
}
#editClassSchedule .fc-row .fc-week .fc-widget-content{
border-right-width: 1px !important;margin-right: 7px !important;
}
#editClassScheduleNew .modal-body .event-recurrence {display: block !important;
}
#editClassSchedule .modal-body .event-recurrence {display: block !important;
}
#editClassSchedule .invite{width: 20px !important;
}
.wrapper{margin-top: 0px ;padding: 0px 15px  0px 15px !important;
}
#calendar .fc-month-view .fc-rigid{
height: calc(16.5vh - 14px) !important;
/*height: 85px !important;*/
}
#calendar .fc-toolbar{margin-top: 0px !important;
}
#calendar .fc-month-view.fc-view-container{margin-top: 0px !important;}
#calendar .fc-month-view .fc-basic-view > table {height:calc(100vh - 159px); height:-webkit-calc(100vh - 159px);}
#main-content .panel {margin-bottom:0;}
.header{display: none}
.tab-title{display: none}
.panel-heading{padding: 0px !important;
}
#calendar .fc-month-view .fs-label-wrap .fs-label{    padding: 10px 20px 5px 7px !important;}
.panel .panel-heading a.module_head{    padding: 5px 15px !important;}
/*.panel{margin-bottom:0px !important;}*/
.fc-event-container .fc-day-grid-event:not(.fc-not-end):after{content: '\f274';font-family: "Font Awesome 5 Free";position: absolute;right: 0px;padding: 4px;top: -5px;line-height: 22px;}

/*.fc-event-container .fc-day-grid-event:not(.fc-not-end):after{content: '\d7';font-family: "Font Awesome 5 Free";position: absolute;right: 0px;padding: 4px;top: -5px;line-height: 22px;font-size:-webkit-xxx-large;}*/

.fc-event-container .replace_book:not(.fc-not-end):after {
position: absolute;
content: "";
background-color: #333;
width: 95%;
top: 35%;
}

#calendar .fc-content{width: 130px !important;}
#calendar .fc-popover .fc-content{width: 150px !important;}
#collapse:hover{    color: #fff !important;opacity: .9;}
#expand:hover{    color: #fff !important;opacity: .9;}
.pac-container{z-index:9999 !important;}
#addClassSchedule .file_uploader, #editClassScheduleNew .file_uploader {border: 2px dashed #1eb5ad;background: #f1f3f4;padding: 6px;position: absolute;text-align: center;top: 3px;left: 315px;font-size: 13px;width: 220px;color: #16514e;
}
#editClassSchedule .file_uploader {top: 35px !important;
}
.fc-past{
  color: #c6d6d1;
}
#eventViewModal .remove_event_invited{display: none}
#reminder_event_modal .head .fa-clock-o {color:#fff !important;}
#reminder_event_modal {width:350px; background-color:#fdfdfd; box-shadow:0px 3px 20px -10px; max-height:370px; overflow-y:scroll;position: fixed;right: -350px;top: 200px;z-index: 9;transition: all 0.25s ease-in;}
#reminder_event_modal .head {background-color:#11b6ab; padding:5px;}
#reminder_event_modal .head p {margin:5px; color:#fff; padding:5px; font-size:15px; font-weight:600;}
#reminder_event_modal .head i {margin-right:8px;}
#reminder_event_modal .left .date {font-size:11px; margin:5px 0;font-weight: 700;color: #1cb6ab;opacity: .75;}
#reminder_event_modal .left h6 {margin:8px 0; font-size:13px; font-weight:700;color: black}
#reminder_event_modal .left .discription {font-size:12px; margin:0; font-weight: 600}
.description-link { color:#767676; }
.description-link:hover { color:#5dc9c1; }
#reminder_event_modal .right .btn {font-size:12px; font-weight:600; padding:4px 8px; margin:5px 0px; border-radius:20px;}
#reminder_event_modal .left {width:50%;}
#reminder_event_modal .right {width:50%;margin-bottom: 25px;margin-top: 17px}
#reminder_event_modal .reminder-item {display:flex; padding:6px 12px; border-bottom:2px solid #e0e0e0;}
#reminder_event_modal.open{right: 0;}
#reminder_event_modal label.status {position: relative;padding: 6px;cursor: pointer;color: #4CAF50;float: right;}
#reminder_event_modal label.status input {position: absolute;visibility: hidden;}
#reminder_event_modal span.status-label {border-radius: 32px;border: 2px solid;padding: 4px 10px 4px 10px;position: relative;font-size: 10px;}
#reminder_event_modal span.radio-icon {border: 2px solid;padding: 2px;background: #fff;display: inline-block;border-radius: 7px;position: absolute;left: 12px;top: 9px;}
#reminder_event_modal label.status.ignore {color: #F44336;}
 #reminder_event_modal label.status input:checked + .status-label {background:currentColor;}
 #reminder_event_modal label.status input:checked + .status-label .text {color:#fff; position:relative;} 
 #reminder_event_modal label.status input:checked + .status-label .radio-icon {color:#fff;}
 #reminder_event_modal #reminder_event_modal-close:hover {cursor: pointer;color: }
 #reminder_event_modal.show_reminder_event  {max-height: 280px;overflow-y: scroll;overflow: auto;}

 
 #booking_popup span.close-modal:before , #eventViewModal   span.close-modal:before{top: 18px;left: 11px;}
#booking_popup span.close-modal:after ,#eventViewModal span.close-modal:after{top: 18px;left: 11px}
#eventViewModal .invited_dv{max-height: 145px;overflow: auto;
}
#booking_popup .modal-header .icons-plot {width:50%;}#booking_popup .title {width:45%;}
#booking_popup .icons-plot .icon{margin-bottom: -12px;}
#booking_popup .modal-body{padding: 0px;
}
#booking_popup .event-address{margin-bottom: 0px !important;}
#booking_popup .fa-clock{margin-left: -3px;}
.fa-clock{font-size: 18px !important;
}
#booking_popup .tab-title{
margin-bottom: 0px !important;
}

 
</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        
        <?php $this->load->view('common/alert'); 
        ?>

        <h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Bookings</span> </h3>
        
 
<!-- Define content -->
<div id="popupBottom" class="popover">
    <div class="arrow"></div>
    <h3 class="popover-title">Bottom</h3>
    <div class="popover-content">
        <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. 
            Pellentesque ornare sem lacinia quam venenatis vestibulum.
            <a href="#" class="btn btn-default helloWorld">Click me</a>
        </p>
    </div>
</div>        
                  <?php

                  $user = $_GET['user'];
                  $user = explode(",",$user);
                 if($user[0] == "all"){
                    $selected = "selected";
            
                 }else { $selected = ""; ?>
                
               <?php }
               $selected1 = isset($show_booking_all)?'selected':'';
                ?>
        <section class="panel">
            <header class="panel-heading selUser">
                <label style="margin-left:15px"> Showing Records of </label>              
                <?php if($superAdmin == true || $_SESSION['role_id'] == 7) {  ?>
                 
                    <select id="popular" name="own[]"  multiple="multiple" class="popular-list" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
                        <option <?php echo $selected1 .$selected; ?> value="all">All</option>
                        <?php foreach ($users_list as $option_key => $option) { ?>
                          <option value="<?php echo $option['id']; ?>" <?php if(in_array($option['id'], $user_array)) { echo "selected"; 
                         } ?> ><?php echo $option['title']; ?></option>
                        <?php } ?>
                        
                    </select>
            
                <?php } 
                else 
                { //echo $username;  ?> 
                  
                  <select id="popular" name="own[]" multiple="multiple" class="popular-list" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
                        <?php foreach ($optional_users_list as $option_key => $option) { ?>
                            <option  value="<?php echo $option['id']; ?>" <?php if(in_array($option['id'], $user_array)) { echo "selected";
                             } ?> ><?php echo $option['title']; ?></option>
                        <?php } ?>
                    </select>                         
                <?php   } ?> 
             <ul class="nav top-menu" id="cal-list">
              <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle" id="calendar-listing-btn" title="Choose calendar">My Calendars <i class="fa fa-angle-down"></i></a>
                        
                        <ul class="dropdown-menu extended" id='calendar-listing'>
                          <li class="estimator-all" style="color:#000;">
                            <input type="checkbox" class="check_all" value="all" checked />
                            <span class="prevent-checkbox" style="background:#000;"></span>
                            <span class="cal-all">All</span>
                          </li>

                          <li class="estimator-list" id="estId_1"  style="color: #777">
                            <input type="checkbox" class="est_checkbox" value = "1"/>
                            <span class="prevent-checkbox" style="background:#777;"></span>
                            <span class="cal-span-list">Default Calendar</span>
                          </li>

                          <?php 
                            if(!empty($calendars))
                           {
                            foreach ($calendars as $key => $estimator) 
                            {
                            ?>
                            
                            <li class="estimator-list" id="<?php echo 'estId_'.$estimator['id'];?>"  style="color: <?php echo $estimator['color'];?>">
                                <input type="checkbox" class="est_checkbox" value="<?php echo $estimator['id'] ?>" data-timezone="<?php echo $estimator['timezone'] ?>"/>
                                <span class="prevent-checkbox" style="background: <?php echo $estimator['color'];?>"></span>
                                <span class="cal-span-list"><?php echo $estimator['name'];?>                             
                                </span>
                              <?php echo isset($estimator['access']) && $estimator['access'] == 2 ? '' : '<div class="delete fa fa-trash" id="'.$estimator["id"].'"> </div>';?>      
                                <?php echo isset($estimator['access']) && $estimator['access'] == 2 ? '<b style="float:right; color:#0f504d; font-size:12px;">SHARED</b>' : '';?>
                            </li>
                          <?php    
                            }
                           }
                           ?>
                            <li class="divider"></li>
                            <li class="dropdown-header">Other Calendar</li>
                            <li class="holiday-li"><input type="checkbox" class="reminder_checkbox" value="Reminders"/><span class="prevent-checkbox" style="background: #F47E2A"></span><span style="color: #777;">Reminders</span></li>
                            <li class="holiday-li"><input type="checkbox" class="holidays_checkbox" value="holidays" checked/><span class="prevent-checkbox" style="background: #777"></span><span style="color: #777;">Holidays in US</span></li>
                            <li class="holiday-li"><input type="checkbox" class="holidays_canada_checkbox" value="holidays" checked/><span class="prevent-checkbox" style="background: #777;"></span><span style="color: #777;">Holidays in Canada</span></li>
                        </ul>
                   </li>
                  </ul>
              </li>
                </ul>
                  <a class="btn add_calendar module_head" id="add_calendar" href="<?php echo base_url('calendar/createcalendar');?>"><i class="fa fa-calendar-plus"> </i> Add Calendar</a>
                  <?php if($role_id == 1 || $_SESSION['role_id'] == 7 || in_array('shareCalendar',json_decode($permissions))) { ?>
                  <a class="btn share_btn module_head" id="share_btn" href="#" title="Share Calendar" data-toggle="modal" data-target="#share_modal"><i class="fa fa-share-alt"> </i> SHARE</a> 
                <?php }?>
                <button class="btn" id="expand" style="background-color:#1fb5ad !important; padding: 2px 5px; float:right;margin-right: 10px;" title="Expand"><img src="<?php echo base_url(); ?>/assets/images/expand.png" style="width: 22px;"> </button> 
                <!-- <a class="btn" id="expand" ><i class="fa fa-expand"> </i></a>  -->
                <!-- <a class="btn" id="collapse" ><i class="fa fa-collapse"> </i></a> --> 
                <button class="btn" id="collapse" style="background-color:#1fb5ad !important; padding: 4px 5px; display:none; float:right;margin-right: 10px;" title="Collapse"><img src="<?php echo base_url(); ?>/assets/images/collapse.png" style="width: 22px;"></button>



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
                        <img src="<?php echo base_url('assets/images/loader.gif');?>" class="calendar-loader hide" style="position: absolute;top: 40%;right: 47%;z-index: 1;width: 82px">
                    </aside>                   
                    
                </div>
                <!-- page end-->
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->



<div id="fullCalModal" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog edit-modal-width">
    <div class="modal-content">
      <div class="modal-header">

        <div class="title">
          <!-- <span class="event-color" style="background:#1fb5ad;"></span>
          <h4 id="modalTitle" class="modal-title"></h4> -->
        </div>

        <div class="icons-plot">

        <span class="icon edit_schedule"><i class="far fa-edit"></i> <span class="hover-title">Edit </span> </span>
        <span class="icon duplicate_booking"><i class="far fa-clone"></i> <span class="hover-title">Duplicate </span> </span>
        <span class="icon delete_booking" data-delete='' id="delete-booking"><i class="far fa-trash-alt"></i> <span class="hover-title" >Delete </span> </span>
        <span class="icon close-modal" data-dismiss="modal"></i> <span class="hover-title">Close </span> </span>
        </div>
      </div>
      <div id="modalBody" class="modal-body service-box" style="margin-bottom: -15px;">


      </div>
    
    </div>
  </div>
</div>


<div id="editClassSchedule" class="modal fade" data-backdrop="static" data-keyboard="false">  
  <div class="modal-dialog booking-modal">
    <div class="modal-content">
      <div class="row">
        <div class="col-xs-8">
    <form id="frmEditBooking3" name="frmEditBooking3" method="post" action="<?php echo base_url('booking/bookupdate');?>">  
      <input type="hidden" name="booking_id" id="booking_id">
      <input type="hidden" name="record_id" id="record_id">     
      <input type="hidden" name="google_event_id" id="google_event_id">     
      <input type="hidden" name="title" id="title_id">      
      <input type="hidden" name="previous_invitee" id="previous_invitee">
      <input type="hidden" name="email" id="email">
      <input type="hidden" name="name" id="name">     
      <input type="hidden" name="current_module" id="current_module" value="">
      <input type="hidden" name="event_id" id="event_id" value="">
      <input type="hidden" name="created_for" id="created_for"> 
      <input type="hidden" name="proposed_end_time" id="proposed_end_time">      
     
      
      <div id="classScheduleBody" class="modal-body">
      <div class="first-part">
        <div class="row">
          <span class="icon close-modal close-div" data-dismiss="modal">
                <span>&nbsp;</span>
          </span>
              <div class="col-xs-8">
                <div class="form-group">
                  <div class="controls">
                    <input type="text" class="input-xlarge form-control title" name="booking_title" id="booking_title" placeholder="Enter title" style="width:100%;background-color: white !important;">
                  </div>                
                </div>
              </div>          
            <div class="col-xs-2">
                <img src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" class="ajax-load">
                <button class='btn btn-success update_schedule_timing2' type="button">Update</button>
            </div>
          </div>
          <span class="fa fa-calendar" style="margin-top: 2px;float: left;margin-left: -20px;font-size: 20px;"></span>
            <div class="row event-day-time" style="display: inline-block;">
              <div class="col-xs-12">
                <input class="input-xlarge form-control datepicker" name="start_date" id="start_date"  type="text" required="" value="" required autocomplete="off" readonly="true">
                <input class="input-xlarge form-control start_time_dv" name="start_time" id="start_time" value="" required="" type="text" autocomplete="off" >
                <span style="margin-right:8px;"> to </span>
                <input class="input-xlarge form-control datepicker" name="end_date" id="end_date" type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off" style="display:none">
                <input class="input-xlarge form-control timepicker start_time_dv" name="end_time" id="end_time" value="" type="text" placeholder="HH:MM" autocomplete="off" >
                <label id="time-error" class="error" style="display: none;"></label>
                <label class="control-label event-recurrence" style="display:none">
                    <input class="form-control checkbox" style="display:none" name="all_day" id="all_day" value="1"  type="checkbox" style="width:17px; position:absolute; visibility:hidden;">
                    <span class="input-checkbox-icon" style="display:none"></span>
                    <span style="display:none"> All Day </span>
                  </label>
              
                  <div class="booking-alert"></div>
              </div>

              <div class="col-xs-12">
              
                  <label style="display: none;">Visibility</label>
                  <select style="display: none;" name="visibility" id="visibility">
                    <option value="public">Public</option>
                    <option value="private">Private</option>                  
                  </select>
              </div>
            </div> <!-- /.row.event-day-time -->
          </div>

          <div class="row flex-row">
            <div class="col-sm-8 col-xs-12">
              <div class="tab-title"> <span>Event Details</span> </div>
              <div class="scrollers">
                <div class="row">
                  <div class="col-xs-12">

                    <div class="row event-location"> 
                     <i class="material-icons" style="margin-left:11px; font-size:28px; float:left;">location_on</i>
                     <div class="col-xs-10 location-div1" >
                        <input type="text" class="form-control location-input event_location" id="event_location" placeholder="Enter Location" name="event_location" onFocus="geolocate()" autocomplete="off">
                        <a href="javascript:void(0)" onclick="mapsSelector2('addForm')" class="open-map btn-link" >Open location in map</a>
                        <span class="location-icon" title="Use current location"> <i class="fa fa-crosshairs" onclick="currentLocation()"></i> </span>
                      </div>
                    </div>

                    <div class="row" style="margin-top: 5px;"> 
                     <i class="fa fa-video-camera" style="margin-left:11px; font-size:24px; float:left;"></i>
                     <div class="col-xs-10" >
                        <select style="border: 0px;background: #f1f3f4; border-radius: 4px;" name="conference" id="conference">
                          <option value="0" selected disabled>Add conferencing</option>
                          <option value="1">Conference call</option>
                          <option value="2">Web meeting</option>
                        </select>
                      </div>
                    </div>

                   <div class="row event-day-time get-notify" style="margin-top:20px;margin-bottom: 10px; display:none;">
                            <div class="col-sm-3 col-xs-6" style="padding-right:0">
                                <label class="control-label" for="textfield">Notification</label>

                                  <select name="notification_via" id="notification_via" class="notification-via" style="width:123px;">
                                    <option value="1">Email</option>
                                    <!-- <option value="2">Notification</option> -->
                                  </select>
                            </div>

                            <div class="col-sm-3 col-xs-6 all_dv repeat">
                              <label class="control-label" for="textfield"></label> 
                              <input type="number" id="notification_interval1" name="notification_interval" placeholder="before" class="before-time" max="60" min="1" > 
                            </div>
                              
                              <div class="col-sm-3 col-xs-6 all_dv note">
                                <select id="notification_type" name="notification_type" class="notification-via">
                                    <option value="3">minutes</option>
                                    <option value="1">hours</option>
                                    <option value="2">days</option>
                                </select>
                              </div>
                      <!-- <i class="fas fa-times close" id="close-notification"></i> -->
                  </div>
                    <div class="row event-day-time get-notify1" style="margin-top:20px;margin-bottom: 10px;margin-left:24px; display:none">
                    </div>
                    <div style="margin-bottom: 10px;">
                      <i class="fa fa-bell add-notification-bell" style="margin-left:2px; font-size:23px;"></i>
                      <button type="button" class="btn btn-success add-notification" id="add-notification-btn" style="display:none">Add Notification</button>
                    </div>
                    <i class="fa fa-bars" aria-hidden="true" style="margin-left:2px; font-size:24px; float:left"></i>
                    <div class="col-xs-11 notes-div">
                      <div class="controls">
                        <div class="wrapper" style="margin-top:0;padding: 0;">
                        <div class="file_uploader">
                          <input type="file" name="file" id="file">
                          <span class="value"></span>
                          <span class="default">
                          <i class="fa fa-upload"></i>
                          <span class="choose">Choose a file</span> </span>
                        </div>
                      </div>
                      <textarea name="notes" id="notes"></textarea>          
                  </div>                
                </div>
             </div>
          </div>
        </div>
      </div>        
      <div class="col-sm-4 col-xs-12">
          <div class="tab-title"> <span>Client</span> </div>
              <div class="form-group" style="margin-top: -20px;width: 121%;">
                <div style="margin-bottom:8px;"><i class="fas fa-briefcase"></i>  <strong> Company :</strong> <span id="c_name" style="display:inline-block;"></span> 
                </div>
                <div style="margin-bottom:8px;"><i class="fas fa-user-circle"></i>  <strong> Name :</strong> <span id="name_status" style="display:inline-block;"></span> 
                  <input type="hidden" name="lead_name" id="lead_name" value="">
                </div>
                <div style="margin-bottom:5px;"><i class="fas fa-user"></i>  <strong> Email :</strong> <span id="c_email" style="display:inline-block;"></span> 
                </div>
                <div style="margin-bottom:5px; display:none;"> <strong>Email :</strong> <span id="email_status" style="display:inline-block;"></span> </div>

                <div id="book_status" style="margin-top:5px; border-top:1px solid #ddd; padding-top:5px; display:none;" > <strong>Status :</strong> <span name="status" id="status" class="    client_booking_status" style="/*background:#1fb5ad;*/"></span> 
                </div>
                <div id="suggestion" style="display:none; margin-top:5px; border-top:1px solid #ddd; padding-top:5px;"> <strong>Suggested Time by Client:</strong> <br> <span   name="status" id="suggestionTime"></span> 
                </div> 
                <div class="col-guests">
                  <div class="tab-title" style="margin-bottom:0px !important;"> <span>Guests</span> </div>
                  <div class="row"> 
                  <div class="col-xs-12 check_guest2"></div>         
                    <div class="col-xs-12"> 
                      <div class="form-group">
                        <label class="control-label" for="textfield">Invite company contacts and guests:</label>
                        <div class="guest-list-scroller" style="overflow: hidden;overflow-y: auto;height: 72px;">
                          <div class="invite_dv" >
                          </div>
                        <div class="form-group" style="margin-top:10px;">
                          <a  class="add_invite" title="Add More" href="javascript:;" style="text-transform:uppercase;">Add Guests</a>      
                        </div>  
                        </div>  
                                      
                      </div>
                    </div>                
                  </div>          
                  <div class="row">
                <div class="col-xs-12">
               
              </div>          
            </div>  
             <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;">          
                <div class="col-xs-12"> 
                  <div class="form-group guest-list-scroller absolute" style="height: 200px">
                    <div>
                      <label class="control-label" for="textfield">
                        <span class="guest_count"></span> Guest(s)
                      </label>               
                    </div>
                    <div class="invited_dv"> </div>
                  </div>
                </div>                
              </div>  
            </div>
            </div>
        </div>

      </div>
     
      </div>
     
    </div>
       
       <div>

            <span style="margin-left: 53px">Bookings of </span>
              <?php if($superAdmin == true || $_SESSION['role_id'] == 7) {  ?>
                  
                    <select id="uleadowner" name="uleadowner"  class="" style="max-width: 50%;margin-top: 20px;margin-left: 5px;min-width: 15%;border-radius: 7px">
                        <option value="0">Select User</option>
                        <?php
                         foreach ($users_list as $option_key => $option) { 
                          ?>
                          <option value="<?php echo $option['id']; ?>" ><?php echo $option['title']; ?></option>
                        <?php } ?>
                        
                    </select>
            
                <?php } 
                else 
                { //echo $username;  ?> 
                        <?php
                         foreach ($optional_users_list as $option_key => $option) { ?>
                          <button type="button" class="btn btn-secondary" style="margin-top: 5px;margin-left: 5px;"><?php echo $option['title']; ?></button>
                        <?php } ?>
               <?php   } ?>  
        </div>
      

    </form>    
      <div class="col-xs-4">
          <img id="ajax-loader10" src="<?php echo base_url() ?>assets/images/ajax-loader.gif" style="display: none;position: absolute;left:80px;z-index: 999; top:150px;">
        <div class="col-xs-12">
          <div id="booking_calendar">
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<!-- edit model end -->

<div id="reassignModal" class="modal fade" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header background-green">
        <a href="javascript:void(0)" data-dismiss="modal" class="" title="Close modal" style="float:right;font-size: 19px;margin-right: 10px;color:#333"><i class="fas fa-window-close"></i></a>
        <h4 id="modalTitle" class="modal-title" style="color: #000;">Re-assign to other user</h4>
      </div>
      <div id="modalBody" class="modal-body service-box">
      <form id='frmAssignUser'>
        <input type="hidden" name="booking_guest_id"  id="booking_guest_id">
        <input type="hidden" name="olduser" id="olduser">
        <input type="hidden" name="reassign_booking_id" id="reassign_booking_id">
        <div class="row">
          
          <div class="col-xs-12">
            <div class="form-group">
              <p>* Once you reassign this meeting to other user, the meeting event will be removed from your calendar and you will unable to access this meeting again. </p>
            </div>  
          </div>  
        </div>  
        <div class="row">
          
          <div class="col-xs-12">
            <div class="form-group">
              <label class="control-label" for="textfield">Enter email</label>
              <div class="controls">
                <input class="input-xlarge form-control " name="newuser" id="newuser" type="text" autocomplete="off">
              </div>              
            </div>
          </div>
    
        </div>
      </form> 
      </div>
      
      <div class="modal-footer">        
  
        <button type="button" class="btn btn-success go_assign" ><i class="far fa-edit"></i>Go</button>

        <button type="button" class="btn btn-normal" data-dismiss="modal" title="Close modal"><i class="fa fa-times"></i>Close</button>     
        
      </div>
    </div>
  </div>
</div>


<div id="addClassSchedule1" class="modal fade" data-backdrop="static" data-keyboard="false">  
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    <form id="frmAddBooking1" name="frmAddBooking1" method="post" action="<?php echo base_url('calendar/add');?>">  
      <input type="hidden" name="booking_id" id="booking_id">     
      <input type="hidden" name="google_event_id" id="google_event_id">     
      <input type="hidden" name="title" id="title_id">      
      <input type="hidden" name="previous_invitee" id="previous_invitee">     
     
       
      <div id="classScheduleBody" class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="icons-plot" style="padding:0px !important; margin-right:-16px;">
              <span class="icon close-modal" data-dismiss="modal" style="font-size: 25px !important; width:50px; height:40px; margin-top:10px;">
                 <span>&nbsp;</span>
                 <span class="hover-title">Close </span>
              </span>
            </div>
            <div class="form-group">
              <div class="controls title-div">
                <input type="text" class="form-control add-title" name="booking_title" id="booking_title" placeholder="Add Title">  
              </div>
              <div id="event_title_error" style="color: red;margin-left: 60px;font-size: 15px;"></div>
            </div>
          </div>
        </div>

        <div class="row event-day-time">
          <div class="col-xs-12">
            <i class="far fa-clock" style="font-size:18px; margin-left:4px;"></i>
           
            <input class="input-xlarge form-control datepicker start-date" name="start_date" id="start_date1"  type="text" placeholder="MM/DD/YYYY" required="" value="" required autocomplete="off">
            <input class="input-xlarge form-control timepicker start_time_dv start-time" name="start_time" id="start_time1" value="" type="text"  placeholder="HH:MM" autocomplete="off">
            <span style="margin-right:3px; margin-left:0px;"> - </span>
            <input class="input-xlarge form-control datepicker end-date" name="end_date" id="end_date1"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off">

            <input class="input-xlarge form-control timepicker start_time_dv end-time" name="end_time" id="end_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">
            <label id="time-error" class="error" style="display: none;"></label>

          </div>

           <div class="col-xs-12" style="margin-top:5px;">
            <i class="fas fa-user" style="margin-left:5px; font-size:18px; float:left;"></i>
            <div class="col-xs-8 guest-div">
            <input class="input-xlarge form-control guest1" name="invite[]"  id="add-guest" type="text" placeholder="Add Guest" required="" value="" required autocomplete="off">
  
              
          </div> 
          </div>



          <div class="col-xs-12">
            <i class="material-icons" style="margin-left:3px; font-size:20px;">location_on</i>
            <input type="text" class="form-control location-input event_location location" id="event_location3" placeholder="Add Location" name="event_location" onFocus="geolocate()" autocomplete="off">
            <span class="location-icon1" title="Use current location"> <i class="fa fa-crosshairs" onclick="currentLocation()"></i> </span>
            <a href="javascript:void(0)" onclick="mapsSelector1('addForm')" class="open-map btn-link" style="display:block; margin-left:50px !important">Open location in map</a>
            
          </div>
        

            
        </div> 
        <div class="row get-notify2">
            
        </div> 
            <div class="scroller1">
              <div class="row">
                <i class="fa fa-bars" aria-hidden="true" style="margin-left:20px; font-size:18px; float:left"></i>
                <div class="col-xs-11">
                  <div class="form-group">
                    <div class="controls">
                      <textarea name="notes" id="notes2" rows="2" cols="20" contenteditable="true"></textarea>        
                    </div> 
                    <div id="note2_error" style="color: red;font-size: 15px;"></div>               
                  </div>
                </div>          
              </div>
            </div>

            <div class="col-xs-12">
        
                <i class="fa fa-calendar" style="font-size:18px; margin-left:-10px;"></i>
                  <select name="calendar_type" id="calendar_type2" class="calendar">
                  <option value = 1 style="background-color: #1eb5ad ;color: #fff;">Default Calendar</option>     
                  <?php 
                             if(!empty($calendars))
                             {
                              foreach ($calendars as $key => $estimator) 
                              { 
                             ?>
                              <option value="<?php echo $estimator['id'];?>" style="background-color:<?php echo $estimator['color'];?> ;color: #fff;"><?php echo $estimator['name'];?></option>  
                          <?php }
                            }
                          ?>
                  </select>

          </div>        

        

        <div class="row">
          
        </div>
  
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-normal saveEvent" title="">More options</button>      
        <button type="button" class="btn btn-success add_schedule_timing save-btn small-modal" >Save</button>
        <img src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" class="ajax-load">
      </div>
      
    </form> 
    </div>
  </div>
</div>

<div id="addClassSchedule" class="modal fade" data-backdrop="static" data-keyboard="false"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form id="frmAddBooking" name="frmAddBooking" method="post" action="<?php echo base_url('calendar/add');?>">  
      <input type="hidden" name="booking_id" id="booking_id">     
      <input type="hidden" name="google_event_id" id="google_event_id">     
      <input type="hidden" name="title" id="title_id">      
      <input type="hidden" name="previous_invitee" id="previous_invitee">     
      
    
      <div id="classScheduleBody" class="modal-body">
         
        <div class="first-part">
          
        <div class="row">
          <span class="icon close-modal close-div" data-dismiss="modal">
                  <span>&nbsp;</span>
          </span>
          <div class="col-xs-8" style="margin-left: -25px;">
            <div class="form-group event-day-time">

                
              <div class="controls">
               <input type="text" class="input-xlarge form-control title" name="booking_title" id="booking_title" placeholder="Add title" style="width:100%">
              
              </div>
              <div id="event_title_error_big" style="color: red;font-size: 15px;"></div>
             
            </div>
          </div>


          
          <div class="col-xs-2">
              <button class='add_schedule_timing btn save-btn big-modal' type="button">Save</button>
          </div>
        </div> 

      <span class="fa fa-calendar" style="margin-top: 8px;float: left;margin-left: -20px;font-size: 20px;"></span>
      <div class="row event-day-time" style="display: inline-block;">
          <div class="col-xs-12">
            <input class="input-xlarge form-control datepicker" name="start_date" id="start_date_more"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off">

            <input class="input-xlarge form-control timepicker start_time_dv" name="start_time" id="start_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">

            <span style="margin-right:8px;"> to </span>

            <input class="input-xlarge form-control datepicker" name="end_date" id="end_date_more"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off">

            <input class="input-xlarge form-control timepicker start_time_dv" name="end_time" id="end_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">

                <label class="control-label event-recurrence">
                  <input class="form-control checkbox" name="all_day" id="all_day" value="1"  type="checkbox" style="width:17px; position:absolute; visibility:hidden;">
                  <span class="input-checkbox-icon"></span>
                  <span> All Day </span>
                </label>
                <br>
                <label id="time-error" class="error" style="display: none;"></label>
          </div>

       
        </div> <!-- /.row.event-day-time -->
       </div>
       
          
        <div class="row reminder-n-guests flex-row">



          <div class="col-xs-12 col-sm-8 col-reminder">

            <div class="tab-title"> <span>Event Details</span> </div>

            <div class="scroller">
              <div class="row">
                <div class="col-xs-12">
                  <div class="row event-location"> 
                     <i class="material-icons" style="margin-left:11px; font-size:28px; float:left;">location_on</i>
                     <div class="col-xs-10 location-div" >
                        <input type="text" class="form-control location-input event_location" id="event_location4" placeholder="Enter Location" name="event_location" onFocus="geolocate()" autocomplete="off">
                        <a href="javascript:void(0)" onclick="mapsSelector('addForm')" class="open-map btn-link" >Open location in map</a>
                        <span class="location-icon" title="Use current location"> <i class="fa fa-crosshairs" onclick="currentLocation()"></i> </span>
                    </div>
                  </div>  

                    <div class="row" style="margin-top: 5px;"> 
                     <i class="fa fa-video-camera" style="margin-left:11px; font-size:24px; float:left;"></i>
                     <div class="col-xs-10" >
                        <select style="border: 0px;background: #f1f3f4; border-radius: 4px;" name="conference" id="conference_add_event">
                          <option value="0" selected disabled>Add conferencing</option>
                          <option value="1">Conference call</option>
                          <option value="2">Web meeting</option>
                        </select>
                      </div>
                    </div>
                    
                  <div class="row get-notify2">
                       
                  </div> 
                  <i class="fa fa-bell" style="margin-left:2px; font-size:23px;"></i>
                   <button type="button" class="btn btn-success add-notification" id="add-notification-btn" data-event='1'>Add Notification</button>             
                <div class="calendar-div">    
                  <i class="fa fa-calendar" style="font-size:24px; margin-left:2px;"></i>
                    <select name="calendar_type" id="calendar_type2">
                    <option value = 1 style="background-color: #1eb5ad ;color: #fff;">Default Calendar</option>     
                    <?php 
                               if(!empty($calendars))
                               {
                                foreach ($calendars as $key => $estimator) 
                                { 
                               ?>
                                <option value="<?php echo $estimator['id'];?>" style="background-color: <?php echo $estimator['color'];?>;color: #fff;"><?php echo $estimator['name'];?></option>   
                            <?php }
                              }
                            ?>
                    </select>
                  </div>
                  <i class="fa fa-bars" aria-hidden="true" style="margin-left:2px;margin-top:15px; font-size:24px; float:left"></i>
                  <div class="col-xs-11 notes-div">
                    
                    <div class="controls">
                    <div class="wrapper">
                      <div class="file_uploader">
                          <input type="file" name="file" id="file">
                          <span class="value"></span>
                          <span class="default">
                            <i class="fa fa-upload"></i>
                            <span class="choose">Choose a file</span> or Drag and drop
                          </span>
                        </div>
                      </div>
                      <textarea name="notes" id="notes5" rows="4" cols="106"></textarea>        
                    </div>                
                  </div>
                </div>          
              </div>

            </div> <!-- /.scroller -->

            <div class="row">
                <div class="col-xs-12">
                <div class="form-group">
                  <div class="controls">
                  
                  </div>
                </div>
              </div>
            </div>

          </div> <!-- /.col-reminder -->
          
          <div class="col-sm-4 col-xs-12 col-guests">

            <div class="tab-title"> <span>Guests</span> </div>
            
            <div class="row">         
              <div class="col-xs-12"> 
                <div class="form-group">
                  <label class="control-label" for="textfield">Invite company contacts and guests:</label>
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
                    <a  class="add_invite" title="Add More" href="javascript:;" style="text-transform:uppercase;">Add Guests</a>      
                </div>
              </div>          
            </div>  
          
             <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;display: none;">          
              <div class="col-xs-12"> 
                <div class="form-group">
                  <div>
                    <label class="control-label" for="textfield">
                      <span class="guest_count"></span> Guest(s) 
                    </label>
                  </div>

                  <div>
                    <label class="control-label guest_yes_no" for="textfield" style="font-size: 11px;">
                      <span class="guest_yes"></span>
                      <span class="guest_maybe"></span>
                      <span class="guest_no"></span>
                      <span class="guest_awaiting"></span>
                    </label>
                  </div>
                  <div class="invited_dv">
      
                  </div>
                </div>
              </div>                
            </div>  
             <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;display: none;">          
              <div class="col-xs-12"> 
                <div class="form-group">
                  <div>
                    <label class="control-label" for="textfield">
                      Guests can: 
                    </label>
                  </div>
                 <div class="guest_checkbox">  
                  <div class="check">
                    <label class="control-label" for="textfield" style="vertical-align: middle">
                      <input type="checkbox" name="modify_event" style="zoom: 1.6;">
                    </label> <span>Modify Event</span>
                  </div>
                  <div class="check">
                    <label class="control-label" for="textfield"  style="vertical-align: middle">
                      <input type="checkbox" name="invite_others" style="zoom: 1.6;">
                    </label> <span>Invite Others</span>
                  </div>
                  <div class="check">
                    <label class="control-label" for="textfield"  style="vertical-align: middle">
                      <input type="checkbox" name="see_guest_list" style="zoom: 1.6;">
                    </label> <span>See guest list</span>
                  </div>
                 </div> 
                </div>
              </div>                
            </div>          
            
          </div> <!-- /.col-guests -->

        </div> <!-- /.reminder-n-guests -->


        <div class="row">
            
        </div>
  
      </div>
     <!--  
      <div class="modal-footer">
        <button type="button" class="btn btn-normal" data-dismiss="modal" title="Close modal">Close</button>      
        <button type="button" class="btn btn-success add_schedule_timing" >Save</button>
        <img src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" class="ajax-load">
      </div> -->
      
    </form> 
    </div>
  </div>
</div>

<!-- event view modal start  -->
<div id="eventViewModal" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog edit-modal-width">
    <div class="modal-content">
      <div class="modal-header background-green">

        <div class="title">
        </div>
        <div class="icons-plot">
          <span class="icon edit_event"><i class="far fa-edit"></i> <span class="hover-title">Edit </span> </span>
          <span class="icon duplicate_event"><i class="far fa-clone"></i> <span class="hover-title" style="margin-left:-15px;">Duplicate </span> </span>
          <span class="icon delete_event"><i class="far fa-trash-alt"></i> <span class="hover-title" style="margin-left:-5px;">Delete </span> </span>
          <span class="icon print_event"><i class="fas fa-print"></i> <span class="hover-title">Print </span> </span>
          <span class="icon close-modal" data-dismiss="modal"><span>&nbsp;</span> <span class="hover-title">Close </span> </span>
        </div>

      <input type="hidden" name="event_id" id="event_id">
      </div>

      <div id="modalBody" class="modal-body service-box">

                <div class="eventView-row col-xs-12 "> 
                  <div class="col-xs-2 event-icon">
                    <span class="event-color">
                    </span>
                  </div>
                    <div class="col-xs-10 event-div">
                      <div class="jobName col-xs-12 edit-title">
                      </div>
                      <div class="startDay col-xs-6">
                      </div> 
                      <div class="endDate col-xs-6">
                    </div>              
                  </div>
                </div>


              <div class="eventView-row col-xs-12">
                  <div class="col-xs-2 address-icon">
                        <i class="material-icons">location_on</i>
                  </div>  
                  <div class="event_location col-xs-10 event-address">
                  </div>
              </div>
                
              <div class="eventView-row col-xs-12">
                  <div class="col-xs-2 address-icon">
                     <i class="fas fa-user"></i>
                  </div>  
                  <div class="col-xs-8 event-address">   
                      <label><span class="guest_count">0</span> Guest(s) :</label>
                      <div class="invited_dv"></div>
                  </div>          
              </div>
                
              <div class="eventView-row col-xs-12 notes-div"> 
                  <div class="col-xs-2 address-icon">
                     <i class="fa fa-bars" aria-hidden="true" ></i>
                  </div>
                  <div class="notes col-xs-10 event-address">
                  </div> 
              </div>

              <div class="eventView-row  col-xs-12"> 
                <div class="col-xs-2 address-icon">
                     <i class="fa fa-bell"></i>
                </div>
                <div class="event_notification col-xs-10 event-address">
                </div>
              </div>

              <div class="eventView-row col-xs-12" > 
                  <div class="col-xs-2 address-icon">
                       <i class="fa fa-calendar" ></i>
                  </div> 
                  <div class="calendar_name col-xs-6 event-address">
                  </div>
              </div> 

              <div class="eventView-row col-xs-12 attachment-div" >
                <div class="col-xs-2 address-icon">
                       <i class="fa fa-paperclip" ></i>
                </div>  
                <div class="attached_files col-xs-8 event-address">

                </div>
              </div>  

               <div class="eventView-row col-xs-12" >
                <div class="col-xs-2 address-icon">
                       <i class="far fa-clock"></i>
                </div>  
                <div class="allDay col-xs-8 event-address">

                </div>
              </div>  
                   
          <div class="eventView-row" > <label></label> <span class=""></span></div>
      </div>

      <div class="modal-footer" style="text-align: center;">    
       <div id="cal-view-actions">
        <span class="shared-label" style="float:left; font-weight:700; color:#1eb5ad;">SHARED CALENDAR</span>
        </div>  
        
      </div>
    </div>  
    </div>
  </div>


<div id="editClassScheduleNew" class="modal fade" data-backdrop="static" data-keyboard="false"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
  <form id="frmEditBooking2" name="frmEditBooking2" method="post" action="<?php echo base_url('calendar/update');?>"> 
      <input type="hidden" name="booking_id" id="booking_id">     
      <input type="hidden" name="google_event_id" id="google_event_id">     
      <input type="hidden" name="title" id="title_id">      
      <input type="hidden" name="previous_invitee" id="previous_invitee">
      <input type="hidden" name="event_id" id="event_id">     
      <div id="classScheduleBody" class="modal-body">

         
        <div class="first-part">
        
        <div class="row">
          <span class="icon close-modal close-div" data-dismiss="modal">
          <span>&nbsp;</span>
        </span>
          <div class="col-xs-8" style="margin-left:-26px">
            <div class="form-group">
              <div class="controls">
               <input type="text" class="input-xlarge form-control title" name="booking_title" id="booking_title" placeholder="Add title">            
              </div>            
            </div>
          </div>
          <div class="col-xs-2">
              <button class='update_schedule_timing1 btn save-btn' type="button">Update</button>
          </div>
        </div>

      <div class="row event-day-time">
          <div class="col-xs-12">
             <label id="time-error" class="error" style="display: none;"></label><br>
            <input class="input-xlarge form-control datepicker" name="start_date" id="start_date3"  type="text" placeholder="MM/DD/YYYY" required="" value="" required autocomplete="off">
            <input class="input-xlarge form-control timepicker start_time_dv" name="start_time" id="start_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">
            <span style="margin-right:8px;"> to </span>
            <input class="input-xlarge form-control datepicker" name="end_date" id="end_date3"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off" >
            <input class="input-xlarge form-control timepicker start_time_dv" name="end_time" id="end_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">
             
             <label class="control-label event-recurrence">
                  <input class="form-control checkbox" name="all_day" id="all_day" value="1"  type="checkbox" style="width:17px; position:absolute; visibility:hidden;">
                  <span class="input-checkbox-icon"></span>
                  <span> All Day </span>
                </label>
  
                
          </div>
                   
        </div> <!-- /.row.event-day-time -->
       </div>
        
       
          
        <div class="row reminder-n-guests flex-row">
          <div class="col-xs-12 col-sm-8 col-reminder">
            <div class="tab-title"> <span>Event Details</span> </div>
            <div class="scroller">
              <div class="row">
                <div class="col-xs-12">
                  <div class="row event-location"> 
                     <i class="material-icons" style="margin-left:11px; font-size:28px; float:left;">location_on</i>
                     <div class="col-xs-10 location-div" >
                        <input type="text" class="form-control location-input event_location" id="event_location1" placeholder="Enter Location" name="event_location" onFocus="geolocate()" autocomplete="off">
                        <a href="javascript:void(0)" onclick="mapsSelector('addForm')" class="open-map btn-link" >Open location in map</a>
                        <span class="location-icon" title="Use current location"> <i class="fa fa-crosshairs" onclick="currentLocation()"></i> </span>
                      </div>
                    </div>  

                    <div class="row" style="margin-top: 5px;"> 
                     <i class="fa fa-video-camera" style="margin-left:11px; font-size:24px; float:left;"></i>
                     <div class="col-xs-10" >
                        <select style="border: 0px;background: #f1f3f4; border-radius: 4px;" name="conference" id="conference_event_edit">
                          <option value="0" selected disabled>Add conferencing</option>
                          <option value="1">Conference call</option>
                          <option value="2">Web meeting</option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="row get-notify2">
                    
                    </div> 
                    <i class="fa fa-bell add-notification-bell" style="margin-left: 2px; font-size: 23px; display: block;"></i>
                    <button type="button" class="btn btn-success add-notification" id="add-notification-btn" data-event='1'>Add Notification</button>             
                <div class="calendar-div">    
                  <i class="fa fa-calendar" style="font-size:24px; margin-left:2px;"></i>
                    <select name="calendar_type" id="calendar_type">
                    <option value = 1 style="background-color: #1eb5ad ;color: #fff;">Default Calendar</option>     
                    <?php 
                               if(!empty($calendars))
                               {
                                foreach ($calendars as $key => $estimator) 
                                { 
                               ?>
                                <option value="<?php echo $estimator['id'];?>" style="background-color: <?php echo $estimator['color'];?>;color: #fff;"><?php echo $estimator['name'];?></option>   
                            <?php }
                              }
                            ?>
                    </select>
                   </div>
                  <i class="fa fa-bars" aria-hidden="true" style="margin-left:2px;margin-top:15px; font-size:24px; float:left"></i>
                  <div class="col-xs-11 notes-div" style="padding-right:0px;">
                    <div class="controls">
                     <div class="wrapper"> 
                    <div class="file_uploader">
                      <input type="file" name="file" id="file">
                      <span class="value"></span>
                      <span class="default">
                        <i class="fa fa-upload"></i>
                        <span class="choose">Choose a file</span> or Drag and drop
                      </span>
                    </div>
                   </div> 
                      <textarea name="notes" id="notes3" rows="4" cols="106"></textarea>        
                    </div>                
                  </div>
                </div>          
              </div>
            </div> <!-- /.scroller -->
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12">
                  
                  <div class="attached_files" style="margin: 0px 0px 20px;">  
                    <i class="fa fa-paperclip"></i> <a href="#" id="attachment" name="attachment" class="btn-link" download title="Download file"></a>
                  </div> 
                
              </div>
            </div>
          </div> <!-- /.col-reminder -->
          <div class="col-sm-4 col-xs-12 col-guests">
            <div class="tab-title"> <span>Guests</span> </div>
            <div class="row">
            <div class="col-xs-12 check_guest"></div>           
              <div class="col-xs-12"> 
                <div class="form-group">
                  <label class="control-label" for="textfield">Invite company contacts and guests:</label>
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
                    <a  class="add_invite" title="Add More" href="javascript:;" style="text-transform:uppercase;">Add Guests</a>      
                </div>
              </div>          
            </div>  
             <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;">          
                <div class="col-xs-12"> 
                  <div class="form-group guest-list-scroller">
                    <div>
                      <label class="control-label" for="textfield">
                        <span class="guest_count"></span> Guest(s)
                      </label>
                    </div>

                   
                    <div class="invited_dv"> </div>
                  </div>
                </div>                
              </div>  
            </div>  
             <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;display: none;">          
              <div class="col-xs-12"> 
                <div class="form-group">
                  <div>
                    <label class="control-label" for="textfield">
                      Guests can: 
                    </label>
                  </div>
                 <div class="guest_checkbox">  
                  <div class="check">
                    <label class="control-label" for="textfield" style="vertical-align: middle">
                      <input type="checkbox" name="modify_event" style="zoom: 1.6;">
                    </label> <span>Modify Event</span>
                  </div>
                  <div class="check">
                    <label class="control-label" for="textfield"  style="vertical-align: middle">
                      <input type="checkbox" name="invite_others" style="zoom: 1.6;">
                    </label> <span>Invite Others</span>
                  </div>
                  <div class="check">
                    <label class="control-label" for="textfield"  style="vertical-align: middle">
                      <input type="checkbox" name="see_guest_list" style="zoom: 1.6;">
                    </label> <span>See guest list</span>
                  </div>
                 </div> 
                </div>
              </div>                
            </div>          
          </div> <!-- /.col-guests -->
        </div> <!-- /.reminder-n-guests -->
        <div class="row">
        </div>
      </div>
     
    </form> 
    </div>
  </div>
</div>

<!-- end Share modal section -->
<!-- Share modal start -->
<div id="share_modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content share-calendar">
      <form action="<?php echo base_url('calendar/share');?>" method="post">  
      <div class="modal-header background-green">
        <div class="title">
          <h4 id="modalTitle" class="modal-title">Share Calendar</h4>
        </div>

        <div class="icons-plot">
          <button type="submit" class="icon" id="share_submit">
            <i class="fas fa-share"></i>
            <span class="hover-title">Share </span>
          </button>

          <span class="icon close-modal" data-dismiss="modal">
            <span>&nbsp;</span>
            <span class="hover-title">Close </span>
          </span>
        </div>
      </div>
      <div id="modalBody" class="modal-body">
         <div class="row">
           <div class="col-xs-12" style="padding:15px;">
            <label style="width:80px;">Calendars :</label>
             <?php
                 if(!empty($calendars))
                 { ?>
                   <select id="cal-select" style="width:230px; background-color:#f1f3f4; border-radius:2px; cursor:pointer; border-color:#ddd;" name="calendar_id" required>
                    <option value="">Choose Calendar</option> 
                  <option value="1" style="background: #1fb5ad ;color: #fff;">Default Calendar</option>
                 <?php foreach ($calendars as $key => $estimator) 
                  {
                  ?>
                  <option value="<?php echo $estimator['id'];?>" style="background: <?php echo $estimator['color'];?>;color: #fff;"><?php echo $estimator['name'];?></option>
                
                <?php    
                  }
                  ?>
                  </select>
                <?php }
                 ?> 
           </div>
          </div>
          <div class="row">
            <div class="col-xs-12 share_calendar_user">
              <label style="width:80px;">Users :</label> 
              <select id="users_list" name="user[]"  multiple="multiple" class="popular-list">
                
                  <?php foreach ($users as $option_key => $option) { ?>
                    <option value="<?php echo $option['id']; ?>" ><?php echo $option['email']; ?></option>
                  <?php } ?>
                  
              </select>
            </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="share_submit" title="Share & Send notification mail to user" class="btn btn-success" style="background: #1fb5ad;border-color: #1fb5ad;"><i class="fa fa-share"></i> Share</button>
        </div>
      </form> 
    </div>
  </div>
</div>


<!-- Reminder Event Modal -->
<div id="reminder_event_modal" class="pull-right">
     <div class="head">
       <p>
         <i class="fa fa-clock-o"></i>
       <span>Reminder</span>
       <i id="reminder_event_modal-close" class="fa fa-times pull-right"></i>
     </p>
   </div>
   <div class="show_reminder_event">
  </div>
</div>

<!--Reminder Event Modal  -->
<div id="map" style="display: none;"></div>


<div id="booking_popup" class="modal fade" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog edit-modal-width">
    <div class="modal-content">
      <div class="modal-header">

        <div class="title">
        </div>

        <div class="icons-plot">
        <span class="icon close-modal" data-dismiss="modal"></i> <span class="hover-title">Close </span> </span>
        </div>
      </div>
      <div id="modalBody" class="modal-body service-box" >

      </div>
  
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/webui-popover/2.1.15/jquery.webui-popover.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min-new.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/fullcalendarv3.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/gcal.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<style>
#cke_1_contents{ border:1px solid #eae8e8; }
</style>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/timepicker/') ?>jquery.timepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script> 
<script> 

 
   
 
var newmodule = '';
var newrecord_id = '';
var created_for = "<?php echo $this->session->userdata('user_id'); ?>";
$(function() {
   addClass();
  $('#booking_calendar').fullCalendar({
    timeFormat: 'H:mm', // uppercase H for 24-hour clock
    //axisFormat: 'HH:mm',
    selectable: true,
    selectHelper: true,

    slotLabelFormat:"HH:mm",
    defaultView: 'agendaDay',
    slotDuration :'00:15:00',
    header: {
      left: ' today',
      center: 'title',
      right: 'prev,next'
    },
    editable:true,
    droppable:true,
    eventDurationEditable:false,
    dayClick: function(date,jsEvent, view) {
         $('#editClassSchedule #start_time').val(date.format('H:mm'));
         $('#editClassSchedule #start_date').val(date.format('MM/DD/YYYY'));
         $('#editClassSchedule #end_date').val(date.format('MM/DD/YYYY')); 
         $('#editClassSchedule #end_time').val(moment(date).add(15,'minutes').format('H:mm'));
         $('.ui-timepicker-viewport').scrollTop($('.ui-timepicker-viewport li:nth-child(1)').position().top);
    },
    eventDrop:function(event, delta, revertFunc)
    {     
            var booking_id = event.id;
            var record_id = event.record_id;
            var booking_date = event.start.format();
            var start_date = booking_date.split('T');
            var start_time = start_date[1];
            start_date = start_date[0];
            var end_date = event.end.format();
            end_date = end_date.split('T');
            var end_time = end_date[1];
            end_date = end_date[0];
            var email = event.email;
            var created_for=event.created_for;

            if (!confirm("Are you sure about this change?")) {
                    revertFunc();
                  }
                  else
                  {
                    
                    $.ajax({
                      type:'post',
                      url: base_url+'booking/bookupdate',
                      data:{ dragEvent:true,created_for:created_for,booking_id:booking_id, record_id:record_id, start_date:start_date, start_time:start_time, end_date:end_date, end_time:end_time,email:email, dragEvent:true },
                      dataType:'json',
                      success:function(data)
                      {
                        if(data.success == false)
                        {
                          alert(data.message);
                          $('.calendar-loader').addClass('hide');
                          revertFunc();
                        }
                        if(data.success == true)
                        {
                          var x = start_time.split(":");
                          var y = end_time.split(":");
                          $('#editClassSchedule #start_time').val(x[0]+":"+x[1]);
                          $('#editClassSchedule #end_time').val(y[0]+":"+y[1]);
                        }
                        
                      }
                    });
                  }
       
    },
    loading: function(isLoading, view)
    {
      isLoading == true ? $('#ajax-loader10').show() : $('#ajax-loader10').hide();
    },
    eventSources: [{
          events: function (start, end, timezone, callback) { 
            $.ajax({
                url: '<?php echo base_url() ?>Modules/getEvents',
                method:'post',
                dataType: 'json',
                data: {
                  record_id: newrecord_id, module:newmodule,created_for:created_for,
                },
                success: function (msg) {
                  console.log(msg);
                  var events = msg.events;
                  console.log(events);
                  callback(events);
                  //addClass();
                }
            });
          },
        },               
      ],
  });
});           
  CKEDITOR.replace('notes',{
        removePlugins : 'elementspath',
        resize_enabled : false,
          /*toolbar : [
           ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
           '/',
        ] ,*/
          height: '50px',
          contentsCss : 'body{background:#f1f3f4;font-family:sans-serif, Arial, Verdana, "Trebuchet MS"; font-size:12px;}',
        });

     CKEDITOR.replace('notes2',{
        removePlugins : 'elementspath',
        resize_enabled : false,
          toolbar : [
           ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
           '/',
        ] ,
          height: '50px',
          contentsCss : 'body{background:#f1f3f4;font-family:sans-serif, Arial, Verdana, "Trebuchet MS"; font-size:12px;}',
        });

     CKEDITOR.replace('notes5',{
        removePlugins : 'elementspath',
        resize_enabled : false,
          toolbar : [
           ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
           '/',
        ] ,
          height: '200px',
          contentsCss : 'body{background:#f1f3f4;font-family:sans-serif, Arial, Verdana, "Trebuchet MS"; font-size:12px;}',
        });



  CKEDITOR.replace('notes3',{
          removePlugins : 'elementspath',
        resize_enabled : false,
          toolbar : [
           ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
           '/',
        ] ,
          height: '200px',
          contentsCss : 'body{background:#f1f3f4;font-family:sans-serif, Arial, Verdana, "Trebuchet MS"; font-size:12px;}',
        });
  
  var base_url = "<?php echo base_url();?>";
  $(document).on('click','.update_schedule_timing',function(e){
    e.preventDefault();
    
    CKEDITOR.instances.notes.updateElement();
    
    var frmdata = $('#frmEditBooking').serializeArray();
    
    console.log(frmdata);
      
      $.ajax({
        url:  '<?php echo base_url()."index.php/booking/bookupdate"; ?>',
        type: "POST",
        data: frmdata,
        beforeSend: function() {
        
        },
        success: function(result)
        {
          console.log(result);    
          $('#invite_first').val('');
          $('.invite_dv').html('');
          $('#fullCalModal').modal('hide');   
          $('#editClassSchedule').modal('hide');        
          //window.location.reload();
          
        } 
      }); 
    
      
  }); 
  $(document).on('click','.add_invite',function(){
    
    var html = '<div class="controls" style="margin-bottom: 5px;"><input class="input-xlarge form-control invite auto-email" name="invite[]" type="text" value="" required autocomplete="off" placeholder="Enter email">    <i class="fa fa-times remove_invite" aria-hidden="true"></i>  <div class="show_avail" style="color:red;font-size: 12px;display: none;">User not available on this date time!</div> </div> ';     
    
    //console.log(html);
    $('.invite_dv').append(html);
    
  });
  
  $(document).on('click','.remove_invite',function(){   
    $('.check_guest').html('');
    $('.check_guest2').html('');
    $(this).parent().remove();
    $('.add_invite').show();
    $('.update_schedule_timing').attr('disabled', false);
  });
  
  $(document).on('click','.remove_invited',function(){
      
    if(confirm('Are you sure to remove guest?'))
    { 
      var booking_guest_id = $(this).attr('id');
      $.ajax({
        url:  '<?php echo base_url()."index.php/booking/remove_guest"; ?>',
        type: "POST",
        data: { 'id': booking_guest_id },
        beforeSend: function() {
          $('#con_'+booking_guest_id).css('opacity','0.5');
        },
        success: function(result)
        {
          console.log(result);    
          $('#con_'+booking_guest_id).remove();
          if($('.guest_count').html()>0)
          {
            $('.guest_count').html($('.guest_count').html()-1);
            $('.guest_yes_no').html("");
          }
          $("#calendar").fullCalendar('refetchEvents');
        } 
      }); 
    }
  });

// event guest remove
  $(document).on('click','.remove_event_invited',function(){
      
    if(confirm('Are you sure to remove guest?'))
    { 
      var event_guest_id = $(this).attr('id');
      $.ajax({
        url:  '<?php echo base_url()."index.php/booking/remove_event_guest"; ?>',
        type: "POST",
        data: { 'id': event_guest_id },
        beforeSend: function() {
          $('#con_'+event_guest_id).css('opacity','0.5');
        },
        success: function(result)
        {
          console.log(result); 
          if(result == 1)   
          {
             $('#eventViewModal #con_'+event_guest_id).css('display','none');
             $('#editClassScheduleNew #con_'+event_guest_id).css('display','none');
             $("#calendar").fullCalendar('refetchEvents');
          }
          // if($('.guest_count').html()>0)
          // {
          //   $('.guest_count').html($('.guest_count').html()-1);
          //   $('.guest_yes_no').html("");
          // }
          
        } 
      }); 
    }
  });
  
  $(document).on('click','.add_notification',function(){
    
    var html = '<div class="row">     <div class="col-sm-2 col-xs-12">            <div class="form-group"> <div class="controls">  <select class="form-control" name="notify_by[]">  <option value="email">Email</option>                 </select></div>         </div>  </div>  <div class="col-sm-2 col-xs-12">            <div class="form-group"> <div class="controls">     <input class="input-xlarge form-control" type="number" min=1 value=10 name="notify_before[]"> </div>          </div>  </div>  <div class="col-sm-2 col-xs-12">            <div class="form-group"> <div class="controls">    <select class="form-control" name="notify_on[]">                   <option value="minutes">Minutes</option>                  <option value="hours">Hours</option>                  <option value="days">Days</option>                  <option value="weeks">Weeks</option>                                </select> </div>          </div>  </div> <div class="col-sm-1 col-xs-12">             <div class="form-group"> <div class="controls remove_notify">     <i class="fa fa-times" aria-hidden="true" style="margin-top: 10px; margin-left: -20px; cursor:pointer;"></i> </div>         </div>  </div>  </div>';     
    
    console.log(html);
    $('.notify').html(html);
    
  });
  
  $(document).ready(function(){
      // if($("#all_select").val() == "no")
      // {
      //   alert();
      // }

      $('input[name="all_day"]').click(function(){
          if($(this).prop("checked") == true){
            $('.start_time_dv').hide();
            //$('.end_time_dv').hide();
          }
          else if($(this).prop("checked") == false){
            $('.start_time_dv').show();
            //$('.end_time_dv').show();
          }
      });
  
  });
  
  $(document).on('click','.remove_notify',function(){   
    $(this).parent().parent().parent().remove();
  });
  /* new code start here */
  $(document).on('click','#editClassSchedule #start_time', function(){
    $(this).addClass('clicked');
  })
  $(document).on("click", ".ui-timepicker-wrapper li", function(){
    availCheck();
    if(!$('#editClassSchedule #start_time').hasClass('clicked'))
    {
     return;
    }
    else
    {   
      if($('#editClassSchedule #start_time').timepicker('getTime'))
      {
        $("#editClassSchedule #start_time").removeClass('clicked');  
      }
      else
      {
        $("#editClassSchedule #start_time").removeClass('clicked');
        return;
      }
    }
    var start_date=$("#editClassSchedule #start_date").val();
    var start_time=$("#editClassSchedule #start_time").val();
    
    var end_timeAndDate=moment(start_date+' '+start_time).add(15,'minutes');
    
    $("#editClassSchedule #end_date").val(end_timeAndDate.format('MM/DD/YY'));
    $("#editClassSchedule #end_time").val(end_timeAndDate.format('HH:mm'));
  
  });
  $("#editClassSchedule #start_date").change(function(){
    var date = $(this).val();
    // console.log("datecheck",date);
    $("#editClassSchedule #booking_calendar").fullCalendar('gotoDate', date);
    $("#editclassSchedule #booking_calendar").fullCalendar('refetchEvents');
  });
  /* new code end here */ 
   function newList(page)
   {
      var own = $("#own").val();
      var rStat = $("#rStat").val();
      if(!page)
        page = 1;
      var url = "<?php echo base_url() ?>index.php/booking/?own=" + own + "&rStat=" + rStat + "&page=" + page;
      window.location.href = url;
  }
  
  
  var users = new Array();
  //users[0] = new Array();
  $(document).on('click','.selUser .fs-option',function()
  {
    console.log('abc'); 
    
    var myCheckboxes = new Array(); 
    
    $('.fs-option.selected').each(function() { 
        console.log('in each');
        console.log($(this).attr('data-value'));
        myCheckboxes.push($(this).attr('data-value')); 
    }); 
     
    console.log(myCheckboxes);
    
    if(myCheckboxes!='')
    {
      myCheckboxes =decodeURIComponent(myCheckboxes);
 
      var rStat = $("#rStat").val();    
      var page = 1;
      var own = ''; 
      var url = "<?php echo base_url() ?>index.php/booking/?user=" + myCheckboxes + "&own=" + own + "&rStat=" + rStat + "&page=" + page;
      window.location.href = url;  
      
    }
    
  });
  
  
  

  var Script = function ()
  {
    /* initialize the calendar
     -----------------------------------------------------------------*/

    var access_flag=true; 

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var curSource = '<?php echo base_url() ?>calendar/getJobsEvent';
    var googleCalendarId = 'en.usa#holiday@group.v.calendar.google.com';
    var googleCalendarIdCanada = 'en.canadian#holiday@group.v.calendar.google.com';
    var temp_estimator=[];  
    
    $('#calendar').fullCalendar({
      header: {
          left: 'prev,next today',
          center: 'title',
          right: 'year,month,agendaWeek,agendaDay',              
      }, 
      nextDayThreshold:"00:00:00",

       //showNonCurrentDates :true,   
       firstDay: 1,
       eventLimit:true,
       slotMinutes: 5,
       slotDuration:'00:15:00',
       //ignoreTimezone: false,
       timeFormat: 'H(:mm)', // uppercase H for 24-hour clock
       slotLabelFormat:"HH:mm",

       yearColumns: 2,
       googleCalendarApiKey: 'AIzaSyDzUvSPXi93saIWTnMO70RG0-w4e54ipQo', 

       // plugins: [ 'dayGrid', 'list', 'googleCalendar' ],
       // displayEventTime: false,
       // events: 'en.usa#holiday@group.v.calendar.google.com',

       editable: true,
       droppable: true,
       dayRender: function(date, cell){
            if (date < moment()){
               $('#calendar').fullCalendar('unselect');
                return false;
                
            }
       },
       loading: function(isLoading, view)
       {
         isLoading == true ? $('.calendar-loader').removeClass('hide') : $('.calendar-loader').addClass('hide');
       },
       eventAfterAllRender:function(view){
         

            var bid ="<?php echo $_GET['booking_id'] ?>";
          
            var events =  $("#calendar").fullCalendar('clientEvents');
            for(var i in events)
            {
                if(events[i].booking_id==bid && access_flag){
                  window.history.pushState("new", "Title","<?php echo base_url('booking') ?>");
                  $('#calendar').fullCalendar('gotoDate',events[i].start)
                  $('.booking'+bid).click()
                  $('#fullCalModal .edit_schedule').click();
                  access_flag = false;
                }
             }
                            
       },

       eventDrop:function(event, delta, revertFunc)
       {
          access_flag=false;
          
          if(event.class=='reminder_event'){
              revertFunc();
          }
          else if(event.class == "calendar_event")
          {
            if (!confirm("Are you sure about this change?")) {
              revertFunc();
            }
            else
            {
              var event_id = event.id;
              var start = event.start.format();
              var end = event.end.format();
              $.ajax({
                type:'post',
                url: base_url+'calendar/update',
                data:{ id:event_id,start:start,end:end,dragEvent:true },
                dataType:'json',
                success:function(data)
                {
                  if(data.success == false)
                  {
                    alert(data.message);
                    revertFunc();
                  }
                  else
                  {
                    $("#calendar").fullCalendar('refetchEvents');
                  }
                }
              });
            }
          }
          else
          {
            console.log("eventDrop",event);
            var modules = event.module;
            var booking_id = event.booking_id;
            var record_id = event.record_id;
            var booking_date = event.start.format();
            var start_date = booking_date.split('T');
            var start_time = start_date[1];
            start_date = start_date[0];
            var end_date = event.end.format();
            end_date = end_date.split('T');
            var end_time = end_date[1];
            end_date = end_date[0];
            var email = event.email;
            var created_for = event.created_for;

     //first availability start    
            $.ajax({
              type:'post',
              url: base_url+'booking/first_checkAvailability',
              data:{ record_id:record_id,email:email,start_date:start_date, start_time:start_time},
              dataType:'json',
              success:function(data)
              {
                if(data == "true")
                {

                   swal.fire({
                        title: "Attention !",
                        text: "Please note that there is another meeting schedule for this "+ modules +" on this day !",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ok'
                      }).then(function (result) {
                        if (result.value) {
                            $('.calendar-loader').removeClass('hide');
                            $.ajax({
                              type:'post',
                              url: base_url+'booking/bookupdate',
                              data:{ booking_id:booking_id, record_id:record_id, start_date:start_date, start_time:start_time, end_date:end_date, end_time:end_time,email:email, dragEvent:true,current_module:modules },
                              dataType:'json',
                              success:function(data)
                              {
                                if(data.success == false)
                                {
                                  alert(data.message);
                                  $('.calendar-loader').addClass('hide');
                                  revertFunc();
                                }
                                else
                                {
                                  window.location.reload();
                                }
                              }
                            });
                         }else{
                            revertFunc();
                         }
                      });

                }
                else
                {
           //availability start    
                     $.ajax({
                      type:'post',
                      url: base_url+'booking/checkAvailability',
                      data:{ record_id:record_id,start_date:start_date,start_time:start_time,email:email,created_for:created_for },
                      dataType:'json',
                      success:function(data)
                      {
                        if(data.booking)
                        {
                          swal.fire({
                              title: "Are you sure ?",
                              text:"You won't be able to revert this!",
                              type: 'warning',
                              showCancelButton: true,
                              confirmButtonText: 'Ok'
                            }).then(function (result) {
                              if (result.value) {
                            $('.calendar-loader').removeClass('hide');
                            $.ajax({
                              type:'post',
                              url: base_url+'booking/bookupdate',
                              data:{ booking_id:booking_id, record_id:record_id, start_date:start_date, start_time:start_time, end_date:end_date, end_time:end_time,email:email, dragEvent:true,current_module:modules },
                              dataType:'json',
                              success:function(data)
                              {
                                if(data.success == false)
                                {
                                  alert(data.message);
                                  $('.calendar-loader').addClass('hide');
                                  revertFunc();
                                }
                                else
                                {
                                  window.location.reload();
                                }
                              }
                            });

                            }else{
                            revertFunc();
                          }
                         }); 

                        }
                        else
                        {
                          alert(data.status);
                          revertFunc();
                        }
                      }
                    });
        //availability end    
                 } 

              }
           });
       //first availability end    
       
          }
       },
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
                                addClass();
                                callback(events);
                               
                            }
                        });
            
                    },
                 
                },
                {
                  googleCalendarId: googleCalendarId,
                  className: 'gcal-event-hollydays',
                  color:'#e67c73',  
                }, 
                {
                  googleCalendarId: googleCalendarIdCanada,
                  className: 'gcal-event-hollydays',
                  color:'#e67c73',  
                },
                            
            ],
      events: <?php echo $events; ?>,
      eventRender: function (event, element)
      { 
        element.attr('href', 'javascript:void(0);');
        element.addClass(event.class);
        element.addClass('booking'+event.booking_id);
        if(event.status == "Web Booking")
        {
          element.addClass('web_booking');  
        }
        element.click(function()
        {
          console.log("event",event);       
          $("#current_module").val(event.module);   
          var type = event.type;
          if(type=='booking')
          {
            var booking_id = event.booking_id;
            $('#booking_id').val(booking_id);   
            
            var booking_title = event.booking_title;
            $('#booking_title').val(booking_title);   
            
            var google_event_id = event.google_event_id;
            $('#google_event_id').val(google_event_id);   
            
            var headercontent = event.title;
            $('#modalTitle').html("View Booking");    
            $('#title').val(headercontent);   
            
            var description = event.description;
            // description += '<div class="row title-row"> <h4 style="font-weight: bold;"> Lead Information</h4> </div>'; 
            $('#modalBody').html(description);          
          
            var notes = event.notes;    
            if(notes!='')
            {               
              CKEDITOR.instances.notes.setData(notes);  
            }
            else
            {
              CKEDITOR.instances.notes.setData(notes);  
            }
            var email = event.email;
            $("#editClassSchedule #email").val(email);
            var name =event.name;
            $("#editClassSchedule #name").val(name);
            var record_id =event.record_id;
            $("#editClassSchedule #record_id").val(record_id);

            var start_date = event.start_date;
            $('#start_date').val(start_date); 
              
            var start_time = event.start_time;        
            $('#start_time').val(start_time);
              
            var end_date = event.end_date;
            $('#editClassSchedule #end_date').val(end_date);

            var end_time =event.end_time;
            $("#editClassSchedule #end_time").val(end_time);

            var created_for =event.created_for;
            $("#editClassSchedule #created_for").val(created_for);

            var popColor = event.backgroundColor;
            $("#fullCalModal span.event-color").css("background-color",popColor);
          
            
            var visibility = event.visibility;  
            if(visibility!='')
            {           
              $('#visibility').val(visibility); 
            }           
            
          
            var all_day = event.all_day;    
            if(all_day==1)
            {                                   
              $('#editClassSchedule #all_day').prop('checked', true);
              $('#editClassSchedule .start_time_dv').hide();
            }
            else
            {                         
              $('#editClassSchedule #all_day').prop('checked', false);  
              $('#editClassSchedule .start_time_dv').show();
            }
            
            $("#editClassSchedule #email_status").text(event.email);
            $("#editClassSchedule #name_status").text(event.name);
            if(event.company){
              $("#editClassSchedule #c_name").text(event.company);
            }
            $("#editClassSchedule #c_email").text(event.email);
            $("#editClassSchedule #lead_name").val(event.name);
            var status = event.status;
            $("#editClassSchedule #status").text(status);
            $("#editClassSchedule #status").css("background", popColor);
            
            if(status == "Cancelled")
                        {
              var stamp = event.praposed_date.split(" ");
                            var validDate = !/Invalid|NaN/.test(new Date(stamp[0]).toString());
                            $("#br_tag").css("display","none");
                            $("#editClassSchedule #status").css("margin-left","0");
                            if(validDate == true)
                            {
                                $("#suggestion").css("display", "block");
                                $("#suggestionTime").text(event.praposed_date);
                                $("#proposed_end_time").val(event.praposed_end_time);
                            }
                            else
                            {
                                $("#suggestion").css("display", "none");
                                $("#suggestionTime").text('');
                            }
                        }
                        else
                        {
                            $("#suggestion").css("display", "none");
                            $("#suggestionTime").text('');
                            $("#br_tag").css("display","block");
                            $("#editClassSchedule #status").css("margin-left","44px");
                        }

            $("#editClassSchedule #attachment").text(event.attachment);
                    if(event.attachment)
                    {
                      $("#editClassSchedule #attachment").attr("href", base_url+"upload/event/"+event.attachment);
                      $("#editClassSchedule .attached_files").removeClass('hide');
                    }else 
                    {
                      $("#editClassSchedule .attached_files").addClass('hide');
              }
    

              if(typeof(event.notification) != 'undefined' && event.notification.length != 0){
                   $('.get-notify').css('display', 'block');
                   $("#editClassSchedule .add-notification-bell").css('display','none');
                   $('#add-notification-btn').css('display', 'none');
                   $('#notification_interval1').val(event.notification[0].notification_interval);
                   $('#notification_type').val(event.notification[0].notification_type);
                   $('#notification_via').val(event.notification[0].notification_via);
                }
                else{
                  $('.get-notify').css('display', 'none');
                  $('.get-notify1').css('display', 'block');
                  $("#editClassSchedule .add-notification-bell").css('display','block');
                  $('#add-notification-btn').css('display', 'inline-block');
                }


            var notify_by = event.notify_by;  
            var notify_before = event.notify_before;  
            var notify_on = event.notify_on;  
          
            var html = '';
            $('.notify').html(html);
            if(notify_by!=null)
            {
              for(i=0; i<notify_by.length;i++)
              {             
                var by = notify_by[i];
                var before = notify_before[i];
                var on = notify_on[i];  
              
                var html = '<div class="row">     <div class="col-sm-2 col-xs-12">            <div class="form-group"> <div class="controls">  <select class="form-control" name="notify_by[]" id="notify_by_'+i+'">  <option value="email">Email</option> <option value="notification"  >Notification</option></select></div>          </div>  </div>  <div class="col-sm-2 col-xs-12">            <div class="form-group"> <div class="controls">     <input class="input-xlarge form-control" type="number" min=1 value=10 name="notify_before[]" id="notify_before_'+i+'"> </div>         </div>  </div>  <div class="col-sm-2 col-xs-12">            <div class="form-group"> <div class="controls">    <select class="form-control" name="notify_on[]"  id="notify_on_'+i+'">                   <option value="minutes">Minutes</option>                  <option value="hours">Hours</option>                  <option value="days">Days</option>                  <option value="weeks">Weeks</option>                                </select> </div>          </div>  </div> <div class="col-sm-1 col-xs-12">             <div class="form-group"> <div class="controls remove_notify">     <i class="fa fa-times" aria-hidden="true" style="margin-top: 10px;cursor:pointer;"></i> </div>          </div>  </div>  </div>';    
                
                //console.log(html);
                $('.notify').append(html);
              
                $('#notify_by_'+i).val(by); 
                $('#notify_before_'+i).val(before);          
                $('#notify_on_'+i).val(on);   
          
              }
            }
            else
            {
              //console.log(html);
              $('.notify').append(html);
            }       
            
            var own_email = event.own_email;                
            var all_invites = event.invites;                
            var all_invites_count = all_invites.length;
            var html = ''; var yes = 0; var maybe = 0; var no = 0; var awaiting = 0; 
            $('.guest_yes').html('');   
            $('.guest_maybe').html('');             
            $('.guest_no').html('');
            $('.guest_awaiting').html('');
            
            $('.guest_count').html(all_invites_count);
            $('.invited_dv').html(html);
            if(all_invites!=null)
            {
              for(i=0; i<all_invites_count;i++)
              {
                //console.log(i);
                var invite = all_invites[i];            
                //console.log(invite.guest);            
                
                var guest = invite.guest;
                var guest_name = invite.guest_name;
                if(guest_name!="" && guest_name!=null)
                {
                  var show_name = guest_name;
                }else
                {
                  var show_name = guest;
                }
                
                var status = invite.status;
                var status_icon = '';
                if(status==1){
                  var status_icon = '<i class="fa fa-check-circle" style="font-size: 13px; color: #14a714; position: relative; left: -12px; top: 7px; z-index: 9999; background: #fff; border-radius: 50%;"></i>';
                  var yes = yes+1; 
                }
                else if(status==2) {
                  var status_icon = '<i class="fa fa-question-circle" style="font-size: 13px; color: #f9bb2b; position: relative; left: -12px; top: 7px; z-index: 9999; background: #fff; border-radius: 50%;"></i>';
                  var maybe = maybe+1; 
                }
                else if(status==3) {
                  var status_icon = '<i class="fa fa-times-circle" style="font-size: 13px; color: #ff4c4c; position: relative; left: -12px; top: 7px; z-index: 9999; background: #fff; border-radius: 50%;"></i>';
                  var no = no+1; 
                }
                else
                {
                  var status_icon = '<i class="fa fa-info-circle" style="font-size: 13px; color: #908b8b; position: relative; left: -12px; top: 7px; z-index: -1; background: #fff; border-radius: 50%;"></i>';
                  var awaiting = awaiting+1; 
                }
                if(own_email == guest)
                {
                  var reassign = '<span class="reassign"><button type="button" class="btn btn-success reassign_user" data-id="'+invite.id+'" data-reassign_booking_id="'+booking_id+'" data-email="'+guest+'" >Reassign to other user</button></span>';
                }
                else
                {
                  var reassign = '';
                }
                var html = '<div class="controls" style="margin-bottom: 5px;" id="con_'+invite.id+'">  <img style="height: 25px; margin: 3px 3px;" src="<?php echo base_url() ?>static/images/boyAvatar.png" />'+status_icon+'  <span class="">'+show_name+' '+reassign+' <i class="fa fa-times remove_invited" aria-hidden="true" style="cursor: pointer;  float: right;   margin-right: 10px;  margin-top: 10px;" id='+invite.id+' ></i> </span><input type="hidden" class="input-xlarge form-control invite_exist auto-email ui-autocomplete-input valid" name="invite_exist[]" value="'+show_name+'"> </div>';    
        
                //console.log(html);
                $('.invited_dv').append(html);
          
              }
              
              if(yes>0) $('.guest_yes').html(yes+' yes,');
              if(maybe>0)  $('.guest_maybe').html(maybe+' maybe,');
              if(no>0)  $('.guest_no').html(no+' no,');
              if(awaiting>0)  $('.guest_awaiting').html(awaiting+' awaiting');
                
            }
            else
            {
              //console.log(html);
              $('.invited_dv').append(html);
            }   
            newrecord_id = event.record_id;
            newmodule = event.module; 
            $('#editClassSchedule #conference').val(event.conference);
           /* alert(newrecord_id);
            alert(newmodule);*/
            $('#fullCalModal #delete-booking').attr('data-delete', event.booking_id);
            //alert(event.module);
            $('#fullCalModal').modal();
            //$('#eventViewModal').modal();           
          }
        
          if(type=='not_available')
          {
            var loggedUserId = event.loggedUserId;
            var not_available_user_id = event.user_id;
            if(loggedUserId==not_available_user_id)
            {
              var not_available_id = event.id;
              $('#not_available_id').val(not_available_id);                 
              
              $('#not_available_user_id').val(not_available_user_id);   
              
              var start_date = event.start_date;
              $('#nstartdate').val(start_date);   
              
              var start_time = event.start_time;
              $('#nstarttime').val(start_time);   
              
              var end_date = event.end_date.format('MM/DD/YYYY H:mm');
              $('#nenddate').val(end_date);   
              
              var end_time = event.end_time.format('MM/DD/YYYY H:mm');
              $('#nendtime').val(end_time);   
              
              var reason = event.reason;
              $('#nreason').val(reason);    
              
              $('.delete_not_available').show();
              $('.notavailable_submit').html('<i class="far fa-edit"></i> Update');
              
              //$('#editClassSchedule').modal(); 
            }
          }
        
        });
      },    
      dayClick: function(date, jsEvent, view)
      { 
          
        if ($('.reminder_checkbox').is(':checked')) {


        }else if(date > moment().subtract(1, 'days')){
            $('#addClassSchedule1').modal()

            $('.invite_dv').html('');
            CKEDITOR.instances.notes2.setData("");
            CKEDITOR.instances.notes5.setData("");
            
          
           
           $('#addClassSchedule1 #start_date1').val( date.format('MM/DD/YYYY'));
            $('#addClassSchedule1 #end_date1').val( date.format('MM/DD/YYYY'));
                    $('#addClassSchedule1 #start_time1').val( date.format('H:mm'));
                    var endDate = date.add(30,"m");
                     //console.log("find my endDate",endDate);

                    $('#addClassSchedule1 #end_time').val( endDate.format('H:mm'));
     
           }else{
             Swal.fire(
                'Oops...',
                'You can not book in past date!',
                'warning',
              )
           }
       },
      
       eventClick: function(event){
        console.log("event_test",event);

        if(event.class=="reminder_event"){

             var status = event.status == 'completed' ? 'checked' : '';
             var status2 = event.status == 'ignore' ? 'checked' : '';
             html = '<div class="reminder-item" id="'+event.id+'"> <div class="left">  <p class="discription"><a class="description-link" href="javascript:void()"><i class="icon icon-crm-calendar" style="font-size: 15px;color: #0288d1;"></i> '+event.value+'</a></p><h6><strong>'+event.task+'</strong></h6><p class="date" style="width:200px;">'+event.remind_date+' by '+event.first_name+' '+event.last_name+'</p></div><div class="right"> <label id="'+event.id+'" class="ignore status" title="Mark Ignore"><input type="radio"  name="status'+event.id+'" class="status-checkbox" value="ignore" '+status2+'><span class="status-label"><span class="text"> Ignore</span></span></label> <label id="'+event.id+'" class="completed status" title="Mark Completed"><input type="radio" name="status'+event.id+'" class="status-checkbox" value="completed" '+status+'><span class="status-label"><span class="text">Completed</span></span></label> </div></div>';

            $('.show_reminder_event').html(html);
            $('#reminder_event_modal').addClass('open');
        }

       if(event.class == 'calendar_event'){
          $('#editClassScheduleNew #conference_event_edit').val(event.conference)
          $("#eventViewModal span.event-color").css("background" , event.color);
          $("#editClassScheduleNew #event_id,#eventViewModal #event_id").val(event.id);
          if(event.calendar_name == ''){
              $("#eventViewModal .calendar_name").text('default')
          }  
          else{
            $("#eventViewModal .calendar_name").text(event.calendar_name);
          }

        

            if(event.notification.length){
                  var Notification;
                  var html1 = '<div class="col-xs-3"><label class="note1"></label><select name="notification_via" id="" class="notification_via"><option  selected value="1">Email</option></select></div><div class="col-xs-3 notification_interval" style="margin-right:-58px !important"><input class="interval" type="number" id="notification_interval1" name="notification_interval" min = "1" max = "60" placeholder = "before"/></div><div class="notification_type"><select class="notification" id="notification_type" name="notification_type"><option value="3">minutes</option><option  value="1">hours</option><option value="2">days</option></select></div>';
                      $('#editClassScheduleNew .get-notify2').html(html1); 
                      $('#editClassScheduleNew .add-notification-bell').css('display','none'); 
                      $('#editClassScheduleNew #notification_interval1').val(event.notification[0]['notification_interval']);
                      $('#editClassScheduleNew #notification_type').val(event.notification[0]['notification_type']);
                      $('#editClassScheduleNew #notification_via1').val(event.notification[0]['notification_via']);
                       $('#editClassScheduleNew #add-notification-btn').css('display', 'none');
                  if(event.notification[0]['notification_type'] == 1){
                      Notification = 'Before ' +event.notification[0]['notification_interval']+ ' Hours Via Email';
                      $('#eventViewModal .event_notification').text(Notification);
                       $('.interval').attr({"min":1,"max":12,});            
                  
                  }else if(event.notification[0]['notification_type'] == 2){
                      Notification = 'Notification Before ' +event.notification[0]['notification_interval']+ ' Days Via Email';
                     $('#eventViewModal .event_notification').text(Notification);
                      $('.interval').attr({"min":1,"max":7,});            

                  }else{
                       Notification = 'Notification Before ' +event.notification[0]['notification_interval']+ ' Minutes Via Email';
                       $('#eventViewModal .event_notification').text(Notification);
                        $('.interval').attr({"min":1,"max":60,});            

                  }

            }else{
                  $('#editClassScheduleNew .add-notification-bell').css('display','block'); 
                  $('#editClassScheduleNew #add-notification-btn').css('display', 'block');
                  $('#editClassScheduleNew .get-notify2').html('');
                 $('#eventViewModal .event_notification').text('Not set');
                 $('#editClassScheduleNew #notification_interval1').val('');
                 $('#editClassScheduleNew #notification_type1').val(1);
                 $('#editClassScheduleNew #notification_via1').val(1);          
            }
        
          $("#eventViewModal .event_location").text(event.location);
            if(event.attachment)
            {
              $("#eventViewModal .attached_files").html('<i class="fa fa-download"></i><a class="btn btn-link" href="'+base_url+'/upload/event/'+event.attachment+'" download>'+event.attachment+'</a>');
          }
          $("#eventViewModal").modal("show");

          $("#eventViewModal .jobName").text(event.title);
              var estimator_id = event.estimator_id;
                 // $("#eventViewModal #estimator option[value='"+estimator_id+"']").attr("selected","selected");
                  if(event.allDay == true)
                  {
                    $("#eventViewModal .startDay").text(event.start.format('MM/DD/YYYY H:mm'));
                   /*  $("#eventViewModal .allDay").html('<i class="fa fa-check"></i>');*/
                     $("#eventViewModal .allDay").html('Yes');
                      if(event.end){
                       $("#eventViewModal .endDate").text(event.end.format('MM/DD/YYYY H:mm'));
                      }else{
                        $("#eventViewModal .endDate").text(event.start.format('MM/DD/YYYY H:mm'));
                      }
                  }else
                  {
                    $("#eventViewModal .startDay").text(event.start.format('MM/DD/YYYY H:mm'));
                    $("#eventViewModal .allDay").text('No');
                    $("#eventViewModal .endDate").text(event.end.format('MM/DD/YYYY H:mm'));
                    //$("#eventViewModal .endDate").text(event.end_date+' '+event.endTime);
                  }
                  $("#eventViewModal .notes").html(event.notes);
                
                  // set event data section
                  if(typeof(event.start)!='undefined' && event.start !=null)
                  {
                      $("#editClassScheduleNew #start_date3").val(event.start.format('MM/DD/YYYY'));
                  }
                  if(typeof(event.end)!='undefined' && event.end !=null)
                  {
                    $("#editClassScheduleNew #end_date3").val(event.end.format('MM/DD/YYYY'));
                  }else
                  {
                    $("#editClassScheduleNew #end_date3").val(event.start.format('MM/DD/YYYY'));
                  }
                  if(typeof(event.start)!='undefined' && event.start !=null)
                          {                 
                    $("#editClassScheduleNew #start_time").val(event.start.format('H:mm'));
                  }
                
                $("#editClassScheduleNew #end_time").val(event.end.format('H:mm'));
                  $("#editClassScheduleNew #booking_title").val(event.title);
                  $("#editClassScheduleNew .event_location").val(event.location);
                  
                  if(event.description == ''){
                    $('#eventViewModal .notes-div').css('display', 'none');
                  }else{
                    $('#eventViewModal .notes-div').css('display', 'block');
                    CKEDITOR.instances.notes3.setData(event.description);  
                    
                  }
                
                  $("#editClassScheduleNew #attachment").text(event.attachment);
                  
                  if(event.attachment)
                  {
                    $(' #eventViewModal .attachment-div').css('display', 'block');
                    $("#editClassScheduleNew #attachment").attr("href", base_url+"upload/event/"+event.attachment);
                    $(".attached_files").removeClass('hide');
                  }else 
                  {
                    $(' #eventViewModal .attachment-div').css('display', 'none');
                    $(".attached_files").addClass('hide');
                  }

             if(event.allDayEvent ==1)
                  {
                    $("#editClassScheduleNew input[type=checkbox]").prop('checked', true);
                    //$("input[type=checkbox]").attr('checked', 'checked');
                    $("#editClassScheduleNew .start_time_dv").css("display", "none");
                  }else{
                   $("#editClassScheduleNew input[type=checkbox]").prop('checked', false);
                   $("#editClassScheduleNew .start_time_dv").css("display", "inline-block");
                  }
                  $("#calendar_type").find("option[value="+event.calendar_id+"]").attr('selected', true);
                  // $("#calendar_type").trigger("change");
                  var all_invites = event.invitations;
                  var all_invites_count = event.invitations.length;
                  console.log(event.invitations);
                  var html = '';
                  if(all_invites!=null){
              for(i=0; i<all_invites_count;i++)
              {
                //console.log(i);
                
                var invite = all_invites[i];            
                var email = invite.sent_email;
                var status = invite.status;
                var status_icon = '';
                if(status==1){
                  var status_icon = '<i class="fa fa-question-circle" style="color:#fcf8e3; position:absolute; right:0; top: 15px; z-index:9999; background:#8a6d3b; border-radius:50%;"></i>';
                  var status_flag ='<span class="alert alert-warning" style="padding:0px 5px; display:table; font-size:11px;">Awaiting</span>';
                  //var yes = yes+1; 
                }
                else if(status==2) {
                  var status_icon = '<i class="fa fa-check-circle" style="color:#3c763d; position:absolute; right:0; top:16px; z-index:9999; background:#fff; border-radius:50%;"></i>';
                  var status_flag ='<span class="alert alert-success" style="padding:0px 5px; display:table; font-size:11px;">Invitation Accepted</span>'; 
                  //var maybe = maybe+1;
                }
                else if(status==3) {
                  var status_icon = '<i class="fa fa-times-circle" style="color:#f44336; position:absolute; right:0; top:15px; z-index:9999; background:#fff; border-radius:50%;"></i>';
                  var status_flag ='<span class="alert alert-danger" style="padding:0px 5px; display:table; font-size:11px;">Invitation Declined</span>';
                  //var no = no+1; 
                }
                // else
                // {
                //  var status_icon = '<i class="fa fa-info-circle" style="font-size: 13px; color: #908b8b; position: relative; left: -12px; top: 7px; z-index: -1; background: #fff; border-radius: 50%;"></i>';
                //  var status_flag ='<span class="alert alert-info" style="padding: 0px 5px;font-weight: 500;">awaiting Invitation</span>';
                //  //var awaiting = awaiting+1; 
                // }
                
                html += '<div class="controls" style="margin-bottom:5px; display:flex; display:-webkit-flex;" id="con_'+invite.id+'"> <div class="guest" style="margin-right:10px; position:relative;"> <img style="height: 25px; margin: 3px 3px;" src="<?php echo base_url() ?>static/images/boyAvatar.png" />'+status_icon+' </div>  <span class="" style="display:inline-block; margin-bottom:5px !important;">'+email+''+status_flag+'</span><span style="    margin-left: 40px;"><i class="fa fa-times remove_event_invited" aria-hidden="true" style="cursor: pointer;" id='+invite.id+' ></i></span> </div>';     
                //console.log(html);          
              }
              
         
              $('#editClassScheduleNew .invited_dv,#eventViewModal .invited_dv').html(html);  
              $('#editClassScheduleNew .guest_count,#eventViewModal .guest_count').text(all_invites_count); 

            }
            console.log(event.access);
           var calendar_id = event.calendar_id;
           if(event.access){
           $.each(event.access,function(index,cal){
            if(cal.calendar_id == calendar_id){
              if(cal.access == 1){
               $("#cal-view-actions .edit_event,#cal-view-actions .duplicate_event,#cal-view-actions .delete_event").show();
               $(".shared-label").hide(); 
                }else if(cal.access == 2){
                   $("#cal-view-actions .edit_event,#cal-view-actions .duplicate_event,#cal-view-actions .delete_event").hide();
                   $(".shared-label").show();   
                }else{
                  $("#cal-view-actions .edit_event,#cal-view-actions .duplicate_event,#cal-view-actions .delete_event").hide();
                   $(".shared-label").show();
                }
            }
           });
           }
        }else if(event.source.className == 'gcal-event-hollydays')
        {
            window.open(event.url, '_blank', 'width=700,height=600');
            return false;
        }
        else
        {
          
        }
            
      }// eventClick
    });

  }();
  
  $('.edit_schedule').on('click',function(){
     setTimeout(function(){$('#booking_calendar .fc-today-button').trigger('click')},500);
    $('#editClassSchedule #event_location').val($('#fullCalModal .event_location').text());
    created_for = $("#editClassSchedule #created_for").val();
    $('#editClassSchedule #uleadowner').val(created_for);
    var booking_date = new Date($("#editClassSchedule #start_date").val());
    //console.log("booking_date",booking_date);
    $("booking_calendar").fullCalendar('refetchEvents');
    setTimeout(function(){ $("#booking_calendar").fullCalendar('gotoDate', moment(booking_date));},500);
    $('#editClassSchedule').modal();
    $("#fullCalModal").modal('hide');
    
    setTimeout(function(){ $('body').addClass('modal-open');
    $('body').css('padding-right','15px'); },1000)
    $('#title_id').val($('#modalTitle').html());
    $('#classScheduleTitle').html("Edit Booking");
    $("#frmEditBooking3").attr("action",base_url+"booking/bookupdate");
    $('.booking_availability').removeClass('in').css("visibility","hidden");
    //$("#editClassSchedule .update_schedule_timing2").removeAttr("disabled");
    $('.booking_availability_show').removeClass('in');
     $(".icon.add_schedule_timing").replaceWith('<button class="icon update_schedule_timing2"><i class="far fa-save"></i><span class="hover-title" style="margin-left:-8px;">Update</span></button>');
    $(".btn.add_schedule_timing").replaceWith('<button type="button" class="btn btn-success update_schedule_timing2">Update</button>');
  

  });

  
  $('.delete_schedule').on('click',function(){
    
    if(confirm('Are you sure to delete booking? This booking from google calendar will also be deleted, and action is irreversible!'))
    {     
      var booking_id = $('#booking_id').val();    
      var google_event_id = $('#google_event_id').val();    
      
      $.ajax({
        url:  '<?php echo base_url()."index.php/booking/bookdelete"; ?>',
        type: "POST",
        data: { 'booking_id': booking_id, 'google_event_id': google_event_id  }, 
        beforeSend: function() {
        
        },
        success: function(result)
        {
          console.log(result);                
          
          $('#editClassSchedule').modal('hide');        
          
        } 
      });  
    }
  }); 
  
  $(document).on('click','.reassign_user',function(){
      
    var id = $(this).attr('data-id'); 
    var email = $(this).attr('data-email'); 
    var reassign_booking_id = $(this).attr('data-reassign_booking_id'); 
    $('#booking_guest_id').val(id);
    $('#olduser').val(email);   
    $('#reassign_booking_id').val(reassign_booking_id);   
    
    $('#reassignModal').modal();      
    
  });
  
  function validateEmail(email) {
      var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
      return expr.test(email);
  };
    
  $(document).on('click','.go_assign',function()
  {   
    var newuser = $('#newuser').val();    
    if(newuser=='')
    {
      alert('Please enter user email address!');
      return;
    }
    //console.log(validateEmail(newuser)); return;
    if(validateEmail(newuser)==false)
    {
      alert('Please enter correct email address!');
      return;
    }
    
    if(confirm("Are you sure to re-assign meeting? once it done, you will unable to access this meeting again."))
    {
      var frmData = $('#frmAssignUser').serializeArray();
      console.log(frmData);
      
      $.ajax({
          url:  '<?php echo base_url()."index.php/booking/reassign_guest"; ?>',
          type: "POST",
          data: frmData, 
          beforeSend: function() {
            
          },
          success: function(result)
          {
            console.log(result);                
            if(result=='already_assigned')
            {
              alert('This user is already assigned!');
            }
            else
            {           
              $('#reassignModal').modal('hide');      
              window.location.reload(); 
            }
            
          } 
        });  
    }
  });

  $(document).on('click','.notavailable_submit',function()
  {   
    var nstartdate = $('#nstartdate').val();    
    if(nstartdate=='')
    {
      alert('Please enter start date!');
      return;
    }
    
    var nstarttime = $('#nstarttime').val();    
    if(nstarttime=='')
    {
      alert('Please enter start time!');
      return;
    }
    
    var nenddate = $('#nenddate').val();    
    if(nenddate=='')
    {
      alert('Please enter end date!');
      return;
    }   
    var nendtime = $('#nendtime').val();    
    if(nendtime=='')
    {
      alert('Please enter end time!');
      return;
    }   
    
    var nreason = $('#nreason').val();    
    if(nreason=='')
    {
      alert('Please enter reason for not availability!');
      return;
    }   
    
    if(confirm("Are you sure to make not available during this duration?"))
    {
      var frmData = $('#frmNotAvailable').serializeArray();
      console.log(frmData);
      
      $.ajax({
          url:  '<?php echo base_url()."index.php/booking/not_available"; ?>',
          type: "POST",
          data: frmData, 
          beforeSend: function() {
            
          },
          success: function(result)
          {
            console.log(result);                
          
            window.location.reload();             
            
          } 
        });  
    }
  });

  $(document).on('click','.delete_not_available',function()
  {   
    if(confirm("Are you sure to delete it?"))
    {
      var id = $('#not_available_id').val();
      console.log(id);
      
      $.ajax({
          url:  '<?php echo base_url()."index.php/booking/not_available_delete"; ?>',
          type: "POST",
          data: { 'id': id }, 
          beforeSend: function() {
            
          },
          success: function(result)
          {
            console.log(result);                
          
            window.location.reload();             
            
          } 
        });  
    }
  });


  $(document).on('keyup','.invite',function()
  {   
    var _this = $(this);
    var email = _this.val();    
    check_availability(_this, email);   
  });
  
  
  
  $(document).on('paste','.invite', function() {
    var _this = $(this);
    setTimeout(function () {
      
      var email = _this.val();    
      console.log(email);
      check_availability(_this, email); 
      
    }, 100);
  });
  
  function check_availability(_this, email)
  {   
    if(validateEmail(email)==true)
    {
      var booking_id = $('#booking_id').val();    
      var start_date = $('#start_date').val();    
      var start_time = $('#start_time').val();
        
      $.ajax({
        url:  '<?php echo base_url()."index.php/booking/not_available_check"; ?>',
        type: "POST",
        data: { 'booking_id': booking_id, 'email': email, 'start_date': start_date, 'start_time': start_time },
        beforeSend: function() {
          
        },
        success: function(result)
        { 
          var data = jQuery.parseJSON(result);
          var available = data.available;           
          console.log('available= '+ available);    
          if(available==0)
          {
            _this.css('border','1px solid red');
            _this.parent().find('.show_avail').show().html("User not available on this date time!");
            $('.add_invite').hide();
            $('.update_schedule_timing').attr('disabled', true);
          }
          else if(available==2)
          {
            _this.css('border','1px solid red');
            _this.parent().find('.show_avail').show().html("User already added!");
            $('.add_invite').hide();
            $('.update_schedule_timing').attr('disabled', true);
          }
          else
          {
            _this.css('border','1px solid #e2e2e4');
            _this.parent().find('.show_avail').hide().html("");
            $('.add_invite').show();
            $('.update_schedule_timing').attr('disabled', false);
          }
          //window.location.reload();             
          
        } 
      });  
      
    }
    else
    {
      
    }
  }
  
  
$(".datepicker, #datepicker2").datepicker({ minDate: 0 });

$("#start_date").datepicker({ minDate: 0 });
$("#addClassSchedule .datepicker").datepicker({ minDate: 0 });

$("input.timepicker").timepicker({
    timeFormat: 'H:i',
    'step': 15
    //minTime: '10',
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
    estimator_ids=temp_estimator;
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('addEventSource',<?php echo $events; ?>);
    $('#calendar').fullCalendar('refetchEvents');
    $('.reminder_checkbox').attr('checked',false);


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
     addClass();
  });
  




  /*check all estimators*/
  $(".estimator-all .check_all").change(function(){

     estimator_ids=temp_estimator; 
    $('#calendar').fullCalendar('removeEvents');
    $('#calendar').fullCalendar('addEventSource',<?php echo $events; ?>);
    $('#calendar').fullCalendar('refetchEvents');
    $('.reminder_checkbox').attr('checked',false);


     if($(this).prop("checked") == true)
     {
      estimator_ids = [];
     $('.estimator-list input.est_checkbox').attr('checked',false);
     }else
     {
      estimator_ids.push(0);
     }
      $('#calendar').fullCalendar('refetchEvents');
       addClass();
  });
  


 $('.holiday-li').click(function(){
    $(this).find('input').click();
     var googleEvent = {
        url: base_url+ 'calendar/test',
        type: 'POST',
        data: {
            
        },
        success: function (msg) {
                                console.log('fdsf');
                                var events = msg.events;
                                console.log(events);
                               // callback(events);
                            }
    }
    $('#calendar').fullCalendar('addEventSource', googleEvent);
    $('#calendar').fullCalendar('refetchEvents');
     addClass();
 }); 

  /* email auto complete*/
   $('body').on('keyup', '.auto-email', function () {
    $(this).autocomplete({
        source: function (request, response) {
            $.getJSON(base_url + "booking/getEmails/" + encodeURIComponent(request.term), function (data) {
                var dataLen = data.customers.length;
                response($.map(data.customers, function (value, key) {
                    console.log(value.email);
                    return {
                        label: value.email,
                        value: value.email
                    };
                }));
            });


        },
        minLength: 2,
        delay: 100
    });
  });
  /* Add booking */
  var form = $( "#addClassSchedule #frmAddBooking" );
    form.validate({
        invalidHandler: function(form, validator) {
          var errors = validator.numberOfInvalids();
          if (errors) {
                $("#dialog").animate({ scrollTop: 0 }, "fast");
          }
      }
    }); 

$(document).ready(function(){
      $(document).on("keyup","#addClassSchedule1 #booking_title",function(){
        $("#addClassSchedule1 #event_title_error").html("");
    });
    // $(document).on("keyup","#addClassSchedule1 #notes2",function(){
    //       $("#addClassSchedule1 #note2_error").html("");
    // });
       $(document).on("keyup","#addClassSchedule #booking_title",function(){
        $("#addClassSchedule #event_title_error_big").html("");
    });
      
});

  /* Add Event */
  $( "#addClassSchedule1 .save-btn, #addClassSchedule .add_schedule_timing" ).click(function() {  

    var select_user =  $("#editClassSchedule #created_for").val();
     if(select_user)
     {
        if(select_user == 0)
       {
         alert("please select a user.");
         return false;
       }  
     } 
    var formName;
    if($(this).hasClass('small-modal'))
    {
      formName = 'frmAddBooking1';


      var booking_title =  $("#addClassSchedule1 #booking_title").val();
        if(booking_title == "")
        {
          $("#addClassSchedule1 #event_title_error").html("Please Enter Title.");
           return false;
        }
     
      //time validation start
      var s_time = $("#addClassSchedule1 #start_time1").val();
      var s_date = $("#addClassSchedule1 #start_date1").val(); 
      var e_time = $("#addClassSchedule1 #end_time").val();
      var e_date = $("#addClassSchedule1 #end_date1").val();

      var s_main_date =new Date(s_date);
      var e_main_date =new Date(e_date);

      s_main_date.setDate(s_main_date.getDate());
      var s_dd = s_main_date.getDate();
      var s_mm = s_main_date.getMonth();
      var s_y = s_main_date.getFullYear();

      e_main_date.setDate(e_main_date.getDate());
      var e_dd = e_main_date.getDate();
      var e_mm = e_main_date.getMonth();
      var e_y = e_main_date.getFullYear();


      if(e_main_date >= s_main_date)
      {   } else {
         $("#addClassSchedule1 #time-error").css("display","inline-block");
         $("#addClassSchedule1 #time-error").text('Invalid Schedule time');
         setTimeout(function(){
            $("#addClassSchedule1 #time-error").fadeOut('slow');
         },2000);
         return false;
      }

      var stheTime = $("#addClassSchedule1 #start_time1").val().split(":");
      var s_hour = stheTime[0];
      var s_min = stheTime[1]; 

      var etheTime = $("#addClassSchedule1 #end_time").val().split(":");
      var e_hour = etheTime[0];
      var e_min = etheTime[1]; 

     var sFormatted = s_date + ' ' + s_time;
     var eFormatted = e_date + ' ' + e_time;

      var date1 = new Date(sFormatted);
      var date2 = new Date(eFormatted);

      if(s_dd == e_dd)
      {
        if(date1.getTime() < date2.getTime())
          { 
             console.log("s_hour",s_hour);
              console.log("e_hour",e_hour);
          } else 
          {
              console.log("first");
              console.log("s_hour",s_hour);
              console.log("e_hour",e_hour);
             $("#addClassSchedule1 #time-error").css("display","inline-block");
             $("#addClassSchedule1 #time-error").text('Invalid Schedule time');
             setTimeout(function(){
                $("#addClassSchedule1 #time-error").fadeOut('slow');
             },2000);
             return false;
         }

        
       }
    //time validation end

    }
    else if($(this).hasClass('big-modal'))
    {
       formName = 'frmAddBooking';

        var booking_title =  $("#addClassSchedule #booking_title").val();
        if(booking_title == "")
        {
          $("#addClassSchedule #event_title_error_big").html("Please Enter Title.");
           return false;
        }
      //time validation start 3800
      var s_time = $("#addClassSchedule #start_time").val();
      var s_date = $("#addClassSchedule #start_date_more").val(); 
      var e_time = $("#addClassSchedule #end_time").val();
      var e_date = $("#addClassSchedule #end_date_more").val();

      var s_main_date =new Date(s_date);
      var e_main_date =new Date(e_date);

      s_main_date.setDate(s_main_date.getDate());
      var s_dd = s_main_date.getDate();
      var s_mm = s_main_date.getMonth();
      var s_y = s_main_date.getFullYear();

      e_main_date.setDate(e_main_date.getDate());
      var e_dd = e_main_date.getDate();
      var e_mm = e_main_date.getMonth();
      var e_y = e_main_date.getFullYear();


      if(e_main_date >= s_main_date)
      {   } else {
         $("#addClassSchedule #time-error").css("display","inline-block");
         $("#addClassSchedule #time-error").text('Invalid Schedule time');
         setTimeout(function(){
            $("#addClassSchedule #time-error").fadeOut('slow');
         },2000);
         return false;
      }

      var stheTime = $("#addClassSchedule #start_time").val().split(":");
      var s_hour = stheTime[0];
      var s_min = stheTime[1]; 

      var etheTime = $("#addClassSchedule #end_time").val().split(":");
      var e_hour = etheTime[0];
      var e_min = etheTime[1]; 

     var sFormatted = s_date + ' ' + s_time;
     var eFormatted = e_date + ' ' + e_time;

      var date1 = new Date(sFormatted);
      var date2 = new Date(eFormatted);

      if(s_dd == e_dd)
      {
        if(date1.getTime() < date2.getTime())
          { 
             console.log("s_hour",s_hour);
              console.log("e_hour",e_hour);
          } else 
          {
              console.log("first");
              console.log("s_hour",s_hour);
              console.log("e_hour",e_hour);
             $("#addClassSchedule #time-error").css("display","inline-block");
             $("#addClassSchedule #time-error").text('Invalid Schedule time');
             setTimeout(function(){
                $("#addClassSchedule #time-error").fadeOut('slow');
             },2000);
             return false;
         } 
       }
    //time validation end

    }
    
     if(form.valid())
      {
       $('#addClassSchedule .ajax-load').show();
       $('#addClassSchedule1 .ajax-load').show();
       $("#addClassSchedule1 #notes2").val(CKEDITOR.instances.notes2.getData());
       $("#addClassSchedule #notes5").val(CKEDITOR.instances.notes2.getData());
       $('#'+formName).ajaxSubmit({
                  dataType: 'json',
                  success: function (data) {
                      $('#addClassSchedule .get-notify2').html('');
                      $('#addClassSchedule').modal("hide");
                      $('#addClassSchedule1').modal("hide");
                      formName = '';
                      if (typeof data != 'undefined' && typeof data.message != 'undefined' && data.message != 'undefined' && data.success == true) {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-success alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Success! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                          $('#calendar').fullCalendar('refetchEvents');
                          $('#addClassSchedule #frmAddBooking')[0].reset();
                          $('#addClassSchedule1 #frmAddBooking1')[0].reset();
                          $('#installer').val(null).trigger('change');
                          $('#addClassSchedule .ajax-load').hide();
                          $('#addClassSchedule1 .ajax-load').hide();
                      }else if(typeof data != 'undefined'  && data.success != 'undefined' && data.success == false)
                      {
                        var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                          $('#addClassSchedule .ajax-load').hide();
                          $('#addClassSchedule1 .ajax-load').hide();
                      }                        
                     
                  },
                  error: function(data){
                    $('#addClassSchedule .get-notify2').html('');
                    $('#addClassSchedule').modal("hide");
                   // location.reload();
                    if (typeof data != 'undefined') {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>There are some problems to perform this action.</div></div>';
                          $('.flash-message').html(html);
                          $('#addClassSchedule .ajax-load').hide();
                         } 
                  }  
              });
      }
    });
 /* edit event */ 
$(document).on('click','.edit_event', function(){
    $('#eventViewModal').modal('hide');
    $('#editClassScheduleNew').modal('show');
    setTimeout(function(){ $('body').addClass('modal-open');
    $('body').css('padding-right','15px'); },1000)
    $('#editClassScheduleNew .invite_dv').html('');
  });
$(".duplicate_booking").click(function(){
    $('#editClassSchedule').modal();
    $("#fullCalModal").modal('hide');
    setTimeout(function(){ $('body').addClass('modal-open');
    $('body').css('padding-right','15px'); },1000)
    $('#title_id').val($('#modalTitle').html());
    $('#classScheduleTitle').html("Duplicate Booking");
    $("#frmEditBooking3").attr("action",base_url+"booking/bookNow");
    $("#suggestion,#book_status").remove();
    $(".booking_availability").addClass("in").css("visibility","visible");
    $(".icon.update_schedule_timing2").replaceWith('<button type="button" class="icon add_schedule_timing" disabled=""><i class="fas fa-check"></i><span class="hover-title" style="width:90px; margin-left:-17px;">Book Now </span></button>');
    $(".btn.update_schedule_timing2").replaceWith('<button type="button" class="btn btn-success add_schedule_timing">Book Now</button>');
    $('.booking_availability_show').removeClass('in');
    $(".attached_files").html('');
    availCheck();
});
$(document).on('click','.add_reminder',function(){
    
    var html = '<div class="row"> <div class="col-sm-4 col-xs-12"> <div class="form-group"> <div class="controls">  <select class="form-control" name="notify_by">  <option value="email">Email</option> </select></div> </div> </div>   <div class="col-sm-3 col-xs-12" style="padding-left:0;"> <div class="form-group"> <div class="controls"> <input class="input-xlarge form-control" type="number" min=1 value=1 name="notify_before"> </div> </div>  </div>  <div class="col-sm-3 col-xs-12" style="padding-left:0;"> <div class="form-group"> <div class="controls"> <select class="form-control" name="notify_on"> <option value="days">Days</option> <option value="weeks">Weeks</option> </select> </div> </div> </div>  <div class="col-sm-2 col-xs-12" style="padding:0;"> <div class="form-group"> <div class="controls remove_notify"> <i class="fa fa-times" aria-hidden="true"></i> </div> </div>  </div>  </div>';     
    
    console.log(html);
    $('.notify').html(html);
    
  });
/* update event */
var form2 = $( "#frmEditBooking2" );
    form2.validate({
        invalidHandler: function(form, validator) {
          var errors = validator.numberOfInvalids();
          if (errors) {
                $("#dialog").animate({ scrollTop: 0 }, "fast");
          }
      }
    });
$(".update_schedule_timing1").click(function(){ 


   //time validation start 3800
      var s_time = $("#editClassScheduleNew #start_time").val();
      var s_date = $("#editClassScheduleNew #start_date3").val(); 
      var e_time = $("#editClassScheduleNew #end_time").val();
      var e_date = $("#editClassScheduleNew #end_date3").val();


      if(s_time=='' || s_time==null)
      {
         $("#editClassScheduleNew #time-error").css("display","inline-block");
         $("#editClassScheduleNew #time-error").text('Invalid Schedule time');
         setTimeout(function(){
            $("#editClassScheduleNew #time-error").fadeOut('slow');
         },2000);
         return false;
      }


      var s_main_date =new Date(s_date);
      var e_main_date =new Date(e_date);

      s_main_date.setDate(s_main_date.getDate());
      var s_dd = s_main_date.getDate();
      var s_mm = s_main_date.getMonth();
      var s_y = s_main_date.getFullYear();

      e_main_date.setDate(e_main_date.getDate());
      var e_dd = e_main_date.getDate();
      var e_mm = e_main_date.getMonth();
      var e_y = e_main_date.getFullYear();


      if(e_main_date >= s_main_date)
      {   } else {
         $("#editClassScheduleNew #time-error").css("display","inline-block");
         $("#editClassScheduleNew #time-error").text('Invalid Schedule time');
         setTimeout(function(){
            $("#editClassScheduleNew #time-error").fadeOut('slow');
         },2000);
         return false;
      }

      var stheTime = $("#editClassScheduleNew #start_time").val().split(":");
      var s_hour = stheTime[0];
      var s_min = stheTime[1]; 

      var etheTime = $("#addClassSchedule #end_time").val().split(":");
      var e_hour = etheTime[0];
      var e_min = etheTime[1]; 

     var sFormatted = s_date + ' ' + s_time;
     var eFormatted = e_date + ' ' + e_time;

      var date1 = new Date(sFormatted);
      var date2 = new Date(eFormatted);

      if(s_dd == e_dd)
      {
        if(date1.getTime() < date2.getTime())
          { 
             console.log("s_hour",s_hour);
              console.log("e_hour",e_hour);
          } else 
          {
              console.log("first");
              console.log("s_hour",s_hour);
              console.log("e_hour",e_hour);
             $("#editClassScheduleNew #time-error").css("display","inline-block");
             $("#editClassScheduleNew #time-error").text('Invalid Schedule time');
             setTimeout(function(){
                $("#editClassScheduleNew #time-error").fadeOut('slow');
             },2000);
             return false;
         }

        
       }
    //time validation end


  if(form2.valid())
      {

       var arr = $('#frmEditBooking2').find('input[name="invite[]"]').map(function () {
        return this.value; // $(this).val()
       }).get(); 
       
       $('.check_guest').html('');   
       
       if(hasDuplicates(arr)){
            $('.check_guest').append('<div class="alert alert-danger">Email can not be same</div>');
            return;
       } 

       //$('#editClassScheduleNew .ajax-load').css('display','block');
       $('#editClassScheduleNew .ajax-load').show();
       $("#notes3").val(CKEDITOR.instances.notes3.getData());
       $('#frmEditBooking2').ajaxSubmit({
                  dataType: 'json',
                  success: function (data) {
                    //alert(data.success);
                      $('#editClassScheduleNew').modal("hide");
                      
                      if (typeof data != 'undefined' && typeof data.message != 'undefined' && data.message != 'undefined' && data.success == true) {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-success alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Success! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                          $('#calendar').fullCalendar('refetchEvents');
                          //$('#editClassScheduleNew .ajax-load').css('display','none');
                          $('#editClassScheduleNew .ajax-load').hide();
                      }else if(typeof data != 'undefined'  && data.success != 'undefined' && data.success == false)
                      {
                        var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                          //$('#editClassScheduleNew .ajax-load').css('display','none');
                          $('#editClassScheduleNew .ajax-load').hide();
                      }                        
                      window.location.reload();
                  },
                  error: function(data){
                    $('#editClassScheduleNew').modal("hide");
                    if (typeof data != 'undefined') {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>There are some problems to perform this action.</div></div>';
                          $('.flash-message').html(html);
                          //$('#editClassScheduleNew .ajax-load').css('display','none');
                          $('#editClassScheduleNew .ajax-load').hide();
                         } 
                  }  
              });

    }
});
 /*Delete event */
  $(".delete_event").click(function(){
   if (confirm("Are you sure to delete this event ?")) {
    var eventId = $('#eventViewModal #event_id').val();
     $.ajax({
            url: base_url + 'calendar/delete/' + eventId,
            error: function () {
              var html = '';
                    var html = '<div data-auto-dismiss="2000" class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>error!</strong>There is Problem in performing this action.</div>';
                    $('#eventViewModal').modal("hide");
                    $('#calendar').fullCalendar('refetchEvents');
                    $('.flash-message').html(html);
            },
            dataType: 'JSON',
            success: function (data) { 
                if (typeof data != 'undefined' && typeof data.success != 'undefined' && data.success != 'undefined' && data.message != 'undefined') {
                    var html = '';
                    var html = '<div data-auto-dismiss="2000" class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Success! </strong>'+ data.message + '</div>';
                    $('#eventViewModal').modal("hide");
                    $('.flash-message').html(html);
                    $('#calendar').fullCalendar('refetchEvents');
                   
                }
            },
            type: 'GET'
        });
    }  
  });
  $("#book_now").click(function(){
    $(".booking_availability span").html('');
  });
  /*Delete event */
  $(".print_event").click(function(){
    var eventId = $('#eventViewModal #event_id').val();
     $.ajax({
            url: base_url + 'calendar/print/' + eventId,
            error: function () {
             
            },
            dataType: 'JSON',
            success: function (data) { 
              console.log(data);
                if (typeof data != 'undefined' && typeof data.success != 'undefined' && data.success != 'undefined') {
                   window.open( base_url + 'upload/pdf/' + data.file ,"_blank" );

                }
            },
            type: 'GET'
        });
  });
  /* update lead booking event */
var form3 = $( "#frmEditBooking3" );
    form3.validate(
    {
        rules: {
        booking_title: "required",
        //end_date: { required:false, greaterThan: "#start_date" }
        },
        invalidHandler: function(form, validator) {
          var errors = validator.numberOfInvalids();
          if (errors) {
                $("#editClassSchedule").animate({ scrollTop: 0 }, "fast");
          }
      },
      messages:{
       booking_title: "Enter Booking title." 
      }
    });


$(document).on("click","#editClassSchedule button.update_schedule_timing2",function(){ 

    var select_user =  $("#editClassSchedule #created_for").val();
     if(select_user == 0)
     {
       alert("please select a user.");
       return false;
     }
  if(!$("#editClassSchedule #end_date").val()) { 
    // $("#editClassSchedule #end_date").val($("#editClassSchedule #start_date").val());
  }
  var status = false;
  var start_time = $("#editClassSchedule #start_time").val();
  var end_time = $("#editClassSchedule #end_time").val();
  if(form3.valid())
  {

   var arr = $('#frmEditBooking3').find('input[name="invite[]"]').map(function () {
    return this.value; // $(this).val()
    }).get(); 
   $('.check_guest2').html('');   
   if(hasDuplicates(arr)){
        $('.check_guest2').append('<div class="alert alert-danger">Email can not be same</div>');
        return;
   }
   //time validation start 3800
      var s_time = $("#editClassSchedule #start_time").val();
      var s_date = $("#editClassSchedule #start_date").val(); 
      var e_time = $("#editClassSchedule #end_time").val();
      var e_date = $("#editClassSchedule #start_date").val();

      var s_main_date =new Date(s_date);
      var e_main_date =new Date(e_date);

      s_main_date.setDate(s_main_date.getDate());
      var s_dd = s_main_date.getDate();
      var s_mm = s_main_date.getMonth();
      var s_y = s_main_date.getFullYear();

      e_main_date.setDate(e_main_date.getDate());
      var e_dd = e_main_date.getDate();
      var e_mm = e_main_date.getMonth();
      var e_y = e_main_date.getFullYear();

      var stheTime = $("#editClassSchedule #start_time").val().split(":");
      var s_hour = stheTime[0];
      var s_min = stheTime[1]; 

      var etheTime = $("#editClassSchedule #start_date").val().split(":");
      var e_hour = etheTime[0];
      var e_min = etheTime[1]; 

     var sFormatted = s_date + ' ' + s_time;
     var eFormatted = e_date + ' ' + e_time;

      var date1 = new Date(sFormatted);
      var date2 = new Date(eFormatted);

      if(s_dd == e_dd)
      {
        if(date1.getTime() < date2.getTime())
          {  } else 
          {
             $("#editClassSchedule #time-error").css("display","inline-block");
             $("#editClassSchedule #time-error").text('Invalid Schedule time');
             setTimeout(function(){
                $("#editClassSchedule #time-error").fadeOut('slow');
             },2000);
             return false;
         }      
       }
    //time validation end


    //invite guest compare validation
      var arr = $('#frmEditBooking3 .invite');
      var invite_exist = $('#frmEditBooking3 .invite_exist');
      for(var i = 0; i < invite_exist.length; i++){
                var exist = $.trim($(invite_exist[i]).val());
            for(var j = 0; j < arr.length; j++){
                          var invite = $.trim($(arr[j]).val());                           
                           if(exist == invite)
                           {
                              $('.check_guest2').append('<div class="alert alert-danger">Guest email can not be same</div>');
                              return false;
                           }
                  }
      }
    //invite guest compare validation end

 
   $('#editClassSchedule .ajax-load').show();
   $("#notes").val(CKEDITOR.instances.notes.getData());
 
   start_date =$("#editClassSchedule #start_date").val();
   end_date=$("#editClassSchedule #end_date").val();

   $('#frmEditBooking3').ajaxSubmit({
              dataType: 'json',
              success: function (data) {
                  location.reload();
              },
              error: function(data){
                location.reload(); 
              }  
          });

}
});
$(".duplicate_event").click(function(){
  var eventId = $('#eventViewModal #event_id').val();
  $.ajax({
        url: base_url + 'calendar/duplicate/' + eventId,
        type: 'GET',
    dataType: 'JSON',
        success: function (data) { 
          $("#eventViewModal").modal('hide');
          $("#addClassSchedule").modal();
          setTimeout(function(){ $('body').addClass('modal-open'); },1000);
          $("#addClassSchedule #start_date_more").val(data['calendarJobs'][0]['start_date']);
          $("#addClassSchedule #start_time").val(data['calendarJobs'][0]['start_time']);
          $("#addClassSchedule #end_date_more").val(data['calendarJobs'][0]['end_date']);
          $("#addClassSchedule #end_time").val(data['calendarJobs'][0]['end_time']);
          if(data['calendarJobs'][0]['all_day'] ==1)
            {
            $("input[type=checkbox]").attr('checked', 'checked');
            $("#editClassSchedule .start_time_dv").css("display", "none");
            }
            $("#calendar_type2").find("option[value="+data['calendarJobs'][0]['calendar_id']+"]").attr('selected', true);
          $("#addClassSchedule #booking_title").val(data['calendarJobs'][0]['title']);
          CKEDITOR.instances.notes2.setData(data['calendarJobs'][0]['notes']);
          
          console.log(data['calendarJobs'][0]);
        },
        error: function () {
          alert("error");
        }
    });
}); 
$("#share_submit").click(function(){
  if($("#cal-select").val()){
      if($("#users_list").val() == null){
        alert("Please select an user in the list.");
        return false;
      }
    } 
});
</script> 
<script type="text/javascript">

    $(document).ready(function(){
        $('.file_uploader #file').click(function(e){
          $('.file_uploader .value').text('');
        });
        $('.file_uploader #file').change(function(e){
            var fileName = e.target.files[0].name;
            $('.file_uploader .value').text(fileName);
        });
    });

   $(document).on("mouseenter",".fc-row.fc-week [data-date]", function(){
      var get_date = $(this).attr('data-date');
    if(!$(this).hasClass('fc-other-month')){
      $(".fc-row.fc-week [data-date='"+get_date+"']").addClass('fc-day-hover');  
    }
    });
   $(document).on("mouseleave",".fc-row.fc-week [data-date]",function(){
      var get_date = $(this).attr('data-date');
    if(!$(this).hasClass('fc-other-month')){
         $(".fc-row.fc-week [data-date='"+get_date+"']").removeClass('fc-day-hover');
      }
    });
    /* check availability */
  $(document).on("click", ".check_booking", function(){
    var record_id = $("#frmEditBooking3 #record_id").val();
    var start_date = $("#frmEditBooking3 #start_date").val();
    var start_time = $("#frmEditBooking3 #start_time").val();
    var email = $("#frmEditBooking3 #email").val();
    if($("#frmEditBooking3 #all_day").prop("checked") == true)
    {
      if(start_date != ''){
        $.ajax({
          method:"post",
          url:base_url + 'booking/checkAvailability',
          data:{'record_id':record_id, 'start_date':start_date, 'start_time':start_time,'email':email},
          dataType:"json",
          success:function(data){
             if (typeof data != 'undefined') {  
            console.log(data);
            if(data.booking == false){ 
             //$("#frmEditBooking3 .update_schedule_timing2, .add_schedule_timing").prop("disabled", true);
             $(".booking-alert").text(data.status);
             $(".booking-alert").addClass('alert-false in');
             $(".booking-alert").removeClass('alert-true');
             return false;  
            }else{
              
             //$("#frmEditBooking3 .update_schedule_timing2, .add_schedule_timing").removeAttr("disabled");
             $(".booking-alert").text(data.status); 
             $(".booking-alert").addClass('alert-true in');
              $(".booking-alert").removeClass('alert-false'); 
            }
            }
          },
          error:function(){
          }
        });
       }else
       {
        alert("Choose start date");
       }    
    }else
    {
        if(start_date != '' && start_time != ''){
        $.ajax({
          method:"post",
          url:base_url + 'booking/checkAvailability',
          data:{'record_id':record_id, 'start_date':start_date, 'start_time':start_time,'email':email},
          dataType:"json",
          success:function(data){
             if (typeof data != 'undefined') {  
            console.log(data);
            if(data.booking == false){ 
             //$("#frmEditBooking3 .update_schedule_timing2, .add_schedule_timing").prop("disabled", true);
             $(".booking-alert").text(data.status);
             $(".booking-alert").addClass('alert-false in');
             $(".booking-alert").removeClass('alert-true');
             return false;  
            }else{ 
             //$("#frmEditBooking3 .update_schedule_timing2, .add_schedule_timing").removeAttr("disabled");
             $(".booking-alert").text(data.status);
             $(".booking-alert").addClass('alert-true in');
              $(".booking-alert").removeClass('alert-false'); 
            }
            }
          }
        });
       }else
       {
        alert("Choose start date and time");
       }
     }
  });
 $("#frmEditBooking3 #start_time").timepicker({
    timeFormat: 'H:i',
    'step': 15,
    change:availCheck
  });
  $("#frmEditBooking3 #start_date, #frmEditBooking3 #all_day").on("change keyup",function(){
    availCheck();
  });
  function availCheck(){
    $('.booking-alert').text('');
    $('.booking_availability_show').removeClass('in');
    $('.booking_availability').addClass('in').css("visibility","visible");
   
  }
  $(document).on("click","#editClassSchedule .add_schedule_timing", function() {
     var select_user =  $("#editClassSchedule #created_for").val();
     if(select_user == 0)
     {
       alert("please select a user.");
       return false;
     }
     if(form.valid())
      {
       $('#editClassSchedule .ajax-load').show();
       $("#notes").val(CKEDITOR.instances.notes.getData());
       $('#frmEditBooking3').ajaxSubmit({
                  dataType: 'json',
                  success: function (data) {
                          window.location.reload();  
                  },
                  error: function(data){
                        window.location.reload(); 
                   }  
              });
      }
    });

  /* Get current location */
var latitude;
var longitude;

function currentLocation(){
  if ("geolocation" in navigator){
     navigator.geolocation.getCurrentPosition(function(position){
       latitude = position.coords.latitude;
       longitude = position.coords.longitude;
       initMap();
     });
  }
}
function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: 36.2059116, lng: -113.7525038}
        });
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
        setTimeout(function(){ 
          geocodeLatLng(geocoder, map, infowindow);
          }, 1000);
      }

function geocodeLatLng(geocoder, map, infowindow) {
  var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
  console.log(latlng);
  geocoder.geocode({'location': latlng}, function(results, status) {
  if (status === 'OK') {
    if (results[0]) {
      map.setZoom(11);
      var marker = new google.maps.Marker({
        position: latlng,
        map: map
      });
      console.log(results[0].formatted_address);
      $(".event_location").val(results[0].formatted_address);
    }else{
      alert("No location found.");
    } 
  } 
  });
}
// open map in app
function mapsSelector(formID)
{
var address = $("#addClassSchedule .event_location").val();

 if(address)
 {
  if /* if we're on iOS, open in Apple Maps */
     ((navigator.platform.indexOf("iPhone") != -1) ||
      (navigator.platform.indexOf("iPod") != -1) ||
      (navigator.platform.indexOf("iPad") != -1))
   {
     window.open("maps://maps.google.com/maps?daddr="+address+"&amp;ll=");
   }
   else
   {
     window.open("https://www.google.com/maps?daddr="+address+"&amp;ll=");
   }
 }else
 {
  alert("Please fill out address field");
 }   
}

function mapsSelector2(formID)
{
var address = $("#editClassSchedule .event_location").val();

 if(address)
 {
  if /* if we're on iOS, open in Apple Maps */
     ((navigator.platform.indexOf("iPhone") != -1) ||
      (navigator.platform.indexOf("iPod") != -1) ||
      (navigator.platform.indexOf("iPad") != -1))
   {
     window.open("maps://maps.google.com/maps?daddr="+address+"&amp;ll=");
   }
   else
   {
     window.open("https://www.google.com/maps?daddr="+address+"&amp;ll=");
   }
 }else
 {
  alert("Please fill out address field");
 }   
}


function mapsSelector1(formID)
{
var address = $("#addClassSchedule1 .event_location").val();

 if(address)
 {
  if /* if we're on iOS, open in Apple Maps */
     ((navigator.platform.indexOf("iPhone") != -1) ||
      (navigator.platform.indexOf("iPod") != -1) ||
      (navigator.platform.indexOf("iPad") != -1))
   {
     window.open("maps://maps.google.com/maps?daddr="+address+"&amp;ll=");
   }
   else
   {
     window.open("https://www.google.com/maps?daddr="+address+"&amp;ll=");
   }
 }else
 {
  alert("Please fill out address field");
 }   
}

/*Google place Autocomplete */
var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('event_location')),
            {types: ['geocode']});
         autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('event_location2')),
            {types: ['geocode']});

            autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('event_location3')),
            {types: ['geocode']});

             autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('event_location4')),
            {types: ['geocode']});
              autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('event_location1')),
            {types: ['geocode']});
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }

      $(document).on('change', '.holidays_checkbox', function(){
        var googleCalendarId = 'en.usa#holiday@group.v.calendar.google.com';
        var google = {googleCalendarId: googleCalendarId,className: 'gcal-event-hollydays',color:'#e67c73',}    
        var status = $(this).prop("checked");
        if(status==false){
          $('#calendar').fullCalendar( 'removeEventSource',google);
        }else{
          $('#calendar').fullCalendar( 'addEventSource',google);
        }
        //alert(status);
        // body...
      });


      $(document).on('change', '.holidays_canada_checkbox', function(){
        var googleCalendarId = 'en.canadian#holiday@group.v.calendar.google.com';
        var google = {googleCalendarId: googleCalendarId,className: 'gcal-event-hollydays',color:'#e67c73',}    
        var status = $(this).prop("checked");
        if(status==false){
          $('#calendar').fullCalendar( 'removeEventSource',google);
        }else{
          $('#calendar').fullCalendar( 'addEventSource',google);
        }
      });
      
      $(document).on('change', '.reminder_checkbox', function(){
        var status = $(this).prop("checked");
        $.ajax({
            url: "<?php echo base_url()?>Calendar/getReminderEvent",
            method:'post',
            dataType: 'json',
            success: function (res) {
                if(status==false){

                  estimator_ids=temp_estimator;
                   $('#calendar').fullCalendar('removeEvents');
                   $('#calendar').fullCalendar('addEventSource',<?php echo $events; ?>);
                   $('#calendar').fullCalendar('refetchEvents');
                   addClass();
                }else{

                  temp_estimator= estimator_ids;
                  estimator_ids=[0];
                  $('#calendar').fullCalendar('removeEvents');
                  $('#calendar').fullCalendar('addEventSource',res);
                  $('#calendar').fullCalendar('refetchEvents');
                  addClass();
                }
            }
        });

        
      });


      $(document).on('click', '.delete', function(){
        
        var calendarId = this.id;
        if(confirm('If you click on ok, all the events of this calendar are deleted.'))$.ajax({
          method:"post",
          url:base_url + 'booking/deleteCalendar',
          data:{'calendarId':calendarId},
          success:function(data){window.location.reload();}
        });
        
        //alert(calendarId);
      });

    
 $(document).on('click', '#add-notification-btn', function(){
  var html1;
      if($(this).attr('data-event') == 1){
        html1 = '<div class="col-xs-3"><label class="note1"> </label><select name="notification_via" id="notification_via1" class="notification_via"><option selected value="1">Email</option></select></div><div class="col-xs-3 notification_interval" style="margin-right:-59px !important"><input type="number" class="interval" id="notification_interval1" min=1 max=60 name="notification_interval" placeholder = "before"/></div><div class="notification_type"><select id="notification_type" name="notification_type" class="notification"><option value="3">minutes</option><option value="1">hours</option><option value="2">days</option></select></div><i class="fas fa-times close" id="close-notification" ></i>';
           $('.get-notify2').html(html1);
           $('#notification_interval1').val('1');
           $('.interval').val('10');

      
      }else{
       html1 = ' <div class="col-sm-3 col-xs-6" style="padding-right:0 margin-right:14px"><label class="control-label note1" for="textfield">Remindar</label><select name="notification_via" id="calendar_type" class="notification-via" ><option selected="" value="1">Email</option></select></div><div class="col-sm-3 col-xs-6 all_dv repeat"><label class="control-label" for="textfield"></label><input type="number" class="interval" id="notification_interval1" name="notification_interval" placeholder="before" class="before-time" max="60" min="1" ></div><div class="col-sm-3 col-xs-6 all_dv note"><label class="control-label" for="textfield"></label><select id="notification_type" name="notification_type" class="notification-via notification"><option selected="" value="3">minutes</option><option value="1">hours</option><option value="2">days</option></select></div><i class="fas fa-times close" id="close-notification"></i>'
              $('.get-notify1').html(html1);
              $('.before-time').val('1');
              $('.interval').val('10');
      }
  });
$(document).on('click', '#close-notification', function (){
  $('.get-notify').css('display', 'none');
  $('.get-notify1').css('display', 'block'); 
  $('#add-notification-btn').css('display', 'inline-block');
  $(this).parent().html(''); 
});

$(document).on('click', '#addClassSchedule .close-modal', function(){
  // body...
  $('#addClassSchedule .get-notify2').html('');
  $('#addClassSchedule .add-notification').attr('disabled', true);
});



$(document).on('change', '.notification-via', function(){
  $(".before-time").val(1);
  if($(this).val() == 1){
      $('.before-time').attr({
        "min":1,
        "max":12,
      });

  }else if($(this).val() == 3)
  {
     $('.before-time').attr({
        "min":1,
        "max":60,
      });
  }
  else{
      $('.before-time').attr({
        "min":1,
        "max":7,
      });

  }
});

$(document).on('change', '.notification', function(){
  //alert('test');
     $('.interval').val(1);

  if($(this).val() == 1){
      $('.interval').attr({
        "min":1,
        "max":12,
      });

  }else if($(this).val() == 3)
  {
     $('.interval').attr({
        "min":1,
        "max":60,
      });
  }else{
      $('.interval').attr({
        "min":1,
        "max":7,
      });

  }
});


 $(document).on('click', '#fullCalModal #delete-booking', function(){
  var booking_id = $(this).attr('data-delete');
  if(confirm('Are you sure to delete this booking .'))$.ajax({
    method:'post',
    url:base_url+'booking/deleteBooking',
    data:{'booking_id':booking_id},
    dataType:'json',
    success:function(data){
      //console.log(data.success);
      if(data.success == true){
        $('#fullCalModal').modal('hide');
        $('#calendar').fullCalendar('refetchEvents');
        window.location.reload();
      }else{
         $('#fullCalModal').modal('hide');
         $('#calendar').fullCalendar('refetchEvents');
          window.location.reload();
      }
    }
  });
});

  /* rebooking availability check */
  $(document).on("click", ".check_rebooking", function(){
    var record_id = $("#fullCalModal #srecord").val();
    var start_date = $("#fullCalModal #sdate").val();
    var start_time = $("#fullCalModal #stime").val();
    var created_for = $("#fullCalModal #s_book_created_id").val();
    var email = $("#fullCalModal .semail").text();
        $.ajax({
          method:"post",
          url:base_url + 'booking/checkAvailability',
          data:{'record_id':record_id, 'start_date':start_date, 'start_time':start_time,'email':email,'created_for':created_for},
          dataType:"json",
          success:function(data){
             if (typeof data != 'undefined') {  
            console.log(data);
            if(data.booking == false){
               $("#fullCalModal .rebooking-status").css("margin-left","17px");
               $("#fullCalModal .rebooking-status").text(data.status).css("color","red");
              $("#fullCalModal .re_booking_other").css('display','inline-block');
              $("#fullCalModal .re_booking_other").removeClass('hidden');
              $("#fullCalModal .re_booking_other").addClass('in');

            }else{
              $("#fullCalModal .rebooking-status").text(data.status).css("color","green");

              $("#fullCalModal .re_booking").css('display','inline-block');
              $("#fullCalModal .re_booking").removeClass('hidden');
              $("#fullCalModal .re_booking").addClass('in');
             }
           }
          }, 
        }); 
     });
   /* Rebooking form */
   $(document).on("click",".re_booking_other", function(){
      $(".duplicate_booking").click();
      var start_date = $("#fullCalModal #sdate").val();
     // console.log("start_date",start_date);
      var start_time = $("#fullCalModal #stime").val();
      $("#editClassSchedule #start_date").val(start_date);
      $("#editClassSchedule #start_time").val(start_time);
      $("#editClassSchedule #end_date").val(start_date);
      $("#editClassSchedule #created_for").val(0);
      $('#editClassSchedule #uleadowner').val(0);
      proposed_end_time=$('#proposed_end_time').val();
      $('#editClassSchedule #end_time').val(proposed_end_time);
      setTimeout(function(){ 
        $("#booking_calendar").fullCalendar('gotoDate', moment(start_date));
        $("#booking_calendar").fullCalendar('refetchEvents');
      },500);
      $(".check_booking").click();
     
  });     
  $(document).on("click",".re_booking", function(){
      $(".duplicate_booking").click();
      var start_date = $("#fullCalModal #sdate").val();
     // console.log("start_date",start_date);
      var start_time = $("#fullCalModal #stime").val();
      $("#editClassSchedule #start_date").val(start_date);
      $("#editClassSchedule #start_time").val(start_time);
      $("#editClassSchedule #end_date").val(start_date);

      created_for = $("#editClassSchedule #created_for").val();
      $('#editClassSchedule #uleadowner').val(created_for);
      proposed_end_time=$('#proposed_end_time').val();
      $('#editClassSchedule #end_time').val(proposed_end_time);
      setTimeout(function(){ $("#booking_calendar").fullCalendar('gotoDate', moment(start_date));},500);
      $(".check_booking").click();
     
  });
   /* Rebooking form end*/

  $('#addClassSchedule1 .guest1').keypress(function(e){
    var key = e.which;

    if(key == 13){
      var email = $('#addClassSchedule1 .guest1').val();
        $('#addClassSchedule1 .guest1').val('');
      var html = '<input class="input-xlarge form-control guest2" name="invite[]" type="text" placeholder="Add Guest" required="" value="'+email+'" required autocomplete="off"><i class="fa fa-times remove_invite1" aria-hidden="true"></i>';
        $('#addClassSchedule1 .guest-div').append(html);


    var html1 = '<div class="controls" style="margin-bottom: 5px;"><input class="input-xlarge form-control invite auto-email" name="invite[]" type="text" value="'+email+'" required autocomplete="off" placeholder="Enter email">    <i class="fa fa-times remove_invite" aria-hidden="true"></i>  <div class="show_avail" style="color:red;font-size: 12px;display: none;">User not available on this date time!</div> </div> ';     
    
    //console.log(html);
    $('#addClassSchedule .invite_dv').append(html1);
      
     
    }
  });

  $(document).on('click', '.remove_invite1', function(){
    $(this).prev().val('').remove();
    $(this).remove();
  })

  $(document).on('click', '.saveEvent', function(){
      $('#addClassSchedule1').find('*').removeClass('add-toogle-class');
      $('#addClassSchedule1').find('*').removeClass('add-background');
      $('#addClassSchedule .add-notification').attr('disabled', false);
      $('#addClassSchedule #booking_title').val($('#addClassSchedule1 #booking_title').val());
      
      $('#addClassSchedule #start_date').val($('#addClassSchedule1 #start_date1').val());
      $('#addClassSchedule #start_time').val($('#addClassSchedule1 #start_time1').val());
      $('#addClassSchedule #end_date').val($('#addClassSchedule1 #end_date1').val());
      $('#addClassSchedule #end_time').val($('#addClassSchedule1 #end_time').val());
      
      $('#addClassSchedule #event_location4').val($('#addClassSchedule1 #event_location3').val());
      $('#addClassSchedule #calendar_type2').val($('#addClassSchedule1 #calendar_type2').val());
      $('#addClassSchedule1 #frmAddBooking1')[0].reset();
      $('#addClassSchedule1').modal('hide');
      $('#addClassSchedule').modal('show');

  });
/*$( function() {
    $( "#dialog" ).dialog();
  } );*/

$(document).on("click","#addClassSchedule1 input[type='text']", function(){             
      
    $('#addClassSchedule1').find('*').removeClass('add-toogle-class');
    $('#addClassSchedule1').find('*').removeClass('add-background');
    
    if($(this).hasClass('datepicker') || $(this).hasClass('timepicker')){
      $(this).addClass('add-background');
     // alert('test');
    }else if($(this).hasClass('guest1')){
       $(this).addClass('add-background');
       $(this).parent().parent().addClass('add-toogle-class');
    }else if($(this).hasClass('location')){
        $(this).addClass('add-background');
        $(this).parent().addClass('add-toogle-class');      
    }
});



$(document).on('click', '#calendar .fc-button', function(){ 
  //alert('click');
  addClass();
});


function addClass(){
  var str;  
  $('.fc-month-view .fc-day-number').each(function(){
  str = $(this).text();
  $(this).text('');
  $(this).removeClass('fc-day-number');
  $(this).append( "<span class='fc-day-number'></span>" );
  $(this).children().text(str);
});
  console.log('calling...');
}

$(document).on('mousewheel','.fc-basic-view' , function(e) {
   if($("#expand").is(":visible")){ 
    if(e.originalEvent.wheelDelta / 120 > 0) {
      console.log('next');
       $( "#calendar .fc-center h1" ).toggle( "slide" );
       $( "#calendar .fc-day-number" ).toggle( "slide" );
       $("#calendar .fc-next-button").click();
    } else {
      console.log('prev');
      $( "#calendar .fc-day-number" ).toggle( "slide" );
      $("#calendar .fc-prev-button").click();
        //alert('down');
      }
    }
});
$(document).on('click', '#expand', function(){
  $('.wrapper').css('margin-top', '80px');
  $('.header').css('display', 'block');
  $('#collapse').css('display', 'inline-block');
  $(this).hide();
  //$('.reminder-count').css('top','81px');
//alert('test');
});
$(document).on('click', '#collapse', function(){
  $('.wrapper').css('margin-top', '0px');
  $('.header').css('display', 'none');
   $('#expand').css('display', 'inline-block');
  $(this).hide();
   //$('.reminder-count').css('top','1px');
});

 $(document).on('change','#editClassSchedule #uleadowner',function(){
       created_for=$(this).val();
       $('#ajax-loader10').show();
       $('#editClassSchedule #created_for').val(created_for);
       $("#booking_calendar").fullCalendar('refetchEvents');
 }); 

function hasDuplicates(array) {
    var valuesSoFar = Object.create(null);
    for (var i = 0; i < array.length; ++i) {
        var value = array[i];
        if (value in valuesSoFar) {
            return true;
        }
        valuesSoFar[value] = true;
    }
    return false;
}




/* Auto add end date and end time */
$(document).on('click','#addClassSchedule1 #start_time1', function(){
  $(this).addClass('clicked');
})
$(document).on("click", ".ui-timepicker-wrapper li", function(){
  availCheck();
  if(!$('#addClassSchedule1 #start_time1').hasClass('clicked'))
  {
   return;
  }
  else
  {   
    if($('#addClassSchedule1 #start_time1').timepicker('getTime'))
    {
      $("#addClassSchedule1 #start_time1").removeClass('clicked');  
    }
    else
    {
      $("#addClassSchedule1 #start_time1").removeClass('clicked');
      return;
    }
  }

  var theTime = $(this).text().split(":");
  var theTime1 = theTime[1].split(" ");
  var hour = theTime[0];
  var time_min = theTime1[0]; 

  var theTime2 = parseInt(hour) + parseInt(1);  
  if(hour == "23")
  { 
      theTime2 = parseInt(0);
      var selected111 = $("#addClassSchedule1 #end_date1").val();
      var date =new Date(selected111);
      date.setDate(date.getDate());
      var dd = date.getDate() + 1 ;
      var mm = date.getMonth() + 1;
      var y = date.getFullYear();
      var someFormattedDate = mm + '/' + dd + '/' + y;
      $("#addClassSchedule1 #end_date1").val(someFormattedDate);
  }
  var x =$("#addClassSchedule1 #end_time").val(theTime2+":"+time_min);

});



/* Auto add end date and end time */
$(document).on('click','#addClassSchedule #start_time', function(){
  $(this).addClass('clicked');
})
$(document).on("click", ".ui-timepicker-wrapper li", function(){
  availCheck();
  if(!$('#addClassSchedule #start_time').hasClass('clicked'))
  {
   return;
  }
  else
  {   
    if($('#addClassSchedule #start_time').timepicker('getTime'))
    {
      $("#addClassSchedule #start_time").removeClass('clicked');  
    }
    else
    {
      $("#addClassSchedule #start_time").removeClass('clicked');
      return;
    }
  }

  var theTime = $(this).text().split(":");
  var theTime1 = theTime[1].split(" ");
  var hour = theTime[0];
  var time_min = theTime1[0]; 

  var theTime2 = parseInt(hour) + parseInt(1);  
  if(hour == "23")
  { 
      theTime2 = parseInt(0);
      var selected111 = $("#addClassSchedule #end_date_more").val();
      var date =new Date(selected111);
      date.setDate(date.getDate());
      var dd = date.getDate() + 1 ;
      var mm = date.getMonth() + 1;
      var y = date.getFullYear();
      var someFormattedDate = mm + '/' + dd + '/' + y;
      $("#addClassSchedule #end_date_more").val(someFormattedDate);
  }
  var x =$("#addClassSchedule #end_time").val(theTime2+":"+time_min);

});



/* Auto add end date and end time */
$(document).on('click','#editClassScheduleNew #start_time', function(){
  $(this).addClass('clicked');
})
$(document).on("click", ".ui-timepicker-wrapper li", function(){
  availCheck();
  if(!$('#editClassScheduleNew #start_time').hasClass('clicked'))
  {
   return;
  }
  else
  {   
    if($('#editClassScheduleNew #start_time').timepicker('getTime'))
    {
      $("#editClassScheduleNew #start_time").removeClass('clicked');  
    }
    else
    {
      $("#editClassScheduleNew #start_time").removeClass('clicked');
      return;
    }
  }

  var theTime = $(this).text().split(":");
  var theTime1 = theTime[1].split(" ");
  var hour = theTime[0];
  var time_min = theTime1[0]; 

  var theTime2 = parseInt(hour) + parseInt(1);  
  if(hour == "23")
  { 
      theTime2 = parseInt(0);
      var selected111 = $("#editClassScheduleNew #end_date3").val();
      var date =new Date(selected111);
      date.setDate(date.getDate());
      var dd = date.getDate() + 1 ;
      var mm = date.getMonth() + 1;
      var y = date.getFullYear();
      var someFormattedDate = mm + '/' + dd + '/' + y;
      $("#editClassScheduleNew #end_date3").val(someFormattedDate);
  }
  var x =$("#editClassScheduleNew #end_time").val(theTime2+":"+time_min);

});

$("#reminder_event_modal-close").click(function(){
  $("#reminder_event_modal").removeClass("open");
});

$(document).on('click','#reminder_event_modal .status',function(){
         var r = confirm('Are sure you want to perform this action ?');
        if(r == true){
            var val = $(this).find('input').val();
            $(this).find('input').attr('checked',true);
            var id = $(this).attr('id');
            $.ajax({
            url:'<?php echo base_url();?>'+'reminder/response/'+id + '/'+val,
            type:'get',
            dataType:'json',     
            success:function(data){
              console.log(data);
               if(data.success == true){
                getUpcomingReminders();

                $.ajax({
                      url: "<?php echo base_url()?>Calendar/getReminderEvent",
                      method:'post',
                      dataType: 'json',
                      success: function (res) {
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('addEventSource',res);
                            $('#calendar').fullCalendar('refetchEvents');
                            addClass();
                      }
                  });

               }
             }
           });
            return false;
          }else
          {
            var val = $(this).find('input').prop("checked", false);
            return false;
          }             
});


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmw-ajRb-0ytRRavjIK52f6IbTIB7vrBY&libraries=places&callback=initAutocomplete"></script>


