<style>
.p-menu{
   font-size: 16px;	
}
.p-menu ul li {
  list-style: none;
	padding: 4px 0px 3px 10px;
	border: 1px solid #e4efed;
	width: 23%;
	display: inline-block;
	margin: 0 0 4px 0;
}    
ul, .list-unstyled {
    padding-left: 0;
}

.new-layout header:before, .new-layout header:after {
    content: '';
    display: table;
    clear: both;
}

header .title {
    float: left;
    width: 75%;
    text-align: left;
    padding: 15px 0;
}

.permissions label {display:inline-block; margin:15px 5px 8px; cursor:pointer; user-select:none; color:#989898;}
.permissions label input {position:absolute; opacity:0;}
.new-table .input-checkbox-icon {margin:0;}
.permissions .tag {padding:8px 10px 8px 30px; background:#f1f3f4; border:1px solid #ddd; margin-left:-27px; border-radius: 5px;}
.permissions input:checked ~ .tag {color:#767676; background:#e1e3e4; border-color:#d5d5d5;}

</style>
<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-7" style="margin-left:100px;">
                <form role="form" action="" method="post" onsubmit="return checkPassword();">
                    <section class="panel new-layout">
                    <header style="margin:-20px -20px 30px; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">
                        <a class="btn header-back-btn" href="<?php echo base_url() ?>UserManagement"> <i class="fas fa-arrow-left"></i> </a>

                        <div class="title">
                            <h4 style="font-weight:400; letter-spacing:1px;"> Edit User </h4>
                        </div>

                        <div class="icons-plot">
                            <button type="submit" class="icon update-user">
                                <i class="fas fa-user"></i>
                                <span class="hover-title" style="width:110px; margin-left:-31px;">Update User</span>
                            </button>
                        </div>
                    </header>
                    <div class="panel-body">
                        <?php $this->load->view('common/alert'); ?>
<!--
                        <div class="alert alert-info alert-block fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            <h4>
                                <i class="icon-ok-sign"></i>
                                Attention!
                            </h4>
                            <p>All of the fields are required. The newly created user will be activated as soon as it's created. Please make sure the email address is accessible.</p>
                        </div>
-->

                        <div class="tab-title">
                            <span>User Info</span>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="email">User's Email *</label>
                                <input type="email" required="required" class="form-control" id="email" placeholder="Enter email address" value="<?php if(!empty($user)){ echo $user['email']; } ?>" disabled>
                            </div>
                            <div class="form-group col-lg-6">  
                                <label for="role">Select User's Role *</label>
                                <select name="role" id="role" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                    <?php foreach ($users_role as $role_id => $role_name) { ?>
                                        <option value="<?php echo $role_id; ?>" <?php if(!empty($user) && $user['role']==$role_name){ echo 'selected'; } ?>><?php echo $role_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="first_name">User's First Name *</label>
                                <input name="first_name" type="text" required="required" class="form-control" id="first_name" placeholder="Enter first name" value="<?php if(!empty($user)){ echo $user['first_name']; } ?>">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="last_name">User's Last Name *</label>
                                <input name="last_name" type="text" required="required" class="form-control" id="last_name" placeholder="Enter last name" value="<?php if(!empty($user)){ echo $user['last_name']; } ?>">
                            </div>
                       
                            
                             <div class="form-group col-lg-6">
                                <label for="password">User's Login Password *</label>
                                <input name="password" type="password" class="form-control" id="password" minlength="6" placeholder="Enter password to update otherwise left empty">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="conf_password">Confirm User's Login Password *</label>
                                <input name="conf_password" type="password" class="form-control" id="conf_password" minlength="6" placeholder="Confirm password  to update otherwise left empty">
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label for="first_name">User's Monthly Target *</label>
                                <input name="monthly_target" type="number" required="required" class="form-control" id="monthly_target" placeholder="Enter monthly target for the new user" value="<?php if(!empty($user)){ echo $user['monthly_target']; } ?>">
                            </div>
                        </div>
                            
                            
                        <div class="tab-title" style="margin:25px 0 15px;">
                            <span>Salary & Hourly Rate</span>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="first_name">User's Salary *</label>
                                <input name="salary" type="number" required="required" class="form-control" id="salary" placeholder="Enter salary" value="<?php if(!empty($user)){ echo $user['salary']; } ?>">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="first_name">User's Hourly Rate *</label>
                                <input name="hourly_rate" type="number" required="required" class="form-control" id="hourly_rate" placeholder="Enter hourly rate" value="<?php if(!empty($user)){ echo $user['hourly_rate']; } ?>">
                            </div>
                        </div>
                            
                            <div class="tab-title" style="margin:25px 0 0;">
                                <span>User Permissions</span>
                            </div>
                            
                            <?php $permissions = json_decode($user['permissions']); ?>

                            <div class="permissions new-table" style="border:0;">
                                <label>
                                    <input type="checkbox" name="p[]" value="activities" <?php if(!empty($user['permissions']) && in_array('activities',$permissions)){ echo 'checked'; } ?> />
                                    <span class="input-checkbox-icon"></span> <span class="tag">Activities</span>
                                </label>

                                <label>
                                    <input type="checkbox" name="p[]" value="bookings" <?php if(!empty($user['permissions']) && in_array('bookings',$permissions)){ echo 'checked'; } ?> />
                                    <span class="input-checkbox-icon"></span> <span class="tag">Bookings</span>
                                </label>

                                <label>
                                    <input type="checkbox" name="p[]" value="leads" <?php if(!empty($user['permissions']) && in_array('leads',$permissions)){ echo 'checked'; } ?> />
                                    <span class="input-checkbox-icon"></span> <span class="tag">Leads</span>
                                </label>

                                <label>
                                    <input type="checkbox" name="p[]" value="clients" <?php if(!empty($user['permissions']) && in_array('clients',$permissions)){ echo 'checked'; } ?> />
                                    <span class="input-checkbox-icon"></span> <span class="tag">Clients</span>
                                </label>

                                <label>
                                    <input type="checkbox" name="p[]" value="contracts" <?php if(!empty($user['permissions']) && in_array('contracts',$permissions)){ echo 'checked'; } ?> />
                                    <span class="input-checkbox-icon"></span> <span class="tag">Contracts</span>
                                </label>

                                <label>
                                    <input type="checkbox" name="p[]" value="emailtemplates" <?php if(!empty($user['permissions']) && in_array('emailtemplates',$permissions)){ echo 'checked'; } ?> />
                                    <span class="input-checkbox-icon"></span> <span class="tag">Email Templates</span>
                                </label>

                               <!--  <label>
                                    <input type="checkbox" name="p[]" value="holidays" <?php if(!empty($user['permissions']) && in_array('holidays',$permissions)){ echo 'checked'; } ?> />
                                    <span class="input-checkbox-icon"></span> <span class="tag">Holidays</span>
                                </label> -->
                            </div>
                            
                            <div style="text-align:right; margin-top:35px; padding-top:15px; border-top:1px solid #ddd;">
                                <button type="submit" class="btn btn-success">Update User <i class="fa fa-user icon-right"></i> </button>
                            </div>

                    </div>
                </section>
                </form>

            </div>
        </div>
    </section>
</section>

<script type="text/javascript">
    function checkPassword(){
        if ($("#conf_password").val() != $("#password").val()){
            alert("Password doesn't match. Please correct the confirm password");
            return false;
        }

        return true;
    }
</script>
