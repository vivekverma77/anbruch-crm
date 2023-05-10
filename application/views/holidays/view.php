<style type="text/css">
    .form-group div{
        padding-left: 0 !important;
        background: white !important;
        border: none !important;
    }

    label{
        border-bottom: 1px solid #e2e2e4 !important;
        display: block !important;
    }

    .form-group {
        margin-bottom: 10px;
    }
</style>

<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <a class="module_head" href="<?php echo base_url() ?>index.php/activities/">View All Activity</a>
                        <div style="float: right;">
                            <a class="module_head" href="<?php echo base_url() ?>index.php/activities/editRecord/?id=<?php echo $id ?>">Edit Activity</a>
                        </div>
                    </header>
                    <div class="panel-body">
                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="assigned_officer_id">Assigned Officer</label>
                            <div class="col-lg-6"><span><?php echo $record_data["assigned_officer_name"]; ?></span></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="assigned_officer_id">Created By</label>
                            <div class="col-lg-6"><span><?php echo $record_data["created_by_name"]; ?></span></div>
                        </div>
                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="assigned_officer_id">Created Time</label>
                            <span><?php echo date("m/d/Y", $record_data["created_time"]); ?></span>
                        </div>
                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="assigned_officer_id">Modified By</label>
                            <?php if ($record_data["modified_time"] != NULL) { ?>
                                <span><?php echo $record_data["modified_by_name"]; ?></span>
                            <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                        </div>
                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="assigned_officer_id">Modified Time</label>
                            <?php if ($record_data["modified_time"] != NULL) { ?>
                                <span><?php echo date("m/d/Y", $record_data["modified_time"]); ?></span>
                            <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <hr/>

                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="contracts">Associated <?php echo $record_data["module_name"] ?></label>
                            <div class="col-lg-6">
                                <a class="list_link" href="<?php echo base_url() ?>index.php/modules/viewRecord/?cm=<?php echo $record_data["module_name"]; ?>&id=<?php echo $record_data["record_id"]; ?>&record_status=<?php echo $record_data["record_status"]; ?>">
                                    <span><?php echo $record_data["record_title"]; ?></span>
                                </a>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="title">Activity Title</label>
                            <div class="col-lg-6"><span><?php echo $record_data["name"]; ?></span></div>
                        </div>

                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="type">Activity Type</label>
                            <div class="col-lg-6"><span><?php echo $record_data["type"]; ?></span></div>
                        </div>

                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="due_date">Due Date</label>
                            <div class="col-lg-6"><span><?php echo $record_data["due_date"]; ?></span></div>
                        </div>

                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="closed_time">Closed Date</label>
                            <div class="col-lg-6"><span><?php echo $record_data["closed_time"]; ?></span></div>
                        </div>

                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="status">Status</label>
                            <div class="col-lg-6"><span><?php echo $record_data["status"]; ?></span></div>
                        </div>

                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label for="priority">Priority</label>
                            <div class="col-lg-6"><span><?php echo $record_data["priority"]; ?></span></div>
                        </div>

                        <div class="clearfix"></div>
                        <hr/>
                    </div>
                </section>

            </div>
        </div>
    </section>
</section>
