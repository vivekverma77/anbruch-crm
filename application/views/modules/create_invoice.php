<style>
.dropdown-toggle::after {
display: none;
}

.invoice {
    max-width: 800px;
    width: 100%;
    margin: 0 auto;
    padding: 40px;
	box-shadow: 0 0 50px #ccc;
}
.invoice table tr td{font-size:16px;}
.invoice p{color: #595959;font-size:15px}
.invoice table tr td {font-size: 14px;}


.card {
	position: relative;
	display: -ms-flexbox;
	display: flex;
	-ms-flex-direction: column;
	flex-direction: column;
	min-width: 0;
	word-wrap: break-word;
	background-color: #fff;
	background-clip: border-box;
	border: none;
	border-radius: .25rem;
}

.invoice-left {
	margin-bottom: 20px;
}
.invoice-right {
	float: right;
	border: 1px solid;
	width: 40%;
	font-size: 20px;
	line-height: 17px;
	text-align: center;
}

p.font-weight-bold.mb-1 {
	border-bottom: 1px solid #607D8B;
	padding: 8px;
	background: #10498a;
	color: white;
}

p.text {
	border-bottom: 1px solid;
	padding: 6px;
	font-weight: bold;
	font-size: 16px;
}

p.text-invoice {
	font-weight: bold;
	font-size: 16px;
	margin: 8px;
}

.attention {
   margin: 20px 0;
}

thead tr {
	background: #10498a;
	color: white;
	text-align: center;
}
.table th,.table td {border:1px solid #ddd !important;}
.table thead th {
  vertical-align: top !important;

}

td p {
  text-align: right;
}

td p.font-weight-bold.mb-4 {
  margin: 0px !important;
}

.left-note {
	float: left;
	width: 60%;
	border: 1px solid #dddddd;
	padding: 100px 0px 100px 0;
	margin-right: 33px;
}

.right-note {
	float: right;
	width: 37%;
	border: 1px solid #dddddd;
	text-align: center;
}
.left-item {
	border: 1px solid #dddddd;
	min-height: 230px;
}
.right-item {
	border: 1px solid #dddddd;
	padding: 0px 16px 0 16px;
	text-align: center;
	min-height: 230px;
}
.right-item p {
    font-size: 13px;
}
hr {
    border-color: #000;
}
.invoice-note {
   margin: 30px 0px 40px 0px;
}
.thankyou {
	width: 100%;
	margin-top: 20px;
	margin-bottom: 30px;
	text-align: center;
}

.footer {
	border-top: 1px solid;
	width: 100%;
	padding: 20px;
	text-align: center;
}

.footer p {
   margin-bottom: 0px;
}
.wrapper{background:#f1f2f7;}
	 [type=reset], [type=submit], button, html [type=button] {
    -webkit-appearance: none;
    -moz-appearance: none;
}

</style>
<section id="main-content">
	<section class="wrapper">
		
		<div class="row">
			<div class="col-lg-12">
				<section class="panel detail-panel">
					<header class="panel-heading">
						Create Invoice
						<div style="float: right;">
							<a type="button" href="<?php echo base_url().'modules/viewRecord/?cm=Contracts&id='.$current_record_id.'&record_status=3' ?>" class="module_head">Back</a>
						</div>			
					</header>
						<?php //print_r($record_data);?>

					<div class="panel-body">
						
						<?php $this->load->view('common/alert'); ?>

						<form role="form" method="post">
							
							<div class="invoice-main">
								<div class="invoice">
									
									<div class="row">
										<div class="col-12">
											<div class="card">
													
												<div class="card-body p-0">
													<div class="row invoice-left">
														<div class="col-md-6">
															<img style= "width: 75%;height: auto;" src="<?php echo base_url(); ?>static/images/anbruch-logo-2.png" alt="">
														</div>
													</div>

													<div class="invoice-right">
														<p class="font-weight-bold mb-1">INVOICE</p>
														<!-- <p class="text">Date: <?php if(isset($record_data["__179"])){ echo date("d/m/Y",strtotime($record_data["__179"])); } else { echo date('d/m/Y'); } ?> <input type="hidden" name="invoice_date" placeholder="Invoice Date" value="<?php if(isset($record_data["__179"])){ echo date("d-m-Y",strtotime($record_data["__179"])); } else { echo date('d-m-Y'); } ?>"></p> -->
														
														<p class="text">Date: <?=  date('m/d/Y');  ?> <input type="hidden" name="invoice_date" placeholder="Invoice Date" value="<?php echo date('Y-m-d');  ?>"></p>

														<!-- <p class="text-invoice">Invoice: #<?php if(isset($record_data["__178"])){ echo $record_data["__178"]; }else{ echo $inv_no = rand(1111111,9999999); } ?> <input type="hidden" name="invoice" placeholder="Invoice" value="<?php if(isset($record_data["__178"])){ echo $record_data["__178"]; }else{ echo $inv_no; } ?>"></p> -->

														<?php 
														$contract_no =$record_data['__165'];
														$invoice_no=$record_data['__165'].'-01';
														/*$services = isset($record_data['__163']) ? $record_data['__163'] :'';*/
														/*$ser_code  = '';
														if(!empty($services)){
															if(is_array($services)){
															foreach ($services as $key => $service) {
															$ser =   explode('-', $service, 2);	
															$ser_code .= '-'.$ser[1];	
															}
														  }else{
														  	$ser =   explode('-', $services, 2);	
															$ser_code .= '-'.$ser[1];
														  }	
														}
														$invoice_no = rand(1111,9999).'-'.date('mdY').$ser_code; */

														//print_r($record_data);?>
														 <p class="text-invoice">Invoice: #<?php echo $invoice_no;?>

														  <input type="hidden" name="invoice" placeholder="Invoice" value="<?php echo $invoice_no; ?>">
														 </p>
													</div>
												</div>

													<div class="row">
														<div class="col-md-12">
															<p class="font-weight-bold mb-4">Bill to:</p>
															<p class="mb-1"><?php if(isset($client_data["__84"])){ echo $client_data["__84"]; } ?></p>
															<p class="mb-1"><?php if(isset($client_data["__115"])){ echo $client_data["__115"]; } ?></p>
															<p class="mb-1"><?php if(isset($client_data["__116"])){ echo $client_data["__116"]; } ?></p>
															<p class="mb-1"><?php if(isset($client_data["__112"])){ echo $client_data["__112"].","; } ?> <?php if(isset($client_data["__117"])){ echo $client_data["__117"]; } ?> <?php if(isset($client_data["__113"])){ echo $client_data["__113"]; } ?></p>
															<p class="mb-1"><?php if(isset($client_data["__114"])){ echo $client_data["__114"]; } ?></p>
															<div class="attention">
																<p>
																	<span class="font-weight-bold mb-4">Attention: </span>
																	<?php if(isset($record_data["__160"])){ echo $record_data["__160"]; } ?>
																</p>
															</div>
															<div class="attention">
																<p>
																	<span class="font-weight-bold mb-4">RE: </span>
																	<?php if(isset($record_data["__163"])){ if( is_array($record_data["__163"])){ echo implode(",\n",$record_data['__163']); }else { echo $record_data["__163"]; } } ?>
																</p>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-12">
															<div class="invoice-table">
																<table class="table">
																	<thead>
																		<tr>
																			<th class="border-0 font-weight-bold">Description</th>
																			<th class="border-0  font-weight-bold">Recovery Amount(CAD)</th>
																			<th class="border-0  font-weight-bold">Hours</th>
																			<th class="border-0  font-weight-bold">Rate(%)</th>
																			<th class="border-0 font-weight-bold">Fee Amount(CAD)</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$fee_amount = 0;
																			if(isset($record_data["__180"])  && is_numeric($record_data["__180"])){ $fee_amount = $record_data["__180"]; }

																			$recovery_amount	= 0;
																			if(isset($record_data["__181"]) && is_numeric($record_data["__181"])){ $recovery_amount	= $record_data["__181"]; }

																			$signing_rate = 0;
																			if(isset($record_data["__164"])){ $signing_rate = $record_data["__164"]; }
																				
																			$total_amount = ($recovery_amount*$signing_rate)/100;
															
																			
																		?>
																		<tr>
																			
																			<td style="padding:0"><textarea placeholder="Enter description" required name="description" style="width: 370px;height: 87px;"><?php if(isset($record_data["__196"])){ echo $record_data["__196"]; } ?></textarea></td>
																			
																			<td style="padding:0"><textarea class="digitonly recovery_amt" placeholder="Enter Recovery Amount(CAD)" required name="recovery_amount" style="width: 158px;height: 87px;"><?php echo $recovery_amount; ?></textarea></td>
																			
																			<td><?php echo $hours=""; ?></td>
																			
																			<td><input type="text" name="signing_rate" value="<?php echo $signing_rate; ?>" class="signing_rate digitonly"  style="width: 110%;"></td>
																			
																			<td class="fee_amount"><?php echo number_format($total_amount,2); ?></td>
																		</tr>
																		<tr>
																			<td rowspan="3" style="border: 0 !important;"></td>
																			<td colspan="3"><p>Sub-Total</p></td>
																			<td class="fee_amount"><?php echo number_format($total_amount,2); ?></td>
																		</tr>
																		<?php
																			$gst_rate=13;
																			$gst_amount = 0;
																			$gst_amt = ($total_amount*$gst_rate)/100; 
																			$gst_amount = number_format($gst_amt,2);
																		 ?>
																		<tr>
																			<td colspan="2">GST/ HST No. 839999539/ RT0001</td>
																			
																			<td><input type="text" name="gst_rate" value="<?php echo $gst_rate; ?>" class="gst_rate digitonly" style="width: 110%;"></td>
																			
																			<td class="gst_amount"><?php echo $gst_amount; ?></td>
																			
																		</tr>
																		<?php
																			$total_invoice_amount = $total_amount+$gst_amt;												
																		 ?>
																		<tr>
																			<td colspan="3"><p class="font-weight-bold mb-4">Total Invoice Amount (CAD)</p></td>
																			<td><p class="font-weight-bold mb-4">$<span class="total_invoice_amount"><?php echo $total_invoice_amount; ?></span></p><input type="hidden" name="total_invoice_amount" value="<?php echo $total_invoice_amount; ?>" class="total_invoice_amount_hdn"></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>

													<div class="invoice-note">
														<div class="row">
															<div class="col-md-7">
																	<p style="margin:0;background: #10498a; color: white; padding: 2px 0px 2px 10px; width: 60px ;">Note:</p>
																	<div class="left-item" style="border:0;">
																		<textarea placeholder="Enter note" required name="note" style="width: 406px;height: 230px;font-size: 13px;"></textarea>
																	</div>
															</div>
															<div class="col-md-5">
																<p style="margin:0;background: #10498a; color: white; padding: 2px 0px 2px 10px; width: 90px ;">Payment:</p>
																<div class="right-item">
																	<p style="margin-top: 20px;">Please make check payable to:</p>
																	<p class="font-weight-bold " style="padding: 7px;">Anbruch Inc.</p>
																	<p class="font-weight-bold " style="padding: 7px;">and mail to:</p>
																	<p class="font-weight-bold ">
																		25 The Esplanade
																		PO Box 122 Station A
																		Toronto ON CA M5W 1A2</p>
																		<hr>
																	<p class="font-weight-bold ">TERMS: NET 30 DAYS</p>

																</div>

															</div>
														</div>

													</div>

													<div class="thankyou">
														<p class="font-weight-bold ">WE APPRECIATE AND THANK YOU FOR YOUR BUSINESS!</p>
													</div>

											</div>

										</div>

									</div>
									
									<div class="footer">
										<p>25 The Esplanade PO Box 122 Station A Toronto ON CA M5W 1A2</p>
										<p>  Toll Free: 1.800.344.2627 Tel: 416.687.2TAX (2829) Fax: 416.900.6TAX (6829)</p>
										<p class="font-weight-bold " style="margin-top: 0px; color: #10498a;">www.anbruch.com</p>
									</div>

								</div>
							</div>

							<div class="clearfix"></div>
							
							<hr/>
							<div class="text-center" style="margin-bottom: 15px;">
								<button type="submit" class="module_head btn btn-primary">Create Invoice</button>
								<a type="submit" href="javascript:history.back()" class="btn btn-danger">Cancel</a>
							</div>
						</form>
						
					</div>

				</section>
			</div>	
		</div>	

	</section>
</section>
<script>
	$('.digitonly').keypress(function(e)
	{
    var a = [];
    var k = e.which;

		a.push(46);
		
    for (i = 48; i < 58; i++)
        a.push(i);

    if (!(a.indexOf(k)>=0))
        e.preventDefault();    
	});
	
	$('.recovery_amt, .signing_rate, .gst_rate').keyup(function()
	{
    console.log($(this).val());
    
    var recovery_amt = $(".recovery_amt").val();
    var signing_rate = $(".signing_rate").val();
    var gst_rate = $(".gst_rate").val();

    var fee_amount = ((recovery_amt*signing_rate)/100).toFixed(2);
    $(".fee_amount").html(fee_amount);
		
		var gst_amount = ((fee_amount*gst_rate)/100).toFixed(2);
		$(".gst_amount").html(gst_amount);

		var total_invoice_amount = (parseFloat(fee_amount)+parseFloat(gst_amount)).toFixed(2);
		$(".total_invoice_amount").html(total_invoice_amount);
		$(".total_invoice_amount_hdn").val(total_invoice_amount);   
    
	});

</script>
