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

.panel-heading button {
	background: #222;
	border-radius: 5px;
}
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">

		<div class="row">
			<div class="col-sm-12">
				<section class="panel">
					<header class="panel-heading">
						
						<div class="module_head">Contracts&nbsp;|&nbsp;Showing&nbsp;</div>
						
						<?php if ($superAdmin == true) {  ?>
						<div>
						
							<form name="frmDates" method="get" action="<?php echo base_url();?>reports/contracts1/1">

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

								<label for="fromDate">Stage </label>
								<select id="stage" name="stage" style="width: 115px;">
									<option value="">ALL STAGES</option> 
									<?php foreach($contract_stage as $stg){ ?>
									<option value="<?php echo $stg; ?>" <?php echo ($stage == $stg) ? 'selected="selected"' : "" ?>><?php echo $stg; ?></option>
									<?php } ?>	
								</select>  
								
								<label for="fromDate">From </label>
								<input name="fromDate" id="fromDate" class="date-picker" value="<?php echo @$fromDate; ?>" style="padding: 5px;width: 115px;" autocomplete="off">

								<label for="toDate">To </label>
								<input name="toDate" id="toDate" class="date-picker" value="<?php echo @$toDate; ?>" style="padding: 5px;width: 115px;" autocomplete="off">

								<button type="submit" id="go" class="btn btn-primary">Go</button>
								
							</form>	
						</div>							
						<?php } ?>

						<?php if(!empty($contracts)) { ?>
						<a class="module_head" href="<?php echo base_url() ?>reports/contracts_print/?own=<?php echo $own; ?>&stage=<?php echo $stage; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" target="_blank" style="float: right;">Print</a>
						
						<a class="module_head" href="<?php echo base_url() ?>reports/contracts_export/?own=<?php echo $own; ?>&stage=<?php echo $stage; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" style="float: right;margin-right: 2px;">Export</a>					
						<?php } ?>
					
					</header>

					                      <div class="uper-total">
                      	<div class="left">
                      		<p style=" margin: 10px 0px 0px 15px;font-size: 15px; text-align: left;background: #eeeeee; width: 136px; padding: 4px; border-radius: 2px; ">Total Records:&nbsp;<?php echo $total_record;?>                
                      		</p>
                        </div>
					   <div style='margin-top: 10px; text-align: right; margin-right: 19px;'>
						  <?= $pagination; ?>
					  </div>

                     </div>
					
					<div class="panel-body">
        
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
							<?php if(!empty($result_data))
							{							
									
                 $sno = $row+1;
                 
								foreach ($result_data as $key => $contract)
								{
									//echo '<pre>';print_r($contract);die;
									$record_mv = $contract["record_mv"];
							?>
							 
								<tr>                   

									<td class="text-center"><?php echo $sno; ?></td>
									<?php foreach($record_mv as $mvfield){ ?>
									<td class="text-center"><?php echo $mvfield["value"]; ?></td>	
									<?php } ?>
									<td class="text-center"><?php echo date("d M, Y",$contract["created_time"]); ?></td>	
				
								</tr>
						
							<?php $sno++;

								 }
							 }
							 ?>
								
								</tbody>


            </table>

                           <!-- Paginate -->
   <div style='margin-top: 10px; text-align: right;'>

   <?= $pagination; ?>
   </div>
      
        
					</div>
				</section>
			</div>
		</div>

	</section>
</section>

<script type="text/javascript">

	$(function()
	{
    $('.date-picker').datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'dd-mm-yy',        
    });
	});
	
    var checkAll = false;
    function newList(){
        var own = $("#own").val();
        var url = "<?php echo base_url() ?>index.php/activities/?&own=" + own;
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
        var t = $('#dynamic-table212').dataTable( {
					//"aaSorting": [[2,'desc']],
					//"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],					 
        });   
    
    } );
</script>
