<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>


<div class="card top-border color-red collapsible-card" id="activities-card">

	<div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-activities">
		<div class="col">
			<h4>Recent Activities</h4>
		</div>
		<div>
			<span class="toggle-card-btn bg-red-50">
				<i class="icon-crm-angle-up"></i>
			</span>
		</div>
	</div>
	<div id="collapse-activities" class="card-content collapse in">

		<?php  if (isset($logData) && count($logData) > 0){ ?>
		
            <table class="display table new-table table-striped table-condensed" id="logs">
                <thead>
	                <tr class="th-row">
	                	<th style="display:none">id</th>
	                    <th>Activity Title</th>
	                    <th>Stage</th>
	                    <th>Activity Description</th>
	                    <th>Activity Date</th>
	                    <th>Module Name</th>
	                    <th>Activity  By</th>
	                </tr>
                </thead>
                <tbody>
                    <?php foreach ($logData as $key => $value) { ?>
                    <tr>
                    	 <td style="display:none"><?php echo $value["id"];?></td>
                        <td><?php echo $value["title"];?></td>
                        <td><?php echo $value["stage"];?></td>
                         <td><?php echo $value['description'] ?></td>
                        <td><?php echo date('m/d/Y H:i',strtotime($value["date"])); ?> </td> 
                         <td><?php echo $value['module_name'] ?></td>
                         <td><?php echo $value['activity_user'] ?></td>
                    </tr>
                     <?php } ?>
                </tbody>
                <!-- <tfoot>
	                <tr class="th-row">
	                	 <th style="display:none">id</th>
	                    <th>Activity Title</th>
	                     <th>Activity Description</th>
	                    <th>Activity Date</th>
	                    <th>Activity Time</th>
	                     <th>Module Name</th>
	                    <th>Activity By</th>
	                </tr>
                </tfoot> -->            
            </table>
            
        <?php } else { ?>
            <h3 class="text-center">No activity available.</h3>
        <?php } ?>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#logs").dataTable( {
			"aaSorting": [[0,'desc']],
			"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
	});
});
</script>
