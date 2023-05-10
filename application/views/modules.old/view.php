<style type="text/css">

/*set to global*/
.card [data-toggle="collapse"], [data-smooth-scroll] {cursor:pointer;}
#main-content {background:#f8fafb;}
#page-header {margin:40px 0 60px;}
#page-header a {font-size:16px; font-weight:700; transition:all .25s ease-in;}
.btn.color-theme {color:#1fb5ad; border:1px solid transparent;}
.btn-theme-o, .btn.color-theme:hover {color:#1fb5ad; background:#e0f7fa; border:1px solid #1fb5ad;}
.btn-theme-o:hover {color:#fff; background:#1fb5ad;}
.icon-btn {border:1px solid; border-radius:50px; font-size:20px; width:36px; height:36px; padding:0; text-align:center; line-height:36px; position:relative;}
.btn + .btn {margin-left:10px;}
.icon-btn .icn-txt {position:absolute; font-size:14px; font-weight:normal; left:50%; background:#aaa; top:27px; 
  z-index:1; padding:4px 9px; display:inline-block; visibility:hidden; opacity:0; transition:all .1s .15s ease; margin-left:-60px; color:#fff;}
.icon-btn:hover .icn-txt {visibility:visible; opacity:1; top:40px;}

.btn-green-o {color:#4caf50; border:1px solid #4caf50; background:#eaf5ea;}
.btn-green-o:hover {color:#fff; background:#4caf50;}

.btn-red-o {color:#f44336; border:1px solid #f44336; background:#fee8e7;}
.btn-red-o:hover {color:#fff; background:#f44336;}
.btn-fill-theme {background:#1fb5ad;}
.btn-fill-blue {background:#03a9f4;}

.btn[class*="btn-fill-"] {color:#fff;}
.btn[class*="btn-fill-"]:hover {box-shadow:0px 2px 5px 0px rgba(0, 0, 0, 0.36);}

.card {box-shadow:0px 2px 5px 0px rgba(0, 0, 0, 0.36); padding:15px;}
.card:not([class*="bg"]) {background:#fff;}
.collapsible-card {padding-bottom:1px;}
.collapsible-card .card-header {margin-bottom:14px;}

.bordered-card {border-left:3px solid;}
.card-header {border-bottom:3px solid #dde5e9;}
.card-title {margin:0;}
.flex-row .col {flex-grow:1;}
.card-content {color:#455a64;}
.card-content ul {padding:0; /*margin:0;*/}
.card-content li {list-style:none; font-size:14px;}
.toggle-card-btn {margin-top:8px; display:inline-block; border-radius:25px; font-size:20px; width:20px; height:20px; text-align:center; line-height:20px; cursor:pointer;}
.toggle-card-btn i {position:relative; left:-4px;}

.table-structure-info table {width:100%; margin-bottom:25px;}
.table-structure-info tr {background:#eceff1; border:solid #dfe4e7; border-width:1px 0;}
.table-structure-info tr:nth-child(even) {background:#f2f4f5;}
.table-structure-info th {padding:8px 10px;}
.table-structure-info td {width:100%; padding:8px 0;}
.table-structure-info table span {line-height:normal;} 

/*new-table*/
.new-table {color:#455a64; font-size:14px;}
.new-table tbody tr:nth-child(odd) {background:#f2f4f5;}
.new-table tr:nth-child(even) {background:#eceff1;}
.new-table tr:nth-child(even) td {border:solid #dfe4e7; border-width:1px 0;}
.new-table tbody:hover tr:not(:hover) {background:transparent;}
.new-table tbody:hover {background:#fff;}
/*.new-table tbody:hover tr:not(:hover) {background:#fff;}*/
.new-table tbody tr:hover {-webkit-box-shadow:inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15); box-shadow:inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0, 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);}

.new-table .th-row {background:#dfe4e7;}
.new-table .th-row th {padding:7px 15px 7px 7px; border-width:2px; border-color:#cad1d7;}

div.dataTables_length label select {width:auto; border-radius:4px; border-color:#dde5e9;}
.dataTables_filter label input {width:auto; border:1px solid #dde5e9; border-radius:4px;}

/*.card .dataTables_length label {font-size:0;}
.card .dataTables_length label:before {content:"Show"; font-size:13px; margin-right:5px;}
.card .dataTables_length label:after {content:"entries"; font-size:13px; margin-left:5px;}*/
.card .dataTables_length select {height:auto !important; font-size:13px; font-weight:normal !important; padding:3px; vertical-align:baseline;}
.card .dataTables_filter input {height:28px;}
.card .dataTables_info {padding-left:0;}

.section-row {margin-top:90px;}

/*End Global*/

/*.hero-row .card {margin-bottom:30px;}*/
.hero-row .card + .card {margin-top:45px;}

#lead-info {padding:25px 40px;}
.card-footer {text-align:center; margin-top:35px; border-top:3px solid #dde5e9; padding-top:25px;}

.additional-info-accordion .panel {border:0;}
.additional-info-accordion .panel-heading {padding:0;}
.additional-info-accordion .panel-title {padding:15px; cursor:pointer; border:1px solid #ddd;}
.additional-info-accordion .panel-body {padding:15px; background:#e4f2fe; border:1px solid #dde5e9; border-top:0;}
.panel-title.collapsed .fa-plus:before {content:"\f068";}
.additional-info-accordion .panel + .panel {margin-top:10px;}
.additional-info-accordion .panel-title:not(.collapsed), .additional-info-accordion .panel-title:hover {background:#e4f2fe;}

.state-cards {margin-top:43px;}
.state-cards .card-icon {font-size:26px; float:left; position:relative; width:50px; height:50px; text-align:center; line-height:55px; margin-top:6px; margin-left:2px;}
.state-cards .card-icon:before {content:'\e80b'; font-family:'icon-anbruch'; font-size:50px; position:absolute; top:0; left:0; line-height:53px; transform:scale(1.25); -webkit-transform:scale(1.25); -moz-transform:scale(1.25);}
.state-cards .card-icon i {position:relative;}
.state-cards h1 {font-size:52px; font-weight:700; margin:30px 0 0;}
.state-cards h4 {margin:0; font-weight:700;}


/*.contact-persons .fa-plus {margin-top:15px;}
.contact-persons .content {padding:15px; border-radius:0 0 5px 5px; border:1px solid #ddd; border-bottom:2px solid #ddd;}

.contact-persons .flex-row {background:#f5f5f5; margin-top:15px; border-radius:5px 5px 0 0; border:1px solid #ddd; padding:0 7px; cursor:pointer; border-bottom:0;}
.contact-persons .flex-row.collapsed {background:#e5e5e5; border-radius:5px; border:1px solid #ddd;}*/

.company-name {color:#929da8; position:relative; top:-4px;}

#stage-indicator-wrapper {margin:-25px -25px 20px; background:#f8fafb; padding:25px; box-shadow:0px 2px 5px 0px rgba(0, 0, 0, 0.36);}
#stage-indicator-wrapper .col-8 .col {flex-grow:1; -ms-flex:0 0 12%; flex:0 0 12%; max-width:12%;}
#stage-indicator-wrapper h4 {padding-bottom:20px; margin:0 0 -11px; position:relative; font-size:15px; font-weight:700;}
#stage-indicator-wrapper h4 span {line-height:normal;}
#stage-indicator-wrapper h4:before {content:''; width:100%; height:3px; position:absolute; left:0; background:#767676; bottom:0; z-index:1;}
#stage-indicator-wrapper .status-completed h4:before {animation:timeline .5s 1s linear forwards; -webkit-animation:timeline .5s 1s linear forwards;}
#stage-indicator-wrapper .status-completed:nth-child(2) h4:before {animation-delay:1.5s; -webkit-animation-delay:1.5s;}
#stage-indicator-wrapper .status-completed:nth-child(3) h4:before {animation-delay:2s; -webkit-animation-delay:2s;}
#stage-indicator-wrapper .status-completed:nth-child(4) h4:before {animation-delay:2.5s; -webkit-animation-delay:2.5s;}
#stage-indicator-wrapper .status-completed:nth-child(5) h4:before {animation-delay:3s; -webkit-animation-delay:3s;}
#stage-indicator-wrapper .status-completed:nth-child(6) h4:before {animation-delay:3.5s; -webkit-animation-delay:3.5s;}
#stage-indicator-wrapper .status-completed:nth-child(7) h4:before {animation-delay:4s; -webkit-animation-delay:4s;}
#stage-indicator-wrapper .status-completed:nth-child(8) h4:before {animation-delay:4.5s; -webkit-animation-delay:4.5s;}
#stage-indicator-wrapper .status-completed h4 span {color:#767676; animation:flip .5s 1s linear forwards; -webkit-animation:flip .5s 1s linear forwards; display:inline-block;}
#stage-indicator-wrapper .status-completed:nth-child(2) h4 span {animation-delay:1.5s; -webkit-animation-delay:1.5s;}
#stage-indicator-wrapper .status-completed:nth-child(3) h4 span {animation-delay:2s; -webkit-animation-delay:2s;}
#stage-indicator-wrapper .status-completed:nth-child(4) h4 span {animation-delay:2.5s; -webkit-animation-delay:2.5s;}
#stage-indicator-wrapper .status-completed:nth-child(5) h4 span {animation-delay:3s; -webkit-animation-delay:3s;}
#stage-indicator-wrapper .status-completed:nth-child(6) h4 span {animation-delay:3.5s; -webkit-animation-delay:3.5s;}
#stage-indicator-wrapper .status-completed:nth-child(7) h4 span {animation-delay:4s; -webkit-animation-delay:4s;}
#stage-indicator-wrapper .status-completed:nth-child(8) h4 span {animation-delay:4.5s; -webkit-animation-delay:4.5s;}

.stage-icon {font-size:71px; color:#767676; display:inline-block;}
.status-completed .stage-icon {animation:flip .5s 1s linear forwards; -webkit-animation:flip .5s 1s linear forwards;}
#stage-indicator-wrapper .status-completed:nth-child(2) .stage-icon {animation-delay:1.5s; -webkit-animation-delay:1.5s;}
#stage-indicator-wrapper .status-completed:nth-child(3) .stage-icon {animation-delay:2s; -webkit-animation-delay:2s;}
#stage-indicator-wrapper .status-completed:nth-child(4) .stage-icon {animation-delay:2.5s; -webkit-animation-delay:2.5s;}
#stage-indicator-wrapper .status-completed:nth-child(5) .stage-icon {animation-delay:3s; -webkit-animation-delay:3s;}
#stage-indicator-wrapper .status-completed:nth-child(6) .stage-icon {animation-delay:3.5s; -webkit-animation-delay:3.5s;}
#stage-indicator-wrapper .status-completed:nth-child(7) .stage-icon {animation-delay:4s; -webkit-animation-delay:4s;}
#stage-indicator-wrapper .status-completed:nth-child(8) .stage-icon {animation-delay:4.5s; -webkit-animation-delay:4.5s;}
/*#stage-indicator-wrapper .block {padding:0 1px;}*/
.status-remaining:not(:first-child) h4:before {border-left:1px solid #fff;}
.status-remaining .indicate {background:#efefef;}
.status-remaining {color:#767676;}
#stage-indicator-wrapper .indicate {width:15px; height:15px; position:relative; top:-1px; border-radius:20px; line-height:18px; border:2px solid; font-size:0; z-index:2;}
#stage-indicator-wrapper .status-completed .indicate {width:20px; height:20px; animation:zoom-out .5s 1s forwards; -webkit-animation:zoom-out .5s 1s forwards; opacity:0;}
#stage-indicator-wrapper .status-completed:nth-child(2) .indicate {animation-delay:1.5s; -webkit-animation-delay:1.5s;}
#stage-indicator-wrapper .status-completed:nth-child(3) .indicate {animation-delay:2s; -webkit-animation-delay:2s;}
#stage-indicator-wrapper .status-completed:nth-child(4) .indicate {animation-delay:2.5s; -webkit-animation-delay:2.5s;}
#stage-indicator-wrapper .status-completed:nth-child(5) .indicate {animation-delay:3s; -webkit-animation-delay:3s;}
#stage-indicator-wrapper .status-completed:nth-child(6) .indicate {animation-delay:3.5s; -webkit-animation-delay:3.5s;}
#stage-indicator-wrapper .status-completed:nth-child(7) .indicate {animation-delay:4s; -webkit-animation-delay:4s;}
#stage-indicator-wrapper .status-completed:nth-child(8) .indicate {animation-delay:4.5s; -webkit-animation-delay:4.5s;}

#stage-indicator-wrapper .status-completed h4:after {content:''; display:inline-block; width:15px; height:15px; position:absolute; background:#efefef; border-radius:25px; bottom:-6px; border:2px solid #767676; left:50%; margin-left:-7.5px; z-index:1;}

#stage-indicator-wrapper .status-completed .indicate:before {font-size:11px; color:#fff;}
#stage-indicator-wrapper .status-completed .indicate {background:currentColor;}
/*#stage-indicator-wrapper .status-remaining .indicate {width:15px; height:15px; position:relative; top:-1px;}*/

@keyframes timeline {
  0% {
    background:#767676;
  }
  100% {
    background:currentColor;
  }
}

@-webkit-keyframes timeline {
  0% {
    background:#767676;
  }
  100% {
    background:currentColor;
  }
}



@keyframes zoom-out {
  0% {
    transform:scale(0);
  }
  33% {
    transform:scale(1.5);
    color:inherit;
    opacity:1;
  }
  67% {
    transform:scale(.75);
    color:inherit;
    opacity:1;
  }
  100% {
    transform:scale(1);
    color:inherit;
    opacity:1;
  }
}

@-webkit-keyframes zoom-out {
  0% {
    -webkit-transform:scale(0);
  }
  33% {
    -webkit-transform:scale(1.5);
    color:inherit;
    opacity:1;
  }
  67% {
    -webkit-transform:scale(.75);
    color:inherit;
    opacity:1;
  }
  100% {
    -webkit-transform:scale(1);
    color:inherit;
    opacity:1;
  }
}

@keyframes flip {
  0% {
    transform:translatey(10px);
    opacity:0;
  }
  33% {
    transform:translatey(-10px);
    opacity:.33;
    color:inherit;
  }
  67% {
    transform:translatey(5px);
    opacity:.67;
    color:inherit;
  }
  100% {
    transform:translatey(0);
    opacity:1;
    color:inherit;
  }
}

@-webkit-keyframes flip {
  0% {
    -webkit-transform:translatey(10px);
    opacity:0;
  }
  33% {
    -webkit-transform:translatey(-10px);
    opacity:.33;
    color:inherit;
  }
  67% {
    -webkit-transform:translatey(5px);
    opacity:.67;
    color:inherit;
  }
  100% {
    -webkit-transform:translatey(0);
    opacity:1;
    color:inherit;
  }
}


.flex-row {display:flex; display:-webkit-flex; flex-wrap:wrap;}
/*input, select, .select2-selection__rendered, .flat-green{height: 34px !important;padding-left: 0 !important;background: white !important;border: none !important;}*/
.select2-selection--multiple{background: white !important;border: none !important;}
/*label{border-bottom: 1px solid #e2e2e4 !important;display: block !important;}*/
ul.select2-selection__rendered{border: none !important;}
.form-group {margin-bottom: 10px;}
div.icheckbox_flat-green{display: inline-block;}
/*.detail-panel{background-color: #efefef;}*/
.detail-box11 {padding: 15px;background: #fff; min-height:220px; border-radius: 5px; box-shadow:0 4px 8px 0 rgba(0,0,0,0.5); height:100%;}
.heading1 {font-size: 16px;color: #fff;font-weight: 600;text-transform: uppercase;display: block;background: #1fb5ad;padding: 5px 15px;margin-bottom: 20px;border-radius: 3px;}
.additional a {display: block;background: #f6f6f6;padding: 5px;}
.detail-box11 a i {float: right;}
strong, p, span, li {line-height: 1.8;}
.btn-success {border: 0;}
form > h1 {text-transform: uppercase;}
#addClassSchedule .modal-content,#editClassScheduleNew .modal-content {border-radius: 0;}
#editClassScheduleNew .modal-title {text-align: center;font-weight: 600;color: #fff !important;}
#editClassScheduleNew .modal-header {background-color: #1FB5AD;padding: 7px;border-radius: 0;}
#editClassScheduleNew .modal-header .fas {color: #fff;}
#editClassScheduleNew .modal-body {background-color: #f1ffff;}
#editClassScheduleNew .form-control {border: 1px solid #1eb5ad !important;background-color: #f1ffff !important;border-radius: 0;}
#addClassSchedule .modal-body label,#editClassScheduleNew .modal-body label {font-weight: 600;color: #16514e;letter-spacing: 0.2px;padding: 4px 0;}
#addClassSchedule .modal-body label.error,#editClassScheduleNew .modal-body label.error {color:#e33244;}
#addClassSchedule .add_invite,#addClassSchedule .add_reminder,#editClassScheduleNew .add_invite,#editClassScheduleNew .add_reminder {text-transform: uppercase;background-color: #1eb5ad;color: #fff;padding: 7px 10px;font-weight: 700;}
#addClassSchedule .add_invite:hover,#addClassSchedule .add_reminder:hover,#editClassScheduleNew .add_invite:hover,#editClassScheduleNew .add_reminder:hover {background-color: #646464;transition: 0.4s;}
#addClassSchedule .remove_invite,#editClassScheduleNew .remove_invite {color: #1eb5ad;}
#addClassSchedule .remove_invite:hover,#editClassScheduleNew .remove_invite:hover {color: #646464;}
#addClassSchedule .guest_checkbox,#editClassScheduleNew .guest_checkbox {display: flex;}
#addClassSchedule .guest_checkbox .check,#editClassScheduleNew .guest_checkbox .check {margin-right: 12px;}
#editClassScheduleNew .modal-footer {background-color: #95d5d1;text-align: center;}
#editClassScheduleNew button.add_schedule_timing {border-radius: 0;font-weight: 700;margin: 4px 10px;background-color: #646464;padding: 8px 50px;border: none;}
#editClassScheduleNew button.btn-normal {border-radius: 0;font-weight: 700;margin: 4px 10px;background-color: #f2fffe;padding: 8px 50px;border: none;color: #646464;}
#editClassScheduleNew button.add_schedule_timing:hover {background-color: #0f8f88;transition: 0.4s;}
#editClassScheduleNew button.btn-normal:hover {background-color: #1eb5ad;
    transition: 0.4s;color: #fff;}
#addClassSchedule .form-group label {border-bottom: 0 !important;}
.ui-timepicker-container{ z-index:9999 !important; }
form .form-group .controls input,form .form-group .controls select{padding-left: 10px !important;}
.check_booking {text-transform: uppercase;background-color: #1eb5ad;color: #fff;padding: 7px 10px; font-weight:700;}
.check_booking:hover, .check_booking:focus {background-color:#646464; transition:0.4s; color:#fff;}
.new-layout .modal-header {background:#fff; color:#333; border-radius:0; padding:0; position:relative; z-index:1;}
.new-layout .title {float:left; width:75%; text-align:left; padding:15px;}
.new-layout h4.modal-title {font-weight:400; letter-spacing:1px;}
.icons-plot {float:right; width:25%; text-align:right; padding:9px 15px;}
.icons-plot .icon {display:inline-block; border-radius:52px; width:37px; height:37px; line-height:37px; text-align:center; font-size:16px; cursor:pointer; position:relative; user-select:none; background:#fff; border:0;}
.icons-plot .icon[disabled] {opacity:.5; cursor:not-allowed;}
.icons-plot .close-modal {margin-left:15px;}
.icons-plot .icon i {color:#5f6368;}
.icons-plot .hover-title {position:absolute; bottom:-22px; left:-6px; color:#fff; padding:4px 10px; line-height:normal; font-size:14px; background:#5f6368; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
.icons-plot .icon:hover {background:#f5f5f5;}
.icons-plot .icon:hover .hover-title {bottom:-30px; opacity:1;}
/* div#logs_wrapper .row-fluid , #dynamic-table-bookings_wrapper .row-fluid*/ {padding:0 15px;}
div#logs_wrapper .dataTables_paginate.paging_bootstrap.pagination , #dynamic-table-bookings_wrapper .dataTables_paginate.paging_bootstrap.pagination {margin-bottom:3px;}

.new-layout .form-control {background-color:#f1f3f4 !important; padding-left:10px !important;}
.new-layout label {display:inline-block !important; border:0 !important;}
.new-layout .input-disabled {display:inline-block; width:auto; background:transparent !important; font-weight:300 !important; border:0; padding:0 !important;}
.new-layout .ajax-load {float:right; width:80px; margin:-25px -25px -21px -17px; display:none;}
.new-layout .btn-success {background:#1eb5ad;}
.new-layout .btn-success:hover {background:#129e97;}
.new-layout .modal-footer .btn-normal {background:none;}
.new-layout .modal-footer .btn-normal:hover {background:#d5d5d5; color:#333;}
.event-day-time input {margin:0 8px 10px 0; display:inline-block;}
.event-day-time .event-recurrence {cursor:pointer; user-select:none; width:130px; margin-top:15px;}
.event-day-time .input-checkbox-icon {display:inline-block; width:17px; height:17px; border:2px solid #1fb5ad; border-radius:3px; margin:6px 6px 0 0; vertical-align:bottom; position:relative;}
.event-day-time input:checked + .input-checkbox-icon {background:#1fb5ad;}
.event-day-time input:checked + .input-checkbox-icon:before {content:''; width:12px; height:6px; border:solid #fff; border-width:0 0 2px 2px; transform:rotatez(-45deg); -webkit-transform:rotatez(-45deg); -ms-transform:rotatez(-45deg); -o-transform:rotatez(-45deg); -moz-transform:rotatez(-45deg); display:inline-block; position:absolute; left:0px; top:2px;}
.event-day-time .txt-to {left:-7px; position:absolute; top:36px;}
.event-day-time .all_dv[style="display: none;"] + div {margin-left:17px;}

.new-layout .inline-select {cursor:pointer; width:224px; background:#f1f3f4 !important; padding-left:5px !important;  border-radius:4px; margin-left:10px;}

.file_uploader {border:2px dashed #ccc; background:#f1f3f4; padding:24px; position:relative; text-align:center; font-size:20px;}
.file_uploader:hover {background:#f0f0f0; border-color:#bbb;}
.file_uploader input {position:absolute; width:100%; height:100% !important; left:0; top:0; opacity:0; cursor:pointer;}
.file_uploader .value:not(:empty) + .default {display:none;}

.dataTables_length, .dataTables_filter {padding-right:0; padding-left:0;}
 .dataTables_filter label {text-align:right;}
section.panel {box-shadow:none;}
.modal-dialog {box-shadow:0 4px 8px 0 rgba(0,0,0,0.5);}
</style>

<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/jquery.timepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.timepicker.min.js"></script>
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.form.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/ckeditor/ckeditor.js"></script>


<?php //echo '<pre>';print_r($record_data);die; ?>
<?php  $propose = 0;
       $develop_date = '';
       $proposed_date = '';
       //print_r($bookings);die();
      if(!empty($bookings)){ // Develop
        foreach ($bookings as $value) {
          if($value['status'] == 1){
            $propose = 1;
            $proposed_date = $value['status_change_date'];
          }
          $develop_date = $value['created_time'];
        }
      }

?>			
<section id="main-content">
	<section class="wrapper">

		<div id="stage-indicator-wrapper">
      <div class="indicator-container container color-purple" style="max-width:100%;">
        <h3 style="margin-top:0;">Leads Pipeline</h3>
        <input type="hidden" id="current_module" value="<?php echo $current_module; ?>">
         <div class="indicator-row flex-row text-center <?php echo ($current_module == 'Leads') ? "col-4" : (($current_module == "Clients")  ? "col-5" : "col-8");?>">
          <div id="stage-asigned" class="col status-completed">
            <div class="block">
              <i class="icon-crm-add-contact stage-icon"></i>
              <h4> <span>Assigned</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
            <?php if(!empty($record_data['created_time'])){ ?>
             <div>
              <span>Assigned At</span> <span><?php echo !empty($record_data) ? date("m/d/Y h:i a", $record_data['created_time']) : '';?></span>
             </div> 
          <?php } ?>
          </div>
          <div id="stage-qualify" class="col color-theme <?php echo !empty($qualified) ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="icon-crm-qualify stage-icon"></i>
              <h4> <span>Qualify</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
            <?php if(!empty($qualified)){ ?>
             <div>
              <span><?php echo $qualified['selling_goods_to_canada'] == 'yes' ? 'Qualified At' : 'Not Qualified At' ?></span> <span><?php echo !empty($qualified) ? date("m/d/Y h:i a",strtotime($qualified['created_time'])) : '';?></span>
             </div> 
          <?php }elseif(empty($qualified) && (!empty($bookings) || $propose == 1 || $current_module == 'Clients' || $current_module == 'Contracts')){
              echo '<div><i class="fa fa-question-circle"></i></div>'; 
              }
              ?>
          </div>
          <div id="stage-develop" class="col color-orange <?php echo !empty($bookings) ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="icon-crm-develop stage-icon"></i>
              <h4> <span>Develop</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
            <?php if(!empty($bookings)){ ?>
            <div>
                <span>Developed At</span> <span><?php echo !empty($bookings) ? date("m/d/Y h:i a",strtotime($develop_date)) : '';?></span>
            </div>
             <?php }elseif(empty($bookings) && ($propose == 1 || $current_module == 'Clients' || $current_module == 'Contracts')){
              echo '<div><i class="fa fa-question-circle"></i></div>';
             }?>
          </div>
          <div id="stage-propose" class="col color-blue <?php echo  $propose == 1 ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="icon-crm-propose stage-icon"></i>
              <h4> <span>Propose</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
            <?php if($propose == 1){ ?>
            <div>
                <span>Proposed At</span> <span><?php echo !empty($propose == 1) ? date("m/d/Y h:i a",strtotime($proposed_date)) : '';?></span>
            </div>
             <?php }elseif($propose != 1 && $current_module == 'Clients' || $current_module == 'Contracts'){
              echo '<p><i class="fa fa-question-circle"></i></p>';
             }?>
          </div>
    <?php if($current_module == 'Clients' || $current_module == 'Contracts')
    { ?>     
          <div id="stage-close" class="col color-yellow <?php echo !empty($current_module) && $current_module == 'Clients' || $current_module == 'Contracts' ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="icon-crm-checklist stage-icon"></i>
              <h4> <span>Close</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
            <?php if($current_module == 'Clients' || $current_module == 'Contracts'){ ?>
            <div>
                <span>Closed At</span> <span><?php echo !empty($record_data['created_time']) ? date("m/d/Y h:i a",$record_data['created_time']) : '';?></span>
            </div>
             <?php }?>
          </div>
      <?php  } ?>
      <?php if($current_module == 'Contracts')
       { 
      ?> 
      <div id="stage-technical" class="col color-green <?php echo !empty($record_data['__162']) ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="icon-crm-technical stage-icon"></i>
              <h4> <span>Technical</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
             <?php if(!empty($record_data['__162'])){ ?>
            <div>
                <span><?php echo $record_data['__162']; ?> At</span> <span><?php echo !empty($record_data['created_time']) ? date("m/d/Y h:i a",$record_data['created_time']) : '';?></span>
            </div>
             <?php }elseif(empty($record_data['__162'])  && !empty($record_data['__172']) ){
              echo '<div><i class="fa fa-question-circle"></i></div>';
             }?>
          </div>  

          <div id="stage-invoiced" class="col color-pink <?php echo !empty($record_data['__172']) ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="icon-crm-bill stage-icon"></i>
              <h4> <span>Invoiced</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
             <?php if(!empty($record_data['__172'])){ ?>
            <div>
                <span><?php echo $record_data['__172'];?> </span> <span><?php echo !empty(!empty($invoice_data)) ? ' At '.date("m/d/Y h:i a",strtotime($invoice_data['created_time'])) : '';?></span>
            </div>
             <?php }elseif(empty($record_data['__172']) && isset($record_data['__172']) && $record_data['__172'] == 'Invoice Paid'){
              echo '<div><i class="fa fa-question-circle"></i></div>' ;
             }?>
          </div>
          <div id="stage-paid" class="col color-brown <?php echo !empty($record_data['__172']) && $record_data['__172'] == 'Invoice Paid' ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="icon-crm-paid stage-icon"></i>
              <h4> <span>Paid</span> </h4>
              <i class="indicate fa fa-check"></i>
            </div>
             <?php if(!empty($invoice_data) && !empty($record_data['__172']) && $record_data['__172'] == 'Invoice Paid'){ ?>
            <div>
                <span><?php echo !empty($invoice_data) ? 'Paid At '.date("m/d/Y h:i a",strtotime($invoice_data['created_time'])) : '';?></span>
            </div>
             <?php }?>
          </div>
        <?php } ?>  
        </div>
      </div>
    </div>
		
		<div id="page-header">
			<div class="row">
				<div class="left-panel col-sm-6">
					<?php if ($writePermission == true) 
					{ ?>
					<a class="btn btn-theme-o" href="<?php echo base_url() ?>modules/addRecord/?cm=<?php echo $current_module; ?>&ac=new">Add New Record</a>
					<?php 
					} ?>

					<a class="btn color-theme" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>">View All <?php echo $current_module; ?> <i class="icon-crm-arrow-long-right icon-right"></i> </a>
				</div>

				<div class="right-panel col-sm-6 text-right" style="padding-right:50px;">

					<?php 
					if (!(isset($deletedRecord) && $deletedRecord == true)) 
					{ 
						?>
						<?php 
						if ($writePermission == true) 
						{ 
						?>

							<?php 
							if ($current_module == "Contracts") 
							{ ?>
								<!--														
								<a class="module_head" href="<?php echo base_url() ?>modules/invoice/?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>">View Invoice</a> |
								-->
							<?php 
							} ?>
							
							<!-- <a class="module_head" href="<?php echo base_url() ?>modules/editRecord/?cm=<?php echo $current_module; ?>&ac=edit&id=<?php echo $current_record_id; ?>">Edit Record</a> -->
							<a class="btn icon-btn btn-green-o" data-toggle="modal" href="#modalArchive"> <i class="fa fa-save"></i> <span class="icn-txt">Archive Record</span> </a>

							<a class="btn icon-btn btn-red-o" data-toggle="modal" href="#modalDelete"> <i class="icon-crm-delete"></i> <span class="icn-txt">Delete Record</span> </a>
								
						<?php 
						} 
						?>
					<?php 
					} 
					?>

				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-12">
        <section>
				<!-- <section class="panel detail-panel"> -->
					
					<div class="panel-body">
						
						<?php $this->load->view('common/alert'); ?>
						
						<!-- Modal -->
						<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
										<div class="modal-content">
												<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Delete Confirmation</h4>
												</div>
												<div class="modal-body">Are you sure to delete this record?</div>
												<div class="modal-footer">
														<button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
														<button class="btn btn-success" onclick="deleteRecord();" type="button">Confirm</button>
												</div>
										</div>
								</div>
						</div>
						<!-- modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="modalArchive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
										<div class="modal-content">
												<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Archive Confirmation</h4>
												</div>
												<div class="modal-body">Are you sure to archive this record?</div>
												<div class="modal-footer">
														<button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
														<button class="btn btn-success" onclick="archiveRecord();" type="button">Confirm</button>
												</div>
										</div>
								</div>
						</div>
						<!-- modal -->
						
						<!-- Modal -->
						<div class="modal fade" id="modalConvert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
										<div class="modal-content">
												<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Lead Conversion Confirmation</h4>
												</div>
												<div class="modal-body">Are you sure to convert this record to Client?</div>
												<div class="modal-footer">
														<button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
														<button class="btn btn-success" onclick="convertRecord();" type="button">Confirm</button>
												</div>
										</div>
								</div>
						</div>
						<!-- modal -->

						<?php 
						if (isset($deletedRecord) && $deletedRecord == true) 
						{ ?>
								<a type="button" class="btn btn-success btn-lg btn-block" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>">View All <?php echo $current_module; ?> Listing</a>
						<?php 
						}
						else 
						{ ?>
							<form role="form" action="" method="post">
								
							<?php
								if ($current_module == LEADS_PLURAL_NAME)
								{ 
									$first_name_key = "__" . LEAD_FIRST_NAME_META_ID;
									$last_name_key = "__" . LEAD_LAST_NAME_META_ID;
									
									$status_key = "__" . LEAD_STATUS_META_ID;
									$phone_key = "__" . LEAD_PHONE_NUMBER_META_ID;
									
									$company_name_key = "__" . LEAD_COMPANY_NAME_META_ID;
									
									$first_name = isset($record_data[$first_name_key]) ? $record_data[$first_name_key] : "";
									$last_name = isset($record_data[$last_name_key]) ? $record_data[$last_name_key] : "";
									
									$status = isset($record_data[$status_key]) ? $record_data[$status_key] : "No Status Available";
									$call_status = isset($record_data['__27']) ? $record_data['__27'] : "No Status Available";
									
									$phone = isset($record_data[$phone_key]) ? $record_data[$phone_key] : "No Phone Number Available";
									$company_name = isset($record_data[$company_name_key]) ? $record_data[$company_name_key] : "No Company Name Available";
								
									$opener = (isset($record_data['__22']) && $record_data['__22']) ? $record_data['__22'] : "Not Available";
									$closer = (isset($record_data['__21']) && $record_data['__21']) ? $record_data['__21'] : "Not Available";
									
									/*if($opener == 2)
										$opener = 'Bernadette Lucanas';
									if($closer == 4)
										$closer = 'Pawel Krzemieniecki';*/
									//$opener = $closer = '';
									//echo $opener;
									
									foreach($users_list as $arr_usr)
									{
										if($arr_usr['id'] == $opener)
										{
											$opener = $arr_usr['title'];
										}
										if($arr_usr['id'] == $closer)
										{
											$closer = $arr_usr['title'];
										}
									}
						?>
						
									<!--<img style="height: 42px; width: 42px;" alt="" src="<?php echo base_url() ?>static/images/boyAvatar.png">-->

                  <div class="hero-row row">
                    <div class="col-sm-7">

                      <div id="lead-info" class="card bordered-card color-theme">

                        <div class="card-header">
                            <div>
                              <h3 class="card-title"><?php echo $first_name . " " . $last_name; ?> </h3>
                              <span class="company-name"><?php echo $company_name ?></span>
                            </div>

                            <div style="padding:5px 0;">
                              <a href="#" class="btn btn-round btn-fill-theme"> <i class="icon-crm-user-plus"></i> Follow </a>

                              <?php 
                                if (!(isset($deletedRecord) && $deletedRecord == true)) 
                                { 
                                  ?>
                                  <?php 
                                  if ($writePermission == true) 
                                  { 
                                  ?>
                                    <?php 
                                    if ($current_module == "Leads") 
                                    { ?>                            
                                      <a id="convert-to-client" class="btn btn-round btn-fill-blue" data-toggle="modal" href="#modalConvert"> <i class="icon-crm-user-out"></i> Convert To Client</a>

                                    <?php 
                                    } ?>
                                      
                                  <?php 
                                  } 
                                  ?>
                                <?php 
                                } 
                                ?>
                              </div>
                          </div>

                        <div class="card-content">
                          <h4 style="font-size:20px; margin:30px 0 15px;">LEAD INFORMATION</h4>
                          <ul>
                            <li> <b>Lead Name:</b> <?=$record_data['__1']?> <?=$record_data['__2']?> </li>
                            <li> <b>Title:</b> <?=$record_data['__3']?> </li>
                            <li> <b>Function:</b>  <?=$record_data['__8']?> </li>
                            <li> <b>Direct Number:</b>  <?=$record_data['__19']?> </li>
                            <li> <b>Direct Number Extension:</b>  <?=$record_data['__15']?> </li>
                            <li> <b>Alternate Phone:</b>  <?=$record_data['__20']?> </li>
                            <li> <b>Email:</b>  <?=$record_data['__4']?> </li>
                          </ul>
                        </div>

                        <div class="card-footer">
                            <?php if ($current_module == "Leads") { ?>
                              
                               <?php if ($user_role == 1 ||$user_role == 3 || $user_role == 4) { ?>

                              <?php
                              if(!empty($qualified))
                              { ?>
                                <span><?php if($qualified['selling_goods_to_canada']=='yes') { echo 'Qualified'; } else { echo 'Not Qualified'; } ?></span>
                              <?php
                              }
                              else
                              {
                              ?>  
                            <a href="#modalQualifyNow" id="qualify_now" class="btn btn-theme-o" data-toggle="modal">Qualify Now</a>
                            
                            <?php } } } ?>
                            
                            <a href="#" id="send_email" class="btn btn-theme-o" data-email="<?php echo $record_data['__4'] ?>">SEND EMAIL</a>
                            
                            <!-- <a href="<?php echo base_url() ?>booking/bookNow/?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $recordStatus; ?>" id="book_now" class="btn btn-theme-o">Book Now</a> -->
                            <a href="javascript:void(0)" id="book_now" class="btn btn-theme-o" data-toggle="modal" data-target="#addClassSchedule">Book Now</a>
                            <a class="btn btn-theme-o" data-toggle="modal" href="#modalOwnerUpdate">View Notes</a>
                        </div>

                      </div>
                        
                    </div>



<!-- ******************************************************************************************************* -->
<div style="display:none;">

Lead Owner: 
<?php foreach ($users_list as $option_key => $option) 
{ ?>
    <?php if ($option['id'] == $record_data["__0"]) 
    { $lead_owner = $option['title']?>
        <?php echo $option['title']; ?>
    <?php 
    } ?>
<?php 
} ?>

Phone: <?php echo $phone ?> 
Email: <?php echo $record_data['__4'] ?> 
Call Status: <?php echo $call_status ?> 
Lead Status: <?php echo $status ?>


Lead Processor Information
<?=$lead_owner?>
<?=$opener?>
<?=$closer?>
Lead Category: <?=$record_data['__14']?>
Lead Status: <?=$status?>
Proximity: <?=$record_data['__16']?>
Service Type: <?php if(!empty((array)$record_data['__9'])) { echo implode(', </br> ',(array)$record_data['__9']); } ?>

Lead Source: <?=$record_data['__5']?>
ID Source: <?=$record_data['__11']?>
ID Number: <?=$record_data['__7']?>
Lead Referred Partner: <?=$record_data['__10']?>
Source ID: <?=str_replace('zcrm_', '', $record_data['__12'])?>


Created By: <?php foreach ($users_list as $option_key => $option) { ?>
<?php if ($option['id'] == $record_data["__0"]) { ?>
<?php echo $option['title']; ?> 
<?php } ?>
<?php } ?> <?php echo date("j-F-Y", $record_data["created_time"]); ?> 


Modified By:
<?php if ($record_data["modified_by"] != NULL) {
foreach ($users_list as $option_key => $option) { ?>
<?php if ($option['id'] == $record_data["modified_by"]) { ?>
<?php echo $option['title']; ?>
<?php } ?>
<?php }
} else { ?>Not Modified Yet <?php } ?>

<?php if ($record_data["modified_time"] != NULL) { ?>
<?php echo date("j-F-Y", $record_data["modified_time"]); ?>
<?php } else {} 
$head_office_status = '';
if(strtolower($record_data['__42']) == 'false')
  $head_office_status = 'No';
if(strtolower($record_data['__42']) == 'true')                                      
  $head_office_status = 'Yes';
?>

</div>

<!-- ******************************************************************************************************* -->

                    <div class="col-sm-5">

                      <div id="lead-additional-info" class="collapsible-card card bordered-card color-blue">

                        <div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#accordion-LAI">
                          <div class="col">
                            <h4>Additional Lead Information</h4>
                          </div>
                          <div>
                            <span class="toggle-card-btn bg-blue-50">
                              <i class="icon-crm-angle-down"></i>
                            </span>
                          </div>
                        </div>


                        <div id="accordion-LAI" class="card-content collapse panel-group additional-info-accordion">

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion-LAI" href="#person-2"> Contact Person 2 <i class="fa fa-plus pull-right"></i> </h4>
                            </div>
                            <div id="person-2" class="panel-collapse collapse in">
                              <div class="panel-body content">
                                <ul>
                                  <li> <b>First Name:</b> <?=$record_data['__51']?> </li>
                                  <li> <b>Last Name:</b> <?=$record_data['__50']?> </li>
                                  <li> <b>Title:</b> <?=$record_data['__53']?> </li>
                                  <li> <b>Phone:</b> <?=$record_data['__55']?> </li>
                                  <li> <b>Phone Extension:</b> <?=$record_data['__56']?> </li>
                                  <li> <b>Function:</b> <?=$record_data['__52']?> </li>
                                  <li> <b>Email:</b> <?=$record_data['__54']?> </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion-LAI" href="#person-3"> Contact Person 3 <i class="fa fa-plus pull-right"></i> </h4>
                            </div>
                            <div id="person-3" class="panel-collapse collapse">
                              <div class="panel-body content">
                                <ul>
                                  <li> <b>First Name:</b> <?=$record_data['__60']?> </li>
                                  <li> <b>Last Name:</b> <?=$record_data['__58']?> </li>
                                  <li> <b>Title:</b> <?=$record_data['__57']?> </li>
                                  <li> <b>Phone:</b> <?=$record_data['__62']?> </li>
                                  <li> <b>Phone Extension:</b> <?=$record_data['__63']?> </li>
                                  <li> <b>Function:</b> <?=$record_data['__59']?> </li>
                                  <li> <b>Email:</b> <?=$record_data['__61']?> </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion-LAI" href="#person-4"> Contact Person 4 <i class="fa fa-plus pull-right"></i> </h4>
                            </div>
                            <div id="person-4" class="panel-collapse collapse">
                              <div class="panel-body content">
                                <ul>
                                  <li> <b>First Name:</b> <?=$record_data['__64']?> </li>
                                  <li> <b>Last Name:</b> <?=$record_data['__66']?> </li>
                                  <li> <b>Title:</b> <?=$record_data['__65']?> </li>
                                  <li> <b>Phone:</b> <?=$record_data['__69']?> </li>
                                  <li> <b>Phone Extension:</b> <?=$record_data['__70']?> </li>
                                  <li> <b>Function:</b> <?=$record_data['__67']?> </li>
                                  <li> <b>Email:</b> <?=$record_data['__68']?> </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title collapsed" data-toggle="collapse" data-parent="#accordion-LAI" href="#person-5"> Contact Person 5 <i class="fa fa-plus pull-right"></i> </h4>
                            </div>
                            <div id="person-5" class="panel-collapse collapse">
                              <div class="panel-body content">
                                <ul>
                                  <li> <b>First Name:</b> <?=$record_data['__71']?> </li>
                                  <li> <b>Last Name:</b> <?=$record_data['__73']?> </li>
                                  <li> <b>Title:</b> <?=$record_data['__72']?> </li>
                                  <li> <b>Phone:</b> <?=$record_data['__75']?> </li>
                                  <li> <b>Email:</b> <?=$record_data['__74']?> </li>
                                </ul>
                              </div>
                            </div>
                          </div>

                        </div> <!-- /#accordion-LAI -->

                      </div> <!-- /#lead-additional-info -->


                      <div id="company-info" class="collapsible-card card bordered-card color-purple">

                        <div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#collapse-company-info">
                          <div class="col">
                            <h4>Company Information</h4>
                          </div>
                          <div>
                            <span class="toggle-card-btn bg-purple-50">
                              <i class="icon-crm-angle-down"></i>
                            </span>
                          </div>
                        </div>

                        <div id="collapse-company-info" class="card-content collapse">
                          <ul>
                            <li> <b>Company:</b> <?=$record_data['__31']?> </li>
                            <li> <b>Head Office Status:</b> <?=$head_office_status?> </li>
                            <li> <b>Address Line 1:</b> <?=$record_data['__38']?> </li>
                            <li> <b>Address Line 2:</b> <?=$record_data['__39']?> </li>
                            <li> <b>City:</b> <?=$record_data['__35']?> </li>
                            <li> <b>Province:</b> <?=$record_data['__40']?> </li>
                            <li> <b>Country:</b> <?=$record_data['__37']?> </li>
                            <li> <b>Zip Code:</b> <?=$record_data['__36']?> </li>
                            <li> <b>Phone:</b> <?=$record_data['__32']?> </li>
                            <li> <b>Fax:</b> <?=$record_data['__33']?> </li>
                            <li> <b>Website:</b> <a href="http://<?=str_replace('http://', '', $record_data['__34'])?>" target="_blank"><?=$record_data['__34']?></a> </li>
                          </ul>

                        </div>

                      </div> <!-- /#Company-info -->


                      <div id="add-company-info" class="collapsible-card card bordered-card color-brown">

                        <div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#collapse-add-company-info">
                          <div class="col">
                            <h4>Additional Company Information</h4>
                          </div>
                          <div>
                            <span class="toggle-card-btn bg-brown-50">
                              <i class="icon-crm-angle-down"></i>
                            </span>
                          </div>
                        </div>

                        <div id="collapse-add-company-info" class="card-content collapse">

                          <ul>
                            <li> <b>Company Website 2:</b> <?=(isset($record_data['__190']))?$record_data['__190']:''?> </li>
                            <li> <b>Company Website 3:</b> <?=(isset($record_data['__190']))?$record_data['__191']:''?> </li>
                            <li> <b>Company Website 4:</b> <?=(isset($record_data['__190']))?$record_data['__192']:''?> </li>
                            <li> <b>Company Website 5:</b> <?=(isset($record_data['__190']))?$record_data['__193']:''?> </li>
                            <li> <b>Company Website 6:</b> <?=(isset($record_data['__190']))?$record_data['__194']:''?> </li>
                            <li> <b>Company Website 7:</b> <?=(isset($record_data['__190']))?$record_data['__195']:''?> </li> 
                          </ul>

                        </div>

                      </div> <!-- /#Company-info -->

                      <div class="row state-cards">
                        
                        <div class="col-xs-6">
                          <div class="card bg-red-500 color-red-50 text-right" data-smooth-scroll="#activities-card" data-time="10000">
                            <span class="card-icon">
                              <i class="fa fa-list-ol color-red"></i>
                            </span>
                            <h1><?php echo count($logs);?></h1>
                            <h4>ACTIVITIES</h4>
                          </div>
                        </div>

                        <div class="col-xs-6">
                          <div class="card bg-green-500 color-green-50 text-right" data-smooth-scroll="#attachments-card" data-time="500">
                            <span class="card-icon">
                              <i class="icon-crm-doc-text color-green"></i>
                            </span>
                            <h1><?php echo count($attachments);?></h1>
                            <h4>DOCUMENTS</h4>
                          </div>
                        </div>

                      </div>

                    </div> <!-- /.col-sm-5 -->
                  </div> <!-- /.hero-row -->

                  <?php if (!isset($deletedRecord) || $deletedRecord != true) { ?>
                  <div class="row section-row">
                    <div class="col-xs-12">
                      <?php require_once "bookings.php"; ?>
                    </div>
                  </div>
                  <div class="row section-row">
                    <div class="col-xs-12">
                      <?php require_once "new_activities.php"; ?>
                    </div>
                  </div>
                  <div class="row section-row">
                    <div class="col-xs-12">
                      <?php require_once "attachment.php"; ?>
                    </div>
                  </div>
                  <?php } ?>




                  <div class="section-row">
                    <div id="lead-processor-info" class="collapsible-card card bordered-card color-purple">

                      <div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#collapse-lead-processor-info">
                        <div class="col">
                          <h4>Lead Processor Information</h4>
                        </div>
                        <div>
                          <span class="toggle-card-btn bg-purple-50">
                            <i class="icon-crm-angle-up"></i>
                          </span>
                        </div>
                      </div>

                      <div id="collapse-lead-processor-info" class="card-content collapse in">

                        <div class="table-structure-info row">

                          <div class="col-sm-6">
                            <table class="height-equalizer" data-equalizer="table1">
                              <tr>
                                <th nowrap >Lead Owner</th> <td> <?=$lead_owner?> </td>
                              </tr>

                              <tr>
                                <th nowrap >Phone</th> <td> <?php echo $phone ?> </td>
                              </tr>
                              <tr>
                                <th nowrap >Email</th> <td> <?php echo $record_data['__4'] ?> </td>
                              </tr>
                              <tr>
                                <th nowrap >Call Status</th> <td> <?php echo $call_status ?> </td>
                              </tr>
                              <tr>
                                <th nowrap >Lead Status</th> <td> <?php echo $status ?> </td>
                              </tr>
                              <tr>
                                <th nowrap >Lead Category</th> <td> <?php echo $record_data['__14'] ?> </td>
                              </tr>
                              <tr>
                                <th nowrap ># Dial Attempts</th> <td> </td>
                              </tr>                            
                              <tr>
                                <th nowrap >Opener</th> <td> <?=$opener?> </td>
                              </tr>
                              <tr>
                                <th nowrap >Closer</th> <td> <?=$closer?> </td>
                              </tr>
                              <tr>
                                <th nowrap >Proximity</th> <td><?=$record_data['__16']?></td>
                              </tr>
                              <tr>
                                <th nowrap >Service Type</th> <td><?php if(!empty((array)$record_data['__9'])) { echo implode(', </br> ',(array)$record_data['__9']); } ?></td>
                              </tr>
                            </table>
                          </div>

                          <div class="col-sm-6">
                            <table class="height-equalizer" data-equalizer="table1">
                              <tr>
                                <th nowrap >Lead Source</th> <td><?=$record_data['__5']?></td>
                              </tr>
                              <tr>
                                <th nowrap >ID Source</th> <td><?=$record_data['__11']?></td>
                              </tr>
                              <tr>
                                <th nowrap >ID Number</th> <td><?=$record_data['__7']?></td>
                              </tr>
                              <tr>
                                <th nowrap >Lead Referred Partner</th> <td> <?=$record_data['__10']?></td>
                              </tr>
                              <tr>
                                <th nowrap >Source ID</th> <td><?=str_replace('zcrm_', '', $record_data['__12'])?></td>
                              </tr>

                              <tr>
                                <th nowrap >Created By</th>
                                <td>
                                  <?php foreach ($users_list as $option_key => $option) { ?>
                                    <?php if ($option['id'] == $record_data["__0"]) { ?>
                                      <span><?php echo $option['title']; ?></span>
                                    <?php } ?>
                                  <?php } ?>
                                </td>
                              </tr>
                              <tr>
                                <th nowrap >Created On</th>
                                <td><?php echo date("j-F-Y", $record_data["created_time"]); ?></td>
                              </tr>
                              <tr>
                                <th nowrap >Modified By</th>
                                <td>
                                  <?php if ($record_data["modified_by"] != NULL) {
                                    foreach ($users_list as $option_key => $option) { ?>
                                      <?php if ($option['id'] == $record_data["modified_by"]) { ?>
                                        <span><?php echo $option['title']; ?></span>
                                      <?php } ?>
                                    <?php }
                                  } else { ?> Not Modified Yet <?php } ?>
                                </td>
                              <tr>
                                <th nowrap >Modified On</th>
                                <td>
                                  <?php if ($record_data["modified_time"] != NULL) { ?>
                                    <?php echo date("j-F-Y", $record_data["modified_time"]); ?>
                                  <?php } else {}?>
                                </td>
                              </tr>
                              <tr>
                                <th> <span class="invisible"> - </span> </th> <td></td>
                              </tr>
                              <tr>
                                <th> <span class="invisible"> - </span> </th> <td></td>
                              </tr>
                            </table>

                              <?php
                              $head_office_status = '';
                              if(strtolower($record_data['__42']) == 'false')
                                $head_office_status = 'No';
                              if(strtolower($record_data['__42']) == 'true')                                      
                                $head_office_status = 'Yes';
                              ?>

                          </div>


                        </div>

                      </div> <!-- /.card-content -->

                    </div> <!-- /#lead-processor-info -->
                  </div>


                  <div class="row section-row">

                    <div class="col-sm-6">
                      <div id="additional-info" class="collapsible-card card bordered-card color-blue">
                        <div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#collapse-additional-info">
                          <div class="col">
                            <h4>Additional Information</h4>
                          </div>
                          <div>
                            <span class="toggle-card-btn bg-blue-50">
                              <i class="icon-crm-angle-up"></i>
                            </span>
                          </div>
                        </div>
                        <div id="collapse-additional-info" class="card-content collapse in">
                          <div class="table-structure-info">
                            <table class="height-equalizer" data-equalizer="table2">
                              <tr>
                                <th nowrap>Business Type</th>
                                <td><?=$record_data['__48']?></td>
                              </tr>
                                <tr>
                                  <th nowrap>Year Established</th>
                                  <td><?=$record_data['__49']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Estimated Sales</th>
                                  <td><?=$record_data['__80']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Reported Sales</th>
                                  <td><?=$record_data['__82']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>No. of Employees</th>
                                  <td><?=$record_data['__76']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Primary NAICS <br/> Description</th>
                                  <td><?=$record_data['__77']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Primary SIC Code</th>
                                  <td><?=$record_data['__78']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Export Indicator</th>
                                  <td><?=$record_data['__81']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Export Country</th>
                                  <td><?=$record_data['__79']?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Sales Tax Registration <br/> GST (CAN)</th>
                                  <td><?php if(!empty((array)$record_data['__17'])) { echo implode(', </br> ',(array)$record_data['__17']); } ?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Sales Tax Status</th>
                                  <td><?php if(!empty((array)$record_data['__18'])) { echo implode(', </br> ',(array)$record_data['__18']); } ?></td>
                                </tr>
                                <tr>
                                  <th nowrap>Service Type</th>
                                  <td><?php if(!empty((array)$record_data['__9'])) { echo implode(', </br> ',(array)$record_data['__9']); } ?></td>
                                </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div id="affiliate-company" class="collapsible-card card bordered-card color-pink">
                        <div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#collapse-affiliate-company">
                          <div class="col">
                            <h4>Parent/Affiliate Company Information</h4>
                          </div>
                          <div>
                            <span class="toggle-card-btn bg-pink-50">
                              <i class="icon-crm-angle-up"></i>
                            </span>
                          </div>
                        </div>
                        <div id="collapse-affiliate-company" class="card-content collapse in">
                          <div class="table-structure-info">
                            <table class="height-equalizer" data-equalizer="table2">
                              <tr>
                                <th nowrap>Company Name</th>
                                <td><?=$record_data['__41']?></td>
                              </tr>
                              <tr>
                                <th nowrap>Address Line 1</th>
                                <td><?=$record_data['__43']?></td>
                              </tr>
                              <tr>
                                <th nowrap>City</th>
                                <td><?=$record_data['__45']?></td>
                              </tr>
                              <tr>
                                <th nowrap>Province</th>
                                <td><?=$record_data['__44']?></td>
                              </tr>
                              <tr>
                                <th nowrap>Country</th>
                                <td><?=$record_data['__46']?></td>
                              </tr>
                              <tr>
                                <th nowrap>Postal Code</th>
                                <td><?=$record_data['__47']?></td>
                              </tr>
                              <tr>
                                <th nowrap>Phone</th>
                                <td><?=(isset($record_data['__186']))?$record_data['__186']:''?></td>
                              </tr>
                              <tr>
                                <th nowrap>Fax</th>
                                <td><?=(isset($record_data['__186']))?$record_data['__187']:''?></td>
                              </tr>
                              <tr>
                                <th nowrap>Website</th>
                                <td><?=(isset($record_data['__186']))?$record_data['__188']:''?></td>
                              </tr>
                              <tr>
                                <th nowrap>Year Established</th>
                                <td><?=(isset($record_data['__186']))?$record_data['__189']:''?></td>
                              </tr>
                              <tr>
                                <th> <span class="invisible">-</span> </th>
                                <td></td>
                              </tr>
                              <tr>
                                <th> <span class="invisible">-</span> </th>
                                <td></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
								
								<?php 
								}
							?>	
							
							<?php
								if ($current_module == CLIENTS_PLURAL_NAME)
								{ 
                   require_once "client_view.php";
								} 								
							?>	
									
							<?php
								if ($current_module == CONTRACTS_PLURAL_NAME)
								{ 
									//echo '<pre>';print_r($record_data); die;
									
									$company_name_key = "__" . CLIENTS_CLIENT_NAME_META_ID;										
									$first_name_key = "__" . CLIENTS_FIRST_NAME_META_ID;
									$last_name_key = "__" . CLIENTS_LAST_NAME_META_ID;
									
									$status_key = "__" . CLIENTS_STATUS_META_ID;
									$phone_key = "__" . CLIENTS_PHONE_NUMBER_META_ID;
									$email_key = "__" . CLIENTS_EMAIL_META_ID;
									
									$first_name = isset($record_data[$first_name_key]) ? $record_data[$first_name_key] : "";
									$last_name = isset($record_data[$last_name_key]) ? $record_data[$last_name_key] : "";
									
									$status = isset($record_data[$status_key]) ? $record_data[$status_key] : "No Status Available";
									$call_status = isset($record_data['__27']) ? $record_data['__27'] : "No Status Available";

									$contract_number = isset($record_data['__165']) ? $record_data['__165'] : "No Contract No. Available";
									$signing_rate = isset($record_data['__164']) ? $record_data['__164'] : "No Singing Rate Available";
									$preferred_number = isset($record_data['__166']) ? $record_data['__166'] : "No Preferred Number Available";
									$visit_location = isset($record_data['__167']) ? $record_data['__167'] : "No Visit Location Available";
									
									$phone = isset($record_data[$phone_key]) ? $record_data[$phone_key] : "No Phone Number Available";
									$email = isset($record_data[$email_key]) ? $record_data[$email_key] : "No Email Available";
									$company_name = isset($record_data[$company_name_key]) ? $record_data[$company_name_key] : "No Company Name Available";
									
									$technical_consultant = (isset($record_data['__169']) && $record_data['__169']) ? $record_data['__169'] : "Not Available";
									$accountant = (isset($record_data['__170']) && $record_data['__170']) ? $record_data['__170'] : "Not Available";
									
									/*if($opener == 2)
										$opener = 'Bernadette Lucanas';
									if($closer == 4)
										$closer = 'Pawel Krzemieniecki';*/
									//$opener = $closer = '';
									//echo $opener;
									
									foreach($users_list as $arr_usr)
									{
										if($arr_usr['id'] == $technical_consultant)
										{
											$technical_consultant = $arr_usr['title'];
										}
										if($arr_usr['id'] == $accountant)
										{
											$accountant = $arr_usr['title'];
										}
									}
								
								?>
						
									<!--<img style="height: 42px; width: 42px;" alt="" src="<?php echo base_url() ?>static/images/boyAvatar.png">-->
								
									<h1 style="color: #000000; margin: 0px; font-size: 2em;margin-bottom:5px;">
										<strong><?php echo @$record_data["__160"]; ?></strong>
										<!--span style="font-size: .7em;"><?php echo " - " . $company_name ?></span-->
									</h1>
									
									<div class="row" style="margin-top:20px;">
				
										<div class="form-group col-lg-6">
											<div class="detail-box11">
											<h5 style="color: #744B00;">
													Contract Owner:<span style="padding-left: 35px;color:#000000;">
													<?php foreach ($users_list as $option_key => $option) 
													{ ?>
															<?php if ($option['id'] == $record_data["__0"]) 
															{ $lead_owner = $option['title']?>
																	<span><?php echo $option['title']; ?></span>
															<?php 
															} ?>
													<?php 
													} ?></span>
											</h5>
											<h5 style="color: #744B00;">Contract Client:<span style="padding-left: 13px;color:#000000;">	<?php foreach ($active_clients_list as $option_key => $option) 
													{ ?>
															<?php if ($option['id'] == $record_data["__161"]) 
															{ ?>
																	<span><?php echo $option['title']; ?></span>
															<?php 
															} ?>
													<?php 
													} ?></span></h5>
											<h5 style="color: #744B00;">Contract Number:<span style="padding-left: 13px;color:#000000;"><?php echo $contract_number ?></span></h5>
											<h5 style="color: #744B00;">Signing Rate:<span style="padding-left: 40px;color:#000000;"><?php echo $signing_rate."%" ?></span></h5>
											<h5 style="color: #744B00;">Preferred Number:<span style="padding-left: 8px;color:#000000;"><?php echo $preferred_number ?></span></h5>
											<h5 style="color: #744B00;">Visit Location:<span style="padding-left: 39px;color:#000000;"><?php echo $visit_location ?></span></h5>
											</div>
										</div>
								
										<div class="form-group col-lg-6">												
												
											<div class="detail-box11">

												<div style="">
												
													<?php if ($current_module == "Leads") { ?>										
														
														 <?php if ($user_role == 3 || $user_role == 4) { ?>
														
													<a href="#modalQualifyNow" id="qualify_now" class="btn btn-success" style="background:#1FB5AD;color: #fff;" data-toggle="modal">Qualify Now</a>
													
													<?php } } ?>

													<?php if(!empty($invoice_data)) {  ?>
													<a href="<?php echo base_url()."modules/invoice"; ?>?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&invoice_id=<?php echo $invoice_data["id"]; ?>" id="view_invoice" class="btn btn-success" style="background:#1FB5AD;color: #fff;">View Invoice</a>
													<?php } else { ?> 
													<a href="<?php echo base_url()."modules/create_invoice"; ?>?cm=<?php echo $current_module; ?>&ac=create_invoice&id=<?php echo $current_record_id; ?>" id="create_invoice" class="btn btn-success" style="background:#1FB5AD;color: #fff;">Create Invoice</a>
													<?php } ?>
													
													<a href="javascript:void(0)" id="send_email" class="btn btn-success" style="background:#1FB5AD;color: #fff;" data-email="<?php echo @$record_data['__4'] ?>">SEND EMAIL</a>
													
													<!--a href="<?php echo base_url() ?>booking/bookNow/?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $recordStatus; ?>" id="book_now" class="btn btn-success" style="background:#1FB5AD;color: #fff;">Book Now</a-->

													<a class="module_head btn btn-success" data-toggle="modal" href="#modalOwnerUpdate" style="background:#1FB5AD;color: #fff;">View Notes</a>

													<div style="text-align:left;margin:30px 0px;font-size:12pt;">
														<span style="color:#000000;font-weight:bold;">Contract Stage:</span> <?php echo @$record_data['__162'] ?><br />
														<span style="color:#000000;font-weight:bold;display:none;"># Dial Attempts:</span>
													</div>
													
													<div style="font-weight:normal;font-size:11pt;">
														<span style="color:#0098E3;font-weight:bold;">Technical Consultant:</span> <?=$technical_consultant?><br /><span style="color:#0098E3;font-weight:bold;">Accountant :</span> <?=$accountant?>
													</div>			

												</div>

											</div>
			
										</div>                                                
											
									</div>
									
									<div class="clearfix"></div>
									
									<div class="row">
										
										<div class="col-lg-6">
											
											
											<div class="detail-box11">
												
											<span class="heading1">Contract Information</span>
											
												<strong>Contract Client:</strong> <span style="color:#000000;">
													<?php foreach ($active_clients_list as $option_key => $option) 
													{ ?>
															<?php if ($option['id'] == $record_data["__161"]) 
															{ ?>
																	<span><?php echo $option['title']; ?></span>
															<?php 
															} ?>
													<?php 
													} ?></span><br />

												<strong>Contract Stage:</strong> <span style="color:#000000;"><?=$record_data['__162']?></span><br />
											
													<strong>Service Type:</strong> <span style="color:#000000;"><?php if(!empty((array)$record_data['__163'])) { echo implode(', </br> ',(array)$record_data['__163']); } ?></span>
												
												<strong>Title:</strong> <span style="color:#000000;"><?= @$record_data['__83']?></span><br />
												
												<strong>Function:</strong> <span style="color:#000000;"><?= @$record_data['__89']?></span><br />
												
												<strong>Direct Number:</strong> <span style="color:#000000;"><?= @$record_data['__100']?></span><br />
												
												<strong>Direct Number Extension:</strong> <span style="color:#000000;"><?=@$record_data['__96']?></span><br />
												
												<strong>Alternate Phone:</strong> <span style="color:#000000;"><?= @$record_data['__103']?></span><br />
												
												<strong>Email:</strong> <span style="color:#000000;"><?= @$record_data['__85']?></span>
												
											</div>
											
										</div>
									
										<div class="col-lg-6">
											
											<div class="detail-box11" style="min-height: 338px;">
												
												<span class="heading1">Contract Processor Information</span>
												<div class="col-lg-12" style="min-height:130px;">
													
													<strong>Technical Consultant:</strong> <span style="color:#000000;"><?=$technical_consultant?></span><br />
													
													<strong>Technical Consultant Status:</strong> <span style="color:#000000;"><?= @$record_data['__171']?></span><br />
																							
													<strong>Accountant:</strong> <span style="color:#000000;"><?=$accountant?></span><br />
													
													<strong>Accountant Status:</strong> <span style="color:#000000;"><?= @$record_data['__172']?></span><br />
													
													<strong>Admin Status:</strong> <span style="color:#000000;"><?= @$record_data['__173']?></span><br />

													<strong>Accountants Expected Start Date:</strong> <span style="color:#000000;"><?= @date("j-F-Y", strtotime($record_data['__174']))?></span><br />

													<strong>Technical Expected Start Date:</strong> <span style="color:#000000;"><?= @date("j-F-Y", strtotime($record_data['__175']))?></span><br />

													<strong>Accountants Actual Start Date:</strong> <span style="color:#000000;"><?= @date("j-F-Y", strtotime($record_data['__176']))?></span><br />

													<strong>Technical Actual Start Date:</strong> <span style="color:#000000;"><?= @date("j-F-Y", strtotime($record_data['__177']))?></span><br />											
												
												</div>					
													
											</div>
											
										</div>
									
									
									</div>
									
									<div class="clearfix"></div>
									
									<div class="row" style="margin-top:10px;">
										<div class="col-lg-6">

											<div class="detail-box11">
                        <span class="heading1">Description Information</span>										
										    <strong>Final Invoice Number:</strong> <span style="color:#000000;"><?=(isset($record_data['__178']))? "#".$record_data['__178']:''?></span><br />
												<strong>Invoice Date:</strong> <span style="color:#000000;"><?=(isset($record_data['__179']))? date("j-F-Y", strtotime($record_data['__179'])):''?></span><br />
												<strong>Invoice Paid CAD:</strong> <span style="color:#000000;"><?=(isset($record_data['__180']))?$record_data['__182']:''?></span><br />
												<strong>Total Recovery Amount CAD:</strong> <span style="color:#000000;"><?=(isset($record_data['__181']))?$record_data['__181']:''?></span><br />
												<strong>Invoiced Amount CAD:</strong> <span style="color:#000000;"><?=(isset($record_data['__182']))?$record_data['__182']:''?></span><br />
												<strong>Description:</strong> <span style="color:#000000;"><?=(isset($record_data['__196']))?$record_data['__196']:''?></span>
											</div>
								
										
										</div>
										
										<div class="col-lg-6">
										
										</div>
									
									</div>
									
									<div class="clearfix"></div>
									
									<div class="row" style="margin-top:10px;">
										
										<div class="col-lg-6">
											
											
										</div>
										
										<div class="col-lg-6">
									
										</div>
									</div>  
								
									<div class="clearfix"></div>
									
									
								<?php 								
								} 								
							?>	
									
							</form>
							
							<!-- Modal -->
							<div class="modal fade" id="modalOwnerUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
											<div class="modal-content">
													<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title"><strong>Notes</strong></h4>
													</div>
													<div class="modal-body">
														<?php if(!empty($qualified)) { ?>
															<?php require_once "qualified.php"; ?>
														<?php } ?>	
															<?php require_once "note.php"; ?>
													</div>
													<div class="modal-footer">
															<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
															<!--button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change owner of');" type="button">Confirm</button-->
													</div>
											</div>
									</div>
							</div>
							<!-- modal -->   
							
							<!-- Modal -->
							<div class="modal fade" id="modalQualifyNow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog" style="width: 800px;">
											<div class="modal-content">
												<form id="frmQualify" role="form" action="<?php echo base_url()."modules/qualify_now"; ?>?cm=<?php echo $current_module; ?>&ac=qualify_now&id=<?php echo $current_record_id; ?>" method="post">
												
													<div class="modal-header">
														
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title"><strong>Qualify Now: Survey - USA Campaign</strong></h4>
															
													</div>
													<div class="modal-body">
														<?php if(!empty($qualified)) { ?>
														<?php //require_once "qualified.php"; ?>	
														<?php } 
														else
														{ ?>	
														<?php require_once "qualify_now.php"; ?>
														<?php } ?>
															
													</div>
													<!--div class="modal-footer" style="text-align: center;"> -->
													<?php if(empty($qualified)) { ?>
														
														<!-- <button class="btn btn-success btnNext" type="button">Next</button>
														
														<button class="btn btn-success btnSubmit" type="submit" style="display:none;">Submit</button>
														
														 button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button--->
														
													<?php } ?>	
															
													<!-- </div-->
												 </form>
											</div>
									</div>
							</div>
							<!-- modal -->   
							 
							
						<?php
						}
						?>
			
					</div>
		
				</section>
				
				<?php if (!isset($deletedRecord) || $deletedRecord != true) { ?>
						
						<?php // require_once "attachment.php"; ?>
						<?php //require_once "activities.php"; ?>
						<?php // require_once "new_activities.php"; ?>
						
						<?php if ($current_module == 'Clients') { ?>
								<?php require_once "contract.php"; ?>
						<?php } ?>
						
						<?php //require_once "bookings.php"; ?>
						
				<?php } ?>
					
			</div>
	
		</div>
		
	</section>
	
</section>


<!-- upload document popup-form -->



<div id="upload-document-popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Attachment</h4>
      </div>
      <form role="form" action="?cm=<?php echo $current_module; ?>&ac=attachment&id=<?php echo $current_record_id; ?>" enctype="multipart/form-data" method="post">

        <div class="modal-body" style="margin-top:30px; padding:0 50px;">

            <input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>"/>
            <div class="form-group" style="margin-bottom:25px;">
                <div class="file_uploader">
                    <input id="record_attachment" type="file" name="record_attachment" class="default" />
                    <span class="value"></span>
                    <span class="default">
                        <i class="fa fa-upload"></i>
                        <span class="choose">Choose a file</span> or Drag and drop
                    </span>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:25px;">
                <label for="file_name">Enter the file name *</label>
                <input name="file_name" type="text" class="form-control" required="required" id="file_name" placeholder="Enter the name of the file" style="background:#f5f5f5 !important; border:1px solid #ddd !important; padding:0 9px !important;">
            </div>
        </div>

        <div class="modal-footer" style="text-align:left">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-fill-blue pull-right">Upload attachment</button>
        </div>

      </form>
    </div>

  </div>
</div>




<!-- booking add popup start -->
<div id="addClassSchedule" class="modal fade new-layout" data-backdrop="static" data-keyboard="false">	
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<form id="frmAddBooking" name="frmAddBooking" method="post" action="<?php echo base_url('booking/bookNow');?>">	
			<input type="hidden" name="booking_id" id="booking_id">			
			<input type="hidden" name="google_event_id" id="google_event_id">			
			<input type="hidden" name="title" id="title_id">			
			<input type="hidden" name="previous_invitee" id="previous_invitee">
      <input type="hidden" name="current_module" value="<?php echo $current_module; ?>">
      
			<input type="hidden" name="record_id" id="record_id">
			<div class="modal-header">
				<div class="title">
					<h4 id="classScheduleTitle" class="modal-title">Add Booking</h4>
				</div>
				<div class="icons-plot">

					<button type="button" class="icon add_schedule_timing" disabled>
						<i class="fas fa-check"></i>
						<span class="hover-title" style="width:90px; margin-left:-17px;">Book Now </span>
					</button>

					<span class="icon close-modal" data-dismiss="modal">
						<i class="fas fa-times"></i>
						<span class="hover-title">Close </span>
					</span>
				</div>
			</div>
			
			<div id="classScheduleBody" class="modal-body">

				<div class="row flex-row">
					<div class="col-sm-8 col-xs-12">
						<div class="tab-title">
							<span>Booking Information</span>
						</div>
						<div class="form-group">
							<label class="control-label" for="textfield">Booking Title</label>
							<input type="text" class="input-xlarge form-control" name="booking_title" id="booking_title" placeholder="Enter title">
						</div>
						<div class="row event-day-time" style="margin-top:20px;">
							<div class="col-sm-3 col-xs-6" style="padding-right:0">
								<label class="control-label" for="textfield">Start Date: *</label>
								<input class="input-xlarge form-control datepicker" name="start_date" id="start_date2"  type="text" placeholder="MM/DD/YYYY" required="" value="" required autocomplete="off">
							</div>
							<div class="col-sm-3 col-xs-6 all_dv">
								<label class="control-label" for="textfield">Start Time: *</label>
								<input class="input-xlarge form-control" name="start_time" id="start_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">
							</div>
							<div class="col-sm-3 col-xs-6" style="padding-right:0">
								<span class="txt-to"> to </span>
								<label class="control-label" for="textfield">End Date:</label>
								<input class="input-xlarge form-control datepicker" name="end_date" id="end_date"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off">
							</div>
							<div class="col-sm-3 col-xs-6 all_dv">
								<label class="control-label" for="textfield">End Time:</label>
								<input class="input-xlarge form-control timepicker" name="end_time" id="end_time" value="" type="text" placeholder="HH:MM" autocomplete="off">
							</div>
						</div>
						<div class="event-day-time">
							<label class="control-label event-recurrence" style="width:90px;">
								<input class="form-control checkbox" name="all_day" id="all_day" value="1"  type="checkbox" style="width:17px; position:absolute; visibility:hidden;">
								<span class="input-checkbox-icon"></span>
								<span style="line-height:0;">All Day</span>
							</label>
							<span class="booking_availability">
								<a href="javascript:" class="check_booking">Check Availability</a>
							</span>
							 <span class="booking_availability fade" style="padding:2px 7px;">
							  <span class="booking-alert"></span>
							</span>  
							<div style="display: none;">
								<label class="control-label" for="textfield" style="margin-top:20px;">Visibility</label>
								<select name="visibility" id="visibility" class="inline-select">
									<option value="public">Public</option>
									<option value="private">Private</option>
								</select>
							</div>
						</div>
					</div>

					<div class="col-sm-4 col-xs-12" style="border-left:1px solid #ccc;">					
						<div class="tab-title" style="margin-bottom:15px;">
							<span>Lead Information</span>
						</div>
						<div>
							<strong style="color:#16514e;" id="booking-name"> </strong>
							<input class="input-xlarge form-control" name="lead_name" id="lead_name"  type="text" placeholder="Lead Name" required="" value="" required autocomplete="off">
						</div>
						<div>
							<strong style="color:#16514e;">Lead Title : </strong>
							<input class="input-xlarge form-control" name="lead_title" id="lead_title"  type="text" placeholder="Lead Title" value="" autocomplete="off">
						</div>
						<div>
							<strong style="color:#16514e;">Email :</strong>
							<input class="input-xlarge form-control" name="email" id="email"  type="email" placeholder="Enter Email" required="" value="" required autocomplete="off">
						</div>
					</div>
				</div>

				<div class="row">
						
						<div class="col-sm-6 col-xs-12" >
							<!-- <div class="row">
								<div class="col-sm-12 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="textfield">Company Name: *</label>
										<div class="controls">
											<input class="input-xlarge form-control" name="company_name" id="company_name"  type="text" placeholder="Choose company name" required="" value="" required>
										</div> 
									</div>
								</div>
							</div> -->	
							<!-- <div class="row">
								
								<div class="col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="textfield">Start Date: *</label>
										<div class="controls">
											<input class="input-xlarge form-control datepicker" name="start_date" id="start_date2"  type="text" placeholder="MM/DD/YYYY" required="" value="" required autocomplete="off">
										</div> 
									</div>
								</div>
								
								<div class="col-sm-6 col-xs-12 start_time_dv">
									<div class="form-group">
										<label class="control-label" for="textfield">Start Time: *</label>
										<div class="controls">
											<input class="input-xlarge form-control timepicker" name="start_time" id="start_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">
										</div>
									</div>
								</div>
								
							</div>
							<div class="row">
								
								<div class="col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="textfield">End Date: </label>
										<div class="controls">
											<input class="input-xlarge form-control datepicker" name="end_date" id="end_date"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off">
										</div> 
									</div>
								</div>
								
								<div class="col-sm-6 col-xs-12 start_time_dv">
									<div class="form-group">
										<label class="control-label" for="textfield">End Time: </label>
										<div class="controls">
											<input class="input-xlarge form-control timepicker" name="end_time" id="end_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">
										</div>
									</div>
								</div>
								
							</div> -->
							<div class="row">
								<!-- <div class="col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="textfield">Repeat</label>
										<div class="controls">
											<select class="form-control" name="repeat" id="repeat">
												<option value="NO">Does not repeat</option>
												<option value="DAILY">Daily</option>
												<option value="WEEKLY">Weekly</option>
												<option value="MONTHLY">Monthly</option>
												<option value="ANNUALLY">Annually</option>									
											</select>
											
										</div> 							
									</div>
								</div> -->
								
							</div>
							
							<div class="row">
								
								<!-- <div class="col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="textfield">Availability</label>
										<div class="controls">
											<select class="form-control" name="availability" id="availability">
												<option value="free">Free</option>
												<option value="busy">Busy</option>									
											</select>
										</div> 							
									</div>
								</div> -->
								
								<!-- <div class="col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="textfield">Visibility</label>
										<div class="controls">
											<select class="form-control" name="visibility" id="visibility">
												<option value="public">Public</option>
												<option value="private">Private</option>									
											</select>								
										</div> 							
									</div>
								</div> -->
							</div>	
								
							<!-- < div class="row">	
								
								 <div class="col-sm-6 col-xs-12" style="display: none;">
									<div class="form-group">
										<label class="control-label" for="textfield">Color</label>
										<div class="controls">
											<select class="form-control" name="color" id="color">
												<option value="#F6BF26" style="background: #F6BF26;color: #fff;">Banana</option>									
												<option value="#D50000" style="background: #D50000;color: #fff;">Tomato</option>
												<option value="#E67C73" style="background: #E67C73;color: #fff;">Flamingo</option>								
												<option value="#F4511E" style="background: #F4511E;color: #fff;">Tangerine</option>							
												
												<option value="#33B679" style="background: #33B679;color: #fff;">Sage</option>									
												<option value="#0B8043" style="background: #0B8043;color: #fff;">Basil</option>									
												<option value="#039BE5" style="background: #039BE5;color: #fff;">Peacock</option>		
												<option value="#3F51B5" style="background: #3F51B5;color: #fff;">Blueberry</option>		
												<option value="#7986CB" style="background: #7986CB;color: #fff;">Lavender</option>		
												<option value="#8E24AA" style="background: #8E24AA;color: #fff;">Grape</option>		
												<option value="#616161" style="background: #616161;color: #fff;">Graphite</option>					
											</select>								
										</div> 							
									</div>
								</div> 
								 <div class="col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label" for="textfield">All Day</label>
										<div class="controls">
											<input class="form-control checkbox" name="all_day" id="all_day" value="1"  type="checkbox" style="width: 25px;margin: 0;padding: 0;">
										</div> 							
									</div>
								</div> 
							</div> -->
						
						</div>	
					
						<div class="col-sm-6 col-xs-12" style="border-left: 1px solid #ccc; display:none;">	
							
							<div class="row">					
								<div class="col-sm-11 col-xs-12"> 
									<div class="form-group">
										<label class="control-label" for="textfield">Invite company contacts and guests:</label>
										
										<div class="invite_dv">
				
										</div>
										 
									</div>
								</div>								
							</div>					
							
							<div class="row">
									<div class="col-sm-12 col-xs-12">
									<div class="form-group">
										<a class="add_invite" title="Add More" href="javascript:;" style="text-transform:uppercase;">Add Guests</a>			
									</div>
								</div>					
							</div>	
						
							 <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;display: none;">					
								<div class="col-sm-12 col-xs-12"> 
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
								<div class="col-sm-12 col-xs-12"> 
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
							
						</div>	
				
				</div>
				
				<!-- <hr>	 
				<div class="notify">
				
				</div>
				
				<div class="row">
						<div class="col-sm-3 col-xs-12">
						<div class="form-group">
								<a  class="add_reminder" title="Add Notification" href="javascript:;" style="text-transform:uppercase;">Add Reminder</a>			
						</div>
					</div>					
				</div>	
	
				<hr> -->	
								

				<div class="tab-title" style="margin:35px 0 15px;"> <span> Notes & Attachment</span> </div>
				<div class="row">
					<div class="col-sm-8 col-xs-12">
						<label class="control-label" for="textfield" style="text-transform:uppercase;">Notes</label>
						<textarea name="notes" id="notes2" rows="4" cols="106"></textarea>
					</div>
					<div class="col-sm-4 col-xs-12">
						<label class="control-label" for="textfield" style="text-transform:uppercase;">Attachment</label>
						<div class="file_uploader">
							<input type="file" name="file" id="file">
							<span class="value"></span>
							<span class="default">
								<i class="fa fa-upload" style="display:block; font-size:40px; margin:20px 0;"></i>
								<span class="choose">Choose a file</span> or Drag and drop
							</span>
						</div>
					</div>
				</div>
	
				<div class="row">
						<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						</div>
					</div>					
				</div>
				<div class="row">
						<div class="col-sm-12 col-xs-12">
						<div class="form-group">
							<div class="controls">
							</div> 								
						</div>
					</div>					
				</div>	
	
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-normal" data-dismiss="modal" title="Close modal">Close</button>
				<button type="button" class="btn btn-success add_schedule_timing" disabled>Book Now</button>
				<img src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" class="ajax-load">
			</div>
			
		</form>	
		</div>
	</div>
</div>
<!-- booking add popup end -->
<script type="text/javascript">
	var base_url = '<?php echo base_url();?>';
	$('input[type=radio][name=selling_goods_to_canada]').change(function() {
    if (this.value == 'yes') {
			$(this).parent().parent().next('.btnNext').show();
			$(this).parent().parent().next('.btnSubmit').hide();
      $('.btnSubmit').hide();
      $('.btnNext').show();      
    }
    else if (this.value == 'no') {
			$(this).parent().parent().next('.btnNext').hide();
			$(this).parent().parent().next('.btnSubmit').show();
      $('.btnSubmit').show();
      $('.btnNext').hide();      
    }
	});

	$('input[type=radio][name=tax_consultant_conduct]').change(function() {
    if (this.value == 'yes') {
			$('.recoveries').show();      
    }
    else if (this.value == 'no') {
			$('.recoveries').hide();      
    }
	});

	$('input[type=radio][name=government_audit]').change(function() {
    if (this.value == 'yes') {
			$('.areas').show();      
    }
    else if (this.value == 'no') {
			$('.areas').hide();      
    }
	});

	$('input[type=radio][name=operation_in_canada]').change(function() {
    if (this.value == 'yes') {
			$('.operations').show();      
    }
    else if (this.value == 'no') {
			$('.operations').hide();      
    }
	});

	
	$('.btnNext').on('click',function(){

		console.log("attr "+$(this).attr('data-id'));
		if($(this).attr('data-id')=="q2")
		{
			var val = $('input[type=radio][name=annual_sales_to_canada]:checked').val();
			console.log("val "+val);
			if(val=="other")
			{
				var tval = $('input[type=text][name=annual_sales_to_canada_other_amount]').val();
				console.log("tval "+tval);
				if(tval=="")
				{
					alert("Enter the other amount!");
					return false;
				}
			}
		}
		
		console.log("attr "+$(this).attr('data-id'));
		if($(this).attr('data-id')=="q7")
		{
			var val = $('input[type=radio][name=sales_tax_return_filed_from]:checked').val();
			console.log("val "+val);
			if(val=="other")
			{
				var tval = $('input[type=text][name=sales_tax_return_filed_from_other]').val();
				console.log("tval "+tval);
				if(tval=="")
				{
					alert("Enter the other source!");
					return false;
				}
			}
		}
		
		$(this).parent().next('.form-group').show();
		$(this).parent().hide();		
	});
	
	$('.btnPrevious').on('click',function(){
		$(this).parent().prev('.form-group').show();
		$(this).parent().hide();		
	});

	
	$('.btnSubmit2').on('click',function(e){

		var val = $('input[type=radio][name=operation_in_canada]:checked').val();
		if(val=="yes")
		{
			e.preventDefault();
			var tval = $('input[type=text][name=operation_in_canada_type]').val();
			console.log("tval "+tval);
			if(tval=="")
			{
				alert("Enter the operation type!");
				return false;
			}
			else
			{
				$("#frmQualify").submit();
			}	
		}
		
	});

	

	

	
	function deleteRecord(){
			window.location.href = "<?php echo base_url() ?>modules/viewRecord/?cm=<?php echo $current_module; ?>&ac=del&id=<?php echo $current_record_id; ?>&mtd=2";
	}
	function archiveRecord(){
			window.location.href = "<?php echo base_url() ?>modules/viewRecord/?cm=<?php echo $current_module; ?>&ac=del&id=<?php echo $current_record_id; ?>&mtd=1";
	}
	function convertRecord(){
			window.location.href = "<?php echo base_url() ?>modules/viewRecord/?cm=<?php echo $current_module; ?>&ac=convert&id=<?php echo $current_record_id; ?>";

	}

	function sectionToggle(i){
			$("#" + i).slideToggle();
			var elem = $("#carot_" + i);
			if (elem.hasClass('fa-plus-square')) {
					elem.removeClass('fa-plus-square');
					elem.addClass('fa-minus-square');
			} else {
					elem.removeClass('fa-minus-square');
					elem.addClass('fa-plus-square');
			}
	}
	function showContactPersonDetail(idx)
	{
	$('#contact_person_'+idx).slideToggle();
			var elem = $("#ccarot_" + idx);
			if (elem.hasClass('fa-plus-square')) {
					elem.removeClass('fa-plus-square');
					elem.addClass('fa-minus-square');
			} else {
					elem.removeClass('fa-minus-square');
					elem.addClass('fa-plus-square');
			}		
	}
	
	$('#send_email').click(function()
	{
		console.log('clicked');
		var email = $(this).attr('data-email');
		
		var url = '<?php echo base_url() ?>reports/sendMail?action=compose&email='+email;
		sendEmailWindow = window.open(url, 'Send Email', "width=1000,height=600");
			
		//if(email!='')
		//{
			//var url = '<?php echo base_url() ?>modules/sendMail?action=compose&email='+email;
			//window.open(url, 'Send Email', "width=1000,height=600");
		//}
		//else
		//{
			//alert('No email specified for this user!');
		//}
	});

	function closeme()
	{
		sendEmailWindow.close();
	}

	CKEDITOR.replace('notes2',{
				height: '150px',
		        contentsCss : 'body{background:#f1f3f4;font-family:sans-serif, Arial, Verdana, "Trebuchet MS"; font-size:12px;}',
				});
	
	$(".datepicker,#datepicker2").datepicker();
	$("#addClassSchedule .timepicker").timepicker({
	    timeFormat: 'h:mm a',
	    interval: 60,
    });
	/* book now */
    $("#book_now").click(function(){
      var current_module = $("#current_module").val();
      if(current_module == "Leads"){
        $("#lead_name").val("<?php echo isset($record_data['__1']) ? $record_data['__1']:''; ?><?php echo " "; echo isset($record_data['__2']) ? $record_data['__2']:''; ?>").attr('readonly', true).addClass('input-disabled');
        $("#lead_title").val("<?php echo isset($record_data['__3']) ? $record_data['__3']:''; ?>").attr('readonly', true).addClass('input-disabled');
        $("#email").val("<?php echo isset($record_data['__4']) ? $record_data['__4'] :''; ?>");
        $("#addClassSchedule #record_id").val("<?php echo isset($current_record_id) ? $current_record_id :''; ?>");
        $("#booking-name").text("Lead name :");
     }else if(current_module == "Clients"){
        $("#lead_name").val("<?php echo isset($record_data['__184']) ? $record_data['__184']:''; ?><?php echo " "; echo isset($record_data['__183']) ? $record_data['__183']:''; ?>").attr('readonly', true).addClass('input-disabled');
        $("#lead_title").val("<?php echo isset($record_data['__83']) ? $record_data['__83']:''; ?>").attr('readonly', true).addClass('input-disabled');
        $("#email").val("<?php echo isset($record_data['__85']) ? $record_data['__85'] :''; ?>");
        $("#addClassSchedule #record_id").val("<?php echo isset($current_record_id) ? $current_record_id :''; ?>");
        $("#booking-name").text("Client name :");
     }
    });

    var form = $( "#frmAddBooking" );
    form.validate({
        invalidHandler: function(form, validator) {
          var errors = validator.numberOfInvalids();
          if (errors) {
                $("#dialog").animate({ scrollTop: 0 }, "fast");
          }
      }
    });	
    /* Add Event */
  $( ".add_schedule_timing" ).click(function() {
     if(form.valid())
      {
       $('#addClassSchedule .ajax-load').show();
       $("#notes2").val(CKEDITOR.instances.notes2.getData());
       $('#frmAddBooking').ajaxSubmit({
                  dataType: 'json',
                  success: function (data) {
                  	  $('#addClassSchedule').modal("hide");
                  	 
                      if (typeof data != 'undefined' && typeof data.message != 'undefined' && data.message != 'undefined' && data.success == true) {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-success alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Success! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                          $('#frmAddBooking')[0].reset();
                          $('#addClassSchedule .ajax-load').hide();
                          location.reload();

                      }else if(typeof data != 'undefined'  && data.success != 'undefined' && data.success == false)
                      {
                        var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                          $('#frmAddBooking')[0].reset();
                          $('#addClassSchedule .ajax-load').hide();
                          location.reload();
                      }                        
                     
                  },
                  error: function(data){
                  	
                  	$('#addClassSchedule').modal("hide");
                    if (typeof data != 'undefined') {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>There are some problems to perform this action.</div></div>';
                          $('.flash-message').html(html);
                          $('#frmAddBooking')[0].reset();
                          $('#addClassSchedule .ajax-load').hide();
                         } 
                   }  
              });
      }
    });
   /* check availability */
  $(".check_booking").click(function(){
    var record_id = $("#frmAddBooking #record_id").val();
    var start_date = $("#frmAddBooking #start_date2").val();
    var start_time = $("#frmAddBooking #start_time").val();
    var email = $("#frmAddBooking #email").val();
    if($("#frmAddBooking #all_day").prop("checked") == true)
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
             $("#addClassSchedule .add_schedule_timing").prop("disabled", true);
             $(".booking-alert").text(data.status);
             $(".booking-alert").parent().addClass('alert-danger in');
             $(".booking-alert").parent().removeClass('alert-success');
             return false;  
            }else{
             $("#addClassSchedule .add_schedule_timing").removeAttr("disabled");
             $(".booking-alert").text(data.status);
             $(".booking-alert").parent().addClass('alert-success in');
              $(".booking-alert").parent().removeClass('alert-danger'); 
            }
            }
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
             $("#addClassSchedule .add_schedule_timing").prop("disabled", true);
             $(".booking-alert").text(data.status);
             $(".booking-alert").parent().addClass('alert-danger in');
             $(".booking-alert").parent().removeClass('alert-success');
             return false;  
            }else{
             $("#addClassSchedule .add_schedule_timing").removeAttr("disabled");
             $(".booking-alert").text(data.status);
             $(".booking-alert").parent().addClass('alert-success in');
              $(".booking-alert").parent().removeClass('alert-danger'); 
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
  $("#addClassSchedule #start_time").timepicker({
    timeFormat: 'h:mm a',
    interval: 60,
    change:availCheck
  })
  $("#start_date2,#all_day").on("change keyup",function(){
    availCheck();
  });
  function availCheck(){
    $('.booking-alert').text('');
    $('.booking_availability').removeClass('in');
    $("#addClassSchedule .add_schedule_timing").prop("disabled", true);
  }
</script>



<script type="text/javascript">
    $(document).ready(function(){         
        $('.file_uploader input[type="file"]').click(function(e){
          $('.file_uploader .value').text('');
        });
        $('.file_uploader input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.file_uploader .value').text(fileName);
        });
    	
    	$('input[name="all_day"]').click(function(){
			if($(this).prop("checked") == true){
				$('.all_dv').hide();
			}
			else if($(this).prop("checked") == false){
				$('.all_dv').show();
			}
		});

      $('.toggable-header').click(function(){
        $(this).find('.toggle-card-btn i').toggleClass('icon-crm-angle-down icon-crm-angle-up');
      });

    });
</script>
<?php 
function dateDiff($date1, $date2) 
  {
    $date1_ts = strtotime($date1);
    $date2_ts = strtotime($date2);
    $diff = $date2_ts - $date1_ts;
    return round($diff / 86400);
  }
?>

<script type="text/javascript">
  
  $(document).ready(function(){

      $(".height-equalizer").each(function(){
        var maxHeight = 0;
        var equalizer = $(this).attr('data-equalizer');
         if ($('[data-equalizer="'+equalizer+'"]').height() > maxHeight) { maxHeight = $('[data-equalizer="'+equalizer+'"]').height(); }

        $('[data-equalizer="'+equalizer+'"]').height(maxHeight);
      });

      $("[data-smooth-scroll]").click(function() {
        var scroll_target = $(this).attr('data-smooth-scroll');
        var scroll_speed = $(this).attr('data-time');
          $('html, body').animate({
              scrollTop: $(scroll_target).offset().top - 140
          }, 500);
      });

  });


</script>