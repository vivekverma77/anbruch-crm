<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">
<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>

<section id="main-content">
	
	<section class="wrapper" style="overflow: hidden;">

		<div class="row">

			<div class="col-lg-12">
					
				<section class="panel">
		
					<header class="panel-heading">
							<a class="module_head" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>">View All <?php echo $current_module; ?></a> |
							<a class="module_head" href="<?php echo base_url() ?>modules/addRecord/?cm=<?php echo $current_module; ?>&ac=new">Add New Record</a>
					</header>
				 
					<div class="panel-body">
						
						<?php $this->load->view('common/alert'); ?>

						<form role="form" action="?cm=<?php echo $current_module; ?>&ac=edit&id=<?php echo $record_id; ?>" method="post">
						
							<input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
							<input type="hidden" name="record_id" value="<?php echo $record_id; ?>"/>
							
							<div class="form-group col-lg-6" style="min-height: 57px !important;">
								<label for="0">Assigned Officer *</label>
								<select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
								<?php 
									foreach ($users_list as $option_key => $option) 
									{ ?>
									<option <?php if ($option['id'] == $record_data["__0"]) echo 'selected="selected"' ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
								<?php 
									} 
								?>
								</select>
								<script type="text/javascript">
										$(document).ready(function() {
												$("#0").select2();
										});
								</script>
							</div>
							
							<?php
								$section_name = "";
								foreach ($meta_fields as $key => $meta) 
								{
									$savedValueKey = "__" . $meta['id'];
									$savedValue = (isset($record_data[$savedValueKey])) ? $record_data[$savedValueKey] : "";
									$id = str_replace(" ", "_", $meta["name"]);
									$option_value = explode(",", $meta["option_value"]);
									$required = ($meta['is_required'] == 1) ? true : false;									
									
									$isReadOnly = ($meta['is_readonly'] == 1) ? "readonly" : "";
									
									if($meta['name']=='Closer')
									{
										$isReadOnly = "readonly";
									}
									
									if($meta['name']=='Opener')
									{
										$isReadOnly = "readonly";
									}
									
									$placeholder = strtolower($meta["name"]);
									
									list($type, $multiple) = explode("_", $FIELD_TYPE[$meta['type']]);
									
									$lookup_module_id = $meta["lookup_module_id"];
									
									if ($lookup_module_id == 0)
									{
										$iteration = $users_list;
									}
									else if ($lookup_module_id == 2)
									{
										$iteration = $active_clients_list;
									}
									else 
									{
										$iteration = array();
									}
									
									if ($multiple == 'multiple' && !is_array($savedValue))
									{
										$savedValue = (array)$savedValue;
									}
									
									if ($section_name != $meta["section_name"])
									{
										$section_name = $meta["section_name"];
										echo "<div class=\"clearfix\"></div><br/><strong class='main-heading' style=\"font-size: 1.3em;\">$section_name</strong>";
									}
										
									if ($lookup_module_id != '') 
									{ 
									?>
										<div class="form-group col-lg-6" style="min-height: 57px !important;">
												<label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
												<select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?>>
														<?php foreach ($iteration as $option_key => $option) { ?>
																<option <?php if ($option['id'] == $savedValue) echo 'selected="selected"' ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
														<?php } ?>
												</select>
										</div>
											
										<script type="text/javascript">
											$(document).ready(function()
											{
												$("#<?php echo $id; ?>").select2();												
												
												//$("#<?php echo $id; ?>").select2("readonly", true);
											});
										</script>
											
									<?php 
									} 
									else if ($type == "textarea") 
									{ ?>
										<div class="form-group col-lg-12">
												<label class="col-sm-12 control-label" for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
												<div class="col-sm-12">
														<textarea name="__<?php echo $meta['id'] ?>" class="form-control" rows="6" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?>><?php echo $savedValue; ?></textarea>
												</div>
										</div>
									<?php
									} 
									else if ($type == "checkbox") 
									{ 
									?>
										<div class="form-group col-lg-6 icheck" style="min-height: 57px !important; padding-top: 18px;">
											<div class="flat-green single-row" style="margin-top: 6px;border: 1px solid #e2e2e4;border-radius: 4px;padding-left: 5px;height: 34px;">
												<div class="radio" style="margin-top: 7px;">
													<label for="<?php echo $id ?>"><strong><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></strong></label>
													<input <?php if ($savedValue == "yes") echo 'checked="checked"' ?> name="__<?php echo $meta['id'] ?>" value="yes" type="checkbox" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?> >
												</div>
											</div>
										</div>
									<?php 
									} 
									else if ($type == "select" && $multiple == 'multiple') 
									{ 
									?>
										<div class="form-group col-lg-6" style="min-height: 57px !important;">
											<label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
											<select name="__<?php echo $meta['id'] ?>[]" class="multi-select" style="width: 100% !important; padding: 5px;" multiple="multiple" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?> >
											<?php foreach ($option_value as $option_key => $option) { ?>
												<option <?php if (in_array($option, $savedValue)) echo 'selected="selected"' ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
											<?php } ?>
											</select>
										</div>
										<script type="text/javascript">
											$(document).ready(function()
											{
												$("#<?php echo $id; ?>").select2({
														maximumSelectionLength: 10
												});
											});
										</script>
									<?php 
									} 
									else if ($type == "select" && $multiple != 'multiple') 
									{
									?>
										<div class="form-group col-lg-6" style="min-height: 57px !important;">
											<label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
											<select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?> >
											<?php foreach ($option_value as $option_key => $option) { ?>
												<option <?php if ($option == $savedValue) echo 'selected="selected"' ?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
											<?php } ?>
											</select>
										</div>
										<script type="text/javascript">
											$(document).ready(function() {
											
													$("#<?php echo $id; ?>").select2();											
													
											});
										</script>
									<?php 
									} 
									else 
									{
									?>
										<div class="form-group col-lg-6" style="min-height: 57px !important;">
											<label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
											<input value="<?php echo $savedValue; ?>" name="__<?php echo $meta['id'] ?>" type="<?php echo $type; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> class="form-control" id="<?php echo $id ?>" placeholder="Enter <?php echo $placeholder ?>" <?php echo $isReadOnly; ?>>
										</div>
									<?php 
									}
							
								}
						
							?>

							<div class="clearfix"></div>
							
							<hr/>
							
							<button type="submit" class="btn btn-info">Update Record</button>
							<?php
							if ($current_module == LEADS_PLURAL_NAME) 
							{ ?>
								<a type="submit" onclick="convertRecord();" href="#" class="btn btn-info">Convert Record</a>
							<?php 
							} 
							?>
							<a type="submit" href="javascript:history.back()" class="btn btn-info">Cancel Update</a>
						</form>

					</div>
			
				</section>

			</div>

		</div>

	</section>

</section>

<script type="text/javascript">
	function convertRecord(){
		if (confirm("Are you sure that you want to convert this record? Be careful! This action cannot be undone."))
		window.location.href = "<?php echo base_url() ?>modules/viewRecord/?cm=<?php echo $current_module; ?>&ac=convert&id=<?php echo $record_id; ?>";
	} 
	
	//<?php if($current_module=='Leads' && ($own_data['role_id']==3 || $own_data['role_id']==4)) { ?>
		//$('#Closer').prop('readonly', true);
		//$('#Opener').prop('readonly', true);
	//<?php } ?>
</script>

<script>
	$(document).ready(function()
	{
		if("<?php echo $current_module; ?>"=="Contracts")
		{
			console.log("current module=<?php echo $current_module; ?>");

			//get_data($("#Client_Name").val());
			
			$("#Client_Name").on("change",function()
			{
				var client_id = $(this).val();
				get_data(client_id);				
			});

			function get_data(client_id)
			{
				console.log(client_id);
				$.ajax({
					url:  '<?php echo base_url()."modules/getClientById"; ?>',
					type: "POST",
					data: { "client_id": client_id },
					beforeSend: function() {
						$("#Signing_Rate").val("");
						$("#Contract_Number").val("");			
					},
					success: function(result)
					{
						console.log(result);
						var result =JSON.parse(result);
						console.log(result);
						var signing_rate = result[0]['value'];
						var contract_number = result[1]['value'];

						$("#Signing_Rate").val(signing_rate);
						$("#Contract_Number").val(contract_number);			
					}	
				});
			}
		}
		
	});

</script>
