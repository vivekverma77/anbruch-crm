<?php
if (strpos($_SERVER['SERVER_NAME'], "localhost") === false) {
    $links = "static/select2/dist/css/select2.min.css";
    $links .= ",static/js/data-tables/DT_bootstrap.css";

    $js = "static/select2/dist/js/select2.min.js";
    $js .= ",static/js/advanced-datatable/js/jquery.dataTables.js";
    $js .= ",static/js/data-tables/DT_bootstrap.js";
?>
<!--
<link rel="stylesheet" href="<?php /*echo base_url() */?>min/?f=<?php /*echo $links; */?>&124"/>
<script type="text/javascript" src="<?php /*echo base_url() */?>min/?f=<?php /*echo $js; */?>&124"></script>

//Current version 124
-->
    <link rel="stylesheet" href="<?php echo base_url() ?>static/minified_master/mVersion124.css"/>
    <script type="text/javascript" src="<?php echo base_url() ?>static/minified_master/mVersion124.js"></script>

<?php } else { ?>
<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>
<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<?php } ?>

<style type="text/css">
    .adv-table .dataTables_filter label input{
        margin-left: 0 !important;
        float: none !important;
        width: 90%;
    }

    #dynamic-table_filter{
        padding: 0 !important;
        width: 100% !important;
    }

    #dynamic-table_wrapper .span6{
        display: inline-block !important;
        width: 50% !important;
        padding: 15px 0 !important;
    }

    .adv-table .dataTables_filter label input{
        width: 55% !important;
    }
</style>

<section id="main-content">
    <section class="wrapper" style="width: auto; min-width: 100%;">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <span class="module_head"><?php echo $current_module; ?>&nbsp;|&nbsp;</span>
                        <label for="rStat">Showing </label>
                        <select id="rStat" onchange="newList()" name="rStat" class="populate" style="max-width: 25%;margin-top: -2px;margin-left: 5px;min-width: 80px;">
                            <option <?php echo ($recordStatus == 1) ? 'selected="selected"' : ""; ?> value="1">Archived</option>
                            <option <?php echo ($recordStatus == 3) ? 'selected="selected"' : ""; ?> value="3">Active</option>
                            <?php if ($current_module == "Leads") { ?><option <?php echo ($recordStatus == 4) ? 'selected="selected"' : ""; ?> value="4">Converted</option><?php } ?>
                        </select>
                        <label for="own"> Records of </label>
                        <?php if ($superAdmin == true) {  ?>
                            <select id="own" onchange="newList()" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
                                <?php foreach ($users_list as $option_key => $option) { ?>
                                    <option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                <?php } ?>
                            </select>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#own").select2();
                                });
                            </script>
                        <?php } else { echo $username; } ?>
                        <label for="page"> | Displaying Records </label>
                        <select id="page" onchange="newList()" name="page" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
                            <?php
                                $total_page = ceil(($total_record / RECORD_LIMIT_IN_EACH_PAGE));
                                $offsetStart = 0;
                                $offsetEnd = $offsetStart + RECORD_LIMIT_IN_EACH_PAGE;
                            ?>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                <option <?php echo ($page == $i) ? 'selected="selected"' : "" ?> value="<?php echo $i; ?>"><?php echo "From $offsetStart to $offsetEnd"; ?></option>
                                <?php $offsetStart = $offsetEnd + 1; $offsetEnd = (($offsetEnd + RECORD_LIMIT_IN_EACH_PAGE) > $total_record) ? $total_record : ($offsetEnd + RECORD_LIMIT_IN_EACH_PAGE) ; ?>
                            <?php } if ($total_record == 0) { echo '<option value="1">No record found</option>'; } ?>
                        </select>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#page").select2();
                            });
                        </script>

                        <div style="float: right;">
                            <?php if ($writePermission == true) { ?>
                                <a class="module_head" href="<?php echo base_url() ?>index.php/modules/addRecord/?cm=<?php echo $current_module; ?>&ac=new">Add New Record</a> |
                            <?php } ?>
                            <a class="module_head" href="<?php echo base_url() ?>index.php/modules/advanceSearch/?cm=<?php echo $current_module; ?>&ac=advanceSearch">Advanced Search</a>
                        </div>
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

                        <!-- Modal -->
                        <div class="modal fade" id="modalOwnerUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Select new record owner</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group col-lg-6" style="min-height: 57px !important;">
                                            <label>New Officer *</label>
                                            <select name="__0" id="0" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                                <?php foreach ($users_list as $option_key => $option) { ?>
                                                    <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <script type="text/javascript">
                                                $(document).ready(function() {
                                                    $("#0").select2();
                                                });
                                            </script>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button data-dismiss="modal" class="btn btn-default" type="button">Ignore</button>
                                        <button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change owner of');" type="button">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal -->
                        <div class="adv-table">
                            <?php if ($superAdmin == true) { ?>
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <button id="checkboxSelect" onclick="selectAll()" class="btn btn-primary">Select All</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
<!--                                            <li><a href="#">Mass Field Update</a></li>-->
                                            <li><a class="module_head" data-toggle="modal" href="#modalOwnerUpdate">Mass Owner Update</a></li>
                                            <li><a class="module_head" data-toggle="modal" href="#">Mass Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                            <form id="record_list_table">
                                <table class="display table table-bordered table-striped table-condensed" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <?php if ($writePermission == true) { ?>
                                            <th>Select Record</th>
                                        <?php } ?>
                                        <?php
                                        foreach ($record_data as $key => $record) {
                                            foreach ($record['meta'] as $metaFieldName => $metaValue) {
                                                ?>
                                                <th><?php echo $metaFieldName ?></th>
                                            <?php
                                            }
                                            break;
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($record_data as $key => $record) {
                                        ?>
                                        <tr>
                                            <?php if ($writePermission == true) { ?>
                                                <td class="center"><input type="checkbox" value="<?php echo $key; ?>"
                                                                          id="<?php echo $key; ?>"/></td>
                                            <?php } ?>
                                            <?php
                                            $link = false;
                                            foreach ($record['meta'] as $metaFieldName => $metaValue) {
                                                $column_value = $metaValue;
                                                if (is_array($column_value)){
                                                    $column_value = '';
                                                    foreach ($metaValue as $singleValueKey => $singleValue){
                                                        $column_value .= ($column_value == '') ? "&lt;$singleValue&gt;" : ", &lt;$singleValue&gt;";
                                                    }
                                                }
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($link == false) {
                                                        echo '<a class="list_link" href="' . base_url() . 'index.php/modules/viewRecord/?cm=' . $current_module  . "&id=$key&record_status=" . $record['static']['record_status'] . '">';
                                                    }

                                                    if ($link == false) {
                                                        if ($column_value == '') {
                                                            echo "No $metaFieldName available";
                                                        } else {
                                                            echo $column_value;
                                                        }
                                                    } else {
                                                        echo $column_value;
                                                    }

                                                    if ($link == false) echo '</a>';

                                                    $link = true;
                                                    ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </form>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>

<script type="text/javascript">
    var checkAll = false;
    function newList(){
        var own = $("#own").val();
        var page = $("#page").val();
        var rStat = $("#rStat").val();
        var url = "<?php echo base_url() ?>index.php/modules/?cm=<?php echo $current_module; ?>&own=" + own + "&rStat=" + rStat + "&page=" + page;
        window.location.href = url;
    }

    function selectAll(){
        if (checkAll){
            $('#record_list_table input[type="checkbox"]').prop("checked", false);
            $("#checkboxSelect").removeClass( "btn-danger" ).addClass( "btn-primary" );
            $('#checkboxSelect').text("Select All");
            checkAll = false;
        } else {
            $('#record_list_table input[type="checkbox"]').prop("checked", true);
            $("#checkboxSelect").removeClass( "btn-primary" ).addClass( "btn-danger" );
            $('#checkboxSelect').text("Deselect All");
            checkAll = true;
        }
    }

    function bulkActionOnUser(action, actionText){
        var uids = '';
        $("input:checkbox:checked").each(function() {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
        });

        if (uids == ''){
            alert("No user has been selected. Please select an user first.");
            return;
        }

        var newOwner = $("#0").val();
        var url = '<?php echo base_url() ?>index.php/Modules/?cm=<?php echo $current_module; ?>&bulk=on&ac=' + action + '&new=' + newOwner + '&uid=' + uids;
        if (confirm("Are you sure that you want to " + actionText + " these selected users?")) {
            window.location.href = url;
        }
    }

    $(document).ready(function() {
        $('#dynamic-table').dataTable( {
            "aaSorting": [[0,'desc']],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "oLanguage": {
                "sSearch": "Quick Search (On displaying records)"
            }
        } );
    } );
</script>