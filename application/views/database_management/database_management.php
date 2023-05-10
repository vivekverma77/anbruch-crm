<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<!--<script src="<?php /*echo base_url() */?>static/js/dynamic_table_init.js"></script>-->

<section id="main-content">
    <section class="wrapper" style="width: auto; min-width: 100%;">

        <div class="row">
            <div class="col-sm-12">

                <h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Database Management </span></h3>

                <section class="panel">
                    <header class="panel-heading">                        
                        <a class="module_head pull-right" href="<?php echo base_url() ?>/DatabaseManagement/backupnow/">Backup Now</a>
                    </header>
                    <div class="panel-body">
							<?php if ($this->session->flashdata('success')){  ?>
							<div class="alert alert-success alert-block fade in" style="margin:15px;">
								<button data-dismiss="alert" class="close close-sm" type="button">
										<i class="fa fa-times"></i>
								</button>
								<h4>
										<i class="icon-ok-sign"></i>
										<?php echo 'Success' ?>!
								</h4>
								<p><?php echo $this->session->flashdata('success'); ?></p>
							</div>
						<?php } ?>	
						<?php if ($this->session->flashdata('error')){  ?>
							<div class="alert alert-danger alert-block fade in" style="margin:15px;">
								<button data-dismiss="alert" class="close close-sm" type="button">
										<i class="fa fa-times"></i>
								</button>
								<h4>
										<i class="icon-ok-sign"></i>
										<?php echo 'Danger' ?>!
								</h4>
								<p><?php echo $this->session->flashdata('error'); ?></p>
							</div>
						<?php } ?>	
											
						 <?php if (isset($message)) foreach ($message as $key => $value) { ?>
                        <div class="alert alert-<?php echo $key ?> alert-block fade in" style="margin:15px;">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <h4>
                                <i class="icon-ok-sign"></i>
                                <?php echo ucfirst($key) ?>!
                            </h4>
                            <p><?php echo $value ?></p>
                        </div>
                        <?php } ?>
                        <div class="adv-table">
                            <?php if($_SESSION['role_id'] == 1) { ?>
                            <div class="bulk-action out-from-table">
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:;" id="mass_delete">Mass Delete</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                            <form id="record_list_table">
                                <table class="display table new-table table-striped table-condensed" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <th nowrap="nowrap" class="no_sorting">
                                                <label style="cursor:pointer;">
                                                    <input type="checkbox" id="checkboxSelect" onclick="selectAll()" style="position:absolute; opacity:0;"/>
                                                    <span class="input-checkbox-icon"></span> 
                                                </label>
                                        </th>
                                        <th nowrap="nowrap" class="no_sorting">Actions</th>
                                        <th nowrap="nowrap">File Name</th>
                                        <th nowrap="nowrap">File Type</th>
                                        <th nowrap="nowrap">File Size</th>
                                        <th nowrap="nowrap">Created On</th>                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($database_list)) {
                                    foreach ($database_list as $db) {
                                        $uid = $db["id"];
                                        ?>
                                        <tr>

                                            <td nowrap="nowrap">
                                                <label style="cursor:pointer;">
                                                    <input type="checkbox" value="<?php echo $uid; ?>" id="<?php echo $uid; ?>" style="position:absolute; opacity:0;"/>
                                                    <span class="input-checkbox-icon"></span> 
                                                </label>
                                            </td>
                                            <td nowrap="nowrap">                                                         
                                                <a class="list_link" href="<?php echo base_url() ?>index.php/DatabaseManagement/downloadRecord/<?php echo $uid; ?>">Download</a> |
                                                <a class="list_link" href="<?php echo base_url() ?>index.php/DatabaseManagement/deleteRecord/<?php echo $uid; ?>" onclick="return confirm('Are you sure to delete this backup?');">Delete</a>
                                            </td>
                                            <td nowrap="nowrap"><?php echo $db["filename"]; ?></td>
                                            <td nowrap="nowrap"><?php echo $db["filetype"]; ?></td>
                                            <td nowrap="nowrap"><?php echo $this->DatabaseModel->formatSizeUnits($db["filesize"]); ?></td>
                                            <td nowrap="nowrap"><?php echo date("m/d/Y, g:i a", strtotime($db["created_time"])); ?></td>                                            
                                        </tr>
                                    <?php } } ?>
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
        var us = $("#us").val();
        var url = "<?php echo base_url() ?>index.php/UserManagement/?us=" + us;
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

    function actionOnUser(uid, uname, action, actionText){
        var url = '<?php echo base_url() ?>index.php/UserManagement/?ac=' + action + '&uid=' + uid;
        if (confirm("Are you sure that you want to " + actionText + " " + uname + "?")) {
            window.location.href = url;
        }
    }

    function bulkActionOnUser(action, actionText){
        var uids = '';
        $("input:checkbox:checked").each(function() {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
        });

        if (uids == ''){
            alert("No user has been selected. Please select an user first.");
            return;
        }

        var url = '<?php echo base_url() ?>index.php/UserManagement/?bulk=on&ac=' + action + '&uid=' + uids;
        if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
            window.location.href = url;
        }
    }

    $(document).ready(function() {
        $('#dynamic-table').dataTable( {
            "aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
        } );
    } );
    
    
     $(document).on('click','#mass_delete',function(){
			
			console.log('mass_delete');
		
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
								url:  '<?php echo base_url()."index.php/DatabaseManagement/deleteMassRecord"; ?>',
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
