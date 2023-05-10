<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<section class="panel">
    <header class="panel-heading">Activities</header>
    <div class="panel-body">
			<?php if (isset($logs) && count($logs) > 0) { ?>
            <table class="display table table-bordered table-striped table-condensed" id="logs">
                <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Changed Text</th>
                    <th>Created By</th>
                    <th>Created Time</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($logs as $key => $value) { ?>
                    <tr>
                        <td><?php echo $key+1; ?></a></td>
                        <td><?php $arr = json_decode($value["text"]);
													if(!empty($arr)){
														foreach($arr as $k=>$v){
															echo $k .' -> '. $v.'<br>';
														}
													}
                         ?></td>
                        <td><?php echo $value["first_name"]; ?> <?php echo $value["last_name"]; ?></td> 
                        <td class="text-center"><?php if(!empty($value["created_time"])){echo date("j-F-Y", strtotime($value["created_time"]));} ?></td>
                    </tr>
                     <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h3 class="text-center" style="margin: 0;">No activity available.</h3>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
	$("#logs").dataTable( {
			"aaSorting": [[3,'desc']],
			"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
	});
});
</script>
