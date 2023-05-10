
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
            <h3 style="letter-spacing:1.5px; color:#586571; margin-bottom:0; font-size:26px; font-weight:normal;"><?php echo $mainheading?></h3>
            <p style="margin-top:0; font-size:14px; color:#586571;">Dear <?php echo $username?> your password has been updated by admin</p>
          </td>
        </tr>
        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:15px auto 1px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>User Name: </strong>
             <span><?php echo (isset($email) && !empty($email)) ? $email : '' ?></span>
            </p>
          </td>
         </tr> 
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:1px auto 15px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>New Password: </strong>
             <span><?php echo (isset($password) && !empty($password)) ? $password : '' ?></span>
            </p>
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