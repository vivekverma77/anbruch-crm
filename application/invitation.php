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
									<img alt="" src="https://ci3.googleusercontent.com/proxy/RahXXl6Cj5L7yNKjnJjF22gqyuWOAAWiaiG0-ueE3zRAectg01hg8iF1oxzWgI3p9D-zO0VPijcMJdAwr81lQaLXtfw5JBznVrkqg5mo-8qT-Im4TWYLP041McGvsREMRuzMcY0A=s0-d-e1-ft#https://d1pgqke3goo8l6.cloudfront.net/VKTV2ixLRtyLXw0tBQzN_tr-email-header-2.jpg" style="width:100%; background:#f0f0f0; max-height:220px" />
								</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td style="padding-top:20px; padding-bottom:20px" width="100%" align="center">
									
									<h2 style="font-size:24px; line-height:32px; margin:0px; padding-bottom:10px; color:#1FB5AD !important; font-family:" >Invitation</h2>
								
									<p style="font-size:95%; line-height:22px; margin:0px; padding-bottom:10px; color:#333333; font-family:"> Invited for <b><?php echo $invitation_data['booking_title'];?></b></p>									
								</td>
							</tr>
						</table>	
						<table cellpadding="0" cellspacing="0" width="95%;" align="center">
							<tr>
								<td style="padding:20px 0px" align="left">			
															
									<p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; border-bottom:1px solid #e1e1e1; margin-bottom:12px; font-weight:600">DETAILS</p>
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Title: <?php echo $invitation_data['booking_title'];?></p>									
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Date: <?php echo date('m/d/Y',strtotime($invitation_data['booking_date'])); ?></p>									
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500">Time: <?php echo date('H:ia',strtotime($invitation_data['booking_date'])); ?></p>		
									
									<!--p style="font-size:75%; line-height:14px; margin:0px; padding-bottom:8px; color:#b2b2b2; border-bottom:1px solid #e1e1e1; margin-bottom:12px; font-weight:600">Your Status updated.</p-->
										
									<p style="font-size:115%; line-height:25px; margin:0px;padding-bottom: 4px;color:#222; font-family:; font-weight:500"><?php echo $invitation_data['guest'];?> is <?php if($invitation_data['bgstatus']==1) { echo 'Going to attend the meeting.'; } else if($invitation_data['bgstatus']==2) { echo 'Maybe Going to attend the meeting.'; } else if($invitation_data['bgstatus']==3) { echo 'Not Going to attend the meeting.'; } ?></p>								
								
								</td>
							</tr>
						</table>
						<table cellpadding="0" cellspacing="0" width="95%;" align="center" style="border-bottom: 1px solid #ccc; border-top: 0px solid #ccc; margin-top:30px; margin-bottom:30px;">
							
						
							<tr>							
							
								<td width="50%" align="center">								
							
									<a href="<?php echo base_url() ?>index.php/booking" style="text-decoration:none; font-size:100%; width:100%; display:inline-block; font-family:; font-weight:400; line-height:20px; color:#cb202d; padding:30px 0" width="100%" >Go To Dashboard</a>
									
								</td>

							</tr>
						
						</table>
						<!--table cellpadding="0" cellspacing="0" width="100%" bgcolor="#323232">
							<tr>
								<td align="center"> 
									<p style="font-size:75%; line-height:22px; color:#ffffff; text-align:center;">&copy; <?php echo date('Y'); ?> All rights reserved.</p>
								</td>
							</tr>
						</table-->
					</td>
				</tr>
			</table>
	</body>
</html>
