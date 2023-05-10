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
</style>

<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-xs-7" style="margin-left:100px;">
                <section class="panel new-layout">
                    <header style="margin:-20px -20px 30px; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                        <a class="btn header-back-btn" href="<?php echo base_url() ?>holidays/"> <i class="fas fa-arrow-left"></i> </a>
                        <div class="title">
                            <h4 style="font-weight:400; letter-spacing:1px;">New Holiday</h4>
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

                        <form role="form" action="" method="post">
                          
                          <div class="row">
                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="title">Holiday Title *</label>
                                <input name="name" type="text" class="form-control" id="title" placeholder="Enter Holiday Title" required="required">
                            </div>                       

                            <div class="form-group col-xs-12 col-sm-6">
                                <label for="due_date">Date *</label>
                                <input name="date" type="date" required="required" class="form-control" id="due_date" placeholder="Enter Holiday Date">
                            </div>
                          </div>

                          <div style="padding-top:15px; border-top:1px solid #ddd; text-align:right; margin-top:20px;">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-plus icon-left"></i> Add </button>
                          </div>
                            
                        </form>

                    </div>
                </section>

            </div>
        </div>
    </section>
</section>
<script type="text/javascript">
    $(document).ready(function() {
     
    });



</script>
