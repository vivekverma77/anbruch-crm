<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>
<?php
if (strpos($_SERVER['SERVER_NAME'], "localhost") === false)
{
	$links = "static/select2/dist/css/select2.min.css";
	$links .= ",static/js/data-tables/DT_bootstrap.css";

	$js = "static/select2/dist/js/select2.min.js";
	$js .= ",static/js/advanced-datatable/js/jquery.dataTables.js";
	$js .= ",static/js/data-tables/DT_bootstrap.js";
	?>
	<!--
	<link rel="stylesheet" href="<?php /*echo base_url() */?>min/?f=<?php /*echo $links; */?>&124"/>
	<script type="text/javascript" src="<?php /*echo base_url() */?>min/?f=<?php /*echo $js; */?>&124"></script>

	//Current version 124
	-->
	<link rel="stylesheet" href="<?php echo base_url() ?>static/minified_master/mVersion124.css"/>
	<script type="text/javascript" src="<?php echo base_url() ?>static/minified_master/mVersion124.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>static/js/tableHeadFixer.js"></script>

<?php
}
else
{
?>

	<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
	<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>
	<!--dynamic table-->
	<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
	<!--dynamic table-->
	<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>static/js/tableHeadFixer.js"></script>

<?php
}
?>

<style type="text/css">
	.adv-table .dataTables_filter label input{
			margin-left: 0 !important;
			float: none !important;
			width: 90%;
	}

	#dynamic-table_filter{
			padding: 0 !important;
			width: 100% !important;
	}

	#dynamic-table_wrapper .span6{
			display: inline-block !important;
			width: 50% !important;
			padding: 15px 0 !important;
	}

	.adv-table .dataTables_filter label input{
			width: 55% !important;
	}
	#dynamic-table td{white-space: nowrap;}

	#dynamic_content>div {
    height: auto !important;
    overflow-y: auto !important;
    overflow-x: auto !important;
	}
	.select2-search--dropdown {border-top:1px solid #aaa; margin-top:-1px;}

	@media (max-width: 1099px)
	{
		header.panel-heading >div {margin-top: 10px;float: unset !important;}
		#add_calendar,.panel .panel-heading .module_head{margin-top: 10px;}

	}
	.select2-selection{
		margin-left: 5px !important;
		/*width: 190px;*/
	}
	.select2-container {
		width:254px !important;
	}
	.select2-container--open .select2-dropdown--below{
		margin-left: 5px !important;
		width: 249px !important;
	}
	/*.select2-container--default .select2-selection--single .select2-selection__arrow{
		margin-right: -60px !important;
	}*/
	.select2-container--default .select2-selection--single .select2-selection__rendered{
		padding-left: 11px;
		padding-top: 3px;
	}
	.records_of{
		margin-left: 10px;
	}
	#modalOwnerUpdate .modal-header { background: #1eb5ad; color:white; }
	#modalOwnerUpdate .close { color: white; opacity:1; }
	#modalOwnerUpdate .modal-title , #modalOwnerUpdate label { font-weight:550; }
	.list_link_clients:hover{
		color:#1FB5AD !important;
	}
	.list_link_contracts:hover{
		color:#1FB5AD !important;	
	}
	.search-by-name{
		width: 350px;
	}
	#keyword{
		font-weight: 400 !important;
	}
	#dynamic_content table tr {cursor: pointer;}
	a.alphabet-links { padding: 5px 6px;font-size: 15px;color:#1fb5ad;font-weight: 700; }
	a.alphabet-links:hover { color: #767676; border-radius: 50%;background: #1fb5ad38; }
	.dtnotes:not(:first-child){
		    padding-left: 78px;
	}
</style>

<section id="main-content">

	<section class="wrapper" style="width: auto; min-width: 100%;">

		<div class="row">

			<div class="col-sm-12">

                <h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title"><?php echo $current_module; ?></span> </h3>

				<section class="panel">

					<header class="panel-heading">

						<label for="rStat">Showing </label>

						<select id="rStat" onchange="newList()" name="rStat" class="populate" style="max-width: 25%;margin-top: -2px;margin-left: 5px;min-width: 80px;">
							<option <?php echo ($recordStatus == 1) ? 'selected="selected"' : ""; ?> value="1">Archived</option>
							<option <?php echo ($recordStatus == 3) ? 'selected="selected"' : ""; ?> value="3">Active</option>
							<?php
							if ($current_module == "Leads")
							{
							?>
							<option <?php echo ($recordStatus == 4) ? 'selected="selected"' : ""; ?> value="4">Converted</option>
							<?php
							}
							?>
						</select>
						<div class="records_of" style="display:inline-block;">
						<label for="own" > Records of </label>

						<?php
					if ($current_module == "Leads")
					{
						//if ($superAdmin == true || $_SESSION['role_id'] == 7 || $_SESSION['role_id'] == 3 || $_SESSION['role_id'] == 8){
						?>
							<select id="own" onchange="newList()" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
									<option value="">All</option>
									<?php foreach ($users_list as $option_key => $option) { 

										//if($_SESSION['role_id'] == 3 || $_SESSION['role_id'] == 8){
											
										//  if($option['role_id'] == 3 || $option['role_id'] == 8){ ?>
												<!-- <option value="<?php //echo $option['id']; ?>"><?php //echo $option['title']; ?></option> -->
									  <?php 
									  	     /* }
											    continue;
										     } */
										 ?>
											 <option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option> 
									<?php } ?>
							</select>
							<script type="text/javascript">
								$("#own").select2();
							</script>
						<?php
						/*}
						else
						{
							echo $username;
						}*/
					}else
					{
						//if ($superAdmin == true || $_SESSION['role_id'] == 7)
						//{
						?>
							<select id="own" onchange="newList()" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
									<option value="">All</option>
									<?php foreach ($users_list as $option_key => $option) { 
										?>
											<option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
										
									<?php } ?>
							</select>
							<script type="text/javascript">
								$("#own").select2();
							</script>
						<?php
						/*}
						else
						{
							echo $username;
						}	*/
					}
						?>
						</div>
						<div style="float: right; position:relative;" class="add_n_search">

							<?php
							if ($writePermission == true)
							{
							?>
								<a class="module_head add_new_record" href="<?php echo base_url() ?>modules/addRecord/?cm=<?php echo $current_module; ?>&ac=new"><span class="desktop_btn">Add New Record</span><span class="mobile_btn hidden"><i class="fa fa-plus" aria-hidden="true"></i></span></a>
							<?php
							}
							?>

							<!--<a class="module_head" href="<?php echo base_url() ?>modules/advanceSearch/?cm=<?php echo $current_module; ?>&ac=advanceSearch">Advanced Search</a>-->

							<a class="module_head advance_search" href="javascript:void(0)" onclick="javascript: $('#search_blk').fadeIn();"><span class="desktop_btn">Advanced Search</span><span class="mobile_btn hidden"><i class="fa fa-search" aria-hidden="true"></i></span></a>

							<div id="search_blk" style="display:none;position:absolute;z-index:100;background:#FFFFFF;width:1000px;height:auto; margin-top:10px; background:#f2f4f8;border:1px solid #DDDDDD;right:0px;padding:10px; -webkit-box-shadow: 0 2px 6px rgba(0,0,0,0.1); box-shadow:0 2px 6px rgba(0,0,0,0.1);">

								<form name="frmSearch" id="frmSearch" method="get">
									<input type="hidden" name="cm" value="<?php echo $current_module; ?>" />
									<input type="hidden" name="own" value="<?=$own?>" />
									<input type="hidden" name="rStat" value="<?=$recordStatus?>" />

									<h4 style="color:#1fb5ad;margin:0px;font-weight:bold;margin-bottom:10px;">Advanced Search</h2>

									<?php
									$query_string = '';
									foreach($search_filters as $k => $filter_name)
									{
										$id = str_replace(' ', '_', strtolower(preg_replace("/[^A-Za-z0-9 ]/", '_', trim($filter_name))));
										if(${$id})
											$query_string.= ($query_string == '')? ($id.'='.${$id}):('&'.($id.'='.${$id}));
										?>
											<div class="col-lg-3" style="margin-bottom:3px;"><input type="text" placeholder="<?php echo $filter_name;?>" name="<?php echo $id;?>" class="form-control" id="<?php echo $id;?>" value="<?php echo ${$id};?>" /></div>
									<?php
									}
									?>
									<div style="clear:both;"></div>
									<p align="center" style="margin-top:12px;">
										<input type="submit" value="Apply Filters" class="btn btn-success btn-md" style="color:#fff !important;" />
										<input type="button" value="Reset" class="btn btn-success btn-md" style="color:#fff !important;" onclick="javascript: newList()" />
										<input type="button" value="Close" class="btn btn-success btn-md" style="color:#fff !important;" onclick="javascript:$('#search_blk').fadeOut()" />
									</p>
								</form>

							</div>

						</div>

					</header>

					<div class="panel-body">

						<?php $this->load->view('common/alert'); ?>

						<!-- Modal -->
						<div class="modal fade" id="modalOwnerUpdate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
									<div class="modal-content">
											<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Select new record owner</h4>
											</div>
											<div class="modal-body">
													<div class="form-group col-lg-6" style="min-height: 57px !important;">
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
													<button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change owner of');" type="button">Confirm</button>
											</div>
									</div>
							</div>
						</div>
						<!-- modal -->

						<div class="adv-table">

							<?php
							extract($page_details);

							if(count($record_data) >= 0)
							{
							?>
							<div class="row" style="margin-top:20px; padding:0 15px;">

								<div class="col-lg-4">

									<select name="num_records_per_page" id="num_records_per_page" size="1" onchange="self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&num_records_per_page='+this.value">
										<option value="25"<?=($records_per_page == 25)?' selected="selected"':''?>>25</option>
										<option value="50"<?=($records_per_page == 50)?' selected="selected"':''?>>50</option>
										<option value="100"<?=($records_per_page == 100)?' selected="selected"':''?>>100</option>
										<option value="200"<?=($records_per_page == 200)?' selected="selected"':''?>>200</option>
									</select>

									<span>Records per Page</span>

									<?php
									if ($superAdmin == true || $this->session->userdata('role_id') == 1)
									{
									?>

										<div class="bulk-action modules">
										  <div class="btn-group">
											<button class="btn dropdown-toggle bulk_action" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i></button>
											<ul class="dropdown-menu">
											  <!--<li><a href="#">Mass Field Update</a></li>-->
											  <li><a class="module_head" data-toggle="modal" href="#modalOwnerUpdate">Mass Owner 	Update</a></li>
											  <li><a class="module_head mass_delete" href="javascript:;">Mass Delete</a></li>
											</ul>
										  </div>
										</div>

									<?php
									} ?>

								</div>



								<div class="col-lg-8" style="text-align:right;">
									
									<input type="text" name="keyword" id="keyword" value="<?php echo $keyword?>" placeholder="Enter Keyword" onkeyup="javascript: self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&id=1&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&num_records_per_page='+$('#num_records_per_page').val()+'&keyword='+$('#keyword').val()" />
									
									<input type="button" class="btn btn-primary dropdown-toggle btn-sm keyword_search" value="Search" style="margin-top:-4px;" onclick="javascript: self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&id=1&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&num_records_per_page='+$('#num_records_per_page').val()+'&keyword='+$('#keyword').val()" />

									<input type="button" class="btn btn-primary dropdown-toggle btn-sm reset" value="Reset" style="margin-top:-4px;" onclick="javascript: self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1'" />
								</div>
							</div>
							<?php if($current_module == 'Leads'){ ?>
							<div class="row" style="margin-right:0;display:inline-block;padding:10px 0px 0px 25px;">
								<a href="#" class="alphabet-links">A</a>
								<a href="#" class="alphabet-links">B</a>
								<a href="#" class="alphabet-links">C</a>
								<a href="#" class="alphabet-links">D</a>
								<a href="#" class="alphabet-links">E</a>
								<a href="#" class="alphabet-links">F</a>
								<a href="#" class="alphabet-links">G</a>
								<a href="#" class="alphabet-links">H</a>
								<a href="#" class="alphabet-links">I</a>
								<a href="#" class="alphabet-links">J</a>
								<a href="#" class="alphabet-links">K</a>
								<a href="#" class="alphabet-links">L</a>
								<a href="#" class="alphabet-links">M</a>
								<a href="#" class="alphabet-links">N</a>
								<a href="#" class="alphabet-links">O</a>
								<a href="#" class="alphabet-links">P</a>
								<a href="#" class="alphabet-links">Q</a>
								<a href="#" class="alphabet-links">R</a>
								<a href="#" class="alphabet-links">S</a>
								<a href="#" class="alphabet-links">T</a>
								<a href="#" class="alphabet-links">U</a>
								<a href="#" class="alphabet-links">V</a>
								<a href="#" class="alphabet-links">W</a>
								<a href="#" class="alphabet-links">X</a>
								<a href="#" class="alphabet-links">Y</a>
								<a href="#" class="alphabet-links">Z</a>
							</div>
							<?php } ?>
							<form id="record_list_table">

								<div id="dynamic_content" style="margin-top:10px;/*height:500px;*/">
									<table class="display new-table data-table table table-striped table-condensed" id="dynamic-table" style="width: 100% !important;">
										<thead>
											<tr style="font-weight:bold;">
												<?php
												if ($writePermission == true)
												{
												?>
													<td>
														<label style="cursor:pointer;">
															<input type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;" />
															<span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
														</label>
													</td>
												<?php
												}
												?>
												<?php
												foreach ($record_data as $key => $record)
												{
													foreach ($record['meta'] as $metaFieldName => $metaValue)
													{
													?>
													<td nowrap="nowrap">
														<a <?php if($sort_column == $metaFieldName){?>style="color:#007CB2"<?php }?> href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=$cur_page?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$metaFieldName?>&sort_order=<?=($sort_order == 'ASC' && $sort_column == $metaFieldName)?'DESC':'ASC'?>&id=2"><?php echo $metaFieldName ?><?php if($sort_column == $metaFieldName){?> <i class="fa fa-caret-<?=($sort_order == 'ASC')?'down':'up'?>"></i><?php }?></a>
														</td>
													<?php
													}
													break;

												}
												?>
										</tr>
										</thead>
										<tbody>
										<?php
										foreach ($record_data as $key => $record)
										{
										?>
											<tr>
												<?php
												if ($writePermission == true)
												{
												?>
													<td class="center" style="padding-bottom:0">
														<label style="cursor:pointer;">
															<input type="checkbox" value="<?php echo $key; ?>" id="<?php echo $key; ?>" style="position:absolute; opacity:0;" />
															<span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
														</label>
													</td>
												<?php
												}
												?>
												<?php
												//$link = false;
												foreach ($record['meta'] as $metaFieldName => $metaValue)
												{
													$column_value = $metaValue;
													if (is_array($column_value))
													{
														$column_value = '';
														foreach ($metaValue as $singleValueKey => $singleValue)
														{
															$column_value .= ($column_value == '') ? "&lt;$singleValue&gt;" : ", &lt;$singleValue&gt;";
														}
													}
													?>
													<td>
													<?php
														if ($current_module=='Leads' && $metaFieldName == 'Company Name')
														{
															echo '<a class="list_link" href="' . base_url() . 'modules/viewRecord/?cm=' . $current_module  . "&id=$key&record_status=" . $record['static']['record_status'] . '">';
														}

														if ($current_module=='Leads' && $metaFieldName == 'Company Name')
														{
															if ($column_value == '')
															{
																echo "No $metaFieldName available";
															}
															else
															{
																echo $column_value;
															}
														}
														else if ($current_module=='Leads' )
														{
															echo $column_value;
														}

														if ($current_module=='Leads' && $metaFieldName == 'Company Name')
														echo '</a>';

														//if ($current_module=='Leads' && $metaFieldName == 'Company Name')
															//$link = true;
														?>

														<?php
														if ($current_module=='Clients' && $metaFieldName == 'Client Name')
														{
															echo '<a class="list_link_clients" href="' . base_url() . 'modules/viewRecord/?cm=' . $current_module  . "&id=$key&record_status=" . $record['static']['record_status'] . '">';
														}

														if ($current_module=='Clients' && $metaFieldName == 'Client Name')
														{
															if ($column_value == '')
															{
																echo "No $metaFieldName available";
															}
															else
															{
																echo $column_value;
															}
														}
														else if ($current_module=='Clients' )
														{
															echo $column_value;
														}

														if ($current_module=='Clients' && $metaFieldName == 'Client Name')
														echo '</a>';

														?>

														<?php
														if ($current_module=='Contracts' && $metaFieldName == 'Contract Name' || $metaFieldName == 'Contract Client')
														{
															echo '<a class="list_link_contracts" href="' . base_url() . 'modules/viewRecord/?cm=' . $current_module  . "&id=$key&record_status=" . $record['static']['record_status'] . '">';
														}

														if ($current_module=='Contracts' && $metaFieldName == 'Contract Name')
														{
															if ($column_value == '')
															{
																echo "No $metaFieldName available";
															}
															else
															{
																echo $column_value;
															}
														}
														else if ($current_module=='Contracts' )
														{
															echo $column_value;
														}

														if ($current_module=='Contracts' && $metaFieldName == 'Contract Name')
														echo '</a>';

														?>
													</td>

												<?php
												}
												?>

											</tr>

										<?php
										}
										?>
										</tbody>
									</table>
								</div>
								<?php if($current_module == 'Leads'){ ?>
								<div class="row" style="margin-right:0;display:inline-block;padding:10px 0px 0px 25px;">
									<a href="#" class="alphabet-links">A</a>
									<a href="#" class="alphabet-links">B</a>
									<a href="#" class="alphabet-links">C</a>
									<a href="#" class="alphabet-links">D</a>
									<a href="#" class="alphabet-links">E</a>
									<a href="#" class="alphabet-links">F</a>
									<a href="#" class="alphabet-links">G</a>
									<a href="#" class="alphabet-links">H</a>
									<a href="#" class="alphabet-links">I</a>
									<a href="#" class="alphabet-links">J</a>
									<a href="#" class="alphabet-links">K</a>
									<a href="#" class="alphabet-links">L</a>
									<a href="#" class="alphabet-links">M</a>
									<a href="#" class="alphabet-links">N</a>
									<a href="#" class="alphabet-links">O</a>
									<a href="#" class="alphabet-links">P</a>
									<a href="#" class="alphabet-links">Q</a>
									<a href="#" class="alphabet-links">R</a>
									<a href="#" class="alphabet-links">S</a>
									<a href="#" class="alphabet-links">T</a>
									<a href="#" class="alphabet-links">U</a>
									<a href="#" class="alphabet-links">V</a>
									<a href="#" class="alphabet-links">W</a>
									<a href="#" class="alphabet-links">X</a>
									<a href="#" class="alphabet-links">Y</a>
									<a href="#" class="alphabet-links">Z</a>
					
								</div>
								<?php } ?>
								<div class="row" style="padding:15px;">
									<div class="col-xs-12" style="text-align:right">

									<span><?php echo $total_records;?></span> items

										<a class="btn <?php  if($start_record < 1) { ?>disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page-1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>" style="border:1px solid #aaa;">&laquo;</a>

									<?=$cur_page?> of <?=$total_page?>

									<a class="btn <?php  if($total_records <= $end_record) {?> disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page+1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>" style="border:1px solid #aaa;">&raquo;</a>
									</div>
								</div>

							</form>

							<?php
							}
							else
							{
								?>
							<h3 align="center">No Records Found!</h3>
							<?php
							}
							?>

							</div>

					</div>

				</section>

			</div>

		</div>

	</section>

</section>

<script type="text/javascript">

	var SearchInput = $('#keyword');
	var strLength= SearchInput.val().length;
	SearchInput.focus();
	SearchInput[0].setSelectionRange(strLength, strLength);

    var checkAll = false;
    function newList(page){
        var own = $("#own").val();
        var rStat = $("#rStat").val();
        if(!page)
        	page = 1;
        var url = "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1&own=" + own + "&rStat=" + rStat + "&page=" + page;
        window.location.href = url;
    }
	function searchResult()
	{
        var own = $("#own").val();
        var page = $("#page").val();
        var rStat = $("#rStat").val();
        var city = $('#city').val();
        var country = $('#country').val();
        var company = $('#company').val();
        var url = "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=" + own + "&rStat=" + rStat + "&page=" + page+'&city='+city+'&country='+country+'&company='+company;
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

    $('.mass_delete').on('click',function()
    {
			var uids = '';
			$("input:checkbox:checked").each(function() {
					var id = $(this).val();
					uids += (uids == '') ? id : ("," + id);
			});

			if (uids == ''){
					alert("No record has been selected. Please select record first.");
					return;
			}

			if(confirm("Are you sure to delete all selected records?"))
			{
				var action = "mass_delete";
        var url = '<?php echo base_url() ?>Modules/?cm=<?php echo $current_module; ?>&bulk=on&ac=' + action + '&uid=' + uids;

         window.location.href = url;

			}
		});

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

        var newOwner = $("#0").val();
        var url = '<?php echo base_url() ?>Modules/?cm=<?php echo $current_module; ?>&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids;
        if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
            window.location.href = url;
        }
    }

    $(document).ready(function() {

            $("#dynamic-table").tableHeadFixer();

            $("#dynamic-table").DataTable({responsive: true,
    			ordering: false,
   			    paging: false,
    			searching:false,
    			dom: 't',
    			keys: true,
			});

			$(document).on('click', 'a', function(event){
  			
  			if($(this).text() == 'Closer Name'){
  				(event).preventDefault();
  			}
  			//return true;
		});
		$("a").hover(function(){
			if($(this).text() == 'Closer Name'){
  				$(this).css('cursor', 'auto');
  				$(this).css('color', '#32323A');	
  			}	
		});

		$(document).ready(function(){
				if($('.new-table thead tr td:eq(4) .fa').length  || $('.new-table thead tr td:eq(5) .fa').length || $('.new-table thead tr td:eq(1) .fa').length  || $('.new-table thead tr td:eq(2) .fa').length){
						$('.icone').remove();
						//alert('present');
				}else if($('.new-table thead tr td:eq(3) a').text() == 'Contract Name'){
					$('.new-table thead tr td:eq(1)').append('<i style="font-size:12px" class="fa icone">&#xf0dc;</i>');
					$('.new-table thead tr td:eq(2)').append('<i style="font-size:12px" class="fa icone">&#xf0dc;</i>');
					$('.new-table thead tr td:eq(3)').append('<i style="font-size:12px" class="fa icone">&#xf0dc;</i>');
					$('.new-table thead tr td:eq(4)').append('<i style="font-size:12px" class="fa icone">&#xf0dc;</i>');
					$('.new-table thead tr td:eq(5)').append('<i style="font-size:12px" class="fa icone">&#xf0dc;</i>');
					$('.new-table thead tr td:eq(7)').append('<i style="font-size:12px" class="fa icone">&#xf0dc;</i>');
				}
		});

		// $('#dynamic_content').css('width', ($(window).width()-300)+'px');
		// $(window).on('resize', function(){
		// 	$('#dynamic_content').css('width', ($(window).width()-300)+'px');
		// });
		// $('#toggleIcon').on('click', function(){
		// 		if($('#main-content').css('margin-left') == '0px')
		// 			$('#dynamic_content').css('width', ($(window).width()-300)+'px');
		// 		else
		// 			$('#dynamic_content').css('width', ($(window).width()-70)+'px');
		// 	});
        /*$('#dynamic-table').dataTable( {
            "aaSorting": [[0,'desc']],
            "aoColumnDefs": [{ "bSortable": false, "aTargets": [ 0 ] }],
            "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
            "oLanguage": {
                "sSearch": "Quick Search (On displaying records)"
            },
            "fnDrawCallback": function( oSettings ) {
			      //$('#dynamic-table_info')[0].innerHTML+= ', Range [<?=($page-1)*RECORD_LIMIT_IN_EACH_PAGE+1?>-<?=$page*RECORD_LIMIT_IN_EACH_PAGE?>]';
    }

        } );
        //$('#dynamic-table_info')[0].innerHTML = '';*/
    	
    	/* new code start here*/
    	$(".alphabet-links").click(function(){
    		var alphabet = $(this).text().toLowerCase();
			
			window.location.href= "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&id=1&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&num_records_per_page="+$('#num_records_per_page').val()+"&alphabet="+alphabet;
    	});
    	/*new code end here */
    });
    $("#record_list_table table tr td:not(:first-child)").click(function(){
    	var mod = '<?php echo $this->input->get('cm'); ?>'; 
    if(mod == 'Leads'){
    	 var link= $(this).closest('tr').find('.list_link').attr('href');
    	 if(link)window.location.href = link;
    }else if (mod == 'Clients'){
    	 var link= $(this).closest('tr').find('.list_link_clients').attr('href');
    	 if(link)window.location.href = link;
    	}else if (mod == 'Contracts'){
    	 var link= $(this).closest('tr').find('.list_link_contracts').attr('href');
    	 if(link)window.location.href = link;
    }		
     
   });
</script>
