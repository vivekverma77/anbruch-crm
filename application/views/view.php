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

.btn-yellow-o {color:#ff9800; border:1px solid #ff9800; background:#fff8e1;}
.btn-yellow-o:hover {color:#fff; background:#ff9800;}

.btn-blue-o {color:#03a9f4; border:1px solid #03a9f4; background:#e4f2fe;}
.btn-blue-o:hover {color:#fff; background:#03a9f4;}

.btn-fill-theme {background:#1fb5ad;}
.btn-fill-blue {background:#03a9f4;}

.btn[class*="btn-fill-"] {color:#fff;}
.btn[class*="btn-fill-"]:hover {box-shadow:0px 2px 5px 0px rgba(0, 0, 0, 0.36);}

/*.card {box-shadow:0px 2px 5px 0px rgba(0, 0, 0, 0.36); padding:15px;}*/
.card {box-shadow:0px 2px 5px 0px rgba(0, 0, 0, 0.36); padding:9px;}
.card:not([class*="bg"]) {background:#fff;}
.collapsible-card {padding-bottom:1px;}
.collapsible-card .card-header {margin-bottom:14px;}

.bordered-card {border-left:3px solid;}
.card-header {border-bottom:3px solid #dde5e9;}
.card-title {margin:0;}
.card-title:first-letter {text-transform:uppercase;}
.flex-row .col {flex-grow:1;}
.card-content {color:#455a64;}
.card-content.have-tabs {position:relative; top:-13px;}
.nav.card-tabs {border:0; margin:0 5px 10px;}
.nav.card-tabs li {margin:-1px;}
.nav.card-tabs li a {padding:6px 15px; border-radius:0 0 11px 11px; border:1px solid #673ab7 !important; border-top:0 !important; border-top:0 !important;}
.nav.card-tabs li.active a, .nav.card-tabs li.active a:focus, .nav.card-tabs li.active a:hover {background-color:#ede7f6;}
.nav.card-tabs li.active {z-index:2;}
.nav.card-tabs li:hover {z-index:3;}



.card-content ul {padding:0; /*margin:0;*/}
.card-content li {list-style:none; font-size:14px;}
.toggle-card-btn {margin-top:8px; display:inline-block; border-radius:25px; font-size:20px; width:20px; height:20px; text-align:center; line-height:20px; cursor:pointer;}
.toggle-card-btn i {position:relative; left:-4px;}
.card-header .collapsed .icon-crm-angle-up:before {content:'\f107';}
.card-header .collapsed .icon-crm-angle-down:before {content:'\f106';}

.table-structure-info table {width:100%; margin-bottom:25px;}
.table-structure-info tr {background:#eceff1; border:solid #dfe4e7; border-width:1px 0;}
.table-structure-info tr:nth-child(even) {background:#f2f4f5;}
.table-structure-info td {width:100%; padding:8px 0;}
.table-structure-info th, .table-structure-info td[colspan] {padding:8px 10px;}
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

.section-row {margin-top:70px;}

/*End Global*/

/*.hero-row .card {margin-bottom:30px;}*/
.hero-row .card + .card {margin-top:45px;}
.client-view.hero-row .card + .card, .contract-view.hero-row .card + .card {margin-top:30px;}

#modalQualifyNow .panel {border:0;}
#modalQualifyNow label {font-size:20px;}
#modalQualifyNow .btn-xs {padding:5px 9px;}
#modalQualifyNow .btnNext {float:right;}
#modalQualifyNow .modal-header { background: #1fb5ad; color: white; }
#modalQualifyNow .close { color: white; opacity:1; }

#lead-info {padding:25px 40px;}
.card-footer {text-align:center; margin-top:35px; border-top:3px solid #dde5e9; padding-top:25px;}

#client-info .card-footer {margin-top:69px;}
#contract-info .card-title {margin-bottom:10px;}
#contract-info .card-footer {margin-top:136px;}

.additional-info-accordion .panel {border:0;}
.additional-info-accordion .panel-heading {padding:0;}
.additional-info-accordion .panel-title {padding:0px 15px 0px 15px; cursor:pointer; border:1px solid #ddd;}
.additional-info-accordion .panel-body {padding:15px; background:#e4f2fe; border:1px solid #dde5e9; border-top:0;}
.panel-title.collapsed .fa-plus:before {content:"\f068";}
.additional-info-accordion .panel + .panel {margin-top:10px;}
.additional-info-accordion .panel-title:not(.collapsed), .additional-info-accordion .panel-title:hover {background:#e4f2fe;}

.state-cards {margin-top:20px;}
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
#addClassSchedule .modal-content,#editClassScheduleNew .modal-content {border-radius: 10px !important;}
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
.check_booking {text-transform: uppercase;background-color: #1eb5ad;color: #fff;padding: 5px 4px; border-radius: 4px; font-weight:700;font-size: 12px;}
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

/*.new-layout .form-control {background-color:#f1f3f4 !important; padding-left:10px !important;}*/
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
.intro {background-color: rgb(251, 233, 231) !important;
  border: 1px solid red;}

.repeat{height: 40px !important;margin-bottom: 3px;margin-top: 10px;padding-left: 0px;}
.repeat input{width: 130px;height: 35px;padding: 0px;background-color: #f1f3f4 !important;border: 0px;border-radius: 10%;padding-left: 12px;color: #555 !important;}
.note {margin-top: 10px; width: 158px;margin-left: -29px !important;}
.add-notification{font-weight: 600;background-color: #1fb5ad !important;border: none;/*text-transform: uppercase*/;height: 30px;margin-top: 10px;}
.notification-via{
    cursor: pointer;
    color: #c2c2c2 !important;
    border-radius: 4px !important;
    border: 1px solid #d2dae1;
   /* margin-right: 10px;*/
    background: #f1f3f4 !important;
    border: 0px;
    font-weight: 700 !important;

    width: 77px !important;
}
/*.notification-via :hover{
      background-color: #f5f5f5 !important;
}
*/.get-notify .close{
  margin-top: 35px;
  margin-right: 150px;
  border-radius: 50%;
}
.get-notify .close :hover{
  color: #000;
  text-decoration: none;
  cursor: pointer;  
  opacity: .5;
}

/*Modal style start*/
.close-div {position: relative;z-index: 130;top: 4px;cursor: pointer;width: 40px;height: 40px;float: left;font-size: 25px;}
span.close-modal:before {content: "";width: 18px;height: 2px;position: absolute;background: #5f6368;transform: rotate(45deg);top: 19px;left: 18px;}
span.close-modal:after {content: "";width: 18px;height: 2px;position: absolute;transform: rotate(-45deg);background: #5f6368;top: 19px;left: 18px;}
.event-day-time {margin-left: 1px;}
.save-btn {width: 105px;height: 40px;font-size: 135%;background-color: #1eb5ad;color: white;order: 0px;border-radius: 8%;}
.event-day-time input {width: 110px;margin-right: 8px;display: inline-block;
}
#addClassSchedule .modal-body label{font-weight: 600;color: #16514e;letter-spacing: 0.2px;padding: 4px 0;
}
.event-day-time .input-checkbox-icon {display: inline-block;width: 17px;height: 17px;border: 2px solid #1fb5ad;border-radius: 3px;margin: 6px 6px 0 0;vertical-align: bottom;position: relative;
}
#addClassSchedule .form-control{border: 0;background-color: #f1f3f4;
}
.title {height: 50px;background-color: white !important;font-size: 22px;border-bottom: 1px solid #f1f3f4 !important;
}
.alert-true
{color:#3c763d;
}
.alert-false
{color:#a94442;
}
.get-notify{margin-bottom: 10px;margin-top: 0px;margin-left: 23px;
}
#add-notification-btn{margin-top: 0px;margin-bottom: 15px;margin-left: 12px;
}

.repeat input{
width: 100px !important;
    margin-left: 8px;
    margin-top: 2px;
}
.note select{
  margin-left: 39px;
    margin-top: 19px;
}
.get-notify .close
{
margin-right: 30px;}
#addClassSchedule .file_uploader {border: 2px dashed #1eb5ad;background: #f1f3f4;padding: 6px;position: relative;text-align: center;top: 0px;left: 270px;font-size: 12px;width: 105px;color: #16514e;
}
#cke_notes2{ margin-top:-40px; width: 108%;}
.scrollers{ max-height: 350px;overflow-y: scroll;overflow-x: hidden;margin: -25px -15px 0 0;padding: 25px 15px 0 0;
}
.cke_reset{height:250px !important;
}
#addClassSchedule .ajax-load {float:right; width:80px; margin:-22px -40px -57px -17px; display:none;}

#modalConvert .modal-fields{width:65%; }
#signing_rate_error {font-weight: bold;color:tomato;margin-left: 27%;}

.fc-ltr .fc-basic-view .fc-day-hover .fc-day-number {background:#62CBC6;}

#modalConvert .select2-selection--multiple { border: 1px solid #e2e2e4 !important; line-height: normal;border-radius: 4px;font-size: 13px; }
#modalConvert .row { margin-top: 15px; }
#modalConvert .select2-search__field { width: 240px !important; }
#modalConvert .select2-container { width:240px !important; }
#modal_error {font-weight: bold;color:tomato;}
#modalConvert label { font-weight: 550; padding-top: 5px;  }
#modalOwnerUpdate .modal-header { background: #1fb5ad; color:white; }
#modalOwnerUpdate .close { color: white; opacity: 1; }

#modalQualified .modal-header { background: #1fb5ad; color:white; }
#modalQualified .close { color: white; opacity: 1; }
.hero-row .card + .card{
  margin-top: 26px !important;
}
div#client-info, .col-sm-7 #contract-info{
    padding: 31px 45px !important;
}
#lead-info .lead-status{
    position: absolute;
    margin-left: 388px;
    margin-top: -25px;
}
#lead-info .lead-status img{
    height: 95px;
    width: 125px;
}

.location-div {
    padding-right: 0px !important;
    width: 88%;
}
.location-icon {
    float: right;
    margin-top: -33px;
    margin-right: 1px;
    color: #fff;
    background: #1eb5ad;
    height: 32px;
    width: 32px;
    text-align: center;
    line-height: 36px;
    font-size: 24px;
    cursor: pointer;
    opacity: .8;
}
.fc-scroller{
  overflow-x: scroll;
    overflow-y: scroll !important;
    height: 350px !important;
}

.booking-modal{
  width: 75% !important;
}
.fc-event-container .fc-day-grid-event {box-shadow:0 2px 2px rgba(0,0,0,0.25), 0 1px 0 rgba(0,0,0,0.05); font-size:14px; padding:6px 25px 6px 6px; overflow:hidden; margin-bottom:4px; border-radius:25px;}
.fc-event-container .fc-day-grid-event:focus{color:#fff;}
.fc-event-container .fc-day-grid-event:hover {box-shadow:0 2px 2px rgba(0,0,0,0.5), 0 1px 0 rgba(0,0,0,0.15);}
.fc-event-container .fc-day-grid-event:hover:before {content:''; background:rgba(0, 0, 0, .2); position:absolute; width:100%; height:100%; left:0; top:0;}
.fc-event-container .fc-day-grid-event:not(.fc-not-end):after {content:'\f274'; font-family:"Font Awesome 5 Free"; position:absolute; right:3px; padding:4px; top:0; line-height:22px;}
.fc-event-container .fc-day-grid-event.booking_event:not(.fc-not-end):after {content:'\f02e';}
.fc-view-container {margin-top: 60px !important;}
.fc-icon-right-single-arrow:after, .fc-icon-left-single-arrow:after {content:'\f105'; font-family:fontawesome; font-size:22px; font-weight:normal;}
.fc-icon-left-single-arrow:after {content:'\f104';}
.fc-icon-left-single-arrow {left:-2px;}
.fc-ltr .fc-basic-view .fc-day-top .fc-day-number {float:none; text-align:center; display:table; line-height:36px; margin:5px auto; font-weight:bold; border-radius:25px; width:36px; height:36px; cursor:pointer; background:#f1f3f4; font-size:17px;}
.fc-ltr .fc-basic-view .fc-day-top:not(.fc-today) .fc-day-number:hover {background:#1BAEA6; color:#fff;}
.fc-ltr .fc-basic-view .fc-day-top.fc-today .fc-day-number {background:#1fb5ad; color:#fff;}

.fc .fc-button-group .fc-button {border: 0; border-radius: 4px; color: #fff; transition: 0.2s; text-shadow: none; background: #5a6766 ; text-transform: capitalize; color:#5a6766;}
.fc .fc-button-group .fc-prev-button, .fc .fc-button-group .fc-next-button {border-radius:25px; width:27px; height:27px; background:transparent !important; box-shadow:none;}

.fc .fc-button-group .fc-state-hover {background:#dadce0 !important; transition: 0.4s; color:#666 !important;}
.fc .fc-button-group .fc-corner-right {margin: 0 0 0 10px;}
.fc .fc-button-group .fc-basicWeek-button {padding: 0 15px 2px;}
.fc .fc-button-group .fc-basicDay-button {padding: 0 15px 2px;}

.fc-toolbar.fc-header-toolbar {padding:20px 16px 8px;}

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
.fc-toolbar .fc-center {margin:5px 14px;}
.fc-toolbar h2 {font-size:25px; color:#5a6766;}
.has-toolbar.fc {
    margin-top: 0px !important;
}
.fc-axis{
  width: 39px !important;
}
/*#lead-additional-info{
  margin-bottom: 80px !important;
}*/
/*#company-info{
  margin-bottom: 80px !important;
}*/
/*#add-company-info{
  margin-bottom: 80px !important;
}*/

/*#client-additional-info{
  margin-top: 80px !important;
}*/
/*#company-info{
  margin-top: 80px !important;
}*/
/*#contract-info1{
  margin-top: 80px !important;
}
#contract-processor-info{
  margin-top: 80px !important;
}
#description-info{
  margin-top: 80px !important;
}*/
.fc-content:hover { font-weight: 700;  }
.notes{
  height: 485px !important;
}
.notes-body{
  height:400px !important;
  min-height: 350px !important;
  overflow-y: auto;
}
.info{
  margin-top: 20px;
}
.other-info{
  height: 198px;
  overflow-y: auto;
}
.bg-purple-500{
  background-color: #673ab7 !important;
}
.color-purple-50{
  color: #f4f4f4db;
}
.color-purple{
  color: #673ab7;
}
#addClassSchedule .invite{
  width: 145px !important;
}
.invite_dv .controls .remove_invite:hover {background:#f1f3f4;}
.remove_invite:hover,#editClassSchedule .remove_invite:hover {color: #646464;}
/*.invite_dv .controls .remove_invite {padding:10px; width:34px; text-align:center; margin-left:10px; color:#767676; margin-right:-6px; cursor:pointer; border-radius:50px;}*/
.invite_dv .controls .remove_invite:hover {background:#f1f3f4;}
.invite_dv .controls .remove_invite {
    padding: 10px;
    /* margin-bottom: -27px; */
    position: absolute;
    width: 34px;
    margin-top: -34px;
    text-align: center;
    margin-left: 144px;
    color: #767676;
    margin-right: 0px;
    cursor: pointer;
    border-radius: 50px;
}
.well{
  margin-bottom: 0px !important; 
}
.select2-div{margin-top: 88px;position: absolute;}
.select2-div .select2-container{ width: 150px !important;}
.fc-agendaDay-view{margin-top: -30px;}
.pac-container{z-index:9999;}
/*.calendar{
  overflow: auto !important;
  min-height: 100px;
  height: 520px;
}*/
/*Modal style end*/
</style><!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/jquery.timepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.css"  rel="stylesheet" type="text/css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.timepicker.min.js"></script>
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.form.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>




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
<?php //print_r($record_data); die("ok"); ?>
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
              <?php foreach ($qualified as $key => $qualifiedData){?>

             <?php if($qualifiedData['questions'] == 'Are you selling goods to Canada' &&  $qualifiedData['answers']== 'Yes'){?>
                 
                 <span>Qualified At</span>'
                <span><?php echo date("m/d/Y h:i a",strtotime($qualifiedData['created_time']))?></span>  
                <?php }else{?>
                 <span>Not Qualified At</span><br/>
                 <span><?php echo date("m/d/Y h:i a",strtotime($qualifiedData['created_time']))?></span>
                <?php }break;?>       
            <?php }?>

              <?php  $qualified[0]['answers'] == 'Yes' ? '<span>Qualified At</span>' : '<span>Not Qualified At</span><br/>' ?> <span><?php  !empty($qualified) ? date("m/d/Y h:i a",strtotime($qualified[0]['created_time'])) : '';?></span>
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
                <span>Proposed</span> <span><?php echo !empty($propose == 1) && strtotime($propose) != false ? 'At '.date("m/d/Y h:i a",strtotime($proposed_date)) : '';?></span>
            </div>
             <?php }elseif($propose != 1 && $current_module == 'Clients' || $current_module == 'Contracts'){
              echo '<p><i class="fa fa-question-circle"></i></p>';
             }?>
          </div>
    <?php if($current_module == 'Clients' || $current_module == 'Contracts')
    { ?>
          <div id="stage-close" class="col color-yellow <?php echo !empty($current_module) && $current_module == 'Clients' || $current_module == 'Contracts' ? 'status-completed' : 'status-remaining';?>">
            <div class="block">
              <i class="fas fa-handshake fa-2x stage-icon" style="margin-top: 16px; font-size: 85px;"></i>
              <!-- <i class="icon-crm-checklist stage-icon"></i> -->
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
              <i class="fas fa-user-tie fa-2x stage-icon" style="margin-top: 16px; font-size: 85px;"></i>
              <!-- <i class="icon-crm-technical stage-icon"></i> -->
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
          <a class="btn icon-btn btn-theme-o" id="back-btn" title="back" href="#"> &nbsp;<i class="fa fa-arrow-left icon-left"></i></a>
					<?php if ($writePermission == true)
					{ ?>
					<a class="btn btn-theme-o" href="<?php echo base_url() ?>modules/addRecord/?cm=<?php echo $current_module; ?>&ac=new">Add New Record</a>  
          <?php
					} ?>
          <?php if ($writePermission == true && $current_module == 'Clients')
          { ?>
           <a class="btn btn-theme-o" href="<?php echo base_url() ?>modules/addRecord/?cm=<?php echo $current_module;?>&ac=new&add=addContract&clientId=<?php echo $current_record_id?>">Add Contract</a>
            <?php
          } ?>
  					<a class="btn color-theme" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1">View All <?php echo $current_module; ?><!--  <i class="icon-crm-arrow-long-right icon-right"></i> --> </a>

            <br>
          

          <div  id="st_message"></div>


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
              <?php
               
                $opener_id = (isset($record_data['__22']) && $record_data['__22']) ? $record_data['__22'] : 0;
                $closer_id = (isset($record_data['__21']) && $record_data['__21']) ? $record_data['__21'] : 0;
                /*print_r($record_data);
                die;*/
                /*$openerCloser_id = $current_module == 'Leads'? $opener_id: $record_data['__104'];*/

              ?>
              <?php
              if ($current_module != "Contracts")
              { 
                $openerCloser_id = $current_module == 'Leads'? $opener_id: $record_data['__104'];
              } ?>
                <!--
                <a class="module_head" href="<?php echo base_url() ?>modules/invoice/?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>">View Invoice</a> |
                -->
              
              <?php if($current_module == 'Leads'){?>

              <a class="btn btn-blue-o opener" title="Reassigned To Opener" href="<?php echo base_url() ?>modules/reassignedLead/?cm=<?php echo $current_module; ?>&ac=opener&opener_id=<?php echo $opener_id ;?>&id=<?php echo $current_record_id; ?>" data-id ='1' style="font-size: 12px;"><i class="fa fa-repeat"></i> Opener</span>
              </a>
              <a class="btn btn-blue-o opener" title="Reassigned To Closer" style="margin-right: 60px;font-size: 12px;" href="<?php echo base_url() ?>modules/reassignedLead/?cm=<?php echo $current_module; ?>&ac=closer&closer_id=<?php echo $closer_id; ?>&id=<?php echo $current_record_id; ?>" data-id='2'><i class="fa fa-repeat"></i> Closer</span>
              </a>
              <?php }?>

              
							<a class="btn icon-btn btn-blue-o" href="<?php echo base_url() ?>modules/editRecord/?cm=<?php echo $current_module; ?>&ac=edit&id=<?php echo $current_record_id; ?>" style="margin-left:-46px;">
                <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Record</span>
              </a>

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

            <div class="flash-message"></div>
        

            <!-- Modal -->
            <div class="modal fade" id="modalFollow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Follow Confirmation</h4>
                        </div>
                        <div class="modal-body">Are you sure about this action?</div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                            <button class="btn btn-success" id="record_follow_id" type="button">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->



            <!-- Modal Reassigned Start-->
            <div class="modal fade" id="reassigned" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title title"></h4>
                        </div>
                        <div class="modal-body">Are you sure about this action?</div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default ignore" type="button">Ignore</button>
                            <button class="btn btn-success confirm" type="button">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal Reassigned End-->


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
												<div class="modal-header" style="background:#1eb5ad;color:white;">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: 1;color: white;">&times;</button>
														<h4 class="modal-title" style="font-weight: 550;">Lead Conversion Confirmation</h4>
												</div>
												<div class="modal-body" style="font-size: 15px;">Are you sure to convert this record to Client ?
                          <div id="modal_error"></div>
                          <div class="row">
                            <div class="col-sm-4">
                              <label for='signing_rate'>Signing Rate *</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="number" class="form-control modal-fields" min="1" id="signing_rate" name="signing_rate" value="<?php echo isset($record_data['__13']) && !empty($record_data['__13']) ? $record_data['__13'] : ''; ?>" />
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <label for='Service_Type'>Service Type *</label>
                            </div>
                            <div class="col-sm-8">
                              <select multiple="multiple" class="modal-fields" id="Service_Type" placeholder="Service Type" >
                              </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <label for='expected_start_date'>Expected Start Date *</label>
                            </div>
                            <div class="col-sm-8">
                              <input type="text" class="form-control modal-fields" id="expected_start_date" name="expected_start_date" placeholder="MM/DD/YYYY" value="<?php echo isset($record_data['__24']) && !empty($record_data['__24']) ? $record_data['__24'] : ''; ?>" />
                            </div>
                          </div>

                        </div>
                        
                        <div class="modal-footer" style="margin-top: 10px;">
														<button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
														<button class="btn btn-success" onclick="convertRecord();" type="button">Confirm</button>
												</div>
										</div>
								</div>
						</div>
						<!-- modal -->

            <!-- unfollow Modal Start-->
              <div class="modal fade" id="modalunfollow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Unfollow Confirmation</h4>
                        </div>
                        <div class="modal-body">Are you sure about this action?</div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                            <button class="btn btn-success" id="record_unfollow_id" type="button">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- unfollow modal end -->



						<?php
						if (isset($deletedRecord) && $deletedRecord == true)
						{ ?>
								<a type="button" class="btn btn-success btn-lg btn-block" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1">View All <?php echo $current_module; ?> Listing</a>
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

                  $leadstatus =  (isset($record_data['__14']) && $record_data['__14']) ? $record_data['__14'] : "Cold";
                
									foreach($users_list as $arr_usr)
									{
										if($arr_usr['id'] == $opener)
										{
											$opener_name = $arr_usr['title'];
										}
										if($arr_usr['id'] == $closer)
										{
											$closer_name = $arr_usr['title'];
										}

									}
						?>

									<!--<img style="height: 42px; width: 42px;" alt="" src="<?php echo base_url() ?>static/images/boyAvatar.png">-->

                  <div class="hero-row row">
                    <div class="col-sm-7">

                      <div id="lead-info" class="card bordered-card color-theme">

                        <div class="card-header">
                          <div class="lead-status">
                          <?php if($leadstatus == 'Hot') {?>
                            <img src="<?php echo base_url()?>assets/images/hot.png">
                             <span><?php echo !empty($record_data['modified_time']) ? date("m/d/Y H:m:s", $record_data['modified_time']) : date("m/d/Y H:m:s", $record_data['created_time']);?></span>
                          <?php } ?>

                          <?php if($leadstatus == 'Cold') {?>
                            <img src="<?php echo base_url()?>assets/images/cold.png">
                            <span><?php echo !empty($record_data['modified_time']) ? date("m/d/Y H:m:s", $record_data['modified_time']) : date("m/d/Y H:m:s", $record_data['created_time'])?></span>
                          <?php }?>

                          <?php if($leadstatus == 'Warm') {?>
                            <img src="<?php echo base_url()?>assets/images/warm.png">
                            <span><?php echo !empty($record_data['modified_time']) ? date("m/d/Y H:m:s", $record_data['modified_time']) : date("m/d/Y H:m:s", $record_data['created_time']);?></span>
                          <?php }?>

                          <?php if($leadstatus == 'Dead') {?>
                            <img src="<?php echo base_url()?>assets/images/dead.png">
                            <span><?php echo !empty($record_data['modified_time']) ? date("m/d/Y H:m:s", $record_data['modified_time']) : date("m/d/Y H:m:s", $record_data['created_time']);?></span>
                          <?php }?>  
                          </div>
                            <div>
                              <h3 class="card-title"><?php echo $first_name . " " . $last_name; ?> </h3>
                              <span class="company-name"><?php echo $company_name ?></span>
                            </div>

                            <div style="padding:5px 0;">

                         <?php if($record_data['__14']=="Hot"){?>
                                <a href="#modalFollow" id="unfollow_id" class="btn btn-round btn-fill-theme"> <i class="icon-crm-user-plus"></i> Unfollow </a>
                              <!-- <span style="background:#1fb5ad; color:#fff; margin:0 8px; padding:1px 9px; border-radius:25px; display:inline-block; position:relative; top:2px; box-shadow:0 0 7px #ccc;" ><i class="icon-crm-user-plus"></i> Followed </span> -->
                            <?php } else{
                              ?>
                              <a href="#modalFollow" id="follow_id" class="btn btn-round btn-fill-theme"> <i class="icon-crm-user-plus"></i> Follow </a>
                            <?php } ?>

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
                                      <a id="convert-to-client" class="btn btn-round btn-fill-blue" data-toggle="modal" href="#"> <i class="icon-crm-user-out"></i> Convert To Client</a>

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
                                <span style="background:#1fb5ad; color:#fff; margin:0 8px; padding:1px 9px; border-radius:25px; display:inline-block; position:relative; top:2px; box-shadow:0 0 7px #ccc;"><?php if($qualified[0]['answers']=='Yes') { echo 'Qualified'; } else { echo 'Not Qualified'; } ?></span>
                              <?php } else { ?>
                            <a href="#modalQualifyNow" id="qualify_now" class="btn btn-theme-o" data-toggle="modal">Qualify Now</a>

                            <?php } } } ?>

                            <?php if($record_data['__14']=="Dead") {?>
                            <a href="#" id="" class="btn btn-theme-o" data-email="<?php echo $record_data['__4'] ?>" disabled>SEND EMAIL</a>
                            <?php } else{ ?>
                            <a href="#" id="send_email" class="btn btn-theme-o" data-email="<?php echo $record_data['__4'] ?>">SEND EMAIL</a>
                            <?php } ?>
                            
                            <?php if ($role_id == 1 || $role_id == 5 || in_array('bookings',json_decode($permissions))) { if($record_data['__14']=="Dead") { ?>  
                            <a href="#" id="book_now" class="btn btn-theme-o" data-toggle="modal" data-target="#"  disabled>Book Now</a>
                            <?php } else{ ?>
                            <a href="javascript:void(0)" id="book_now" class="btn btn-theme-o" data-toggle="modal" data-target="#addClassSchedule">Book Now</a>
                            <?php }?>
                            <?php } ?>
                


                            <a class="btn btn-theme-o" data-toggle="modal" href="#modalQualified">Qualified Data</a>
                        </div>

                      </div>

                    </div>


<!-- ******************************************************************************************************* -->
<div style="display:none;">


Lead Owner:
<?php 
  
foreach ($users_list as $option_key => $option)
{ ?>
    <?php if ($option['id'] == $record_data["__0"])
    {

      $lead_owner = $option['title']?>
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
<?php echo isset($lead_owner)? $lead_owner:"Not Available";?>
<?php echo isset($opener_name)? $opener_name:"Not Available";?>
<?php echo isset($closer_name)? $closer_name:"Not Available";?>
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
<?php } ?> <?php echo date("m/d/Y", $record_data["created_time"]); ?>


Modified By:
<?php if ($record_data["modified_by"] != NULL) {
foreach ($users_list as $option_key => $option) { ?>
<?php if ($option['id'] == $record_data["modified_by"]) { ?>
<?php echo $option['title']; ?>
<?php } ?>
<?php }
} else { ?>Not Modified Yet <?php } ?>

<?php if ($record_data["modified_time"] != NULL) { ?>
<?php echo date("m/d/Y", $record_data["modified_time"]); ?>
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
          <div id="notes-info" class="collapsible-card card bordered-card notes">

            <div class="card-header flex-row toggable-header " data-target="#notes-LAI" aria-expanded="true">
              <div class="col">
                <h4 style="display: inline-block;">Notes</h4>
                <a class="btn btn-theme-o" id="save-note-btn" href="#" style="float:right; margin-bottom:2%; display: none;">Save Notes</a>
                <a class="btn btn-theme-o" id="add-note-btn" data-toggle="modal" href="#modalOwnerUpdate" style="float: right; margin-bottom:2%;">Add Notes</a>
                <select id="note-response" style="height:33px !important;margin-bottom:2%;color:#41beb8 !important;font-weight:600 !important;background: #e0f7fa;border-color: #1fb5ad;border-radius:4px;float: right;margin-right:10px;">
                  <option value="">Choose Response</option>
                  <option value="Confirm">Confirm</option>
                  <option value="Cancel">Cancel</option>
                  <option value="Wait">Wait</option>
                  <option value="Hold">Hold</option>
                </select>
                
              </div>
              <div>
          <!--<span class="toggle-card-btn bg-blue-50">
                  <i class="icon-crm-angle-down"></i>
              </span> -->
              </div>
            </div>
            <div id="notes-LAI" class="card-content collapse panel-group additional-info-accordion collapse in " aria-expanded="true">

              <div id="collapse-notes1" class="collapse in notes-body">
                  <?php  if (isset($notes) && count($notes) > 0) {?>
                      <?php $id = 0; foreach ($notes as $key => $note) { $id ++; if($id == 1) { ?>
                      <div class="panel panel-default">
                         <div class="panel-heading">
                            <h4 class="panel-title" data-toggle="collapse" data-parent="#notes-LAI" href="#<?php echo $note['id'] ?>"> Note <?php echo $id ?><i class="fa fa-plus pull-right"></i> </h4>
                          </div>
                        <div id="<?php echo $note['id'] ?>" class="panel-collapse collapse in">
                            <div class="well well-large" style="padding:10px;">
                                <strong class="text-info" style="color:#444;">Posted on: <?php echo date('m/d/Y H:i', $note["created_time"]); ?> by <?php echo $note["created_by"] ?></strong>
                                <hr style="margin: 0;"/>
                                <h4 style="margin-top: 5px;color:#0098E3;font-size:12pt;font-weight:bold;"><?php echo $note["note_title"] ?></h4>
                                <?php echo $note["note"] ?>
                            </div>
                         </div>
                        </div>
                      <?php } else { ?>
                      <div class="panel panel-default">
                         <div class="panel-heading">
                            <h4 class="panel-title" data-toggle="collapse" data-parent="#notes-LAI" href="#<?php echo $note['id'] ?>"> Note <?php echo $id ?><i class="fa fa-plus pull-right"></i> </h4>
                          </div>
                        <div id="<?php echo $note['id'] ?>" class="panel-collapse collapse in">
                         
                            <div class="well well-large" style="padding:10px;">
                                
                                 <strong class="text-info" style="color:#444;">Posted on: <?php echo date('m/d/Y H:i', $note["created_time"]); ?> by <?php echo $note["created_by"] ?></strong>

                                <hr style="margin: 0;"/>
                                <h4 style="margin-top: 5px;color:#0098E3;font-size:12pt;font-weight:bold;"><?php echo $note["note_title"] ?></h4>
                                <?php echo $note["note"] ?>
                            </div>
                         </div>
                        </div>
                      <?php } ?>

                      <?php } ?>
                  <?php } else { ?>
                      <h3 class="text-center" style="margin: 0;">No notes available.</h3>
                  <?php } ?>
                  </div>
            </div> <!-- /#notes-LAI -->

          </div> <!-- /#lead-additional-info -->

            <?php
            $head_office_status = '';
            if(strtolower($record_data['__42']) == 'false')
              $head_office_status = 'No';
            if(strtolower($record_data['__42']) == 'true')
              $head_office_status = 'Yes';
            ?>

          <div class="row state-cards">
            <div class="col-xs-6">
              <div class="card bg-yellow-500 color-yellow-50 text-right" data-smooth-scroll="#bookings-card" data-time="10000">
                <span class="card-icon">
                  <i class="fa fa-list-ol color-yellow"></i>
                </span>
                <h1><?php echo count($bookings);?></h1>
                <h4>BOOKINGS</h4>
              </div>
            </div>
            
             <div class="col-xs-6">
                  <div class="card bg-red-500 color-red-50 text-right" data-smooth-scroll="#activities-card" data-time="10000">
                    <span class="card-icon">
                      <i class="fa fa-list-ol color-red"></i>
                    </span>
                    <h1><?php echo ($activities1);?></h1>
                    <h4>ACTIVITIES</h4>
                  </div>
              </div>
            <div class="col-xs-6 info">
              <div class="card bg-purple-500 color-purple-50 text-right" data-smooth-scroll="#lead-processor-info" data-time="10000">
                <span class="card-icon">
                  <i class="fa fa-list-ol color-purple"></i>
                </span>
                <h1>1</h1>
                <h4>LEAD PROCESSOR </h4>
              </div>
            </div>             
            <div class="col-xs-6 info">
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
        <div class="col-sm-7" style="margin-top:-265px">
          <div class="collapsible-card card bordered-card">
            <div class="card-header flex-row toggable-header">
                <div class="col">
                   <h4>Lead Infomation</h4>
                </div>
            </div>
            <div class=" other-info">
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

          <div id="collapse-company-info" class="card-content have-tabs collapse">

            <ul class="nav nav-tabs card-tabs">
              <li class="active">
                <a data-toggle="tab" href="#general">
                  <!-- <span class="icon-crm-tab-corner left"></span> -->
                  <span class="text">General</span>
                  <!-- <span class="icon-crm-tab-corner right"></span> -->
                </a>
              </li>
              <li>
                <a data-toggle="tab" href="#affiliate-company">
                  <!-- <span class="icon-crm-tab-corner left"></span> -->
                  <span class="text">Parent/Affiliate Company Information</span>
                  <!-- <span class="icon-crm-tab-corner right"></span> -->
                </a>
              </li>
            </ul>

            <div class="tab-content">
              <div id="general" class="tab-pane fade in active">
                <div class="table-structure-info">
                  <table>
                    <tr> <th nowrap>Company:</th> <td> <?=$record_data['__31']?> </td> </tr>
                    <tr> <th nowrap>Head Office Status:</th> <td> <?=$head_office_status?> </td> </tr>
                    <tr> <th nowrap>Address Line 1:</th> <td> <?=$record_data['__38']?> </td> </tr>
                    <tr> <th nowrap>Address Line 2:</th> <td> <?=$record_data['__39']?> </td> </tr>
                    <tr> <th nowrap>City:</th> <td> <?=$record_data['__35']?> </td> </tr>
                    <tr> <th nowrap>Province:</th> <td> <?=$record_data['__40']?> </td> </tr>
                    <tr> <th nowrap>Country:</th> <td> <?=$record_data['__37']?> </td> </tr>
                    <tr> <th nowrap>Zip Code:</th> <td> <?=$record_data['__36']?> </td> </tr>
                    <tr> <th nowrap>Phone:</th> <td> <?=$record_data['__32']?> </td> </tr>
                    <tr> <th nowrap>Fax:</th> <td> <?=$record_data['__33']?> </td> </tr>
                    <tr> <th nowrap>Website:</th> <td> <a href="http://<?=str_replace('http://', '', $record_data['__34'])?>" target="_blank"><?=$record_data['__34']?></a> </td> </tr>
                  </table>
                </div>
              </div>

              <div id="affiliate-company" class="tab-pane fade">
                <div class="table-structure-info">
                  <table>
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
                  </table>
                </div>
              </div>
            </div>
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
                <tr>
                  <th nowrap>Company Website 2 </th>
                  <td> <?=(isset($record_data['__190']))?$record_data['__190']:''?> </td>
                </tr>
              </table>
            </div>
          </div>
        </div> <!-- /#Company-info -->
      </div>
    </div>
  </div> <!-- /.hero-row -->
</div>

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

          <div id="collapse-lead-processor-info" class="card-content collapse in collapsed-have-height-equalizer">

            <div class="table-structure-info row">

              <div class="col-sm-6">
                <table class="height-equalizer" data-equalizer="table1">
                  <tr> <th nowrap >Lead Owner</th> <td><?php echo isset($lead_owner)? $lead_owner:"Not Available";?> </td> </tr>
                  <tr> <th nowrap >Phone</th> <td> <?php echo $phone ?> </td> </tr>
                  <tr> <th nowrap >Email</th> <td> <?php echo $record_data['__4'] ?> </td> </tr>
                  <tr> <th nowrap >Call Status</th> <td> <?php echo $call_status ?> </td> </tr>
                  <tr> <th nowrap >Lead Status</th> <td> <?php echo $status ?> </td> </tr>
                  <tr> <th nowrap >Lead Category</th> <td> <?php echo $record_data['__14'] ?> </td> </tr>
                  <tr> <th nowrap ># Dial Attempts</th> <td> </td> </tr>
                  <tr> <th nowrap >Closer</th> <td> <?php echo isset($closer_name)?$closer_name: 'Not Available';?> </td> </tr>
                  <tr> <th nowrap >Opener</th> <td> <?php echo isset($opener_name)?$opener_name: 'Not Available';?> </td> </tr>
                  <tr> <th nowrap >Service Type</th> <td><?php if(!empty((array)$record_data['__9'])) { echo implode(', </br> ',(array)$record_data['__9']); } ?></td> </tr>
                  <tr> <th nowrap >Signing Rate</th> <td><?php echo $record_data['__13']; ?></td> </tr>
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
                  <tr> <th nowrap >Proximity</th> <td><?=$record_data['__16']?></td> </tr>
                  <tr>
                    <th nowrap >Created By</th>
                    <td>
                      <?php foreach ($users_list as $option_key => $option) { ?>
                        <?php if ($option['id'] == $record_data["__0"]) {$user_name = $option['title'];?>
                          <span><?php echo isset($user_name)?$user_name:'Not Available';?></span>
                        <?php } ?>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <th nowrap >Created On</th>
                    <td><?php echo date("m/d/Y", $record_data["created_time"]); ?></td>
                  </tr>
                  <tr>
                    <th nowrap >Modified By</th>
                    <td>
                      <?php if ($record_data["modified_by"] != NULL) {
                        foreach ($users_list as $option_key => $option) { ?>
                          <?php if ($option['id'] == $record_data["modified_by"]){$modified_by = $option['title'];?>
                            <span><?php echo isset($modified_by)?$modified_by:"Not Available";?></span>
                          <?php } ?>
                        <?php }
                      } else { ?> Not Modified Yet <?php } ?>
                    </td>
                  <tr>
                    <th nowrap >Modified On</th>
                    <td>
                      <?php if ($record_data["modified_time"] != NULL) { ?>
                        <?php echo date("m/d/Y H:m:s", $record_data["modified_time"]); ?>
                      <?php } else {}?>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div> <!-- /.card-content -->
        </div> <!-- /#lead-processor-info -->
      </div>
            <?php if (!isset($deletedRecord) || $deletedRecord != true) { ?>
            <div class="row section-row" id="bookings-card">
              <div class="col-xs-12">
                <?php require_once "bookings.php"; ?>
              </div>
            </div>
            
            <div class="row section-row">
              <div class="col-xs-12">
                <?php require_once "new_activities1.php"; ?>
              </div>

            </div> 
            <div class="row section-row">
              <div class="col-xs-12">
                <?php require_once "attachment.php"; ?>
              </div>
            </div>
            <?php } ?>

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
             require_once "contracts_view.php";
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
													<?php require_once "note.php"; ?>
											</div>
											<div class="modal-footer">
													<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
													<!--button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change owner of');" type="button">Confirm</button-->
											</div>
									</div>
							</div>
					</div>
          <div class="modal fade" id="modalQualified" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"><strong>Qualified</strong></h4>
                      </div>
                      <div class="modal-body">
                          <?php if(!empty($qualified)) { ?>
                          <?php require_once "qualified.php"; ?>
                        <?php } ?>

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
									

											<div class="modal-header">

													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title"><strong>Qualify Now: Survey - USA Campaign</strong></h4>

											</div>
											<div class="modal-body">
                        <div class="text-center">
                          <b style="margin:0 10px;">Survey Type</b>
                          <div class="dropdown" id="survey_types_dropdown" style="display:inline-block;">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Choose Survey Type
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a data-toggle="pill" href="#survey_type1" data-cat = '1' class="select-cat" id = "surveyQ1">SALES TAX</a></li>
                              <!-- <li><a data-toggle="pill" href="#survey_type1" data-cat = '1' class="select-cat" id = "surveyQ1">APPRENTICESHIP TAX</a></li> -->
                              <!-- <li><a data-toggle="pill" href="#survey_type2" data-cat = '2' class="select-cat" id = "surveyQ2">CUSTOMS DUTY</a></li>
                              <li><a data-toggle="pill" href="#survey_type3" data-cat = '3' class="select-cat" id = "surveyQ3">SALES TAX</a></li> -->
                            </ul>
                          </div>
                        </div>
                         <div class="tab-content" style="padding-top:25px;">
													
                            <div id="survey_type1">
                             <?php require_once "qualify-servey-types/qualify_now_service3.php"; ?>
                            </div>
                             <div id="survey_type2">
                                <?php require_once "qualify-servey-types/qualify_now_service3.php"; ?>
                             </div>
                            <div id="survey_type3" >
                              <?php require_once "qualify-servey-types/qualify_now_service3.php"; ?>
                              
                            </div>

													</div>
											</div>
											<!--div class="modal-footer" style="text-align: center;"> -->
											<?php if(empty($qualified)) { ?>

												<!-- <button class="btn btn-success btnNext" type="button">Next</button>

												<button class="btn btn-success btnSubmit" type="submit" style="display:none;">Submit</button>

												 button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button--->

											<?php } ?>

											<!-- </div-->
										
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
            <input type="hidden" name="record_id" class="all_records" value="<?php echo $current_record_id; ?>"/>
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
<!--<div id="addClassSchedule" class="modal fade new-layout" data-backdrop="static" data-keyboard="false">
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

            <div class="row event-day-time get-notify" style="margin-top:20px;">
            </div>
            <button type="button" class="btn btn-success add-notification" id="add-notification-btn">Add Notification</button>
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
							
							<div class="row">
								
							</div>

							<div class="row">

							</div>

							
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
</div> -->
<!-- booking add popup end -->

<div id="addClassSchedule" class="modal fade new-layout" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg booking-modal">
    <div class="modal-content">
      <div class="row">
      <div class="col-xs-8">
      <form id="frmAddBooking" name="frmAddBooking" method="post" action="<?php echo base_url('booking/bookNow');?>">
        <input type="hidden" name="booking_id" id="booking_id">
        <input type="hidden" name="google_event_id" id="google_event_id">
        <input type="hidden" name="title" id="title_id">
        <input type="hidden" name="previous_invitee" id="previous_invitee">
        <input type="hidden" name="current_module" value="<?php echo $current_module; ?>">

        <input type="hidden" name="record_id" id="record_id">
        <div id="classScheduleBody" class="modal-body">


          <div class="first-part">
            <div class="row">
              <span class="icon close-modal close-div" data-dismiss="modal">
                <span>&nbsp;</span>
              </span>
              <div class="col-xs-8">
                <div class="form-group event-day-time">
                  <div class="controls">
                    <input type="text" class="input-xlarge form-control title" name="booking_title" id="booking_title" placeholder="Add title" style="width:100%;background-color: white !important;">
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <img src="<?php echo base_url('assets/images/ajax-loader.gif'); ?>" class="ajax-load">
                <button class='add_schedule_timing btn save-btn' type="button">Book Now</button>
              </div>
            </div>
            
            <div class="row event-day-time" style="margin: 0px 0px 5px 30px;">
              <div class="col-xs-12">
                <input class="input-xlarge booking-time form-control datepicker" name="start_date" id="start_date2"  type="text" placeholder="MM/DD/YYYY" required="" value="" required autocomplete="off">

                <input class="input-xlarge booking-time form-control timepicker start_time_dv" name="start_time" id="start_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">

                <span style="margin-right:8px;"> to </span>

                <input class="input-xlarge booking-time form-control datepicker" name="end_date" id="end_date"  type="text" placeholder="MM/DD/YYYY" value="" autocomplete="off" style="display:none;">

                <input class="input-xlarge booking-time form-control timepicker start_time_dv" name="end_time" id="end_time" value="" type="text"  placeholder="HH:MM" autocomplete="off">
                <!-- <label class="control-label event-recurrence">
                  <input class="form-control checkbox" name="all_day" id="all_day" value="1"  type="checkbox" style="width:17px; position:absolute; visibility:hidden;">
                  <span class="input-checkbox-icon"></span>
                  <span> All Day </span>
                </label> -->
                <!-- <span class="booking_availability" style="margin-left:10px;">
                    <a href="javascript:" class="check_booking">Check Availability</a>
                </span> -->
                <div class="booking-alert"></div>
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
                     <div class="col-xs-10 location-div" >
                        <input type="text" class="form-control location-input event_location" id="event_location" placeholder="Enter Location" name="event_location" onFocus="geolocate()" autocomplete="off">
                        <a href="javascript:void(0)" onclick="mapsSelector('addForm')" class="open-map btn-link" >Open location in map</a>
                        <span class="location-icon" title="Use current location"> <i class="fa fa-crosshairs" onclick="currentLocation()"></i> </span>
                      </div>
                    </div>
                    <div class="row" style="margin-top: 5px;"> 
                     <i class="fa fa-video-camera" style="margin-left:11px; font-size:24px; float:left;"></i>
                     <div class="col-xs-10" >
                        <select style="border: 0px;background: #f1f3f4; border-radius: 4px;" name="conference" id="conference">
                          <option value="0" selected >Add conferencing</option>
                          <option value="1">Conference call</option>
                          <option value="2">Web meeting</option>
                        </select>
                      </div>
                    </div>
                    <div class="event-day-time">
              
                      <div style="display: none;">
                        <label class="control-label" for="textfield" style="margin-top:20px;">Visibility</label>
                        <select name="visibility" id="visibility" class="inline-select">
                          <option value="public">Public</option>
                          <option value="private">Private</option>
                        </select>
                      </div>
                    </div>

                    <div class="row event-day-time get-notify">
                    </div>

                    <div style="margin-bottom: 10px;">
                      <i class="fa fa-bell" style="margin-left:2px; font-size:23px;"></i>
                      <button type="button" class="btn btn-success add-notification" id="add-notification-btn">Add Notification</button>
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
                              <span class="choose">Choose a file</span>
                            </span>
                          </div>
                        </div>
                        <textarea name="notes" id="notes2" rows="4" cols="106"></textarea>        
                      </div>                
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-xs-12">
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
                <div class="col-guests">
                  <div class="tab-title" style="margin-bottom:0px !important;"> <span>Guests</span> </div>
                  <div class="row">         
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
                <!-- <div class="form-group">
                    <a  class="add_invite" title="Add More" href="javascript:;" style="text-transform:uppercase;">Add Guests</a>      
                </div> -->
              </div>          
            </div>  
             <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;">          
                <div class="col-xs-12"> 
                  <div class="form-group guest-list-scroller" style="display:none">
                    <div>
                      <label class="control-label" for="textfield">
                        <span class="">1</span> Guest(s)
                      </label>
                      <span id="email_status" style="display:block;"></span>
                    </div>

                    <!-- <div>
                      <label class="control-label guest_yes_no" for="textfield" style="font-size: 11px;">
                        <span class="guest_yes"></span>
                        <span class="guest_maybe"></span>
                        <span class="guest_no"></span>
                        <span class="guest_awaiting"></span>
                      </label>
                    </div> -->
                    <div class="invited_dv"> </div>
                  </div>
                </div>                
              </div>  
            </div>
            </div>


          </div>

          <div class="row">
            <div class="col-sm-6 col-xs-12" >
              <div class="row">
                
              </div>

              <div class="row">

              </div>
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

               <div class="row" style="border-top: 1px solid #ccc; padding-top: 8px;display: block;">
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
    </form>
  </div>
    <div class="col-xs-4 calendar">
    <div class="col-xs-12">
      <div class="select2-div"> 
        <span>Bookings of</span>
      <span>
         <select id="popular" name="own[]" class="popular-list" style="margin-top: -2px;margin-left: 5px;min-width: 15%; background: white; border-radius: 5px;">
              <?php foreach ($closerOpener as $option_key => $option) { if($option['user_id'] == $openerCloser_id){?>
                <option value="<?php echo $option['user_id']; ?>" selected><?php echo $option['first_name'].' '.$option['last_name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $option['user_id']; ?>" ><?php echo $option['first_name'].' '.$option['last_name']; ?></option>

              <?php } } ?>
        </select>
      </span>
      </div>
        <div id="calendar" class="has-toolbar"></div>
     </div> 
    </div>
    </div>
  </div>
</div>
<div id="map" style="display: none;"></div>
<style>

</style>
<script type="text/javascript">
/*$(document).ready(function() {
    //$("#own").select2();
    
});*/
</script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min-new.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/fullcalendarv3.min.js"></script>

<script type="text/javascript">
  
  var base_url = '<?php echo base_url();?>';
 $("#follow_id").click(function(){
    $("#modalFollow").modal();
});

/* $(function() {

  $('#calendar').fullCalendar({
    header: {
      left: '',
      
      right: 'prev,next'
    },
     defaultView: 'agendaDay'
     //selectable:true,

  });

});
*/
$(function() {
  //$('.popular-list').select2();
  var user_id = '';

  if(user_id == ''){
    user_id = '<?php echo $openerCloser_id?>';
  }else{
    user_id = user_id;
  }
  // alert(user_id);
  $('#calendar').fullCalendar({
    selectable: true,
    defaultView: 'agendaDay',
    slotDuration :'00:15:00',
    header: {
      left: ' today',
      center: 'title',
      right: 'prev,next'
    },
    dayClick: function(date,jsEvent, view) {
       $('#addClassSchedule #start_time').val(date.format('h:mm a'));
        $('#addClassSchedule #start_date2').val(date.format('MM/DD/YYYY'));
         $('#addClassSchedule #end_date').val(date.format('MM/DD/YYYY')); 
          var endDate = date.add(15,"m");
        $('#addClassSchedule #end_time').val(endDate.format('h:mm a'));
       
    },
    eventSources: [{
          events: function (start, end, timezone, callback) {
            $.ajax({
                url: '<?php echo base_url() ?>Modules/getEvents1',
                method:'post',
                dataType: 'json',
                data: {
                  user_id: user_id , module:'<?php echo $current_module; ?>',
                },
                success: function (msg) {
                  console.log(msg);
                  var events = msg.events;
                  console.log(events);
                  // $('#calendar').fullCalendar('refetchEvents');
                  callback(events);
                }
            });
          },
        },               
      ],
  });
/*$('#popular').on("select2:selecting", function(e) { 
    user_id = $(this).val();
    alert($(this).val());
     if(user_id != ''){
     //user_id = id; 
     $('#calendar').fullCalendar('refetchEvents');
     }
  });*/
$('#popular').on("change", function(e) { 
    user_id = $(this).val();
    //alert($(this).val());
     if(user_id != ''){
     //user_id = id; 
     $('#calendar').fullCalendar('refetchEvents');
     }
  });
});


 $("#record_follow_id").click(function(){
  var record_id = $(".all_records").val();
  $.ajax({
          method:"post",
          url:base_url + 'booking/followlead',
          data:{'record_id':record_id},
        //  dataType:"json",
          success:function(data) {
          window.location.reload();
             }
        });
  });

/*
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
	});*/
/*
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
	});*/

/*
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
	});*/

/*
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

  });*/
	function deleteRecord(){
			window.location.href = "<?php echo base_url() ?>modules/viewRecord/?cm=<?php echo $current_module; ?>&ac=del&id=<?php echo $current_record_id; ?>&mtd=2";
	}
	function archiveRecord(){
			window.location.href = "<?php echo base_url() ?>modules/viewRecord/?cm=<?php echo $current_module; ?>&ac=del&id=<?php echo $current_record_id; ?>&mtd=1";
	}
	function convertRecord(){
		var signing_rate = $("#signing_rate").val();
    var Service_Type = $("#Service_Type").val();
    var expected_start_date = $("#expected_start_date").val();
    if(signing_rate && signing_rate!=='0')
		{
      if(Service_Type!='' && Service_Type!=null)
      {
        if(expected_start_date!='' && expected_start_date!=null)
        {
          $("#modal_error").text('');
          window.location.href = "<?php echo base_url() ?>modules/viewRecord/?cm=<?php echo $current_module; ?>&ac=convert&id=<?php echo $current_record_id; ?>&signing_rate="+signing_rate+"&service_type="+Service_Type+"&expected_technical_start_date="+expected_start_date;
        }
        else
        {
          $("#modal_error").text('Enter valid Start Date');
        }
      }
      else
      {
        $("#modal_error").text("Choose Service Type");
      }
		}
		else
		{
			$("#modal_error").text("Enter valid Signing Rate");	
		}
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
    var record_id = '<?php echo $current_record_id ?>';
    var module_name = '<?php echo $current_module ?>';
		var url = '<?php echo base_url() ?>reports/sendMail?action=compose&email='+email+'&record_id='+record_id+'&module_name='+module_name+'';
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
        removePlugins : 'elementspath',
        resize_enabled : false,
          toolbar : [
           ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
           '/',
        ] ,
          height: '50px',
          contentsCss : 'body{background:#f1f3f4;font-family:sans-serif, Arial, Verdana, "Trebuchet MS"; font-size:12px;}',
        });

	$(".datepicker,#datepicker2").datepicker(
  {minDate: 0}
    );
	$("#addClassSchedule .timepicker").timepicker({
	    timeFormat: 'h:mm a',
	    interval: 15,
      startTime: new Date(0,0,0,9,0,0) // 3:00:00 PM - noon
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
    form.validate(
    {
        rules: {
        booking_title: "required",
        },
        invalidHandler: function(form, validator) {
          var errors = validator.numberOfInvalids();
          if (errors) {
                $("#addClassSchedule").animate({ scrollTop: 0 }, "fast");
          }
      },
      messages:{
       booking_title: "Enter Booking title."
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
                          $('.success').css('display', 'block');
                          $('#success-message').text(data.message);
                          $('#calendar').fullCalendar('refetchEvents');
                          //location.reload();

                      }else if(typeof data != 'undefined'  && data.success != 'undefined' && data.success == false)
                      {
                        var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>'+ data.message + '</div></div>';
                          $('.flash-message').html(html);
                          $('#frmAddBooking')[0].reset();
                          $('#addClassSchedule .ajax-load').hide();
                          $('.warning').css('display', 'block');
                          $('#warning-message').text(data.message);
                           $('#calendar').fullCalendar('refetchEvents');
                          //location.reload();
                      }

                  },
                  error: function(data){

                  	$('#addClassSchedule').modal("hide");
                    if (typeof data != 'undefined') {
                          var html = '';
                          var html = '<div class="col-md-12"><div class="alert alert-danger alert-dismissable" data-auto-dismiss="2000"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>Error! </strong>There are some problems to perform this action.</div></div>';
                          $('.flash-message').html(html);
                          $('#frmAddBooking')[0].reset();
                           $('.warning').css('display', 'block');
                          $('#warning-message').text(data.message);
                           $('#calendar').fullCalendar('refetchEvents');
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
             $(".booking-time").css("border","1px solid red");
             $(".booking-alert").text(data.status);
             $(".booking-alert").addClass('alert-false in');
             $(".booking-alert").removeClass('alert-true');
             return false;
            }else{ 
             $("#addClassSchedule .add_schedule_timing").removeAttr("disabled");
             $(".booking-time").css("border","1px solid green");
             $(".booking-alert").text(data.status);
             $(".booking-alert").addClass('alert-true in');
              $(".booking-alert").removeClass('alert-false');
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
             $(".booking-time").css("border","1px solid red");
             $(".booking-alert").addClass('alert-false in');
             $(".booking-alert").removeClass('alert-true');
             return false;
            }else{ 
             $("#addClassSchedule .add_schedule_timing").removeAttr("disabled");
             $(".booking-time").css("border","1px solid green");
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
  $("#addClassSchedule #start_time").timepicker({
    timeFormat: 'h:mm a',
    interval: 30,
    change:availCheck
  })
  $("#start_date2,#all_day").on("change keyup",function(){
    availCheck();
  });
  function availCheck(){
    $('.booking-alert').text('');
    $('.booking_availability').removeClass('in');
    //$("#addClassSchedule .add_schedule_timing").prop("disabled", true);
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
				$('.start_time_dv').hide();
			}
			else if($(this).prop("checked") == false){
				$('.start_time_dv').show();
			}
		});

      $('.toggable-header').click(function(){
        $(this).find('.toggle-card-btn i').toggleClass('icon-crm-angle-down icon-crm-angle-up');
      });

      /* new code start here*/
      $("#note-response").change(function(){
        var data = $(this).val();
        if(data != '')
        {
          $("#add-note-btn").css('display','none');
          $("#save-note-btn").css('display','inline-block');
        }
        else
        {
          $("#add-note-btn").css('display','inline-block');
          $("#save-note-btn").css('display','none');
        }
      });
      $("#save-note-btn").click(function(){
        var data = $("#note-response").val();
        $("#addNoteForm #note").val(data);
        $("#addNoteForm").submit();
      });
      $("#back-btn").click(function(){
        history.back();
      });
      /* new code end here*/
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
      var base_url = "<?php echo base_url(); ?>";
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
      $("#survey_types_dropdown .dropdown-toggle").click(function(){
        $(".dropdown-menu li").removeClass("active");
      });
      $("#survey_types_dropdown .dropdown-menu li").click(function(){
        $("#survey_types_dropdown .dropdown-toggle").html($(this).text()+' <span class="caret"></span>');
        $("#frmQualify .questiondiv").hide();
        $("#frmQualify .first_que").show();
        $("#frmQualify")[0].reset();

      });

      $(".collapsed-have-height-equalizer").each(function(){
        //$(this).removeClass('in');
      });

  });

/* Auto add end date and end time */
$(document).on('click','#addClassSchedule #start_time', function(){
  $(this).addClass('clicked');
})
$(document).on("click", ".ui-timepicker-viewport a", function(){
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
  var time_min = theTime1[0]; 
  var theTime3 = '00';
  var theTime2;
//  var theTimearrr = parseInt(theTime1);
 if (theTime[0]=='12' && theTime1[1]=='am') {
   if(theTime1[0] == '45')
   {
      theTime[0]=0+1;
      theTime3 = '00';
   }
   else
   {
      
      theTime3 = parseInt(theTime1[0])+15;
   }
   //theTime[0]=0+1;
   theTime2 = theTime[0];
   var select3 = $("#start_date2").val();
   var selected11 = $("#end_date").val(select3);
}
  else if(theTime[0]=='12' &&  theTime1[1]=='pm')
  {
    if(theTime1[0] == '45')
    {
      theTime[0]=0+1;
      theTime3 = '00';
    }
    else
    {
      theTime3 = parseInt(theTime1[0])+15;
    }
    theTime1[1]='pm';
    theTime2 = theTime[0];
    var select3 = $("#start_date2").val();
    var selected11 = $("#end_date").val(select3);
  }
  else if(theTime[0]=='11' &&  theTime1[1]=='pm')
  {
    if(theTime1[0] == '45')
    {
      theTime2=+theTime[0]+1;
      theTime3 = '00';
      theTime1[1]='am';
      var selected111 = $("#end_date").val();
      var date =new Date(selected111);
      date.setDate(date.getDate() + 1);
      var dd = date.getDate();
      var mm = date.getMonth() + 1;
      var y = date.getFullYear();
      var someFormattedDate = mm + '/' + dd + '/' + y;
      $("#end_date").val(someFormattedDate);
    }
    else
    {
      theTime3 = parseInt(theTime1[0])+15;
      theTime2 = theTime[0];
      var select3 = $("#start_date2").val();
      var selected11 = $("#end_date").val(select3);
    }
  }else if(theTime[0]=='11' &&  theTime1[1]=='am')
   {
      if(theTime1[0] == '45')
      {
        theTime2=+theTime[0]+1;
        theTime1[1]='pm';
        theTime3 = '00';
      }
      else
      {
        theTime2 = theTime[0];
        theTime3 = parseInt(theTime1[0])+15; 
        theTime1[1]='am'; 
      }
      var select3 = $("#start_date2").val();
      var selected11 = $("#end_date").val(select3);
   }
 else
  {
      if(theTime1[0] == '45')
      {
        theTime2=parseInt(theTime[0])+1;
        theTime3 = '00';
      }
      else
      {
        theTime2 = theTime[0];
        theTime3 = parseInt(theTime1[0])+15; 
      }
      var select3 = $("#start_date2").val();
      var selected11 = $("#end_date").val(select3);
  }
  $("#end_time").val(theTime2+":"+theTime3+" "+theTime1[1]);
  /*if(time_min=='30'){
    $("#end_time").val(theTime2+":30"+" "+theTime1[1]);
  }else{
    $("#end_time").val(theTime2+":00"+" "+theTime1[1]);
  }*/
  

});

 /* $("#start_date2").on("change",function(){
          var selected = $(this).val();
          $("#end_date").val(selected);
   });
  $(document).on("change", "#end_date", function(){
        var st = $("#start_date2").val();
        var ed = $("#end_date").val();
    if(new Date(st) > new Date(ed)){
      $("#end_date").addClass("intro");
      $("#end_time").addClass("intro");
    }else
    {
      $("#end_date").removeClass("intro");
      $("#end_time").removeClass("intro");
    }
});
*/
  $(document).on('click', '#unfollow_id', function(){
    $('#modalunfollow').modal('show');
  });
  $(document).on('click', '#record_unfollow_id', function(){
    var record_id = $(".all_records").val();
      $.ajax({
          method:"post",
          url:base_url + 'booking/unfollowlead',
          data:{'record_id':record_id},
          success:function(data){window.location.reload();}
        });
  });
  $(document).on('change', '#start_date2', function(){
    var start_date = $(this).val();
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yy = today.getFullYear();
    var todayDate = mm + '/' + dd + '/' + yy;
     if(new Date(start_date)< new Date(todayDate)){
      $("#start_date2").addClass("intro");
      $('#end_date').val('');
      $('#end_time').val('');
      $('#start_time').val('');
    }
    else{
     $("#start_date2").removeClass("intro");
      //$('#start_time').val('12:00 am');
      $('#end_date').val(start_date);
      //$('#end_time').val('1:00 am');
      //alert('true');
    }
  });

  $(document).on('click', '#add-notification-btn', function(){
    // body...
      var html1 = ' <div class="col-sm-3 col-xs-6" style="padding-right:0"><label class="control-label" for="textfield">Notification</label><select name="notification_via" id="calendar_type" class="notification-via"><option value="1">Email</option></select></div><div class="col-sm-3 col-xs-6 all_dv repeat"><label class="control-label" for="textfield"></label><input type="number" id="calendar_type" min = "1" max= "12" name="notification_interval" placeholder="before" class="before-time"></div><div class="col-sm-3 col-xs-6 all_dv note"><label class="control-label" for="textfield"></label><select id="calendar_type" name="notification_type" class="notification-via"><option selected="" value="1">hours</option><option value="2">days</option></select></div><i class="fas fa-times close" id="close-notification"></i>'
              $('.get-notify').html(html1);
              $('#notification_interval').val(1);
  });

$(document).on('click', '#close-notification', function (){
   $('#notification_interval').val(0);
  $(this).parent().html(''); 
});

$(document).on('change', '.notification-via', function(){
  $(".before-time").val(1);
  if($(this).val() == 1){
      $('.before-time').attr({
        "min":1,
        "max":12,
      });

  }else{
      $('.before-time').attr({
        "min":1,
        "max":7,
      });

  }
});
  $(document).on('click', '.select-cat', function(){
    
    var cat_id = $(this).attr('data-cat');
    var className = $(this).attr('id');
    if('.qualify_now:visible'){
        $('.qualify_now').css('display', 'none');
    }
    $("#frmQualify")[0].reset();

    $('.btnNext').css('display', 'block');
    $('.btnNext').next('.btnSubmit').css('display', 'none');
   /* $('.btnSubmit').css('display', 'none');*/

    $('.others').next().next("input[type='text']").prop('disabled', true);

  $('.'+className +' '+'.form-group').first().css('display', 'block');
    $('.questions').find('.'+className).css('display', 'block');

  });
var link;
$(document).on('click', '.opener', function(e){     
     e.preventDefault(); 
     link = $(this).attr('href');

    if($(this).attr('data-id')==1){
       $('#reassigned  .title').text('Reassigned To Opener');
       $('#reassigned').modal('show'); 
      }
      else{
        $('#reassigned  .title').text('Reassigned To Closer');
        $('#reassigned').modal('show');}     
});
$('#reassigned .ignore').click(function (){
      $('#reassigned').modal('hide');
});
$('#reassigned .confirm').click(function(){
  window.location.href=link;
});
$(document).on('click', '#convert-to-client', function(){
  var base_url = "<?php echo base_url(); ?>";
  $.ajax({
    type: "post",
    url: base_url+ 'modules/getServiceType',
    dataType: 'json',
    success: function(data)
    {
      var serviceTypes = data.result[0]['option_value'];
      $("#Service_Type").html('');
      if(data.status != false && serviceTypes != null && serviceTypes != '')
      {
        var arr = serviceTypes.split(',');
        var html = '';
        for(var i=0; i< arr.length; i++)
        {
          html += '<option value="'+arr[i]+'">'+arr[i]+'</option>';
        }
        $("#Service_Type").html(html);
        $("#Service_Type").select2({
         placeholder: "Choose Service Type",
         allowClear: true,
         });
        UpdateServices();
      }
    }
  });
});
$('#expected_start_date').datepicker({
  dateFormat: 'mm/dd/yy',
  minDate: 0,
});
function UpdateServices()
{
    var base_url = "<?php echo base_url(); ?>";
  var record_id = "<?php echo $current_record_id; ?>";
  $.ajax({
    type: "post",
    dataType: "json",
    url: base_url+'modules/getServicesByRecordId',
    data: { record_id : record_id},
    success:function(data)
    {
      var services= data.result[0]['value'];
      var html ='';
      if(data.status!=false && data.result!=null && data.result!='')
      {
        var arr = services.split('____');
        if(arr.length)
        {
            $("#Service_Type").val(arr);
            $("#Service_Type").trigger('change');
        }
      }
      $("#modalConvert").modal();
    }
  });
}
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
       $(document).on('click','.add_invite',function(){
    
    var html = '<div class="controls" style="margin-bottom: 5px;"><input class="input-xlarge form-control invite auto-email" name="invite[]" type="text" value="" required autocomplete="off" placeholder="Enter email">    <i class="fa fa-times remove_invite" aria-hidden="true"></i>  <div class="show_avail" style="color:red;font-size: 12px;display: none;">User not available on this date time!</div> </div> ';     
    
    //console.log(html);
    $('.invite_dv').append(html);
    
  });
  
  $(document).on('click','.remove_invite',function(){   
    $(this).parent().remove();
    $('.add_invite').show();
    $('.update_schedule_timing').attr('disabled', false);
  });
  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmw-ajRb-0ytRRavjIK52f6IbTIB7vrBY&libraries=places&callback=initAutocomplete"></script>
