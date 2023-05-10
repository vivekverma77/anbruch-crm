<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<section class="panel">
    <header class="panel-heading">Contracts</header>
    <div class="panel-body">
        <?php if (isset($contracts) && count($contracts) > 0) { ?>
        <table class="display table table-bordered table-striped table-condensed" id="dynamic-table-contract">
            <thead>
            <tr>
                <th class="text-center">Contract Name</th>
                <th class="text-center">Service Type</th>
                <th class="text-center">Assigned Officer</th>
                <th class="text-center">Stage</th>
                <th class="text-center">Created Time</th>
                <th class="text-center">Modified Time</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($contracts as $contract_id => $contract) { ?>
                    <tr>
                        <td class="text-center"><a class="alink" target="_blank" href="<?php echo base_url() ?>index.php/modules/viewRecord/?cm=Contracts&id=<?php echo $contract_id ?>"><?php echo $contract["contract_name"] ?></a></td>
                        <td class="text-center"><?php echo $contract["service_type"] ?></td>
                        <td class="text-center"><?php echo $contract["assigned_officer"] ?></td>
                        <td class="text-center"><?php echo $contract["stage"] ?></td>
                        <td class="text-center"><?php echo date("j-F-Y", $contract["created_time"]) ?></td>
                        <td class="text-center">
                            <?php if ($record_data["modified_time"] != NULL) { ?>
                                <span><?php echo date("j-F-Y", $contract["modified_time"]); ?></span>
                            <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                        </td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <h3 class="text-center" style="margin: 0;">No contracts available.</h3>
        <?php } ?>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dynamic-table-contract').dataTable( {
            "aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
        } );
    } );
</script>