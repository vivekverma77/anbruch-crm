<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<!--<script src="<?php /*echo base_url() */?>static/js/dynamic_table_init.js"></script>-->

<style type="text/css">
    .alert-box .alert {margin:15px;}
</style>

<section id="main-content">
    <section class="wrapper" style="width: auto; min-width: 100%;">

        <div class="row">
            <div class="col-sm-12">
                <h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title"> Team Management </span></h3>
                <section class="panel">
                    <header class="panel-heading">
                        <label for="us">Showing </label>
                        <select id="us" onchange="newList()" name="rStat" class="populate" style="max-width: 25%;margin-top: -2px;margin-left: 5px;min-width: 80px;">
                            <option <?php echo ($teamStatus == 1) ? 'selected="selected"' : ""; ?> value="1">Active</option>
                            <option <?php echo ($teamStatus == 0) ? 'selected="selected"' : ""; ?> value="0">Inactive</option>
                        </select>
                        <label for="own" style="margin:0 6px;"> Teams</label>
                        <a class="module_head pull-right" href="<?php echo base_url() ?>index.php/TeamManagement/addNew/">Add New</a>
                    </header>
                    <div class="panel-body">
					   
                        <div class="alert-box">
                            <?php $this->load->view('common/alert'); ?>
                        </div>			
                       
                        <div class="adv-table">
                            <?php if($_SESSION['role_id'] == 1){ ?>
                            <div class="bulk-action out-from-table">
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a onclick="bulkActionOnUser('1', 'activate')" href="#">Activate These Teams</a></li>
                                        <li><a onclick="bulkActionOnUser('0', 'deactivate')" href="#">Deactivate These Teams</a></li>
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
                                                <input id="checkboxSelect" type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;">
                                                <span class="input-checkbox-icon" style="left:4px;"></span>
                                            </label>
                                        </th>
    									<th nowrap="nowrap" class="no_sorting">Actions</th>
    									<th nowrap="nowrap">Team Name</th>
    									<th nowrap="nowrap">Members</th>
                                       
    									<th nowrap="nowrap">Status</th>
    									<th nowrap="nowrap">Created On</th>
                                        <!-- <th nowrap="nowrap">Created By</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($teams_list as $key => $user) 
                                    {
                                        $uid = $user["id"];
                                        ?>
                                        <tr>
                                            <td nowrap="nowrap">
                                                <label style="cursor:pointer;">
                                                    <input type="checkbox" value="<?php echo $uid; ?>" id="<?php echo $uid; ?>" style="position:absolute; opacity:0;">
                                                    <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                                                </label>
											</td>
                                            <td nowrap="nowrap">
												<a class="list_link" href="<?php echo base_url() ?>index.php/TeamManagement/edit?id=<?php echo $uid ?>">Edit</a>		
                                                |
                                                <a class="list_link" href="<?php echo base_url() ?>index.php/TeamManagement/delete?id=<?php echo $uid ?>" onclick="return confirm('Are you sure to delete permanently?')">Delete</a>
                                                
                                            </td>
                                            <td nowrap="nowrap"><?php echo $user["name"]; ?></td>
                                            <td nowrap="nowrap">
												
												<?php //echo $user["members"]; ?>
												<ul>
												<?php if(!empty($users_list)){
													foreach($users_list as $u){																								
												
													if(is_array(json_decode($user["members"])) && in_array($u['id'],json_decode($user["members"])))
													{  
															 ?>
												<li>																							
													<?php 
														echo $u['first_name'].' '.$u['last_name'].' ('.$u['email'].')'; 
												?>
													
												</li>				
												<?php		
													}   } } ?>
											    </ul>
											</td>
                                           
                                            <td nowrap="nowrap"><?php echo $user["status"]==1? 'Active' : 'Inactive'; ?></td>
                                            
                                            <td nowrap="nowrap"><?php echo date("m/d/Y, g:i a", strtotime($user["created_time"])); ?></td>

                                            <!-- <td nowrap="nowrap"><?php echo $user["created_by"]; ?></td>   -->
                                             
                                        </tr> 
                                    <?php } ?>
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
        var url = "<?php echo base_url() ?>index.php/TeamManagement/?us=" + us;
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
        var url = '<?php echo base_url() ?>index.php/TeamManagement/?ac=' + action + '&uid=' + uid;
        if (confirm("Are you sure that you want to " + actionText + " " + uname + "?")) {
            window.location.href = url;
        }
    }

    function bulkActionOnUser(action, actionText)
    {
        var uids = '';
        $("input:checkbox:checked").each(function()
        {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
        });

        if (uids == ''){
            alert("No item has been selected. Please select an item first.");
            return;
        }

        var url = '<?php echo base_url() ?>index.php/TeamManagement/?bulk=on&ac=' + action + '&uid=' + uids;
        if (confirm("Are you sure that you want to " + actionText + " these selected items?")) {
            window.location.href = url;
        }
    }

    $(document).ready(function() {
        $('#dynamic-table').dataTable( {
            "aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
        } );
    } );
</script>
