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

	td.status_col span {font-size:0; padding:6px; position:relative; cursor:pointer; z-index:1; border-radius:50px;}
	td.status_col .info-warning {background:#673AB7;}
	td.status_col .info-danger {background:#ff5722;}
	td.status_col span:before {content:'Cancelled'; font-size:13px; position:absolute; color:#fff; top:0px; background:#73879f; padding:4px 10px; border-radius:2px; left:-34px; letter-spacing:.5px; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
	td.status_col .info-warning:before {content:'New'; left:-17px;}
	td.status_col .info-success:before {content:'Confirmed'}
	td.status_col span:hover:before {top:14px; opacity:1;}


	.ui-datepicker-header {
		background: #1FB5AD;
	}
	
.panel-heading div {
  display: inline-block;
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
    top:148px;
    left:20px;
}

header {top:0;}
#main-content section.wrapper {display:block;}

</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">

		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">Bookings</h3>
				<section class="panel">
					<header class="panel-heading">
						
						<?php if ($superAdmin == true) {  ?>
						<div>
							
							<form name="frmDates" method="get" action="<?php echo base_url();?>reports1/bookings/1">

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

								<button type="submit" id="go" class="btn btn-success" style="padding:5.5px 12px; margin:-3px 0 0 3px;">Go</button>

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

						<?php if(!empty($bookings)) { ?>
						<a class="module_head" href="<?php echo base_url() ?>reports/bookings_print/?own=<?php echo $own; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" target="_blank" style="float: right;">Print</a>
						
						<a class="module_head" href="<?php echo base_url() ?>reports/bookings_export/?own=<?php echo $own; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" style="float: right;margin-right: 2px;">Export</a>					
						<?php } ?>
					
					</header>
                      
                      <div class="uper-total">
                      	<?php if($pagination){ ?>
                      	<div style='margin:20px 20px 10px 0; text-align:right;'>
						  <span style="padding:0 10px;">Total Records: <?php echo $total_record;?></span>
						  <?= $pagination; ?>
					  	</div>
                      	<?php } else {?>
	                      	<div style='margin:40px 20px 10px 0; text-align:right;'>
							  <span style="padding:0 10px;">Total Records: <?php echo $total_record;?></span>
							  <?= $pagination; ?>
						  	</div>
                      	<?php }?>	
					   

                     </div>

					
					<div class="panel-body">

			<div style="color:#73879C; font-size:14px; margin-top:-30px; position:relative; top:-10px; margin-left:120px; float:left;">
				<strong>Status:</strong>
				<span style="display:inline-block; padding:5px; background:#1fb5ad; border-radius:50px; margin:0 5px;"></span> Confiremd | 
				<span style="display:inline-block; padding:5px; background:#673ab7; border-radius:50px; margin:0 5px;"></span> New |
				<span style="display:inline-block; padding:5px; background:#ff5722; border-radius:50px; margin:0 5px;"></span> Cancelled 

			</div>
        
        <div style="overflow:auto; padding-bottom:20px;">
            <table class="display table new-table table-striped table-condensed" id="dynamic-table">
							<thead>
								<tr>

										<th nowrap="nowrap">Sr No.</th>
										<th nowrap="nowrap">Booking Title</th>
										<th nowrap="nowrap">Booking Date</th>
										<th nowrap="nowrap">Booking Time</th>
										<th nowrap="nowrap">Name</th>
										<th nowrap="nowrap">Email</th>                    
										<th nowrap="nowrap" class="text-right">Status</th>                    
										<th nowrap="nowrap">Created By</th>
										<th nowrap="nowrap">Created Time</th>							
								</tr>
							</thead>
							<tbody>
								
							<?php
								$sno = $row+1;
						
								foreach ($result_data as $key => $bkng)
								{
									if($bkng["status"]==0){  $info = 'info-warning'; }
									else if($bkng["status"]==1){  $info = 'info-success'; }
									else if($bkng["status"]==2){  $info = 'info-danger'; } 
									else {  $info = ''; } 
									
									?>
							 
										<tr>                   

											<td nowrap="nowrap"><?php echo $sno; ?></td>
											<td nowrap="nowrap"><?php echo $bkng["booking_title"]; ?></td>
											<td nowrap="nowrap"><?php echo date("m/d/Y", strtotime($bkng["booking_date"]));?></td>
											<td><?php echo date("h:ia", strtotime($bkng["booking_date"])); ?></td>
											<td nowrap="nowrap"><?php echo $bkng["name"]; ?></td>
											<td nowrap="nowrap"><?php echo $bkng["email"]; ?></td>
											<td class="text-center status_col info_status_<?php echo $bkng["id"]; ?>"><span class="<?php echo $info; ?>"><?php echo $booking_status[$bkng["status"]]; ?></span></td>
											<td nowrap="nowrap"><?php echo $bkng["first_name"].' '.$bkng["last_name"]; ?></td>
											<td nowrap="nowrap"><?php echo date("m/d/Y", strtotime($bkng["created_time"])); ?></td>
						
										</tr>
						
								 <?php $sno++;
								 }

								     if(count($result_data) == 0){
								      echo "<tr>";
								      echo "<td class='no-record' colspan='9'>No record found.</td>";
								      echo "</tr>";
								    }
															 	
							 ?>
								
								</tbody>

            </table>
        </div>

               <!-- Paginate -->
   <div style='padding:0 15px 10px; text-align:right;'>

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
        var t = $('#dynamic-table123').dataTable( {
					//"aaSorting": [[2,'desc']],
					//"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],					 
        });   
    
    } );
</script>
