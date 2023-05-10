<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">

<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>

<style type="text/css">
    header .title {
        float: left;
        width: 75%;
        text-align: left;
        padding: 15px 0;
    }
    .new-layout header:before, .new-layout header:after {
        content: '';
        display: table;
        clear: both;
    }
    .tab-title {margin:25px 0 15px;}
</style>
<section id="main-content">
        <section class="wrapper">
            <div class="row">

            <div class="col-xs-7" style="margin-left:100px;">
            <form role="form" action="" method="post" onsubmit="">
                <section class="panel new-layout">
                    <header style="margin:-20px -20px 0; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                        <a class="btn header-back-btn" href="<?php echo base_url() ?>emailtemplates/"> <i class="fas fa-arrow-left"></i> </a>
                        <div class="title">
                            <h4 style="font-weight:400; letter-spacing:1px;">Edit Template</h4>
                        </div>
                        <div class="icons-plot">
                            <button type="submit" class="icon add-activity">
                                <i class="fas fa-save"></i>
                                <span class="hover-title" style="margin-left:-10px;">Update</span>
                            </button>

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
                                                <?php //echo '<pre>';print_r($record_data);die; ?>          
													
                            <input type="hidden" name="record_id" id="record_id" value="<?php echo $record_data['id']; ?>">
                            
                            <div class="row">

                                <div class="form-group col-xs-12">
                                    <div class="tab-title"> <span>Notification Process *</span> </div>
                                    <input name="mode" type="text" class="form-control" id="mode" placeholder="Enter Notification Process" required="required" value="<?php echo ucwords(str_replace('_',' ',$record_data['slug'])); ?>" />
                                    <!-- <select name="mode" id="mode" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                        <option value="">Select Mode</option>
                                        <?php if(!empty($modes)) { 
                                            foreach($modes as $key=>$mode) { 
                                                if(!in_array($key,$modes)) {
                                                    if($key === $record_data['slug']){ 
                                                    ?>
                                                    <option value="<?php echo $key; ?>" selected><?php echo ucwords(str_replace('_',' ',$mode)); ?></option>
                                                    <?php }else{  
                                                    ?>
                                                    <option value="<?php echo $key; ?>"><?php echo ucwords(str_replace('_',' ',$mode)); ?></option> 
                                        <?php } } } } ?>  
                                    </select> -->
                                </div>

                                <!-- <div class="form-group col-xs-12">
                                    <div class="tab-title"> <span>Notification Process *</span> </div>
                                    <input type="text" class="form-control" name="notification_process" value="<?php echo $modes[$record_data["slug"]]; ?>" >
                                     -->
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <div class="tab-title"> <span>Module *</span> </div>
                                        <select name="module_id" id="module_id" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                            <option value="">Select Module</option>
                                            <?php if(!empty($module_ids)) { 
                                                foreach($module_ids as $key=>$value) { 
                                                    if(!in_array($key,$module_ids)) {
                                                        if($key == $record_data['module_id']){ 
                                                        ?>
                                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                                        <?php }else{  
                                                        ?>
                                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option> 
                                            <?php } } } } ?>  
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <div class="tab-title"> <span>Pipeline Stage</span> </div>
                                        <select name="pipeline_stage" id="pipeline_stage" style="width: 100% !important; padding: 5px;" class="populate">
                                            <option value="">Select Pipeline stage</option>
                                             <?php 
                                             $pipeline=['Prospect','Qualify','Develop','Propose','Close','Technical','Invoiced','Paid'];
                                             
                                                foreach($pipeline as $key=>$value) { 
                                                     if($value == $record_data['pipeline_stage']){  ?>
                                                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                                                        <?php }
                                                        else{  
                                                        ?>
                                                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
                                            <?php } } ?>  
                                             
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                <div class="form-group col-xs-12">
                                    <div class="tab-title"> <span>Title *</span> </div>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter Template Title" required="required" value="<?php echo $record_data['title']; ?>" >
                                </div>
                                </div>
                                 <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="tab-title"> <span>Direction *</span> </div>
                                    <select name="direction"class="form-control" id="direction" >
                                        <?php 
                                        if($record_data['direction'] == 1)
                                        {   $internal = "selected"; }else{
                                           $internal = ""; 
                                        }
                                        if($record_data['direction'] == 2)
                                        {   $External = "selected"; }else{
                                           $External = ""; 
                                        }
                                        ?>
                                        <option>Select Direction</option>
                                        <option <?php echo $internal;?> value="1">Internal</option>
                                        <option <?php echo $External;?> value="2">External</option>
                                     </select>   
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-xs-12">
                                    <div class="tab-title"> <span>Template *</span> </div>
                                    <textarea name="template" class="form-control" id="template" placeholder="Enter Template Description" required="required"><?php echo $record_data['template']; ?></textarea>
                                </div>   
                            </div>

                            <div style="padding-top:15px; text-align:right;">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save icon-left"></i> Update </button>
                            </div>

                    </div>
                </section>
                </form>

            </div>
        </div>
    </section>
</section>
<style>
.cke_inner { 
    border: 1px solid #e2e2e4;
}
</style>
<script src="https://cdn.ckeditor.com/4.7.3/full/ckeditor.js"></script> 
<script> 
    CKEDITOR.config.allowedContent = true;          	
	CKEDITOR.replace('template',{
		height: '500px',
		removePlugins : 'elementspath,save,link,tools,bidi,blockquote,colordialog,templates,copyformatting,format,horizontalrule,indentlist,list,newpage,preview',
        resize_enabled : true,
				});
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#assigned_officer_id").select2();
        $("#leads").select2();
        $("#clients").select2();
        $("#contracts").select2();
        $("#module_id").select2();
        $("#type").select2();
        $("#status").select2();
        $("#priority").select2();

        /*$("#mode").on("change",function()
        {
            var slug = $(this).val();
            $.ajax({
                url:  '<?php //echo base_url()."emailtemplates/getTemplateBySlug"; ?>',
                type: "POST",
                data: { "slug":slug },
                beforeSend: function() {
                    $("#subject").val("");
                    CKEDITOR.instances['template'].setData("");
                },
                success: function(result)
                {
                    //console.log(result);
                    var result =JSON.parse(result);
                    //console.log(result);

                    var title = result.title;
                    var template = result.template;
                    //console.log(title);
                    $("#title").val(title);
                    
                    CKEDITOR.instances['template'].setData(template);        
            
                }   
            });
            
            
        });*/
    });

    function activateModuleRecords(){
        var selectedDiv = $("#module_id").val();
        $("#<?php echo LEADS ?>_div").hide();
        $("#<?php echo CLIENTS ?>_div").hide();
        $("#<?php echo CONTRACTS ?>_div").hide();
        $("#record_id").val("");

        if (selectedDiv == "<?php echo LEADS ?>") {
            $("#<?php echo LEADS ?>_div").slideDown();
        } else if (selectedDiv == "<?php echo CLIENTS ?>") {
            $("#<?php echo CLIENTS ?>_div").slideDown();
        } else if (selectedDiv == "<?php echo CONTRACTS ?>") {
            $("#<?php echo CONTRACTS ?>_div").slideDown();
        }
    }

    function addRecordId(e){
        $("#record_id").val($("#" + e).val());
    }

    function verify(){
        if ($("#module_id").val() != '' && $("#record_id").val() == '') {
            alert("You must select a record to associate with this task.");
            return false;
        }

        return true;
    }
</script>
