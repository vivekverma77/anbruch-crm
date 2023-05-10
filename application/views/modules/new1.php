<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">

<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>

<style type="text/css">
    .form-control, .single-row {background: #f5f5f5;}
    .select2-container--default .select2-selection--single .select2-selection__rendered {line-height:35px;}
    .select2-container--default .select2-selection--single {background:#f5f5f5; height:35px; border-color:#ddd;}
    .select2-container--default .select2-selection--multiple {background:#f5f5f5; border-color:#ddd;}
    ul.sidebar-menu {padding-top:80px;}
     .required + .select2{
        border-radius: 5px !important;
        border: 1px solid blue ;
    }
</style>
<?php $sessionData = $this->session->userdata; 
    $isopener = $sessionData['role_id'];
?>
<section id="main-content" style="overflow:hidden;">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        New Contract For Client 
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
                        <?php }?>
                        <form role="form" id="addContract" action="?cm=<?php echo $current_module; ?>&ac=new&add=addContract&clientId=<?php echo $clientId ?>" method="post">
                            <input type="hidden" name="module_name" value="<?php echo $current_module; ?>"/>
                                <div class="form-group col-lg-6">
                                    <label for="0" style="margin-top:15px;">Lead Creator *</label>
                                    <?php if($sessionData['role_id']==3){ ?>
                                    <input name="__0" type="hidden" value id="officer-id">
                                    <select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required"> 
                                     <?php } else {?>   
                                   <select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                   <?php }?> 
                                   
                                    <?php foreach ($users_list as $option_key => $option) { ?>
                                        <option <?php echo $option['id'] == $sessionData['user_id'] ? 'selected' : ''; ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                    <?php } ?>
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
																//echo '<pre>';print_r($meta_fields);die;
                                $section_name = "";
                                foreach ($meta_fields1 as $key => $meta) 
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
                                        echo "<div class=\"clearfix\"></div><br/><div class='col-xs-12'> <div class='tab-title'> <span> $section_name <span></div></div>";
                                    }
                                    if ($lookup_module_id != '') 
                                    { 
									   //echo '<pre>';print_r($iteration); die;
																			?>
                                        <div class="form-group col-lg-6 here" style="min-height: 57px !important;">
                                            <label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
                                            <select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate <?php echo ($required) ? "required": ""; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> >
                                                <?php foreach ($iteration as $option_key => $option) {?>
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
    <label for="<?php echo $id ?>">
       <?php echo $meta['name']; echo ($required) ? " *" : ""; ?>
   </label>
    <select name="__<?php echo $meta['id'] ?>[]" class="multi-select <?php echo ($required) ? "required": ""; ?>" style="width: 100% !important; padding: 5px;" multiple="multiple" id="<?php echo $id ?>" <?php echo ($required) ? 'required="required"' : ""; ?> <?php echo $isReadOnly; ?> >
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
                                            <select name="__<?php echo $meta['id'] ?>" id="<?php echo $id ?>" style="width: 100% !important; padding: 5px;" class="populate <?php echo ($required) ? "required": ""; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> >
                                                <?php if(!empty($option_value)) { foreach ($option_value as $option_key => $option) { ?>
                                                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $(".form-group.col-lg-6 #Signing_Rate").val("35");
                                                $("#<?php echo $id; ?>").select2();
                                            });
                                        </script>
                                    <?php 
                                    } 
                                    else 
                                    { ?>
                                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                            <label for="<?php echo $id ?>"><?php echo $meta['name']; echo ($required) ? " *" : ""; ?></label>
                                            <input name="__<?php echo $meta['id'] ?>" type="<?php echo $type; ?>" <?php echo ($required) ? 'required="required"' : ""; ?> class="form-control <?php echo ($required) ? "required": ""; ?>" id="<?php echo $id ?>" placeholder="Enter <?php echo $placeholder ?>">
                                        </div>
                                    <?php   
																		}

                                }
                            ?>

                            <div class="clearfix"></div>
                            <hr/>
                            <div style="text-align:right">
                                <button type="button" id="add_contract_btn" class="btn btn-success" style="margin:0 15px 15px;"> <i class="fas fa-plus" style="margin-right:8px;"></i> Add Record </button>
                            </div>
                        </form>

                    </div>
                </section>

            </div>
        </div>
        <!-- Modal Open -->
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

<script>
var serviceType = $('.col-lg-6 .multi-select');
var base_url = "<?php echo base_url(); ?>";
var time = "<?php echo dechex( time() - mktime(0, 0, 0, 0, 0, 2017) ); ?>";
var clientId = "<?php echo $clientId?>";

    function get_data(client_id)
    {
       // alert(client_id);
        console.log(client_id);
        $.ajax({
            url:  '<?php echo base_url()."modules/getClientById"; ?>',
            type: "POST",
            data: { "client_id": client_id},
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
                $("#Contract_Number").val();
                $("#Signing_Rate").val(signing_rate);
                var array = result[1].value.split("____"); 
                if(array.length >0){
                for(var i = 0 ;i<array.length; i++){
                    var newOption = new Option(array[i], array[i], true, true);
                   // serviceType.append(newOption).trigger('change');
                   $('#Service_Type option[value="'+array[i]+'"]').prop('selected', true);
                   $('#Service_Type').select2();
                    //$("#Service_Type").val(array[i]);
                    }
                }else{
                    if(result[1].value!= ""){
                    var newOption = new Option(result[1].value, result[1].value, true, true);}
                    console.log("test boy22",newOption);
                    $('#Service_Type option[value="'+array[i]+'"]').prop('selected', true);
                    $('#Service_Type').select2();
                //    $("#Service_Type").val(newOption);
                }
            }   
        });
    }

	$(document).ready(function(){
            var reqlength1 = $(".required");
            for(var i = 0; i < reqlength1.length; i++){
                $(reqlength1[i]).css('border', '1px solid blue'); 
            }
		if("<?php echo $current_module; ?>"=="Clients")
		{
            //alert(time);

            $("#Contract_Number").val();
            console.log("current module=<?php echo $current_module; ?>");
            $('#Client_Number').parent().css('display', 'none');
            $('#Contract_Client').parent().css('display', 'none');;
			//alert(clientId);
            $('#Client_Name').val(clientId);
            $('#Client_Name').trigger('change');
            get_data($("#Client_Name").val());	
			
            $("#Client_Name").on("change",function()
			{	var client_id = $(this).val();
				get_data(client_id);				
			});

		}		
        $("#add_contract_btn").click(function(){
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

                if("<?php echo $current_module; ?>"=="Contracts" || "<?php echo $_GET['add']; ?>"=="addContract"){
                    
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
                $("#addContract").submit();
            });
        }
	});    
});           

</script>
