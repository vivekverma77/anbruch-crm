<?php
$calendarJobs = !empty($calendarJobs) && !empty($calendarJobs[0]) ? $calendarJobs[0] : '';
$invitations = !empty($invitations) && !empty($invitations[0]) ? $invitations[0] : '';
//print_r($calendarJobs);
//print_r($invitations);
?>
<style>
#section1 #text {background-color: #faebd7; padding: 22px 15px;}
#section1 #text .col-12 {margin-top:20px;}
#text-field {text-align: center; background-color: #faebd7; padding: 15px; margin-top: 35px;}
/*site sheet */
#page_title {text-align:center; font-weight:700; color:#2a4054; margin-top:40px;}
#page_title span {border-bottom: 3px double;}
.box-container {background:#f1ffff;; border:1px solid #c4cbd0; margin:40px auto; max-width:740px;}
#site_header ul, .form-ul, .form_row {color:#2a4054; list-style:none; padding:0; margin:20px auto;} 
.form-ul li:not(:last-child), .form_row .col {margin-bottom:10px;}
.form-ul b, .form_row b {min-width:120px; display:inline-block; text-align:right; margin-right:5px;}
.form-ul input, .form-ul select, .form_row input, .form_row select {width:calc(100% - 130px); width:-webkit-calc(100% - 130px); -moz-calc(100% - 130px); -ms-calc(100% - 130px); -o-calc(100% - 130px); padding:3px; outline:none; line-height:inherit;}
#material_req, #fenceType {padding:0;}
#material_req table, #fenceType table {width:100%; text-align:center;}
#material_req table thead th, #fenceType table thead th {background:#2a4054; color:#fff;}
#material_req table th, #fenceType table th {text-align:center; padding:5px; width:50%;}
#material_req table th + th, #fenceType table th + th  {border-left:1px solid #999;}
#material_req table td, #fenceType table td {padding:5px;}
#material_req table td + td, #fenceType table td + td  {border-left:1px solid #999;}
#material_req table tr:nth-child(even), #fenceType table tr:nth-child(even) {background:#eee;}
#site-sheet-containter .row {margin-left:-15px; margin-right:-15px;}
#site-sheet-containter .col-6 {width:50%; float:left; padding:0 15px;}
#siteSheet #site_header ul li {padding-bottom: 10px;}
.alert-success {color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;}
.alert {padding: 4px;margin-bottom: 20px;border: 1px solid transparent; border-radius: 4px;}
.alert-danger {color: #a94442;background-color: #f2dede;border-color: #ebccd1;}
.alert-info {color: #31708f;background-color: #d9edf7;border-color: #bce8f1;}
</style>
<div id="site-sheet-containter">
    <div id="header" style="background:#1FB5AD; color:#fff;margin:0 auto;height: 100px;">

       <div style="padding-right:15px; padding-left:15px; display:inline-block; width:50%; box-sizing:border-box;">
           <img src="<?php echo FCPATH."static/images/anbruch-logo-2.png"; ?>" alt="company Logo" style="margin-top:20px;width:300px;">
       </div>
   </div> <!-- /#header -->
</div>
  <h1 id="page_title"><span>Calendar Event</span></h1> 
    <div id="siteSheet" class="container box-container" style="height:250px; padding-left:25px;">
        <div id="site_header" style="display:inline-block;">
            <div class="col-6" style="display:inline-block;">    
                <ul>
                    <li id="contractor"><b>Title :</b> <span class="field_data"><?php echo !empty($calendarJobs['title']) ? $calendarJobs['title'] : '';?></span></li>
                    <li id="jobName"><b>Start Date :</b> <span class="field_data"><?php echo !empty($calendarJobs['start_date']) ? date("m/d/Y",strtotime($calendarJobs['start_date'])) : '';?><?php echo !empty($calendarJobs['start_date']) ? ' '.date("H:i a",strtotime($calendarJobs['start_time'])) : '';?></span></li>
                    <li id="siteAddress"><b>End Date :</b> <span class="field_data"><?php echo !empty($calendarJobs['end_date']) ? date("m/d/Y",strtotime($calendarJobs['end_date'])) : ''; ?>
                    	<?php echo !empty($calendarJobs['end_time']) ? ' '.date("H:i a",strtotime($calendarJobs['end_time'])) : '';?></span>
                    </li>
                    <li id="cityZip"><b>All Day Event :</b> <span class="field_data"><?php echo !empty($calendarJobs['all_day']) && $calendarJobs['all_day']==1 ? 'Yes' : 'No';?></span></li>
                    <li id="cityZip"><b>Calendar :</b> <span class="field_data"><?php echo !empty($calendarJobs['calendar_name']) ? $calendarJobs['calendar_name'] : '';?></span></li>
                    <li id="cityZip"><b>Notes :</b> <span class="field_data"><?php echo !empty($calendarJobs['notes']) ? $calendarJobs['notes'] : '';?></span></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="material_req" class="container box-container">
     <div class="row">
        <table id="material_req_table" style="width:100%;">
            <thead>
                <tr>
                    <th colspan="3"> Guests</th>
                </tr>
            </thead>
            <tbody>
            	<?php if(!empty($invitations)){ 
            	  foreach ($invitations as $key => $value) { ?>
                 <tr>
                    <th style="text-align:right;"><?php echo strstr($value['sent_email'], '@', true);?> <span class="email-guest" style="font-weight: 100;color: #848484;font-size: 13px;"><?php echo !empty($value['sent_email']) ? '('.$value['sent_email'].')':'' ?></span>: </th>
                    <td style="border-left:none;text-align: left;" id="col-hight">
                  <?php if($value['status'] == 1){ ?>
                  	     <span class="status alert alert-info">Awaiting</span>
                  <?php }elseif ($value['status'] == 2){ ?>
                  	      <span class="status alert alert-success">Accepted</span>	
                  <?php }elseif ($value['status'] == 3){ ?>
                  	    <span class="status alert alert-danger">Declined</span>	
                   </td>
                </tr>
                <?php
                   }
                  }
                 }
                 ?>          
                  <!-- <tr class="data_row" id="material-row-1">
                    <td style=" text-align:right;border-left:none;">Status: </td>
                   <td style="border-left:none;text-align: left;"></td>
                 </tr> -->
                               
            </tbody>
        </table>       
    </div>
</div> 
