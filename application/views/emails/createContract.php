
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
            <p style="margin-top:0; font-size:14px; color:#586571;"><?php echo $heading?></p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:40px auto 0; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Assigned Officer :</strong>
             <span><?php echo (isset($contractassignedofficer) && !empty($contractassignedofficer)) ? $contractassignedofficer : '' ?></span>
            </p>
          </td>
        </tr>


        <!-- <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto ; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Meeting Date :</strong>
             <span><?php echo (isset($start_date) && !empty($start_date)) ? $start_date : '' ?></span>
            </p>
          </td>
        </tr> -->


        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Contract Name :</strong>
             <span><?php echo (isset($contract_name) && !empty($contract_name)) ? $contract_name:'' ?> </span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Contract Number :</strong>
             <span><?php echo (isset($contract_number) && !empty($contract_number))? $contract_number :''?></span>
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Client Name :</strong>
             <?php echo (isset($client_name) && !empty($client_name)) ? $client_name: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Signing Rate :</strong>
             <?php echo (isset($signing_rate) && !empty($signing_rate)) ? $signing_rate: '' ?>
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
        
         
        <!-- <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Service Type :</strong>
             <?php echo (isset($service_type) && !empty($service_type)) ? $service_type: '' ?>
            </div>
          </td>
        </tr> -->


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Technical Consultants :</strong>
             <?php echo (isset($technical_consultants) && !empty($technical_consultants)) ? $technical_consultants: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Technical Consultants Status :</strong>
             <?php echo (isset($technical_consultants_status) && !empty($technical_consultants_status)) ? $technical_consultants_status: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Accountants :</strong>
             <?php echo (isset($accountants) && !empty($accountants)) ? $accountants: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Accountants Status :</strong>
             <?php echo (isset($accountants_status) && !empty($accountants_status)) ? $accountants_status: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Description :</strong>
             <?php echo (isset($description) && !empty($description)) ? $description: '' ?>
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