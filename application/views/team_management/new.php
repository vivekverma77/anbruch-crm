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

.d-menu{
    font-size: 16px;	
    height:260px;
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

.new-table {border:0;}
.d-menu li a {position:relative;}
.d-menu label {display:inline-block; margin:15px 0; cursor:pointer; color:#989898;}
.d-menu label input {position:absolute; opacity:0;}
.new-table .input-checkbox-icon {margin:0 6px 0 0;}
</style>
<section id="main-content">
    <section class="wrapper">

        <div class="row"> 

            <div class="col-lg-6" style="margin-left:100px;">
                <form role="form" action="" method="post">
                <section class="panel new-layout">
                    <header style="margin:-20px -20px 30px; clear:both; padding-left:17px; border-bottom:1px solid #ccc;">

                        <a class="btn header-back-btn" href="<?php echo base_url() ?>index.php/TeamManagement/"> <i class="fas fa-arrow-left"></i> </a>

                        <div class="title">
                            <h4 style="font-weight:400; letter-spacing:1px;"> Add new team</h4>
                        </div>

                        <div class="icons-plot">
                            <button type="submit" class="icon create-team">
                                <i class="fas fa-users"></i>
                                <span class="hover-title" style="width:110px; margin-left:-30px;">Create team</span>
                            </button>
                        </div>
                    </header>
                    <div class="panel-body">
                                             
                        <?php $this->load->view('common/alert'); ?>
                        
                        <div class="row">
                            <div class="form-group col-xs-6">
                                <label for="name">Team Name *</label>
                                <input name="name" type="text" required="required" class="form-control" id="name" placeholder="Enter name">
                            </div>
                            
                            <div class="form-group col-xs-12">
                                <label for="role">Select Team Members *</label>
                                <div class="d-menu new-table">
                                    <ul>
                                        <?php if(!empty($users_list)){
                                            foreach($users_list as $user){ ?>
                                        <li>
                                            <a href="Javascript:;" class="small" data-value="<?php echo $user['id']; ?>" tabIndex="-1">
                                                <label>
                                                    <input type="checkbox" name="members[]" value="<?php echo $user['id']; ?>"/>
                                                    <span class="input-checkbox-icon"></span>
                                                </label>
                                                <?php echo $user['first_name'].' '.$user['last_name']; ?> (<?php echo $user['email']; ?>)
                                            </a>
                                        </li>               
                                        <?php  } } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                            <div style="text-align:right; margin-top:35px; padding-top:15px; border-top:1px solid #ddd;">
                                <button type="submit" class="btn btn-success">Create team <i class="fa fa-users icon-right"></i> </button>
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
