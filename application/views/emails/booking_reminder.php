<!DOCTYPE html>
<html>
	<head>
		<style>
			body {padding:0; margin:0;}
			table[class*="data-table"] tr:nth-last-child(4) td {background:#000; padding-bottom:20px !important;}
		</style>
	</head>
	<body>
			<table style="background:#f8f9fa; font-family:Open Sans,sans-serif,Arial; font-weight: 400; line-height: 1.6!important; border:0; color:#586571;" cellpadding="0" cellspacing="0" width="100%" align="center">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="600px" align="center" style="background:#fff; margin-top:80px;">
							<tr width="100%">
								<td colspan="2" style="background:#1FB5AD;color: #fff;padding:35px;letter-spacing: 10px;text-align: center;"></td>
							</tr>
							<tr>
								<td style="padding:30px 0 0; text-align:center;">
									<img src="<?php echo base_url(); ?>static/images/anbruch-logo-2.png" style="margin-left:80px;">
								</td>
							</tr>

							<tr>
								<td style="padding-top:20px; padding-bottom:20px" width="100%" align="center">
								
									<span style="display:block; font-size:30px; color:#1fb5ad; letter-spacing:1.5px;">Booking Reminder.</span>

									<?php if( $status=='0'){  $b_status = 'done and awaiting for confirmation'; ?>
									<h2 style="color:#ff9800; font-weight:normal; letter-spacing:1px;" >Awaiting for confirmation!</h2>
									<?php } else if($status =='1'){  $b_status = 'confirmed'; ?>
									<h2 style="color:#1fb5ad; font-size:20px; letter-spacing:1.5px; font-weight:normal; margin-bottom:-15px;">Booking Confirmed!</h2>
									<?php } else if($status=='2'){  $b_status = 'cancelled'; ?>
									<h2 style="color:#F44336; font-size:20px; letter-spacing:1.5px; font-weight:normal; margin-bottom:-15px;">Booking Cancelled!</h2> 
									<?php } ?>	
									<p style="font-size:14px; color:#586571;"> Your appointment on <b><?php echo $booking_date;?></b> is <?php echo $b_status; ?>.</p>									
								</td>
							</tr>
						</table>	
						<table class=" data-table" cellpadding="0" cellspacing="0" width="600px;" align="center" style="background:#fff;">
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" width="400px;" align="center" style="background:#f8f9fa; border-radius:7px; padding:0 20px;">
										<tr>
											<td style="padding:20px 0px" align="left">
												<p style="font-size:15px; letter-spacing:1.5px; line-height:14px; color:#b2b2b2; margin-bottom:0; font-weight:600">BOOKING DETAILS - </p>
											</td>
										</tr>
										<?php if(isset($booking_title) && !empty($booking_title)){ ?>
										<tr>
											<td style="padding:5px 10px;">
												<strong>Booking Title:</strong> <?php echo $booking_title;?>
											</td>
			 							</tr>
			 							<?php } ?>
			 							<tr>
			 								<td style="padding:5px 10px;">
			 									<strong> Start Date: </strong> <?php echo $booking_date;?>
			 								</td>
			 							</tr>
			 							<tr>
			 								<td style="padding:5px 10px;">
			 									<strong> Start Time: </strong> <?php echo $booking_time;?>
			 								</td>
			 							</tr>
			 							<tr>
			 								<td style="padding:5px 10px;">
			 									<strong> End Date: </strong> <?php echo $end_date; ?>
			 								</td>
			 							</tr>
			 							<tr>
			 								<td style="padding:5px 10px;">
			 									<strong> End Time: </strong> <?php echo $end_time;?>
			 								</td>
			 							</tr>
			 							<?php if(isset($lead_title) && !empty($lead_title)){ ?>
			 							<tr>
			 								<!-- <td style="padding:5px 10px;">
			 									<strong> Lead: </strong> <?php echo $lead_title;?>
			 								</td> -->
			 							</tr>
			 							<?php }
			 							if(isset($notes) && !empty($notes)){ ?>
			 							<tr>
			 								<td style="padding:5px 10px 15px;">
			 									<strong> Notes: </strong>
			 									<p><?php echo $notes; ?></p>
			 								</td>
			 							</tr>
			 							<?php } ?>
										<tr>
											<td style="padding:10px 0 0; border-top: 1px solid #e5e5e5;" align="left">
												<p style="font-size:15px; letter-spacing:1.5px; line-height:14px; color:#b2b2b2; font-weight:600"><!-- YOUR CONTACT INFO -  --></p>
											</td>
										</tr>
										<tr>
											<td>
												<p style="font-size:100%; padding:5px 10px; line-height:24px; margin:0px; color:#4a4a4a;"><a href="javascript:void(0)" style="color:#4a4a4a;text-decoration:none"><?php echo $name;?></a>
												</p>
											</td>
			 							</tr>
			 							<tr>
			 								<td>
												<p style="font-size:100%; padding:5px 10px 12px; line-height:24px; margin:0px; color:#4a4a4a;"><a href="#m_4152791197783621497_m_-1980801558428767443_" style="color:#4a4a4a; text-decoration:none"><?php echo $email;?></a></p>
			 								</td>
			 							</tr>
 								
									</table>
								</td>
							</tr>
						</table>

						<table cellpadding="0" cellspacing="0" width="600px" align="center" style="border-bottom: 1px solid #d8d8d8; margin-bottom:30px; background:#fff;">
							<tr>
								<?php if($status== 0){ ?>
									<td class="action-col" colspan="2" style="text-align:center; padding:40px 0 25px;">

									<a href="<?php echo base_url() ?>index.php/user/confirmBooking/?bid=<?php echo $bookingId; ?>&cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $record_status; ?>" style="color: #fff;background-color:#1fb5ad;padding:9px 14px;text-decoration:none; border-radius:4px;display: inline-block;margin-bottom: 16px; margin-right:10px; font-weight:600;" target="_blank" >Confirm booking</a>
									<a href="<?php echo base_url() ?>index.php/user/cancelBooking/?bid=<?php echo $bookingId; ?>&cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $record_status; ?>" style="color:#fff; background-color:#F44336;padding:9px 14px; text-decoration:none; border-radius:4px;display: inline-block;margin-bottom:16px; font-weight:600;" target="_blank" >Cancel booking</a>
								</td>
								<?php } ?>
							
								<?php 
								if($status== 1){
								 ?>
								<td width="50%" align="center">
									<a href="<?php echo base_url() ?>index.php/user/cancelBooking/?bid=<?php echo $bookingId; ?>&cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $record_status; ?>" style="color: #fff;background-color: #d9534f;padding: 7px;text-decoration: none;border-radius: 0px;display: inline-block;margin-bottom: 16px;" target="_blank" >Cancel booking</a>
								</td>
								<?php }?>
							</tr>
							<tr>
                       			<td style="background:#f1f3f4; font-size:11px;" valign="top" align="center">
                          			 <p style="color:#586571;"><em>Copyright &copy;  Anbruch<?php echo date('Y')?> All rights reserved.</em></p>

                      			 </td>
                  			 </tr>
						</table>
					</td>
				</tr>
			</table>
	</body>
</html>
