<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<section id="main-content">
    <section class="wrapper" style="width: auto; min-width: 100%;">
			

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       <h3 class="page-title" style="float:left; margin:0; color:#767676; position:relative; top:5px;text-transform:none;">Email Template List</h3>
                        <div style="float: right;">
                            <a class="module_head" href="<?php echo base_url() ?>emailtemplates/add/"><span class="desktop_btn">Add New Template</span><span class="mobile_btn hidden"><i class="fa fa-plus" aria-hidden="true"></i></span></a>
                        </div>
                    </header>
                    <header class="panel-heading">
                        <label for="us">Showing </label>
                        <select id="us" onchange="changeList()" name="rStat" class="populate" style="max-width: 25%;margin-top: -2px;margin-left: 5px;min-width: 80px;">
                            <option <?php echo ($templateStatus == 1) ? 'selected="selected"' : ""; ?> value="1">Active</option>
                            <option <?php echo ($templateStatus == 0) ? 'selected="selected"' : ""; ?> value="0">Inactive</option>
                        </select>
                        <label for="own" style="margin-left:5px;"> Templates</label>
                    </header>
                    
                    <div class="panel-body">
											
											<?php $this->load->view('common/alert'); ?>
											
                        <div class="adv-table">
                            <?php if ($superAdmin == true) { ?>
                                <div class="bulk-action out-from-table">
                                    <div class="btn-group">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if($templateStatus == 0) { ?>
                                                <li><a href="javascript:;" id="mass_restore">Mass Restore</a></li>
                                            <?php }else{ ?>
                                                <li><a href="javascript:;" id="mass_delete">Mass Delete</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                            <form id="record_list_table">
                                <table class="display table new-table table-striped table-condensed" id="dynamic-table" style="width:100% !important;">
                                    <thead>
                                    <tr>
                                        <?php if ($superAdmin == true) { ?>
                                            <th class="no_sorting"> <label style="cursor:pointer; margin-bottom:0;"> <input type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;"> <span class="input-checkbox-icon"></span> </label> </th>
                                        <?php } ?>
                                        <th class="no_sorting">Actions</th>
                                        <th>Module</th>
                                        <th width="10%">Pipeline Stage</th>
                                        <th width="10%">Direction</th>
                                        <th width="25%">Title</th>
                                        <th>Notification Process</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created Time</th>
                                        <th>Modified Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!empty($record_data)){
                                    foreach ($record_data as $key => $record) {
                                        $createdBy = $record['first_name'] . " " . $record['last_name'];
                                        $createdTime = date("m/d/Y h:i:s", strtotime($record['created_time']));
                                        $modifiedTime = ($record['modified_time'] == '') ? "Not Modified Yet" : date("m/d/Y h:i:s", strtotime($record['modified_time']));
                                        ?>
                                        <tr id="tr_<?php echo $record['id']; ?>">
                                            <?php if ($superAdmin == true) { ?>
                                                <td class="center">
                                                    <label style="cursor:pointer;">
                                                        <input type="checkbox" name="chk[]" value="<?php echo $record['id']; ?>" id="<?php echo $record['id']; ?>" style="position:absolute; opacity:0;"/>
                                                        <span class="input-checkbox-icon"></span>
                                                    </label>
                                                </td>
                                            <?php } ?>
                                            <td class="center" style="min-width: 190px;">
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>emailtemplates/editRecord/?id=<?php echo $record['id']; ?>">Edit</a>
                                                |
                                            <?php if($templateStatus == 0) { ?>
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>emailtemplates/restoreRecordById/?id=<?php echo $record['id']; ?>">Restore</a>
                                                |
                                            <?php } else{  ?>
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>emailtemplates/deleteRecordById/?id=<?php echo $record['id']; ?>">Delete</a>
                                                |
                                            <?php } ?>
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>emailtemplates/viewRecord?id=<?php echo $record['id']; ?>">View</a>
                                                |
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>emailtemplates/cloneRecord?id=<?php echo $record['id']; ?>&status=<?php echo $templateStatus; ?>" title="Clone email template">Clone</a>
                                            </td>
                                            <td><?php 
                                                if($record['module_id']==1)
                                                       echo 'Leads';
                                                if($record['module_id']==2)
                                                       echo 'Clients';
                                                if($record['module_id']==3)
                                                       echo 'Contracts';
                                                if($record['module_id']==4)
                                                       echo 'Others';
                                             ?></td>
                                            <td><?php echo $record["pipeline_stage"]; ?></td>
                                            <td><?php if($record["direction"] == 1){echo "Internal";}else if($record["direction"] == 2){echo "External";} ?></td> 
                                            <td><?php echo $record["title"]; ?></td>
                                            <td><?php echo $record['slug_name']; ?></td>
                                            <td><?php echo $record["status"]==1 ? 'Active' : 'Inactive'; ?></td>
                                            <td><?php echo $createdBy; ?></td>
                                            <td><?php echo $createdTime; ?></td>
                                            <td><?php echo $modifiedTime; ?></td>
                                        </tr>
                                    <?php }  } ?>
                                    </tbody>
                                </table>
                            </form>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>



<script type="text/javascript">
    var checkAll = false;
    function newList(){
        var own = $("#own").val();
        var url = "<?php echo base_url() ?>index.php/activities/?&own=" + own;
        window.location.href = url;
    }

    function changeList(){
        var status = $("#us").children("option:selected").val();
        var url = "<?php echo base_url() ?>emailtemplates/" + status;
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
        $('#dynamic-table').dataTable( {
            "aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "responsive": true
        } );

         
    } );
    
    $(document).on('click','#mass_delete',function(){
			
	//console.log('mass_delete');

	 var favorite = [];
		$.each($('input[type="checkbox"]:checked'), function(){            
				favorite.push($(this).val());
		});
		
		console.log(favorite); 
		
			
		if(favorite!='')
		{
				if(confirm('Are you sure to delete?'))
				{
					$.ajax({
						url:  '<?php echo base_url()."index.php/emailtemplates/deleteRecord"; ?>',
						type: "POST",
						data: {'ids': favorite },								
						beforeSend: function() {
							//$("#dynamic-table").css('opacity','0.5');
						},
						success: function(result)
						{
							window.location.reload();							
							console.log(result);
							//$.each(favorite,function(i,j){
									//$('#tr_'+j).hide('slow');
							//});	
							//$("#dynamic-table").css('opacity','1');			
									
						}
					});
				}
			
		}
		else
		{
			alert('Please select an item!');
			return;
		}
	
			
	});
    $(document).on('click','#mass_restore',function(){
            
        var favorite = [];
        $.each($('input[type="checkbox"]:checked'), function(){            
                favorite.push($(this).val());
        });
            
        if(favorite!='')
        {
                if(confirm('Are you sure to restore ?'))
                {
                    $.ajax({
                        url:  '<?php echo base_url()."index.php/emailtemplates/restoreRecord"; ?>',
                        type: "POST",
                        data: {'ids': favorite },                               
                        beforeSend: function() {
                            //$("#dynamic-table").css('opacity','0.5');
                        },
                        success: function(result)
                        {
                            window.location.reload();                           
                            console.log(result);
                            //$.each(favorite,function(i,j){
                                    //$('#tr_'+j).hide('slow');
                            //});   
                            //$("#dynamic-table").css('opacity','1');           
                                    
                        }
                    });
                }
            
        }
        else
        {
            alert('Please select an item!');
            return;
        }
    
            
    });
</script>
<style type="text/css">
    .dataTables_length,.dataTables_filter{padding:15px !important;}
    @media (max-width: 1099px)
    {
     .panel .panel-heading .module_head {margin-top:0px;}
    }


    @media (max-width:667px)
    {
       
    }

    @media (max-width:500px)
    {
        .out-from-table.bulk-action .btn-group{left:auto;}
        .dataTables_wrapper .dataTables_filter{margin-top:30px;}
        .mobile_btn.hidden{display:block !important;}
        .desktop_btn{display:none;}
    }

     @media (max-width:400px)
    {
        .out-from-table.bulk-action {height:auto;top:0px;}
        #main-content .out-from-table.bulk-action .btn-group{left:auto;}
        .dataTables_wrapper .dataTables_filter{margin-top:30px;}
    }

    @media (max-width:360px)
    {
        .dataTables_wrapper .dataTables_filter {margin-top: -5px;margin-bottom: 45px;}
        .out-from-table.bulk-action {top: 120px;left: -67px;}
    }
</style>
