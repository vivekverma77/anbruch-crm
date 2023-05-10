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
									
									<h2 style="font-size:24px; line-height:32px; margin:0px; padding-bottom:10px; color:#1FB5AD !important; font-family:" >Invitation</h2>
								
									<p style="font-size:95%; line-height:22px; margin:0px; padding-bottom:10px; color:#333333; font-family:"> You are invited for <b><?php echo $booking_title;?></b></p>									
								</td>
							</tr>
						</table>	
						<table cellpadding="0" cellspacing="0" width="95%;" align="center">
							<tr>
								<td style="padding:20px 0px" align="left">			
															
									<p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; border-bottom:1px solid #e1e1e1; margin-bottom:12px; font-weight:600">DETAILS</p>
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Title: <?php echo $booking_title;?></p>									
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Date: <?php echo $booking_date; ?></p>									
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Time: <?php echo $booking_time; ?></p>		
									
									<p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; border-bottom:1px solid #e1e1e1; margin-bottom:12px; font-weight:600">Who invited</p>
									
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Who: <?php echo $all_email; ?></p>									
									
								</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" width="95%;" align="center" style="border-bottom: 1px solid #ccc; border-top: 0px solid #ccc; margin-top:30px; margin-bottom:30px;">
							<tr>
									<td style="padding:20px 0px" align="left">			
									
									<p style="font-size:100%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; border-bottom:1px solid #e1e1e1; margin-bottom:12px; font-weight:600">Going (<?php echo $email; ?>) </p>				
									
									<p style="padding: 10px; display: inline-block; float: left; border: 1px solid; 
									 border-radius: 4px; margin-right: 10px;">
										<a href="<?php echo base_url() ?>index.php/member/going/?booking_id=<?php echo $booking_id; ?>&email=<?php echo $email; ?>&status=1" style="text-decoration:none; font-size:100%; width:100%; display:inline-block; font-family:; font-weight:400; line-height:20px; color:#cb202d; padding:30px 0" width="100%" target="_blank" >Yes</a>									
									</p>
									
									<p style="padding: 10px; display: inline-block; float: left; border: 1px solid; 
									 border-radius: 4px; margin-right: 10px;">
										<a href="<?php echo base_url() ?>index.php/member/going/?booking_id=<?php echo $booking_id; ?>&email=<?php echo $email; ?>&status=2" style="text-decoration:none; font-size:100%; width:100%; display:inline-block; font-family:; font-weight:400; line-height:20px; color:#cb202d; padding:30px 0" width="100%" target="_blank" >Maybe</a>									
									</p>
									
									<p style="padding: 10px; display: inline-block; float: left; border: 1px solid; 
									 border-radius: 4px; margin-right: 10px;">
										<a href="<?php echo base_url() ?>index.php/member/going/?booking_id=<?php echo $booking_id; ?>&email=<?php echo $email; ?>&status=3" style="text-decoration:none; font-size:100%; width:100%; display:inline-block; font-family:; font-weight:400; line-height:20px; color:#cb202d; padding:30px 0" width="100%" target="_blank" >No</a>								
									</p>
								</td>
							</tr>							
						
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
