  <style>
header .date-time {margin:0 auto -68px; display:table; position:relative; line-height:68px; font-size:20px; top:16px; text-align:center;}
#digitalClock {font-size:14px; display:block; line-height:0; position:relative; top:8px;}

    @media (max-width:1044px){
		header .date-time {margin-right:245px;}
    }

    @media (max-width:767px){
		header .date-time {margin-left:15px;}
    }

/*    @media (max-width:567px){
		header .date-time {margin:0 0 0 15px;}
		header .top-notifications {position:absolute; top:0; right:10px;}
    }*/

    @media (max-width:508px){
    	header .date-time {display:none;}
		.fc-scroller.fc-day-grid-container {height:auto !important;}
    }
.top-reminder-count {background: #fe832c;}
.fa-clock-o {color:#666 !important;}
#reminder-popup .fa-clock-o {color:#fff !important;}
#reminder-popup {width:350px; background-color:#fdfdfd; box-shadow:0px 3px 20px -10px; max-height:370px; overflow-y:scroll;position: fixed;right: -350px;top: 81px;z-index: 9;transition: all 0.25s ease-in;}
#reminder-popup .head {background-color:#11b6ab; padding:5px;}
#reminder-popup .head p {margin:5px; color:#fff; padding:5px; font-size:15px; font-weight:600;}
#reminder-popup .head i {margin-right:8px;}
#reminder-popup .left .date {font-size:11px; margin:5px 0;font-weight: 700;color: #1cb6ab;opacity: .75;}
#reminder-popup .left h6 {margin:4px 0; font-size:13px; font-weight:700;}
#reminder-popup .left .discription {font-size:12px; margin:0; font-weight: 600}
.description-link { color:#767676; }
.description-link:hover { color:#5dc9c1; }
#reminder-popup .right .btn {font-size:12px; font-weight:600; padding:4px 8px; margin:5px 0px; border-radius:20px;}
#reminder-popup .left {width:50%;}
#reminder-popup .right {width:50%;margin-bottom: 25px;}
#reminder-popup .reminder-item {display:flex; padding:6px 12px; border-bottom:2px solid #e0e0e0;}
#reminder-popup.open{right: 0;}
#reminder-popup label.status {position: relative;padding: 6px;cursor: pointer;color: #4CAF50;float: right;}
#reminder-popup label.status input {position: absolute;visibility: hidden;}
#reminder-popup span.status-label {border-radius: 32px;border: 2px solid;padding: 4px 10px 4px 10px;position: relative;font-size: 10px;}
#reminder-popup span.radio-icon {border: 2px solid;padding: 2px;background: #fff;display: inline-block;border-radius: 7px;position: absolute;left: 12px;top: 9px;}
#reminder-popup label.status.ignore {color: #F44336;}
 #reminder-popup label.status input:checked + .status-label {background:currentColor;}
 #reminder-popup label.status input:checked + .status-label .text {color:#fff; position:relative;} 
 #reminder-popup label.status input:checked + .status-label .radio-icon {color:#fff;}
 #reminder-popup #reminder-popup-close:hover {cursor: pointer;color: }
 #reminder-popup.reminder-content {max-height: 280px;overflow-y: scroll;overflow: auto;}
 .dropdown-menu > li > .ntflink:hover {
    color: #1FB5AD !important;
}
.brand{
    background-color: white;
}
.clearfix a.logo{
    margin-top: 0px !important;
    margin-left: 0px !important;
}
.logo img{
    margin-left: 10px;
}
.hide-left-bar{
	width: 60px !important;
	margin-left: 0px !important;
}
.merge-left{
	margin-left: 240px !important;
}
.swal2-styled:focus {
	box-shadow: none !important;
}
.swal2-styled.swal2-confirm{
	background-color:#48b5ac !important;
}
#sidebar .sidebar-menu a {text-overflow:clip; white-space:nowrap;}
#sidebar a .side-head {transition:all .3s ease-in-out}
#sidebar.hide-left-bar a .side-head {visibility:hidden; opacity:0;}
.top-reminder-count{display: none;}
#reminder_table.dataTable tbody td{
  padding: 0px !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover{
    background: #1fb5ad !important;
    color: #fff !important;
    border: 1px solid #1fb5ad !important;
}    
.dataTables_wrapper .dataTables_paginate .paginate_button.current{
    background: #1fb5ad !important;
    color: #fff !important;
    border: 1px solid #1fb5ad !important;
}
.dataTables_length select{
    border-radius: 4px !important;
    border: 1px solid #d2dae1;
    font-weight: 400 !important;
    background: white;
}
.dataTables_wrapper .dataTables_filter input{
    border: 1px solid #e2e2e4;
    height: 34px;
    border-radius: 17px;
    margin-left: 0px !important;
}
.table .dataTables_wrapper .dataTables_paginate .paginate_button.current{
  color: #fff !important
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover{
  color:#fff !important;
}
table.dataTable.no-footer{
  border-bottom: 1px solid #e3ebf3 !important;
}
</style>
<!--header start-->
<header class="header fixed-top clearfix"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--logo start-->
    <div class="brand">
			
		<div class="clearfix " style="margin-left:0%;float: left;">
			<a href="<?php echo base_url() ?>" class="logo">
					<img width="215px" height="80px" src="<?php echo base_url() ?>static/images/Anbruch_logo_2020.png" alt="">
			</a>
		</div>

        
        <div class="sidebar-toggle-box">
            <div id="toggleIcon" class="fas fa-2x"></div>
        </div>
    
    </div>
    <!--logo end-->

    <div class="right-panel">
	    <div class="date-time">
	    	<div>
	    		<span id="digitalClock">
	    		</span>
	    		<span style="border-top:1px solid #eee;"> <span style="text-transform:uppercase;"><?php echo date("l,"); ?></span> <span> <?php echo date("F d, Y"); ?></span></span>
	    	</div>
	    </div>

	    <div style="display:none;">
				<?php print_r($currentUserData); ?>    
	    </div>
	    <div class="top-nav clearfix pull-right user-info" >
				<!--search & user info start-->
				<ul class="nav top-menu">
						<!-- user login dropdown start-->
						<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<span style="display:inline-block; width:40px; height:40px; overflow:hidden; border-radius:50px; line-height:initial; vertical-align:middle;">
										<img style="border-radius:0; width:100%; height:auto;" alt="" src="<?php echo (isset($currentUserData["profile_picture"])) ? $currentUserData["profile_picture"] : (base_url() . "static/images/avatar1_small.jpg"); ?>">
									</span>
										<span class="username" style="font-weight:700;"><?php echo $username; ?></span>
										<b class="caret"></b>
								</a>
								<ul class="dropdown-menu logout fadeInRight animated">
										
									<h5 style="padding:11px 15px; border-bottom:1px solid #e1e6ef; background:#f2f4f8; color:#788288; font-size:13px; margin-top:-5px;"><?php echo  $role_title; ?></h5>
									
										<li><a href="<?php echo base_url() ?>member/personalProfile"><i class=" fa fa-suitcase"></i>Personal Profile</a></li>

										<li><a href="<?php echo base_url() ?>member/attendance"><i class=" fa fa-clock-o"></i>Attendance</a></li>
										
										<?php if ($role_id == 1 || $role_id == 7) { ?>

												<li><a href="<?php echo base_url() ?>member/payroll"><i class=" fa fa-money"></i>Payroll</a></li>

                                               <!--  <li><a href="<?php echo base_url() ?>Booking/webBooking"><i class=" fa fa-calendar"></i>Web Bookings</a></li> -->
                                                
                                                <li><a href="<?php echo base_url() ?>Contacts/index"><i class=" fa fa-user"></i>Web Contacts</a></li>
											
												<li><a href="<?php echo base_url() ?>UserManagement/"><i class="fa fa-users"></i>User Management</a></li>
												<li><a href="<?php echo base_url() ?>TeamManagement/"><i class="fa fa-users"></i>Team Management</a></li>
												<li><a href="<?php echo base_url() ?>ModuleManagement/leadConversionMapping"><i class="fa fa-tasks"></i>Lead Mapping</a></li>
												<li><a href="<?php echo base_url() ?>ModuleManagement/modifyPrimaryView"><i class="fa fa-tasks"></i>View Modify</a></li>
												<li><a href="<?php echo base_url() ?>ModuleManagement/modifySortingView"><i style="float: left;" class="fa fa-sort"></i>View Sorting</a></li>
												
												<li><a href="<?php echo base_url() ?>DatabaseManagement"><i class="fa fa-database"></i>DB Management</a></li>
												
										<?php } ?>
										
										<li style="border-top:1px solid #d2d2d2; margin-top:5px;"><a href="<?php echo base_url() ?>member/logout" style="margin-top:5px;"><i class="fa fa-key"></i>Log Out</a></li>
								</ul>
						</li>
				</ul>
				<!--search & user info end-->
		</div>
		<?php ///echo '<pre>';print_r($this->mydata['topnotifications']);  ?>	
		<div class="top-nav clearfix pull-right top-notifications" >
			<!--notifications start-->
			<ul class="nav top-menu top-notify">
					<!-- user login dropdown start-->
					<li class="dropdown Notifications">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#" style="padding-right:20px !important;">
								<i class="fa fa-bell" style="font-size:20px"></i>		
								<span class="notify-count"><?php echo count($this->mydata['topnotifications']); ?></span>
							</a>
							
							<ul class="dropdown-menu extended logout fadeInRight animated" style=" width:360px !important;padding:0; height:300px; overflow-y:auto; border-radius:0;">
									<h5 style="padding:11px 15px; border-bottom:1px solid #e1e6ef; background:#f2f4f8; margin-top:0; color:#788288; font-size:13px;">
										<span>You have <?php echo count($this->mydata['topnotifications']); ?> notifications</span>
									</h5>	
									<?php 
									if(!empty($this->mydata['topnotifications']))
									{
										foreach($this->mydata['topnotifications'] as $notifications)
										{
                      $bkg='';

											if($notifications['module_id']==1){ 
                          
                      $this->load->helper('rand_helper'); 
                      $company_name=getLeadCompanyName($notifications['record_id'],$notifications['module_id']);   
                    
                  ?>
                         
                    <li class="<?php echo $notifications['title']; ?>" style=" border-bottom: 1px solid #ccc; background:<?php echo $bkg; ?>;">
                      <a href="<?php echo base_url() ?>/booking?booking_id=<?php echo $notifications['booking_id']; ?>" style="white-space: normal !important;" class='ntflink'>
                      <i class="fa"></i><span style="color:#242729; font-size:13px;"><?php echo $notifications['title']?></span>
                      <br>
                      <span class="ntfcompany" style="font-size:12px;margin-left:28px; padding:0;"><strong><?php echo $company_name; ?></strong>
                      <p style="margin-left:28px; padding:0; color:#a1a8ac;"><?php echo $notifications['description']?></p>
                    </a>
                    </li>


                    <?php }else{
									?>
										<li class="<?php echo $notifications['title']; ?>" style=" border-bottom: 1px solid #ccc; background:<?php echo $bkg; ?>;">
											<a href="<?php echo base_url() ?>/booking?booking_id=<?php echo $notifications['booking_id']; ?>" style="white-space: normal !important;">
											<i class="fa"></i><span style="color:#242729; font-size:13px;"><?php echo $notifications['title']; ?></span>
											<p style="margin-left:28px; padding:0; color:#a1a8ac;"><?php echo $notifications['description']; ?></p>
										</a>
										</li>						
									<?php } } } else { ?>	
									<div class="no_records" style="padding: 85px 70px;">No Notifications</div>
									<?php } ?>
							</ul>
					</li>
			</ul>
			<!--notifications end-->
		</div>
		<div class="top-nav clearfix pull-right top-reminders" >
				<ul class="nav top-menu top-notify">
					<!-- user login dropdown start-->
					<li class="dropdown Notifications">
							<a data-toggle="dropdown" class="dropdown-toggle reminder-btn" id='nav-reminder' href="#" style="padding-right:20px !important;" title="Reminders">
								<i class="fa fa-clock-o" style="font-size:20px"></i>		
								<span class="notify-count top-reminder-count">0</span>
							</a>
 	    </div>
	</div>


    
</header>
<!--header end-->
<!-- reminder  -->
<div id="reminder-popup" class="pull-right open">
     <div class="head">
       <p>
         <i class="fa fa-clock-o"></i>
       <span>Upcoming Reminder<span class="numbers"> (0)</span></span>
       <i id="reminder-popup-close" class="fa fa-times pull-right"></i>
     </p>
   </div>
   <div class="reminder-content">
     <table id="reminder_table" class="table">
       <thead>
         <tr style="display: none"><th></th></tr>
       </thead>
     </table>
       
   </div>
</div>
<!-- Reminder -->
<script type="text/javascript">
localStorage.setItem("sidebar", "hide");
	// $(document).ready(function(){
	// 	$('section#main-content').addClass('merge-left');
	// });
    $("#reminder-popup").toggleClass("open");

    // $('#toggleIcon').click(function (e) {
    //     sidebar_toggle(e);
    // });


  $('.sidebar-toggle-box').click(function(){
    $(this).toggleClass('open-sidebar');
    $('#sidebar').toggleClass('hide-left-bar');
    $('#main-content').toggleClass('merge-left');
  });

  $(document).on('mouseenter','#sidebar li a', function (event) {
   if($('#sidebar').hasClass('hide-left-bar')){
       $('#sidebar').removeClass('hide-left-bar');
       $('#main-content').addClass('merge-left')
      }
   }).on('mouseleave','#sidebar',  function(){
     if($('.sidebar-toggle-box').hasClass('open-sidebar')){
        // if menu is toggled manually than do nothing
      }else {
       $('#sidebar').addClass('hide-left-bar');
       $('#main-content').removeClass('merge-left')
      }
  });


/* function sidebar_toggle(e){
 	$(".leftside-navigation").niceScroll({
            cursorcolor: "#1FB5AD",
            cursorborder: "0px solid #fff",
            cursorborderradius: "0px",
            cursorwidth: "3px"
        });

        $('#sidebar').toggleClass('hide-left-bar');
        if ($('#sidebar').hasClass('hide-left-bar')) {
            $(".leftside-navigation").getNiceScroll().hide();
            $('.side-head').hide();
            localStorage.setItem("sidebar", "hide");
        }else{
        	setTimeout(function(){
            $('.side-head').show();
          },300)
        	localStorage.setItem("sidebar", "show");
        }
        $(".leftside-navigation").getNiceScroll().show();
        $('#main-content').toggleClass('merge-left');
        e.stopPropagation();
        if ($('#container').hasClass('open-right-panel')) {
            $('#container').removeClass('open-right-panel')
        }
        if ($('.right-sidebar').hasClass('open-right-bar')) {
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if ($('.header').hasClass('merge-header')) {
            $('.header').removeClass('merge-header')
        }

        if ($(this).hasClass('fa-arrow-circle-o-left')) {
            $(this).removeClass('fa-arrow-circle-o-left');
            $(this).addClass('fa-arrow-circle-o-right');
        } else {
            $(this).removeClass('fa-arrow-circle-o-right');
            $(this).addClass('fa-arrow-circle-o-left');
        }
 }*/

// $(document).on('mouseenter','#sidebar li a', function (event) {
// 	if(localStorage.getItem("sidebar")=='hide'){
// 		  setTimeout(function(){
//             $('.side-head').show();
//       },100)
//      	$('#sidebar').removeClass('hide-left-bar');
//     	$('#main-content').addClass('merge-left')
//     }
//  }).on('mouseleave','#sidebar',  function(){
//  	if(localStorage.getItem("sidebar")=='hide'){
//       setTimeout(function(){
//             $('.side-head').hide();
//       },100)
//      	$('#sidebar').addClass('hide-left-bar');
//     	$('#main-content').removeClass('merge-left')
//     }
// });



/******************************************************************************/

function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("digitalClock").innerText = time;
    document.getElementById("digitalClock").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();

</script>