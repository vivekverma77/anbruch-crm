<!--
users cancel booking list
-->
<style>
.panel-heading, .panel-heading a {
    background-color: #1FB5AD !important;
    font-weight: 700;
    color: #FFF !important;
}
.panel-heading {
    border-color: #eff2f7;
    font-size: 13px;    
    text-transform: uppercase;
    padding: 15px;
}
div.dataTables_paginate ul {
padding: 0;
}
div.dataTables_paginate li {
display: inline-block;
padding-left: 10px;
}
div.dataTables_paginate li a {
background: #1fb5ad;
color: #fff;
padding: 5px 10px;
text-decoration: navajowhite;
border-radius: 4px;
}
div.dataTables_paginate li a:hover {
background: #999;
}
</style>
<!--dynamic table-->
<?php //echo '<pre>';print_r($bookings);die; ?>
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />

<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<section class="panel">
    <header class="panel-heading">Bookings List</header>
    <div class="panel-body">
        <?php if (isset($bookings) && count($bookings) > 0) { ?>
            <table class="display table table-bordered table-striped table-condensed" id="dynamic-table-bookings">
                <thead>
                <tr>
                    <th class="text-center">Sr No.</th>
                    <th class="text-center">Booking Date</th>
                    <th class="text-center">Booking Time</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>                    
                    <th class="text-center">Status</th>                    
                    <th class="text-center">Created By</th>
                    <th class="text-center">Created Time</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($bookings as $key => $booking) { 
									
									if($booking["status"]==0){  $info = 'info-warning'; }
									else if($booking["status"]==1){  $info = 'info-success'; }
									else if($booking["status"]==2){  $info = 'info-danger'; } 
									else {  $info = ''; } 
									
									?>
               
                    <tr class="tr_<?php echo $booking["id"]; ?>">                       
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo date("m/d/Y", strtotime($booking["booking_date"]));?></td>
                        <td class="text-center"><?php echo date("h:ia", strtotime($booking["booking_date"])); ?></td>
                        <td class="text-center"><?php echo $booking["name"]; ?></td>
                        <td class="text-center"><?php echo $booking["email"]; ?></td>
                        <td class="text-center"><span id="status<?php echo $booking["id"]; ?>" class="<?php echo $info; ?>"><?php echo $booking_status[$booking["status"]]; ?></span></td>
                        <td class="text-center"><?php echo $booking["first_name"].' '.$booking["last_name"]; ?></td>
                        <td class="text-center" ><?php echo date("m/d/Y", strtotime($booking["created_time"])); ?></td>
                        
                        <td class="text-center">
													<?php if($booking["status"]==0){  ?>                        
													<span style="background:#5cb85c;color:#fff" id="confirmbtn<?php echo $booking["id"]; ?>" class="<?php echo $info; ?>">
                                                        <input type="hidden" name="record_id" id="record_id<?php echo $booking["id"]; ?>" value="<?php echo $booking['record_id'] ?>">
                                                        <input type="hidden" name="email" id="email<?php echo $booking["id"]; ?>" value="<?php echo $booking['email'] ?>">                  
														<a href="javascript:;" style="text-decoration:none;background:#5cb85c;color:#fff" class="confirm_booking" data-id="<?php echo $booking["id"]; ?>">Confirm</a></span>
    
                                                    </td>
													<?php } ?>
                        </td>
                    </tr>
                  
                 <?php $i++;  } ?>
                
                </tbody>
            </table>
        <?php
        }
        else
        { ?>
            <h3 class="text-center" style="margin: 0;">No booking found.</h3>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dynamic-table-bookings').dataTable( {
            //"aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
        } );       
    } );
</script>
