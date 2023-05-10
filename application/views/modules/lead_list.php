<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>

 

<?php
error_reporting(~E_WARNING);
/*if($_SESSION['role_id'] !=7 && $_SESSION['role_id'] !=1){
	if(!isset($_GET['own']) || empty($_GET['own'])){
		$url=base_url()."modules/?cm=".$current_module."&id=1&own=".$_SESSION['user_id'];
		redirect($url);
	}elseif($_GET['own']!=$_SESSION['user_id']){
		$url=base_url()."modules/?cm=".$current_module."&id=1&own=".$_SESSION['user_id'];
		redirect($url);
	}
}*/

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
		width:155px !important;
	}
	.select2-container--open .select2-dropdown--below{
		margin-left: 5px !important;
		width: 150px !important;
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
	#modalOwnerUpdate .modal-header, #addFavoriteListModal .modal-header  { background: #1eb5ad; color:white; }
	#modalOwnerUpdate .close,#addFavoriteListModal .close { color: white; opacity:1; }
	#modalOwnerUpdate .modal-title ,#addFavoriteListModal .modal-title, #modalOwnerUpdate label { font-weight:550; }
	#modalCloserUpdate .modal-header, #addFavoriteListModal .modal-header  { background: #1eb5ad; color:white; }
	#modalCloserUpdate .close,#addFavoriteListModal .close { color: white; opacity:1; }
	#modalCloserUpdate .modal-title ,#addFavoriteListModal .modal-title, #modalCloserUpdate label { font-weight:550; }
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
	/* new code start here */
	#dynamic_content table tr {cursor: pointer;}
	a.alphabet-links { padding: 5px 6px;font-size: 15px;color:#1fb5ad;font-weight: 700; }
	a.alphabet-links:hover { color: #767676; border-radius: 50%;background: #1fb5ad38; }
	.dtnotes:not(:first-child){
            padding-left: 78px;
    }
    .btn-yellow-o {color:#ff9800; border:1px solid #ff9800; background:#fff8e1;}
	.btn-yellow-o:hover {color:#fff; background:#ff9800;}
    .btn-yellow-o:focus{color: #ff9800; border: 1px solid #ff9800;background: #fff8e1; }

    .btn-blue-o {color:dodgerblue; border:1px solid dodgerblue; background:#1e90ff1f;}
	.btn-blue-o:hover {color:#fff; background:dodgerblue;}
    .btn-blue-o:focus{color: dodgerblue; border: 1px solid dodgerblue;background: #1e90ff1f; }
    
    .btn-green-o {color:#901EFF; border:1px solid #901EFF; background:#901eff1f;}
	.btn-green-o:hover {color:#fff; background:#901EFF;}
    .btn-green-o:focus{color: #901EFF; border: 1px solid #901EFF;background: #901eff1f; }
    
    #addFavoriteListModal .modal-body label { font-weight: 600; }
    .btn-red-o {  color: #f44336;border: 1px solid #f44336;border-radius:50%;background: #fee8e7;font-size: 16px;font-weight: 700;transition: all .25s ease-in;padding: 4px 4px !important;margin-left:5px; }
    .btn-red-o:hover{     color: #fff !important;background: #f44336;}
    #search_blk #frmSearch .col-lg-3 .form-control::placeholder { color: #B6B9B8 !important;}
     #reminders.reminder-btn {color: initial !important;background-color: initial !important;}
.reminder-btn {font-size: 18px;margin: 0 5px 0px -3px;}
.reminder-item {display:flex; padding:6px 12px; border-bottom:2px solid #e0e0e0;}
 #reminders.reminder-btn {color: initial !important;background-color: initial !important;}
 .ui-timepicker-container{ z-index:9999 !important; }
 .no-reminder{display: none;}
 .no-reminder-count{display: none;}
 .none{display: none !important;}
 #keyword{width: 350px;
    border-radius: 16px;
    border: 2px solid #bfb9b9;
    padding-left: 20px;
}
#keyword::placeholder {
  color: grey !important;
  }
.icon-btn {
    border: 1px solid;
    border-radius: 50px;
    font-size: 16px;
    width: 34px;
    height: 33px;
    padding: 0;
    text-align: center;
    line-height: 31px;
    position: relative;
} 													
/*    #keyword::placeholder { color: red !important;}
*/    /*new code end here*/
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
					   if ($superAdmin == true || $_SESSION['role_id'] == 7 || $_SESSION['role_id'] == 1)
					   { ?>
                        <select id="own" onchange="newList()" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
									<option value="">All</option>
									<?php foreach ($users_list as $option_key => $option) {  ?>
											 <option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option> 
									<?php } ?>
						</select>
							
						<script type="text/javascript">
							$("#own1").select2();
						</script>
					<?php
						}
					}
					else
					{
						if ($superAdmin == true || $_SESSION['role_id'] == 7 || $_SESSION['role_id'] == 1)
						{
						?>
							<select id="own" onchange="newList()" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
									<option value="">All</option>
									<?php foreach ($users_list as $option_key => $option) { 
										?>
											<option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
										
									<?php } ?>
							</select>
							<script type="text/javascript">
								//$("#own").select2();
							</script>
						<?php
						}
						
					}
						?>
						<select id="own1" onchange="newFavoriteList()" name="own1" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">

								<option value="">Favorite List</option>
								<?php $mode = $current_module != 'Leads' ? $current_module == 'Clients' ? 2 : 3 : 1;

								$edit_fav_id=$_GET['edit_fl_id'];
							    
								foreach ($favorite_list as $option_key => $option) { 
									
									if(!empty($edit_fav_id) && $edit_fav_id==$option['id'])
								    	$selection='selected';
								    else
								    	$selection='';

										if($option['module_id'] == $mode){ 
									?>
										<option <?php echo $selection; echo !empty($selected_fav_list) && ($selected_fav_list == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option> 
								<?php } } ?>
						</select>
						<button type="button" class="btn btn-red-o" title="Delete Favorite List" id="del_fav_list" <?php echo !empty($selected_fav_list) ? '':'style="display:none;"'; ?>> <i class="icon-crm-delete"></i>
						</button>
						 <button class="btn icon-btn btn-blue-o" <?php echo !empty($selected_fav_list) ? '':'style="display:none;"';?> id='edit_fav'  title='Edit Favorite List'>
			                <i class="fa fa-edit"></i> 
			            </button>
			            <button class="btn icon-btn btn-blue-o" <?php echo !empty($_GET['edit_fl_id']) ? '':'style="display:none;"';?> id='add_fav' title='Add favourite record'>
			                <i class="fa fa-plus"></i>
			            </button>
						<script type="text/javascript">
								$("#own1").select2();
							</script>	
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
													<h4 class="modal-title">Select new record opener</h4>
											</div>
		<div class="modal-body">
				<div class="form-group col-lg-6" style="min-height: 57px !important;">
						<label>New Opener *</label>
						<select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
								<?php foreach ($users_list as $option_key => $option) {
									if($option['role_id'] == 3){ ?>
										<option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
								<?php } } ?>
						</select>
						<script type="text/javascript">
								$(document).ready(function() {
										$("#0").select2();
								});
						</script>
				</div>
				 <div class="form-group col-lg-6" style="min-height: 57px !important;">
                        <label>New CLoser *</label>
                        <select name="__0" id="cLead_0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                <?php foreach ($users_list as $option_key => $option) {
                                    if($option['role_id'] == 4){ ?>
                                        <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                <?php } } ?>
                        </select>
                        <script type="text/javascript">
                                $(document).ready(function() {
                                       $("#cLead_0").select2();
                                });
                        </script>
                </div>
				<div class="clearfix"></div>
		</div>
											<div class="modal-footer">
													<button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
													<button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change opener of');" type="button">Confirm</button>
											</div>
									</div>
							</div>
						</div>
						<!-- modalCloserUpdate -->
						<div class="modal fade" id="modalCloserUpdate" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">Select new record closer</h4>
						</div>
						<div class="modal-body">
								<div class="form-group col-lg-6" style="min-height: 57px !important;">
										<label>New Closer *</label>
										<select name="__0" id="Client_0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
												<?php foreach ($users_list as $option_key => $option) {
														if($option['role_id'] == 4){ ?>
														<option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
												<?php } } ?>
										</select>
										<script type="text/javascript">
												$(document).ready(function() {
														$("#Client_0").select2();
												});
										</script>
								</div>
								<div class="clearfix"></div>
						</div>
											<div class="modal-footer">
													<button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
													<button class="btn btn-success" onclick="bulkActionOnClient('mOwner','change closer of');" type="button">Confirm</button>
											</div>
									</div>
							</div>
						</div>
						<!-- modalCloserUpdate -->
						<!-- modal -->

						<div class="adv-table">

							<?php
							extract($page_details);
							if(!isset($selected_fav_list)){
								$selected_fav_list='';
							}	
							if(count($record_data) >= 0)
							{
							?>
							<div class="row" style="margin-top:20px; padding:0 15px;">

								<div class="col-lg-6">

									<select name="num_records_per_page" id="num_records_per_page" size="1" onchange="self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&fl_id=<?=$selected_fav_list?>&num_records_per_page='+this.value">
										<option value="25"<?=($records_per_page == 25)?' selected="selected"':''?>>25</option>
										<option value="50"<?=($records_per_page == 50)?' selected="selected"':''?>>50</option>
										<option value="100"<?=($records_per_page == 100)?' selected="selected"':''?>>100</option>
										<option value="200"<?=($records_per_page == 200)?' selected="selected"':''?>>200</option>
										<option value="300"<?=($records_per_page == 300)?' selected="selected"':''?>>300</option>
										<option value="400"<?=($records_per_page == 400)?' selected="selected"':''?>>400</option>
										<option value="500"<?=($records_per_page == 500)?' selected="selected"':''?>>500</option>
									</select>

									<span>Records per Page</span>

									<?php
									if ($superAdmin == true || $this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 7)
									{
										$none='';
										if($this->session->userdata('role_id') == 7 && $current_module=='Contracts')
											$none='none';	
									?>

										<div class="bulk-action modules <?php echo $none ?>">
										  <div class="btn-group">
											<button class="btn dropdown-toggle bulk_action" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i></button>
											<ul class="dropdown-menu">
											<?php if($current_module == "Leads") { ?>
											  <li><a class="module_head" data-toggle="modal" href="#modalOwnerUpdate">Mass assign</a></li>
											<?php }else if($current_module == "Clients"){ ?>
											  <li><a class="module_head" data-toggle="modal" href="#modalCloserUpdate">Mass assign to closer</a></li>	
											<?php } ?>

											<?php if($this->session->userdata('role_id') == 1){ ?>
											  <li><a class="module_head mass_delete" href="javascript:;">Mass Delete</a></li> <?php }?>
											</ul>
										  </div>
										</div>

									<?php
									} ?>
									<?php if ($current_module == "Leads") { ?>
										<a class="btn btn-yellow-o" title="Favorite Leads" href="#" id="favorite_list_btn" data-id="Leads" style="font-size: 13px;width:130px;">Add Favorite Lead
              							</a>
									<?php } ?>
									<?php if ($current_module == "Clients") { ?>
										<a class="btn btn-blue-o" title="Favorite Clients" href="#" id="favorite_list_btn" data-id="Clients" style="font-size: 13px;width:130px;">Add Favorite Client
              							</a>
									<?php } ?>
									<?php if ($current_module == "Contracts") { ?>
										<a class="btn btn-green-o" title="Favorite Contracts" href="#" id="favorite_list_btn" data-id="Contracts" style="font-size: 13px;width:150px;">Add Favorite Contract
              							</a>
									<?php } ?>
								</div>



								<div class="col-lg-6" style="text-align:right;">
									
									<input type="text" name="keyword" id="keyword" value="<?php echo $keyword?>" placeholder="Enter Keyword" onkeyup="javascript: self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&id=1&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&fl_id=<?=$selected_fav_list?>&num_records_per_page='+$('#num_records_per_page').val()+'&keyword='+$('#keyword').val()" />
									
									<input type="button" class="btn btn-primary dropdown-toggle btn-sm keyword_search" value="Search" style="margin-top:-4px;" onclick="javascript: self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&id=1&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&fl_id=<?=$selected_fav_list?>&num_records_per_page='+$('#num_records_per_page').val()+'&keyword='+$('#keyword').val()" />

									<input type="button" class="btn btn-primary dropdown-toggle btn-sm reset" value="Reset" style="margin-top:-4px;" onclick="javascript: self.location='<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1'" />
								</div>
							</div>
							<div class="row" style="text-align:right;width:100%;margin-right:0;display:inline-block;padding:10px 0px 0px 25px;">
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
<form id="record_list_table">
<?php 
$alphabet='';
$fl_id='';
$sper_page='';
$spage='';
$search = '';
if (isset($_GET['alphabet']) && !empty($_GET['alphabet'])) {
   $alphabet=$_GET['alphabet'];	
}
if (isset($_GET['fl_id']) && !empty($_GET['fl_id'])) {
   $fl_id=$_GET['fl_id'];	
}
if(isset($_GET['num_records_per_page']) && !empty($_GET['num_records_per_page']))
	$sper_page=$_GET['num_records_per_page'];

if(isset($_GET['page']) && !empty($_GET['page']))
	$spage=$_GET['page'];

if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
   $search=$_GET['keyword'];	
}
?>
<div id="dynamic_content" style="margin-top:10px;/*height:500px;*/">


<table class="display new-table data-table table table-striped table-condensed" id="dynamic-table" style="width: 100% !important;">
	<thead>
		<tr style="font-weight:bold;">
			<?php
			if ($writePermission == true)
			{
			?>
				<td class="all">
					<label style="cursor:pointer;">
						<input type="checkbox" onclick="selectAll()" style="position:absolute; opacity:0;" />
						<span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
					</label>
				</td>

			<?php
			}
			?>
			<td class="all"></td>
            <th class="all" nowrap>Company Name</th>
            <th class="all" nowrap>First Name</th>
            <th class="all" nowrap>Last Name</th>
            <th class="all" nowrap>Email</th>   
            <th class="all" nowrap>Phone</th>
			<th class="all" nowrap>City</th>
            <th class="all" nowrap>Province</th>
            <th class="all" nowrap>Country</th>
            <th class="all" nowrap>Last Modified By</th>
            <th class="all" nowrap>Last Modified</th>
            <th class="all" nowrap>Lead Status</th> 
            <th class="all" nowrap>Opener</th> 
            <th class="all" nowrap>Closer</th> 
            <th class="none">Notes</th>

    </tr>
    </thead>
	    <tbody>   

		</tbody>
</table>


</div>
<div class="row" style="text-align:right;width:100%;margin-right:0;display:inline-block;padding:10px 0px 0px 25px;">
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
<div class="row" style="padding:15px;">
<div class="col-xs-12" style="text-align:left">

<span><?php echo $total_records;?></span> items
<?php if(!empty($selected_fav_list)){ ?>
	<a class="btn <?php  if($start_record < 1) { ?>disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page-1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&fl_id=<?=$selected_fav_list?>" style="border:1px solid #aaa;">&laquo;</a>

		<?=$cur_page?> of <?=$total_page?>

		<a class="btn <?php  if($total_records <= $end_record) {?> disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page+1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&fl_id=<?=$selected_fav_list?>" style="border:1px solid #aaa;">&raquo;</a>
<?php } else if(!empty($alphabet)){  ?>
		<a class="btn <?php  if($start_record < 1) { ?>disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page-1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&alphabet=<?=$alphabet?>" style="border:1px solid #aaa;">&laquo;</a>

		<?=$cur_page?> of <?=$total_page?>

		<a class="btn <?php  if($total_records <= $end_record) {?> disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page+1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&alphabet=<?=$alphabet?>" style="border:1px solid #aaa;">&raquo;</a>
<?php } else { ?>
	<a class="btn <?php  if($start_record < 1) { ?>disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page-1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>" style="border:1px solid #aaa;">&laquo;</a>

	<?=$cur_page?> of <?=$total_page?>

	<a class="btn <?php  if($total_records <= $end_record) {?> disabled <?php } ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own=<?=$own?>&rStat=<?=$recordStatus?>&<?=$query_string?>&page=<?=($cur_page+1)?>&num_records_per_page=<?=$records_per_page?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&keyword=<?=$search?>" style="border:1px solid #aaa;">&raquo;</a>
<?php } ?>
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
<!-- Favorite List Modal -->
<div class="modal fade" id="addFavoriteListModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
							<div class="form-group col-lg-6" style="min-height: 57px !important;">
									<label>Title *</label>
									<input type="text" id="title" class="form-control" placeholder="title" />
							</div>
							<div class="clearfix"></div>
					</div>
					<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
							<button class="btn btn-success" id="confirm_btn" type="button">Add</button>
					</div>
			</div>
	</div>
</div>
<!-- Favorite List Modal -->

<!-- Reminder model  start-->

<div class="modal fade" id="reminder-modal" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Reminders</h4>
          </div>
          <div class="modal-body">
            <?php require_once 'dynamic_reminder.php';?>
          </div>
          <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          </div>
      </div>
  </div>
</div>

<!-- Reminder model end-->
   <?php
	
	        	$closerdata = array();
               foreach ($users_list as $option) {  
		               	if($option['role_id']==4)
		               	{
		               		$words = explode( " ", $option['title'] ); 
							array_splice( $words, -1 ); 
		               		$closerdata[] .= implode( " ", $words );
		               	}
				 }
				 $openerdata = array();
               foreach ($users_list as $option) {  
		               	if($option['role_id']==3)
		               	{
		               		$words = explode( " ", $option['title'] ); 
							array_splice( $words, -1 ); 
		               		$openerdata[] .= implode( " ", $words );
		               	}
				 }
	                               
?>		

<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";

	$(document).ready(function(){
		var cdata = '<?php if(isset($closerdata)){echo json_encode($closerdata);} ?>';
			  $(function() {
			    var availableTags =  $.parseJSON(cdata) ;
			    $( "#closer" ).autocomplete({
			      source: availableTags
			    });
			});
		  var odata = '<?php if(isset($openerdata)){echo json_encode($openerdata);} ?>';
		  $(function() {
		    var availableTags =  $.parseJSON(odata) ;
		    $( "#opener" ).autocomplete({
		      source: availableTags
		     });
			});
	});


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
    function newFavoriteList(page){
    	var list_id = $("#own1").val();
    	console.log("list_id",list_id);
	    var own = "<?php echo $this->session->userdata('user_id'); ?>";
	    role_id="<?php echo $this->session->userdata('role_id'); ?>";
	  	if(role_id==7 || role_id ==1){
	  		own='';
	  	}  
		var rStat = $("#rStat").val();
        if(!page)
        	page = 1;
        var url = list_id == "" ? "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1&num_records_per_page=<?=$records_per_page?>&own=" + own + "&rStat=" + rStat + "&page=" + page : "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&num_records_per_page=<?=$records_per_page?>&id=1&own=&rStat=" + rStat + "&page=" + page +"&fl_id=" + list_id;
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
        var newCloser=$("#cLead_0").val();
        var url = '<?php echo base_url() ?>Modules/?cm=<?php echo $current_module; ?>&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids+'&newCloser=' + newCloser+'&isDash=0';
        if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
            window.location.href = url;
        }
    }
    function bulkActionOnClient(action, actionText){
        var uids = '';
        $("input:checkbox:checked").each(function() {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
        });

        if (uids == ''){
            alert("No user has been selected. Please select an user first.");
            return;
        }

        var newOwner = $("#Client_0").val();
        var url = '<?php echo base_url() ?>Modules/?cm=<?php echo $current_module; ?>&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids+'&isDash=0';
        if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
            window.location.href = url;
        }
    }
    $(document).ready(function() {

   //          $("#dynamic-table").tableHeadFixer();

   //          $("#dynamic-table").DataTable({responsive: true,
   //  			ordering: false,
   // 			    paging: false,
   //  			searching:false,
   //  			dom: 't',
   //  			keys: true,
			// });

			var base_url = "<?php echo base_url();?>";
			var dataTable = $('#dynamic-table').DataTable({
             "pageLength" : 10,
             "serverSide": true,
             "order": [[0, "asc" ]],
             "ajax":{
                  data: function(data){
                          var name = $('#select').val();
                          data.monthly_target = name;
                       },                     
                  url :  base_url+'Modules/leadtable',
                  type : 'POST'
                    },
             });
			 // $('#select').change(function(){
		  //      dataTable.draw();
		  //   });


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

			$( "#record_list_table tr" ).hover(
			  function() {
			    $(this).find('.no-reminder').show();
			    
			  }, function() {
			    $(this).find('.no-reminder').hide();
			  }
			);

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
			var own = $("#own").val();
			window.location.href= "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&own="+own+"&id=1&rStat=<?=$recordStatus?>&<?=$query_string?>&sort_column=<?=$sort_column?>&sort_order=<?=$sort_order?>&num_records_per_page="+$('#num_records_per_page').val()+"&alphabet="+alphabet;
    	});
    	$("#favorite_list_btn").click(function(){
    		var mode = $(this).attr('data-id');
    		var uids = '';
			$("input:checkbox:checked").each(function() {
					var id = $(this).val();
					uids += (uids == '') ? id : ("," + id);
			});

			if (uids == ''){
					alert("No record has been selected. Please select record first.");
					return;
			}
			if(mode == 'Leads')
			{
				$("#addFavoriteListModal .modal-title").text('Add Favorite Lead');
				$("#addFavoriteListModal #confirm_btn").attr('data-id', 'Leads');	
				$("#addFavoriteListModal").modal();
    		}
			else if(mode == 'Clients')
			{
				$("#addFavoriteListModal .modal-title").text('Add Favorite Client');
				$("#addFavoriteListModal #confirm_btn").attr('data-id', 'Clients');
				$("#addFavoriteListModal").modal();
			}
			else if(mode == 'Contracts')
			{
				$("#addFavoriteListModal .modal-title").text('Add Favorite Contract');
				$("#addFavoriteListModal #confirm_btn").attr('data-id', 'Contracts');
				$("#addFavoriteListModal").modal();
			}
		});
    	$("#addFavoriteListModal #confirm_btn").click(function(){
    		var uids = '';
    		var title = $("#addFavoriteListModal #title").val().trim();
    		var mode = $(this).attr('data-id');
    		$("input:checkbox:checked").each(function() {
					var id = $(this).val();
					if(id != 'on')
					uids += (uids == '') ? id : ("," + id);
			});
			if (uids == ''){
					alert("No record has been selected. Please select record first.");
					return;
			}
			else if(!title)
			{
				alert("Please select title first.");
				return;	
			}
			else
			{
				if(mode)
				{
					$.ajax({
						type:'post',
						url: base_url + 'modules/addFavoriteList',
						dataType:'json',
						data: { title : title, mode : mode, ids : uids},
						success:function(data)
						{
							if(data.success)
							{
								window.location.reload();
							}	
							else
							{
								alert(data.message);
							}
						}
					});
				}
			}
    	});
    	$("#del_fav_list").click(function(){
    		var fav_id = $("#own1").children("option:selected").val();
    		var fav_name = $("#own1").children("option:selected").text();
    		var mode = "<?php echo $current_module ?>";
    		if(confirm("Are you sure to delete "+fav_name+" ?"))
			{
				$.ajax({
					type:'post',
					url: base_url + 'modules/deleteFavoriteList',
					dataType:'json',
					data:{ id : fav_id },
					success:function(data)
					{
						window.location.href = base_url + 'modules/?cm='+mode+'&id=1';
					}
				});
			}
    	});

    	$("#edit_fav").click(function(){
    		
			var list_id = $("#own1").val();
    	
		    var own = "<?php echo $this->session->userdata('user_id'); ?>";
		    role_id="<?php echo $this->session->userdata('role_id'); ?>";
		  	if(role_id==7 || role_id ==1){
		  		own='';
		  	}  
			var rStat = $("#rStat").val();
	       	page = 1;
	        var url = list_id == "" ? "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&id=1&num_records_per_page=<?=$records_per_page?>&own=" + own + "&rStat=" + rStat + "&page=" + page : "<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>&num_records_per_page=<?=$records_per_page?>&id=1&own="+own+"&rStat=" + rStat + "&page=" + page +"&edit_fl_id=" + list_id;
	         window.location.href = url;
    		
		});


		$("#add_fav").click(function(){
			var fav_id = $("#own1").children("option:selected").val();	
			var uids = '';
    		var mode = "<?php echo $current_module ?>";
    		$("input:checkbox:checked").each(function() {
					var id = $(this).val();
					if(id != 'on')
					uids += (uids == '') ? id : ("," + id);
			});
			if (uids == ''){
					alert("No record has been selected. Please select record first.");
					return;
			}
			else
			{
				
				$.ajax({
					type:'post',
					url: base_url + 'modules/editFavoriteList',
					dataType:'json',
					data: { fav_id : fav_id, mode : mode, ids : uids},
					success:function(data)
					{
						if(data.success)
						{
							newFavoriteList(1);
						}	
						else
						{
							alert(data.message);
						}
					}
				});
				
			}
		})

    	/*new code end here */
    });
    $("#record_list_table table tr td").not(":nth-child(1)").not(":nth-child(2)").click(function(){
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

public function leadtable()
    {   
        
       // $monthly_target = $this->input->post("monthly_target");

        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

       
        $valid_columns = array(
            0=>'a.id',
            1=>'b.value',
            2=>'c.value',
            3=>'d.value',
            4=>'e.value',
            5=>'f.value',
            6=>'g.value',
            7=>'h.value',
            8=>'i.value',
            9=>'j.value',

        );
        
        if(!isset($valid_columns[$col]))
        {   $order = null; }
        else
        {  $order = $valid_columns[$col]; }

        if($order !=null)
        { $this->db->order_by($order, $dir); }

        //  if(isset($monthly_target) && !empty($monthly_target))
        // {  $this->db->where('module_id',$monthly_target);  }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        $this->db->limit($length,$start);

        // $this->db->select("a.*,b.*,a.id as r_id");
        // $this->db->join("anb_crm_users_personal_info b","a.assigned_officer_id=b.user_id","left");
        // $employees = $this->db->get("anb_crm_record a");


		$this->db->where('b.record_meta_id',1);	
		$this->db->where('c.record_meta_id',2);	
		$this->db->where('d.record_meta_id',31);	
		$this->db->where('e.record_meta_id',4);	
		$this->db->where('f.record_meta_id',32);	
		$this->db->where('g.record_meta_id',35);	
		$this->db->where('h.record_meta_id',40);	
		$this->db->where('i.record_meta_id',36);	
		$this->db->where('j.record_meta_id',6);	

        $this->db->select("a.id,a.module_id,a.record_status,a.modified_by,a.modified_time,b.value as fname,c.value as lname,d.value as c_name,e.value as email, f.value as phone,g.value as city,h.value as state,i.value as country,j.value as lead_status");

        $this->db->join("anb_crm_record_meta_value b","a.id=b.record_id","left");
        $this->db->join("anb_crm_record_meta_value c","a.id=c.record_id","left");
        $this->db->join("anb_crm_record_meta_value d","a.id=d.record_id","left");
        $this->db->join("anb_crm_record_meta_value e","a.id=e.record_id","left");
        $this->db->join("anb_crm_record_meta_value f","a.id=f.record_id","left");
        $this->db->join("anb_crm_record_meta_value g","a.id=g.record_id","left");
        $this->db->join("anb_crm_record_meta_value h","a.id=h.record_id","left");
        $this->db->join("anb_crm_record_meta_value i","a.id=i.record_id","left");
        $this->db->join("anb_crm_record_meta_value j","a.id=j.record_id","left");

		 $employees = $this->db->get("anb_crm_record a");
         $total_employees = $employees->num_rows();
echo $this->db->last_query();
die("ok");
        $data = array();
        foreach($employees->result() as $rows)
        {
            $data[]= array(
            	'checkbox',
            	'reminder',
                $rows->c_name,
                $rows->fname,
                $rows->lname,
                $rows->email,
                $rows->phone,
                $rows->city,
                $rows->state,
                $rows->country,
                'last modified_by',
            	'last modified_time',
                $rows->lead_status,
                'opener',              
                'closer'             
            );     
        }

    //for filter    
        // if(isset($monthly_target) && !empty($monthly_target))
        // { $this->db->where('module_id',$monthly_target); }
        //   if(!empty($search))
        // { $x=0;
        //     foreach($valid_columns as $sterm)
        //     {  if($x==0)
        //         {  $this->db->like($sterm,$search); }
        //         else
        //         {  $this->db->or_like($sterm,$search); }
        //         $x++;
        //     }                 
        // }
        // $this->db->select("a.*,b.*,a.id as r_id");
        // $this->db->join("anb_crm_users_personal_info b","a.assigned_officer_id=b.user_id","left");
        // $x = $this->db->get("anb_crm_record a");
        // $total_employeesx = $x->num_rows();
    //for filter end    

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employees,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }







    