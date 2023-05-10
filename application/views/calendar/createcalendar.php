<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.minicolors.css');?>">


<style type="text/css">
  .form-control, .select2-container--default .select2-selection--single {background:#f1f3f4;}
  .header-back-btn {position:absolute; left:-40px; border-radius:50%; font-size:20px; color:#7e7e7e; top:15px;}
  .header-back-btn:hover {background:#fff;}
  .select2-container--default .select2-results>.select2-results__options::-webkit-scrollbar{width:4px; height:4px;}
  .select2-container--default .select2-results>.select2-results__options::-webkit-scrollbar-track {background:#ddd; }
  .select2-container--default .select2-results>.select2-results__options::-webkit-scrollbar-thumb {background:#1fb5ad; border-radius:50px;}
  .select2-container--default .select2-results>.select2-results__options::-webkit-scrollbar-thumb:hover {background:#3c8c88;}
  .select2-container--default .select2-results__option--highlighted[aria-selected] {background:#f5f5f5; color:#767676;}
  .select2-container--default .select2-results__option[aria-selected=true] {background-color:#1fb5ad; color:#fff;}
  .select2-container--default .select2-results__option--highlighted[aria-selected=true] {background-color:#169c95; color:#fff;}
  .select2-search.select2-search--dropdown {padding:0; overflow:hidden;}
  .select2-search.select2-search--dropdown .select2-search__field {border-width:0 0 1px; border-radius:4px 4px 0 0; background:#f5f5f5; padding:7px;}

   .minicolors-theme-default {margin-left:30px;}
   .minicolors-theme-default .minicolors-input {height:31px; padding-left:15px; border:1px solid #ddd;}
   .minicolors-theme-default .minicolors-swatch {top:10px; left:-23px; width:14px; height:14px; border-radius:30px; border:0; overflow:hidden;}

   .btn-info {background:#1eb5ad; border-color:#1eb5ad;}
   .btn-info:hover {background:#129e97; border-color:#129e97;}

   @media (min-width: 568px) {
    .form-container {margin-left: 8.33333333%; width:462px; max-width:100%;}
   }
   @media (max-width: 567px) {
    .header-back-btn {left:40px; top:20px; background:#e5e5e5 !important;}
    .page-title {padding-left:65px; line-height:40px;}
   }
</style>

<section id="main-content">
    <section class="wrapper">

        <div class="row">

            <div class="col-xs-12 form-container">

                <section class="panel new-layout" style="padding:20px 20px 0;">

                  <a class="btn header-back-btn" href="<?php echo base_url('booking');?>"> <i class="fas fa-arrow-left"></i>  </a>

                  <h3 class="page-title" style="margin-top:0;">New calendar</h3>

                    <div class="panel-body" style="padding:15px 0 0;">
                        <form role="form" action="<?php echo base_url('calendar/createcalendar');?>" method="post">
                          
							<div class="clearfix"></div>
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input name="name" type="text" class="form-control" id="title" placeholder="Enter Calendar Name" required="required">
                            </div>                       
                            <div class="form-group">
                                <label for="description" >Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter calendar description" rows="5"></textarea>  
                            </div>
                             <div class="form-group">
                                <label for="timezones" style="display:block;">Time zone</label>
                                <?php $default = date_default_timezone_get();?>
                                <select class="form-control" name="timezones" id="timezones">
                                 <?php foreach(tz_list() as $t) { ?>
                                  <option value="<?php print $t['zone'] ?>" <?php echo ($default == $t['zone'] ? 'selected' : '');  ?>>
                                    <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                                  </option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Owner</label>
                                <input  type="text" class="form-control" readonly="" name="owner" value="<?php  echo $this->session->userdata('email');?>" style="font-weight:400 !important; cursor:not-allowed;">
                            </div>
                             <div class="clearfix"></div>
                            <div class="form-group hidden">
                                <label for="color">Color</label>
                                <input type="text" id="color" class="form-control color" data-control="hue" value="#bdb7b7" name="color">
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="modal-footer" style="padding-right:0;">
                              <button type="submit" class="btn btn-info"> Add <i class="fas fa-plus-circle" style="margin-left:10px"></i></button>
                            </div>
                            
                        </form>

                    </div>
                </section>

            </div>
        </div>
    </section>
</section>
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url('assets/js/jquery.minicolors.min.js');?>"></script>
<?php
function tz_list() {
  $zones_array = array();
  $timestamp = time();
  foreach(timezone_identifiers_list() as $key => $zone) {
    date_default_timezone_set($zone);
    $zones_array[$key]['zone'] = $zone;
    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  }
  return $zones_array;
}
?>
<script type="text/javascript">
    $(document).ready(function() {
     $("#timezones").select2();
     $('.color').minicolors();
    });
</script>
