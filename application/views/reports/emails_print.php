<body onload="window.print(); window.close(); ">
	
	<div style="text-align: center;">
		<div>
			<p><h3>Emails Report</h3></p>
			<p>From: <?php echo $fromDate; ?> - To: <?php echo $toDate; ?></p>
		</div>

		<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
			<thead>
				<tr>
						<th class="text-center">Sr No.</th>
						<th class="text-center">From</th>
						<th class="text-center">To</th>
						<!--th class="text-center">Cc</th>
						<th class="text-center">Bcc</th-->
						<th class="text-center">Subject</th>                    
						<th class="text-center">Content</th>                    
						<th class="text-center">Created By</th>
						<th class="text-center">Created Time</th>							
				</tr>
			</thead>
			<tbody>
				
			<?php
				$i=1;
		
				foreach ($emails as $key => $val)
				{												
			?>							 
					<tr>
						<td class="text-center"><?php echo $i; ?></td>
						<td class="text-center from_<?php echo $val["id"]; ?>"><?php echo $val["from"]; ?></td>
						<td class="text-center to_<?php echo $val["id"]; ?>"><?php echo $val["to"]; ?></td>
						<!--td class="text-center"><?php echo $val["cc"]; ?></td>
						<td class="text-center"><?php echo $val["bcc"]; ?></td-->
						<td class="text-center subject_<?php echo $val["id"]; ?>"><?php echo $val["subject"]; ?></td>
						<td class="text-center"><?php echo $val["content"]; ?></td>
						<td class="text-center"><?php echo $val["first_name"].' '.$val["last_name"]; ?></td>
						<td class="text-center"><?php echo date("m/d/Y h:ia", strtotime($val["created_time"]));?></td>
					</tr>
	
			 <?php $i++;
			 }							 	
			 ?>
				
			</tbody>


		</table>


	</div>
</body>		
