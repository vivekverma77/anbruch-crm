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

	#ui-datepicker-div {
		background: #f5f5f5;
    	border-radius: 0;
    	padding: 9px;
    	box-shadow: 0 2px 2px rgba(0,0,0,0.05), 0 1px 0 rgba(0,0,0,0.05);
	}
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
</style>

<section id="main-content">
    <section class="wrapper" style="width: auto; min-width: 100%;">

        <div class="row">
            <div class="col-sm-12">
            	<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Attendance </span></h3>
                <section class="panel">
                    <header class="panel-heading">
                        <label for="us">Showing of </label>
                       	<?php 
												if ($superAdmin == true || $_SESSION['role_id'] == 7) 
												{  
												?>
													<select id="own" onchange="newList()" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
															<?php foreach ($users_list as $option_key => $option) { ?>
																	<option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
															<?php } ?>
													</select>
													<script type="text/javascript">
														$(document).ready(function() {
																$("#own").select2();
														});
													</script>
												<?php 
												} 
												else 
												{
													echo "<input type='hidden' id='own' value='".$own."'>";
													echo $username; 
												} 
												?>
												<label for="startDate" style="margin:0 10px;">for Date </label>
												<input name="startDate" id="startDate" class="date-picker" value="<?php echo $startDate; ?>" style="padding:6px; border-radius:4px; border:1px solid #e2e2e4;">

                      <div style="float: right;margin-right:0px;position:relative;">
                        <a class="module_head check_in" href="javascript:;" style="margin-right:10px;">Check In</a>
                        <a class="module_head check_out" href="javascript:;">Check Out</a>
                      </div>	
												
                    </header>
                    <div class="panel-body">
											
												<?php $this->load->view('common/alert'); ?>

                        <div id="adv-table" class="adv-table">
									<?php 
									if ($superAdmin == true) 
									{  
									?>
                        	<div class="bulk-action no-position" style="padding:15px;">
								<div class="btn-group">
										<button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu">
												<li><a onclick="bulkActionOnUser('update')" href="javascript:;">Bulk Update</a></li>
												<li><a onclick="bulkActionOnUser('delete')" href="javascript:;">Bulk Delete</a></li>
										</ul>
								</div>
							</div>
								<?php 
								}  
								?>

								<form id="record_list_table" style="margin-top: 10px;">
									<table class="display table new-table table-striped table-condensed" id="dynamic-tableNIU">
										<thead>
										<tr>																	
											<?php 
											if ($superAdmin == true || $_SESSION['role_id'] == 7) 
											{  
											?>
											<th nowrap="nowrap">
												<label style="cursor:pointer;">
													<input id="checkboxSelect" type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;">
													<span class="input-checkbox-icon" style="left:4px;"></span>
												</label>
											</th>
											<th nowrap="nowrap">Actions</th>
											<?php 
											}  
											?>
											<th nowrap="nowrap">Date</th>
											<th nowrap="nowrap">Check In</th>
											<th nowrap="nowrap">Check Out</th>
											<th nowrap="nowrap">Total Time</th>
											<!-- <th>Over Time</th-->
											<!-- <th>Status</th-->
												
										</tr>
										</thead>
										<tbody>
										<?php
										if(!empty($attendance))
										{
											foreach ($attendance as $key => $val)
											{																	
										?>
												<tr>																		
													<?php 
													if ($superAdmin == true || $_SESSION['role_id'] == 7) 
													{  
													?>
													<td nowrap="nowrap">
														<label style="cursor:pointer;">
															<input type="checkbox" value="<?php echo $val['id']; ?>" id="<?php echo $val['id']; ?>" style="position:absolute; opacity:0;">
															<span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
														</label>
													</td>
													<td nowrap="nowrap"><a href="javascript:;" class="edit_attendance" data-id="<?php echo $val['id']; ?>">Edit</a> | <a href="javascript:;" class="delete_attendance" data-id="<?php echo $val['id']; ?>">Delete</a></td>
													<?php 
													}  
													?>
													<td nowrap="nowrap" class="adate<?php echo $val['id']; ?>"><?php echo date("m/d/Y", strtotime($val["date"])); ?></td>
													<td nowrap="nowrap" class="acheckin<?php echo $val['id']; ?>"><?php echo $val["check_in"]; ?></td>
													<td nowrap="nowrap" class="acheckout<?php echo $val['id']; ?>"><?php echo $val["check_out"]; ?></td>
													<td nowrap="nowrap"><?php echo $val["total_time"]; ?></td>
													
												</tr>
										<?php
											}
										}
										else
										{
										?>
											<tr>
												<td colspan="6">
													No record found!						
												</td>
											</tr>		
										<?php 				
										}
										?>
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
						alert(res);
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
		var url = "<?php echo base_url() ?>member/attendance/?own="+us+"&date="+startDate;
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

	function bulkActionOnUser(action)
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
