<table style="background:#f8f9fa; width:100%; border-collapse:collapse;">
  <tr>
    <td>
      
      <table style="background:#fff; color:#474747; font-size:13px; width:600px; margin:70px auto; border-collapse:collapse;">

        <tr>
          <td style="border-top:70px solid #1fb5ad; padding-top:30px; text-align:center;">
            <img src="<?php echo base_url() ?>static/images/anbruch-logo-2.png" style="margin-left:80px;">
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
            <p style="border-bottom:1px solid #ddd; margin: 0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Contract Name :</strong>
             <span><?php echo (isset($contractName) && !empty($contractName)) ? $contractName:'' ?> </span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Contract Number :</strong>
             <span><?php echo (isset($contractName) && !empty($contractName))? $contractName :''?></span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Client Name :</strong>
             <?php echo (isset($clientName) && !empty($clientName)) ? $clientName: '' ?>
            </div>
          </td>
        </tr>


        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Client Number :</strong>
             <?php echo (isset($clientNumber) && !empty($clientNumber)) ? $clientNumber: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Stage :</strong>
             <?php echo (isset($stage) && !empty($stage)) ? $stage: '' ?>
            </div>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Assigned Officer :</strong>
             <span><?php echo (isset($assignedOfficer) && !empty($assignedOfficer)) ? $assignedOfficer : '' ?></span>
            </p>
          </td>
        </tr>


        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto ; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Assigned Date :</strong>
             <span><?php echo (isset($assignedDate) && !empty($assignedDate)) ? $assignedDate : '' ?></span>
            </p>
          </td>
        </tr>

         <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Service Type :</strong>
             <?php echo (isset($serviceType) && !empty($serviceType)) ? $serviceType: '' ?>
            </div>
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