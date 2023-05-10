<style type="text/css">
    .flex-row {display:flex; display:-webkit-flex; flex-wrap:wrap;}
    .form-group div {padding-left:0 !important; background:white !important; border:none !important;}
    label{border-bottom:1px solid #e2e2e4 !important; display:block !important;}
    .form-group {margin-bottom:10px;}
    header .title {float:left; width:75%; text-align:left; padding:15px 0;}
    .icons-plot {float:right; width:25%; text-align:right; padding:9px 15px;}
    .icons-plot .icon {display:inline-block; border-radius:52px; width:37px; height:37px; line-height:37px; text-align:center; font-size:16px; cursor:pointer; position:relative; user-select:none; background:#fff; border:0; letter-spacing:.5px;}
    .icons-plot .icon:hover {background:#f5f5f5;}
    .icons-plot .icon i {color:#5f6368;}
    .icons-plot .hover-title {position:absolute; bottom:-22px; left:-6px; color:#fff; padding:4px 10px; line-height:normal; font-size:14px; background:#5f6368; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
    .icons-plot .icon:hover .hover-title {bottom:-30px; opacity:1;}
    .new-layout header:before, .new-layout header:after {content:''; display:table; clear:both;}
    .tab-title {font-size:14px; margin-bottom:25px; border-bottom:1px solid #ccc; font-weight:bold; color:#1fb5ad;}
    .tab-title span {position:relative; padding-bottom:7px; display:inline-block;}
    .tab-title span:before {content:''; border:1.5px solid; display:inline-block; width:100%; position:absolute; bottom:-1px; border-radius:3px 3px 0 0; background:#1fb5ad;}
    .details p {background:#f5f5f5; padding:6px; border-radius:5px; margin-top:5px;}
    .details p:empty:after {content:'-';}

    .modal-footer .btn {background:#1eb5ad; color:#fff;}
    .modal-footer .btn:hover, .modal-footer .btn:focus {background:#129e97;}

</style>

<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-7" style="margin-left:100px;">
                <section class="panel new-layout">
                    <header style="margin:-20px -20px 30px; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                        <a class="btn header-back-btn" href="<?php echo base_url() ?>activities/"> <i class="fas fa-arrow-left"></i> </a>
                        <div class="title">
                            <h4 style="font-weight:400; letter-spacing:1px;">View Activity</h4>
                        </div>
                        <div class="icons-plot">
                            <a class="icon edit-activity" href="<?php echo base_url() ?>activities/editRecord/?id=<?php echo $id ?>">
                                <i class="fas fa-edit"></i>
                                <span class="hover-title" style="width:110px; margin-left:-31px;">Edit Activity</span>
                            </a>
                        </div>
                    </header>
                    <div class="panel-body">

                        <div class="tab-title" style="margin-bottom:10px;">
                            <span> Activity Overview </span>
                        </div>

                        <div class="row" style="line-height:25px;">
                            <div class="col-sm-6">
                                <strong>Created By :</strong>
                                <span><?php echo $record_data["created_by_name"]; ?></span>                                
                            </div>
                            <div class="col-sm-6">
                                <strong>Created Time :</strong>
                                <span><?php echo date("m/d/Y", $record_data["created_time"]); ?></span>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:40px; line-height:25px;">
                            <div class="col-sm-6">
                                <strong>Modified By :</strong>
                                <?php if ($record_data["modified_time"] != NULL) { ?>
                                    <span><?php echo $record_data["modified_by_name"]; ?></span>
                                <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                            </div>
                            <div class="col-sm-6">
                                <strong>Modified Time :</strong>
                                <?php if ($record_data["modified_time"] != NULL) { ?>
                                    <span><?php echo date("m/d/Y", $record_data["modified_time"]); ?></span>
                                <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                            </div>
                        </div>

                        <!-- <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="contracts">Associated <?php echo $record_data["module_name"] ?></label>
                            <div class="col-lg-6">
                                <a class="list_link" href="<?php echo base_url() ?>index.php/modules/viewRecord/?cm=<?php echo $record_data["module_name"]; ?>&id=<?php echo $record_data["record_id"]; ?>&record_status=<?php echo $record_data["record_status"]; ?>">
                                    <span><?php echo $record_data["record_title"]; ?></span>
                                </a>
                            </div>
                        </div> -->


                        <div class="tab-title">
                            <span> Activity details </span>
                        </div>


                        <div class="row flex-row details">
                            <div class="form-group col-xs-12 col-sm-6">
                                <strong for="assigned_officer_id">Assigned Officer :</strong>
                                <p><?php echo $record_data["assigned_officer_name"]; ?></p>
                            </div>

                            <div class="col-xs-12"></div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <strong>Activity Title</strong>
                                <p><?php echo $record_data["name"]; ?></p>
                            </div>
                            <div class="form-group col-xs-12 col-sm-6">
                                <strong>Activity Type</strong>
                                <p><?php echo $record_data["type"]; ?></p>
                            </div>
 
                            <div class="form-group col-xs-12 col-sm-6">
                                <strong>Due Date</strong>
                                <p><?php echo $record_data["due_date"]; ?></p>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <strong>Closed Date</strong>
                                <p><?php echo $record_data["closed_time"]; ?></p>
                            </div>
 
                            <div class="form-group col-xs-12 col-sm-6">
                                <strong>Status</strong>
                                <p><?php echo $record_data["status"]; ?></p>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6">
                                <strong>Priority</strong>
                                <p><?php echo $record_data["priority"]; ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="modal-footer" style="margin:0 -5px; padding:15px 20px 0;">
                                <a class="btn" href="<?php echo base_url() ?>activities/editRecord/?id=<?php echo $id ?>"> Edit Activity </a>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div>
    </section>
</section>
