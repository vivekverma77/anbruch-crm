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
    .modal-footer {text-align:right; margin-top:10px; padding:15px 0 0; border-color:#1eb5ad;}
    .modal-footer .btn {background:#1eb5ad; color:#fff;}
    .modal-footer .btn:hover, .modal-footer .btn:focus {background:#129e97;}
</style>

<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-xs-7" style="margin-left:100px;">
                <form role="form" action="" method="post" onsubmit="return verify();">
                    <section class="panel new-layout">
                        <header style="margin:-20px -20px 30px; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                            <a class="btn header-back-btn" href="<?php echo base_url() ?>activities/"> <i class="fas fa-arrow-left"></i></a>
                            <div class="title">
                                <h4 style="font-weight:400; letter-spacing:1px;">Update Activity</h4>
                            </div>
                            <div class="icons-plot">
                                <button type="submit" class="icon add-activity">
                                    <i class="fas fa-check"></i>
                                    <span class="hover-title" style="width:130px; margin-left:-41px;">Update Activity</span>
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

                                <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
                                <input type="hidden" name="record_id" id="record_id" value="<?php echo $record_data["record_id"]; ?>"/>
                                <div class="row">
                                    <div class="form-group col-xs-6">
                                        <label for="assigned_officer_id">Assigned Officer *</label>
                                        <select name="assigned_officer_id" id="assigned_officer_id" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                            <?php foreach ($users_list as $option_key => $option) { ?>
                                                <option <?php echo ($record_data["assigned_officer_id"] == $option['id']) ? 'selected="selected"' : ""; ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
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
                                            <option <?php echo ($record_data["module_id"] == LEADS) ? 'selected="selected"' : ""; ?> value="<?php echo LEADS; ?>"><?php echo LEADS_PLURAL_NAME ?></option>
                                            <option <?php echo ($record_data["module_id"] == CLIENTS) ? 'selected="selected"' : ""; ?> value="<?php echo CLIENTS; ?>"><?php echo CLIENTS_PLURAL_NAME ?></option>
                                            <option <?php echo ($record_data["module_id"] == CONTRACTS) ? 'selected="selected"' : ""; ?> value="<?php echo CONTRACTS; ?>"><?php echo CONTRACTS_PLURAL_NAME ?></option>
                                        </select>
                                    </div>

                                    <div id="<?php echo LEADS ?>_div" class="form-group col-xs-6" style="display:none;">
                                        <label for="leads"><?php echo LEADS_PLURAL_NAME ?> Lists</label>
                                        <select onchange="addRecordId('leads')" name="leads" style="width: 100% !important; padding: 5px;" id="leads">
                                            <option value="">Please select a Lead</option>
                                            <?php foreach ($active_leads_list as $lead_id => $lead) { ?>
                                                <option <?php echo ($record_data["record_id"] == $lead_id) ? 'selected="selected"' : ""; ?> value="<?php echo $lead_id; ?>"><?php echo $lead['first_name'] . " " . $lead['last_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div id="<?php echo CLIENTS ?>_div" class="form-group col-xs-6" style="display:none;">
                                        <label for="clients"><?php echo CLIENTS_PLURAL_NAME ?> Lists</label>
                                        <select onchange="addRecordId('clients')" name="clients" style="width: 100% !important; padding: 5px;" id="clients">
                                            <option value="">Please select a Client</option>
                                            <?php foreach ($active_clients_list as $client_id => $client) { ?>
                                                <option <?php echo ($record_data["record_id"] == $client_id) ? 'selected="selected"' : ""; ?> value="<?php echo $client_id; ?>"><?php echo $client['client_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div id="<?php echo CONTRACTS ?>_div" class="form-group col-xs-6" style="display:none;">
                                        <label for="contracts"><?php echo CONTRACTS_PLURAL_NAME ?> Lists</label>
                                        <select onchange="addRecordId('contracts')" name="contracts" style="width: 100% !important; padding: 5px;" id="contracts">
                                            <option value="">Please select a Contract</option>
                                            <?php foreach ($active_contracts_list as $contract_id => $contract) { ?>
                                                <option <?php echo ($record_data["record_id"] == $contract_id) ? 'selected="selected"' : ""; ?> value="<?php echo $contract_id; ?>"><?php echo $contract['contract_name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-12"></div>

                                    <div class="form-group col-xs-6">
                                        <label for="title">Activity Title *</label>
                                        <input value="<?php echo $record_data["name"] ?>" name="name" type="text" class="form-control" id="title" placeholder="Enter Activity Title" required="required">
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="type">Activity Type *</label>
                                        <select name="type" id="type" style="width: 100% !important; padding: 5px;" class="populate" required="required">
                                            <option <?php echo ($record_data["type"] == "Task") ? 'selected="selected"' : ""; ?> value="Task">Task</option>
                                            <option <?php echo ($record_data["type"] == "Call") ? 'selected="selected"' : ""; ?> value="Call">Call</option>
                                            <option <?php echo ($record_data["type"] == "Event") ? 'selected="selected"' : ""; ?> value="Event">Event</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="due_date">Due Date *</label>
                                        <input value="<?php echo $record_data["due_date"] ?>" name="due_date" type="date" required="required" class="form-control" id="due_date" placeholder="Enter Activity Due Date">
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="closed_time">Closed Date</label>
                                        <input value="<?php echo $record_data["closed_time"] ?>" name="closed_time" type="date" class="form-control" id="closed_time" placeholder="Enter Activity Closed Date">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="status">Status *</label>
                                        <select name="status" id="status" style="width: 100% !important; padding: 5px;" class="populate" required="required">
                                            <option <?php echo ($record_data["status"] == "Not Started") ? 'selected="selected"' : ""; ?> value="Not Started">Not Started</option>
                                            <option <?php echo ($record_data["status"] == "Deferred") ? 'selected="selected"' : ""; ?> value="Deferred">Deferred</option>
                                            <option <?php echo ($record_data["status"] == "In Progress") ? 'selected="selected"' : ""; ?> value="In Progress">In Progress</option>
                                            <option <?php echo ($record_data["status"] == "Completed") ? 'selected="selected"' : ""; ?> value="Completed">Completed</option>
                                            <option <?php echo ($record_data["status"] == "Waiting for input") ? 'selected="selected"' : ""; ?> value="Waiting for input">Waiting for input</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="priority">Priority *</label>
                                        <select name="priority" id="priority" style="width: 100% !important; padding: 5px;" class="populate" required="required">
                                            <option <?php echo ($record_data["priority"] == "High") ? 'selected="selected"' : ""; ?> value="High">High</option>
                                            <option <?php echo ($record_data["priority"] == "Highest") ? 'selected="selected"' : ""; ?> value="Highest">Highest</option>
                                            <option <?php echo ($record_data["priority"] == "Low") ? 'selected="selected"' : ""; ?> value="Low">Low</option>
                                            <option <?php echo ($record_data["priority"] == "Lowest") ? 'selected="selected"' : ""; ?> value="Lowest">Lowest</option>
                                            <option <?php echo ($record_data["priority"] == "Normal") ? 'selected="selected"' : ""; ?> value="Normal">Normal</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="submit" class="btn">Update Activity</button>
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

        var selectedDiv = <?php echo $record_data["module_id"] ?>;
        if (selectedDiv == "<?php echo LEADS ?>") {
            $("#<?php echo LEADS ?>_div").slideDown();
        } else if (selectedDiv == "<?php echo CLIENTS ?>") {
            $("#<?php echo CLIENTS ?>_div").slideDown();
        } else if (selectedDiv == "<?php echo CONTRACTS ?>") {
            $("#<?php echo CONTRACTS ?>_div").slideDown();
        }
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
