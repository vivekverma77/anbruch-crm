<!DOCTYPE html>
<html>
	<head>
		<style>
			body {padding:0; margin:0;}
			
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
									<img height="70" width="200" src="<?php echo base_url('assets/images/')?>logo-hd2.png">
								</td>
							</tr>

							<tr>
								<td style="padding-top:5px; padding-bottom:20px" width="100%" align="center">
									
									<?php if($status=='0'){  $b_status = !empty($heading_text) ? ' and awaiting for confirmation' : ' is done and awaiting for confirmation'; ?>
									<h2 style="color:#ff9800; font-weight:normal; letter-spacing:1px;" > <span style="display:block; font-size:36px; color:#1fb5ad; letter-spacing:1.5px;"><?php echo !empty($heading_text) ? $heading_text : 'Booking done';  ?>.</span> Awaiting for confirmation!</h2>
									<?php } else if($status=='1'){  $b_status = ' is confirmed'; ?>
									<h2 style="color:#1fb5ad; font-size:36px; letter-spacing:1.5px; font-weight:normal; margin-bottom:-15px;">Booking Confirmed!</h2>
									<?php } else if($status=='2'){  $b_status = ' is cancelled'; ?>
									<h2 style="color:#F44336; font-size:36px; letter-spacing:1.5px; font-weight:normal; margin-bottom:-15px;">Booking Cancelled!</h2> 
									<?php } ?>	
									<p style="font-size:14px; color:#586571;"> Your appointment <?php echo !empty($heading_text) ? 'has been rescheduled' : '';  ?> on <b><?php echo $booking_date;?></b><?php echo $b_status; ?>.</p>									
								</td>
							</tr>
						</table>	
						<table class=" data-table" cellpadding="0" cellspacing="0" width="600px;" align="center" style="background:#fff;">
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" width="500px"  align="center" style="background:#f8f9fa; border-radius:7px; padding:0 20px;">
										<tr>
											<td style="padding:20px 0px" align="left">
												<p style="font-size:15px; letter-spacing:1.5px; line-height:14px; color:#b2b2b2; margin-bottom:0; font-weight:600">BOOKING DETAILS - </p>
											</td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" width="500px" align="center" cellspacing="0">
													<tr>
														<td style="width:253px;padding-top: 5px; border-right: 3px solid #E6E6E6">
															<strong>Booking Title: </strong> <?php echo $booking_title;?>
														</td>
														<td style="padding-left: 15px;padding-top: 5px;"><strong> Start Date: </strong> <?php echo $booking_date;?></td>
													</tr>
													<tr>
														<td style="width:253px;padding-top: 5px;border-right: 3px solid #E6E6E6"><strong>Name: </strong><?php echo $name;?> </td>
														<td style="padding-left: 15px;padding-top: 5px;"><strong> Start Time: </strong> <?php echo $booking_time;?></td>
													</tr>
													<tr>
														<td style="width:253px;padding-top: 5px;border-right: 3px solid #E6E6E6"><strong>Email: </strong><?php echo $email;?></td>
														<td style="padding-left: 15px;padding-top: 5px;"><strong> End Time: </strong> <?php echo $end_time;?></td>
													</tr>
													<tr>
														<td style="width:253px;padding-top: 5px;border-right: 3px solid #E6E6E6"></td>
														<td style="padding-left: 15px;padding-top: 5px;"><strong> Notes: </strong>
			 									<p><?php echo $notes; ?></p></td>
													</tr>
												</table>
											</td>
										</tr>
									
							<tr>
                       			<td valign="top"  align="center" style="padding-top: 35px">
                       				<p style="font-size:100%; padding:0px 25px; line-height:0px;color:#4a4a4a;">Regards,</p>
                       				<p style="font-size:100%; padding:10px 25px;padding-bottom: 15px; line-height:0px; margin:0px; color:#4a4a4a;">Client Services team</p>
                       			</td>
                  			 </tr>
							</table>
							<table cellpadding="0" cellspacing="0" width="90%"  align="center" style="border-bottom: 1px solid #d8d8d8;margin-bottom:30px; background:#f1f3f4;">
								<tr>
                       		 <td style="font-size:11px;" valign="top" align="center">
                          			 <p style="color:#586571;"><em>Copyright &copy;  Anbruch<?php echo date('Y')?> All rights reserved.</em></p>

                      			 </td>
                  			 </tr>
							</table>
						</td>
						</tr>
					</table>

					</td>
				</tr>
			</table>
	</body>
</html>