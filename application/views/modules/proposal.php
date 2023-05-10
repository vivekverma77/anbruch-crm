<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>


<div class="card top-border color-red collapsible-card" id="activities-card">

	<div class="custom-bord flex-row toggable-header" data-toggle="collapse" 
	  data-target="#collapse-proposal">
		<div class="col">
			<h4>Proposal</h4>
		</div>
		<div>
			<span class="toggle-card-btn bg-red-50">
				<i class="icon-crm-angle-up"></i>
			</span>
		</div>
	</div>
	<div id="collapse-proposal" class="card-content collapse in">

		<?php  if (isset($proposal) && count($proposal) > 0){ ?>
		
            <table class="display table new-table table-striped table-condensed" id="proposal">
                <thead>
	                <tr class="th-row">
	                	<th>S.No.</th>
	                	<th>Proposal Name</th>
	                    <th >Status</th>
	                    <th>File</th>      
	                    <th >Created At</th>
	                    <th >Client Signed At</th>
	                    <th >Admin Signed At</th>
	                    <th >Created By</th>
	                </tr>
                </thead>
                <tbody>
                    <?php foreach ($proposal as $key => $value) { ?>
                    <tr>
                    	<td></td>
                    	<td><?php echo $value['name']; ?></td>
                    	
                    	<td id="folder<?php echo $value['folder_id'] ?>"><?php echo $value['status'] ?></td>
                    	<td><a class="alink" target="_blank" href="<?php echo base_url().'proposal/'.$value['file']?>"> <i class="fa fa-download"></i> </a></td>
                      	<td><?php echo date('m/d/Y H:i',$value["created_at"]); ?> </td> 
                      	<td><?php echo !empty($value['client_sign_date'])?date('m/d/Y H:i',$value["client_sign_date"]):'-'; ?> </td>
                      	<td><?php echo !empty($value['admin_sign_date'])?date('m/d/Y H:i',$value["admin_sign_date"]):'-'; ?> </td> 
                        <td><?php echo $value['first_name'].' '.$value['last_name']; ?></td>
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
            <h3 class="text-center">No Proposal available.</h3>
        <?php } ?>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#proposal").dataTable( {
			"aaSorting": [[0,'desc']],
			"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
			"fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
               return nRow;
            },
	});

	var data=<?php echo json_encode($proposal)?>;
	var record_id="<?=$current_record_id?>";

    if(data!=null){
		
		$.each(data,function(index,value){
			
	      if(value.status!='EXECUTED'){
			$.ajax({
			  type:'post',
			  dataType: "json",
			  url:'<?php echo base_url()?>'+'proposal/get_folder_detail/'+value.folder_id+'/'+record_id,
			  data:{'admin_party_id':value.admin_party_id,'client_party_id':value.client_party_id,'status':value.status},
			  success:function(res){
			  	  if(res.result=='success'){
			  	  	 $('#folder'+value.folder_id).html(res.folder.folderStatus);
			  	  }
			  }

			})
		   }		
		})
	}
		
});
</script>
