<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <a class="module_head" href="<?php echo base_url() ?>index.php/UserManagement/">Back to User List</a> |
                        New User
                    </header>
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

                        <form role="form" action="" method="post" onsubmit="return checkPassword();">
                            <div class="form-group col-lg-12" style="min-height: 57px !important;">
                                <label for="email">User's Email *</label>
                                <input name="email" type="email" required="required" class="form-control" id="email" placeholder="Enter email address for the new user">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="password">User's Login Password *</label>
                                <input name="password" type="password" required="required" class="form-control" id="password" minlength="6" placeholder="Enter password for the new user">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="conf_password">Confirm User's Login Password *</label>
                                <input name="conf_password" type="password" required="required" class="form-control" id="conf_password" minlength="6" placeholder="Confirm password for the new user">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="last_name">User's Last Name *</label>
                                <input name="last_name" type="text" required="required" class="form-control" id="last_name" placeholder="Enter last name for the new user">
                            </div>
                            <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                <label for="role">Select User's Role *</label>
                                <select name="role" id="role" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                    <?php foreach ($users_role as $role_id => $role_name) { ?>
                                        <option value="<?php echo $role_id; ?>"><?php echo $role_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                            <button type="submit" class="btn btn-info">Create New User</button>
                        </form>

                    </div>
                </section>

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