<style>

</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
			
			<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Leads</span>
              <span class="info-box-number"><?php echo $total_leads; ?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fas fa-ban"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cancelled Leads</span>
              <span class="info-box-number"><?php echo $cancelled_leads; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="far fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Won Leads</span>
              <span class="info-box-number"><?php echo $won_leads; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-address-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Clients</span>
              <span class="info-box-number"><?php echo $total_clients; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
			
			<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Appointments</span>
              <span class="info-box-number"><?php echo $total_appointments; ?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          
        </div>
        
            <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Appointments</span>
              <span class="info-box-number"><?php echo $new_appointments; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
  
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Confirmed Appointments</span>
              <span class="info-box-number"><?php echo $confirmed_appointments; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
  
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="far fa-window-close"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cancelled Appointments</span>
              <span class="info-box-number"><?php echo $cancelled_appointments; ?></span>
            </div>
           
          </div>
         
        </div>
      
        <div class="clearfix visible-sm-block"></div>

    
      </div>
			
			<div class="row">
				
        <div class="col-md-6 col-sm-6 col-xs-12">
					<div id="dynamic_content" style="overflow-x: auto;margin-top: 10px;min-height: 300px;background: #fff;">
						<div class="content-title">Today's Leads</div>						
						<div>
						<form id="record_list_table">
	
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
									<thead>
									<tr>
										
							<?php if(!empty($record_data))
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
								
								<div class="no-content">No Leads Found!</div>
								
							<?php }
							?>
									</tbody>
							</table>
							
						</form>
						</div>
					</div>
              
				</div>	
				
        <div class="col-md-6 col-sm-6 col-xs-12">
					<div id="dynamic_content" style="overflow-x: auto;margin-top: 10px;min-height: 300px;background: #fff;">
						<div class="content-title">Closing This Month</div>						
						<div>
						<form id="record_list_table">
	
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
									<thead>
									<tr>
										
							<?php if(!empty($record_data123))
							{
									foreach ($record_data as $key => $record)
											{
												foreach ($record['meta'] as $metaFieldName => $metaValue)
												{
													?>
													<th nowrap="nowrap"><a <?php if($sort_column == $metaFieldName){?>style="color:#007CB2"<?php }?> href="<?php echo base_url() ?>index.php/modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=$cur_page?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$metaFieldName?>&sort_order=<?=($sort_order == 'ASC' && $sort_column == $metaFieldName)?'DESC':'ASC'?>"><?php echo $metaFieldName ?><?php if($sort_column == $metaFieldName){?> <i class="fa fa-caret-<?=($sort_order == 'ASC')?'down':'up'?>"></i><?php }?></a></th>
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
													<?php if ($writePermission == true) { ?>
															<td class="center"><input type="checkbox" value="<?php echo $key; ?>"
																												id="<?php echo $key; ?>"/></td>
													<?php } ?>
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
								
								<div class="no-content">No Deals Found!</div>
								
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


