<!DOCTYPE html>
<html>
	<head>
		<style>
			body {padding:0; margin:0;}
		</style>
	</head>
	<body>
			<table style="background-color: #fff; font-family: Open Sans,sans-serif,Arial; font-weight: 400; line-height: 1.6!important; border:1px solid #ccc;" cellpadding="0" cellspacing="0" width="600px" align="center">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr width="100%">
								<td colspan="2" style="background:#1FB5AD;color: #fff;padding: 16px;letter-spacing: 10px;text-align: center;">
									<h1>ANBRUCH</h1>
								</td>
							</tr>
						
							<tr>
								<td style="padding-top:20px; padding-bottom:20px" width="100%" align="center">
									
									
									<h2 style="font-size:24px; line-height:32px; margin:0px; padding-bottom:10px; color:#1FB5AD !important; font-family:" >Booking Cancelled</h2>
									
									<p style="font-size:95%; line-height:22px; margin:0px; padding-bottom:10px; color:#333333; font-family:"> Appointment on <b><?php echo $booking_date; ?></b> is Cancelled.</p>									
								</td>
							</tr>
						</table>	
						<table cellpadding="0" cellspacing="0" width="95%;" align="center">
							<tr>
								<td style="padding:20px 0px" align="left">									
									<p style="font-size:75%; line-height:14px; margin:0px; color:#b2b2b2; font-weight:600">SUGGESTION</p>
								</td>
							</tr>
							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Suggested Date:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $suggested_date;?></td>
 							</tr>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Suggested Time:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $suggested_time;?></td>
 							</tr>
 							<?php if(isset($praposed_notes) && !empty($praposed_notes)){ ?>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Comments:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $praposed_notes; ?></td>
 							</tr>
 							<?php } ?>
							<tr>
								<td style="padding:20px 0px" align="left">									
									<p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; margin-bottom:12px; font-weight:600">BOOKING DETAILS</p>
								</td>
							</tr>
							<?php if(isset($booking_title) && !empty($booking_title)){ ?>
							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Booking Title:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $booking_title;?></td>
 							</tr>
 							<?php } ?>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Start Date:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $booking_date;?></td>
 							</tr>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Start Time:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $booking_time;?></td>
 							</tr>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">End Date:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $end_date; ?></td>
 							</tr>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">End Time:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $end_time;?></td>
 							</tr>
 							<?php if(isset($lead_title) && !empty($lead_title)){ ?>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Lead:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $lead_title;?></td>
 							</tr>
 							<?php }
 							if(isset($notes) && !empty($notes)){ ?>
 							<tr>
								 <th style="text-align: left;border-bottom:1px solid #ddd;padding: 5px 20px;width: 23%;">Notes:</th>
								 <td style="text-align:  left;border-bottom:1px solid #ddd;padding: 5px 20px;"><?php echo $notes; ?></td>
 							</tr>
 							<?php } ?>
							<tr>
								<td style="padding:20px 0px" align="left">
									<p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; font-weight: 600; margin-bottom: 0px; ">YOUR CONTACT INFO</p>
								</td>
							</tr>
							<tr>
								<p style="font-size:100%; line-height:24px; margin:0px; color:#4a4a4a;"><a href="javascript:void(0)" style="color:#4a4a4a;text-decoration:none"><?php echo $name;?></a>
									</p>
 							</tr>
 							<tr>
								<p style="font-size:100%; line-height:24px; margin:0px; color:#4a4a4a;"><a href="#m_4152791197783621497_m_-1980801558428767443_" style="color:#4a4a4a; text-decoration:none"><?php echo $email;?></a></p>
 							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" width="95%;" align="center" style="border-bottom: 1px solid #ccc; border-top: 0px solid #ccc; margin-top:30px; margin-bottom:30px;">
							<!-- <tr>
								<?php if($status== 0){ ?>
									<td colspan="2" style="text-align: center;">
									<a href="<?php echo base_url() ?>index.php/user/confirmBooking/?bid=<?php echo $bookingId; ?>&cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $record_status; ?>" style="color: #fff;background-color: #5cb85c;padding: 7px;text-decoration: none;border-radius: 0px;display: inline-block;margin-bottom: 16px;
									" target="_blank" >Confirm booking</a>
									<a href="<?php echo base_url() ?>index.php/user/cancelBooking/?bid=<?php echo $bookingId; ?>&cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $record_status; ?>" style="color: #fff;background-color: #d9534f;padding: 7px;text-decoration: none;border-radius: 0px;display: inline-block;margin-bottom: 16px;" target="_blank" >Cancel booking</a>
								</td>
								<?php } ?>
							
								<?php 
								if($status== 1){
								 ?>
								<td width="50%" align="center">
									<a href="<?php echo base_url() ?>index.php/user/cancelBooking/?bid=<?php echo $bookingId; ?>&cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $record_status; ?>" style="color: #fff;background-color: #d9534f;padding: 7px;text-decoration: none;border-radius: 0px;display: inline-block;margin-bottom: 16px;" target="_blank" >Cancel booking</a>
								</td>
								<?php }?>
							</tr> -->
							<tr>
                       			<td style="background-color: #d8d8d8; font-size:11px; padding:18px;" valign="top" align="center">
                          			 <p><em>Copyright &copy;  Anbruch<?php echo date('Y')?> All rights reserved.</em></p>

                      			 </td>
                  			 </tr>
						</table>
					</td>
				</tr>
			</table>
	</body>
</html>
