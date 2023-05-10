<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">

<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>


<style type="text/css">
    .flex_row {display:flex; display:-webkit-flex; flex-wrap:wrap;}
    header .title {float:left; width:75%; text-align:left; padding:15px 0;}
    .icons-plot {float:right; width:25%; text-align:right; padding:9px 15px;}
    .icons-plot .icon {display:inline-block; border-radius:52px; width:37px; height:37px; line-height:37px; text-align:center; font-size:16px; cursor:pointer; position:relative; user-select:none; background:#fff; border:0; letter-spacing:.5px;}
    .icons-plot .icon:hover {background:#f5f5f5;}
    .icons-plot .icon i {color:#5f6368;}
    .icons-plot .hover-title {position:absolute; bottom:-22px; left:-6px; color:#fff; padding:4px 10px; line-height:normal; font-size:14px; background:#5f6368; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
    .icons-plot .icon:hover .hover-title {bottom:-30px; opacity:1;}
    .new-layout header:before, .new-layout header:after {content:''; display:table; clear:both;}
    .select2-container .select2-selection--single {height:35px;}
</style>

<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-7" style="margin-left:100px;">
                <form role="form" action="" method="post" onsubmit="return verify();">
                    <section class="panel new-layout">
                        <header style="margin:-20px -20px 30px; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                            <a class="btn header-back-btn" href="<?php echo base_url() ?>activities/"> <i class="fas fa-arrow-left"></i> </a>
                            <div class="title">
                                <h4 style="font-weight:400; letter-spacing:1px;">Add Activity</h4>
                            </div>
                            <div class="icons-plot">
                                <button type="submit" class="icon add-activity">
                                    <i class="fas fa-plus"></i>
                                    <span class="hover-title" style="width:110px; margin-left:-31px;">Add Activity</span>
                                </button>
                            </div>
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

                            <input type="hidden" name="record_id" id="record_id"/>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="assigned_officer_id">Assigned Officer *</label>
                                    <select name="assigned_officer_id" id="assigned_officer_id" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                        <?php foreach ($users_list as $option_key => $option) { ?>
                                            <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr/>

                            <div class="row flex_row">
                                <div class="form-group col-xs-6">
                                    <label for="module_id">Related With</label>
                                    <select onchange="activateModuleRecords();" name="module_id" id="module_id" style="width: 100% !important; padding: 5px;" class="populate">
                                        <option value="">None</option>
                                        <option value="<?php echo LEADS; ?>"><?php echo LEADS_PLURAL_NAME ?></option>
                                        <option value="<?php echo CLIENTS; ?>"><?php echo CLIENTS_PLURAL_NAME ?></option>
                                        <option value="<?php echo CONTRACTS; ?>"><?php echo CONTRACTS_PLURAL_NAME ?></option>
                                    </select>
                                </div>

                                <div id="<?php echo LEADS ?>_div" class="form-group col-xs-6" style="display:none;">
                                    <label for="leads"><?php echo LEADS_PLURAL_NAME ?> Lists</label>
                                    <select onchange="addRecordId('leads')" name="leads" style="width: 100% !important; padding: 5px;" id="leads">
                                        <option value="">Please select a Lead</option>
                                        <?php foreach ($active_leads_list as $lead_id => $lead) { ?>
                                            <option value="<?php echo $lead_id; ?>"><?php echo $lead['first_name'] . " " . $lead['last_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div id="<?php echo CLIENTS ?>_div" class="form-group col-xs-6" style="display:none;">
                                    <label for="clients"><?php echo CLIENTS_PLURAL_NAME ?> Lists</label>
                                    <select onchange="addRecordId('clients')" name="clients" style="width: 100% !important; padding: 5px;" id="clients">
                                        <option value="">Please select a Client</option>
                                        <?php foreach ($active_clients_list as $client_id => $client) { ?>
                                            <option value="<?php echo $client_id; ?>"><?php echo $client['client_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div id="<?php echo CONTRACTS ?>_div" class="form-group col-xs-6" style="display:none;">
                                    <label for="contracts"><?php echo CONTRACTS_PLURAL_NAME ?> Lists</label>
                                    <select onchange="addRecordId('contracts')" name="contracts" style="width: 100% !important; padding: 5px;" id="contracts">
                                        <option value="">Please select a Contract</option>
                                        <?php foreach ($active_contracts_list as $contract_id => $contract) { ?>
                                            <option value="<?php echo $contract_id; ?>"><?php echo $contract['contract_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-xs-12"></div>

                                <div class="form-group col-xs-6">
                                    <label for="title">Activity Title *</label>
                                    <input name="name" type="text" class="form-control" id="title" placeholder="Enter Activity Title" required="required">
                                </div>

                                <div class="form-group col-xs-6">
                                    <label for="type">Activity Type *</label>
                                    <select name="type" id="type" style="width: 100% !important; padding: 5px;" class="populate" required="required">
                                        <option value="Task">Task</option>
                                        <option value="Call">Call</option>
                                        <option value="Event">Event</option>
                                    </select>
                                </div>

                                <div class="form-group col-xs-6">
                                    <label for="due_date">Due Date *</label>
                                    <input name="due_date" type="date" required="required" class="form-control" id="due_date" placeholder="Enter Activity Due Date">
                                </div>

                                <div class="form-group col-xs-6">
                                    <label for="status">Status *</label>
                                    <select name="status" id="status" style="width: 100% !important; padding: 5px;" class="populate" required="required">
                                        <option value="Not Started">Not Started</option>
                                        <option value="Deferred">Deferred</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Waiting for input">Waiting for input</option>
                                    </select>
                                </div>

                                <div class="form-group col-xs-6">
                                    <label for="priority">Priority *</label>
                                    <select name="priority" id="priority" style="width: 100% !important; padding: 5px;" class="populate" required="required">
                                        <option value="High">High</option>
                                        <option value="Highest">Highest</option>
                                        <option value="Low">Low</option>
                                        <option value="Lowest">Lowest</option>
                                        <option value="Normal">Normal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer" style="padding-bottom:0;">
                                <button type="submit" class="btn btn-success">
                                    Add Activity
                                </button>
                            </div>

                        </div>
                    </section>
                </form> 

            </div>
        </div>
    </section>
</section>
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
