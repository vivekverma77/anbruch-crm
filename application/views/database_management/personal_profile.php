<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">Personal Profile</header>
                    <div class="panel-body">
                        <?php if (isset($message)) foreach ($message as $key => $value) { ?>
                            <div class="alert alert-<?php echo $key ?> alert-block fade in">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    <?php echo ucfirst($key) ?>!
                                </h4>
                                <p><?php echo $value ?></p>
                            </div>
                        <?php } ?>
                        <form role="form" action="" enctype="multipart/form-data" method="post" onsubmit="return checkPassword();">
                            <input name="id" value="<?php echo $user_data["id"] ?>" type="hidden"/>
                            <div class="form-group col-lg-12" style="min-height: 57px !important;">
                                <label for="email">Email Address *</label>
                                <input name="email" type="email" value="<?php echo $user_data["email"] ?>" required="required" class="form-control" id="email" disabled="disabled">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="password">Login Password</label>
                                <input name="password" type="password" class="form-control" id="password" minlength="6" placeholder="Leave empty if you don't want to change your password">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="conf_password">Confirm Login Password</label>
                                <input name="conf_password" type="password" class="form-control" id="conf_password" minlength="6" placeholder="Confirm your new password">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="first_name">First Name</label>
                                <input name="first_name" value="<?php echo $user_data["first_name"] ?>" type="text" class="form-control" id="first_name" placeholder="Enter your last name">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="last_name">Last Name *</label>
                                <input name="last_name" value="<?php echo $user_data["last_name"] ?>" type="text" required="required" class="form-control" id="last_name" placeholder="Enter your first name">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="role">Select Your Gender *</label>
                                <select name="role" id="role" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                    <option <?php if ($user_data["gender"] == 'Male') echo 'selected="selected"'; ?> value="Male">Male</option>
                                    <option <?php if ($user_data["gender"] == 'Female') echo 'selected="selected"'; ?> value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="phone">Phone</label>
                                <input name="phone" value="<?php echo $user_data["phone"] ?>" type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="date_of_birth">Date of Birth</label>
                                <input name="date_of_birth" value="<?php echo $user_data["date_of_birth"] ?>" type="date" class="form-control" id="date_of_birth" placeholder="Enter your Date of Birth">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="current_password">Enter your current password *</label>
                                <input name="current_password" type="password" class="form-control" required="required" id="current_password" minlength="6" placeholder="Enter your Current Password">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="profile_picture">Profile Picture</label>
                                <input id="profile_picture" type="file" name="profile_picture" class="default" />
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                            <button type="submit" class="btn btn-info">Update My Profile</button>
                        </form>

                    </div>
                </section>

            </div>
        </div>
    </section>
</section>

<script type="text/javascript">
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