<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css.map">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">

<!-- for calender glyphicon -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- end -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<style>
.btn-collapse {
    float: right;
    padding: 2px !important;
    padding-left: 3px !important;
    margin-top: -7px;
    margin-right: -2px;
    cursor: pointer;
    border-radius: 50px;
    border: 2px solid #fe832c;
    color: #fe832c;
    width: 20px;
    font-size: 12px;
}     
.rem-booking{margin: 0px !important}
.book-href{
    color: grey;
    font-weight: bold;
}
.book-href:hover{
    color: #1FB5AD;
}
a.canvasjs-chart-credit {
    display: none;
}
div#dynamic_content {border:1px solid #e1e6ef; box-shadow:0 7px 14px -5px rgba(0,0,0,0.5);}
#dynamic_content .table-bordered {border:0;}
.btn-collapse {float:right; padding:10px; margin-top:-8px; cursor:pointer; border-radius:50px;}
.btn-collapse:hover, .btn-collapse.collapsed {background:#f1f2f7;}
.btn-collapse.collapsed:before {content:"\f078"}

.stats-card {padding:20px 5px 15px; color:#fff; border-radius:2px; display:flex;}
.stats-card .left-col {padding-left:15px}
.stats-card .right-col {text-align:right; flex-grow:1; padding:0 15px}
.stats-card .count {margin:0 0 25px; font-weight:normal; font-size:28px;}
.stats-card .title {text-transform:uppercase; letter-spacing:2px; font-weight:bold; display:block; font-size:14px; border-bottom:2px solid rgba(0, 0, 0, .18); padding-bottom:4px; margin-bottom:3px;}
.stats-card .icon {border-radius:50%; background-color:rgba(0, 0, 0, .18); display:block; width:74px; height:74px; text-align:center; font-size:44px; line-height:74px; margin-top:13px;}
.blue {background:#0288d1}
.red-pink {background:#ff5252;}
.yellow {background:#ff6f00;}
.green {background:#43a047;}

.calendar-header {text-align:center; color:#ff6b68; padding:1px;}
.calendar-header h2 {line-height:48px;}
.calendar-header2 {background:#fe832c; text-align:center; color:#fff; padding:1px;}
.calendar-header h2 {line-height:48px;}
#calendar {padding-top:20px; background:#fff;}
/*#calendar .fc-left*/
#calendar .fc-left h2 {float:none; text-align:center; font-size:18px; color:#333;}
#calendar .fc-icon-left-single-arrow:after {font-size:100%; top:0; font-family:'icon-anbruch'; content:'\e812';}
#calendar .fc-icon-right-single-arrow:after {font-size:100%; top:0; font-family:'icon-anbruch'; content:'\e813';}

.fc-row.fc-rigid {overflow:initial;}

#calendar .fc-toolbar button {border:0; background:transparent !important; height:35px; border-radius:25px !important; box-shadow:none; color:#767676 !important;}
#calendar .fc-toolbar button:hover {background:#f5f5f5 !important; height:35px; border-radius:25px !important;}
#calendar .fc-toolbar h2 {font-size:22px;}
#calendar .fc-toolbar {padding:0 15px; margin-bottom:30px;}
.fc-unthemed th, .fc-unthemed td {border:0;}
.fc-day-top {text-align:center;}
.fc-ltr .fc-basic-view .fc-day-top .fc-day-number {float:none;}
.fc .fc-day-header {padding:0 0 10px; text-transform:uppercase; font-weight:500;}
.fc-unthemed td.fc-today {background:transparent;}
.fc-day-top.fc-today .fc-day-number {background:#0288d1; border-radius:25px; display:inline-block; width:18px; color:#fff;}
.fc-day-grid-event {padding:5px 9px; background:#ff6b68; border:0; margin-bottom:3px;}
.fc-day-grid-event:hover {background:#f26663;}
.fc-day-grid-event .fc-content {text-overflow:ellipsis; color:#fff;}
.fc-more-popover .fc-day-grid-event {margin-bottom:5px;}
.fc-popover .fc-widget-header {padding:6px;}
table.dataTable.no-footer {border-bottom:1px solid #e3ebf3; width:100% !important;}
table.dataTable tbody td {padding:8px 18px;}

.hot-leads-table {background:#fff; padding:9px 0 0; color:grey; font-size:13px; margin-top:50px;}
.hot-leads-table table.dataTable th  {color:#3e3e4e}
.hot-leads-table table.dataTable a{color: grey}
.hot-leads-table h3 {padding:20px; text-align:center;}
.hot-leads-table table {width:100%}
.hot-leads-table table.dataTable th {vertical-align:bottom; border-bottom:2px solid #E3EBF3; border-top:1px solid #E3EBF3;}
.company {color:#009C9F}
.hot-leads-table tbody tr {border-bottom:1px solid #E3EBF3;}
.hot-leads-table tbody tr:hover {background:rgba(245,247,250,.5)}
.hot-leads-table tbody .status {padding:4.5px 7px; background:#000; color:#fff; font-size:13px; border-radius:2px; display:inline-block;}
/*.hot-leads-table tbody .ASSIGNED.TO.OPENER {background:#16D39A;}
.hot-leads-table tbody .ASSIGNED.TO.CLOSER {background:#ffc722;}*/
.hot-leads-table tbody .NO.OPPORTUNITY {background:#ff6b68;}


.widget-past-days {background:#00BCD4; color:#FFF; box-shadow:0 1px 2px rgba(0,0,0,.075); margin-bottom:2.3rem; position:relative; display:flex; -ms-flex-direction:column; flex-direction:column; min-width:0; word-wrap:break-word; background-clip:border-box; border:1px solid transparent; border-radius:2px; webkit-box-orient:vertical; -webkit-box-direction:normal;
}
.fc-scroller.fc-day-grid-container {padding-top:10px;}

.card-body {-webkit-box-flex:1; -ms-flex:1 1 auto; flex:1 1 auto; padding:2.2rem;}
.card-body .card-title {font-size:21px;}

.listview .listview__item {display:-webkit-box; display:-ms-flexbox; display:flex;}
.listview__item {padding:17px 2.2rem; transition:background-color .3s;}
.widget-past-days__info small {font-size:15px; color:rgba(255,255,255,.9); font-weight:400;}

.widget-past-days__info h3 {margin:0; color:#FFF; /*font-weight:400;*/ /*font-size:1.75rem;*/}
.listview--inverse.listview--striped .listview__item:nth-child(even) {background-color:rgba(255,255,255,.1);}
#compare-row .user_select {margin-bottom: 15px;}
.select2-container--default .select2-selection--single {background: #f5f5f5;height: 35px;border-color: #ddd;}
.chart-container .this_year {background: #fff !important;color: #5a6766 !important;border: 1px solid;opacity: 1;}
.char-actions .year_label {width: 50%;text-align: right;font-size: 20px;}

td.booking-status span {padding:2.5px 7px; font-size:13px; border-radius:2px; display:inline-block;}

span.col-title {margin-top:10px; display:block; font-weight:600; font-size:15px;}
span.circle {border:5px solid; color:#16D39A; margin-top:16px; display:inline-block; border-radius:50%; width:64px; height:64px; line-height:56px; font-size:30px;}


    @media (max-width:1439px){
    .TI span.circle {margin-top:36px;}
    }

    @media (max-width:1244px){
        .stats-card .icon {width:54px; height:54px; font-size:30px; line-height:55px; margin-top:24px;}
        .stats-card .icon-crm-calendar {font-size:25px !important;}
        .data-cols {height:188px;}
        #main-content:not(.merge-left) .L2C span.circle {margin-top:36px;}
    }

    @media (max-width:1199px){
    .stats-row .card-col {margin-bottom:30px;}
    .stats-row .stats-card {width:240px; margin:0 auto;}

    }

    @media (max-width:1044px){
        #main-content:not(.merge-left) .stats-card {display:block;}
        #main-content:not(.merge-left) .stats-card .left-col {position:absolute;}
        #main-content:not(.merge-left) .stats-card .icon {margin-top:-10px;}
        #main-content:not(.merge-left) .calendar-row .main-cols {width:100%; padding:0 15px 0 0;;}
        #main-content:not(.merge-left) .calendar-row .col-left .row {width:50%; margin-left:0;margin-right:0; float:left;}
        #main-content:not(.merge-left) .widget-past-days {margin-right:15px;}
        #main-content:not(.merge-left) .data-cols {display:table;}
        #main-content:not(.merge-left) .data-cols .col {width:100%}
        #main-content:not(.merge-left) span.circle {margin:23px 0 13px !important;}
    }
    @media (max-width:891px){
        .stats-card {display:block;}
        .stats-card .left-col {position:absolute;}
        .stats-card .icon {margin-top:-10px;}
        .calendar-row .main-cols {width:100%; padding:0 15px 0 0 !important;}
        .calendar-row .col-left .row {width:50%; margin-left:0;margin-right:0; float:left;}
        .widget-past-days {margin-right:15px;}
        .data-cols {display:table;}
        .data-cols small {display:block;}
        .data-cols .col {width:100%}
        span.circle {margin:25px 0 14px !important;}
    }

    @media (max-width:767px){ 
        .sidebar-toggle-box {right:0;}
        .clearfix.calendar-row{display:block !important;}       
        .clearfix.calendar-row .col-xs-6{margin-top:20px;padding-right:0px !important;}     
        .clearfix.calendar-row .col-xs-6>div{margin:0 !important;}      
    }

    @media (max-width:567px){
      .stats-row .card-col,
      .calendar-row .col-left .row {width:100% !important}
      #main-content .widget-past-days {margin-right:0 !important;}
      .calendar-row .main-cols.col-left {margin-bottom:30px;}
    }


.data-cols {background:#fff; padding:0; text-align:center; height:470px; /*display:flex;*/}
.data-cols .col {padding:7px 5px; box-shadow:0 10px 40px 0 rgba(62,57,107,.07), 0 2px 9px 0 rgba(62,57,107,.06); width: 100%; height: 147px;}
.data-cols .center-col {border:solid #ECEFF1; border-width:0 1px;}
.data-cols small {display:block;}
.col-xs-4.col.TI {
    height: 175px;
}
.calendar-row .main-cols.col-right {padding-left:30px;}
.calendar-row .main-cols.col-right {padding-left:30px; height:425px; }
#chartAllContract.chartjs-render-monitor{height: 375px !important;}
.company-name :hover{
    color:#009C9F !important;
}
.btn-fill-theme {background:#1fb5ad;color: white;}
.hot-leads-table .btn:hover{
    color: white !important;
    box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.3);
}
.hot-leads-table a:hover{
    color: #1FB5AD !important;
}
#recentWebBookings thead th{ width:25%;}
/*#recentBookings thead th{ width:25%;}*/
#recentWebBookings td {padding: 12.5px 10px;}

#l-info{box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.36);
    padding: 0px;}
.toggle-card-btn {margin-top:8px; display:inline-block; border-radius:25px; font-size:20px; width:20px; height:20px; text-align:center; line-height:20px; cursor:pointer;}
.toggle-card-btn i {
    position: relative;
    left: -4px;
}
.dashboard-one h4{display: inline-block;margin-top: 20px;margin-right: 82%;margin-bottom: 25px;font-weight: bolder;}
.dashboard-one .toggle-card-btn{float: right;margin-top: 20px;margin-right: 12px;border: 2px solid #ff6b68; width: 24px; height: 24px;}
.dashboard-two h4{display: inline-block;margin-top: 20px;margin-bottom:25px;margin-right: 78%;font-weight: bolder;}
.dashboard-two .toggle-card-btn{float: right;margin-top: 20px;margin-right: 12px;border: 2px solid #fe832c; width: 24px; height: 24px;}
.dashboard-two .toggle-card-btn i {color:#fe832c;}
.dashboard-third h4{display: inline-block;margin-top: 20px;margin-bottom:25px;margin-right: 86%;font-weight: bolder;}
.dashboard-third .toggle-card-btn{float: right;margin-top: 20px;margin-right: 12px;border: 2px solid #404E67; width: 24px; height: 24px;}
.dashboard-third .toggle-card-btn i {color:#404E67;}
.dashboard-third_three h4{display: inline-block;margin-top: 20px;margin-bottom:25px;margin-right: 86%;font-weight: bolder;}
.dashboard-third_three .toggle-card-btn{float: right;margin-top: 20px;margin-right: 5px;border: 2px solid #404E67; width: 24px; height: 24px;}
.dashboard-third_three .toggle-card-btn i {color:#404E67;}
.dashboard-forth h4{display: inline-block;margin-top: 20px;margin-bottom:25px;margin-right: 86%;font-weight: bolder;}
.dashboard-forth .toggle-card-btn{float: right;margin-top: 20px;margin-right: 12px;border: 2px solid #404E67; width: 24px; height: 24px;}
.dashboard-forth .toggle-card-btn i {color:#404E67;}
.dashboard-fifth h4{display: inline-block;margin-top: 20px;margin-bottom:25px;margin-right: 80%;font-weight: bolder;}
.dashboard-fifth .toggle-card-btn{float: right;margin-top: 20px;margin-right: 12px;border: 2px solid #404E67; width: 24px; height: 24px;}
.dashboard-fifth .toggle-card-btn i {color:#404E67;}
#modalOwnerUpdate .modal-header, #addFavoriteListModal .modal-header  { background: #1eb5ad; color:white; }
#modalOwnerUpdate .close,#addFavoriteListModal .close { color: white; opacity:1; }
#modalOwnerUpdate .modal-title ,#addFavoriteListModal .modal-title, #modalOwnerUpdate label { font-weight:550; }
.bulk_action{background-color: #204d74 !important;color: white !important}
.hot-btn-group{padding: 8px}
.dtnotes:not(:first-child) {
    padding: 6px;
    padding-left: 78px;
}
.dtnotes{
    display: inline-block;
}
#recentBookings tr:nth-child(even), #recentWebBookings tr:nth-child(even){background-color: 
    #F5F5F5;}
.archived{
    margin-left: 15px;
    border-radius: 4px;
    background: white;
    margin-top: 8px;
}
.restore{
    margin-left: 10px;
    display: none;
}
.chart-container .select2-container{
    width:100% !important; 
}
.chart-container .select2-container--default .select2-selection--multiple,.chart-container .select2-container--default.select2-container--focus .select2-selection--multiple{
    border: 1px solid #e2e2e4 !important;
}
.team{text-align: center;margin-bottom: 20px}
#compare{ margin-top: 20px}
#compare-chart{height: 500px;overflow: auto;}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #48b5ac;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
  position: absolute;
  top: 130px;
  left: 45%;
  display: none;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
#openerData{
margin-top: 22px; margin-left: -21px;background-color: #1EB5B1;border-color: #1EB5B1;
}
#openerData:hover{color: #fff;background-color: #1eb5ad;border-color: #1eb5ad;}
#closerData{margin-top: 22px; margin-left: -21px;background-color: #1EB5B1;border-color: #1EB5B1;}
#closerData:hover{color: #fff;background-color: #1eb5ad;border-color: #1eb5ad;}
.modal-footer .btn-default{background-color: #c7cbd6;border-color: #c7cbd6;color: white;}
.modal-footer .btn-success{background-color: #1eb5ad;border-color: #1eb5ad;}
 .content-title{background: #FEF9F5;border-bottom:0px solid !important;}
 .dashboard-one{background: #FFF6F7};
 #reminders.reminder-btn {color: initial !important;background-color: initial !important;}
.reminder-btn {font-size: 18px;margin: 0 -15px;}
.reminder-item {display:flex; padding:6px 12px; border-bottom:2px solid #e0e0e0;}
 #reminders.reminder-btn {color: initial !important;background-color: initial !important;}
 .ui-timepicker-container{ z-index:9999 !important; }
 .no-reminder{display: none;}
 .no-reminder-count{display: none;}

 #recentWebBookings tbody td ,#recentBookings tbody td ,#hot-leads tbody td , #dead-leads tbody td ,#hot-clients tbody td ,#hot-leads-archived  tbody td,#hot-clients-archived tbody tr,#dead-leads-archived tbody tr
 { white-space: nowrap; }

 #fullCalModal span.close-modal:before {
    content: "";
    width: 18px;
    height: 2px;
    position: absolute;
    background: #5f6368;
    transform: rotate(45deg);
    top: 19px;
}
#fullCalModal span.close-modal:after {
    content: "";
    width: 18px;
    height: 2px;
    position: absolute;
    transform: rotate(-45deg);
    background: #5f6368;
    top: 19px;
    left: 18px;
}
#fullCalModal span.close-modal:before , #eventViewModal   span.close-modal:before{top: 18px;left: 11px;}
#fullCalModal span.close-modal:after ,#eventViewModal span.close-modal:after{top: 18px;left: 11px}
#eventViewModal .invited_dv{max-height: 145px;overflow: auto;
}
#fullCalModal .modal-header .icons-plot {width:50%;}#fullCalModal .title {width:45%;
border-bottom: 1px solid #f1f3f4 !important;display: inline-block;height: 50px}
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
#fullCalModal .modal-header {
    background: #fff;
    color: #333;
    border-radius: 0;
    padding: 0;
    border: 0px;
}
.edit-title {
    font-size: 22px;
    padding: 0px;
}

.tab-title {display: none;}
.edit-title {
    font-size: 22px;
    padding: 0px;
}
.service-box span {
    font-size: 1.6rem;
    margin-bottom: 8px;
    display: inline-block;
    margin-top: 1px;
}
.event-div {
    margin-top: 0px;
    margin-left: -40px;
}
.address-icon {
    font-size: 15px;
    padding: 0px;
    margin-left: 15px;
}
.service-box .field-col {
    float: left;
    width: 65%;
}
.event-address {
    padding: 0px;
    font-size: 14px;
    margin-left: -45px;
}
.service-box span {
    font-size: 1.6rem;
    margin-bottom: 8px;
    display: inline-block;
    margin-top: 1px;
}
.edit-modal-width {
    max-width: 100%;
    width: 448px;
}
.eventView-row {padding:8px 15px; margin-top: 5px;}
.eventView-row .custom-row label {padding:0 7px; display:inline-block; float:left;}
.eventView-row.col-6 {width: 50%;float: left;}
.eventView-row.row .fs-label{font-weight: 700 !important;
    color: #767676 !important;line-height: 35px;padding: 0 10px;font-size: 13px;}

.icons-plot .hover-title {position:absolute; bottom:-22px; left:-6px; color:#fff; padding:4px 10px; line-height:normal; font-size:14px; background:#5f6368; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
.icons-plot .icon:hover .hover-title {bottom:-30px; opacity:1;}

.hot-leads-table .table>thead>tr>th{padding-left: 18px}    
.rem-booking{margin: 0px !important}
.book-href{
    color: grey;
    font-weight: bold;
}
.book-href:hover{
    color: #1FB5AD;
}
</style>


<?php //echo $monthly_bookings; die('in');?> 
<!--main content start-->
<section id="main-content">
    <section class="wrapper" style="color: #767676;font-size: small;">

		<div class="row stats-row">
		
		<div class="col-xs-12" style="margin-bottom:30px;">
			<div class="row">
				<div class="col-xs-6 col-lg-3 card-col">
				  <div class="stats-card blue clearfix">
					<div class="left-col">
					  <i class="icon icon-crm-calendar" style="font-size:40px;"></i>
					</div>
					<div class="right-col">
					  <h3 class="count"><?php echo !empty($bookingsInWeek) ? sprintf("%02d",$bookingsInWeek) : 0; ?></h3>
					  <span class="title">Bookings</span>
					  <span>This Week</span>
					</div>
				  </div> <!-- /.stats-card -->
				</div> <!-- /.col -->

				<div class="col-xs-6 col-lg-3 card-col">
				  <div class="stats-card red-pink clearfix">
					<div class="left-col">
					  <i class="icon icon-crm-user-out"></i>
					</div>
					<div class="right-col">
					  <h3 class="count"><?php echo !empty($leadsInWeek)  ? sprintf("%02d",$leadsInWeek) : 0; ?></h3>
					  <span class="title">Leads</span>
					  <span>This Week</span>
					</div>
				  </div> <!-- /.stats-card -->
				</div> <!-- /.col -->

				<div class="col-xs-6 col-lg-3 card-col">
				  <div class="stats-card yellow clearfix">
					<div class="left-col">
					  <i class="icon icon-crm-add-user-1"></i>
					</div>
					<div class="right-col">
					  <h3 class="count"><?php echo !empty($clientsInWeek) ? sprintf("%02d",$clientsInWeek) : 0; ?></h3>
					  <span class="title">Clients</span>
					  <span>This Week</span>
					</div>
				  </div> <!-- /.stats-card -->
				</div> <!-- /.col -->

				<div class="col-xs-6 col-lg-3 card-col">
				  <div class="stats-card green clearfix">
					<div class="left-col">
					  <i class="icon icon-crm-bill"></i>
					</div>
					<div class="right-col">
					  <h3 class="count"><?php echo !empty($contractsInWeek) ? sprintf("%02d", $contractsInWeek) : 0; ?></h3>
					  <span class="title">Contracts</span>
					  <span>This Week</span>
					</div>
				  </div> <!-- /.stats-card -->
				</div> <!-- /.col -->
			</div>

		</div>			
	</div>
	
	<!-- RECENT BOOKING -->
	
 <div class="hero-row top-border" style="border-top: 5px solid #ff6b68;">

      <div id="l-info" class="collapsible-card card ch" style="height: 100%;">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-dashboard-one" style="">
            <div class="col calendar-header dashboard-one">
               <span> <h4>Recent Bookings</h4></span>          
              <span class="toggle-card-btn">
                <i class="icon-crm-angle-up"></i>
              </span>
              
            </div>
          </div>

    <div id="collapse-dashboard-one" class="card-content collapse in row" style="margin-left: 0px;margin-right: 0px;">

    <div class="clearfix calendar-row" style="height: 100% !important">
        <div id="rec-bookings" class="collapse in"  style="background:#fff;">
            <div class="table-responsive">
                 <div class="btn-group hot-btn-group">
                    <button class="btn dropdown-toggle bulk_action" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                     <ul class="dropdown-menu">
                        
                     <li><a class="module_head mass_book_delete" data-id='book_del' href="javascript:;">Mass Delete</a></li>
                    
                    </ul>
                  </div>

                <table style="width: 100%;margin-bottom: 0px;" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline" id="recentBookings">
                <thead>
                   <tr>
                    <th class="all">
                        <label style="cursor:pointer;">
                            <input type="checkbox" onclick="selectAll('recentBookings')" style="position:absolute; opacity:0;" />
                            <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                        </label>
                    </th> 
                    <th class="all"></th>
                    <th nowrap class="all">Status</th>
                    <th nowrap class="all">Booking Title</th>
                    <th nowrap class="all">Booking Date</th>
                    <th nowrap class="all">Company Name</th>
                    <th nowrap class="all">Name</th>
                    <th nowrap class="all">Phone</th>                  
                    <th nowrap class="all">Email</th>
                    <th nowrap class="all">City</th>
                    <th nowrap class="all">State</th>
                    <th nowrap class="all">Country</th>
                    <th nowrap class="all">Opener Name</th>
                    <th nowrap class="all">Closer Name</th>
                    <th nowrap class="all">Last Modified</th>
                    <th nowrap class="all">Last Modified By</th>
                    <th class="none">Notes</th>

                   </tr> 
                </thead>
                <tbody>
                    
                </tbody>       
</table>
          </div>
       </div>
     </div>  
</div></div></div>
<!-- RECENT BOOKING END -->
     
<!-- Start -->
     <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
        <div class="col-xs-6 main-cols col-left">
            <div style="margin-left:-15px;">
              <div style="background:#fff;border-top: 5px solid #fe832c;">
                <div class="content-title">Leads<span style="margin-left: 30%;"> Opener</span> <i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#leads-OP"></i> 
                </div>  
                 <div id="leads-OP" class="collapse in" style="padding-bottom:15px;">
                   <h6 style="text-align:center;" id="total_lead_number"> </h6>
                    <canvas id="leadChart"></canvas> 
                    <h6 style="text-align:center;" id="total_unassign_lead_number"> </h6>
                 </div>
              </div>
            </div>
        </div>
        <div class="col-xs-6 main-cols">
            <div style="margin-right:-15px;">
              <div style="background:#fff;border-top: 5px solid #fe832c;">
                <div class="content-title">Clients<span style="margin-left: 30%;"> Closer</span> <i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#client-AO"></i> </div> 
                 <div id="client-AO" class="collapse in" style="padding-bottom:15px;">
                      <h6 style="text-align:center;" id="total_client_number"></h6>
                    <canvas id="clientChart"></canvas>
                   <h1 style="text-align:center;height: 5px;"> </h1>

                 </div>
              </div>
            </div>
        </div>
    </div>
    <!-- end -->
         

<!-- start -->

    <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
        <div class="col-xs-6 main-cols col-left">
            <div style="margin-left:-15px;">
              <div style="background:#fff;border-top: 5px solid #fe832c;">
                <div class="content-title">LEAD BOOKING<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#lead-OP"></i> </div>                     
                 <div id="lead-OP" class="collapse in">
                    <div class="text-center user_select">
                      <div class="col-xs-6">
                      <label style="color: #767676;font-size: 13px;">Select Opener</label>  
                          <!-- <select id="opener" onchange="compareChart('c-container-first','chartUser1')"> -->
                           <select id="opener" onchange="getbookings(this, 'leadconversion', '#openertarget')" data-module = '1'>
                           
                            <?php if(!empty($opener_data))
                            {
                                foreach ($opener_data as $key => $user) {
                            ?> 
                            <option value="<?php echo $user['id']?>"> <?php echo $user['first_name'].' '.  $user['last_name'] ?></option> 

                            <?php   
                             }
                            }?>
                            <!-- <option value="<?php echo base_url().'dashboard/charComparison?&user_id='.$user["id"].'&user_role_id='.$user["role_id"];?>" <?php echo array_rand($users) == $key ? 'selected':'';?>><?php echo isset($user['first_name']) ? $user['first_name'] :'';?><?php echo isset($user['last_name']) ? ' '.$user['last_name'] :'';?>
                              </option> -->
                          </select>
                       </div>     
                        <div class="col-xs-4">
                            <label style="color: #767676;font-size: 13px;">Select Limit</label>  
                          <!-- <select id="opener" onchange="compareChart('c-container-first','chartUser1')"> -->
                          <div class='input-group date datetimepicker' >
                                <input type='text' class="form-control" id="openertarget"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
                                </span>
                            </div>                            
                       </div>
                       <div class="col-xs-2"><button class="btn btn-success" id="openerData" style="margin-top: 22px; margin-left: -21px;">Get Data</button> </div>    
                    </div>
                     <!-- <h5 style="text-align:center; padding-left:0px;">Total Opener <?php echo count($opener_data); ?></h5> -->
                    <canvas id="leadconversion"></canvas> 
                   
                 </div>
              </div>
            </div>
        </div>
        <div class="col-xs-6 main-cols">
            <div style="margin-right:-15px;">
              <div style="background:#fff;border-top: 5px solid #fe832c;">
                <div class="content-title">CLIENT BOOKING<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#client-c-AO"></i> </div>                     
                 <div id="client-c-AO" class="collapse in">
                    <div class="text-center user_select">
                        <div class="col-xs-6">
                          <label style="color: #767676;font-size: 13px;">Select Closer</label>  
                              <!-- <select id="closer" onchange="compareChart('c-container-first','chartUser1')"> -->
                               <select id="closer" onchange="getbookings(this, 'clientconversion', '#closertarget')" data-module = '2'>
                              
                                <?php if(!empty($closer_data))
                                {
                                    foreach ($closer_data as $key => $user) {
                                ?>  
                                <option value="<?php echo $user['id']?>"> <?php echo $user['first_name'].' '.  $user['last_name'] ?></option> 
                                <?php   
                                 }
                                }?>
                                           <!--<option value="<?php echo base_url().'dashboard/charComparison?&user_id='.$user["id"].'&user_role_id='.$user["role_id"];?>" <?php echo array_rand($users) == $key ? 'selected':'';?>><?php echo isset($user['first_name']) ? $user['first_name'] :'';?><?php echo isset($user['last_name']) ? ' '.$user['last_name'] :'';?>
                                  </option> -->
                              </select>
                          </div>
                          <div class="col-xs-4">
                            <label style="color: #767676;font-size: 13px;">Select Limit</label>  
                          <!-- <select id="opener" onchange="compareChart('c-container-first','chartUser1')"> -->
                          <div class='input-group date datetimepicker' >
                                <input type='text' class="form-control" id="closertarget"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar">
                                    </span>
                                </span>
                            </div>                            
                       </div>
                       <div class="col-xs-2"><button class="btn btn-success" id="closerData" >Get Data</button> </div>    
                          <!--  <h5 style="text-align:center;padding-left: 80px;">Total Closer <?php echo count($closer_data) ; ?></h5> -->
                    </div>
                    <canvas id="clientconversion"></canvas>
                     
                 </div>
              </div>
            </div>
        </div>
    </div>



<!-- end -->

 <div class="hero-row top-border" style="border-top: 5px solid #FE832C;margin-top: 50px;">

  <div id="l-info" class="collapsible-card card ch" style="height: 100%;">

      <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#compare-div" style="">
        <div class="col calendar-header dashboard-two" style="background:#FEF9F5;">
           <span style="color:#FB812B;"> <h4 style="margin-right:82%">Opening Target</h4></span> 
           <span class="toggle-card-btn">
            <i class="icon-crm-angle-up"></i>
          </span>
        </div>
      </div>
       <div id="compare-div" class="card-content collapse in row" style="background: #fff;margin-left: 0px;margin-right: 0px;">   				
				<div style="overflow: auto; min-height: 350px; height: 350px;">
				<form id="record_list_table">

					<!-- <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->
					<canvas id="chartOpener" style="height: 300px; width: 100%;"></canvas>
						
				</form>
				</div>
		</div>
   </div> 
</div>	
		
    
<!-- start -->
<!-- <div class="mini_graph" style="margin-top: 500px">
<div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
        <div class="col-xs-6 main-cols" style="float: none !important;">
            <div style="margin-left:-15px;">
              <div style="background:#fff;">
                <div class="content-title">ALL OPENERS MONTHLY TARGET<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#stats-OP"></i> </div>                     
                 <div id="stats-OP" class="collapse in">
                    <canvas id="chartAllOpener"></canvas> 
                 </div>
              </div>
            </div>
        </div>
        <div class="col-xs-6 main-cols" style="float: none !important;">
            <div style="margin-right:-15px;">
              <div style="background:#fff;">
                <div class="content-title">ALL CLOSERS MONTHLY TARGET<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#stats-AO"></i> </div>                     
                 <div id="stats-AO" class="collapse in">
                    <canvas id="chartAllCloser"></canvas>
                 </div>
              </div>
            </div>
        </div>
    </div>
</div> -->
<!-- end -->


		
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

 <input type="hidden" name="record_id" class="all_records" value=""/>
    
<div class="hero-row top-border" style="border-top: 5px solid #404E67;margin-top: 50px;">

      <div id="l-info" class="collapsible-card card ch" style="height: 100%;">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-dashboard-third" style="">
            <div class="col calendar-header dashboard-third">
               <span> <h4 style="color: #404E67">Hot Leads</h4></span> 
               <span class="toggle-card-btn">
                <i class="icon-crm-angle-up"></i>
              </span>
            </div>
          </div>

    <div id="collapse-dashboard-third" class="card-content collapse in row" style="margin-left: 0px;margin-right: 0px;">

    <div class="hot-leads-table" style="margin-top: 0px;padding-top: 0px;">

            <select class="archived" data-id='hot-leads'>
                  <option  value="active">Active</option>
                  <option  value="archived">Archived</option>
              </select>

            <button class="btn bulk_action restore" data-id="hot-leads-archived"> 
             Restore&nbsp;&nbsp;<i class="fa fa-refresh"></i></button> 
              
            <div class="btn-group hot-btn-group">
                <button class="btn dropdown-toggle bulk_action" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                 <ul class="dropdown-menu">
                    <li><a class="module_head" data-toggle="modal" href="#modalOwnerUpdateHotLeads">Mass assign</a></li>
                 <li><a class="module_head mass_unfollow" data-id='hot-leads' href="javascript:;">Mass Unfollow</a></li>
                 <?php if($this->session->userdata('role_id') == 1){ ?>
                 <li><a class="module_head mass_delete" data-id='hot-leads' href="javascript:;">Mass Delete</a></li>
                <?php } ?>
                </ul>
              </div>

    <div class="table-responsive hot_leads">
        
          <table id="hot-leads" style="margin-bottom: 0px;" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                    <thead>
                      <tr>
                        <th class="all">
                                      <label style="cursor:pointer;">
                                          <input type="checkbox" onclick="selectAll('hot-leads')" style="position:absolute; opacity:0;" />
                                          <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                                      </label>
                                  </th>
                                  <th class="all"></th>
                                  <th class="all" nowrap>Company Name</th>
                                  <th class="all" nowrap>First Name</th>
                                  <th class="all" nowrap>Last Name</th>
                                  <th class="all" nowrap>Phone</th>
                                  <th class="all" nowrap>City</th>
                                  <th class="all" nowrap>Province</th>
                                  <th class="all" nowrap>Country</th>
                                  <th class="all" nowrap>Lead Category</th>   
                                  <th class="all" nowrap>Lead Status</th> 
                                  <th class="all" nowrap>Call Status</th>
                                  <th class="all" nowrap>Opener</th> 
                                  <th class="all" nowrap>Closer</th> 
                                  <th class="all" nowrap>Last Modified</th>
                                  <th class="all" nowrap>Last Modified By</th>
                                  <th class="none">Notes</th>
                                  <th class="none">Action</th> 
                                   
                              </tr>
                 </thead>
                <tbody>
               
                </tbody>
        </table>
    </div>
    <div class="table-responsive hot_leads_archived" style="display: none">
	
            <table id="hot-leads-archived" style="margin-bottom: 0px;display: none" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                        <th class="all">
                            <label style="cursor:pointer;">
                                <input type="checkbox" onclick="selectAll('hot-leads-archived')" style="position:absolute; opacity:0;" />
                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                            </label>
                        </th>
                          <th class="all"></th>
                          <th class="all" nowrap>Company Name</th>
                          <th class="all" nowrap>First Name</th>
                          <th class="all" nowrap>Last Name</th>
                          <th class="all" nowrap>Phone</th>
                          <th class="all" nowrap>City</th>
                          <th class="all" nowrap>Province</th>
                          <th class="all" nowrap>Country</th>
                          <th class="all" nowrap>Lead Category</th>   
                          <th class="all" nowrap>Lead Status</th> 
                          <th class="all" nowrap>Call Status</th>
                          <th class="all" nowrap>Opener</th> 
                          <th class="all" nowrap>Closer</th> 
                          <th class="all" nowrap>Last Modified</th>
                          <th class="all" nowrap>Last Modified By</th>
                          <th class="none">Notes</th>
                          <th class="none">Action</th> 
                           
                      </tr>
                </thead>
                <tbody>
               
                </tbody>
            </table>
    	</div>
    </div>

</div></div></div>

<!-- Hot Clients -->


<div class="hero-row top-border" style="border-top: 5px solid #404E67;margin-top: 50px;">

      <div id="l-info" class="collapsible-card card ch" style="height: 100%;">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-dashboard-hot-clients" style="">
            <div class="col calendar-header dashboard-third">
               <span> <h4 style="color: #404E67">Hot Clients</h4></span> 
               <span class="toggle-card-btn">
                <i class="icon-crm-angle-up"></i>
              </span>
            </div>
          </div>

    <div id="collapse-dashboard-hot-clients" class="card-content collapse in row" style="margin-left: 0px;margin-right: 0px;">

    <div class="hot-leads-table" style="margin-top: 0px;padding-top: 0px;">

            <select class="archived" data-id='hot-clients'>
                  <option  value="active">Active</option>
                  <option  value="archived">Archived</option>
              </select>
              <button class="btn bulk_action restore" data-id="hot-clients-archived"> 
             Restore&nbsp;&nbsp;<i class="fa fa-refresh"></i></button> 
            <div class="btn-group hot-btn-group">
                <button class="btn dropdown-toggle bulk_action" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                <ul class="dropdown-menu">
                <li><a class="module_head" data-toggle="modal" href="#modalCloserUpdate">Mass assign</a></li> 
                 <li><a class="module_head mass_cunfollow" data-id='hot-clients' href="javascript:;">Mass Unfollow</a></li>
                 <?php if($this->session->userdata('role_id') == 1){ ?>
                 <li><a class="module_head mass_delete" data-id='hot-clients' href="javascript:;">Mass Delete</a></li>
                 <?php } ?>
                </ul>
              </div>

           <div class="table-responsive hot_clients">  

               <table id="hot-clients" style="margin-bottom: 0px;" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                        <th class="all">
                            <label style="cursor:pointer;">
                                <input type="checkbox" onclick="selectAll('hot-clients')" style="position:absolute; opacity:0;" />
                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                            </label>
                        </th>
                        <th class="all"></th>
                        <th class="all" nowrap>Company Name</th>
                        <th class="all" nowrap>First Name</th>
                        <th class="all" nowrap>Last Name</th>
                        <th class="all" nowrap>Phone</th>
                        <th class="all" nowrap>City</th>
                        <th class="all" nowrap>Province</th>
                        <th class="all" nowrap>Country</th>
                        <th class="all" nowrap>Category</th>
                        <th class="all" nowrap>Client Status</th> 
<!--                         <th class="all" nowrap>Call Status</th> 
 -->                    <th class="all" nowrap>Opener Name</th>    
                        <th class="all" nowrap>Closer Name</th>    
                        <th class="all" nowrap>Last Modified</th>    
                        <th class="all" nowrap>Last Modified By</th>    
                        <th class="none">Notes</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
          </div>
      <div class="table-responsive hot_clients_archived"  style="display: none">  
  
              <table id="hot-clients-archived" style="margin-bottom: 0px;display: none" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                        <th class="all">
                            <label style="cursor:pointer;">
                                <input type="checkbox" onclick="selectAll('hot-clients-archived')" style="position:absolute; opacity:0;" />
                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                            </label>
                        </th>
                        <th class="all"></th>
                        <th class="all" nowrap>Company Name</th>
                        <th class="all" nowrap>First Name</th>
                        <th class="all" nowrap>Last Name</th>
                        <th class="all" nowrap>Phone</th>
                        <th class="all" nowrap>City</th>
                        <th class="all" nowrap>Province</th>
                        <th class="all" nowrap>Country</th>
                        <th class="all" nowrap>Category</th>
                        <th class="all" nowrap>Client Status</th> 
<!--                         <th class="all" nowrap>Call Status</th> 
 -->                    <th class="all" nowrap>Opener Name</th>    
                        <th class="all" nowrap>Closer Name</th>    
                        <th class="all" nowrap>Last Modified</th>    
                        <th class="all" nowrap>Last Modified By</th>    
                        <th class="none">Notes</th>
                    </tr>
                </thead>
                <tbody>
   
                </tbody>
            </table>
        </div>
    </div>

</div></div></div>


<!-- HOt Contracts-->


<div class="hero-row top-border" style="border-top: 5px solid #404E67;margin-top: 50px;">

      <div id="l-info" class="collapsible-card card ch" style="height: 100%;">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-dashboard-hot-contracts" style="">
            <div class="col calendar-header dashboard-third_three">
               <span> <h4 style="color: #404E67">Hot Contracts</h4></span> 
               <span class="toggle-card-btn">
                <i class="icon-crm-angle-up"></i>
              </span>
            </div>
          </div>

    <div id="collapse-dashboard-hot-contracts" class="card-content collapse in row" style="margin-left: 0px;margin-right: 0px;">

    <div class="hot-leads-table" style="margin-top: 0px;padding-top: 0px;">

               <select class="archived" data-id='hot-contracts'>
                  <option  value="active">Active</option>
                  <option  value="archived">Archived</option>
              </select>
              <button class="btn bulk_action restore" data-id="hot-contracts-archived"> 
             Restore&nbsp;&nbsp;<i class="fa fa-refresh"></i></button>
            <div class="btn-group hot-btn-group">
                <button class="btn dropdown-toggle bulk_action" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                <ul class="dropdown-menu">
                 <li><a class="module_head" data-toggle="modal" href="#modalOwnerContractUpdate">Mass assign</a></li>
                 <li><a class="module_head mass_cunfollow" data-id='hot-contracts' href="javascript:;">Mass Unfollow</a></li>
                 <?php if($this->session->userdata('role_id') == 1){ ?>
                 <li><a class="module_head mass_delete" data-id='hot-contracts' href="javascript:;">Mass Delete</a></li>
                 <?php } ?>
                </ul>
              </div>

        <div class="table-responsive hot_contracts">
   
              <table id="hot-contracts" style="margin-bottom: 0px;" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                        <th class="all">
                            <label style="cursor:pointer;">
                                <input type="checkbox" onclick="selectAll('hot-contracts')" style="position:absolute; opacity:0;" />
                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                            </label>
                        </th>
                        <th class="all"></th>
                        <th class="all" nowrap>Company Name</th>
                        <th class="all" nowrap>Master Contract Number</th>
                        <th class="all" nowrap>Contract Number</th>
                        <th class="all" nowrap>Service Type</th>
                        <th class="all" nowrap>Signing Rate</th>
                        <th class="all" nowrap>Closing Date</th>
                        <th class="all" nowrap>Assigned Date</th>
                        <th class="all" nowrap>Category</th>
                        <th class="all" nowrap>Contract Status</th>
                        <th class="all" nowrap>Call Status</th>
                        <th class="all" nowrap>Closer Name</th>
                        <th class="all" nowrap>Technical Consultant</th> 
                        <th class="all" nowrap>Technical Start Date</th> 
                        <th class="all" nowrap>Completed Date</th>
                        <th class="all" nowrap>Last Modified</th>   
                        <th class="all" nowrap>Last Modified By</th>
                        <th class="none">Notes</th>
   
                    </tr>
                </thead>
                <tbody>
               
                </tbody>
            </table>
        </div>    
        <div class="table-responsive hot_contracts_archived"  style="display: none">

            <table id="hot-contracts-archived" style="margin-bottom: 0px;display: none;" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                        <th class="all">
                            <label style="cursor:pointer;">
                                <input type="checkbox" onclick="selectAll('hot-contracts-archived')" style="position:absolute; opacity:0;" />
                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                            </label>
                        </th>
                        <th class="all"></th>
                        <th class="all" nowrap>Company Name</th>
                        <th class="all" nowrap>Master Contract Number</th>
                        <th class="all" nowrap>Contract Number</th>
                        <th class="all" nowrap>Service Type</th>
                        <th class="all" nowrap>Signing Rate</th>
                        <th class="all" nowrap>Closing Date</th>
                        <th class="all" nowrap>Assigned Date</th>
                        <th class="all" nowrap>Category</th>
                        <th class="all" nowrap>Contract Status</th>
                        <th class="all" nowrap>Call Status</th>
                        <th class="all" nowrap>Closer Name</th>
                        <th class="all" nowrap>Technical Consultant</th> 
                        <th class="all" nowrap>Technical Start Date</th> 
                        <th class="all" nowrap>Completed Date</th>
                        <th class="all" nowrap>Last Modified</th>   
                        <th class="all" nowrap>Last Modified By</th>
                        <th class="none">Notes</th>
   
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>

</div></div></div>

<!-- Modal Owner Update -->
<div class="modal fade" id="modalOwnerUpdateHotLeads" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Select new record opener</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                    <label>New Opener *</label>
                                    <select name="__0" id="Lead_0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                            <?php foreach ($users_list as $option_key => $option) {
                                                if($option['role_id'] == 3){ ?>
                                                    <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                            <?php } } ?>
                                    </select>
                                    <script type="text/javascript">
                                            $(document).ready(function() {
                                                   $("#Lead_0").select2();
                                            });
                                    </script>
                            </div>
                            <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                            <button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change opener of','hot-leads');" type="button">Confirm</button>
                    </div>
            </div>
    </div>
</div>
<div class="modal fade" id="modalOwnerUpdateDeadLeads" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Select new record opener</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                    <label>New Opener *</label>
                                    <select name="__0" id="dead_0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                            <?php foreach ($users_list as $option_key => $option) {
                                                if($option['role_id'] == 3){ ?>
                                                    <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                            <?php } } ?>
                                    </select>
                                    <script type="text/javascript">
                                            $(document).ready(function() {
                                                    $("#dead_0").select2();
                                            });
                                    </script>
                            </div>
                            <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                            <button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change opener of','dead-leads');" type="button">Confirm</button>
                    </div>
            </div>
    </div>
</div>
<!-- modalCloserUpdate -->
                        <div class="modal fade" id="modalCloserUpdate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Select new record closer</h4>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                                            <label>New Closer *</label>
                                                            <select name="__0" id="Client_0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                                                    <?php foreach ($users_list as $option_key => $option) {
                                                                            if($option['role_id'] == 4){ ?>
                                                                            <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                                                    <?php } } ?>
                                                            </select>
                                                            <script type="text/javascript">
                                                                    $(document).ready(function() {
                                                                            $("#Client_0").select2();
                                                                    });
                                                            </script>
                                                    </div>
                                                    <div class="clearfix"></div>
                                            </div>
                                            <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                                                    <button class="btn btn-success" onclick="bulkActionOnClient('mOwner','change closer of','hot-clients');" type="button">Confirm</button>
                                            </div>
                                    </div>
                            </div>
                        </div>
                        <!-- modalCloserUpdate -->

<!-- modalContractUpdate -->
                        <div class="modal fade" id="modalOwnerContractUpdate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Select new record closer</h4>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                                            <label>New Technical Consultant *</label>
                                                            <select name="__0" id="Contract_0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                                                    <?php foreach ($users_list as $option_key => $option) {
                                                                            if($option['role_id'] == 5){ ?>
                                                                            <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                                                    <?php } } ?>
                                                            </select>
                                                            <script type="text/javascript">
                                                                    $(document).ready(function() {
                                                                            $("#Contract_0").select2();
                                                                    });
                                                            </script>
                                                    </div>
                                                    <div class="clearfix"></div>
                                            </div>
                                            <div class="modal-footer">
                                                    <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                                                    <button class="btn btn-success" onclick="bulkActionOnContract('cOwner','change Technical Consultant of','hot-contracts');" type="button">Confirm</button>
                                            </div>
                                    </div>
                            </div>
                        </div>
<!-- modalContractUpdate -->
 
<!-- Reminder model -->

<div class="modal fade" id="reminder-modal" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Reminders</h4>
          </div>
          <div class="modal-body">
            <?php require_once 'reminder.php';?>
          </div>
          <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          </div>
      </div>
  </div>
</div>


<div class="hero-row top-border" style="border-top: 5px solid #404E67;margin-top: 50px;">

      <div id="l-info" class="collapsible-card card ch" style="height: 100%;">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-dashboard-forth" style="">
            <div class="col calendar-header dashboard-forth">
               <span> <h4 style="color: #404E67">Dead Leads</h4></span>          
              <span class="toggle-card-btn">
                <i class="icon-crm-angle-up"></i>
              </span>
            </div>
          </div>

    <div id="collapse-dashboard-forth" class="card-content collapse in row" style="margin-left: 0px;margin-right: 0px;">

    <div class="hot-leads-table" style="margin-top: 0px;padding-top: 0px;">

             <select class="archived" data-id='dead-leads'>
                  <option  value="active">Active</option>
                  <option  value="archived">Archived</option>
              </select>
            <button class="btn bulk_action restore" data-id="dead_leads_archived"> 
             Restore&nbsp;&nbsp;<i class="fa fa-refresh"></i></button>
            <div class="btn-group hot-btn-group">
                <button class="btn dropdown-toggle bulk_action" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                <ul class="dropdown-menu">
                   <!--  <li><a class="module_head mass_unfollow" data-id='dead-leads' href="javascript:;">Mass Unfollow</a></li> -->
                   <li><a class="module_head" data-toggle="modal" href="#modalOwnerUpdateDeadLeads">Mass assign</a></li>
                 <?php if($this->session->userdata('role_id') == 1){ ?>  
                 <li><a class="module_head mass_delete" data-id='dead-leads' href="javascript:;">Mass Delete</a></li>
                 <?php } ?>
                </ul>
              </div>

                <div class="table-responsive" >
      
                <table id="dead-leads" style="margin-bottom: 0px;" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                        <th class="all">
                            <label style="cursor:pointer;">
                                <input type="checkbox" onclick="selectAll('dead-leads')" style="position:absolute; opacity:0;" />
                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                            </label>
                        </th>
                        <th class="all"></th>
                        <th class="all" >Company Name</th>
                        <th class="all" >First Name</th>
                        <th class="all" >Last Name</th>
                        <th class="all" >Phone</th>
                        <th class="all" >City</th>
                        <th class="all" >Province</th>
                        <th class="all" >Country</th>
                        <th class="all" >Lead Category</th> 
                        
                        <th class="all" >Lead Status</th> 
                        <th class="all" >Call status</th>
                        <th class="all" >Opener</th> 
                        <th class="all" >Closer</th> 
                        <th class="all" nowrap>Last Modified</th>
                        <th class="all">Last Modified By</th>
                        <th class="none">Notes</th>
                        <th class="none">Action</th> 
                         
                    </tr>
                </thead>
                <tbody>
              
                </tbody>
            </table>
        </div>

        <div class="table-responsive" style="display: none">

             <table id="dead-leads-archived" style="margin-bottom: 0px;display: none" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                         <th class="all">
                            <label style="cursor:pointer;">
                                <input type="checkbox" onclick="selectAll('dead-leads-archived')" style="position:absolute; opacity:0;" />
                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                            </label>
                        </th> 
                        <th class="all"></th>
                        <th class="all" >Company Name</th>
                        <th class="all" >First Name</th>
                        <th class="all" >Last Name</th>
                        <th class="all" >Phone</th>
                        <th class="all" >City</th>
                        <th class="all" >Province</th>
                        <th class="all" >Country</th>
                        <th class="all" >Lead Category</th>  
                        <th class="all" >Lead Status</th> 
                        <th class="all" >Call status</th>
                        <th class="all" >Opener</th> 
                        <th class="all" >Closer</th> 
                        <th class="all" nowrap>Last Modified</th>
                        <th class="all">Last Modified By</th>
                        <th class="none">Notes</th>
                        <th class="none">Action</th> 
                         
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div></div></div>

<div class="hero-row top-border" style="border-top: 5px solid #404E67;margin-top: 50px;">

      <div id="l-info" class="collapsible-card card ch" style="height: 100%;">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-dashboard-fifth" style="">
            <div class="col calendar-header dashboard-fifth">
               <span> <h4 style="color: #404E67">Last Update Leads</h4></span>          
              <span class="toggle-card-btn">
                <i class="icon-crm-angle-up"></i>
              </span>
            </div>
          </div>

    <div id="collapse-dashboard-fifth" class="card-content collapse in row" style="margin-left: 0px;margin-right: 0px;">

     <div class="hot-leads-table" style="margin-top: 0px;padding-top: 0px;">
        <div class="table-responsive">
            <table id="last-leads" style="margin-bottom: 0px;" class="display new-table data-table table table-striped table-condensed dataTable no-footer collapsed dtr-inline">
                <thead>
                    <tr>
                         <th nowrap class="hide all">Id</th>
                        <th class="all" nowrap>Company Name</th>
                        <th class="all" nowrap>First Name</th>
                        <th class="all" nowrap>Last Name</th>
                        <th class="all" nowrap>Phone</th>
                        <th class="all" nowrap>City</th>
                        <th class="all" nowrap>Province</th>
                        <th class="all" nowrap>Country</th>
                        <th class="all" nowrap>Lead Category</th> 
                        <th class="all" nowrap>Lead Status</th> 
                        <th class="all" nowrap>Call status</th>
                        <th class="all" nowrap>Opener</th> 
                        <th class="all" nowrap>Closer</th> 
                        <th class="all" nowrap>Last Modified By</th>
                        <th class="all" nowrap>Last Modified</th>
                   </tr>
                </thead>
                <tbody>
            
                </tbody>
            </table>
        </div>
    </div>   
</div></div></div>


<!--Booking model -->
<div id="fullCalModal" class="modal fade in" data-backdrop="static" data-keyboard="false" style="padding-left: 8px;">
  <div class="modal-dialog edit-modal-width">
    <div class="modal-content">
      <div class="modal-header">

        <div class="title">
          
        </div>

        <div class="icons-plot">

        <a href="<?php echo base_url('booking?booking_id='.$book['id'])?>" class="icon edit_schedule"><i class="far fa-edit"></i> <span class="hover-title">Edit </span> </a>

         <span class="icon close-modal" data-dismiss="modal"> <span class="hover-title">Close </span> </span>
        </div>
      </div>
      <div id="modalBody" class="modal-body service-box" style="margin-bottom: 14px;">
        <div class="eventView-row col-xs-12 ">
            <div class="col-xs-2 event-icon"><span class="event-color" style="height: 14px;width: 14px;margin-top: 8px;"></span>
            </div>
            <div class="col-xs-11 event-div" style="padding-left: 11px;">
                <div class="jobName col-xs-12 edit-title"></div>
                <div class="startDay col-xs-8" style="padding: 0px;"></div>
<!--                 <div class="endDate col-xs-4" style="padding: 0px;"></div>
 -->            </div>
        </div>
        <div class="eventView-row col-xs-12">
            <div class="col-xs-2 address-icon" style="margin-left: 10px !important;">
              <i class="fas fa-map-marker-alt" aria-hidden="true" style="margin-left: 4px;font-size: 20px;"></i>
<!--                 <i class="material-icons"></i>
 -->            </div>
            <div class="event_location col-xs-10 event-address" style="margin-left:-40px;"></div>
        </div>
        <div class="eventView-row col-xs-12"> 
            <div class="clearfix">
                <div class="col-xs-2 address-icon"><i class="fas fa-user"></i></div>
                <div class="field-col col-xs-10 event-address" style="">
                    <span class="semail" style="margin-bottom: 0px;"></span> <br>
                   <span class="status_book"></span>
                </div></div></div><div class="eventView-row col-xs-12">
                        <div class="col-xs-2 address-icon" style="width: 25px;"><i class="fa fa-bars" aria-hidden="true"></i></div> 
                        <div class="col-xs-8 notes" style="padding:0px;font-size: 14px;"></div>
                    </div>
                    <div class="eventView-row col-xs-12 notification">
                       
                    </div>
                   <div class="tab-title"><span style="margin-left:10px; margin-bottom:0px;">Lead Information</span>
                   </div>
                   <div class="eventView-row col-xs-12">
                    <div class="col-xs-2 address-icon"><i class="fas fa-user-circle"></i>
                    </div> 
                   <div class="tname col-xs-10 event-address">
                   </div>
                   </div>
                   <div class="eventView-row col-xs-12">
                    <div class="col-xs-2 address-icon"><i class="fa fa-envelope"></i>
                    </div> 
                    <div class="rmno col-xs-10 event-address"></div></div><div class="bookingView-row row"><label></label> <span class=""></span></div></div>
    
    </div>
  </div>
</div>

<!-- -->
		
    
	
    </section>
</section>

 <?php 

    // chart opener/closer
        $count = 0;
        $detail = [];
        $lead_count = [];
        foreach ($opener_chart as $value) {
            $count += $value['total'];
            $detail[] = $value['first_name'] ." " . $value['last_name'] ;
            $lead_count[] = $value['total'];
       
        }
        $total_opener_leads = $count;
        $opener_name = $detail;
        $opener_leads = $lead_count;
    //unassign lead
        $unassign = $unassign_lead[0]['total'];  

        $count = 0;
        $detail = [];
        $client_count = [];
        foreach ($closer_chart as $value) {
            $count += $value['total'];
            $detail[] = $value['first_name'] ." " . $value['last_name'] ;
            $client_count[] = $value['total'];
        }
        $total_closer_clients = $count;
        $closer_name = $detail;
        $closer_clients = $client_count;
       
    ?>

<!--main content end-->

<!-- <script type="text/javascript" src="<?php //echo base_url() ?>static/graph/canvasjs.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url() ?>static/graph/canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script src="<?php echo base_url()?>static/js/chartjs-plugin-labels.min.js"></script>
<script src="<?php echo base_url()?>static/js/utils.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
$('.datetimepicker').datetimepicker({
                viewMode: 'months',
                format: 'YYYY/MM'
            });
window.onload = function () {	
	
// 	 var chart = new CanvasJS.Chart("chartContainer", {
// 			title: {
// 				text: "Target: <?php echo $own_data['monthly_target']; ?>"
// 			},
// 		 	axisY: {
// 				title: "Bookings",
// 				titleFontSize: 15
// 			},
// 		 	axisX: {
// 				title: "Month",
// 				titleFontSize: 15
// 			},
// 			data: [
// 			{
// 					type: "column",
// 					dataPoints:<?php echo $monthly_bookings; ?>
// 			}
// 			]
// 		});

// 		chart.render();

// }
var booking = new Array();
var myChart;
var chart_background = [
               // 'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ];



/*var ctx = document.getElementById('chartAllCloser').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $closer_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $monthly_target_all_closer; ?>',
            data: <?php echo $closer_chart_data;?>,
            backgroundColor: chart_background,
            borderColor: chart_background,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
             yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                 minBarLength: 2,
                stacked: false,
                 scaleLabel: {
                     display: true,
                     labelString: 'Bookings'
                }
            }],
            xAxes: [{
                 scaleLabel: {
                     display: true,
                     labelString: 'Months'
                }
            }]
        }
    }
 });
// New Chart Closers
var ctx2 = document.getElementById('chartAllOpener').getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo $opener_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $monthly_target_all_opener; ?>',
            data: <?php echo $opener_chart_data;?>,
             backgroundColor: chart_background,
            borderColor: chart_background,
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                 minBarLength: 2,
                stacked: false,
                 scaleLabel: {
                     display: true,
                     labelString: 'Bookings'
                }
            }],
            xAxes: [{
                 scaleLabel: {
                     display: true,
                     labelString: 'Months'
                }
            }]
        }
    }
 });*/
// New Chart Closers
// var ctx3 = document.getElementById('chartAllContract').getContext('2d');
// var myChart3 = new Chart(ctx3, {
//     type: 'bar',
//     data: {
//         labels: <?php echo $contracts_chart_label;?>,
//         datasets: [{
//             label: 'Target: <?php echo $monthly_target_all_technical; ?>',
//             data: <?php echo $contracts_chart_data;?>,
//             backgroundColor: chart_background,
//             borderColor: chart_background,
//             borderWidth: 1,
//             fill: true
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 },
//                  minBarLength: 2,
//                 stacked: false,
//                  scaleLabel: {
//                      display: true,
//                      labelString: 'Contracts'
//                 }
//             }],
//             xAxes: [{
//                  scaleLabel: {
//                      display: true,
//                      labelString: 'Months'
//                 }
//             }]
//         }
//     }
//  });
$("#user_first,#user_second").select2();
$("#closer").select2();
$("#opener").select2();
$("#month").select2();
$("#year").select2();

getbookings('#opener', 'leadconversion');// this is called when page is loaded first time for opener only.
getbookings('#closer', 'clientconversion');// this is called when page is loaded first time for closer only.
}

var ctx2 = document.getElementById('chartOpener').getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo $opener_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $own_data["monthly_target"]; ?>',
            data: <?php echo $opener_chart_data;?>,
             backgroundColor: [
               // 'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
              //  'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                 minBarLength: 2,
                stacked: false,
                 scaleLabel: {
                     display: true,
                     labelString: 'Bookings'
                }
            }],
            xAxes: [{
                 scaleLabel: {
                     display: true,
                     labelString: 'Months'
                }
            }]
        }
    }
 });


</script>



<script type="text/javascript">
$(document).ready(function(){


        $('.mass_book_delete').click(function(){
    mass_booking_delete('recentBookings','mass_booking_delete');    
}) 
function mass_booking_delete(type,fn){
    var uids = '';
    $("#"+type+" input:checkbox:checked").each(function() {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
    });
    if (uids == '' || uids =='on'){
            Swal.fire(
              'No record selected ?',
              'Please select record first',
              'question'
            )
            return;
    }
    
    var url = '<?php echo base_url() ?>dashboard/'+fn+'?id='+uids;
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#48B5AC',
      cancelButtonColor: '#d6d6d6',
      confirmButtonText: 'Yes, delete it!',
      showLoaderOnConfirm: true,
      preConfirm: (res) => {
        return fetch(url)
          .then(response => {
             return response
          })
          .catch(error => {
            Swal.showValidationMessage(
              `Request failed: ${error}`
            )
          })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        console.log(result.value)
      if (result.value) {
           Swal.fire(
              'Deleted Successfully !',
              "you won't recover this item",
              'success'
            )
           window.location.reload();
        }
    }) 
}      
        $(document).on('click','.booking_details',function(){

                var id = $(this).data('value');
                var url =  "<?php echo base_url(); ?>";
                 $.ajax({
                  method:"post",
                  url:"<?php echo base_url() ?>Booking/booking_details",
                  data:{id:id},
                  dataType:"json",
                  success:function(data){
                    $('#fullcalmodal').modal('show'); 
                    $(".edit_schedule").attr("href","<?php echo base_url(); ?>booking?booking_id="+data[0].id);

                    $(".jobName").html(data[0].booking_title);
                    $(".startDay").html(data.booking_date);
                    $(".event_location").html(data[0].booking_address);
                    $(".semail").html(data[0].email);
                    $(".status_book").html(data.status);
                    $(".event-color").css('background-color',data.event_color);
                    if(data.notification)
                    {
                        $(".notification").html(data.notification);
                    }else{
                        $(".notification").html('<div class="col-xs-2 address-icon"><i class="fa fa-bell"></i></div> <div class="col-xs-10 event-address">Not found</div>');
                    }
                    $(".notes").html(data[0].notes);
                    $(".tname").html(data[0].name);
                    $(".rmno").html(data[0].email);

                  }
             });
        });
});

var base_url = '<?php echo base_url();?>'; 
   $('.toggable-header').click(function(){
        $(this).find('.toggle-card-btn i').toggleClass('icon-crm-angle-down icon-crm-angle-up');
      });
$(document).ready(function(){

setTimeout(function(){

 $( "#recentWebBookings tbody tr ,#recentBookings tbody tr,#hot-leads tbody tr,#dead-leads tbody tr,#hot-clients tbody tr,#hot-contracts tbody tr,#hot-leads-archived tr,#hot-clients-archived tr,#hot-contracts-archived tr,#dead-leads-archived tr" ).hover(
      function() {
        $(this).find('.no-reminder').show();
        
      }, function() {
        $(this).find('.no-reminder').hide();
      }
    );

},10000);

  // $("#recentBookings").DataTable({
  //       responsive: true,
  // });

   $('#recentBookings').DataTable({
        "bProcessing": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
         },   
        "responsive": true,
        "sAjaxSource": "<?php echo base_url('dashboard/recentBookings'); ?>",
        "aoColumns": [
              { mData: 'checkbox' } ,
              { mData: 'remainder' } ,
              { mData: 'status' } ,
              { mData: 'title' }, 
              { mData: 'start_time' },
              { mData: 'company_name' },
              { mData: 'name'},
              { mData: 'phone' },
              { mData: 'email' },
              { mData: 'city' },
              { mData: 'state' },
              { mData: 'country' },
              { mData: 'opener' },
              { mData: 'closer' },
              { mData: 'last_modified' },
              { mData: 'last_modified_by' },
              { mData: 'notes' },

            ],

        'columnDefs': [ {
        'targets': [0,1], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
            }]

       });

        var base_url = "<?php echo base_url();?>";
        var dataTable = $('#hot-leads').DataTable({
             "pageLength" : 10,
             "serverSide": true,
             'oLanguage': {
            'loadingRecords': '&nbsp;',
            'sProcessing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
             },  
            "processing" : true,
             "responsive": true,
             "order": [[2, "asc" ]],
             "ajax":{ 
                  url :  base_url+'dashboard/hot_leads',
                  type : 'POST'
                    },
             'columnDefs': [ {
                'targets': [0,1], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                    }]
          });

     

        //var base_url = "<?php //echo base_url();?>";
        var dataTable = $('#hot-leads-archived').DataTable({
             "pageLength" : 10,
             "serverSide": true,
             "responsive": true,
             'oLanguage': {
            'loadingRecords': '&nbsp;',
            'sProcessing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
             },  
            "processing" : true,
             "order": [[2, "asc" ]],
             "ajax":{ 
                  url :  base_url+'dashboard/hot_leads_archived',
                  type : 'POST'
                    },
            'columnDefs': [ {
                'targets': [0,1], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
               }]
          });

   $('#hot-clients').DataTable({
        "bProcessing": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
         },   
        "responsive": true,
        "sAjaxSource": "<?php echo base_url('dashboard/hot_clients'); ?>",
        "aoColumns": [
              { mData: 'checkbox' } ,
              { mData: 'remainder' } ,
              { mData: 'company_name' },
              { mData: 'first_name' },
              { mData: 'last_name' },
              { mData: 'phone' },
              { mData: 'city' },
              { mData: 'state' },
              { mData: 'country' },
              { mData: 'category'},
              { mData: 'client_status'},
             // { mData: 'call_satus'},
              { mData: 'opener' },
              { mData: 'closer' },
              { mData: 'last_modified' },
              { mData: 'last_modified_by' },
              { mData: 'notes' }

            ],

        'columnDefs': [ {
        'targets': [0,1], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
            }]

       });

    $("#hot-clients-archived").DataTable({
             "bProcessing": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
         },   
        "responsive": true,
        "sAjaxSource": "<?php echo base_url('dashboard/hot_clients_archived'); ?>",
        "aoColumns": [
              { mData: 'checkbox' } ,
              { mData: 'remainder' } ,
              { mData: 'company_name' },
              { mData: 'first_name' },
              { mData: 'last_name' },
              { mData: 'phone' },
              { mData: 'city' },
              { mData: 'state' },
              { mData: 'country' },
              { mData: 'category'},
              { mData: 'client_status'},
             // { mData: 'call_satus'},
              { mData: 'opener' },
              { mData: 'closer' },
              { mData: 'last_modified' },
              { mData: 'last_modified_by' },
              { mData: 'notes' }

            ],

        'columnDefs': [ {
        'targets': [0,1], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
            }]

    });


  $('#hot-contracts').DataTable({
        "bProcessing": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
         },   
        "responsive": true,
        "sAjaxSource": "<?php echo base_url('dashboard/hot_contracts'); ?>",
        "aoColumns": [
              { mData: 'checkbox' } ,
              { mData: 'remainder' } ,
              { mData: 'company_name' },
              { mData: 'master_contract_number' },
              { mData: 'contract_number' },
              { mData: 'service_type' },
              { mData: 'signing_rate' },
              { mData: 'closing_date' },
              { mData: 'assigning_date' },
              { mData: 'category'},
              { mData: 'contract_status'},
              { mData: 'call_status'},
              { mData: 'closer' },
              { mData: 'technical_consultant'},
              { mData: 'technical_start_date'},
              { mData: 'complete_date'},
              { mData: 'last_modified' },
              { mData: 'last_modified_by' },
              { mData: 'notes' }

            ],

        'columnDefs': [ {
        'targets': [0,1], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
            }]

       });

      $("#hot-contracts-archived").DataTable({
         "bProcessing": true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
         },   
        "responsive": true,
        "sAjaxSource": "<?php echo base_url('dashboard/hot_contracts_archived'); ?>",
        "aoColumns": [
              { mData: 'checkbox' } ,
              { mData: 'remainder' } ,
              { mData: 'company_name' },
              { mData: 'master_contract_number' },
              { mData: 'contract_number' },
              { mData: 'service_type' },
              { mData: 'signing_rate' },
              { mData: 'closing_date' },
              { mData: 'assigning_date' },
              { mData: 'category'},
              { mData: 'contract_status'},
              { mData: 'call_status'},
              { mData: 'closer' },
              { mData: 'technical_consultant'},
              { mData: 'technical_start_date'},
              { mData: 'complete_date'},
              { mData: 'last_modified' },
              { mData: 'last_modified_by' },
              { mData: 'notes' }

            ],

        'columnDefs': [ {
        'targets': [0,1], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
            }]

    }); 

      var dataTable = $('#dead-leads').DataTable({
             "pageLength" : 10,
             "serverSide": true,
             "responsive": true,
             'oLanguage': {
            'loadingRecords': '&nbsp;',
            'sProcessing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
             },  
            "processing" : true,
             "order": [[2, "asc" ]],
             "ajax":{ 
                  url :  base_url+'dashboard/dead_leads',
                  type : 'POST'
                    },
             'columnDefs': [ {
                'targets': [0,1], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                    }]
          });
     
       var dataTable = $('#dead-leads-archived').DataTable({
             "pageLength" : 10,
             "serverSide": true,
             "responsive": true,
             'oLanguage': {
            'loadingRecords': '&nbsp;',
            'sProcessing': "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>" 
             },  
            "processing" : true,
             "order": [[2, "asc" ]],
             "ajax":{ 
                  url :  base_url+'dashboard/dead_leads_archived',
                  type : 'POST'
                    },
             'columnDefs': [ {
                'targets': [0,1], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
                    }]
          });
 
	
   $("#last-leads").dataTable({
              "order": [[ 0, "desc" ]],
              "oLanguage": {
              "sEmptyTable": "No lead available",
              "sSearchPlaceholder": "",
              //"scrollX": true,
               "sProcessing": "<div align='center'><img style='position:relative;height:64px;width:64px;' src='<?php echo base_url(); ?>assets/images/loader.gif'></div>"},
              "ordering": true,
              "searching": true,
              "responsive":true,
              "sAjaxSource": "<?php echo base_url() ?>" + "modules/get_last_updated_leads",
              "bProcessing": true,
              "bServerSide": true,
               "aLengthMenu": [[10,15, 30, 50, 100, 500], [10,15, 30, 50, 100, 500]],
              "iDisplayLength": 10,
              "responsive": true,
              "bDestroy": true,
              "aoColumnDefs": [
                  {"sClass": "hide", "aTargets": [0]},
                  { "bSortable": false, "aTargets": [2]},
                  { "bSortable": false, "aTargets": [3]},
                  { "bSortable": false, "aTargets": [4]},
              ]
    });


});
var checkAll = false;
function selectAll(type){
     
       if (checkAll){
            $('#'+type+' input[type="checkbox"]').prop("checked", false);
            $("#checkboxSelect").removeClass( "btn-danger" ).addClass( "btn-primary" );
            $('#checkboxSelect').text("Select All");
            checkAll = false;
        } else {
            $('#'+type+' input[type="checkbox"]').prop("checked", true);
            $("#checkboxSelect").removeClass( "btn-primary" ).addClass( "btn-danger" );
            $('#checkboxSelect').text("Deselect All");
            checkAll = true;
        }
}

$('.mass_delete').on('click',function()
{   
    type=$(this).attr('data-id');
    massDelete(type);  
              
});


$('.archived').on('change',function(){
    var type=$(this).attr('data-id');
    if($(this).val()=='active'){
        $('#'+type).show();
        $('#'+type+'-archived').hide();
        $(this).next().hide();
        var w = $(this).next().next();
        var x = $(this).next().next().next();
        var y = $(this).next().next().next().next();
         $(w).css('display','inline-block');
         $(x).css('display','block');
         $(y).css('display','none');
        $(this).next().next().next().show();
    }else{
        $('#'+type).hide();
        $('#'+type+'-archived').show();   
        $(this).next().show();
         var w = $(this).next().next();
         var x = $(this).next().next().next();
         var y = $(this).next().next().next().next();
         $(w).css('display','none');
         $(x).css('display','none');
         $(y).css('display','block');
    }
})

$('.restore').click(function(){
     
     var type=$(this).attr('data-id');

     var uids = '';

       $("#"+type+" input:checkbox:checked").each(function() {
                var id = $(this).val();
                uids += (uids == '') ? id : ("," + id);
        });

        if (uids == '' || uids =='on'){
                
                Swal.fire(
                  'No record selected ?',
                  'Please select record first',
                  'question'
                )
                
                return;
        }
        
        var url = '<?php echo base_url() ?>Modules/restore';

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#48B5AC',
          cancelButtonColor: '#d6d6d6',
          confirmButtonText: 'Yes, Restore it!',
          showLoaderOnConfirm: true,
          preConfirm: (res) => {
            return $.ajax({
              method:"post",
              url:url,
              data:{'record_id':uids},
            });
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.value) {
               Swal.fire(
                  'Restored Successfully !',
                  "you won't recover this item",
                  'success'
                )
                window.location.reload();
            }
        }) 
})

function massDelete(type){

        var uids = '';
       $("#"+type+" input:checkbox:checked").each(function() {
                var id = $(this).val();
                uids += (uids == '') ? id : ("," + id);
        });

        if (uids == '' || uids =='on'){
                
                Swal.fire(
                  'No record selected ?',
                  'Please select record first',
                  'question'
                )
                
                return;
        }
        
        var action = "mass_delete";
        var url = '<?php echo base_url() ?>Modules/?cm=<?php echo $current_module; ?>&bulk=on&ac=' + action + '&uid=' + uids;

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#48B5AC',
          cancelButtonColor: '#d6d6d6',
          confirmButtonText: 'Yes, delete it!',
          showLoaderOnConfirm: true,
          preConfirm: (res) => {
            return fetch(url)
              .then(response => {
                 return response
              })
              .catch(error => {
                Swal.showValidationMessage(
                  `Request failed: ${error}`
                )
              })
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.value) {
               Swal.fire(
                  'Deleted Successfully !',
                  "you won't recover this item",
                  'success'
                )
                window.location.reload();
            }
        }) 
}

$(document).on('click', '.mass_unfollow', function(){
    type=$(this).attr('data-id');
    massUnfollow(type);  
});

$(document).on('click', '.mass_cunfollow', function(){
    type=$(this).attr('data-id');
    masscUnfollow(type);  
});


function massUnfollow(type){

    var uids = '';
      $("#"+type+" input:checkbox:checked").each(function() {
                var id = $(this).val();
                uids += (uids == '') ? id : ("," + id);
       });

      if (uids == '' || uids == 'on'){
       
                Swal.fire(
                  'No record selected ?',
                  'Please select record first',
                  'question'
                )
                
                return;
      }  

      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#48B5AC',
          cancelButtonColor: '#d6d6d6',
          confirmButtonText: 'Yes, unfollow it!',
          showLoaderOnConfirm: true,
          preConfirm: (res) => {
           return $.ajax({
              method:"post",
              url:base_url + 'booking/massUnfollowlead',
              data:{'record_id':uids},
            });
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.value) {
               Swal.fire(
                  'Unfollow lead Successfully !',
                  "you won't recover this item",
                  'success'
                )
                window.location.reload();
            }
        })
}

function masscUnfollow(type){

    var uids = '';
      $("#"+type+" input:checkbox:checked").each(function() {
                var id = $(this).val();
                uids += (uids == '') ? id : ("," + id);
       });

      if (uids == '' ||  uids =='on'){
       
                Swal.fire(
                  'No record selected ?',
                  'Please select record first',
                  'question'
                )
                
                return;
      }  
      
      
      if(type=='hot-contracts')
          modules='Contract';
      else  
          modules='Client'; 
      
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#48B5AC',
          cancelButtonColor: '#d6d6d6',
          confirmButtonText: 'Yes, unfollow it!',
          showLoaderOnConfirm: true,
          preConfirm: (res) => {
           return $.ajax({
              method:"post",
              url:base_url + 'booking/massClientContractUnfollow',
              data:{'record_id':uids,'modules':modules},
            });
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.value) {
               Swal.fire(
                  'Unfollow  Successfully !',
                  "you won't recover this item",
                  'success'
                )
                window.location.reload();
            }
        })
}


function bulkActionOnUser(action, actionText,type){
    var uids = '';
    $("#"+type+" input:checkbox:checked").each(function() {
        var id = $(this).val();
        uids += (uids == '') ? id : ("," + id);
    });

    if (uids == ''){
        alert("No user has been selected. Please select an user first.");
        return;
    }
    if(type=='hot-leads'){
        var newOwner = $("#Lead_0").val();
        var newCloser=$("#cLead_0").val();
    }
    else{
        var newOwner=$("#dead_0").val();
        var newCloser=$("#dLead_0").val();
    }
    var url = '<?php echo base_url() ?>Modules/?cm=<?php echo $current_module; ?>&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids+'&newCloser=' + newCloser+'&isDash=1';
    if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
        
        $.ajax({
              method:"get",
              url:url, 
              beforeSend:function(){
                 $('.loader').show();
              },
              success:function(res){
                $('.loader').hide();
                Swal.fire(
                  'Assigned  Successfully !',
                  "you won't recover this action",
                  'success'
                )
                window.location.reload();
              } 
        });

    }
}
function bulkActionOnClient(action, actionText,type){

        var uids = '';
        $("#"+type+" input:checkbox:checked").each(function() {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
        });

        if (uids == ''){
            alert("No user has been selected. Please select an user first.");
            return;
        }

        var newOwner = $("#Client_0").val();
        var url = '<?php echo base_url() ?>Modules/?cm=Clients&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids+'&isDash=1';
        if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
            $.ajax({
                  method:"get",
                  url:url, 
                  beforeSend:function(){
                     $('.loader').show();
                  },
                  success:function(res){
                    $('.loader').hide();
                    Swal.fire(
                      'Assigned  Successfully !',
                      "you won't recover this action",
                      'success'
                    )
                    window.location.reload();
                  } 
            });
        }
    }
function bulkActionOnContract(action, actionText,type){

        var uids = '';
        $("#"+type+" input:checkbox:checked").each(function() {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
        });

        if (uids == ''){
            alert("No user has been selected. Please select an user first.");
            return;
        }

        var newOwner = $("#Contract_0").val();
        var url = '<?php echo base_url() ?>Modules/?cm=Contracts&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids+'&isDash=1';
        if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
            $.ajax({
                  method:"get",
                  url:url, 
                  beforeSend:function(){
                     $('.loader').show();
                  },
                  success:function(res){
                    $('.loader').hide();
                    Swal.fire(
                      'Assigned  Successfully !',
                      "you won't recover this action",
                      'success'
                    )
                    window.location.reload();
                  } 
            });
        }
    }


function getRandomColor() {
  // var letters = '0123456789ABCDEF';
  // var color = '#';
  // for (var i = 0; i < 6; i++) {
  //   color += letters[Math.floor(Math.random() * 16)];
  // }
  // return color;
}
var dataset;
var meta;
var total;
var currentValue;
var percentage;
var color = new Array('#4661EE','#EC5657','#1BCDD1','#8FAABB','#B08BEB','#3EA0DD','#F5A52A','#23BFAA','#FAA586','#EB8CC6','#46FF33','#33FFDD','#B833FF','#581845','#0C0306');
var lead_percent = new Array();
var lead_counts = <?php echo json_encode($opener_leads); ?>;
var total_leads = <?php echo $total_opener_leads; ?>;

var client_percent = new Array();
var client_counts = <?php echo json_encode($closer_clients); ?>;
var total_clients = <?php echo $total_closer_clients; ?>;

//console.log(lead_counts);
//console.log(lead_counts[0]);
// var my_db = "<?php echo $lead_details_count; ?>";
// for(var i=0; i<my_db; i++)
// {
//     var per = Math.round(lead_counts[i]*100 / total_leads);
//     var totalPer = per + "%";
//     lead_percent.push(per);
//     color.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
// }


// var randomScalingFactor = function() {
//   return Math.round(Math.random() * 100);
// };
// var randomColorFactor = function() {
//   return Math.round(Math.random() * 255);
// };
// var randomColor = function(opacity) {
//   return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
// };

var config = {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($opener_name); ?>,
    datasets: [{
      lable:<?php echo json_encode($opener_name); ?>,
      data: lead_counts ,
      backgroundColor: color,
      //label: 'Expenditures'
    }],
    
  },
  options: {
    plugins:
        {
          labels: {
            render: 'value',
            fontSize: 14,
          //  fontStyle: 'bold',
            fontColor: '#000',
           // fontFamily: '"Lucida Console", Monaco, monospace'
          }
        }
    ,
    responsive: true,
    /*legend: {
      position: 'bottom',
    },*/
    animation: {
      animateScale: true,
        animateRotate: true
    },
   tooltips: {
      callbacks: {
        // this callback is used to create the tooltip label
        label: function(tooltipItem, data) {
          // get the data label and data value to display
          // convert the data value to local string so it uses a comma seperated number
          var dataLabel = data.labels[tooltipItem.index];
          var value = ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();
          // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
          if (Chart.helpers.isArray(dataLabel)) {
            // show value on first line of multiline label
            // need to clone because we are changing the value
            dataLabel = dataLabel.slice();
            dataLabel[0] += value;
          } else {
            dataLabel += value;
          }
          // return the text to display on the tooltip
          return dataLabel ;
        }
      }
    }
  }
};

//opener chart start
    var lead_total = <?php echo $total_opener_leads; ?>;
    var unassign = <?php echo $unassign; ?>;
    $("#total_lead_number").html("Total Leads "+lead_total+"");
    $("#total_unassign_lead_number").html("Total Unassigned Lead "+unassign+"");

var ctx = document.getElementById("leadChart").getContext("2d");
    window.myDoughnut = new Chart(ctx, config); {
}
var go = "<?php echo $client_details_count; ?>";
for(var i=0; i<go ; i++)
{
    var per = Math.round(client_counts[i]*100 / total_clients);
    client_percent.push(per);
    color.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
}

var configClients = {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($closer_name); ?>,
    datasets: [{
      lable:<?php echo json_encode($closer_name); ?>,
      data: client_counts ,
      backgroundColor: color,
      //label: 'Expenditures'
    }],
    
  },
  options: {
    plugins:
       {
          labels: {
            render: 'value',
            fontSize: 14,
           // fontStyle: 'bold',
            fontColor: '#000',
            //fontFamily: '"Lucida Console", Monaco, monospace'
          }
        }
    ,
    responsive: true,
    /*legend: {
      position: 'bottom',
    },*/
    animation: {
      animateScale: true,
        animateRotate: true
    },
   tooltips: {
      callbacks: {
        // this callback is used to create the tooltip label
        label: function(tooltipItem, data) {
          // get the data label and data value to display
          // convert the data value to local string so it uses a comma seperated number
          var dataLabel = data.labels[tooltipItem.index];
          var value = ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].toLocaleString();
          // make this isn't a multi-line label (e.g. [["label 1 - line 1, "line 2, ], [etc...]])
          if (Chart.helpers.isArray(dataLabel)) {
            // show value on first line of multiline label
            // need to clone because we are changing the value
            dataLabel = dataLabel.slice();
            dataLabel[0] += value;
          } else {
            dataLabel += value;
          }
          // return the text to display on the tooltip
          return dataLabel ;
        }
      }
    }
  }
};


    var client_total = <?php echo $total_closer_clients; ?>;
    $("#total_client_number").html("Total Clients "+client_total+"");

var ctxclient = document.getElementById("clientChart").getContext("2d");
    window.myDoughnut = new Chart(ctxclient, configClients); {
}
/*default function when no date and time seleted*/
function getbookings(id, chartId, year){
    var target;
    var user_id = $(id).children("option:selected").val();
    var user_name = $(id).children("option:selected").text();
    var module_id = $(id).attr('data-module');
    var monthYear = $(year).val()
    $.ajax({
    type: "post",
    dataType: "json",
    url: base_url+'Dashboard/getbookings',
    data: { user_id : user_id, module_id : module_id, monthYear:monthYear },
    success:function(data)
    {
    console.log(data);
      var target = data.target[0]['target'];
      var total_booking = data.totalbooking[0]['totalbooking'];
      var confirmed_booking = data.confirmbooking[0]['confirmbooking'];
      
      $('#'+chartId).replaceWith('<canvas id="'+chartId+'"></canvas>');
       var config = {
              type: 'bar',
              data: {
               labels: ['Target '+target, 'Total Booking '+total_booking,'Total Converted '+confirmed_booking],
                datasets: [{
            label: 'Target of'+user_name+' is '+target,
            data: [target, total_booking,confirmed_booking],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgb(0,250,154, 0.2)'
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgb(0,250,154, 0.2)'
            ],
            borderWidth: 1
        }]
              },
             options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                    }
                }]
            }
        }
    };
        var chartUser = document.getElementById(chartId).getContext("2d");
        var User = new Chart(chartUser, config);
        User.update()
    }
  });
}

/*when get data button is 
clicked then following event 
will encounter for opener*/
$(document).on('click', '#openerData', function(){
        getbookingsbymonth($('#openertarget').val(),'leadconversion', '#opener');
});
/*when get data button is 
clicked then following event 
will encounter for closer*/
$(document).on('click', '#closerData', function(){ 
        getbookingsbymonth($('#closertarget').val(),'clientconversion', '#closer');    
});

/*function to get data for selected month and year*/
function getbookingsbymonth(year, chartId, userid) {
   var monthYear = year; // year
   var user_id = $(userid).children("option:selected").val(); 
   var module_id = $(userid).attr('data-module');
   var user_name = $(userid).children("option:selected").text();
$.ajax({
    type: "post",
    dataType: "json",
    url: base_url+'Dashboard/getbookings',
    data: { user_id : user_id, module_id : module_id, monthYear:monthYear},
    success:function(data)
    {
    console.log(data);
      var target = data.target[0]['target'];
      var total_booking = data.totalbooking[0]['totalbooking'];

      var confirmed_booking = data.confirmbooking[0]['confirmbooking'];
      
      $('#'+chartId).replaceWith('<canvas id="'+chartId+'"></canvas>');
       var config = {
              type: 'bar',
              data: {
               labels: ['Target '+target, 'Total Booking '+total_booking,'Total Converted '+confirmed_booking],
                datasets: [{
           label: 'Target of'+user_name+' is '+target,
            data: [target, total_booking,confirmed_booking],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgb(0,250,154, 0.2)',
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgb(0,250,154, 0.2)',
            ],
            borderWidth: 1
        }]
              },
             options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                    }
                }]
            }
        }
    };
        var chartUser = document.getElementById(chartId).getContext("2d");
        var User = new Chart(chartUser, config);
        User.update()
    }
  });
}   


</script>
