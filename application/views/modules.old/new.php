<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">

<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>

<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        New <?php echo $current_module; ?>
                    </header>
                    <div class="panel-body">
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

                        <form role="form" action="?cm=<?php echo $current_module; ?>&ac=new" method="post">
                            <input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="0">Assigned Officer *</label>
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
                            <?php
																//echo '<pre>';print_r($meta_fields);die;
                                $section_name = "";
                                foreach ($meta_fields as $key => $meta) 
                                {
                                    $id = str_replace(" ", "_", $meta["name"]);
                                    $option_value = explode(",", $meta["option_value"]);
                         				
                                    $required = ($meta['is_required'] == 1) ? true : false;
                                    $placeholder = strtolower($meta["name"]);
                                    list($type, $multiple) = explode("_", $FIELD_TYPE[$meta['type']]);
                                    $lookup_module_id = $meta["lookup_module_id"];
                                    if ($lookup_module_id == 0) {
                                        $iteration = $users_list;
                                    } else if ($lookup_module_id == 2) {
                                        $iteration = $active_clients_list;
                                    } else {
                                        $iteration = array();
                                    }
                                    //echo '<pre>';print_r($iteration);
                                    
                                    if ($section_name != $meta["section_name"])
                                    {
                                        $section_name = $meta["section_name"];
                                        echo "<div class=\"clearfix\"></div><br/><strong class='main-heading' style=\"font-size: 1.3em;\">$section_name</strong>";
                                    }
                                    if ($lookup_module_id != '') 
                                    { 
																			//echo '<pre>';print_r($iteration); die;
																			?>
                                        <div class="form-group col-lg-6 here" style="min-height: 57px !important;">
                                            <label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
                                            <select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate" <?php echo ($required) ? 'required="required"' : ""; ?> >
                                                <?php foreach ($iteration as $option_key => $option) { ?>
                                                    <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
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
                                    else if ($type == "textarea") 
                                    { ?>
                                        <div class="form-group col-lg-12">
                                            <label class="col-sm-12 control-label" for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
                                            <div class="col-sm-12">
                                                <textarea name="__<?php echo $meta['id'] ?>" class="form-control" rows="6" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> ></textarea>
                                            </div>
                                        </div>
                                    <?php 
                                    } 
                                    else if ($type == "checkbox") 
                                    { ?>
                                        <div class="form-group col-lg-6 icheck" style="min-height: 57px !important; padding-top: 18px;">
                                            <div class="flat-green single-row" style="margin-top: 6px;border: 1px solid #e2e2e4;border-radius: 4px;padding-left: 5px;height: 34px;">
                                                <div class="radio" style="margin-top: 7px;">
                                                    <label for="<?php echo $id ?>"><strong><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></strong></label>
                                                    <input name="__<?php echo $meta['id'] ?>" value="yes" type="checkbox" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> >
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                    } 
                                    else if ($type == "select" && $multiple == 'multiple') 
                                    { ?>
                                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                            <label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
                                            <select name="__<?php echo $meta['id'] ?>[]" class="multi-select" style="width: 100% !important; padding: 5px;" multiple="multiple" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> >
                                                <?php foreach ($option_value as $option_key => $option) { ?>
                                                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
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
                                            <select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate" <?php echo ($required) ? 'required="required"' : ""; ?> >
                                                <?php if(!empty($option_value)) { foreach ($option_value as $option_key => $option) { ?>
                                                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                                <?php } } ?>
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
                                    { ?>
                                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                            <label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
                                            <input name="__<?php echo $meta['id'] ?>" type="<?php echo $type; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> class="form-control" id="<?php echo $id ?>" placeholder="Enter <?php echo $placeholder ?>">
                                        </div>
                                    <?php   
																		}

                                }
                            ?>

                            <div class="clearfix"></div>
                            <hr/>
                            <button type="submit" class="btn btn-info">Add Record</button>
                        </form>

                    </div>
                </section>

            </div>
        </div>
    </section>
</section>

<script>
	$(document).ready(function()
	{
		if("<?php echo $current_module; ?>"=="Clients")
		{
			var time = "<?php echo dechex( time() - mktime(0, 0, 0, 0, 0, 2017) ); ?>";
			$("#Master_Contract_Number").val(time);
		}
		
		if("<?php echo $current_module; ?>"=="Contracts")
		{
			console.log("current module=<?php echo $current_module; ?>");

			get_data($("#Client_Name").val());
			
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
