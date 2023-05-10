<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<!--<script src="<?php /*echo base_url() */?>static/js/dynamic_table_init.js"></script>-->

<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>
<style>
	.ui-datepicker-calendar {
    display: none;
	}
	.ui-datepicker-header {
		background: #1FB5AD;
	}

	#ui-datepicker-div {background:#f5f5f5; border-radius:0; padding:9px; box-shadow:0 2px 2px rgba(0,0,0,0.05), 0 1px 0 rgba(0,0,0,0.05);}
	.ui-datepicker-header {border:0; background:none;}
	.ui-datepicker-header select {height: 32px !important; border:1px solid #1fb5ad; margin-left:-1px !important;}
	.ui-datepicker-header .ui-corner-all {background:#1fb5ad; border:0 !important; top:4px; cursor:pointer; padding:16px;}
	.ui-datepicker-header .ui-corner-all:hover {opacity:.85}
	.ui-datepicker-header .ui-datepicker-prev {left:0px;}
	.ui-state-hover .ui-icon, .ui-state-focus .ui-icon {background:url(/static/js/jquery-ui/images/ui-icons_ffffff_256x240.png); background-position:-80px -192px;}
	.ui-icon-circle-triangle-e {background-position:-48px -192px !important;}
	.ui-datepicker-header .ui-datepicker-next {right:-2px;}
	.ui-datepicker-current {background:#e5e5e5 !important; color:#000 !important; border-color:#666 !important;}
	.ui-datepicker-current:hover {background:#d5d5d5 !important;}
	.panel-heading input {padding:6px; border-radius:4px; border:1px solid #e2e2e4;}
</style>

<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title"> Payroll </span></h3>
					<section class="panel">
						<header class="panel-heading">
							<label for="us">Showing</label>
							<input name="startDate" id="startDate" class="date-picker" value="<?php echo $startDate; ?>">
							<select id="us" onchange="usersList()" name="rStat" class="populate" style="margin-left: 5px;">
	                            <option <?php echo ($userStatus == 1) ? 'selected="selected"' : ""; ?> value="1">Active</option>
	                            <option <?php echo ($userStatus == 0) ? 'selected="selected"' : ""; ?> value="0">Inactive</option>
	                         </select>
	                        <label for="own" style="margin-left:5px;"> Users</label> 
						</header>
							<div class="panel-body">
							<?php $this->load->view('common/alert'); ?>
					       <div class="adv-table">
					       	<?php if($_SESSION['role_id'] == 1 ){ ?>
                            <div class="bulk-action out-from-table">
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                    	<?php $userStatus = 1;
                                    	  $userStatus = $this->input->get('us');
                                    	?>
                                        <li class="<?php echo $userStatus == 1 ? 'li-disabled':'li-enabled';?>"><a onclick="bulkActionOnUser('1', 'activate')" href="javascript:">Activate These Users</a></li>
                                        <li class="<?php echo $userStatus == 0 ? 'li-disabled':'li-enabled';?>"><a onclick="bulkActionOnUser('0', 'deactivate')" href="javascript:">Deactivate These Users</a></li>
                                    </ul> 
                                </div>
                            </div>
                        	<?php } ?>
                            <form id="record_list_table">
                                <table class="display table new-table table-striped table-condensed" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <th nowrap="nowrap">
											<label style="cursor:pointer;">
												<input id="checkboxSelect" type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;">
												<span class="input-checkbox-icon" style="left:4px;"></span>
											</label>
                                        </th>
                                        <!--th nowrap="nowrap">Actions</th-->
                                        <th nowrap="nowrap">Name</th>
                                        <th nowrap="nowrap">Email</th>
                                        <!-- <th nowrap="nowrap">Role</th> -->
                                        <th nowrap="nowrap">Salary</th>
                                        <th nowrap="nowrap">Working Days</th>
                                        <th nowrap="nowrap">Final Pay</th>
                                        
                                        <!--th nowrap="nowrap">User Created On</th>
                                        <th nowrap="nowrap">Last Logged In</th-->
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
                                            
                                            <!--td nowrap="nowrap">
													<a class="list_link" href="<?php echo base_url() ?>index.php/UserManagement/editUser?id=<?php echo $uid ?>">Edit</a> |
																								
													<?php if ($userStatus == 0) { ?>
                                                <a class="list_link" onclick="actionOnUser('<?php echo $uid ?>', '<?php echo $user["email"]; ?>', '1', 'activate');" href="#">Activate</a> |
                                                <?php } ?>
                                                
                                                <a class="list_link" onclick="actionOnUser('<?php echo $uid ?>', '<?php echo $user["email"]; ?>', '-1', 'reset the password of');" href="#">Password Reset</a>
                                                
                                                <?php if ($userStatus == 1) { ?>
                                                |
                                                <a class="list_link" onclick="actionOnUser('<?php echo $uid ?>', '<?php echo $user["email"]; ?>', '0', 'deactivate');" href="#">Deactivate</a>
                                                <?php } ?>
                                                                                                
                                                |
                                                <a class="list_link" href="<?php echo base_url() ?>index.php/UserManagement/deleteUser?id=<?php echo $uid ?>" onclick="return confirm('Are you sure to delete user permanently?')">Delete</a>
                                                
                                            </td-->
                                            <td nowrap="nowrap"><?php echo $user["first_name"]." ".$user["last_name"]; ?></td>
                                            <td nowrap="nowrap"><?php echo $user["email"]; ?></td>
<!--
                                            <td nowrap="nowrap"><?php echo $user["role"]; ?></td>
-->
                                            <td nowrap="nowrap"><?php echo $user["salary"]; ?></td>
                                            <td nowrap="nowrap"><?php echo $working_days; ?></td>
                                            <td nowrap="nowrap"><?php
																						$per_day_salary = $user["salary"]/$days_in_month;
                                            $final_ctc = $working_days*$per_day_salary;
																						echo number_format($final_ctc,2);
                                            ?></td>
                                            
                                            <!--td><?php echo date("F j, Y, g:i a", $user["created_time"]); ?></td>
                                            <td nowrap="nowrap"><?php echo ($user["last_logged_in"] != '') ? date("F j, Y, g:i a", $user["last_logged_in"]) : "User has not logged in yet"; ?></td-->
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

<div id="updateAttendance" class="modal fade" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header background-green">
				
				<div class="row">
					<div class="col-sm-10 col-xs-12">
						<h4 id="modalTitle" class="modal-title" style="color: #000;">Attendance - <span class="sel_date"></span></h4>
					</div>
				
					<div class="col-sm-2 col-xs-12">
						<a href="javascript:void(0)" data-dismiss="modal" class="" title="Close modal" style="float:right;font-size: 19px;margin-right: 10px;color:#333"><i class="fas fa-window-close"></i></a>
					</div>
				</div>
				
				
			</div>
			<div id="modalBody" class="modal-body service-box">
			<form id='frmAttendance'>
			
				<input type="hidden" name="attendance_id"  id="attendance_id">
			
				<div class="row">					
					<div class="col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="textfield">Check In Time</label>
							<div class="controls">
								<input class="input-xlarge form-control " name="checkin" id="checkin" type="text" autocomplete="on" value="09:30:00">
							</div> 							
						</div>
					</div>		
					<div class="col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="textfield">Check Out Time</label>
							<div class="controls">
								<input class="input-xlarge form-control " name="checkout" id="checkout" type="text" autocomplete="on" value="18:30:00">
							</div> 							
						</div>
					</div>		
					
				</div>

			</form>	
			</div>
			
			<div class="modal-footer">				
	
				<button type="button" class="btn btn-success atten_submit" ><i class="far fa-edit"></i> Update</button>

				<button type="button" class="btn btn-normal" data-dismiss="modal" title="Close modal"><i class="fa fa-times"></i> Close</button>			
				
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	$(function()
	{
    $('.date-picker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
          $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
          newList();
        }
    });
	});

	$(function()
	{
		$(".edit_attendance").click(function()
		{
			var id = $(this).attr("data-id");
			var date = $(".adate"+id).html();
			var checkin = $(".acheckin"+id).html();
			var checkout = $(".acheckout"+id).html();

			$("#attendance_id").val(id);
			$(".sel_date").html(date);
			$("#checkin").val(checkin);
			$("#checkout").val(checkout);
			
			$("#updateAttendance").modal('show');
			
		});

		$(".delete_attendance").click(function()
		{
			if (!confirm("Are you sure to delete attendance?") ) {
				return false;	
			}			
			var id = $(this).attr("data-id");
			$.ajax({
				type:"POST",
				url: "<?php echo base_url() ?>member/deleteAttendance",
				data: { "attendance_id": id },
				success: function (res)
				{
					if(res=="login_required")
					{
						var url = "<?php echo base_url() ?>member/login";
						window.location.href = url;
					}
					else
					{
						alert(res);
						window.location.reload();
					}
				},
			});
			
		});

		$(".atten_submit").click(function()
		{
			if (!confirm("Are you sure to update attendance?") ) {
				return false;	
			}

			var frmdata = $("#frmAttendance").serialize();
    	
			$.ajax({
				type:"POST",
				url: "<?php echo base_url() ?>member/updateAttendance",
				data: frmdata,
				success: function (res)
				{
					if(res=="login_required")
					{
						var url = "<?php echo base_url() ?>member/login";
						window.location.href = url;
					}
					else
					{
						alert(res);
						window.location.reload();
					}
				},
			});
		});
			
		$(".check_in").click(function()
		{
			if (!confirm("Are you sure to Check In for the day?") ) {
				return false;	
			}
    		
			$.ajax({
				type:"POST",
				url: "<?php echo base_url() ?>member/checkIn",
				success: function (res)
				{
					if(res=="login_required")
					{
						var url = "<?php echo base_url() ?>member/login";
						window.location.href = url;
					}
					else
					{
						alert(res);
						window.location.reload();
					}
				},
			});
		});

		$( ".check_out" ).click( function()
		{		
			if ( !confirm("Are you sure to Check Out for the day?") )
			{
				return false;	
			}		
		
			$.ajax({
				type:"POST",
				url: "<?php echo base_url() ?>member/checkOut",
				success: function (res)
				{			    
					if(res=="login_required")
					{
						var url = "<?php echo base_url() ?>member/login";
						window.location.href = url;
					}
					else
					{						
						window.location.reload();
					}			
				},
			});
		});
			
	});
   	
	var checkAll = false;
	
	function newList()
	{
		var us = $("#own").val();
		var startDate = $("#startDate").val();
		var url = "<?php echo base_url() ?>member/payroll/?own="+us+"&date="+startDate;
		window.location.href = url;
	}
	function usersList(){
        var us = $("#us").val();
        var url = "<?php echo base_url() ?>index.php/member/payroll/?us=" + us;
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
			var url = '<?php echo base_url() ?>UserManagement/?ac=' + action + '&uid=' + uid;
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

		if (uids == '')
		{
			alert("No user has been selected. Please select an user first.");
			return;
		}

		if(action=='update')
		{

			$("#attendance_id").val(uids);

			$("#updateAttendance").modal('show');
			
		}
		else if(action=='delete')
		{
			if(confirm("Are you sure that you want to delete these selected attendance?"))
			{
				var id = uids;
				$.ajax({
					type:"POST",
					url: "<?php echo base_url() ?>member/deleteAttendance",
					data: { "attendance_id": id },
					success: function (res)
					{
						if(res=="login_required")
						{
							var url = "<?php echo base_url() ?>member/login";
							window.location.href = url;
						}
						else
						{
							alert(res);
							window.location.reload();
						}
					},
				});
			}	
		}else if(actionText == 'activate' || actionText == 'deactivate')
		{
			if(confirm("Are you sure that you want to " + actionText + " this users ?"))
			{
				var id = uids;
				$.ajax({
					type:"POST",
					url: "<?php echo base_url() ?>member/usersDeactivate",
					data: { "user_ids": id ,"action":action, "actionText":actionText+'d' },
					dataType:"json",
					success: function (res)
					{
						window.location.reload();
					},
					error:function()
					{
						window.location.reload();
					}
				});
			}
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
