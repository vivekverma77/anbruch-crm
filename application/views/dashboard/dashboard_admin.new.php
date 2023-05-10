<link href="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.css" rel="stylesheet" />
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



.hot-leads-table {background:#fff; padding:9px 0 0; color:#404E67; font-size:14px; margin-top:50px;}
.hot-leads-table h3 {padding:20px; text-align:center;}
.hot-leads-table table {width:100%}
.hot-leads-table th {vertical-align:bottom; border-bottom:2px solid #E3EBF3; border-top:1px solid #E3EBF3;}
.company {color:#009C9F}
.hot-leads-table tbody tr {border-bottom:1px solid #E3EBF3;}
.hot-leads-table tbody tr:hover {background:rgba(245,247,250,.5)}
.hot-leads-table tbody .status span {padding:4.5px 7px; background:#000; color:#fff; font-size:13px; border-radius:2px; display:inline-block;}
.hot-leads-table tbody .ASSIGNED.TO.OPENER span {background:#16D39A;}
.hot-leads-table tbody .ASSIGNED.TO.CLOSER span {background:#ffc722;}
.hot-leads-table tbody .NO.OPPORTUNITY span {background:#ff6b68;}

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

.data-cols {background:#fff; padding:0; text-align:center; height:168px; display:flex;}
.data-cols .col {padding:7px 5px; box-shadow:0 10px 40px 0 rgba(62,57,107,.07), 0 2px 9px 0 rgba(62,57,107,.06);}
.data-cols .center-col {border:solid #ECEFF1; border-width:0 1px;}

span.col-title {margin-top:10px; display:block; font-weight:600; font-size:15px;}
span.circle {border:5px solid; color:#16D39A; margin-top:16px; display:inline-block; border-radius:50%; width:64px; height:64px; line-height:56px; font-size:30px;}
.TI span.circle {margin-top:36px;}

    @media (max-width:1244px){
        .stats-card .icon {width:54px; height:54px; font-size:30px; line-height:55px; margin-top:24px;}
        .stats-card .icon-crm-calendar {font-size:25px !important;}
        .data-cols {height:188px;}
        #main-content:not(.merge-left) .L2C span.circle {margin-top:36px;}
    }
    @media (max-width:1044px){
        #main-content:not(.merge-left) .stats-card {display:block;}
        #main-content:not(.merge-left) .stats-card .left-col {position:absolute;}
        #main-content:not(.merge-left) .stats-card .icon {margin-top:-10px;}
        #main-content:not(.merge-left) .calendar-row .main-cols {width:100%;}
        #main-content:not(.merge-left) .calendar-row .col-left .row {width:50%; margin-left:0;margin-right:0;}
    }

</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
			
		<div class="row stats-row">
		
		<div class="col-xs-12" style="margin-bottom:30px;">
			<div class="row">
				<div class="col-sm-3 card-col">
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

				<div class="col-sm-3 card-col">
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

				<div class="col-sm-3 card-col">
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

				<div class="col-sm-3 card-col">
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

	<div class="clearfix calendar-row" style="margin:30px -15px 0 0;">
		<div class="col-xs-4 main-cols col-left">
			<div class="row">
				<div class="card card--inverse widget-past-days">
                    <div class="card-body">
                        <h4 class="card-title">Booking Status</h4>
                        <h6 class="card-subtitle">This week</h6>
                    </div>
                    <div style="margin:-30px -1px 0;">
                    	<img src="<?php echo base_url() ?>/assets/images/wave.jpg" style="max-width:100%">
                    </div>
                    <div class="listview listview--inverse listview--striped">
                        <div class="listview__item">
                            <div class="widget-past-days__info">
                                <small>New</small>
                                <h3><?php echo isset($newBookingInWeek) ? sprintf("%02d",$newBookingInWeek) : 0;?></h3>
                            </div>
                        </div>

                        <div class="listview__item">
                            <div class="widget-past-days__info">
                                <small>Confirmed</small>
                                <h3><?php echo isset($confirmedBookingInWeek) ? sprintf("%02d",$confirmedBookingInWeek) : 0;?></h3>
                            </div>
                        </div>

                        <div class="listview__item">
                            <div class="widget-past-days__info">
                                <small>Cancelled</small>
                                <h3><?php echo isset($cancelledBookingInWeek) ? sprintf("%02d",$cancelledBookingInWeek) : 0;?></h3>
                            </div>
                        </div>

                        <div class="listview__item">
                            <div class="widget-past-days__info">
                                <small>Time Suggested</small>
                                <h3><?php echo isset($suggestedBookingInWeek) ? sprintf("%02d",$suggestedBookingInWeek) : 0;?></h3>
                            </div>
                        </div>
                    </div>
                </div>
	    	</div>
	    	<div class="row data-cols">
	    		<div class="col-xs-4 col TQL">
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
	    		</div>
	    	</div>
	    </div>

	    <div class="col-xs-8 main-cols col-right" style="padding-left:30px;">
        	<!-- <img src="<?php echo base_url() ?>/assets/images/event-cal.jpg" style="max-width:100%"> -->
        	<div class="calendar-header"> <h2>Holiday Schedule</h2></div>
        	<div id="calendar"></div>
	    </div>

    </div>

    <!-- <div>
        
        closer target <?php echo $monthly_target_all_closer; ?>
        closer technical <?php echo $monthly_target_all_technical; ?>
    </div>

    <div class="row target-row" style="margin-top:50px;">
        <div class="col-xs-8 card">
            <div class="co" style="background:#fff; padding:10px 15px 15px; ">
                <div class="col-title"> <h3>Opners</h3> </div>
                <div id="lead-opners" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
        <div class="col-xs-4 card">
            <div class="targes">
                <h4> Opners Target </h4>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:38.89%"> </div> 
                </div>
                <p>21 of <b><?php echo $monthly_target_all_opener; ?></b></p>
            </div>        </div>
    </div> -->

    <div class="hot-leads-table">
    	<h3>HOT LEADS</h3>
    	<div class="table">
    		<table id="hot-leads">
    			<thead>
    				<tr>
    					<th nowrap>Customer Name</th>
    					<th nowrap>Company Name</th>
    					<th nowrap>Country</th>
    					<th nowrap>Phone</th>
    					<th nowrap>Email</th>
    					<th nowrap>Lead Status</th>	
    				</tr>
    			</thead>
                <tbody>
               <?php
                    if(!empty($record_data_all_opener)){ //print_r($topHotLeads);
                        foreach ($record_data_all_opener as $key => $record_data) { 
                            $record_data_meta = $record_data['meta'];
                    ?>
                        <tr>
                            <td><?php echo !empty($record_data_meta['First Name']) ? $record_data_meta['First Name'] : '';?><?php echo !empty($record_data_meta['Last Name']) ? ' '.$record_data_meta['Last Name'] : '';?></td>
                            <td class="company"><?php echo !empty($record_data_meta['Company Name']) ? $record_data_meta['Company Name'] : '';?></td>
                            <td><?php echo !empty($record_data_meta['Country']) ? $record_data_meta['Country'] : '-';?></td>
                            <td><?php echo !empty($record_data_meta['Phone']) ? $record_data_meta['Phone'] : '-';?></td>
                            <td> <a href="mailto:<?php echo !empty($record_data_meta['Email']) ? $record_data_meta['Email'] : '';?>"><?php echo !empty($record_data_meta['Email']) ? $record_data_meta['Email'] : '-';?></a> </td>
                            <td class="status <?php echo !empty($record_data_meta['Lead Status']) ? $record_data_meta['Lead Status'] : '';?>"> <span><?php echo !empty($record_data_meta['Lead Status']) ? $record_data_meta['Lead Status'] : '-';?></span> </td>
                       </tr>
                    <?php   }
                    }

                    ?>
                    <?php
                    if(!empty($record_data_all_closer)){ //print_r($topHotLeads);
                        foreach ($record_data_all_closer as  $record_data2) { 
                            $record_data_meta2 = $record_data2['meta'];
                    ?>
                        <tr>
                            <td><?php echo !empty($record_data_meta2['First Name']) ? $record_data_meta2['First Name'] : '';?><?php echo !empty($record_data_meta2['Last Name']) ? ' '.$record_data_meta2['Last Name'] : '';?></td>
                            <td class="company"><?php echo !empty($record_data_meta2['Company Name']) ? $record_data_meta2['Company Name'] : '';?></td>
                            <td><?php echo !empty($record_data_meta2['Country']) ? $record_data_meta2['Country'] : '-';?></td>
                            <td><?php echo !empty($record_data_meta2['Phone']) ? $record_data_meta2['Phone'] : '-';?></td>
                            <td> <a href="mailto:<?php echo !empty($record_data_meta['Email']) ? $record_data_meta['Email'] : '';?>"><?php echo !empty($record_data_meta2['Email']) ? $record_data_meta2['Email'] : '-';?></a> </td>
                            <td class="status <?php echo !empty($record_data_meta2['Lead Status']) ? $record_data_meta2['Lead Status'] : '';?>"> <span><?php echo !empty($record_data_meta2['Lead Status']) ? $record_data_meta2['Lead Status'] : '-';?></span> </td>
                       </tr>
                    <?php   }
                    }

                    ?>
                </tbody>

     			<!-- <tbody>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status opener"> <span> ASSIGNED TO OPENER  </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status opener"> <span> ASSIGNED TO OPENER  </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status closer"> <span> ASSIGNED TO CLOSER  </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status no-opp"> <span> NO OPPORTUNITY </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status no-opp"> <span> NO OPPORTUNITY </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status opener"> <span> ASSIGNED TO OPENER  </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status no-opp"> <span> NO OPPORTUNITY </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status default"> <span> RESEARCH REQUIRED  </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status closer"> <span> ASSIGNED TO CLOSER  </span> </td>
    				</tr>
    				<tr>
    					<td>Lorem Ipsum Dolor</td>
    					<td class="company">Consquetre</td>
    					<td>Canada</td>
    					<td>+91-917-921-8906</td>
    					<td> <a href="mailto:demo@example.com">demo@example.com</a> </td>
    					<td class="status opener"> <span> ASSIGNED TO OPENER  </span> </td>
    				</tr>
    			</tbody>-->
    		</table>
    	</div>
    </div>

    </section>
</section>
<!--main content end-->

<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/fullcalendarv3.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/gcal.min.js"></script>

<script>
$('#calendar').fullCalendar({
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
   });
</script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("lead-opners", {
    animationEnabled: true,  
    axisY: {
        title: "Revenue in USD",
        valueFormatString: "#0,,.",
        suffix: "mn",
        prefix: "$"
    },
    data: [{
        type: "splineArea",
        color: "rgba(54,158,173,.7)",
        markerSize: 5,
        xValueFormatString: "YYYY",
        yValueFormatString: "$#,##0.##",
        dataPoints: [
        { x: new Date(2012, 00, 1), y: 1352 },
        { x: new Date(2012, 01, 1), y: 1514 },
        { x: new Date(2012, 02, 1), y: 1321 },
        { x: new Date(2012, 03, 1), y: 1163 },
        { x: new Date(2012, 04, 1), y: 950  },
        { x: new Date(2012, 05, 1), y: 1201 },
        { x: new Date(2012, 06, 1), y: 1186 },
        { x: new Date(2012, 07, 1), y: 1281 },
        { x: new Date(2012, 08, 1), y: 1438 },
        { x: new Date(2012, 09, 1), y: 1305 },
        { x: new Date(2012, 10, 1), y: 1480 },
        { x: new Date(2012, 11, 1), y: 1391 }        
        ]
    }]
    });
chart.render();

}
</script>