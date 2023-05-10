<body onload="window.print(); window.close(); ">
	
	<div style="text-align: center;">
		<div>
			<p><h3>Invoices Report</h3></p>
			<p>From: <?php echo $fromDate; ?> - To: <?php echo $toDate; ?></p>
		</div>


		<table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
			<thead>
				<tr>
						<th class="text-center">Sr No.</th>						
						<th class="text-center">Invoice no.</th>
						<th class="text-center">Invocie Date</th>
						<th class="text-center">Total Invoice Amount (CAD)</th>
						<th class="text-center">Attention</th>
						<th class="text-center">RE</th>
						<th class="text-center">Description</th>
						<th class="text-center">Note</th>															
						<th class="text-center">Created By</th>
						<th class="text-center">Created Time</th>							
				</tr>
			</thead>
			<tbody>
				
			<?php
				$i=1;
		
				foreach ($invoices as $key => $val)
				{
					$client_data = $val["client_data"];
			?>							 
						<tr>                   

							<td class="text-center"><?php echo $i; ?></td>
							<td class="text-center invoice_number_<?php echo $val["id"]; ?>"><?php echo "#".$val["invoice_number"]; ?></td>
							<td class="text-center invoice_date_<?php echo $val["id"]; ?>"><?php echo date("m/d/Y", strtotime($val["invoice_date"]));?></td>
							<td class="text-center invoice_total_amount_<?php echo $val["id"]; ?>">$<?php echo $val["total_amount"];?></td>
							
							<td class="text-center invoice_attention_<?php echo $val["id"]; ?>"><?php echo $client_data["__160"]; ?></td>
							
							<td class="text-center"><?php if(isset($client_data["__163"])){ if( is_array($client_data["__163"])){ echo implode(", ",$client_data['__163']); }else { echo $client_data["__163"]; } } ?></td>
								
							<td class="text-center invoice_description_<?php echo $val["id"]; ?>"><?php echo $val["description"]; ?></td>
								
							<td class="text-center invoice_note_<?php echo $val["id"]; ?>"><?php echo $val["note"]; ?></td>				
							
							<td class="text-center invoice_by_<?php echo $val["id"]; ?>"><?php echo $val["first_name"].' '.$val["last_name"]; ?></td>
							<td class="text-center invoice_bydate_<?php echo $val["id"]; ?>" ><?php echo date("m/d/Y", strtotime($val["created_time"])); ?></td>
		
						</tr>
		
				 <?php $i++;
				 }
				
			 ?>
				
				</tbody>


		</table>

	</div>

</body>	
