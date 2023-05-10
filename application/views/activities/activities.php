<style type="text/css">
.adv-table table.display {width:100% !important;}
.adv-table table.display thead th {width:auto !important; padding-right:25px;}
</style>


<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.responsive.css">

<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.responsive.min.js"></script>

<section id="main-content" class="page_activities">
    <section class="wrapper" style="width: auto; min-width: 100%;">

        <div class="row">
            <div class="col-sm-12">

                <h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Activities</span> </h3>

                <section class="panel">
                    <header class="panel-heading">
                        <div class="row">
                          <div class="col-left">
                            <label>Showing Activities of </label>
                            <?php if ($superAdmin == true) {  ?>
                                <select id="own" onchange="newList()" name="own" class="populate">
                                    <?php foreach ($users_list as $option_key => $option) { ?>
                                        <option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                    <?php } ?>
                                </select>
                            <?php } else { echo $username; } ?>
                          </div>

                          <div class="col-right">
                            <a class="module_head" href="<?php echo base_url() ?>activities/addActivity/">Add New Activity</a>
                          </div>
                        </div>
                    </header>

                    <div class="panel-body">
                        <div class="adv-table">
                            <?php if ($superAdmin == true) { ?>
                                <div class="bulk-action out-from-table">
                                    <div class="btn-group">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Bulk Action <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Mass Owner Update</a></li>
                                            <li><a href="#">Mass Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                            <form id="record_list_table">
                                <table class="display table table-striped table-condensed new-table" id="dynamic-table">
                                    <thead>
                                    <tr>
                                        <?php if ($superAdmin == true) { ?>
                                            <th class="no_sorting" nowrap> <label style="cursor:pointer;"> <input type="checkbox" onclick="selectAll()"  style="position:absolute; opacity:0;"> <span class="input-checkbox-icon" ></span></label> </th>
                                        <?php } ?>
                                        <th class="no_sorting" nowrap>Actions</th>
                                        <th nowrap>Title</th>
                                        <th nowrap>Type</th>
                                        <th nowrap>Due Date</th>
                                        <th nowrap>Priority</th>
                                        <th nowrap>Status</th>
                                        <th nowrap>Created By</th>
                                        <th nowrap>Created Time</th>
                                        <th nowrap>Modified Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($record_data as $key => $record) {
                                        $createdBy = $record['first_name'] . " " . $record['last_name'];
                                        $createdTime = date("j-F-Y", $record['created_time']);
                                        $modifiedTime = ($record['modified_time'] == '') ? "Not Modified Yet" : date("j-F-Y", $record['modified_time']);
                                        ?>
                                        <tr>
                                            <?php if ($superAdmin == true) { ?>
                                                <td nowrap> <label style="cursor:pointer;"> <input type="checkbox" value="<?php echo $key; ?>" id="<?php echo $key; ?>" style="position:absolute; opacity:0;"/> <span class="input-checkbox-icon"></span> </label> </td>
                                            <?php } ?>
                                            <td nowrap>
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>activities/editRecord/?id=<?php echo $key; ?>">Edit</a>
                                                |
                                                <a class="list_link"
                                                   href="<?php echo base_url() ?>activities/viewRecord/?&id=<?php echo $key; ?>">View</a>
                                            </td>
                                            <td nowrap><?php echo $record["name"]; ?></td>
                                            <td nowrap><?php echo $record["type"]; ?></td>
                                            <td nowrap><?php echo $record["due_date"]; ?></td>
                                            <td nowrap><?php echo $record["priority"]; ?></td>
                                            <td nowrap><?php echo $record["status"]; ?></td>
                                            <td nowrap><?php echo $createdBy ?></td>
                                            <td nowrap><?php echo $createdTime ?></td>
                                            <td nowrap><?php echo $modifiedTime ?></td>
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
        var url = "<?php echo base_url() ?>index.php/activities/?&own=" + own;
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

    $(document).ready(function() {
        $('#dynamic-table').dataTable( {
            "aaSorting": [[0,'desc']],
            "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
            "responsive": true
        } );
    } );
</script>