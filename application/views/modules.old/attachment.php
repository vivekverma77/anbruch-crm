<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<style>
    label {
    text-align: left;
}
</style>
<section class="panel">
    <header class="panel-heading">Attachments / Documents</header>
    <div class="panel-body">
        <div class="col-sm-6" style=" border-right: 1px solid #1fb5ad;">
        <?php if (isset($attachments) && count($attachments) > 0) { ?>
        <table class="display table table-bordered table-striped table-condensed" id="dynamic-table-attachment">
            <thead>
            <tr>
                <th>Sno.</th>
                <th class="text-center">File Name</th>
                <!-- <th class="text-center">File Link</th> -->
                <th class="text-center">Uploaded Time</th>
                <th class="text-center">Uploaded By</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($attachments as $key => $attachment) { ?>
                    <tr>
                        <td></td>
                        <td class="text-center"><a class="alink" target="_blank" href="<?php echo $attachment["link"] ?>"><?php echo $attachment["name"] ?></a></td>
                       <!--  <td class="text-center"><a class="alink" target="_blank" href="<?php echo $attachment["link"] ?>">Click Here</a></td>
 -->                        <td class="text-center"><?php echo date("j-F-Y", $attachment["uploaded_time"]) ?></td>
                        <td class="text-center"><?php echo $attachment["uploaded_by"] ?></td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <h3 class="text-center" style="margin: 0;">No attachments available.</h3>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
        <!-- <hr/> -->
        <div class="col-sm-6">
        <form role="form" action="?cm=<?php echo $current_module; ?>&ac=attachment&id=<?php echo $current_record_id; ?>" enctype="multipart/form-data" method="post" style="margin-top: 50px;">
            <input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>"/>
            <div class="form-group col-lg-12" style="min-height: 57px !important;">
                <label for="record_attachment">Add Attachment</label>
                <input id="record_attachment" type="file" name="record_attachment" class="default" />
            </div>
            <div class="form-group col-lg-12" style="min-height: 57px !important;">
                <label for="file_name">Enter the file name *</label>
                <input name="file_name" type="text" class="form-control" required="required" id="file_name" placeholder="Enter the name of the file">
            </div>
            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                <button type="submit" class="btn btn-info">Upload attachment</button>
            </div>
        </form>
    </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dynamic-table-attachment').dataTable( {
            "aaSorting": [[1,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
        } );
    } );
</script>