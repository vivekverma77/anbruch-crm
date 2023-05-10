<body onload="window.print(); window.close(); ">
	
	<div style="text-align: center;">
		<div>
			<p><h3>Contracts Report</h3></p>
			<p>Stage: <?php echo $stage!="" ? $stage : 'All Stages'; ?></p>
			<p>From: <?php echo $fromDate; ?> - To: <?php echo $toDate; ?></p>
		</div>

		<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
			<thead>
				<tr>

						<th class="text-center">Sr No.</th>
						<?php foreach($meta_field as $field){ ?>
							<th class="text-center"><?php echo $field["name"]; ?></th>											
						<?php } ?>
						<th class="text-center">Created Date</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($contracts))
			{							
				$i=1;						
				foreach ($contracts as $key => $contract)
				{
					$record_mv = $contract["record_mv"];
			?>
			 
				<tr>                   

					<td class="text-center"><?php echo $i; ?></td>
					<?php foreach($record_mv as $mvfield){ ?>
					<td class="text-center"><?php echo $mvfield["value"]; ?></td>	
					<?php } ?>
					<td class="text-center"><?php echo date("m/d/Y",$contract["created_time"]); ?></td>	

				</tr>
		
			<?php $i++;
				 }
			 }
			 ?>
				
				</tbody>

		</table>

	</div>
	
</body>	
