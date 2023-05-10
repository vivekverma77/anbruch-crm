<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>Anbrunch</title>
     
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script src="https://use.fontawesome.com/7a35b830bc.js"></script>
     <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
<style>
#out-box {margin-top:4%; box-shadow:11px 6px 25px -12px #1e3161; padding:0;}
#out-box .head {background-image:url(<?php echo base_url('assets/images/')?>bg.jpg); padding:25px;}
#out-box .head img {width:auto; height:120px;}
#out-box .head h2 {font-weight:600; color:#1e3161; margin-top:30px;}
#out-box .content-1 {margin:0; display:flex;}
#out-box .content-1 .box-1 {padding:15px 20px;}
#out-box .content-1 .box-1 span {font-size:18px; color:#1e3161;}
#out-box .content-1 .box-1 span i {font-size:26px; margin-right:6px;}
#out-box .content-1 .box-1 .brand-name {margin:30px 0 25px;}
#out-box .content-1 .box-1 .brand-name h1 {color:#1e3161; letter-spacing:2px; margin-bottom:0;}
#out-box .content-1 .box-1 .brand-name h4 {color:#f47d38; margin-top:6px;}
#out-box .content-1 .box-1 .brand-details {color: #1e3161;}
#out-box .content-1 .box-1 .text p {margin:2px 0; font-weight:600;}
#out-box .content-1 .box-2 {background-color:#f47d38; color:#fff; padding:20px;}
#out-box .content-1 .box-3 {background-color:#1e3161; color:#fff; padding:20px;}
#out-box .content-1 .box .icon {font-size:26px;}
#out-box .content-1 .box .box-content {margin:20px;}

#out-box .content-2 {margin:0;}
#out-box .content-2 .box-4 {background-color:#e7e7e8; color:#1e3161; padding:20px;}
#out-box .content-2 .box-4 .top span {font-size:18px; font-weight:600;}
#out-box .content-2 .box-4 i {font-size:26px; margin-left:6px;}
#out-box .content-2 .box-4 .text-part {position:relative; margin:20px 15% 0; padding-left:10px; font-size:16px; color:#1e3161; font-weight:600; letter-spacing:0.3px; line-height:24px;}
#out-box .content-2 .box-4 .text-part span {position:absolute; top:8px; left:0;}
#out-box .content-2 .box-4 .text-part span .img {height:35px; margin-left:-8px;}
.text-center {text-align: center;}
.col-md-4 {width: 33.33333333%;}
.col-md-8 {width: 66.66666667%;}
.bottom-text  {display: inline-flex;}
.footer-table {margin: 20px 15%}
@media (max-width:767px) {
     #out-box .content-1 {display:block;margin:0;}
     #out-box .head img {height:75px;}
     .col-md-4,.col-sm-12 {width: auto !important;}
     .col-md-8 {width: auto !important;}
     #out-box .content-2 .box-4 .text-part {margin:20px 20px 0;}
     .bottom-text  {display: flex;}
     .bottom-text-2 {display:block; position:relative; padding-left:50px;}
     .bottom-text-2 img {position:absolute; left:0; max-width:50px; height:auto;}
     .footer-table {margin:20px;}

}

</style>
</head>
<body>
<div class="container" id="out-box">
     <div class="head text-center">
       <div><a href="#"><img src="<?php echo base_url('assets/images/')?>logo-hd2.png" alt="anbruch-logo"></a></div>
     <h2>Your Booking Confirmation Details:</h2>
   </div>
   <div class="row content-1">
       <div class="col-md-4 col-sm-12 box-1">
         <div class="top">
           <img style="vertical-align: middle;" src="<?php echo base_url('assets/images/')?>33.png"><span style="display: inline-block;">Anbruch Specialist</span>
       </div>
       <div class="text">
           <div class="brand-name">
             <h1>Andrew Auger</h1>
           <h4>Sr. Corporate Savings Specialist</h4>
         </div>
         <div class="text brand-details">
           <p>Toll Free: 1.800.344.2627</p>
           <p>Direct: 416.687.2TAX (2829) x 6091</p>
           <p>Cell: 416.820.8208</p>
           <p>Fax: 416.900.6TAX (6829) </p>
           <p><a href="mailto:aauger@anbruch.com" style="color:#1e3161;text-decoration: none;">aauger@anbruch.com</a></p>
         </div>
       </div>
     </div>
       <div class="col-md-4 col-sm-12 box box-2">
         <div class="icon">
          <img src="<?php echo base_url('assets/images/')?>11.png">
       </div>
       <div class="box-content">
           <p><strong> Date: </strong> <?php echo !empty($booking_date) ? $booking_date : ''; ?></p>
           <p><strong> Time: </strong> <?php echo !empty($booking_time) ? $booking_time : ''; ?></p>
           <p><strong> Time Zone: </strong> <?php echo !empty($timezone) ? $timezone : 'Eastern Time : USA & Canada'; ?></p>
           <p><strong> Duration: </strong> <?php echo !empty($duration) ? $duration : '15 min'; ?></p>
       </div>
     </div>
       <div class="col-md-4 box col-sm-12 box-3">
         <div class="icon">
          <img src="<?php echo base_url('assets/images/')?>22.png">
       </div>
       <div class="box-content">
           <p><strong> Name: </strong><?php echo !empty($name) ? $name : ''; ?></p>
           <p><strong> Company Name: </strong><?php echo !empty($company) ? $company : ''; ?></p>
           <p><strong> Phone: </strong><?php echo !empty($phone) ? $phone : ''; ?></p>
           <p><strong> Email: </strong><a style="color: #fff;text-decoration: none;" href="mailto:<?php echo !empty($email) ? $email : ''; ?>"><?php echo !empty($email) ? $email : ''; ?></a></p>
           <p><strong> Address: </strong><?php if(!empty($country))
              {
                  if(!empty($city))
                  {
                    echo  $city.' , '.$country;
                  }
                  else
                  {
                    echo $country;
                  }
              }?></p>
       </div>
     </div>
   </div>
   <div class="row content-2">
       <div class="col-md-4" style="float: left;"></div>
       <div class="col-md-8 col-sm-12 box-4" style="float: right;padding: 0;">
       <div>
        <table class="footer-table" style="font-weight:700;">
          <tr>
            <td>
              <table>
                <tr>
                  <td><img style="margin-right: 10px;vertical-align: middle;" src="<?php echo base_url('assets/images/')?>33.png"></td>
                  <td><span style="display: inline-block;"><?php echo !empty($notes) ? $notes : ''; ?></span></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
                <table style="margin-top:10px;">
                  <tr>
                    <td><img style="margin-right: 10px;vertical-align: middle;" src="<?php echo base_url('assets/images/')?>img.png"></td>
                    <td><span style="display: inline-block;">Your Savings Specialist will be calling at the number that was provided.</span></td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>


       </div>
     </div>
   </div>
</div>

</body>
</html>