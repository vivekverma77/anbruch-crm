<style>
.dropdown-toggle::after {	
	display: none;
}

[type=reset], [type=submit], button, html [type=button] {
  -webkit-appearance: none;
  -moz-appearance: none;
}
.col-12{padding: 0 15px;}
</style>

<section id="main-content">
	<section class="wrapper" style="background:#f1f2f7;">
		
		<div class="row">
			<div class="col-lg-12">
				<section class="panel detail-panel">
					<header class="panel-heading">
						Invoice | Created Date: <?php echo date("m/d/Y",strtotime($invoice_data["created_time"])); ?>

						<div style="float: right;">
							<!--
							<a type="button" href="<?php echo base_url().'modules/invoice_download/?cm=Contracts&id='.$invoice_data["record_id"].'&invoice_id='.$invoice_data["id"] ?>" class="module_head">Download</a>
							|-->
							<a type="button" href="Javascript:;" onclick="printDiv('printableArea')" class="module_head">Print</a>
							|
							<!--a type="button" href="<?php echo base_url().'modules/viewRecord/?cm=Contracts&id='.$invoice_data["record_id"].'&record_status=3' ?>" class="module_head">Back</a-->
							<a type="button" href="javascript:history.go(-1)" class="module_head">Back</a>
						</div>						
					</header>
					
					<div class="panel-body">
						
						<?php $this->load->view('common/alert'); ?>

						<form role="form" method="post">
							
							<div class="invoice-main" id="printableArea">
								<div class="invoice"  style="max-width:700px;width: 100%;margin: 0 auto;padding: 20px;box-shadow: 0 0 50px #ccc;">
									
									<div class="row">
										<div class="col-12">
											<div class="card" style="position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;	flex-direction: column;	min-width: 0;word-wrap: break-word;background-color: #fff;background-clip:border-box;border: none;border-radius: .25rem; ">
													
												<div class="card-body p-0">
													<div class=" invoice-left col-md-6" style="margin-bottom: 0px; width:50%;float:left;">
														<div class="col-md-12">
															<img style= "width: 75%;height: auto;" src="<?php echo base_url(); ?>static/images/anbruch-logo-2.png" alt="">
														</div>
													</div>

													<div class="invoice-right " style="width:50%;float: right;border: 1px solid;width: 50%;font-size: 20px;line-height: 17px;text-align: center;">
														<p class="font-weight-bold mb-1" style="border-bottom: 1px solid #607D8B;padding: 8px;background: #10498a;color: white;">INVOICE</p>
														<p class="text" style="	border-bottom: 1px solid;padding: 6px;font-weight: bold;font-size: 16px;color: black;">Date: <?php if(isset($invoice_data["invoice_date"])){ echo date("d/m/Y",strtotime($invoice_data["invoice_date"])); } ?></p>
														<p class="text-invoice" style="font-weight: bold;font-size: 16px;margin: 8px;color: black;">Invoice: #<?php if(isset($invoice_data["invoice_number"])){ echo $invoice_data["invoice_number"]; } ?></p>
													</div>
												</div>

													<div class="row">
														<div class="col-md-12">
															<p class="font-weight-bold mb-4" style="color: #595959;font-size:15px;"><b>Bill to:</b></p>
															<p class="mb-1" style="color: #595959;font-size:15px;"><?php if(isset($client_data["__84"])){ echo $client_data["__84"]; } ?></p>
															<p class="mb-1" style="color: #595959;font-size:15px;"><?php if(isset($client_data["__115"])){ echo $client_data["__115"]; } ?></p>
															<p class="mb-1" style="color: #595959;font-size:15px;"><?php if(isset($client_data["__116"])){ echo $client_data["__116"]; } ?></p>
															<p class="mb-1" style="color: #595959;font-size:15px;"><?php if(isset($client_data["__112"])){ echo $client_data["__112"].","; } ?> <?php if(isset($client_data["__117"])){ echo $client_data["__117"]; } ?> <?php if(isset($client_data["__113"])){ echo $client_data["__113"]; } ?></p>
															<p class="mb-1" style="color: #595959;font-size:15px;"><?php if(isset($client_data["__114"])){ echo $client_data["__114"]; } ?></p>
															<div class="attention" style="margin: 10px 0;">
																<p style="color: #595959;font-size:15px;">
																	<span class="font-weight-bold mb-4"><b>Attention:</b> </span>
																	<?php if(isset($record_data["__160"])){ echo $record_data["__160"]; } ?>
																</p>
															</div>
															<div class="attention" style="margin: 10px 0;">
																<p style="color: #595959;font-size:15px;">
																	<span class="font-weight-bold mb-4"><b>RE:</b> </span>
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
																		<tr style="	background: #10498a;color: white;text-align: center;">
																			<th class="border-0 font-weight-bold;width: 50%;" style="border:1px solid #ddd !important;  vertical-align: top !important;">Description</th>
																			<th class="border-0  font-weight-bold" style="border:1px solid #ddd !important;  vertical-align: top !important;">Recovery Amount(CAD)</th>
																			<th class="border-0  font-weight-bold" style="border:1px solid #ddd !important;  vertical-align: top !important;">Hours</th>
																			<th class="border-0  font-weight-bold" style="border:1px solid #ddd !important;  vertical-align: top !important;">Rate</th>
																			<th class="border-0 font-weight-bold" style="border:1px solid #ddd !important;  vertical-align: top !important;">Fee Amount(CAD)</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			$fee_amount = 0;																		

																			$recovery_amount	= 0;
																			if(isset($invoice_data["recovery_amount"]) && is_numeric($invoice_data["recovery_amount"])){ $recovery_amount	= $invoice_data["recovery_amount"]; }

																			$signing_rate = 0;
																			if(isset($invoice_data["signing_rate"])){ $signing_rate = $invoice_data["signing_rate"]; }
																				
																			$gst_rate = 0;
																			if(isset($invoice_data["gst_rate"])){ $gst_rate = $invoice_data["gst_rate"]; }
																				
																			$total_amount = 0;
																			if(isset($invoice_data["total_amount"])){ $total_amount = $invoice_data["total_amount"]; }

																			$fee_amount = ($recovery_amount*$signing_rate)/100; 
																			$fee_amount_n = number_format($fee_amount,2);
														
																		?>
																		<tr>
																			<td style="font-size: 14px; border:1px solid #ddd !important; color: #353333;"><?php echo $invoice_data["description"]; ?></td>
																			<td style="font-size: 14px;border:1px solid #ddd !important; color: #353333;"><?php echo number_format($recovery_amount,2); ?> </td>
																			<td style="font-size: 14px; border:1px solid #ddd !important; color: #353333;"><?php echo $hours=""; ?></td>
																			<td style="font-size: 14px; border:1px solid #ddd !important; color: #353333;"><?php echo $signing_rate."%"; ?></td>
																			<td style="font-size: 14px; border:1px solid #ddd !important; color: #353333;"><?php echo $fee_amount_n; ?></td>
																		</tr>
																		<tr>
																			<td rowspan="3" style="border: 0 !important; font-size: 14px;"></td>
																			<td colspan="3" style="font-size: 14px; border:1px solid #ddd !important;"><p style="text-align: right;color: #353333;">Sub-Total</p></td>
																			<td style="font-size: 14px; border:1px solid #ddd !important; color: #353333;"><?php echo $fee_amount_n; ?></td>
																		</tr>
																		<?php																			
																			$gst_amount = 0;
																			$gst_amt = ($fee_amount*$gst_rate)/100; 
																			$gst_amount = number_format($gst_amt,2);
																		 ?>
																		<tr>
																			<td colspan="2" style="border:1px solid #ddd !important; color: #353333;">GST/ HST No. 839999539/ RT0001</td>
																			<td style="font-size: 14px; border:1px solid #ddd !important; color: #353333;"><?php echo $gst_rate."%"; ?></td>
																			<td style="font-size: 14px; border:1px solid #ddd !important; color: #353333;"><?php echo $gst_amount; ?></td>
																		</tr>
																		<?php
																			$total_invoice_amount = $total_amount;												
																		 ?>
																		<tr>
																			<td colspan="3" style="font-size: 14px;border:1px solid #ddd !important;"><p class="font-weight-bold mb-4" style="text-align: right; margin: 0px !important;"><b style="color: black;">Total Invoice Amount (CAD)</b></p></td>
																			<td style="font-size: 14px; border:1px solid #ddd !important;"><p style="text-align: right; margin: 0px !important;"><b style="color: black;">$<?php echo $total_invoice_amount; ?></b></p></td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>

													<div class="invoice-note" style="margin: 0px 0px 10px 0px;">
														<div class="row">
															<div class="col-md-7" style="width:60%;float:left;">
																	<p style="margin:0;background: #10498a; color: white; padding: 2px 0px 2px 10px; width: 60px ;">Note:</p>
														      <div class="left-item" style="border: 1px solid #dddddd;min-height: 200px;font-size:13px;padding: 4px; color: #353333;">
																		<?php echo $invoice_data["note"]; ?>
																	</div>
															</div>
															<div class="col-md-5" style="width:40%; float:right;">
																<p style="margin:0;background: #10498a; color: white; padding: 2px 0px 2px 10px; width: 90px ;">Payment:</p>
																<div class="right-item" style="	border: 1px solid #dddddd;padding: 0px 16px 0 16px;	text-align: center;	min-height: 200px;">
																	<p style="margin-top: 20px; font-size: 13px; color: #353333;" >Please make check payable to:</p>
																	<p class="font-weight-bold " style="padding: 7px;font-size: 13px;padding:0;"><b style="color: black;">Anbruch Inc.</b></p>
																	<p class="font-weight-bold " style="padding: 7px;font-size: 13px;"><b style="color: black;">and mail to:</b></p>
																	<p class="font-weight-bold ">
																		<b style="color: black;">25 The Esplanade
																		PO Box 122 Station A
																		Toronto ON CA M5W 1A2</b></p>
																		<hr style="border-color: #000;margin-top: 10px;margin-bottom: 10px;">
																	<p class="font-weight-bold "><b style="color: black;">TERMS: NET 30 DAYS</b></p>

																</div>

															</div>
														</div>

													</div>

													<div class="thankyou" style="width: 100%;margin-top: 10px;margin-bottom: 10px;text-align: center;">
														<p class="font-weight-bold "><b style="color: black;">WE APPRECIATE AND THANK YOU FOR YOUR BUSINESS!</b></p>
													</div>

											</div>

										</div>

									</div>
									
									<div class="footer" style="border-top: 1px solid;width: 100%;padding: 10px;text-align: center;">
										<p style="margin-bottom: 0px; color: #353333;">25 The Esplanade PO Box 122 Station A Toronto ON CA M5W 1A2</p>
										<p style="margin-bottom: 0px; color: #353333;">  Toll Free: 1.800.344.2627 Tel: 416.687.2TAX (2829) Fax: 416.900.6TAX (6829)</p>
										<p class="font-weight-bold " style="margin-top: 0px; color: #10498a;margin-bottom: 0px;">www.anbruch.com</p>
									</div>

								</div>
							</div>
			
						</form>
						
					</div>

				</section>
			</div>	
		</div>	

	</section>
</section>
<script>

	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>	
