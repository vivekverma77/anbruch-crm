<style>
.dp-wrapper {position:relative;}
.dp-wrapper input {opacity:0; position:absolute;}
.dp-wrapper .new-selector {display:flex; position:relative;}
.dp-wrapper .file-btn {display:inline-block; padding:8px 11px; background:#1fb5ad; color:#fff; cursor:pointer; border-radius:4px 0 0 4px;}
.dp-wrapper .file-btn:hover {background:#1a9a93}
.dp-wrapper .input-field {background:#f5f5f5; flex-grow:1; border-radius:0 4px 4px 0; border:1px solid #e2e2e4; user-select:none; padding:7px;}
.dp-wrapper .input-field:empty {cursor:not-allowed;}
.dp-wrapper .input-field:empty:hover {background:#eee;}

.d-menu{
    font-size: 16px;	
    height:487px;
    overflow: auto;
}
.d-menu ul li {
    list-style: none;
    padding: 4px 0px 3px 10px;
    border: 1px solid #e4efed;
    
}    
ul, .list-unstyled {
    padding-left: 0;
}

.icon-row .fa {
    position: absolute;
    bottom: 9px;
    left: 25px;
    color: #1fb5ad;
}
.icon-row {
    position: relative;
}
.icon-row input:not([type="file"]), .icon-row select  {
    padding-left:30px;
}


.new-table {border:0;}
.d-menu li a {position:relative;}
.d-menu label {display:inline-block; margin:15px 0; cursor:pointer; color:#989898;}
.d-menu label input {position:absolute; opacity:0;}
.new-table .input-checkbox-icon {margin:0 6px 0 0;}

</style>
<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-8">
                <section class="panel">
                    <header class="panel-heading"> <i class="fa fa-user"></i> Personal Profile</header>
                    <div class="panel-body" style="padding:15px; ">
											
                        <?php $this->load->view('common/alert'); ?>
                        
                        <form role="form" action="" enctype="multipart/form-data" method="post" onsubmit="return checkPassword();">
                            <input name="id" value="<?php echo $user_data["id"] ?>" type="hidden"/>

                            <div class="row icon-row">
                                <div class="form-group col-lg-12">
                                    <label for="email">Email Address *</label>
                                    <input name="email" type="email" value="<?php echo $user_data["email"] ?>" required="required" class="form-control" id="email" disabled="disabled">
                                    <i class="fa fa-envelope"></i>
                                </div>
                            </div>
                            <div class="row icon-row">
                                <div class="form-group col-lg-6">
                                    <label for="password">Login Password</label>
                                    <input name="password" type="password" class="form-control" id="password" minlength="6" placeholder="Leave empty if you don't want to change your password">
                                    <i class="fa fa-key"></i>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="conf_password">Confirm Login Password</label>
                                    <input name="conf_password" type="password" class="form-control" id="conf_password" minlength="6" placeholder="Confirm your new password">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="row icon-row">
                                <div class="form-group col-lg-6">
                                    <label for="first_name">First Name</label>
                                    <input name="first_name" value="<?php echo $user_data["first_name"] ?>" type="text" class="form-control" id="first_name" placeholder="Enter your last name">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="last_name">Last Name *</label>
                                    <input name="last_name" value="<?php echo $user_data["last_name"] ?>" type="text" required="required" class="form-control" id="last_name" placeholder="Enter your first name">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                            <div class="row icon-row">
                                <div class="form-group col-lg-6">
                                    <label for="role">Select Your Gender *</label>
                                    <select name="role" id="role" style="width: 100% !important;" class="populate" required="required" >
                                        <option <?php if ($user_data["gender"] == 'Male') echo 'selected="selected"'; ?> value="Male">Male</option>
                                        <option <?php if ($user_data["gender"] == 'Female') echo 'selected="selected"'; ?> value="Female">Female</option>
                                    </select>
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="phone">Phone</label>
                                    <input name="phone" value="<?php echo $user_data["phone"] ?>" type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
                                    <i class="fa fa-phone fa-flip-horizontal"></i>
                                </div>
                            </div>
                            <div class="row icon-row">
                                <div class="form-group col-lg-6">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input name="date_of_birth" value="<?php echo $user_data["date_of_birth"] ?>" type="date" class="form-control" id="date_of_birth" placeholder="Enter your Date of Birth">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="profile_picture">Profile Picture</label>
                                    <div class="dp-wrapper">
                                        <input id="profile_picture" type="file" name="profile_picture" class="default blank" />
                                        <div class="new-selector">
                                            <span class="file-btn"> <i class="icon-crm-folder-open-o"></i> <span class="btn-txt">Select File</span> </span>
                                            <span class="input-field"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row icon-row">
                                <div class="form-group col-lg-6">
                                    <label for="salary">Salary *</label>
                                    <input name="salary" type="text" value="<?php echo $user_data["salary"] ?>" required="required" class="form-control" id="salary" disabled="disabled">
                                    <i class="fa fa-dollar"></i>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="hourly_rate">Hourly Rate *</label>
                                    <input name="hourly_rate" type="text" value="<?php echo $user_data["hourly_rate"] ?>" required="required" class="form-control" id="hourly_rate" disabled="disabled">
                                    <i class="fa fa-clock-o "></i>
                                </div>
                            </div>

                            <div class="row icon-row">
                                <div class="form-group col-lg-6">
                                    <label for="current_password">Enter your current password *</label>
                                    <input name="current_password" type="password" class="form-control" required="required" id="current_password" minlength="6" placeholder="Enter your Current Password">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            
                            <div class="row text-right" style="border-top:1px solid #ddd; margin-top:20px; padding:15px 15px 0">
                                <button type="submit" class="btn btn-success">Update My Profile</button>
                            </div>

                        </form>

                    </div>
                </section>

            </div>
        
            <div class="col-lg-4">
                <section class="panel">
                    <header class="panel-heading"> <i class="fa fa-gear"></i> Settings</header>
                    <div class="panel-body setting">
											                        
                        <form role="form" action="<?php echo base_url()."index.php/member/updatesetting"; ?>" enctype="multipart/form-data" method="post">
                        
                            <input name="id" value="<?php echo $user_data["id"] ?>" type="hidden"/>
                            
                             <div class="form-group col-lg-12" style="margin-top:15px;">
                                <label for="share">Share calendar with: </label>
                                					
								<div class="d-menu new-table">
									<ul>
										<?php if(!empty($users_list)){
											foreach($users_list as $user){
												if($user['id'] != $current_userid){
											 ?>
										<li>
											<a href="Javascript:;" class="small" data-value="<?php echo $user['id']; ?>" tabIndex="-1">
                                                <label>
                                                <input type="checkbox" name="share_calendar[]" value="<?php echo $user['id']; ?>" <?php if(is_array(json_decode($user_data["share_calendar"]))  &&  in_array($user['id'],json_decode($user_data["share_calendar"]))){ echo 'checked'; } ?>  />
                                                <span class="input-checkbox-icon"></span>
                                                </label>
                                                <?php echo $user['first_name'].' '.$user['last_name']; ?> (<?php echo $user['email']; ?>)
											</a>
										</li>				
										<?php } } } ?>
									</ul>
								</div>
                            </div>

                            
                            <div class="clearfix"></div>
                            <div class="text-right" style="border-top:1px solid #ddd; padding:15px">
                                <button type="submit" class="btn btn-success">Update Settings</button>
                            </div>
                        </form>

                    </div>
                </section>

            </div>
        
        </div>
    </section>
</section>

<script type="text/javascript">

    $(document).ready(function(){

        var previousValue = $("#profile_picture").val();
        $('.dp-wrapper .file-btn').click(function(){
            $('#profile_picture').click();
        });

        $('#profile_picture').change(function(e){
            var fileName = e.target.files[0].name;
            $('.dp-wrapper .input-field').text(fileName);
        });
        document.getElementById('profile_picture').onchange = function() {
          if(document.getElementById("profile_picture").files.length == 0 ){
            $('.dp-wrapper .input-field').text('');
          }
        };

    });

    function checkPassword(){
        if ($("#current_password").val() == ''){
            alert("Current password is required to update any change.");
            return false;
        }

        if ($("#conf_password").val() != $("#password").val()){
            alert("Password doesn't match. Please correct the confirm password");
            return false;
        }

        return true;
    }
</script>
