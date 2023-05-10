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
								<td>
									<img alt="" src="<?php echo base_url() ?>static/images/email_header.jpg" style="width:100%; background:#f0f0f0; max-height:220px" />
								</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td style="padding-top:20px; padding-bottom:20px" width="100%" align="center">
									
									
									<h2 style="font-size:24px; line-height:32px; margin:0px; padding-bottom:10px; color:#1FB5AD !important; font-family:" >Meeting Updated!</h2>
								
									<p style="font-size:95%; line-height:22px; margin:0px; padding-bottom:10px; color:#333333; font-family:"> Your appointment on <b><?php echo $booking_date;?></b> is updated.</p>									
								</td>
							</tr>
						</table>	
						<table cellpadding="0" cellspacing="0" width="95%;" align="center">
							<tr>
								<td style="padding:20px 0px" align="left">									
									<p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; border-bottom:1px solid #e1e1e1; margin-bottom:12px; font-weight:600">BOOKING DETAILS</p>
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Date: <?php echo $booking_date;?></p>									
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Time: <?php echo $booking_time; ?></p>									
									<p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; padding-top:30px">YOUR CONTACT INFO</p>									
									<p style="font-size:100%; line-height:24px; margin:0px; color:#4a4a4a;"><a href="javascript:void(0)" style="color:#4a4a4a;text-decoration:none"><?php echo $name;?></a>
									</p>									
									<p style="font-size:100%; line-height:24px; margin:0px; color:#4a4a4a;"><a href="#m_4152791197783621497_m_-1980801558428767443_" style="color:#4a4a4a; text-decoration:none"><?php echo $email;?></a></p>									
								</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" width="95%;" align="center" style="border-bottom: 1px solid #ccc; border-top: 0px solid #ccc; margin-top:30px; margin-bottom:30px;">
							<!--tr>							
								<?php if(@$status== 0 || @$status==1){ ?> 
								<td width="50%" align="center">
									<a href="<?php echo base_url() ?>index.php/user/cancelBooking/?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&record_status=<?php echo $record_status; ?>" style="text-decoration:none; font-size:100%; width:100%; display:inline-block; font-family:; font-weight:400; line-height:20px; color:#cb202d; padding:30px 0" width="100%" target="_blank" >Cancel booking</a>
								</td>
								<?php } ?> 
							</tr-->
						</table>
						<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#323232">
							<tr>
								<td align="center"> 
									<p style="font-size:75%; line-height:22px; color:#ffffff; text-align:center;">&copy; <?php echo date('Y'); ?> All rights reserved.</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
	</body>
</html>
