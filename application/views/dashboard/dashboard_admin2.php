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

</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
			
		<div class="row">
		
		<div class="col-xs-12" style="margin-bottom:30px;">
			<div class="row">
				<div class="col-sm-3">
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

				<div class="col-sm-3">
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

				<div class="col-sm-3">
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

				<div class="col-sm-3">
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

        <div class="col-md-6 col-sm-6 col-xs-12">
					<div id="dynamic_content" style="margin-top:10px;background: #fff;">
						<div class="content-title">STATS – ALL OPENERS – (MONTHLY, YTD) <i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#stats-AO"></i> </div>						
						<div id="stats-AO" class="collapse in">
							<div style="overflow: auto; min-height: 350px; height: 350px;">
								<form id="record_list_table">
									<div id="chartContainerAllOpener" style="height: 300px; width: 100%;">Loading..</div>
									<canvas id="chartAllOpener" width="400" height="400"></canvas>
								</form>
							</div>
						</div>
					</div>
              
				</div>	
				
        <div class="col-md-6 col-sm-6 col-xs-12">
					<div id="dynamic_content" style="margin-top:10px;background: #fff;">
						<div class="content-title">Top 20  - Hot leads (ALL OPENERS) <i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#leads-AO"></i> </div>

					  <div id="leads-AO" class="collapse in">						
						<div style="overflow: auto; min-height: 350px; height: 350px;">
						<form id="record_list_table">
	
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
								<thead style="background:#dadde8;">
									<tr>
										
							<?php 
							if(!empty($record_data_all_opener))
							{
								$query_string = '';$cur_page = '';
								foreach ($record_data_all_opener as $key => $record)
								{
								
						?>
							<!--th nowrap="nowrap">Date & Time</th-->
							<?php
												foreach ($record['meta'] as $metaFieldName => $metaValue)
												{
													?>
													<th nowrap="nowrap">
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
									foreach ($record_data_all_opener as $key => $record)
									{
											?>
											<tr>									
												
												<!--td><?php echo date("j-F-Y", $record['static']["created_time"]); ?></td-->							
												
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
															<td nowrap="nowrap">
																	<?php
																	if ($link == false && $metaFieldName == 'Company Name') {
																			echo '<a class="list_link" href="' . base_url() . 'modules/viewRecord/?cm=' . $current_module  . "&id=$key&record_status=" . $record['static']['record_status'] . '">';
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
																					echo date("j-F-Y", strtotime($column_value));
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
					  </div> <!-- /#leads-AO -->
					</div>
              
				</div>	
				
			</div>
    
			<div class="row">
				
        <div class="col-md-6 col-sm-6 col-xs-12">
			<div id="dynamic_content" style="margin-top:30px;background: #fff;">
				<div class="content-title">STATS – ALL CLOSERS - (MONTHLY, YTD) <i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#stats-AC"></i></div>
				<div id="stats-AC" class="collapse in">
					<div style="overflow: auto; min-height: 350px; height: 350px;">
						<form id="record_list_table">
							<div id="chartContainerAllCloser" style="height: 300px; width: 100%;">Loading..</div>
							<canvas id="chartAllCloser" width="400" height="400"></canvas>
						</form>
					</div>
				</div>
			</div>
              
		</div>	
				
        <div class="col-md-6 col-sm-6 col-xs-12">
					<div id="dynamic_content" style="margin-top:30px;background: #fff;">
						<div class="content-title">Top 20  - Hot leads (ALL CLOSERS)  <i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#leads-AC"></i></div>						
					<div id="leads-AC" class="collapse in">
						<div style="overflow: auto; min-height: 350px; height: 350px;">
						<form id="record_list_table">
	
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
								<thead style="background:#dadde8;">
									<tr>
										
							<?php 
							if(!empty($record_data_all_closer))
							{
								$query_string = '';$cur_page = '';
								foreach ($record_data_all_closer as $key => $record)
								{
						?>
							<!--th nowrap="nowrap">Date & Time</th-->
							<?php
												foreach ($record['meta'] as $metaFieldName => $metaValue)
												{
													?>
													<th nowrap="nowrap">
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
									foreach ($record_data_all_closer as $key => $record)
									{
										

											?>
											<tr>									
												
												<!--td><?php echo date("j-F-Y", $record['static']["created_time"]); ?></td-->							
												
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
															<td nowrap="nowrap">
																	<?php
																	if ($link == false && $metaFieldName == 'Company Name') {
																			echo '<a class="list_link" href="' . base_url() . 'modules/viewRecord/?cm=' . $current_module  . "&id=$key&record_status=" . $record['static']['record_status'] . '">';
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
																					echo date("j-F-Y", strtotime($column_value));
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
					</div>  <!-- /#leads-AC -->
				
					</div>
              
				</div>	   
				
			</div>
    
			<div class="row">
				
        <div class="col-md-6 col-sm-6 col-xs-12">
			<div id="dynamic_content" style="margin-top:30px;background: #fff;">
				<div class="content-title">STATS – ALL TECHNICAL CONSULTANTS – (MONTHLY, YTD) <i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#stats-ATC"></i></div>						

				<div id="stats-ATC" class="collapse in">	
					<div style="overflow: auto; min-height: 350px; height: 350px;">
					<form id="record_list_table">
						<div id="chartContainerAllContract" style="height: 300px; width: 100%;">Loading..</div>
						<canvas id="chartAllContract" width="400" height="400"></canvas>
					</form>
					</div>
				</div>

			</div>
              
		</div>	
				
        <div class="col-md-6 col-sm-6 col-xs-12">
			<div id="dynamic_content" style="margin-top:30px;background: #fff;">
				<div class="content-title">CONTRACTS<i class="fa fa-chevron-up btn-collapse" data-toggle="collapse" data-target="#contracts"></i></div>						

				<div id="contracts" class="collapse in">					
					<div style="overflow: auto; min-height: 350px; height: 350px;">
						<form id="record_list_table">
	
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
								<thead style="background:#dadde8;">
									<tr>
										
							<?php if(!empty($record_data_contract))
							{  $query_string = '';$cur_page = '';
								foreach ($record_data_contract as $key => $record)
									{
									foreach ($record['meta'] as $metaFieldName => $metaValue)
										{
										?>
										<th nowrap="nowrap">
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
									foreach ($record_data_contract as $key => $record)
									{
											?>
											<tr>													
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
									<?php } 
							} else { ?>
								
								<div class="no-content">No Records Found!</div>
								
							<?php }
							?>
									</tbody>
							</table>
							
						</form>
						</div>
					</div> <!-- /#contracts -->
					</div>
              
				</div>	   
				
			</div>
    
			<div class="row">
				
        <div class="col-md-12 col-sm-12 col-xs-12">
					<div id="dynamic_content" style="margin-top:30px;background: #fff;">
						<div class="content-title">STATS – TIMELINE DURATION CONTRACTS (MONTHLY AVERAGE TIME, YTD AVERAGE TIME</div>						
						<div style="overflow: auto; min-height: 350px; height: 350px;">
						<form id="record_list_table">
	
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
								<thead style="background:#dadde8;">
									<tr>
										
							<?php if(!empty($record_data123))
							{  $query_string = '';$cur_page = '';
									foreach ($record_data as $key => $record)
											{
												foreach ($record['meta'] as $metaFieldName => $metaValue)
												{
													?>
													<th nowrap="nowrap">
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
									<?php } 
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
				
       
			</div>
    		

    </section>
</section>
<!--main content end-->

<script type="text/javascript" src="<?php echo base_url() ?>static/graph/canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
window.onload = function () {	
	
	/*	var chart = new CanvasJS.Chart("chartContainerAllOpener", {
			title: {
				text: "Target: <?php echo $monthly_target_all_opener; ?>"
			},
		 	axisY: {
				title: "Bookings",
				titleFontSize: 15
			},
		 	axisX: {
				title: "Month",
				titleFontSize: 15
			},
			data: [
			{
					type: "column",
					dataPoints:<?php echo $monthly_bookings_all_opener; ?>
			}
			]
		});

		chart.render();
		
		
		var chartCloser = new CanvasJS.Chart("chartContainerAllCloser", {
			title: {
				text: "Target: <?php echo $monthly_target_all_closer; ?>"
			},
		 	axisY: {
				title: "Bookings",
				titleFontSize: 15
			},
		 	axisX: {
				title: "Month",
				titleFontSize: 15
			},
			data: [
			{
					type: "column",
					dataPoints:<?php echo $monthly_bookings_all_closer; ?>
			}
			]
		});

		chartCloser.render();

		var chartContract = new CanvasJS.Chart("chartContainerAllContract", {
			title: {
				text: "Target: <?php echo $monthly_target_all_technical; ?>"
			},
		 	axisY: {
				title: "Bookings",
				titleFontSize: 15
			},
		 	axisX: {
				title: "Month",
				titleFontSize: 15
			},
			data: [
			{
					type: "column",
					dataPoints:<?php echo $monthly_contracts; ?>
			}
			]
		});

		chartContract.render();*/

		
// New Chart Closers
var ctx = document.getElementById('chartAllCloser').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $closer_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $monthly_target_all_closer; ?>',
            data: <?php echo $closer_chart_data;?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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
// New Chart Closers
var ctx2 = document.getElementById('chartAllOpener').getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo $opener_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $monthly_target_all_opener; ?>',
            data: <?php echo $opener_chart_data;?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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
// New Chart Closers
var ctx3 = document.getElementById('chartAllContract').getContext('2d');
var myChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: <?php echo $contracts_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $monthly_target_all_technical; ?>',
            data: <?php echo $contracts_chart_data;?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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

}

</script>





