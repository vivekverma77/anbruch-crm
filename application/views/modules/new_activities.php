<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>


<div class="card bordered-card color-red collapsible-card" id="activities-card">

	<div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#collapse-activities">
		<div class="col">
			<h4>Activities</h4>
		</div>
		<div>
			<span class="toggle-card-btn bg-red-50">
				<i class="icon-crm-angle-up"></i>
			</span>
		</div>
	</div>
	<div id="collapse-activities" class="card-content collapse in">

		<?php if (isset($logs) && count($logs) > 0) { ?>
            <table class="display table new-table table-striped table-condensed" id="logs">
                <thead>
	                <tr class="th-row">
	                    <th>Sr. No</th>
	                    <th>Changed Text</th>
	                    <th>Created By</th>
	                    <th>Created Time</th>
	                </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $key => $value) { ?>
                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php $arr = json_decode($value["text"]);
							if(!empty($arr)){
								foreach($arr as $k=>$v){
									echo $k .' - '. $v.'<hr style="margin:10px 0;">';
								}
							}
                         ?></td>
                        <td><?php echo $value["first_name"]; ?> <?php echo $value["last_name"]; ?></td> 
                        <td><?php if(!empty($value["created_time"])){echo date("m/d/Y", strtotime($value["created_time"]));} ?></td>
                    </tr>
                     <?php } ?>
                </tbody>
                <tfoot>
	                <tr class="th-row">
	                    <th>Sr. No</th>
	                    <th>Changed Text</th>
	                    <th>Created By</th>
	                    <th>Created Time</th>
	                </tr>
                </tfoot>            
            </table>
        <?php } else { ?>
            <h3 class="text-center">No activity available.</h3>
        <?php } ?>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#logs").dataTable( {
			"aaSorting": [[3,'desc']],
			"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
	});
});
</script>
