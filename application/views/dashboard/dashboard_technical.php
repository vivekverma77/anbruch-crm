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
.hot-leads-table .btn:hover{
    color: white !important;
    box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.3);
}
.hot-leads-table a:hover{
    color: #1FB5AD !important;
}
.company-name :hover{
    color:#009C9F !important;
}
.btn-fill-theme {background:#1fb5ad;color: white;}
.hot-leads-table table td a { color: #32323A !important }
</style>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
		
	<div class="row">
				
        <div class="col-xs-12">
		  <div id="dynamic_content" style="margin-top:10px; background:#fff;">				
			<div class="table-title"> <h3>CONTRACTS</h3></div>
			  <div>
				<form id="record_list_table">
				  <table id="dynamic-table" class="datatable">
					<thead>
					  <tr>				
						<?php if(!empty($record_data_contract))
						  {  $query_string = '';$cur_page = '';
							foreach ($record_data_contract as $key => $record)
						 	{
							  foreach ($record['meta'] as $metaFieldName => $metaValue)
							  {
						?>
						  	<th nowrap="nowrap">
							  <a <?php if($sort_column == $metaFieldName){?>style="color:#007CB2"<?php }?>  href="<?php echo base_url() ?>index.php/modules/?cm=<?php echo $current_module; ?>
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
								
					<?php } ?>
				  </tbody>
				</table>
			  </form>
			</div>
		  </div>
		</div>	
				
        <div class="col-xs-12">
		  <div id="dynamic_content" style="margin-top:50px;background: #fff;">

			<div class="table-title"> <h3>Upcoming Activities - Bookings & Reminders </h3></div>

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
	                      <td nowrap class="info_status info_status_<?php echo $bkng["id"]; ?>"><span class="<?php echo $info; ?>"><?php echo $booking_status[$bkng["status"]]; ?></span></td>
	                      <td nowrap><?php echo $bkng["first_name"].' '.$bkng["last_name"]; ?></td>
	                      <td nowrap><?php echo date("m/d/Y", strtotime($bkng["booking_created_time"])); ?></td>
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

        <div class="col-xs-12">
		  <div id="dynamic_content" class="hot-leads-table" style="margin-top:50px;background: #fff;">
			  <div class="table-title"> <h3>HOT LEADS (TECHNICAL)</h3> </div>

			  <div>
				<form id="record_list_table">
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
                        <th nowrap>Lead Category</th> 
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
                        
                        <th nowrap>Action</th> 
                         
                    </tr>
    			</thead>
                <tbody>
               <?php

                    if(!empty($record_data_contract)){ //print_r($topHotLeads);
                        foreach ($record_data_contract as $key => $record_data) { 
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
                            <td nowrap ><?php echo !empty($record_data_meta['Estimated Sales']) ? $record_data_meta['Estimated Sales'] : '-';?></td>
                            <?php if($record_data_meta['Lead Category'] == 'Hot'){ ?>
                             <td nowrap style="color:red;"><?php echo !empty($record_data_meta['Lead Category']) ? $record_data_meta['Lead Category'] : '-';?></td>
                             <?php } else if($record_data_meta['Lead Category'] == 'Cold'){ ?>
                            <td nowrap style="color:blue;"><?php echo !empty($record_data_meta['Lead Category']) ? $record_data_meta['Lead Category'] : '-';?></td>
                             <?php } else if($record_data_meta['Lead Category'] == 'Warm') { ?>
                             <td nowrap style="color:yellow;"><?php echo !empty($record_data_meta['Lead Category']) ? $record_data_meta['Lead Category'] : '-';?></td>

                             <?php } else if($record_data_meta['Lead Category'] == 'Dead') {?>
                             <td nowrap style="color:black;"><?php echo !empty($record_data_meta['Lead Category']) ? $record_data_meta['Lead Category'] : '-';?></td>

                            <?php } else { ?>
                                 <td nowrap style="color:pink;"><?php echo !empty($record_data_meta['Lead Category']) ? $record_data_meta['Lead Category'] : '-';?></td>
                            <?php } ?>
                            <td nowrap><?php echo !empty($record_data_meta['Reported Sales']) ? $record_data_meta['Reported Sales'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Last Name']) ? $record_data_meta['Last Name'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Fax']) ? $record_data_meta['Fax'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['First Name']) ? $record_data_meta['First Name'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Title']) ? $record_data_meta['Title'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Phone']) ? $record_data_meta['Phone'] : '';?></td>
                            <td nowrap> <span><?php echo !empty($record_data_meta['Lead Status']) ? $record_data_meta['Lead Status'] : '-';?></span> </td>
                            <td nowrap><?php echo !empty($record_data_meta['Email']) ? $record_data_meta['Email'] : '';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Opener']) ? $record_data_meta['Opener'] : '';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Primary SIC Code']) ? $record_data_meta['Primary SIC Code'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Closer']) ? $record_data_meta['Closer'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Lead Source']) ? $record_data_meta['Lead Source'] : '-';?></td>
                            <td nowrap><?php echo !empty($record_data_meta['Lead Referred Partner']) ? $record_data_meta['Lead Referred Partner'] : '-';?></td> 
                           
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
				</form>
			  </div>

		  </div>
		</div>

        <div class="col-xs-12">
			<div id="dynamic_content" style="margin-top:50px;background: #fff;">
				<div class="content-title">BAR GRAPH - STATS - MONTHLY CONTRACTS vs RECOVERIES</div>						
			  <div>
				<form id="record_list_table">

					<!-- <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->
					<canvas id="chartTechnical" style="height: 300px; width: 100%;"></canvas>
						
				</form>
			  </div>
			</div>
		</div>	   
				
    </div>
    
	
  </section>
</section>
<!--main content end-->  

<!-- <script type="text/javascript" src="<?php echo base_url() ?>static/graph/canvasjs.min.js"></script> -->

<script>

window.onload = function () {	
	
	 // var chart = new CanvasJS.Chart("chartContainer", {
		// 	title: {
		// 		text: "Recoveries: <?php echo $own_data['monthly_target']; ?>"
		// 	},
		//  	axisY: {
		// 		title: "Closings",
		// 		titleFontSize: 15
		// 	},
		//  	axisX: {
		// 		title: "Month",
		// 		titleFontSize: 15
		// 	},
		// 	data: [
		// 	{
		// 			type: "column",
		// 			dataPoints:<?php echo $monthly_contracts; ?>
		// 	}
		// 	]
		// });

		// chart.render();


var ctx2 = document.getElementById('chartTechnical').getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo $contracts_chart_label;?>,
        datasets: [{
            label: 'Target: <?php echo $own_data["monthly_target"]; ?>',
            data: <?php echo $contracts_chart_data;?>,
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
}
</script>


<script type="text/javascript">

var base_url = '<?php echo base_url();?>'; 

$(document).ready(function(){

	$("#hot-leads").DataTable({responsive: true,
        ordering: true,
        paging: false,
        searching:false,
        dom: 't',
        keys: true,
    });


    $(".datatable").DataTable({responsive: true,
	    ordering: false,
	    paging: false,
	    searching:false,
	    dom: 't',
	    keys: true,
	});

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


</script>