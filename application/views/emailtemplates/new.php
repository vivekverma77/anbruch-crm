<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">

<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>

<style type="text/css">
    .new-layout header:before, .new-layout header:after {content:''; display:table; clear:both;}
    header .title {float:left; width:75%; text-align:left; padding:15px 0;}
    .tab-title {margin:25px 0 15px;}
</style>
<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-xs-7" style="margin-left:100px;">
                <section class="panel new-layout">
                    <header style="margin:-20px -20px 0; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                        <a class="btn header-back-btn" href="<?php echo base_url() ?>emailtemplates/"> <i class="fas fa-arrow-left"></i> </a>
                        <div class="title">
                            <h4 style="font-weight:400; letter-spacing:1px;">New Template</h4>
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

                        <form role="form" action="" method="post" onsubmit="">
													
                            <input type="hidden" name="record_id" id="record_id"/>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <div class="tab-title"> <span>Notification Process *</span> </div>
                                    <input name="mode" type="text" class="form-control" id="mode" placeholder="Enter Notification Process" required="required">
                                    <!-- <select name="mode" id="mode" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                        <option value="">Select Mode</option>
                                        <?php if(!empty($modes)) { 
                                            foreach($modes as $key=>$mode) { 
                                                if(!in_array($key,$modes)) {
                                                ?>
                                        <option value="<?php echo $key; ?>"><?php echo ucwords(str_replace('_',' ',$mode)); ?></option> 
                                        <?php } } } ?>  
                                    </select> -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="tab-title"> <span>Module *</span> </div>
                                    <select name="module_id" id="module_id" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                        <option value="">Select Module</option>
                                        <option value="1">Leads</option>
                                        <option value="2">Client</option>
                                        <option value="3">Contract</option>
                                        <option value="4">Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="tab-title"> <span>Pipeline Stage</span> </div>
                                    <select name="pipeline_stage" id="pipeline_stage" style="width: 100% !important; padding: 5px;" class="populate">
                                        <option value="">Select pipeline stage</option>
                                        <option value="Prospect">Prospect</option>
                                        <option value="Qualify">Qualify</option>
                                        <option value="Develop">Develop</option>
                                        <option value="Propose">Propose</option>
                                        <option value="Close">Close</option>
                                        <option value="Technical">Technical</option>
                                        <option value="Invoiced">Invoiced</option>
                                        <option value="Paid">Paid</option>    
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="tab-title"> <span>Title *</span> </div>
                                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter Template Title" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <div class="tab-title"> <span>Direction *</span> </div>
                                    <select name="direction"class="form-control" id="direction" >
                                        <option>Select Direction</option>
                                        <option value="1">Internal</option>
                                        <option value="2">External</option>
                                     </select>   
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="form-group col-lg-12" style="min-height: 57px !important;">
                                    <div class="tab-title"> <span>Template *</span> </div>
                                    <textarea name="template" class="form-control" id="template" placeholder="Enter Template Description" required="required"></textarea>
                                </div>
                            </div>   
                            
                            <div class="text-right" style="border:0;">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-plus icon-left"></i> Add </button>
                            </div>
                        </form>

                    </div>
                </section>

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
    CKEDITOR.config.extraAllowedContent = 'iframe(*)';
    CKEDITOR.replace('template',{
        removePlugins : 'elementspath,save,link,tools,bidi,blockquote,colordialog,templates,copyformatting,format,horizontalrule,indentlist,list,newpage,preview',
        height: '250px',
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
        $("#pipeline_stage").select2();
        $("#type").select2();
        $("#status").select2();
        $("#priority").select2();
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
