<?php 
$mailData = isset($jobData[0]) && !empty($jobData[0]) ? $jobData[0] : '';
//print_r($mailData);
?>  


<table style="background:#f8f9fa; text-align:center; width:100%; border-collapse:collapse;">
  <tr>
    <td>
      <table style="background:#fff; color:#474747; font-size:13px; width:600px; margin:70px auto; border-collapse:collapse;">
        <tr>
            <td style="border-top:70px solid #1fb5ad; padding-top:30px;">
                <img height="70" width="200" src="<?php echo base_url('assets/images/')?>logo-hd2.png">
            </td>
        </tr>

        <tr>
            <td style="padding:0 25px;">
                <h3 style="letter-spacing:1.5px; color:#586571; font-size:26px; font-weight:normal;">Calendar</h3> 
               
                <p style="text-align:left;">Hello <strong><?php echo isset($user_email) ? strstr($user_email, '@', true) : '';?></strong>,</p>

                <p style="margin:15px 0; text-align:left; color:#586571;">
                    We are writing to let you know that <a style="color:#1fb5ad; text-decoration:none;" href="mailto:<?php echo $this->session->userdata('email');?>" target="_blank"><?php echo $this->session->userdata('email');?></a> has given you access to view events on the Calendar called <strong><?php echo isset($calName) ? $calName : '';?></strong>.</p>

                <a href="<?php echo base_url('booking');?>" style="color:#fff; background:#1fb5ad; padding:10px 16px;     font-size:16px; text-decoration:none; border-radius:5px; display:inline-block; margin:30px 0 40px;">View Calendar</a>
            </td>
        </tr>

        <tr>
            <td style="background:#f1f3f4; font-size:11px; padding:18px; border-bottom: 1px solid #d8d8d8;">
                <em>Copyright &copy;  Anbruch<?php echo date('Y')?> All rights reserved.</em>
                
            </td>
        </tr>
      </table>
    </td>      
  </tr>
</table>