<style>

</style>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
			
	<div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
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
        <div class="col-md-4 col-sm-6 col-xs-12">
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
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Appointments</span>
              <span class="info-box-number"><?php echo $total_appointments; ?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          
        </div>
      </div>
	   <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
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
  
        <div class="col-md-4 col-sm-6 col-xs-12">
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
  
        
        <div class="col-md-4 col-sm-6 col-xs-12">
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
				
        <div class="col-md-12 col-sm-12 col-xs-12">
					<div id="dynamic_content" style="overflow-x: auto;margin-top: 10px;min-height: 300px;background: #fff;">
						<div class="content-title">Recent Leads</div>						
						<div>
						<form id="record_list_table">
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
							 <thead>
									<th>Company Name </th>
									<th>Title </th>
									<th>First Name </th>
									<th>Last Name </th>
									<th>Email </th>
									<th>Phone </th>
									<th>Lead Status </th>
							</thead>
							<tbody>
								<?php
								//	print_r($record_data);
									if(!empty($record_data))
									{
										foreach ($record_data as $key => $record) {
										
										}
								?>
									<tr>
									<td><?php echo isset($record['meta']) && isset($record['meta']['Company Name']) ? $record['meta']['Company Name'] : '-'?></td>
									<td><?php echo isset($record['meta']) && isset($record['meta']['Title']) ? $record['meta']['Title'] : '-'?></td>
									<td><?php echo isset($record['meta']) && isset($record['meta']['First Name']) ? $record['meta']['First Name'] : '-'?></td>
									<td><?php echo isset($record['meta']) && isset($record['meta']['Last Name']) ? $record['meta']['Last Name'] : '-'?></td>
									<td><?php echo isset($record['meta']) && isset($record['meta']['Email']) ? $record['meta']['Email'] : '-'?></td>
									<td><?php echo isset($record['meta']) && isset($record['meta']['Phone']) ? $record['meta']['Phone'] : '-'?></td>
									<td><?php echo isset($record['meta']) && isset($record['meta']['Lead Status']) ? $record['meta']['Lead Status'] : '-'?></td>
									</tr>
								<?php	}else
									{ ?>
									<div class="no-content">No Leads Found!</div>	
								<?php	}
								?>
							</tbody>

							</table>
						</form>
						</div>
					</div>
              
				</div>	
				
        <div class="col-md-12 col-sm-12 col-xs-12">
					<div id="dynamic_content" style="overflow-x: auto;margin-top: 10px;min-height: 300px;background: #fff;">
						<div class="content-title">Recent Contract</div>						
						<div>
						<form id="record_list_table">
							<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
							 <thead>
									<th>Contract Name </th>
									<th>Stage </th>
									<th>Signing Rate </th>
									<th>Contract Number </th>
							</thead>
							<tbody>
								<?php
									//print_r($recentContracts);
									if(empty(!$recentContracts))
									{
										foreach ($recentContracts as $key => $contracts) { ?>
									<tr>	
									<td><?php echo isset($contracts['meta']) && isset($contracts['meta']['Contract Name']) ? $contracts['meta']['Contract Name'] : '-'?></td>

									<td><?php echo isset($contracts['meta']) && isset($contracts['meta']['Stage']) ? $contracts['meta']['Stage'] : '-'?></td>
									<td><?php echo isset($record['meta']) && isset($record['meta']['Signing Rate']) ? $contracts['meta']['Signing Rate'] : '-'?></td>
									<td><?php echo isset($contracts['meta']) && !empty($contracts['meta']['Contract Number']) ? $contracts['meta']['Contract Number'] : '-'?></td>
									</tr>
								<?php
									}	
								}else
									{ ?>
									<div class="no-content">No Leads Found!</div>	
								<?php	}
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


