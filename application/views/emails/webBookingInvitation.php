<style>
  a#red:hover {
    background: #ff0000a6 !important;
    color: #fff !important;
}
a#yellow:hover {
    background: #ff9800 !important;
    color: #fff !important;
}
</style>
<table style="background:#f8f9fa; width:100%; border-collapse:collapse;">
  <tr>
    <td>
      
      <table style="background:#fff; color:#474747; font-size:13px; width:600px; margin:70px auto; border-collapse:collapse;">

        <tr>
          <td style="border-top:70px solid #fe832c; padding-top:30px; text-align:center;">
            <img src="<?php echo base_url(); ?>/static/images/logo-f2-blue.png" style="margin-left:0px;">
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px; text-align:center;">
            <h3 style="letter-spacing:1.5px; color:#586571; margin-bottom:0; font-size:26px; font-weight:normal;">Booking Invitation</h3>
            
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:2px dashed gray; margin:40px auto 0; width:75%; padding:11px 10px 5px;font-size:16px;letter-spacing:0.3px;">
             <strong>Call Details :</strong>
             </p>
          </td>
        </tr>
        
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;margin-top:10px;">
             <strong>Date :</strong>
             <?php echo !empty($booking_date) ? $booking_date : ''; ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Time :</strong>
                 <?php echo !empty($booking_time) ? $booking_time : ''; ?>
            </div>
          </td>
        </tr>
    
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Time Zone :</strong>
                  <?php echo !empty($timezone) ? $timezone : 'Eastern Time : USA & Canada'; ?>
            </div>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Duration :</strong>
                <?php echo '15:00 min'; ?>
            </div>
          </td>
        </tr>
    
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:2px dashed gray; margin:0 auto 0; width:75%; padding:5px 10px;font-size:16px;letter-spacing:0.3px;">
    
             </p>
          </td>
        </tr>
        
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;margin-top:5px;">
             <strong>Company Name :</strong>
             <span><?php echo !empty($company) ? $company : ''; ?></span>
            </p>
          </td>
        </tr>
  
      <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Address :</strong>
             <span>
              <?php if(!empty($country))
              {
                  if(!empty($city))
                  {
                    echo  $city.' , '.$country;
                  }
                  else
                  {
                    echo $country;
                  }
              }?>
              </span>
            </p>
          </td>
        </tr>
        
    
        
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Contact Name :</strong>
             <span><?php echo !empty($name) ? $name : ''; ?> </span>
            </p>
          </td>
        </tr>
        
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Title :</strong>
                  <?php echo ''; ?> 
            </div>
          </td>
        </tr>
  
       <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Tel :</strong>
             <span><?php echo !empty($phone) ? $phone : ''; ?></span>
            </p>
          </td>
        </tr>
        
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Email :</strong>
             <span><?php echo !empty($email) ? $email : ''; ?></span>
            </p>
          </td>
        </tr>
        
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:2px dashed gray; margin:0 auto 0; width:75%; padding:5px 10px;font-size:16px;letter-spacing:0.3px;">
    
             </p>
          </td>
        </tr>
        
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:10px auto 0; width:75%; padding:11px 10px 5px; background:#f8f9fa;margin-top:5px;">
             <strong>Savings Specialist :</strong>
             <span><?php echo !empty($leadassignedofficer) ? $leadassignedofficer : 'Andrew Auger'; ?></span>
            </p>
          </td>
        </tr>

         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Notes :</strong>
                 <?php echo !empty($notes) ? $notes : ''; ?>
            </div>
          </td>
        </tr>
    
        <tr>
          <td style="padding:0 25px;">
            <p style="margin:0 auto 0; width:75%; padding:5px 10px;font-size:1em;font-weight:600;letter-spacing:0.3px;">
                Assigned Savings Specialist to call at number provided.
             </p>
          </td>
        </tr>

          <tr>
            <td class="action-col" style="text-align:center;padding:40px;">
              <a id="yellow" href="<?php echo isset($acceptUrl) ? $acceptUrl : '';?>" style="color:#ff9800; background:#fff8e1; padding:2px 15px; text-decoration:none; border-radius:25px; margin-right:10px; display:inline-block; font-size:19px;width:85px;border:1px solid #ff9800">Accept</a>
              <a id="red" style="color:#fff; background:#e804042b; padding:3px 15px; text-decoration:none; border-radius:25px;width:85px;border: 1px solid #ff0000a6;font-size:19px; display:inline-block;color:#ff0000a6;cursor:pointer;" href="<?php echo isset($declineUrl) ? $declineUrl : '';?>">Decline</a>
            </td>
          </tr>
          <td style="background:#f1f3f4; font-size:11px; padding:18px; text-align:center; border-bottom: 1px solid #d8d8d8;">
              <em>Copyright ©  Anbruch All rights reserved.</em>
          </td>
        </tr>
        
      </table>

    </td>
  </tr>
</table>
