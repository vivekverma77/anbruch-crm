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
.dataTables_length, .dataTables_filter {padding:15px 0;}
	.ui-datepicker-header {
		background: #1FB5AD;
	}
	
.panel-heading div {
  display: inline-block;
}

header {top:0;}
#main-content section.wrapper {display:block;}

td.details table tr td, .dataTable tr:last-child {background:#fff; border-bottom:1px solid #ddd;}

#main-content:not(.merge-left) .panel-heading .right-btns {float:right;}
#main-content.merge-left .panel-heading .right-btns {margin-top:10px;}
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">

		<div class="row">
			<div class="col-sm-12">
				<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Contracts </span></h3>
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

								<label for="fromDate" style="padding:0 10px;">Stage </label>
								<select id="stage" name="stage" style="width:135px;">
									<option value="">ALL STAGES</option> 
									<?php foreach($contract_stage as $stg){ ?>
									<option value="<?php echo $stg; ?>" <?php echo ($stage == $stg) ? 'selected="selected"' : "" ?>><?php echo $stg; ?></option>
									<?php } ?>	
								</select>  
								
								<label for="fromDate" style="padding:0 10px;">From </label>
								<input name="fromDate" id="fromDate" class="date-picker" value="<?php echo @$fromDate; ?>" style="padding:7px; border-radius:4px; border:1px solid #e2e2e4; width:115px;" autocomplete="off">

								<label for="toDate" style="padding:0 10px;">To </label>
								<input name="toDate" id="toDate" class="date-picker" value="<?php echo @$toDate; ?>" style="padding:7px; border-radius:4px; border:1px solid #e2e2e4; width:115px;" autocomplete="off">

								<button type="submit" id="go" class="btn btn-primary" style="padding:5.5px 12px; margin:-3px 0 0 3px;">Go</button>
								
							</form>	
						</div>							
						<?php } ?>

						<?php if(!empty($contracts)) { ?>
							<div class="right-btns" style="text-align:right; display:block;">
							  <a class="module_head" href="<?php echo base_url() ?>reports/contracts_export/?own=<?php echo $own; ?>&stage=<?php echo $stage; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" style="margin-right:2px;">Export</a>
							  <a class="module_head" href="<?php echo base_url() ?>reports/contracts_print/?own=<?php echo $own; ?>&stage=<?php echo $stage; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" target="_blank">Print</a>
							</div>
						<?php } ?>
					
					</header>
					
					<div class="panel-body">
        
        <div style="overflow:auto;">
            <table class="display table new-table table-striped table-condensed" id="dynamic-table">
							<thead>
								<tr>

									<th nowrap="nowrap" style="min-width:77px;">Sr No.</th>
									<?php foreach($meta_field as $field){ ?>
										<th nowrap="nowrap"><?php echo $field["name"]; ?></th>											
									<?php } ?>
									<th nowrap="nowrap">Created Date</th>
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

									<td nowrap="nowrap"><?php echo $i; ?></td>
									
									<?php foreach($meta_field as $key=>$field){
										if($field['id']=='169'){	 ?>
										<td nowrap="nowrap" class="tech">
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
										<?php } else { ?>										
									<td nowrap="nowrap"><?php if(!empty($record_mv[$key]["value"])){ echo $record_mv[$key]["value"]; }?></td>	
									<?php } }?>
									
									<td nowrap="nowrap"><?php echo date("m/d/Y",$contract["created_time"]); ?></td>	
				
								</tr>
						
							<?php $i++;
								 }
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
        var t = $('#dynamic-table').dataTable( {
					//"aaSorting": [[2,'desc']],
					//"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],					 
        });   
    
    } );
</script>
