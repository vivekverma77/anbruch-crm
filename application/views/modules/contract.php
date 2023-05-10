<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>

<style type="text/css">
span.assigned_officer_update { cursor: pointer;lor: #767676 !important;font-weight: 550 !important; }
span.assigned_officer_update:hover { color: #1FB5AD !important; }
#modalOwnerUpdate1 .modal-header { background: #1eb5ad; color:white; }
#modalOwnerUpdate1 .close { color: white; opacity:1; }
#modalOwnerUpdate1 .modal-title , #modalOwnerUpdate1 label { font-weight:550; }
</style>
<div class="card top-border color-pink collapsible-card" id="contracts-card">
  <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-contracts">
    <div class="col">
      <h4>Contracts</h4>
    </div>
    <div>
      <span class="toggle-card-btn bg-pink-50">
        <i class="icon-crm-angle-up"></i>
      </span>
    </div>
  </div>
  <div id="collapse-contracts" class="card-content collapse in">
    <?php if (isset($contracts) && count($contracts) > 0) { ?>
      <table class="display table table-bordered table-striped table-condensed" id="dynamic-table-contract" style="width:100% !important">
        <thead>
          <tr class="th-row">
            <th>Contract Client</th>
            <th>Client Number</th>
            <th>Contract Name</th>
            <th>Contract Number</th>
            <th>Signing Rate</th>
            <th>Closer Name</th>
            <th>Technical Consultant</th>
            <th>Assigned Officer</th>
            <th>Assignied Date</th>
            <th>Completed On</th>
            <th>Stage</th>
            <th>Service Type</th>
            <th>Technical Expected Start Date</th>
            <th>Modified Time</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($contracts as $contract_id => $contract) { ?>
                <tr>
                    <td><a class="alink" target="_blank" href="<?php echo base_url() ?>index.php/modules/viewRecord/?cm=Contracts&id=<?php echo $contract_id ?>"><?php echo $contract["contract_client"] ?></a></td>
                    <td><?php echo $contract['client_number']?></td>
                    <td><a class="alink" target="_blank" href="<?php echo base_url() ?>index.php/modules/viewRecord/?cm=Contracts&id=<?php echo $contract_id ?>"><?php echo $contract["contract_name"] ?></a></td>
                    <td><?php echo $contract['contact_number']?></td>
                    <td><?php echo $contract['signing_rate']?></td>
                    <td><?php echo $contract['closer_name']?></td>
                    <td><?php echo $contract['technical_consultant']?></td>
                    <td><span class="assigned_officer_update" id="<?php echo $contract_id; ?>"><?php echo isset($contract["assigned_officer"]) && $contract["assigned_officer"]!=' ' ? $contract["assigned_officer"] : "Not Available"; ?></span></td>
                    <td><?php echo  date("m/d/Y", $contract["created_time"]); ?></td>
                    <td><?php echo $contract["completed_on"] ?></td> 
                    <td><?php echo $contract["stage"] ?></td>
                    <td><?php echo $contract["service_type"] ?></td>
                    <td>
                        <?php if ($contract["technical_expected_start_date"] != NULL) { ?>
                            <span><?php echo  date("m/d/Y", strtotime($contract["technical_expected_start_date"])); ?></span>
                        <?php } else { ?><span>Not Available</span><?php } ?>
                    </td>
                    <td>
                        <?php if ($record_data["modified_time"] != NULL) { ?>
                            <span><?php echo  date("m/d/Y", $contract["modified_time"]); ?></span>
                        <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
        
      </table>
    <?php } else { ?>
        <h3 class="text-center">No contracts available.</h3>
    <?php } ?>
  </div>
</div>

</section>
<!-- Modal -->
<div class="modal fade" id="modalOwnerUpdate1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Select new record owner</h4>
      </div>
      <div class="modal-body">
        <div class="form-group col-lg-6" style="min-height: 57px !important;">
          <input type="hidden" id="contract_id">
          <label>New Officer *</label>
          <select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
            <?php foreach ($users_list as $option_key => $option) { ?>
            <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
            <?php } ?>
          </select>
          <script type="text/javascript">
          $(document).ready(function() {
          $("#0").select2();
          });
          </script>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
        <button class="btn btn-success" onclick="bulkActionOnContract('cOwner','change owner of');" type="button">Confirm</button>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<script type="text/javascript">
  $(document).ready(function() {
      $('#dynamic-table-contract').dataTable( {
          "aaSorting": [[0,'desc']],
          "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
           "responsive": true

      } );
      $("span.assigned_officer_update").click(function(){
          $("#contract_id").val($(this).attr('id'));
          $("#modalOwnerUpdate1").modal();
      });
  });

  function bulkActionOnContract(action, actionText){ 
        var uids = $("#contract_id").val();
        var newOwner = $("#0").val();
        var url = '<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&current_record_id=<?php echo $current_record_id ?>&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids;
        if (confirm("Are you sure that you want to " + actionText + " these selected contract?")) {
            window.location.href = url;
        }
    }

</script>