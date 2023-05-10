<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>

<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>

<style>
	.ui-datepicker-header {
		background: #1FB5AD;
	}
	
.panel-heading div {
  display: inline-block;
}

.form-group label {
    font-weight: bold;
}

td.no-record {
    text-align: center;
    font-size: 16px;
}

.left {
    float: left;
    width: 50%;
    margin-bottom: 15px;
    margin-left: 75px;
}

.pagination {
	vertical-align:middle;
    display: inline-block;
    padding-left: 0;
    margin: 5px 0;
    border-radius: 4px;
}

.sel select {
    border: none;
    border-radius: 4px;
    height: 29px !important;
    background: #eeeeee;
}

.sel {
    position: absolute;
    top: 134px;
    left: 30px;
}
header {top:0;}
#main-content section.wrapper {display:block;}
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">

		<div class="row">
			<div class="col-sm-12">

				<h3 class="page-title">Invoices</h3>

				<section class="panel">
					<header class="panel-heading">
						
						<?php if ($superAdmin == true) {  ?>
						<div>					
							
							<form name="frmDates" method="get">

								Showing

								<select id="own" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
									<option value="">All Users</option>
								<?php foreach ($users_list as $option_key => $option) { ?>
										<option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
								<?php } ?>
								</select>
								<script type="text/javascript">
									$(document).ready(function() {
											$("#own").select2();
									});
								</script>
								
								<label for="fromDate" style="padding:0 10px;">From </label>
								<input name="fromDate" id="fromDate" class="date-picker" value="<?php echo @$fromDate; ?>" style="padding:7px; border-radius:4px; border:1px solid #e2e2e4;" autocomplete="off">

								<label for="toDate" style="padding:0 10px;">To </label>
								<input name="toDate" id="toDate" class="date-picker" value="<?php echo @$toDate; ?>" style="padding:7px; border-radius:4px; border:1px solid #e2e2e4;" autocomplete="off">

								<button type="submit" id="go" class="btn btn-primary" style="padding:5.5px 12px; margin:-3px 0 0 3px;">Go</button>

							<div class="sel">
								<select name="sel" onchange="form.submit()">
									<option value="10" <?php if($sel == "10") echo "selected"; ?>>10</option>
									<option value="20" <?php if($sel == "20") echo "selected"; ?>>20</option>
									<option value="50"<?php if($sel == "50") echo "selected"; ?>>50</option>
									<option value="100"<?php if($sel == "100") echo "selected"; ?>>100</option>
								</select>
							</div>

								
							</form>	
						</div>							
						<?php } ?>

						<?php if(!empty($invoices)) { ?>
						<a class="module_head" href="<?php echo base_url() ?>reports/invoices_print/?own=<?php echo $own; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" target="_blank" style="float: right;">Print</a>
						
						<a class="module_head" href="<?php echo base_url() ?>reports/invoices_export/?own=<?php echo $own; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" style="float: right;margin-right: 2px;">Export</a>					
						<?php } ?>
					
					</header>

					  <div class="uper-total">
							<div class="left">
							</div>
							<?php if($pagination) { ?>
							   <div style='margin:20px 0; text-align: right; margin-right: 19px; min-height:41px;'>
								  <span style="padding:0 10px;">Total Records: <?php echo $total_record;?></span>
								  <?= $pagination; ?>
							  </div>
							<?php } else{?>
							   <div style='margin:20px 0 0; text-align: right; margin-right: 19px; min-height:41px;'>
								  <span style="padding:0 10px;">Total Records: <?php echo $total_record;?></span>
								  <?= $pagination; ?>
							  </div>
							<?php }?>

                     </div>
					
					<div class="panel-body">
        
	        		<div style="overflow:auto; width:100%;">
            			<table class="display table new-table table-striped table-condensed" id="dynamic-table">
							<thead>
								<tr>
									<th nowrap="nowrap">Sr No.</th>
									<th nowrap="nowrap">Action</th>
									<th nowrap="nowrap">Invoice no.</th>
									<th nowrap="nowrap">Invocie Date</th>
									<th nowrap="nowrap">Recovery Amount (CAD)</th>
									<th nowrap="nowrap">Signing Rate</th>
									<th nowrap="nowrap">Fee Amount (CAD)</th>
									<th nowrap="nowrap">GST Rate</th>
									<th nowrap="nowrap">GST Amount</th>
									<th nowrap="nowrap">Total Invoice Amount (CAD)</th>
									<th nowrap="nowrap">Attention</th>
																		
									<th nowrap="nowrap">Created By</th>
									<th nowrap="nowrap">Created Time</th>
								</tr>
							</thead>
							<tbody>
								
							<?php
								$sno = $row+1;
								//echo "<pre>";print_r($result_data);
								foreach ($result_data as $key => $val)
								{
									$client_data = $val["client_data"];
							?>							 
									<tr>                   

										<td nowrap="nowrap"><?php echo $sno; ?></td>
										
										<td nowrap="nowrap">
											<!--a class="list_link view_content" href="javascript:;" data-id="<?php echo $val["id"]; ?>">View</a-->
											<a href="<?php echo base_url() ?>modules/invoice?cm=Contracts&id=<?php echo $val["record_id"]; ?>&invoice_id=<?php echo $val["id"]; ?>" id="view_invoice" class="" style="">View</a>
										</td>
										
										<td nowrap="nowrap" class="invoice_number_<?php echo $val["id"]; ?>"><?php echo "#".$val["invoice_number"]; ?></td>
										
										<td nowrap="nowrap" class="invoice_date_<?php echo $val["id"]; ?>"><?php echo date("m/d/Y", strtotime($val["invoice_date"]));?></td>
										
										<td nowrap="nowrap" class="invoice_recovery_amount_<?php echo $val["id"]; ?>">$<?php echo $recovery_amount = $val["recovery_amount"];?></td>

										<td nowrap="nowrap" class="invoice_signing_rate_<?php echo $val["id"]; ?>"><?php echo $signing_rate = $val["signing_rate"];?>%</td>

										<td nowrap="nowrap" class="invoice_fee_amount_<?php echo $val["id"]; ?>"><?php
											$fee_amount = ($recovery_amount*$signing_rate)/100; 
											echo $fee_amount_n = number_format($fee_amount,2);
										?></td>

										<td nowrap="nowrap" class="invoice_gst_rate_<?php echo $val["id"]; ?>"><?php echo $gst_rate = $val["gst_rate"];?>%</td>

										<td nowrap="nowrap" class="invoice_gst_amount_<?php echo $val["id"]; ?>"><?php
											$gst_amt = ($fee_amount*$gst_rate)/100; 
											echo $gst_amount = number_format($gst_amt,2);
										?></td>										
										
										<td nowrap="nowrap" class="invoice_total_amount_<?php echo $val["id"]; ?>">$<?php echo $val["total_amount"];?></td>
										
										<td nowrap="nowrap" class="invoice_attention_<?php echo $val["id"]; ?>"><?php echo $client_data["__160"]; ?></td>
										
											<textarea class="invoice_re_<?php echo $val["id"]; ?>" style="display:none"><?php if(isset($client_data["__163"])){ if( is_array($client_data["__163"])){ echo implode(",",$client_data['__163']); }else { echo $client_data["__163"]; } } ?></textarea>
											
											<textarea class="text-center invoice_description_<?php echo $val["id"]; ?>" style="display:none"><?php echo $val["description"]; ?></textarea>
											
											<textarea class="text-center invoice_note_<?php echo $val["id"]; ?>" style="display:none"><?php echo $val["note"]; ?></textarea>

										
										
										<td nowrap="nowrap" class="invoice_by_<?php echo $val["id"]; ?>"><?php echo $val["first_name"].' '.$val["last_name"]; ?></td>
										<td nowrap="nowrap" class="invoice_bydate_<?php echo $val["id"]; ?>" ><?php echo date("m/d/Y", strtotime($val["created_time"])); ?></td>
					
									</tr>
						
								 <?php $sno++;
								 }
								 
									if(count($result_data) == 0){
										echo "<tr>";
										echo "<td class='no-record' colspan='13'>No record found.</td>";
										echo "</tr>";
									}
								 	
							 ?>
								
								</tbody>


           				</table>
           			</div>
      
        
					</div>
				</section>
			</div>
		</div>

	</section>
</section>

	<!-- Modal -->
	<div class="modal fade" id="modalContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width: 900px;">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Invoice Details</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="form-group col-lg-6" style="">
									<label>Invoice No.:</label> <span class="inv_number"></span>
								</div>
								<div class="form-group col-lg-6" style="">
									<label>Invoice Date:</label> <span class="inv_date"></span>
								</div>
							</div>
							<div class="row">	
								<div class="form-group col-lg-6" style="">
									<label>Attention:</label> <span class="inv_attention"></span>
								</div>
								<div class="form-group col-lg-6" style="">
									<label>RE:</label> <span class="inv_re"></span>
								</div>
							</div>
							<div class="row">	
								<div class="form-group col-lg-12" style="">
									<label>Recovery Amount (CAD):</label> <b><span class="inv_recovery_amount"></span></b>
								</div>							
							</div>
							<div class="row">	
								<div class="form-group col-lg-6" style="">
									<label>Signing Rate:</label> <b><span class="inv_signing_rate"></span></b>
								</div>
								<div class="form-group col-lg-6" style="">
									<label>Fee Amount:</label> <b><span class="inv_fee_amount"></span></b>
								</div>
							</div>
							<div class="row">	
								<div class="form-group col-lg-6" style="">
									<label>GST Rate:</label> <b><span class="inv_gst_rate"></span></b>
								</div>
								<div class="form-group col-lg-6" style="">
									<label>GST Amount:</label> <b><span class="inv_gst_amount"></span></b>
								</div>
							</div>
							<div class="row">	
								<div class="form-group col-lg-12" style="">
									<label>Total Invoice Amount(CAD):</label> <b><span class="inv_total_amount"></span></b>
								</div>
							</div>
							<div class="row">		
								<div class="form-group col-lg-6" style="">
									<label>Description:</label> <span class="inv_desc"></span>
								</div>
								<div class="form-group col-lg-6" style="">
									<label>Note:</label> <span class="inv_note"></span>
								</div>
							</div>
							<div class="row">		
								<div class="form-group col-lg-6" style="">
									<label>Created By:</label> <span class="inv_by"></span>
								</div>
								<div class="form-group col-lg-6" style="">
									<label>Created Date:</label> <span class="inv_bydate"></span>
								</div>
							</div>
								
							<div class="clearfix"></div> 
						</div>
						<div class="modal-footer">
								<button data-dismiss="modal" class="btn btn-success" type="button">Ok</button>
								<!--button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change owner of');" type="button">Confirm</button-->
						</div>
				</div>
		</div>
	</div>
	<!-- modal -->

<script type="text/javascript">

	$(function()
	{
    $('.date-picker').datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'dd-mm-yy',        
    });

    $(".view_content").on("click",function()
    {
			var id = $(this).attr("data-id");
			var invoice_number = $(".invoice_number_"+id).html();
			var invoice_date = $(".invoice_date_"+id).html();
			var invoice_attention = $(".invoice_attention_"+id).html();
			var invoice_re = $(".invoice_re_"+id).val();
			var invoice_description = $(".invoice_description_"+id).val();
			var invoice_note = $(".invoice_note_"+id).val();
			var invoice_by = $(".invoice_by_"+id).html();
			var invoice_bydate = $(".invoice_bydate_"+id).html();
			var total_amount = $(".invoice_total_amount_"+id).html();

			
			var recovery_amount = $(".invoice_recovery_amount_"+id).html();
			var signing_rate = $(".invoice_signing_rate_"+id).html();
			var fee_amount = $(".invoice_fee_amount_"+id).html();
			var gst_rate = $(".invoice_gst_rate_"+id).html();
			var gst_amount = $(".invoice_gst_amount_"+id).html();

			$(".inv_number").html(invoice_number);
			$(".inv_date").html(invoice_date);
			$(".inv_attention").html(invoice_attention);
			$(".inv_re").html(invoice_re);
			$(".inv_desc").html(invoice_description);
			$(".inv_note").html(invoice_note);
			$(".inv_by").html(invoice_by);
			$(".inv_bydate").html(invoice_bydate);
			$(".inv_total_amount").html(total_amount);

			$(".inv_recovery_amount").html(recovery_amount);		
			$(".inv_signing_rate").html(signing_rate);		
			$(".inv_fee_amount").html(fee_amount);		
			$(".inv_gst_rate").html(gst_rate);		
			$(".inv_gst_amount").html(gst_amount);		

			$("#modalContent").modal("show");
				
		});
		
	});
	
    var checkAll = false;
    function newList(){
        var own = $("#own").val();
        var url = "<?php echo base_url() ?>activities/?&own=" + own;
        window.location.href = url;
    }

    function selectAll(){
        if (checkAll){
            $('#record_list_table input[type="checkbox"]').prop("checked", false);
            $("#checkboxSelect").removeClass( "btn-danger" ).addClass( "btn-primary" );
            $('#checkboxSelect').text("Select All");
            checkAll = false;
        } else {
            $('#record_list_table input[type="checkbox"]').prop("checked", true);
            $("#checkboxSelect").removeClass( "btn-primary" ).addClass( "btn-danger" );
            $('#checkboxSelect').text("Deselect All");
            checkAll = true;
        }
    }

    $(document).ready(function() {
        var t = $('#dynamic-table222').dataTable( {
					//"aaSorting": [[2,'desc']],
					//"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],					 
        });   
    
    } );
</script>
