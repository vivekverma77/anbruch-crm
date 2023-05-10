
<?php 
$mailData = isset($jobData[0]) && !empty($jobData[0]) ? $jobData[0] : '';
//print_r($mailData);
?> 


<table style="background:#f8f9fa; width:100%; border-collapse:collapse;">
  <tr>
    <td>
      
      <table style="background:#fff; color:#474747; font-size:13px; width:600px; margin:70px auto; border-collapse:collapse;">

        <tr>
          <td style="border-top:70px solid #1fb5ad; padding-top:30px; text-align:center;">
            <img src="https://crm.anbruch.com/static/images/anbruch-logo-2.png" style="margin-left:80px;">
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px; text-align:center;">
            <h3 style="letter-spacing:1.5px; color:#586571; margin-bottom:0; font-size:26px; font-weight:normal;">Event Reminder</h3>
            <p style="margin-top:0; font-size:14px; color:#586571;">You have been invited to the following event.</p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:40px auto 0; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Title :</strong>
             <span><?php echo (isset($title) && !empty($title)) ? $title : '' ?></span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Start Date :</strong>
             <span><?php echo (isset($start_date) && !empty($start_date)) ? date('Y-m-d',strtotime($start_date)) : '' ?> <?php echo (isset($start_time) && !empty($start_time)) ? date('h:i a',strtotime($start_time)) : '' ?></span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>End Date :</strong>
             <span><?php echo (isset($end_date) && !empty($end_date)) ? date('Y-m-d',strtotime($end_date)) : '' ?> <?php echo (isset($end_time) && !empty($end_time)) ? date('h:i a',strtotime($end_time)) : '' ?></span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 40px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Notes :</strong>
             <?php echo (isset($notes) && !empty($notes)) ? $notes: '' ?>
            </div>
          </td>
        </tr>

        <tr>
          <td class="action-col" style="text-align:center; padding-bottom:40px;">
            <a href="<?php echo isset($acceptUrl) ? $acceptUrl : '';?>" style="color:#fff; background:#1fb5ad; padding:7px 15px; text-decoration:none; border-radius:5px; margin-right:10px; display:inline-block; font-size:14px;">Accept</a>
            <a style="color:#fff; background:#f44336; padding:7px 15px; text-decoration:none; border-radius:5px; font-size:14px; display:inline-block;" href="<?php echo isset($declineUrl) ? $declineUrl : '';?>">Decline</a>
          </td>
        </tr>

        <tr>
          <td style="background:#f1f3f4; font-size:11px; padding:18px; text-align:center; border-bottom: 1px solid #d8d8d8;">
              <em>Copyright &copy;  Anbruch<?php echo date('Y')?> All rights reserved.</em>
          </td>
        </tr>
        
      </table>

    </td>
  </tr>
</table>