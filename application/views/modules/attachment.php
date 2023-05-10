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
    .attach .status_txt{    
    margin-left: -56px;
    width: 112px;}

</style>


<div class="card top-border color-blue collapsible-card" id="attachments-card">
    
    <div class="custom-bord flex-row">
        <div class="col" data-toggle="collapse" data-target="#collapse-attachments">
            <h4>Attachments / Documents</h4>
        </div>
        <div class="upload" style="margin:-2.5px 15px 10px;">
            <?php if(!$openerRights){ ?>
            <button type="button" class="btn btn-fill-blue" data-toggle="modal" data-target="#upload-document-popup">
                <i class="icon-crm-folder-open-o"></i>
                <span> Upload Document </span>
            </button>
        <?php } ?>
        </div>
        <div data-toggle="collapse" data-target="#collapse-attachments">
            <span class="toggle-card-btn bg-green-50">
                <i class="icon-crm-angle-up"></i>
            </span>
        </div>
    </div>

    <div id="collapse-attachments" class="card-content collapse in">

        <?php if (isset($attachments) && count($attachments) > 0) { ?>
        <div class="table-responsive">
        <?php if($current_module=='Leads'){?>  
            <div class="status-legend">
             <b>Status-</b>
                <span><span class="legend-circle bg-theme-500"></span> Qualify  </span>
                <span><span class="legend-circle bg-red-status"></span> Not Qualified </span>
                <span><span class="legend-circle bg-yellow-status"></span> Other Document </span>
           </div>
        <?php } ?>
        <table class="display table new-table table-striped table-condensed" id="dynamic-table-attachment">
            <thead>
                <tr class="th-row">
                    <th>S.No.</th>
                    <th>File Name</th>
                    <th>Uploaded Time</th>
                    <th>Uploaded By</th>
                    <?php
                        if($current_module=='Leads'){?>
                    <th class="text-center" nowrap="nowrap">Status</th>
                   <?php } ?>
                    <th class="text-center">Download</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($attachments as $key => $attachment) { ?>
                    <tr>
                        <td></td>
                        <td><a class="alink" target="_blank" href="<?php echo $attachment["link"] ?>"><?php echo $attachment["name"] ?></a></td>
                       <td><?php echo date("m/d/Y H:i", $attachment["uploaded_time"]) ?></td>
                        <td><?php echo $attachment["uploaded_by"] ?></td>

                        <?php
                        if($current_module=='Leads'){
                    if($attachment["status"]==0){  $info = 'status-circle bg-red-status'; $status='Not Qualified'; }
                    else if($attachment["status"]==2){  $info = 'status-circle bg-theme-500';$status='Qualified'; }
                    else if($attachment["status"]==1){  $info = 'status-circle bg-yellow-status';$status='Other Document';} 
                        ?>
                        <td class="text-center attach">
                            <span class="<?php echo $info; ?>"> <span class="status_txt"><?php echo $status; ?></span></span> 
                        </td>
                    <?php } ?>
                        <td class="text-center">
                            <a class="alink" target="_blank" href="<?php echo $attachment["link"] ?>" download> <i class="fa fa-download"></i> </a>
                        </td>
                    </tr>
            <?php } ?>
            </tbody>
            
        </table>
       </div> 
        <?php } else { ?>
            <h3 class="text-center">No attachments available.</h3>
        <?php } ?>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dynamic-table-attachment').dataTable( {
            //"aaSorting": [[1,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
        } );
    } );
</script>