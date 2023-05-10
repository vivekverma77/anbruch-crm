<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/mdb.min.js"></script>
<style>
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

.calendar-header {background:#ff6b68; text-align:center; color:#fff; padding:1px;}
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

.hot-leads-table {background:#fff; padding:9px 0 0; color:#404E67; font-size:14px; margin-top:50px;}
.hot-leads-table h3 {padding:20px; text-align:center;}
.hot-leads-table table {width:100%}
.hot-leads-table table.dataTable th {vertical-align:bottom; border-bottom:2px solid #E3EBF3; border-top:1px solid #E3EBF3;}
.company {color:#009C9F}
.hot-leads-table tbody tr {border-bottom:1px solid #E3EBF3;}
.hot-leads-table tbody tr:hover {background:rgba(245,247,250,.5)}
.hot-leads-table tbody .status {padding:4.5px 7px; background:#000; color:#fff; font-size:13px; border-radius:2px; display:inline-block;}
.hot-leads-table tbody .ASSIGNED.TO.OPENER {background:#16D39A;}
.hot-leads-table tbody .ASSIGNED.TO.CLOSER {background:#ffc722;}
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

td.booking-status span {padding:4.5px 7px; font-size:13px; border-radius:2px; display:inline-block;}

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
</style>
<?php //print_r($openerss); die("cool"); ?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
			
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

    <div class="clearfix calendar-row" style="margin:30px -15px 0 0; width:99.5% !important">
          <div class="calendar-header"> <h3>RECENT BOOKINGS</h3></div>
                  <div id="rec-bookings" class="collapse in"  style="background:#fff;    height: 425px; ">
                            <div class="table">
                                <table style="width: 100%;">
                                    <thead>
                                       <tr> 
                                        <th>Booking Title</th>
                                        <th>Booking Date</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                       </tr> 
                                    </thead>
                                    <?php if(!empty($recentBookings))
                                    {
                                        foreach ($recentBookings as $key => $book) {
                                    ?>
                                        <tr>
                                            <td><?php echo !empty($book['booking_title']) ? $book['booking_title'] : '-'?></td>
                                            <td>
                                             <?php
                                               if($book['all_day'] == 1)
                                                { 
                                                     echo !empty($book['booking_date']) && $book['booking_date'] > 0 ? date("m/d/Y", strtotime($book['booking_date'])) : '-';
                                                 }else
                                                 {
                                                     echo !empty($book['booking_date']) && $book['booking_date'] > 0 ? date("m/d/Y h:i a", strtotime($book['booking_date'])) : '-';
                                                 }
                                            ?>
                                                
                                            </td>
                                            <td><?php echo !empty($book['name']) ? $book['name'] : '-'?></td>
                                            <td class="booking-status"><?php 
                                                if($book['status'] == 1){
                                                    echo '<span class="alert-success">Confirmed</span>';
                                                }else if($book['status'] == 2 && $book['praposed_date'] == '0000-00-00 00:00:00'){
                                                    echo '<span class="alert-danger">Cancelled</span>';
                                                }else if($book['status'] == 2 && $book['praposed_date'] != '0000-00-00 00:00:00'){
                                                    echo '<span class="alert-warning" title="Suggested Time: '.$book['praposed_date'].'">Time Suggested</span>';
                                                }else{
                                                    echo '<span class="alert-info">Awaiting</span>';
                                                }
                                            ?></td>
                                        </tr>
                                    <?php       
                                        }
                                    }?>
                                </table>
                            </div>
                         </div>

     </div>   
	<div class="clearfix calendar-row" style="margin:30px -15px 0 0;">

		<div class="col-xs-4 main-cols col-left">
			<div class="row">
				
	    	</div>
	    	<div class="row data-cols">
                <div class="calendar-header" style="background: #00c0ef;">
	    		<h3>Leads %</h3>
                </div>
                <h6>Total Leads <?php echo $total_leads; ?></h6>
                <div>
                    <canvas id="pieChart" width="700" height="600"></canvas>
                </div>
    
                <!-- <div class="col-xs-4 col TQL">
	    			<span class="col-title"> Total Qualified Leads</span>
	    			<small>This Week</small>
	    			<span class="circle"> <?php echo isset($qualifiedLeadsInWeek) ? sprintf("%02d",$qualifiedLeadsInWeek) : 0;?> </span>
	    		</div>
	    		<div class="col-xs-4 center-col col L2C">
	    			<span class="col-title"> Leads to Clients</span>
	    			<small>This Week</small>
	    			<span class="circle" style="color:#ffc722;"> <?php echo isset($leadsToClientsInWeek) ? sprintf("%02d",$leadsToClientsInWeek) : 0;?> </span>
	    		</div>
	    		<div class="col-xs-4 col TI">
	    			<span class="col-title"> Total Invoices</span>
	    			<small>This Week</small>
	    			<span class="circle" style="color:#FFA87D;"> <?php echo isset($invoicesInWeek) ? sprintf("%02d",$invoicesInWeek) : 0;?> </span>
	    		</div> -->
	    	</div>
	    </div>
        <div class="col-xs-8 main-cols col-right">
            <div style="background:#fff;padding-bottom: 36px;margin-top: 0px;">
                 <div class="content-title">ALL TECHNICAL CONSULTANTS MONTHLY TARGET<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#stats-CO"></i> </div>                     
                 <div id="stats-CO" class="collapse in">
                    <canvas id="chartAllContract"></canvas>
                 </div>
            </div>         
        </div>
    </div>
<!-- Start -->
     <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
        <div class="col-xs-6 main-cols col-left">
            <div style="margin-left:-15px;">
              <div style="background:#fff;">
                <div class="content-title">Leads %<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#leads-OP"></i> 
                </div>  
                 <div id="leads-OP" class="collapse in" style="padding-bottom:15px;">
                    <h6 style="text-align:center;">Total Leads <?php echo $total_leads; ?></h6>
                    <canvas id="leadChart"></canvas> 
                 </div>
              </div>
            </div>
        </div>
        <div class="col-xs-6 main-cols">
            <div style="margin-right:-15px;">
              <div style="background:#fff;">
                <div class="content-title">Clients %<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#client-AO"></i> </div> 
                 <div id="client-AO" class="collapse in" style="padding-bottom:15px;">
                      <h6 style="text-align:center;">Total Clients <?php echo $total_clients; ?></h6>
                    <canvas id="clientChart"></canvas>
                 </div>
              </div>
            </div>
        </div>
    </div>
    <!-- end -->

    <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
        <div class="col-xs-6 main-cols col-left">
            <div style="margin-left:-15px;">
              <div style="background:#fff;">
                <div class="content-title">LEAD BOOKING<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#lead-OP"></i> </div>                     
                 <div id="lead-OP" class="collapse in">
                    <div class="text-center user_select">
                      <label>Select Opener</label>  
                          <!-- <select id="opener" onchange="compareChart('c-container-first','chartUser1')"> -->
                           <select id="opener" onchange="getbookings(this, 'leadconversion')" data-module = '1'>
                           
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
                             <h5 style="text-align:center; padding-left: 80px;">Total Opener <?php echo count($opener_data); ?></h5>
                    </div>
                    <canvas id="leadconversion"></canvas> 
                   
                 </div>
              </div>
            </div>
        </div>
        <div class="col-xs-6 main-cols">
            <div style="margin-right:-15px;">
              <div style="background:#fff;">
                <div class="content-title">CLIENT BOOKING<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#client-c-AO"></i> </div>                     
                 <div id="client-c-AO" class="collapse in">
                    <div class="text-center user_select">
                      <label>Select Closer</label>  
                          <!-- <select id="closer" onchange="compareChart('c-container-first','chartUser1')"> -->
                           <select id="closer" onchange="getbookings(this, 'clientconversion')" data-module = '2'>
                          
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
                           <h5 style="text-align:center;padding-left: 80px;">Total Closer <?php echo count($closer_data) ; ?></h5>
                    </div>
                    <canvas id="clientconversion"></canvas>
                     
                 </div>
              </div>
            </div>
        </div>
    </div>




    <div class="clearfix calendar-row" style="margin:50px 0 0; display:flex;">
        <div class="col-xs-6 main-cols col-left">
            <div style="margin-left:-15px;">
              <div style="background:#fff;">
                <div class="content-title">ALL OPENERS MONTHLY TARGET<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#stats-OP"></i> </div>                     
                 <div id="stats-OP" class="collapse in">
                    <canvas id="chartAllOpener"></canvas> 
                 </div>
              </div>
            </div>
        </div>
        <div class="col-xs-6 main-cols">
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


     <div id="compare-row" class="clearfix" style="margin:50px 0 0;background:#fff; height:100%;">
         <div class="c-chart-header text-center content-title" style=""><h3>Comparison</h3></div>
         <div class="col-xs-6 main-cols">
            <div class="chart-container" id="c-container-first">
                <div class="text-center user_select">
                  <label>Select user</label>  
                  <select id="user_first" onchange="compareChart('c-container-first','chartUser1')">
                    <?php if(!empty($users))
                    {
                        foreach ($users as $key => $user) {
                    ?>  
                      <option value="<?php echo base_url().'dashboard/charComparison?&user_id='.$user["user_id"].'&user_role_id='.$user["role_id"];?>" <?php echo array_rand($users) == $key ? 'selected':'';?>><?php echo isset($user['first_name']) ? $user['first_name'] :'';?><?php echo isset($user['last_name']) ? ' '.$user['last_name'] :'';?>
                      </option>
                    <?php   
                     }
                    }?>
                  </select>
                 </div>
                 <div class="char-actions">
                    <label class="year_label"></label>
                    <a href="javascript:void(0)" id="user_first_prev" class="user_prev" title="Previous Year" style="float: left;padding-left: 30px;"><i class="fa fa-arrow-circle-left" style="font-size: 20px;"></i></a>
                    <a href="javascript:void(0)" id="user_first_next" class="user_next" title="Next Year" style="float: right;padding-right: 30px;"><i class="fa fa-arrow-circle-right" style="font-size: 20px;"></i></a>
                    <button type="button" class="this_year hide" style="float: right;margin-right: 30px;">This year</button>
                </div> 
                <input type="hidden" class="year">
                <canvas id="chartUser1"></canvas>                         
            </div>
        </div>
        <div class="col-xs-6  main-cols">
            <div class="chart-container" id="c-container-second">
                <div class="text-center user_select">
                  <label>Select user</label>  
                  <select id="user_second" onchange="compareChart('c-container-second','chartUser2')">
                    <?php if(!empty($users))
                    {
                        foreach ($users as $key2 => $user) {
                    ?>  
                      <option value="<?php echo base_url().'dashboard/charComparison?&user_id='.$user["user_id"].'&user_role_id='.$user["role_id"];?>" <?php echo array_rand($users) == $key2 ? 'selected':'';?>><?php echo isset($user['first_name']) ? $user['first_name'] :'';?><?php echo isset($user['last_name']) ? ' '.$user['last_name'] :'';?></option>
                    <?php   
                     }
                    }?>
                  </select>
                </div>
                <div class="char-actions">
                    <label class="year_label"></label>
                    <a href="javascript:void(0)" id="user_second_prev" class="user_prev" title="Previous Year" style="float: left;margin-left: 30px;"><i class="fa fa-arrow-circle-left" style="font-size: 20px;"></i></a>
                    <a href="javascript:void(0)" id="user_second_next" class="user_next" title="Next Year" style="float: right;margin-right: 30px;"><i class="fa fa-arrow-circle-right" style="font-size: 20px;"></i></a>
                    <button type="button" class="this_year hide" style="float: right;margin-right: 30px;">This year</button>
                </div>
                <input type="hidden" class="year">
                <canvas id="chartUser2"></canvas>
            </div>
        </div>
    </div>
        
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
    
    <div class="hot-leads-table">
    	<h3>FAVORITE LEADS</h3>
    	<div class="table">
    		<table id="hot-leads">
    			<thead>
    				<tr>
    					<th></th>
                        <th nowrap>Company Name</th>
                        <th nowrap>Company Website</th>
    					<th nowrap>City</th>
                        <th nowrap>Province</th>
                        <th nowrap>Country</th>
                        <th nowrap>Estimated Sales</th>
                        <th nowrap>Reported Sales</th>
                        <th nowrap>Last Name</th>
                        <th nowrap>Fax</th>
                        <th nowrap>First Name</th>
    					<th nowrap>Title</th>
                        <th nowrap>Phone</th>
                        <th nowrap>Lead Status</th> 
                        <!-- <th nowrap>Service Type</th>  -->
                         <th nowrap>Email</th> 
                        <th nowrap>Opener</th> 
                        <th nowrap>Primary SIC Code</th>  
    				    <th nowrap>Closer</th> 
                        <th nowrap>Lead Source</th> 
                        <th nowrap>Lead Referred Partner</th> 
                        <th nowrap>Lead Category</th> 
                        <th nowrap>Action</th> 
                         
                    </tr>
    			</thead>
                <tbody>
               <?php

                    if(!empty($record_data_all_opener)){ //print_r($topHotLeads);
                        foreach ($record_data_all_opener as $key => $record_data) { 
                            $record_data_meta = $record_data['meta'];
                            $record_date_static = $record_data['static'];      
                    ?>
                        <tr id="<?php echo 'record_id_'.$key; ?>">
                           <td></td>
                            <td  nowrap><a href="<?php echo base_url()?>modules/viewRecord/?cm=<?php echo $current_module ?>&id=<?php echo $key ?>&record_status=<?php echo $record_date_static['record_status'] ?>" class="company-name"><?php echo !empty($record_data_meta['Company Name']) ? $record_data_meta['Company Name'] : '';?></a></td>
                            <td nowrap><?php echo !empty($record_data_meta['Company Website']) ? $record_data_meta['Company Website'] : '-';?></td>

                            <td nowrap><?php echo !empty($record_data_meta['City']) ? $record_data_meta['City'] : '-';?></td>
                            <td nowrap> <?php echo !empty($record_data_meta['Province']) ? $record_data_meta['Province'] : '-';?></td>
                            <td nowrap> <?php echo !empty($record_data_meta['Country']) ? $record_data_meta['Country'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Estimated Sales']) ? $record_data_meta['Estimated Sales'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Reported Sales']) ? $record_data_meta['Reported Sales'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Last Name']) ? $record_data_meta['Last Name'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Fax']) ? $record_data_meta['Fax'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['First Name']) ? $record_data_meta['First Name'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Title']) ? $record_data_meta['Title'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Phone']) ? $record_data_meta['Phone'] : '';?></td>
                            <td nowrap> <span class="status <?php echo !empty($record_data_meta['Lead Status']) ? $record_data_meta['Lead Status'] : '';?>"><?php echo !empty($record_data_meta['Lead Status']) ? $record_data_meta['Lead Status'] : '-';?></span> </td>
                            <td nowrap><?php echo !empty($record_data_meta['Email']) ? $record_data_meta['Email'] : '';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Opener']) ? $record_data_meta['Opener'] : '';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Primary SIC Code']) ? $record_data_meta['Primary SIC Code'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Closer']) ? $record_data_meta['Closer'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Lead Source']) ? $record_data_meta['Lead Source'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Lead Referred Partner']) ? $record_data_meta['Lead Referred Partner'] : '-';?></td> 
                            <td nowrap><?php echo !empty($record_data_meta['Lead Category']) ? $record_data_meta['Lead Category'] : '-';?></td>
                            <?php if($record_date_static['value']=='Hot'){?>
                            <td nowrap><a href="#modalFollow" id="unfollow_id" class="btn btn-round btn-fill-theme" data-record = <?php echo $key ?> > <i class="icon-crm-user-plus"></i> Unfollow </a></td>   
                            <?php } else{?>
                            <td nowrap><a href="#modalFollow" id="follow_id" class="btn btn-round btn-fill-theme" data-record = <?php echo $key ?> > <i class="icon-crm-user-plus"></i> Follow </a></td>
                            <?php }?>
                            
                       </tr>
                    <?php   }
                    }
                    ?>
                </tbody>
    		</table>
    	</div>
    </div>

    <div class="hot-leads-table">
        <h3>DEAD LEADS</h3>
        <div class="table">
            <table id="dead-leads">
                <thead>
                    <tr>
                        <th></th>
                        <th nowrap>Company Name</th>
                        <th nowrap>Company Website</th>
                        <th nowrap>City</th>
                        <th nowrap>Province</th>
                        <th nowrap>Country</th>
                        <th nowrap>Estimated Sales</th>
                        <th nowrap>Reported Sales</th>
                        <th nowrap>Last Name</th>
                        <th nowrap>Fax</th>
                        <th nowrap>First Name</th>
                        <th nowrap>Title</th>
                        <th nowrap>Phone</th>
                        <th nowrap>Lead Status</th> 
                        <!-- <th nowrap>Service Type</th>  -->
                         <th nowrap>Email</th> 
                        <th nowrap>Opener</th> 
                        <th nowrap>Primary SIC Code</th>  
                        <th nowrap>Closer</th> 
                        <th nowrap>Lead Source</th> 
                        <th nowrap>Lead Referred Partner</th> 
                        <th nowrap>Lead Category</th> 
                        <th nowrap>Action</th> 
                         
                    </tr>
                </thead>
                <tbody>
               <?php

                    if(!empty($record_data_all_dead_leads)){ //print_r($topHotLeads);
                        foreach ($record_data_all_dead_leads as $key => $record_data) { 
                            $record_data_meta = $record_data['meta'];
                            $record_date_static = $record_data['static'];      
                    ?>
                        <tr id="<?php echo 'record_id_'.$key; ?>">
                           <td></td>
                            <td  nowrap><a href="<?php echo base_url()?>modules/viewRecord/?cm=<?php echo $current_module ?>&id=<?php echo $key ?>&record_status=<?php echo $record_date_static['record_status'] ?>" class="company-name"><?php echo !empty($record_data_meta['Company Name']) ? $record_data_meta['Company Name'] : '';?></a></td>
                            <td nowrap><?php echo !empty($record_data_meta['Company Website']) ? $record_data_meta['Company Website'] : '-';?></td>

                            <td nowrap><?php echo !empty($record_data_meta['City']) ? $record_data_meta['City'] : '-';?></td>
                            <td nowrap> <?php echo !empty($record_data_meta['Province']) ? $record_data_meta['Province'] : '-';?></td>
                            <td nowrap> <?php echo !empty($record_data_meta['Country']) ? $record_data_meta['Country'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Estimated Sales']) ? $record_data_meta['Estimated Sales'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Reported Sales']) ? $record_data_meta['Reported Sales'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Last Name']) ? $record_data_meta['Last Name'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Fax']) ? $record_data_meta['Fax'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['First Name']) ? $record_data_meta['First Name'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Title']) ? $record_data_meta['Title'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Phone']) ? $record_data_meta['Phone'] : '';?></td>
                            <td nowrap> <span class="status <?php echo !empty($record_data_meta['Lead Status']) ? $record_data_meta['Lead Status'] : '';?>"><?php echo !empty($record_data_meta['Lead Status']) ? $record_data_meta['Lead Status'] : '-';?></span> </td>
                            <td nowrap><?php echo !empty($record_data_meta['Email']) ? $record_data_meta['Email'] : '';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Opener']) ? $record_data_meta['Opener'] : '';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Primary SIC Code']) ? $record_data_meta['Primary SIC Code'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Closer']) ? $record_data_meta['Closer'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Lead Source']) ? $record_data_meta['Lead Source'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Lead Referred Partner']) ? $record_data_meta['Lead Referred Partner'] : '-';?></td> 
                            <td nowrap><?php echo !empty($record_data_meta['Lead Category']) ? $record_data_meta['Lead Category'] : '-';?></td>
                            <?php if($record_date_static['value']=='Hot'){?>
                            <td nowrap><a href="#modalFollow" id="unfollow_id" class="btn btn-round btn-fill-theme" data-record = <?php echo $key ?> > <i class="icon-crm-user-plus"></i> Unfollow </a></td>   
                            <?php } else{?>
                            <td nowrap><a href="#modalFollow" id="follow_id" class="btn btn-round btn-fill-theme" data-record = <?php echo $key ?> > <i class="icon-crm-user-plus"></i> Follow </a></td>
                            <?php }?>
                            
                       </tr>
                    <?php   }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    </section>
</section>
<!--main content end-->

<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/fullcalendarv3.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/gcal.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
/*$('#calendar').fullCalendar({
		header: {
					left: 'prev',
					center: 'title',
					right: 'next',
			},     
	     firstDay: 1,
         eventLimit:true,
		 googleCalendarApiKey: 'AIzaSyDzUvSPXi93saIWTnMO70RG0-w4e54ipQo',
		 events: {
          googleCalendarId: 'en.indian#holiday@group.v.calendar.google.com',
          className: 'gcal-event' // an option!
        },
        eventClick: function(event) {
             // opens events in a popup window
             window.open(event.url, '_blank', 'width=700,height=600');
             return false;
       },
       eventRender: function(event, element) {
           $(element).tooltip({title: event.title});
       }
   });*/
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>

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
window.onload = function () {
   
/*var leadconversion = document.getElementById('leadconversion');
 myChart = new Chart(leadconversion, {
    type: 'bar',
    data: {
        labels: ['Target', 'Booking for leads'],
        datasets: [{
          
            data: [<?php echo $monthly_target_all_closer; ?>, booking],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
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
});
*/
/*var clientconversion = document.getElementById('clientconversion');
var myChart1 = new Chart(clientconversion, {
    type: 'bar',
    data: {
        labels: ['Target', 'Booking for clients'],
        datasets: [{
   
            data: [<?php echo $monthly_target_all_opener; ?>, booking],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
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
});
    
*/


var ctx = document.getElementById('chartAllCloser').getContext('2d');
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
 });
// New Chart Closers
var ctx3 = document.getElementById('chartAllContract').getContext('2d');
var myChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: <?php echo $contracts_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $monthly_target_all_technical; ?>',
            data: <?php echo $contracts_chart_data;?>,
            backgroundColor: chart_background,
            borderColor: chart_background,
            borderWidth: 1,
            fill: true
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
                     labelString: 'Contracts'
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

$("#user_first,#user_second").select2();
$("#closer").select2();
$("#opener").select2();

compareChart('c-container-first', 'chartUser1');
compareChart('c-container-second', 'chartUser2');

getbookings('#opener', 'leadconversion');
getbookings('#closer', 'clientconversion');
}
$("#hot-leads").DataTable({responsive: true,
        ordering: false,
        paging: false,
        searching:false,
        dom: 't',
        keys: true,
 });
$("#dead-leads").DataTable({responsive: true,
        ordering: false,
        paging: false,
        searching:false,
        dom: 't',
        keys: true,
 });

 function compareChart(container_id, chart, year){
    //alert(container_id);
    var url = $("#"+container_id).find('select').val();
    if(year)
    {
    url  = url + '&year=' + year;
    }else
    {
     url  = url + '&year=' + $("#"+container_id).find('.year').val();   
    }
    $.ajax({
        type:'get',
        url:url,
        dataType:'json',
        success:function(data){
            console.log(data);
             $('#'+chart).replaceWith('<canvas id="'+chart+'"></canvas>');
             $('#'+container_id).find('.year').val(data.year);
             $('#'+container_id).find('.year_label').text(data.year);
            var config = {
              type: 'bar',
              data: {
                labels: data.user1_chart_label,
                datasets: [{
                  label: "Target: "+data.selected_user_data.monthly_target,
                  data: data.user1_chart_data,
                  fill: false,
                  backgroundColor: chart_background,
                  borderColor: chart_background,
                  borderWidth: 1,
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
                                 labelString: data.charYaxis
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
            };
            var chartUser = document.getElementById(chart).getContext("2d");
            var User = new Chart(chartUser, config);
            User.update();
        }   
    })
 }

var base_url = '<?php echo base_url();?>'; 
$('.user_prev').click(function(){
    var id  = $(this).closest('.chart-container').attr('id');
    var canvas = $('#'+id).find('canvas').attr('id');
    var year = $('#'+id).find('.year').val();
     year = parseInt(year) - 1;
    compareChart(id, canvas, year);
    $('#'+id).find('.this_year').removeClass('hide');
});
$('.user_next').click(function(){
    var id  = $(this).closest('.chart-container').attr('id');
    //alert(id);
    var canvas = $('#'+id).find('canvas').attr('id');
    var year = $('#'+id).find('.year').val();
    var current_year = '<?php echo date("Y");?>';
     year = parseInt(year) + 1;
     compareChart(id, canvas, year);
     $('#'+id).find('.this_year').removeClass('hide');
     if(current_year == year){ $('#'+id).find('.this_year').addClass('hide'); }
    
});
$('.this_year').click(function(){
    var id  = $(this).closest('.chart-container').attr('id');
    var canvas = $('#'+id).find('canvas').attr('id');
    $('#'+id).find('.year').val('<?php echo date('Y');?>');
    var year = $('#'+id).find('.year').val();
    compareChart(id, canvas, year);
    $('#'+id).find('.this_year').addClass('hide');
});


$(document).on('click', '#record_unfollow_id', function(){
    var record_id = $(".all_records").val();
      $.ajax({
          method:"post",
          url:base_url + 'booking/unfollowlead',
          data:{'record_id':record_id},
          success:function(data){

            window.location.reload();}
        });
  });
 $(document).on('click', '#unfollow_id', function(){
    var record_id = $(this).attr("data-record");
    $('.all_records').val(record_id);
    $('#modalunfollow').modal('show');
});


function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
var dataset;
var meta;
var total;
var currentValue;
var percentage;
var color = new Array();
var lead_percent = new Array();
var lead_counts = <?php echo json_encode($lead_details['lead_counts']); ?>;
var total_leads = <?php echo $total_leads; ?>;

var client_percent = new Array();
var client_counts = <?php echo json_encode($client_details['client_counts']); ?>;
var total_clients = <?php echo $total_clients; ?>;

//console.log(lead_counts);
//console.log(lead_counts[0]);
for(var i=0; i< <?php echo $lead_details_count; ?>; i++)
{
    var per = Math.round(lead_counts[i]*100 / total_leads);
    var totalPer = per + "%";
    lead_percent.push(per);
    color.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
}


var randomScalingFactor = function() {
  return Math.round(Math.random() * 100);
};
var randomColorFactor = function() {
  return Math.round(Math.random() * 255);
};
var randomColor = function(opacity) {
  return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
};

var config = {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($lead_details['openers']); ?>,
    datasets: [{
      lable:<?php echo json_encode($lead_details['openers']); ?>,
      data: lead_percent ,
      backgroundColor: color,
      //label: 'Expenditures'
    }],
    
  },
  options: {
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
          return dataLabel + '%';
        }
      }
    }
  }
};

var ctx = document.getElementById("leadChart").getContext("2d");
    window.myDoughnut = new Chart(ctx, config); {
}
for(var i=0; i< <?php echo $client_details_count; ?>; i++)
{
    var per = Math.round(client_counts[i]*100 / total_clients);
    client_percent.push(per);
    color.push('#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6));
}

var configClients = {
  type: 'doughnut',
  data: {
    labels: <?php echo json_encode($client_details['closer']); ?>,
    datasets: [{
      lable:<?php echo json_encode($client_details['closer']); ?>,
      data: client_percent ,
      backgroundColor: color,
      //label: 'Expenditures'
    }],
    
  },
  options: {
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
          return dataLabel + '%';
        }
      }
    }
  }
};

var ctxclient = document.getElementById("clientChart").getContext("2d");
    window.myDoughnut = new Chart(ctxclient, configClients); {
}

function getbookings(id,chartId){
    var target;
    var user_id = $(id).children("option:selected").val();
    var user_name = $(id).children("option:selected").text();
    var module_id = $(id).attr('data-module');
    if(module_id ==1){
        if(user_id == ''){
            user_name = ' leads'
        }
         target = <?php echo $monthly_target_all_closer; ?>
    }else{
        if(user_id == ''){
            user_name = ' clients'
        }
        target= <?php echo $monthly_target_all_opener; ?>
    }
    $.ajax({
    type: "post",
    dataType: "json",
    url: base_url+'Dashboard/getbookings',
    data: { user_id : user_id, module_id : module_id},
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
               labels: ['Target', 'Total Booking ','Confirmed Booking'],
                datasets: [{
            label: 'Target of'+user_name+' is '+target,
            data: [target, total_booking,confirmed_booking],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 0.2)',
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