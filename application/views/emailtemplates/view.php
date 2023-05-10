<style type="text/css">
    .form-group div{
        padding-left: 0 !important;
        background: white !important;
        border: none !important;
    }

    .form-group {
        margin-bottom: 10px;
    }
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
</style>
<?php //print_r($record_data); die("Nice"); ?>
<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-xs-7" style="margin-left:100px;">
                <section class="panel new-layout" style="width:107%;">
                    <header style="margin:-20px -20px 30px; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                        <a class="btn header-back-btn" href="<?php echo base_url() ?>emailtemplates/"> <i class="fas fa-arrow-left"></i> </a>
                        <div class="title">
                            <h4 style="font-weight:400; letter-spacing:1px;">View Template</h4>
                        </div>
                        <div class="icons-plot">
                            <a class="icon edit-template" href="<?php echo base_url() ?>emailtemplates/editRecord/?id=<?php echo $id ?>">
                                <i class="fas fa-edit"></i>
                                <span class="hover-title" style="width:120px; margin-left:-37px;">Edit Template</span>
                            </a>
                        </div>
                    </header>
                    <div class="panel-body">

                        <div class="tab-title" style="margin-bottom:10px;">
                            <span> Template overview </span>
                        </div>

                        <div class="row" style="margin-bottom:20px;">
                            <div class="col-xs-6">
                                <label for="assigned_officer_id">Created By</label>
                                <span><?php echo $record_data['first_name'] . " " . $record_data['last_name']; ?></span>
                            </div>
                            <div class="col-xs-6">
                                <label for="assigned_officer_id">Created Time</label>
                                <span><?php echo date("m/d/Y", strtotime($record_data["created_time"])); ?></span>
                            </div>

                            <div class="col-xs-6">
                                <label for="assigned_officer_id">Modified By</label>
                                <?php if ($record_data["modified_time"] != NULL) { ?>
                                    <span><?php echo $record_data['first_name'] . " " . $record_data['last_name']; ?></span>
                                <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                            </div>
                            <div class="col-xs-6">
                                <label for="assigned_officer_id">Modified Time</label>
                                <?php if ($record_data["modified_time"] != NULL) { ?>
                                <span><?php echo date("m/d/Y", strtotime($record_data["modified_time"])); ?></span>
                                <?php } else { ?><span>Not Modified Yet</span><?php } ?>
                            </div>
                        </div>

                        <div class="tab-title">
                            <span>Template Details</span>
                        </div>                        

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="type">Notification Process</label>
                                <span><?php echo $record_data["slug_name"]; ?></span>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="status">Status</label>
                                <span><?php if($record_data["status"]==1) { echo 'Active'; }else { echo 'Inactive'; }; ?></span>
                            </div>                    
                            
                            <div class="form-group col-xs-12">
                                <label for="contracts">Title</label>
                                <a href="javascript:;" style="color:#1fb5ad;">
                                    <span><?php echo $record_data["title"]; ?></span>
                                </a>
                            </div>
                            
                            <div class="form-group col-xs-12">
                                <label for="title">Template</label>
                                <div class="col-xs-12"><span><?php echo $record_data["template"]; ?></span></div>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div>
    </section>
</section>
