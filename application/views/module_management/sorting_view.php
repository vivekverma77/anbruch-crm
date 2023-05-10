<!--<link href="<?php /*echo base_url() */?>application/third_party/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php /*echo base_url() */?>application/third_party/select2/dist/js/select2.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link href="<?php echo base_url() ?>static/js/iCheck/skins/flat/green.css" rel="stylesheet">

<!--icheck init -->
<script src="<?php echo base_url() ?>static/js/iCheck/jquery.icheck.js"></script>
<script src="<?php echo base_url() ?>static/js/icheck-init.js"></script>

<style type="text/css">
    .manage-sorting a {background:#f1f3f4; border:1px solid #ddd; width:25px; display:inline-block; height:25px; text-align:center; line-height:25px; border-radius:25px;}
    .manage-sorting a:hover {background:#e3e5e4;}
    form .row {padding:10px 0}
    form .row:hover {background:#f9fafc;}
</style>

<section id="main-content">
    <section class="wrapper">
        <div class="row col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <label for="modName">Showing Primary View of </label>
                    <select id="modName" onchange="newList()" name="modName" class="populate" style="max-width: 25%;margin-top: -2px;margin-left: 5px;min-width: 80px;">
                        <option <?php echo ($current_module == LEADS_PLURAL_NAME) ? 'selected="selected"' : ""; ?> value="<?php echo LEADS_PLURAL_NAME ?>"><?php echo LEADS_PLURAL_NAME ?></option>
                        <option <?php echo ($current_module == CLIENTS_PLURAL_NAME) ? 'selected="selected"' : ""; ?> value="<?php echo CLIENTS_PLURAL_NAME ?>"><?php echo CLIENTS_PLURAL_NAME ?></option>
                        <option <?php echo ($current_module == CONTRACTS_PLURAL_NAME) ? 'selected="selected"' : ""; ?> value="<?php echo CONTRACTS_PLURAL_NAME ?>"><?php echo CONTRACTS_PLURAL_NAME ?></option>
                    </select>
                    <a class="module_head" style="float:right;" href="<?php echo base_url() ?>index.php/modules/?cm=<?php echo $current_module; ?>"> View <?php echo $current_module; ?></a>
                </header>
                <div class="panel-body" style="padding:15px;">
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
                    <form role="form" action="?cm=<?php echo $current_module; ?>" method="post">
                        <?php foreach ($meta_fields as $key => $meta) {
                            $metaId = $meta['id'];
                            $display = $meta["display_in_short_view"];
                            $metaModuleId = $meta['module_id'];
                            $metaName = $meta['name'];
                            $idx = $meta['display_sort_id'];
                            $jsID = str_replace(" ", "_", $meta["name"]);
                            ?>
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="flat-green single-row" style="border: 1px solid #e2e2e4;border-radius: 4px;height: 34px;">

                                        <div class="radio" style="margin-top: 7px;">
                                            <label for="<?php echo $metaId ?>"><strong><?php echo $meta['name']; ?></strong></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 manage-sorting" style="padding-top:4px;">
                                    <?php if($key > 0){?><a href="<?php echo base_url() ?>index.php/ModuleManagement/modifySortingView?cm=<?php echo $current_module; ?>&order=up&id=<?=$metaId?>&idx=<?=$idx?>" title="Move Up"><i class="fa fa-arrow-up"></i></a><?php }?>
                                    <?php if(($key+1) < count($meta_fields)){?><a href="<?php echo base_url() ?>index.php/ModuleManagement/modifySortingView?cm=<?php echo $current_module; ?>&order=down&id=<?=$metaId?>&idx=<?=$idx?>"><i class="fa fa-arrow-down" title="Move Down"></i></a><?php }?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="clearfix"></div>
                        <hr/>
                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</section>

<script type="text/javascript">
    function newList(){
        var modName = $("#modName").val();
        var url = "<?php echo base_url() ?>index.php/ModuleManagement/modifySortingView?cm=" + modName;
        window.location.href = url;
    }

    function checkSelected(){
        var columns = $('input:checkbox:checked').length;

        if (columns > 10) {
            return confirm("If you select more than 10 columns to display in the view then it may slow down the page loading performance dramatically. Are you sure to proceed?");
        }

        return true;
    }
</script>
