<!--dynamic table-->
<?php //echo '<pre>';print_r($bookings);die; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css"/>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<style type="text/css">
	.status-legend {line-height:37px; color:#455a64; margin-right:20px; font-size:14px;}
	.status-legend span {display:inline-block; padding:5px; margin:0 5px;}
	.legend-circle {border-radius:25px;}
	.bg-red-status {background:#f44336;}
	.bg-yellow-status {background:#ffcc00;}

	.status-circle {border-radius:25px; padding:5.5px; display:inline-block; position:relative; font-size:0; cursor:pointer;}
	.status_txt {visibility:hidden; position:absolute; font-size:12px; background:#666; color:#fff; padding:0 8px; text-transform:capitalize; border-radius:3px; top:18px; left:50%; margin-left:-21px;}
	tr:hover .status_txt {transition:all .25s; visibility:visible;}
	.status_txt:before {content:''; position:absolute; top:-13px; height:4px; border:7px solid transparent; border-bottom:6px solid #666; left:50%; margin-left:-7px;}
	.cancelled .status_txt {margin-left:-35px;}
	.confirmed .status_txt {margin-left:-37px;}
	.dataTables_wrapper .row-fluid:before,.dataTables_wrapper .row-fluid:after {content:''; display:table; clear:both;}

	.booking-cancel-btn a {background:#dfe4e7; border:1px solid #455a64; color:#455a64; padding:4px 8px; border-radius:3px; opacity:1 !important;}

	.booking-cancel-btn a:hover {background:#cfd5d7;}

	#dynamic-table-bookings th, #dynamic-table-bookings th:last-child {width:auto !important;}
	#dynamic-table-bookings tbody tr:hover {cursor: pointer;}
	.status-legend{text-align: right;}
	#dynamic-table-bookings .suggested .status_txt{
		margin-left: -35px !important;
	}
</style>

<div id="bookinglist" style="margin-top:-110px; margin-bottom:110px;"></div>

<div class="card top-border color-green collapsible-card">
	
	<div class="custom-bord flex-row">
		<div class="col" data-toggle="collapse" data-target="#collapse-booking">
			<h4>Bookings</h4>
		</div>
		
		<div data-toggle="collapse" data-target="#collapse-booking">
			<span class="toggle-card-btn bg-yellow-50">
				<i class="icon-crm-angle-up"></i>
			</span>
		</div>
	</div>

	<div id="collapse-booking" class="card-content collapse in">

	<?php if (isset($bookings) && count($bookings) > 0) { ?>
		 <div class="table-responsive">
		 	<div class="status-legend">
			<b>Status-</b>
			<span><span class="legend-circle bg-blue-500"></span> New </span>
			<span><span class="legend-circle bg-theme-500"></span> Confirmed </span>
			<span><span class="legend-circle bg-red-status"></span> Cancelled </span>
			<span><span class="legend-circle bg-yellow-status"></span> Time Suggested </span>
		   </div>
		 	
            <table class="display table new-table table-striped table-condensed" id="dynamic-table-bookings" style="max-width:100% !important;width:1000px !important;">
                <thead>
	                <tr class="th-row">
	                    <th class="all" nowrap="nowrap">Sr No.</th>
	                    <th class="all" style="min-width: 150px;">Booking Title</th>
	                    <th class="all" nowrap="nowrap">Booking Date</th>
	                    <th class="all" nowrap="nowrap">Booking Time</th>
	                    <th class="all" nowrap="nowrap">Booked By</th>
 	                    <th class="all" nowrap="nowrap">Name</th>
 	                    <th class="text-center all" nowrap="nowrap">Status</th>
	                    <th class="all" nowrap="nowrap">Email</th>
	                    <th class="all" nowrap="nowrap">Opener</th>
	                    <th class="all" nowrap="nowrap">Closer</th>
	                  <!--   <th class="text-center" nowrap="nowrap">All Day</th> -->
	                    <th class="all" nowrap="nowrap">Attachment</th> 
	                    <th class="none" nowrap="nowrap">Notes</th>
	                    <th class="all" nowrap="nowrap">Suggested Date</th>
	                    <th class="all" nowrap="nowrap">Suggested Time</th> 
	                    <th class="all" nowrap="nowrap">Created Time</th>
	                    <th class="all" nowrap="nowrap">Modified Time</th>
	                    <th class="all" nowrap="nowrap">Modified By</th>
	                    <th class="none">Action</th>
	                </tr>
                </thead>
                <tbody>
               	
                <?php $i=01; foreach ($bookings as $key => $bkng) { 
									
									
					if($bkng["status"]==0){  $info = 'status-circle bg-blue-500 new'; }
					else if($bkng["status"]==1){  $info = 'status-circle bg-theme-500 confirmed'; }
					else if($bkng["status"]==2 && $bkng["praposed_date"] == '0000-00-00 00:00:00'){  $info = 'status-circle bg-red-status cancelled'; } 
					else if($bkng["status"]==2 && $bkng["praposed_date"] != '0000-00-00 00:00:00'){  $info = 'status-circle bg-yellow-status time suggested';
					 } 
					else {  $info = ''; } 
					
					?>
               
                    <tr id="booking_id_<?php echo $bkng["id"]; ?>">                       
                        <td nowrap="nowrap"><?php echo $i; ?></td>
                        <td><?php echo $bkng["booking_title"]; ?></td>
                        <td nowrap="nowrap">
                        	<?php echo $bkng["all_day"] == 1 ? date("m/d/Y", strtotime($bkng["booking_date"])) : date("m/d/Y H:i", strtotime($bkng["booking_date"]));?>
                        </td>
                        <td nowrap="nowrap">
                        	<?php 
                        	  if($bkng["all_day"] == 1){
                        	   echo $bkng["end_date"] != null ? date("m/d/Y", strtotime($bkng["end_date"])) : '-';	
                        	  }else{
                        	  	$endTime =  $bkng["end_date"] != null && $bkng['booking_date'] != null ? date("H:i", strtotime($bkng["booking_date"])) .' to '. date("H:i", strtotime($bkng["end_date"])) : '-';
                        	  	echo $endTime;
                        	  	//echo $bkng["end_date"] != null ? date("h:i a", strtotime($bkng["end_date"])): '-';
                        	  }
                        	 ?></td>
                       <td nowrap="nowrap"> <?php echo getFullName($bkng["created_by"]); ?></td> 	 
                        <td nowrap="nowrap"> <?php echo $bkng["name"]; ?></td>
                        <td class="text-center info_status_<?php echo $bkng["id"]; ?>">
                        	<span class="<?php echo $info; ?>"> <span class="status_txt"><?php
                        	if($bkng["status"]==2 && $bkng["praposed_date"] != '0000-00-00 00:00:00'){
                        		echo 'Suggested';
                        	}else{echo $booking_status[$bkng["status"]];}?></span></span> 
                        </td>
                        <td nowrap="nowrap"><?php echo $bkng["email"]; ?></td>
                        <td nowrap="nowrap"><?php echo isset($opener_name) ? $opener_name : 'Not Available'; ?></td>
                        <td nowrap="nowrap"><?php echo isset($closer_name) ? $closer_name : 'Not Available'; ?></td>
                       <!--  <td><?php echo $bkng["all_day"] == 1 ? "<i class='fa fa-check'></i>" : 'No' ;?></td> -->
                          <td nowrap="nowrap"><?php echo !empty($bkng["attachment"]) ? '<a class="btn-link" href="'.base_url().'upload/event/'.$bkng["attachment"].'" download >'.$bkng["attachment"].'<a>' : 'NA' ?></td>
                         <td><?php echo $bkng["notes"]; ?></td> 
                         <td><?php echo $bkng["praposed_date"] > 0 ? date("m/d/Y H:i",strtotime($bkng["praposed_date"])) : '-'; ?></td> 
                         <td><?php echo $bkng["praposed_date"] > 0 ? date("H:i",strtotime($bkng["praposed_date"])) .' To '. date("H:i",strtotime($bkng["praposed_end_time"])): '-'; ?></td> 
                         <td nowrap="nowrap"><?php echo date("m/d/Y H:i", strtotime($bkng["created_time"])); ?></td>
                         <td nowrap="nowrap"><?php echo date("m/d/Y H:i", strtotime($bkng["modified_time"])); ?></td>
                          <td nowrap="nowrap"> <?php echo getFullName($bkng["modified_by"]); ?></td>
                         <td>  <?php if($bkng["status"]==0){  ?>
							<span class="booking-cancel-btn btn_<?php echo $bkng["id"]; ?>">                        
								<a href="javascript:;" style="text-decoration:none;" data-id="<?php echo $bkng["id"]; ?>" data-record-id="<?php echo $bkng["record_id"]; ?>" class="cancel_booking" >Cancel Booking</a>
							</span>
                        <?php }elseif($bkng["status"]==1){  ?>                       
							<span class="booking-cancel-btn btn_<?php echo $bkng["id"]; ?>">
								<a href="javascript:;" style="text-decoration:none;" data-id="<?php echo $bkng["id"]; ?>"data-record-id="<?php echo $bkng["record_id"]; ?>" class="cancel_booking" >Cancel Booking</a>
							</span>
                        <?php }else{
                        	echo '-';
                        }?> </td>
                          
                    </tr>
                  
                 <?php $i++;  } ?>
                
                </tbody>
                <!-- <tfoot>
	                <tr class="th-row">
	                    <th nowrap="nowrap">Sr No.</th>
	                    <th nowrap="nowrap">Booking Title</th>
	                    <th nowrap="nowrap">Booking Date</th>
	                    <th nowrap="nowrap">Booking Time</th>
 	                     <th nowrap="nowrap">Name</th>
	                    <th nowrap="nowrap">Email</th> 
	                    <th class="text-center" nowrap="nowrap">Status</th>
	               
	                    <th nowrap="nowrap">Action</th>
	                </tr>
                </tfoot> -->
            </table>
          </div>  
        <?php
        }
        else
        { ?>
            <h3 class="text-center">No booking found.</h3>
        <?php } ?>

	</div>

</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#dynamic-table-bookings').dataTable( {
            "language": {
            	"lengthMenu": "Show _MENU_ entries",
	            "zeroRecords": "Nothing found - sorry",
	            // "info": "Showing page _PAGE_ of _PAGES_",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)"
	        },
	        "responsive": true,
            // "scrollX": true,
            //"aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]], 
        });       
    } );
    
    
    $(document).on('click','.confirm_booking',function(){

			var bookingId = $(this).attr('data-id');
			var current_record_id = $(this).attr('data-record-id');
			console.log(bookingId);
			if(confirm('Are you sure to confirm booking?'))
			{
				$.ajax({
					url:  '<?php echo base_url()."index.php/booking/confirmBooking"; ?>',
					type: "POST",
					data: { ' bookingId':bookingId, 'current_record_id':current_record_id },
					beforeSend: function() {
					
					},
					success: function(result)
					{
						console.log(result);
						if(result=='no_booking_found')
						{
							$("input[name='email']").val('');
							alert('No booking exists with this email address!');
							
							return;
						}					
						if(result=='not_confirmed')
						{
							$("input[name='email']").val('');
							alert('Error! Booking is not confirmed. try after some time!');
							
							return;
						}
						
						$('.cobtn_'+bookingId).remove();
						
						$('.info_status_'+bookingId).html("<span class='info-success'>Confirmed</span><input type='hidden' id='bookingId' value="+bookingId+">");
									
			
					}	
				});			
			}
		});
		
    $(document).on('click','.cancel_booking',function(){

			var bookingId = $(this).attr('data-id');
			var current_record_id = $(this).attr('data-record-id');
			console.log(bookingId);
			if(confirm('Are you sure to cancel booking?'))
			{
				$.ajax({
					url:  '<?php echo base_url()."index.php/booking/cancelBooking"; ?>',
					type: "POST",
					data: { ' bookingId':bookingId, 'current_record_id': current_record_id },
					beforeSend: function() {
					
					},
					success: function(result)
					{
						console.log(result);
						if(result=='no_booking_found')
						{
							$("input[name='email']").val('');
							alert('No booking exists with this email address!');
							
							return;
						}					
						if(result=='not_cancelled')
						{
							$("input[name='email']").val('');
							alert('Error! Booking is not cancelled. try after some time!');
							
							return;
						}
						
						$('.btn_'+bookingId).remove();
						$('.cobtn_'+bookingId).remove();
						
						$('.info_status_'+bookingId).html("<span class='info-danger'>Cancelled</span><input type='hidden' id='bookingId' value="+bookingId+">");
									
			
					}	
				});			
			}
		});
	/*$(document).on("mouseover","#dynamic-table-bookings tbody tr",function(){
		var id =  $(this).attr("id");
	  setTimeout(function(){ 	
		$("#"+id+" td:nth-child(1)").click();
		}, 300);
	});	
	$(document).on("mouseout","#dynamic-table-bookings tbody tr",function(){
		var id =  $(this).attr("id");
		 setTimeout(function(){ 	
		  $("#"+id+" td:nth-child(1)").click();
		 }, 300); 
	});*/	
</script>