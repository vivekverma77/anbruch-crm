
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
             <span><?php echo (isset($leadassignedofficer) && !empty($leadassignedofficer)) ? $leadassignedofficer : '' ?></span>
            </p>
          </td>
        </tr>


        <tr>
          <td style="padding:0 25px;">
            <p style="border-bottom:1px solid #ddd; margin:0 auto ; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Meeting Date :</strong>
             <span><?php echo (isset($start_date) && !empty($start_date)) ? $start_date : '' ?></span>
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
             <strong>Parent Company Name :</strong>
             <span><?php echo (isset($parent_company) && !empty($parent_company))? $parent_company :''?></span>
            </p>
          </td>
        </tr>
        <?php if($current_module_id  == 1){ ?>
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Business Type :</strong>
             <?php echo (isset($business_typ) && !empty($business_typ)) ? $business_type: '' ?>
            </div>
          </td>
        </tr>
      <?php } ?>

        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Primary NAICS Description :</strong>
             <?php echo (isset($primary_NAICS_description) && !empty($primary_NAICS_description)) ? $primary_NAICS_description: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Estimated Sales :</strong>
             <?php echo (isset($estimated_sale) && !empty($estimated_sale)) ? $estimated_sale: '' ?>
            </div>
          </td>
        </tr>


        <?php if($current_module_id  == 1){ ?> 
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Lead name :</strong>
             <?php echo (isset($lead_name) && !empty($lead_name)) ? $lead_name: '' ?>
            </div>
          </td>
        </tr>
        <?php } if($current_module_id == 2){ ?>
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Client name :</strong>
             <?php echo (isset($lead_name) && !empty($lead_name)) ? $lead_name: '' ?>
            </div>
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


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Telephone :</strong>
             <?php echo (isset($telephone) && !empty($telephone)) ? $telephone: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Address :</strong>
             <?php echo (isset($address_line_1) && !empty($address_line_1)) ? $address_line_1: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>City :</strong>
             <?php echo (isset($city) && !empty($city)) ? $city: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Province :</strong>
             <?php echo (isset($province) && !empty($province)) ? $province: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Country :</strong>
             <?php echo (isset($Country) && !empty($Country)) ? $Country: '' ?>
            </div>
          </td>
        </tr>


         
        <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Zip Code :</strong>
             <?php echo (isset($zip_code) && !empty($zip_code)) ? $zip_code: '' ?>
            </div>
          </td>
        </tr>


       <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Website:</strong>
             <?php echo (isset($website) && !empty($website)) ? $website: '' ?>
            </div>
          </td>
        </tr>


         <tr>
          <td style="padding:0 25px;">
            <div style="border-bottom:1px solid #ddd; margin:0 auto 0px; width:75%; padding:11px 10px 5px; background:#f8f9fa;">
             <strong>Admin :</strong>
             <?php echo (isset($admin) && !empty($admin)) ? $admin: '' ?>
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