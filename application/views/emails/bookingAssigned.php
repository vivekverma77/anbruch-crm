
<table style="background:#f8f9fa; width:100%; border-collapse:collapse;">
  <tr>
    <td>
      
      <table style="background:#fff; color:#474747; font-size:13px; width:600px; margin:70px auto; border-collapse:collapse;">

        <tr>
          <td style="border-top:70px solid #1fb5ad; padding-top:30px; text-align:center;">
           <img height="70" width="200" src="<?php echo base_url('assets/images/')?>logo-hd2.png">
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px; text-align:center;">
            <h3 style="letter-spacing:1.5px; color:#586571; margin-bottom:0; font-size:26px; font-weight:normal;"><?php echo $mainheading?></h3>
            <p style="margin-top:0; font-size:14px; color:#586571;"><?php echo $heading?></p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:40px auto 0; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Assigned Officer :</strong>
             <span><?php echo (isset($leadassignedofficer) && !empty($leadassignedofficer)) ? $leadassignedofficer : '' ?></span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Company Name :</strong>
             <span><?php echo (isset($company) && !empty($company)) ? $company:'' ?> </span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <?php if($current_module_id  == 1){ ?>
             <strong>Lead Name :</strong>
             <span><?php echo (isset($lead_name) && !empty($lead_name))? $lead_name :''?></span>
           <?php } else{?>
              <strong>Client Name :</strong>
             <span><?php echo (isset($client_name) && !empty($client_name))? $client_name :''?></span>
           <?php } ?>
            </p>
          </td>
        </tr>

        <?php if($current_module_id == 1) { ?>
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto ; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Business Type :</strong>
             <span><?php echo (isset($business_type) && !empty($business_type)) ? $business_type : '' ?></span>
            </p>
          </td>
        </tr>
      <?php } ?>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Title :</strong>
             <?php echo (isset($title) && !empty($title)) ? $title: '' ?>
            </div>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Email :</strong>
             <?php echo (isset($email) && !empty($email)) ? $email: '' ?>
            </div>
          </td>
        </tr>

        <?php if($current_module_id == 2){ ?>
          <tr>
            <td style="padding:0 25px;">
              <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
               <strong>Signing Rate :</strong>
               <?php echo (isset($signig_rate) && !empty($signig_rate)) ? $signig_rate: '' ?>
              </div>
            </td>
          </tr>
        <?php } ?>
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Booking Title :</strong>
             <?php echo (isset($booking_title) && !empty($booking_title)) ? $booking_title: '' ?>
            </div>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Booking Date :</strong>
             <?php echo (isset($booking_date) && !empty($booking_date)) ? $booking_date: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Booking Time :</strong>
             <?php echo (isset($booking_time) && !empty($booking_time)) ? $booking_time: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>End Date :</strong>
             <?php echo (isset($end_date) && !empty($end_date)) ? $end_date: '' ?>
            </div>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>End Time :</strong>
             <?php echo (isset($end_time) && !empty($end_time)) ? $end_time: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Notes :</strong>
             <?php echo (isset($notes) && !empty($notes)) ? $notes: '' ?>
            </div>
          </td>
        </tr>


          <td style="background:#f1f3f4; font-size:11px; padding:18px; text-align:center; border-bottom: 1px solid #d8d8d8;">
              <em>Copyright &copy;  Anbruch<?php echo date('Y')?> All rights reserved.</em>
          </td>
        </tr>
        
      </table>

    </td>
  </tr>
</table>