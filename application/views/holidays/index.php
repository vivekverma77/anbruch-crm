<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script> 
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>

<section id="main-content">
    <section class="wrapper" style="width: auto; min-width: 100%;">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="page-title" style="float:left; margin:0; color:#767676; position:relative; top:5px;text-transform: none;">Holidays List</h3>
                        <div style="float: right;">
                            <a class="module_head" href="<?php echo base_url() ?>holidays/addRecord/">Add New Holiday</a>
                        </div>
                    </header>
                    <div class="panel-body">
						<?php if ($this->session->flashdata('success')){  ?>
							<div class="alert alert-success alert-block fade in">
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
							<div class="alert alert-danger alert-block fade in">
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
                        <div class="alert alert-<?php echo $key ?> alert-block fade in">
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
                            <?php if ($superAdmin == true) { ?>
                                <div class="bulk-action out-from-table">
                                    <div class="btn-group">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <!-- <li><a href="#">Mass Owner Update</a></li> -->
                                            <li><a href="javascript:;" id="mass_delete">Mass Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                            <form id="record_list_table">
                                <table class="display table new-table table-striped table-condensed" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <?php if ($superAdmin == true) { ?>
                                        <th class="no_sorting">
                                            <label style="cursor:pointer; margin-bottom:0;">
                                                <input type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;">
                                                <span class="input-checkbox-icon"></span>
                                            </label>
                                        </th>
                                        <?php } ?>
                                        <th class="no_sorting">Actions</th>
                                        <th>Holiday</th>
                                        <th>Date</th>
                                        <th>Created By</th>
                                        <th>Created Time</th>
<!--
                                        <th>Modified Time</th>
-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($record_data)) {
                                    foreach ($record_data as $record) {
                                        $createdBy = $record['first_name'] . " " . $record['last_name'];
                                        $createdTime = date("m/d/Y", strtotime($record['created_time']));
                                        $modifiedTime = ($record['modified_time'] == '') ? "Not Modified Yet" : date("m/d/Y", strtotime($record['modified_time']));
                                        ?>
                                        <tr>
                                            <?php if ($superAdmin == true) { ?>
                                              <td>
                                                <label style="cursor:pointer;">
                                                    <input type="checkbox" value="<?php echo $record['id']; ?>" id="<?php echo $record['id']; ?>" style="position:absolute; opacity:0;">
                                                    <span class="input-checkbox-icon"></span>
                                                </label>
                                              </td>
                                            <?php } ?>
                                            <td>
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>holidays/editRecord/<?php echo $record['id']; ?>">Edit</a>
																									|
                                                <a class="list_link" 
                                                   href="<?php echo base_url() ?>holidays/deleteRecord/<?php echo $record['id']; ?>" onclick="return confirm('Are You sure to delete?');">Delete</a>
                                            </td>
                                            <td><?php echo ucwords($record["holiday"]); ?></td>
                                            <td><?php echo date("l, d-F-Y", strtotime($record["date"])); ?></td>
                                            <td><?php echo $createdBy ?></td>
                                            <td><?php echo $createdTime ?></td>
<!--
                                            <td><?php if($modifiedTime > $createdTime){ echo $modifiedTime; } ?></td>
-->
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
        var own = $("#own").val();
        var url = "<?php echo base_url() ?>index.php/activities/?&own=" + own;
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
								url:  '<?php echo base_url()."index.php/holidays/deleteMassRecord"; ?>',
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
