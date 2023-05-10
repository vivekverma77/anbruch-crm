<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "dashboard") !== false) echo 'active' ?>" href="<?php echo base_url() ?>dashboard/">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
								<?php if ($role_id == 1 || $role_id == 5 || in_array('activities',json_decode($permissions))) { ?>
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "activities") !== false) echo 'active' ?>" href="<?php echo base_url() ?>activities/">
                        <i class="fa fa-tasks"></i>
                        <span>Activities</span>
                    </a>
                </li>
                <?php } ?>
                
                <?php if ($role_id == 1 || $role_id == 5 || in_array('bookings',json_decode($permissions))) { ?>
                
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "booking/") !== false) echo 'active' ?>" href="<?php echo base_url() ?>booking/">
                        <i class="fa fa-calendar"></i>
                        <span>Bookings</span>
                    </a>
                </li>
				<?php } ?>
                

                <?php if ($role_id == 1 || $role_id == 5 || in_array('bookings',json_decode($permissions))) { ?>
               <!--  <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "calendar/") !== false) echo 'active' ?>" href="<?php echo base_url() ?>calendar/">
                        <i class="fa fa-calendar-check"></i>
                        <span>Calendar</span>
                    </a>
                </li> -->
                                <?php } ?>
								
                <?php 
                if(!empty($modules))
                {
									foreach ($modules as $key => $value)
									{ ?>
										
										<?php if ($role_id == 1 || $role_id == 5 || in_array(strtolower($value["name"]),json_decode($permissions))) { ?>
                    <li>
                        <a class="<?php if (strpos($_SERVER['REQUEST_URI'], $value["name"]) !== false) echo 'active' ?>" href="<?php echo base_url() ?>modules/?cm=<?php echo $value["name"]; ?>&id=1">
                        <?php if($value["name"]=='Leads'){ echo '<i class="fa fa-book"></i>'; } 
                          elseif($value["name"]=='Clients'){ echo '<i class="fa fa-users"></i>'; }
                          elseif($value["name"]=='Contracts'){ echo '<i class="fa fa-paperclip"></i>'; }
                          else{ echo '<i class="fa fa-book"></i>'; }
                          
                        ?>  
                            <span><?php echo $value["name"]; ?></span>
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
                        <span>Email Templates</span>
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
                <?php if ($role_id == 1) { ?>
                <li>
                    <a class="<?php if (strpos($_SERVER['REQUEST_URI'], "reports") !== false) echo 'active' ?>" href="<?php echo base_url() ?>reports/">
                        <i class="fa fa-file"></i>
                        <span>Reports</span>
                    </a>
                </li>
                 <?php } ?>
                
            </ul>
            <?php //echo '<pre>';print_r(json_decode($permissions)); ?>
        </div>
        
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
