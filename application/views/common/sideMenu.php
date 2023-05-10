<!--sidebar start-->
<style>
#zoom_mentor { background: #1fb5ad;color:white; }
#zoom_mentor:hover { background:#ff5801e8 !important; }
.fa-web::before{content: '\f0ac' !important}
#sidebar ul li {line-height: 17px;}
</style>
<aside>
    <div id="sidebar" class="nav-collapse hide-left-bar">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "dashboard") !== false) echo 'active' ?>" href="<?php echo base_url() ?>dashboard/">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="side-head">Dashboard</span>
                    </a>
                </li>
								<?php if ($role_id == 1 || $role_id == 5 || in_array('activities',json_decode($permissions))) { ?>
                <!-- <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "activities") !== false) echo 'active' ?>" href="<?php echo base_url() ?>activities/">
                        <i class="fa fa-tasks"></i>
                        <span>Activities</span>
                    </a>
                </li> -->
                <?php } ?>
                
                <?php if ($role_id == 1 || $role_id == 5 || in_array('bookings',json_decode($permissions))) { ?>
                
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "booking/") !== false) echo 'active' ?>" href="<?php echo base_url() ?>booking/">
                        <i class="fa fa-calendar"></i>
                        <span class="side-head">Bookings</span>
                    </a>
                </li>
				<?php } ?>
                

                <?php if ($role_id == 1 || $role_id == 7) { ?>
               <!--  <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "calendar/") !== false) echo 'active' ?>" href="<?php echo base_url() ?>calendar/">
                        <i class="fa fa-calendar-check"></i>
                        <span>Calendar</span>
                    </a>
                </li> -->

                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "webBooking") !== false) echo 'active' ?>" href="<?php echo base_url() ?>webBooking">
                        <i class="fa fa-web"></i>
                        <span class="side-head">Web Bookings</span>
                    </a>
                </li> 


                                <?php } ?>
								
                <?php 
                if(!empty($modules))
                {
									foreach ($modules as $key => $value)
									{ ?>
										
										<?php if ($role_id == 1 || $role_id == 5 || in_array(strtolower($value["name"]),json_decode($permissions))) { ?>
                    <li>
                        
                        <?php if($role_id == 1 || $role_id == 7){?>
                        
                            <a class="<?php if (strpos($_SERVER['REQUEST_URI'], $value["name"]) !== false) echo 'active' ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $value["name"]; ?>&id=1"> 

                          <?php }else{?>  

                            <a class="<?php if (strpos($_SERVER['REQUEST_URI'], $value["name"]) !== false) echo 'active' ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $value["name"]; ?>&id=1&own=<?php echo $_SESSION['user_id'] ?>">

                        <?php }if($value["name"]=='Leads'){ echo '<i class="fa fa-book"></i>'; } 
                          elseif($value["name"]=='Clients'){ echo '<i class="fa fa-users"></i>'; }
                          elseif($value["name"]=='Contracts'){ echo '<i class="fa fa-paperclip"></i>'; }
                          else{ echo '<i class="fa fa-book"></i>'; }
                          
                        ?>  
                            <span class="side-head"><?php echo $value["name"]; ?></span>
                        </a>
                    </li>
                    <?php } ?>
                    
                <?php 
									} 
                }
                ?> 
                
                <?php if ($role_id == 1 || $role_id == 5 || in_array('emailtemplates',json_decode($permissions))) { ?>
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "emailtemplates") !== false) echo 'active' ?>" href="<?php echo base_url() ?>emailtemplates/">
                        <i class="fas fa-envelope-square"></i>
                        <span class="side-head">Email Templates</span>
                    </a>
                </li>
                <?php } ?>
                
               <!--  <?php if ($role_id == 1 || $role_id == 5 || in_array('holidays',json_decode($permissions))) { ?>
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "holidays") !== false) echo 'active' ?>" href="<?php echo base_url() ?>holidays/">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Holidays</span>
                    </a>
                </li>
                 <?php } ?>
                 -->
                <?php if ($role_id == 1 || $role_id == 7) { ?>
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "reports") !== false) echo 'active' ?>" href="<?php echo base_url() ?>reports/">
                        <i class="fa fa-file"></i>
                        <span class="side-head">Reports</span>
                    </a>
                </li>
                 <?php } ?>

                <li>
                    <a id="zoom_mentor" class="<?php if (strpos($_SERVER['REQUEST_URI'], "ZoomMentor") !== false) echo 'active' ?>" href="<?php echo base_url() ?>ZoomMentor" target='_blank'>
                        <i class="fa fa-external-link-alt"></i>
                        <span class="side-head">Zoom Mentor</span>
                    </a>
                </li>
                
            </ul>
            <?php //echo '<pre>';print_r(json_decode($permissions)); ?>
        </div>
        
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
