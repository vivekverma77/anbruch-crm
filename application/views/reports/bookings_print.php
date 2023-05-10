<body onload="window.print(); window.close(); ">

	<div style="text-align: center;">
		<div>
			<p><h3>Bookings Report</h3></p>
			<p>From: <?php echo $fromDate; ?> - To: <?php echo $toDate; ?></p>
		</div>
		<table class="display table table-bordered table-striped table-condensed" id="dynamic-table" style="text-align: center;">
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
				</tr>
			</thead>
			<tbody>			
				<?php
				$i=1;	
				foreach ($bookings as $key => $bkng)
				{
					if($bkng["status"]==0){  $info = 'info-warning'; }
					else if($bkng["status"]==1){  $info = 'info-success'; }
					else if($bkng["status"]==2){  $info = 'info-danger'; } 
					else {  $info = ''; } 				
					?>		 
					<tr>                      
						<td class="text-center"><?php echo $i; ?></td>
						<td class="text-center"><?php echo $bkng["booking_title"]; ?></td>
						<td class="text-center"><?php echo date("m/d/Y", strtotime($bkng["booking_date"]));?></td>
						<td class="text-center"><?php echo date("h:ia", strtotime($bkng["booking_date"])); ?></td>
						<td class="text-center"><?php echo $bkng["name"]; ?></td>
						<td class="text-center"><?php echo $bkng["email"]; ?></td>
						<td class="text-center info_status_<?php echo $bkng["id"]; ?>"><span class="<?php echo $info; ?>"><?php echo $booking_status[$bkng["status"]]; ?></span></td>
						<td class="text-center"><?php echo $bkng["first_name"].' '.$bkng["last_name"]; ?></td>
						<td class="text-center" ><?php echo date("m/d/Y", strtotime($bkng["created_time"])); ?></td>
					</tr>	
					<?php
						$i++;
					}				
				?>		
			</tbody>
		</table>

	</div>
	
</body>
