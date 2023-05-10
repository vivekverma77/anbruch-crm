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
						<?php foreach($meta_field as $field){ ?>
							<th class="text-center"><?php echo $field["name"]; ?></th>											
						<?php } ?>
						<th class="text-center">Assigned To</th>
						<th class="text-center">Created By</th>
						<th class="text-center">Created Date</th>
				</tr>
			</thead>
			<tbody>
			<?php if(!empty($recoveries))
				{							
					$i=1;						
					foreach ($recoveries as $key => $contract)
					{
						$record_mv = $contract["record_mv"];
				?>
				 
					<tr>                   

						<td class="text-center"><?php echo $i; ?></td>
						<?php foreach($meta_field as $key=>$field){
							if($field['id']=='169'){?>
							<td class="text-center tech">
								<?php
									if(isset($record_mv[$key]["value"]) && $record_mv[$key]["value"]!="")
									{
										$tech_id = $record_mv[$key]["value"];
										$ci =& get_instance();
										$ci->load->model('ReportsModel');
										echo $ci->ReportsModel->get_user_full_name($tech_id);													
									}
								?>
							</td>	
						<?php } else if($field['id']=='179'){?>
							<td class="text-center tech"><?php if(isset($record_mv[$key]["value"]) && $record_mv[$key]["value"]!="") { echo date("d M, Y", strtotime($record_mv[$key]["value"])); } ?></td>	
						<?php } else { ?>
							<td class="text-center"><?php echo @$record_mv[$key]["value"]; ?></td>	
						<?php }  }?>
						<td class="text-center"><?php echo $contract["ofirst_name"]." ".$contract["olast_name"]; ?></td>	
						<td class="text-center"><?php echo $contract["first_name"]." ".$contract["last_name"]; ?></td>	
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
