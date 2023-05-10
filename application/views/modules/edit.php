<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<style type="text/css">
.btn-fill-blue {background:#03a9f4;}
.btn[class*="btn-fill-"] {color:#fff;}
.btn[class*="btn-fill-"]:hover {box-shadow:0px 2px 5px 0px rgba(0, 0, 0, 0.36);}
 .form-control, .single-row {background: #f5f5f5;}
.select2-container--default span.select2-selection--single .select2-selection__rendered {
    line-height: 35px;}
.select2-container--default span.select2-selection--single {background: #f5f5f5;height: 35px;border-color: #ddd;}
.panel .panel-heading .btn-theme-o,.panel-heading .btn.color-theme:hover {
    color: #1fb5ad !important;
    background: #e0f7fa !important;
    border: 1px solid #1fb5ad !important;
}
#page-header a {
    font-size: 16px;
    font-weight: 700;
    transition: all .25s ease-in;
}
.btn.color-theme {
    color: #1fb5ad !important;
    border: 1px solid transparent !important;
    background: transparent !important;
}
 .required + .select2{
        border-radius: 5px !important;
        border: 1px solid blue ;
    }

   header.panel-heading.fix-panel-heading {position:fixed; z-index:1; border-bottom:3px solid #ddd;}

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">
<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>

<?php $sessionData = $this->session->userdata; 
    $isopener = $sessionData['role_id'];
    $openerRights = false;
if($this->session->userdata('role_id') != 1 && $this->session->userdata('role_id') != 7)
{

  if($this->session->userdata('user_id') != $record_data['created_by'])
  {
  	$openerRights = true;
  }
}
?>

<section id="main-content">
	
	<section class="wrapper" style="overflow: hidden;">

		<div class="row">

			<div class="col-lg-12">
					
				<section class="panel">
		
					<header class="panel-heading">
						<div class="row">
							<div class="col-lg-6">
								<a class="btn btn-theme-o" href="<?php echo base_url() ?>modules/addRecord/?cm=<?php echo $current_module; ?>&ac=new">Add New Record</a>
								<a class="btn color-theme" href="<?php echo base_url() ?>modules/?cm=<?php echo $current_module; ?>">View All <?php echo $current_module; ?></a><i class="icon-crm-arrow-long-right icon-right" style="color: #1fb5ad;font-size: 15px;"></i>
							</div>

							<div class="col-lg-6">
								<span style="float: right">
									<button  id="add_contract_btn" class="btn btn-success" type="button"><i class="fas fa-save"></i> Update Record</button>
									<a type="submit" href="javascript:history.back()" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancel Update</a>
								</span>
							</div>
						</div>

					</header>
				 
					<div class="panel-body">
						
						<?php $this->load->view('common/alert'); ?>

						<form role="form" id="update" action="?cm=<?php echo $current_module; ?>&ac=edit&id=<?php echo $record_id; ?>" method="post">
						
							<input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
							<input type="hidden" name="record_id" value="<?php echo $record_id; ?>"/>
							
							<div class="form-group col-lg-6" style="min-height: 57px !important;">
								<label for="0" style="margin-top:15px;">Lead Creator *</label>
									<?php if($sessionData['role_id']==3){ ?>
	                                    <input name="__0" type="hidden" value id="officer-id">
	                                    <select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required"> 
	                                     <?php } else {?>   
                                       <select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required">
                                       <?php }?> 
                                       
								<?php  $sessionData = $this->session->userdata; 
									if($record_data["__0"] == $sessionData['user_id']){   
									foreach ($users_list as $option_key => $option) 
									 { 
									 	if ($option['id'] == $record_data["__0"]){ ?>
									<option <?php if ($option['id'] == $record_data["__0"]) echo 'selected="selected"' ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
									<?php }
									 }
									}else
									 {
									 	foreach ($users_list as $option_key => $option) 
									    { 
									    	if($sessionData['user_id'] != $option['id'])
									    	{
									 		if ($option['id'] == $record_data["__0"])
									 		{

									    ?>
										<option <?php echo 'selected="selected"' ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
									<?php
										}
									 		}	 
										}

									 }	 
									?>
								</select>
								<script type="text/javascript">
										$(document).ready(function() {
										if(<?php echo $isopener ?> == 3){
                                                $('#officer-id').val($('#0').val());
                                            }else{
                                                  $('#officer-id').val('');
                                            }
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
										echo "<div class=\"clearfix\"></div><br/><div class='col-xs-12'> <div class='tab-title'> <span> $section_name <span></div></div>";
									}
										
									if ($lookup_module_id != '') 
									{ 
									?>
										<div class="form-group col-lg-6" style="min-height: 57px !important;">
												<label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label> 
												<select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate <?php echo ($required) ? "required": ""; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?> >
														<?php foreach ($iteration as $option_key => $option) {
															if($openerRights)
															{
																if ($option['id'] == $savedValue)
																{ ?>
																	<option <?php echo 'selected="selected"' ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>	
																<?php }
															}
															else
															{
															?>
																<option <?php if ($option['id'] == $savedValue) echo 'selected="selected"' ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
														<?php } } ?>
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
														<textarea name="__<?php echo $meta['id'] ?>" class="form-control <?php echo ($required) ? "required": ""; ?>" rows="6" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?>><?php echo $savedValue; ?></textarea>
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
	<select name="__<?php echo $meta['id'] ?>[]" class="multi-select <?php echo ($required) ? "required": ""; ?>" style="width: 100% !important; padding: 5px;" multiple="multiple" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?> >
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
											<select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate <?php echo ($required) ? "required": ""; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?> >
											<?php foreach ($option_value as $option_key => $option) {
													
											 ?>

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
											<input value="<?php echo $savedValue; ?>" name="__<?php echo $meta['id'] ?>" type="<?php echo $type; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> class="form-control <?php echo ($required) ? "required": ""; ?>" id="<?php echo $id ?>" placeholder="Enter <?php echo $placeholder ?>" <?php echo $isReadOnly; ?>>
										</div>
									<?php 
									}
							
								}
						
							?>

							<div class="clearfix"></div>
							
							<hr/>
							<div style="text-align:right;    margin: 0 15px 15px;">
								<button  id="add_contract_btn2" class="btn btn-success" type="button"><i class="fas fa-save"></i> Update Record</button>
								<?php
								if ($current_module == LEADS_PLURAL_NAME) 
								{ ?>
									<!-- <a type="submit" onclick="convertRecord();" href="#" class="btn btn-round btn-fill-blue"><i class="icon-crm-user-out"></i> Convert To Client</a> -->
								<?php 
								} 
								?>
								<a type="submit" href="javascript:history.back()" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancel Update</a>
							</div>
						</form>

					</div>
			
				</section>

			</div>

		</div>

	</section>
<div class="modal fade" id="modalConvert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Client Service Type Confirmation</h4>
                    </div>
                    <div class="modal-body" style="font-size:16px;">Are you sure to continue with selected Service Type ?</div>
                    <div class="client_service_type" style="margin-left: 13px;font-weight: bold;margin-bottom:10px;"></div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                        <button class="btn btn-success" id="confirm_btn" type="button">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Close -->
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
	$(document).ready(function(){ 
		if(<?php echo $isopener ?> != 1){
       		$('#Lead_Category').parent().hide();
             }

		var reqlength1 = $(".required");
            for(var i = 0; i < reqlength1.length; i++){
                $(reqlength1[i]).css('border', '1px solid blue'); 
            }

		 var serviceType = $('.col-lg-6 .multi-select');	
		if("<?php echo $current_module; ?>"=="Contracts")
		{
			console.log("current module=<?php echo $current_module; ?>");
			$('#Client_Number').parent().css('display', 'none');
            $('#Contract_Client').parent().css('display', 'none');;
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
                         serviceType.val('');
						$("#Signing_Rate").val("");
						$("#Contract_Number").val("");	
                        //$('.col-lg-6 .multi-select').empty().trigger('change');
					},
					success: function(result)
					{
                        var result = JSON.parse(result);
						console.log(result);
                         
						var Contract_Client = result[0]['value']; 
						var signing_rate = result[2]['value'];
                        var Client_number = result[3]['value'];
                        var contract_number = result[4]['value'];

                        $('#Client_Number').val(Client_number);
                        $('#Contract_Client').val(Contract_Client);
                        
                	    $("#Signing_Rate").val(signing_rate);
						$("#Contract_Number").val(contract_number);	
                 		var array = result[1].value.split("____"); 
                        if(array.length >1){
                        for(var i = 0 ;i<array.length; i++){
                            var newOption = new Option(array[i], array[i], true, true);
                            serviceType.append(newOption).trigger('change');
                            }
                        }else{
                            if(result[1].value!= ""){
                            var newOption = new Option(result[1].value, result[1].value, true, true);}
                             
                        }
                        serviceType.append(newOption).trigger('change');
                    }	
				});
			}
		}

        $("#add_contract_btn,#add_contract_btn2").click(function(){
        	var flag = true;
            var reqlength = $(".required");
            for(var i = 0; i < reqlength.length; i++){
                if($(reqlength[i]).val() == ''){
                    flag = false;
                    $(reqlength[i]).css('border', '1px solid red');
                     $(reqlength[i]).prev().css('color', 'red'); 
                     if($(reqlength[i]).next().hasClass('select2')){
                        $(reqlength[i]).next().css('border', '1px solid red');
                    } 
                     $('html, body').animate({
                        scrollTop: $(reqlength[i]).offset().top
                    }, 1000);
                     break;
                }else{
                	 $(reqlength[i]).css('border', '1px solid blue');
                     $(reqlength[i]).prev().css('color', '#767676'); 
                    flag = true;
                }
            }
            if(flag){
            	
            	if("<?php echo $current_module; ?>"=="Contracts"){
                    
                    $('#Service_Type').attr('name',$('#Service_Type').attr('name')+'[]');

                    var html = '';
                    var arr = $('#Service_Type').val();       
                    if(arr!=null){
					
					$('#confirm_btn').prop('disabled', false);
                            html += '<li>'+arr+'</li>';
                            html += '</ul>';
                        }
                    else{
                            $('#confirm_btn').prop('disabled', true); 
                            html = 'No Service Type Selected';
                                
                        }
                    $(".client_service_type").html(html);
                    $("#modalConvert").modal();

                }else{
	            
		            console.log($('.col-lg-6 .multi-select').val());
		            var html = '';
		            var arr = $('.col-lg-6 .multi-select').val();       
		           /* alert(arr);*/
		            if(arr!=null){
		                $('#confirm_btn').prop('disabled', false);
		            for(var i=0; i< arr.length; i++){
		                    html += '<li>'+arr[i]+'</li>';
		                    }
		                    html += '</ul>';
		                }
		            else{
		                    $('#confirm_btn').prop('disabled', true); 
		                    html = 'No Service Type Selected';
		                        
		                }
		            $(".client_service_type").html(html);
		            $("#modalConvert").modal();

                }
				$("#confirm_btn").click(function(){
		            $("#update").submit();
		        });
    		}
		});


        // fix panel header on scroll
        // setTimeout(function(){
        	var site_header = $('header.header');
        	var header = $('header.panel-heading');

        	var get_height = header.outerHeight();
        	var set_offset_top = site_header.outerHeight()+'px';
        	var get_width = header.outerWidth();

        // },500);

		$(window).scroll(function(){
		    if ($(this).scrollTop() > 150) {
		       header.addClass('fix-panel-heading').attr("style", "width:"+ get_width + "px; top:"+ set_offset_top);
		       $('.panel-body').attr("style", "margin-top:"+ get_height + "px;");
		    } else {
		       header.removeClass('fix-panel-heading');
		       $('.panel-body').attr("style", "margin-top:0;");
		    }
		});

	});
</script>
