<!--calendar css-->
<link href="<?php echo base_url() ?>static/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />

<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>

<link href="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.css"  rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>static/js/multiselect/jquery.multiselect.js"></script>

<style> 
#editClassSchedule .modal-content { 
    box-shadow: none;
    border: none;
    width: 800px;
    min-height: 500px;
    left: -100px;
}
.fc-event {
    border-style: none;
    cursor: pointer;
	}
	.service-box label {
   font-weight: 600;
   font-family: 'Open Sans',sans-serif;
   font-size: 1.6rem;
   color: #000;
   width: 35%;
}
.service-box span {
   font-size: 1.6rem;
   margin-bottom: 8px;
   display: inline-block;
}
.hr-4{
		border-top: 4px solid #1FB5AD;
	}
	
	.reassign button {
   padding: 0px 6px;
    font-size: 12px;
    margin-left: 5px;
}
.modal-backdrop + .modal-backdrop + .modal-backdrop.fade.in {
	z-index: 1050;
}
.modal.in + .modal.in + .modal.in {
	z-index: 1052;
}
</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        
        <?php $this->load->view('common/alert'); ?>
        
        <section class="panel">
            <div class="panel-body">
                <!-- page start-->
                <div class="row">
									
                    <aside class="col-lg-12">
                        <div id="calendar" class="has-toolbar"></div>
                    </aside>                   
                    
                </div>
                <!-- page end-->
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<script src="<?php echo base_url() ?>static/js/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>static/js/fullcalendar/moment.min.js"></script>
<!--main content end-->
<script type="text/javascript">
	 $('#calendar').fullCalendar({
			header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay',              
				}
		});		
</script>
