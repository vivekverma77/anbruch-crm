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
    #dynamic-table_wrapper {height:auto !important; overflow-y:auto !important; overflow-x:auto !important;}
</style>

<section id="main-content">
    <section class="wrapper" style="width: auto; min-width: 100%;">

        <div class="row">
            <div class="col-sm-12">

                <h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">  User Management </span></h3>

                <section class="panel">
                    <header class="panel-heading">
                        <label for="us">Showing </label>
                        <select id="us" onchange="newList()" name="rStat" class="populate" style="max-width: 25%;margin-top: -2px;margin-left: 5px;min-width: 80px;">
                            <option <?php echo ($userStatus == 1) ? 'selected="selected"' : ""; ?> value="1">Active</option>
                            <option <?php echo ($userStatus == 0) ? 'selected="selected"' : ""; ?> value="0">Inactive</option>
                        </select>
                        <label for="own" style="margin-left:5px;"> Users</label>
                        <a class="module_head pull-right" href="<?php echo base_url() ?>UserManagement/addUser/">Add User</a>
                    </header>
                    <div class="panel-body">
											
                        <div class="alert-box"><?php $this->load->view('common/alert'); ?></div>
                        
                        <div class="adv-table">
                            <?php if($_SESSION['role_id'] == 1){ ?>
                            <div class="bulk-action out-from-table">
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a onclick="bulkActionOnUser('1', 'activate')" href="#">Activate These Users</a></li>
                                        <li><a onclick="bulkActionOnUser('0', 'deactivate')" href="#">Deactivate These Users</a></li>
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
                                        <th nowrap="nowrap">Email</th>
                                        <th nowrap="nowrap">Role</th>
                                        <th nowrap="nowrap">First Name</th>
                                        <th nowrap="nowrap">Last Name</th>
                                        <th nowrap="nowrap">User Created On</th>
                                        <th nowrap="nowrap">Last Logged In</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($users_list as $key => $user) {
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
												<a class="list_link" href="<?php echo base_url() ?>UserManagement/editUser?id=<?php echo $uid ?>">Edit</a> |
																								
												<?php if ($userStatus == 0) { ?>
                                                <a class="list_link" onclick="actionOnUser('<?php echo $uid ?>', '<?php echo $user["email"]; ?>', '1', 'activate');" href="#">Activate</a> |
                                                <?php } ?>
                                                
                                                <a class="list_link" onclick="actionOnUser('<?php echo $uid ?>', '<?php echo $user["email"]; ?>', '-1', 'reset the password of');" href="#">Password Reset</a>
                                                
                                                <?php if ($userStatus == 1) { ?>
                                                |
                                                <a class="list_link" onclick="actionOnUser('<?php echo $uid ?>', '<?php echo $user["email"]; ?>', '0', 'deactivate');" href="#">Deactivate</a>
                                                <?php } ?>
                                                                                                
                                                |
                                                <a class="list_link" href="<?php echo base_url() ?>UserManagement/deleteUser?id=<?php echo $uid ?>" onclick="return confirm('Are you sure to delete user permanently?')">Delete</a>
                                                
                                            </td>
                                            <td nowrap="nowrap"><?php echo $user["email"]; ?></td>
                                            <td nowrap="nowrap"><?php echo $user["role"]; ?></td>
                                            <td nowrap="nowrap"><?php echo $user["first_name"]; ?></td>
                                            <td nowrap="nowrap"><?php echo $user["last_name"]; ?></td>
                                            <td nowrap="nowrap"><?php echo date("m/d/Y g:i a", $user["created_time"]); ?></td>
                                            <td nowrap="nowrap"><?php echo ($user["last_logged_in"] != '') ? date("m/d/Y g:i a", $user["last_logged_in"]) : "User has not logged in yet"; ?></td>
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
						"pageLength": 25,
            "aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
        } );
    } );
</script>
