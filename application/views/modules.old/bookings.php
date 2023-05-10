<!--dynamic table-->
<?php //echo '<pre>';print_r($bookings);die; ?>
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->

<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>

<section class="panel" id="bookinglist">
    <header class="panel-heading">Bookings List</header>
    <div class="panel-body">
        <?php if (isset($bookings) && count($bookings) > 0) { ?>
            <table class="display table table-bordered table-striped table-condensed" id="dynamic-table-bookings">
                <thead>
                <tr>
                    <th class="text-center">Sr No.</th>
                    <th class="text-center">Booking Title</th>
                    <th class="text-center">Booking Date</th>
                    <th class="text-center">Booking Time</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>                    
                    <th class="text-center">Status</th>                    
                    <th class="text-center">Created By</th>
                    <th class="text-center">Created Time</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($bookings as $key => $bkng) { 
									
									
									if($bkng["status"]==0){  $info = 'info-warning'; }
									else if($bkng["status"]==1){  $info = 'info-success'; }
									else if($bkng["status"]==2){  $info = 'info-danger'; } 
									else {  $info = ''; } 
									
									?>
               
                    <tr>                       
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $bkng["booking_title"]; ?></td>
                        <td class="text-center"><?php echo date("j-F-Y", strtotime($bkng["booking_date"]));?></td>
                        <td class="text-center"><?php echo date("h:ia", strtotime($bkng["booking_date"])); ?></td>
                        <td class="text-center"><?php echo $bkng["name"]; ?></td>
                        <td class="text-center"><?php echo $bkng["email"]; ?></td>
                        <td class="text-center info_status_<?php echo $bkng["id"]; ?>"><span class="<?php echo $info; ?>"><?php echo $booking_status[$bkng["status"]]; ?></td>
                        <td class="text-center"><?php echo $bkng["first_name"].' '.$bkng["last_name"]; ?></td>
                        <td class="text-center" ><?php echo date("j-F-Y", strtotime($bkng["created_time"])); ?></td>
                        
                         <td class="text-center ">
													<!--  <span class="info-basic cobtn_<?php echo $bkng["id"]; ?>">                        
														<a href="<?php echo base_url() ?>index.php/booking/bookedit/?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $recordStatus; ?>&bid=<?php echo $bkng["id"]; ?>" style="text-decoration:none;" data-id="<?php echo $bkng["id"]; ?>" data-record-id="<?php echo $bkng["record_id"]; ?>" class="edit_booking" >Edit</a>
													</span> -->
													
                        <?php if($bkng["status"]==0){  ?>                       
													<!-- <span class="info-success cobtn_<?php echo $bkng["id"]; ?>">                        
														<a href="javascript:;" style="text-decoration:none;" data-id="<?php echo $bkng["id"]; ?>" data-record-id="<?php echo $bkng["record_id"]; ?>" class="confirm_booking" >Confirm</a>
													</span> -->
													<span class="info-danger btn_<?php echo $bkng["id"]; ?>">                        
														<a href="javascript:;" style="text-decoration:none;" data-id="<?php echo $bkng["id"]; ?>" data-record-id="<?php echo $bkng["record_id"]; ?>" class="cancel_booking" >Cancel</a>
													</span>
                        <?php }   ?>
                        <?php if($bkng["status"]==1){  ?>                       
													<span class="info-danger  btn_<?php echo $bkng["id"]; ?>">                        
														<a href="javascript:;" style="text-decoration:none;" data-id="<?php echo $bkng["id"]; ?>"data-record-id="<?php echo $bkng["record_id"]; ?>" class="cancel_booking" >Cancel</a>
													</span>
                        <?php }   ?>
                        </td> 
                    </tr>
                  
                 <?php $i++;  } ?>
                
                </tbody>
            </table>
        <?php
        }
        else
        { ?>
            <h3 class="text-center" style="margin: 0;">No booking found.</h3>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dynamic-table-bookings').dataTable( {
            "scrollX": true,
            //"aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
             
        } );       
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
		
</script>
