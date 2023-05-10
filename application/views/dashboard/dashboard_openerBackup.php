<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>


<style>
a.canvasjs-chart-credit {display:none;}

table.dataTable tr.child ul {width:100%;}
.table-title {padding:20px; text-align:center;}

table {width:100% !important; color:#404E67; max-width:100%; border-bottom:1px solid #e3ebf3;}
table.dataTable.no-footer {border-bottom:1px solid #e3ebf3;}
table.dataTable thead th {vertical-align:bottom; border-bottom:2px solid #E3EBF3; border-top:1px solid #E3EBF3; padding:10px 18px; width:auto !important;}
table td, table.dataTable tbody td {padding:10px 18px;}
table td a {color:#009C9F;}
table td .list_link {color:#009C9F !important;}
table tbody tr:hover {background:rgba(245,247,250,.5);}
table tbody .info_status span {padding:4.5px 7px; color:#fff; font-size:13px; border-radius:2px; display:inline-block;}

table.dataTable.dtr-inline.collapsed tbody td:first-child:before, table.dataTable.dtr-inline.collapsed tbody th:first-child:before {top:50%; margin-top:-10px;}
</style>


<?php //echo $monthly_bookings; die('in');?> 
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
			
		<div class="row">
				
        <div class="col-xs-12">
			<div id="dynamic_content" style="margin-top: 10px;background: #fff;">
				<div class="table-title"> <h3>BOOKINGS</h3></div>
				<div>
				<form id="record_list_table">
					
					<table id="dynamic-table" class="datatable">
						
						<thead>
							<tr>
								<th nowrap>Lead Name</th>
								<th nowrap>Booking Title</th>
								<th nowrap>Booking Date</th>
								<th nowrap>Booking Time</th>
								<th nowrap>Name</th>
								<th nowrap>Email</th>                    
								<th nowrap>Status</th>                    
								<th nowrap>Created By</th>
								<th nowrap>Created Time</th>							
							</tr>
						</thead>
					
						<tbody>
							<?php
						if(!empty($bookings)) 
						{	
							$i=1; 
							foreach ($bookings as $key => $bkng)
							{							
							
							if($bkng["status"]==0){  $info = 'info-warning'; }
							else if($bkng["status"]==1){  $info = 'info-success'; }
							else if($bkng["status"]==2){  $info = 'info-danger'; } 
							else {  $info = ''; } 
							
							?>
	       
	            <tr>
	                <td nowrap><a class="list_link" href="<?php echo base_url(). 'index.php/modules/viewRecord/?cm=Leads&id='.$bkng["record_id"].'&record_status='.$bkng['record_status']; ?>"><?php echo $bkng["value"]; ?></a></td>
	                <td nowrap><?php echo $bkng["booking_title"]; ?></td>
	                <td nowrap><?php echo date("m/d/Y", strtotime($bkng["booking_date"]));?></td>
	                <td nowrap><?php echo date("h:ia", strtotime($bkng["booking_date"])); ?></td>
	                <td nowrap><?php echo $bkng["name"]; ?></td>
	                <td nowrap><?php echo $bkng["email"]; ?></td>
	                <td nowrap class="info_status info_status_<?php echo $bkng["id"]; ?>"><span class="<?php echo $info; ?>"><?php echo $booking_status[$bkng["status"]]; ?></span></td>
	                <td nowrap><?php echo $bkng["first_name"].' '.$bkng["last_name"]; ?></td>
	                <td nowrap ><?php echo date("m/d/Y", strtotime($bkng["booking_created_time"])); ?></td>
	            </tr>
            
			         <?php $i++; 
			         }
						}
						else 
						{ ?>
							<!-- <div class="no-content">No Records Found!</div> -->
						<?php }
						?>
						</tbody>
					
					</table>
					
				</form>
			
				</div>
			</div>
      
		</div>	
				
        <div class="col-xs-12">
			<div id="dynamic_content" style="margin-top:50px; background:#fff;">
				<div class="table-title"> <h3>Upcoming Activities - Bookings & Reminders</h3></div>
				<div>
				<form id="record_list_table">

					<table id="dynamic-table" class="datatable">
					<?php
						// if(!empty($upcoming_bookings)) 
						// {	?>		
						<thead>
							<tr>
								<th nowrap>Lead Name</th>
								<th nowrap>Booking Title</th>
								<th nowrap>Booking Date</th>
								<th nowrap>Booking Time</th>
								<th nowrap>Name</th>
								<th nowrap>Email</th>                    
								<th nowrap>Status</th>                    
								<th nowrap>Created By</th>
								<th nowrap>Created Time</th>
							
							</tr>
							
						</thead>
					<?php // } ?>	
						<tbody>
							<?php
						if(!empty($upcoming_bookings)) 
						{	
							$i=1; 
							foreach ($upcoming_bookings as $key => $bkng)
							{							
							
							if($bkng["status"]==0){  $info = 'info-warning'; }
							else if($bkng["status"]==1){  $info = 'info-success'; }
							else if($bkng["status"]==2){  $info = 'info-danger'; } 
							else {  $info = ''; } 
							
							?>
	   
	        <tr>                       
	            <td nowrap><a class="list_link" href="<?php echo base_url(). 'index.php/modules/viewRecord/?cm=Leads&id='.$bkng["record_id"].'&record_status='.$bkng['record_status']; ?>"><?php echo $bkng["value"]; ?></a></td>
	            <td nowrap><?php echo $bkng["booking_title"]; ?></td>
	            <td nowrap><?php echo date("m/d/Y", strtotime($bkng["booking_date"]));?></td>
	            <td nowrap><?php echo date("h:ia", strtotime($bkng["booking_date"])); ?></td>
	            <td nowrap><?php echo $bkng["name"]; ?></td>
	            <td nowrap><?php echo $bkng["email"]; ?></td>
	            <td nowrap class="info_status_<?php echo $bkng["id"]; ?>"><span class="<?php echo $info; ?>"><?php echo $booking_status[$bkng["status"]]; ?></span></td>
	            <td nowrap><?php echo $bkng["first_name"].' '.$bkng["last_name"]; ?></td>
	            <td nowrap ><?php echo date("m/d/Y", strtotime($bkng["booking_created_time"])); ?></td>

	        </tr>
	        
	      
	     <?php $i++; 
	     }
					
						} 
				
					else 
					{ ?>
						
						<!-- <div class="no-content">No Records Found!</div> -->
						
					<?php }
					?>
							</tbody>
					
					</table>
					
				</form>
				</div>
			</div>
	  
		</div>	
				
		</div>

		<div class="row">
				
        <div class="col-xs-12">
		<div id="dynamic_content" style="margin-top:50px;background:#fff;">
			<div class="table-title"> <h3>HOT Leads (OPENER)</h3> </div>
			<div>
			<form id="record_list_table">

				<table id="dynamic-table" class="datatable">
					<thead>
						<tr>
							
						<?php 
						if(!empty($record_data))
						{
							$query_string = '';$cur_page = '';
							foreach ($record_data as $key => $record)
							{
					?>
						<!--th nowrap="nowrap">Date & Time</th-->
						<?php
							foreach ($record['meta'] as $metaFieldName => $metaValue)
							{
								?>
								<th nowrap>
									<a 														
										<?php if($sort_column == $metaFieldName){?>style="color:#007CB2"<?php }?> 
										
										href="<?php echo base_url() ?>index.php/modules/?cm=<?php echo $current_module; ?>
										
										&own=<?=$own?>
										&rStat=<?=$recordStatus?>
										&<?=$query_string?>
										&page=<?=$cur_page?>
										&num_records_per_page=<?=$records_per_page?>
										&sort_column=<?=$metaFieldName?>
										&sort_order=<?=($sort_order == 'ASC' && $sort_column == $metaFieldName)?'DESC':'ASC'?>"
									>
									
										<?php echo $metaFieldName ?>
									
										<?php if($sort_column == $metaFieldName){?> 
										<!--i class="fa fa-caret-<?=($sort_order == 'ASC')?'down':'up'?>"></i-->
										<?php }?>
									</a>
								</th>
							<?php
							}
							break;
						}
						?>
						</tr>
						
						</thead>
						<tbody>
						<?php
						foreach ($record_data as $key => $record)
						{
								?>
								<tr>									
									
									<!--td><?php //echo date("j-F-Y", $record['static']["created_time"]); ?></td-->							
									
										<?php
										$link = false;
										foreach ($record['meta'] as $metaFieldName => $metaValue) {
												$column_value = $metaValue;
												if (is_array($column_value)){
														$column_value = '';
														foreach ($metaValue as $singleValueKey => $singleValue){
																$column_value .= ($column_value == '') ? "&lt;$singleValue&gt;" : ", &lt;$singleValue&gt;";
														}
												}
												?>
												<td>
														<?php
														if ($link == false && $metaFieldName == 'Company Name') {
																echo '<a class="list_link" href="' . base_url() . 'index.php/modules/viewRecord/?cm=' . $current_module  . "&id=$key&record_status=" . $record['static']['record_status'] . '">';
														}

														if ($link == false && $metaFieldName == 'Company Name') {
																if ($column_value == '') {
																		echo "No $metaFieldName available";
																} else {
																		echo $column_value;
																}
														} else if ($metaFieldName == 'Expected Technical Start Date') {
																if ($column_value == '') {
																		echo "No $metaFieldName available";
																} else {
																		echo date("m/d/Y", strtotime($column_value));
																}
														}else if ($metaFieldName == 'Closer') {
																if ($column_value == '') {
																		echo "No $metaFieldName available";
																} else {
																	foreach($users_list as $arr_usr)
                            {
																		if($arr_usr['id'] == $column_value)
																		{
																			$opener = $arr_usr['title'];
																		}
																		if($arr_usr['id'] == $column_value)
																		{
																			$closer = $arr_usr['title'];
																		}
																	}
																	echo $opener;
																}
														} else {
																echo $column_value;
														}

														if ($link == false && $metaFieldName == 'Company Name') echo '</a>';
														if ($link == false && $metaFieldName == 'Company Name')
															$link = true;
														?>
												</td>
										<?php } ?>
								</tr>
						<?php 
						} 
				} else { ?>
					
					<div class="no-content">No Records Found!</div>
					
				<?php }
				?>
						</tbody>
				</table>
				
			</form>
			</div>
		</div>
  
		</div>

        <div class="col-xs-12">
			<div id="dynamic_content" style="margin-top:50px;background: #fff;">
				<div class="content-title">BAR GRAPH - STATS - MONTHLY BOOKINGS vs TARGETS</div>						
				<div >
				<form id="record_list_table">

					<!-- <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->
					<canvas id="chartOpener" style="height: 300px; width: 100%;"></canvas>
						
				</form>
				</div>
			</div>
		</div>
	
	</div>
    
	
    </section>
</section>
<!--main content end-->

<!-- <script type="text/javascript" src="<?php //echo base_url() ?>static/graph/canvasjs.min.js"></script> -->

<script>
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

}
</script>



<script type="text/javascript">
$(document).ready(function(){
	$(".datatable").DataTable({responsive: true,
	    ordering: false,
	    paging: false,
	    searching:false,
	    dom: 't',
	    keys: true,
	});
});
</script>