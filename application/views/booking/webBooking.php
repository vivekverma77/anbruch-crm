<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.form.js"></script> 
<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>

<style>
td.status_col span {font-size:0; padding:6px; position:relative; cursor:pointer; z-index:1; border-radius:50px;}
td.status_col .info-warning {background:#673AB7;}
td.status_col .info-danger {background:#ff5722;}
td.status_col span:before {content:'Cancelled'; font-size:13px; position:absolute; color:#fff; top:0px; background:#73879f; padding:4px 10px; border-radius:2px; left:-34px; letter-spacing:.5px; opacity:0; transition:all .25s .25s ease; -webkit-transition:all .25s .25s ease; -ms-transition:all .25s .25s ease; -moz-transition:all .25s .25s ease; -o-transition:all .25s .25s ease;}
td.status_col .info-warning:before {content:'New'; left:-17px;}
td.status_col .info-success:before {content:'Confirmed'}
td.status_col span:hover:before {top:14px; opacity:1;}
.ui-datepicker-header {background: #1FB5AD;}
.panel-heading div {display: inline-block;}
td.no-record {text-align: center;font-size: 16px;}
.left {float: left;width: 50%;margin-bottom: 15px;}
.pagination {vertical-align:middle;display: inline-block;padding-left: 0;margin: 5px 0;border-radius: 4px;}
.sel select {border: none;border-radius: 4px;background: #eff2f7;padding:7px 20px;}
header {top:0;}
#main-content section.wrapper {display:block;}
i.fa.fa-sort { float: right; }
.uper-total{margin:20px 10px 25px 0px;}
.btn-danger {
    background-color: #d41a1a !important;
    border-color: #fa8564 !important;
    color: #fff !important;
}
.btn-danger:hover {
background-color:#9e0303 !important;
}
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">
        <div class="row">
			<div class="col-sm-12">
				<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Web Bookings </span></h3>
                <!-- panel start -->
				<section class="panel">
                    <div class="row uper-total">
                        <div class="col-sm-6">
                            <form name="frmDates" id="frmDates" method="get" action="<?php echo base_url();?>Booking/webBooking/1">
                                <input type="hidden" id="order_by" name="order_by" value="<?php echo $order_by; ?>" />
                                <input type="hidden" id="order" name="order" value="<?php echo $order; ?>" />
                                <div class="sel">
                                    <select name="sel" onchange="form.submit()">
                                        <option value="10" <?php if($sel == "10") echo "selected"; ?>>10</option>
                                        <option value="20" <?php if($sel == "20") echo "selected"; ?>>20</option>
                                        <option value="50"<?php if($sel == "50") echo "selected"; ?>>50</option>
                                        <option value="100"<?php if($sel == "100") echo "selected"; ?>>100</option>
                                    </select>
                                    <div class="btn-group hot-btn-group">
                                    <button class="btn dropdown-toggle bulk_action" style="background:#eff2f7;" data-toggle="dropdown">Action <i class="fa fa-angle-down"></i></button>
                                     <ul class="dropdown-menu">
                                        
                                     <li><a class="module_head mass_web_book_delete" data-id='web_book_del' href="javascript:;">Mass Delete</a></li>
                                    
                                    </ul>
                                  </div>
                                </div>

                            </form>
                        </div> 
					   <div class="col-sm-6" style='text-align:right;'>
						 <span style="padding:0 10px;"> Total Records: <?php echo $total_record;?> </span>
                          <?= $pagination; ?>
					   </div>
                    </div>

					
					<div class="panel-body">
                        <div style="overflow:auto; padding-bottom:20px; width:96%;margin:0 auto;">
                            <table class="display table new-table table-striped table-condensed" id="dynamic-table">
                                <thead>
                				    <tr>    
                                        <th class="all">
                                            <label style="cursor:pointer;">
                                                <input type="checkbox" onclick="selectAll('dynamic-table')" style="position:absolute; opacity:0;" />
                                                <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span>
                                            </label>
                                        </th>
                                    	<th>Sr No.</th>
                                        <th nowrap="nowrap">Status</th>
                                        <th nowrap="nowrap">Test Name</th>  
										<th nowrap="nowrap" class="sort" data-id="name">Name <i class="fa fa-sort"></i></th>
										<th nowrap="nowrap" class="sort" data-id="email">Email <i class="fa fa-sort"></i></th>
										<th nowrap="nowrap">Phone</th>
                                        <th nowrap="nowrap">Company Name</th>
                                        <th nowrap="nowrap">Province/State</th>
                                        <th nowrap="nowrap">Country</th>
                                        <th nowrap="nowrap">Booking Date</th>
                                        <th nowrap="nowrap">PDF</th>
                                        <th nowrap="nowrap">Action</th>
										<!-- <th nowrap="nowrap">Booking Time</th> -->
										<!-- <th class="sort" data-id="created_at" nowrap="nowrap">Created Time<i class="fa fa-sort"></i></th> -->					
                                    </tr>
							    </thead>

							    <tbody>
								<?php
								    $sno = $row+1;
						          
    								foreach ($result_data as $key => $bkng)
    								{

                                         if($bkng['lead_status'] == 1){
                                                $status= '<span style="padding:6px" class="alert-success">Converted</span>';
                                                $disabled='disabled';
                                         }else{
                                                $status= '<span style="padding:6px" class="alert-danger">Research</span>';
                                                $disabled='';
                                         }

    								?>
							 
									<tr> 
                                      <td class="center" style="padding-bottom:0">
                                        <label style="cursor:pointer;">
                                            <input type="checkbox" value="<?php echo $bkng['booking_id']; ?>" id="<?php echo $bkng['id'] ?>" style="position:absolute; opacity:0;" />
                                            <span class="input-checkbox-icon" style="left:0px; margin:0 6px 6px 0;"></span>
                                        </label>
                                      </td>                  
                                        <td nowrap="nowrap"><?php echo $sno; ?></td>
                                        <td nowrap="nowrap"><?php echo $status ?></td>
										<td nowrap="nowrap"><?php echo !empty($bkng["form_name"]) ? $bkng["form_name"] : ''; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["name"]; ?></td>
										<td nowrap="nowrap"><?php echo $bkng["email"]; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["phone"]; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["company_name"]; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["state"]; ?></td>
                                        <td nowrap="nowrap"><?php echo $bkng["country"]; ?></td>
                                        <td nowrap="nowrap"><?php echo date("Y-m-d H:i", strtotime($bkng["start_time"]));?></td>
                                        <td nowrap="nowrap"><a href="http://anbruch.com/wp-content/themes/anbruch/lead-pdf/<?php echo $bkng["pdf"]; ?>" target="__blank"><i class="fa fa-file-pdf" style="font-size:25px;color:#d41a1a"></i></a></td>
                                        <td nowrap="nowrap">
                                            <button id="convert-lead" <?php echo $disabled ?> data-id='<?php echo $bkng['booking_id'] ?>' class="convert-lead btn-success btn">Convert to lead</button>
                                            <button id="no-oppertunity" data-id='<?php echo $bkng['booking_id'] ?>' class="btn-danger btn no-oppertunity">No Oppertunity</button>
                                        </td>
										<!-- <td><?php echo date("Y-m-d H:i", strtotime($bkng["end_time"])); ?></td> -->
										<!-- <td nowrap="nowrap"><?php echo date("Y-m-d H:i", strtotime($bkng["created_at"])) ?></td> -->
									</tr>
						
								 <?php $sno++;
								    }
                                    if(count($result_data) == 0){
                                    echo "<tr>";
                                    echo "<td class='no-record' colspan='9'>No record found.</td>";
                                    echo "</tr>";
							        }
							     ?>
								
								</tbody>

                            </table>
                        </div>

					               <!-- Paginate -->
					    <div style='margin:10px 25px 15px 0px; text-align: right;'>
                            <span style="padding:0 10px;"> Total Records: <?php echo $total_record;?> </span>
                            <?= $pagination; ?>
					    </div>
                    
                    </div>
				</section>
                <!-- panel end -->
			</div>
		</div>
    </section>
</section>

<!--Covert to lead -->

<div class="modal fade" id="convert-lead-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header" style="background:#1EB5AD;color:#fff">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Convert To Lead</h4>
                    </div>
            <div class="modal-body">
                <form id="convert_lead_form" method="post" action="<?php echo base_url('modules/convertToLead'); ?>">
                    <input type="hidden" name="web_id" id="web_id">
                    <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label>Sevice Type </label>
                            <select multiple="" name="web_stype[]" id="web_stype" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                <option value="APPRENTICESHIP TAX - AT" >APPRENTICESHIP TAX - AT</option>
                                <option value="CUSTOMS DUTY - CD" >CUSTOMS DUTY - CD</option>
                                <option value="SALES TAX - ST" >SALES TAX - ST</option>
                                <option value="SPECIAL ISSUE - SI" >SPECIAL ISSUE - SI</option>
                                <option value="CUSTOMS DUTY DRAWBACK - CDD" >CUSTOMS DUTY DRAWBACK - CDD</option>
                            </select>
                            <script type="text/javascript">
                                    $(document).ready(function() {
                                           $("#web_stype").select2();
                                    });
                            </script>
                    </div>
                    <div class="form-group col-lg-6" style="min-height: 57px !important;">
                        <label>Lead Status </label>
                        <select name="web_lead_status" id="Lead_03" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                        <option value="ASSIGNED TO OPENER" >ASSIGNED TO OPENER</option>
                        <option value="ASSIGNED TO CLOSER" >ASSIGNED TO CLOSER</option>
                        <option value="DEAL CLOSED(WTA)" >DEAL CLOSED(WTA)</option>
                        <option value="NO OPPORTUNITY" >NO OPPORTUNITY</option>
                        <option value="RESEARCH REQUIRED" >RESEARCH REQUIRED</option>
                        <option value="RE-MARKET" >RE-MARKET</option>
                        <option value="RETENTION" >RETENTION</option>
                        <option value="JUNK LEAD" >JUNK LEAD</option>
                        <option value="RETURN TO MGMT" >RETURN TO MGMT</option>
                        <option value="NOT QUALIFIED" >NOT QUALIFIED</option>
                            </select>
                            <script type="text/javascript">
                                    $(document).ready(function() {
                                           $("#Lead_03").select2();
                                    });
                            </script>
                     </div>

                    <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label>Opener </label>
                            <select name="web_opener" id="Lead_02" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                    <?php foreach ($users_list as $option_key => $option) {
                                        if($option['role_id'] == 3){ ?>
                                            <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                    <?php } } ?>
                            </select>
                            <script type="text/javascript">
                                    $(document).ready(function() {
                                           $("#Lead_02").select2();
                                    });
                            </script>
                    </div>
                     <div class="loader"></div>
                     <div class="form-group col-lg-6" style="min-height: 57px !important;">
                            <label>CLoser </label>
                            <select name="web_closer" id="cLead_02" style="width: 100% !important; padding: 5px;" class="populate" required="required" >
                                    <?php foreach ($users_list as $option_key => $option) {
                                        if($option['role_id'] == 4){ ?>
                                            <option value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                                    <?php } } ?>
                            </select>
                            <script type="text/javascript">
                                    $(document).ready(function() {
                                           $("#cLead_02").select2();
                                    });
                            </script>
                    </div>
                    <div class="clearfix"></div>
                </form> 
            </div>
            <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button" style="background-color: #c7cbd6;border-color: #c7cbd6;color: white;">Ignore</button>
                    <button class="btn btn-success" id="confirm-convert" type="button" style="background-color: #1eb5ad;border-color: #1eb5ad;">Confirm</button>
            </div>
            </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
        var t = $('#dynamic-table123').dataTable({});

        $(".sort").click(function(){
        	var order = "<?php echo $order; ?>";
        	var order_by = $(this).attr('data-id');
            order = order == 'desc' ? 'asc' : 'desc';
            $("#frmDates #order").val(order);
        	$("#frmDates #order_by").val(order_by);
        	$("#frmDates").submit();        	
        });   
 });


var checkAll = false;
function selectAll(type){
     
       if (checkAll){
            $('#'+type+' input[type="checkbox"]').prop("checked", false);
            $("#checkboxSelect").removeClass( "btn-danger" ).addClass( "btn-primary" );
            $('#checkboxSelect').text("Select All");
            checkAll = false;
        } else {
            $('#'+type+' input[type="checkbox"]').prop("checked", true);
            $("#checkboxSelect").removeClass( "btn-primary" ).addClass( "btn-danger" );
            $('#checkboxSelect').text("Deselect All");
            checkAll = true;
        }
}
$('.mass_web_book_delete').click(function(){
    mass_booking_delete('dynamic-table','mass_web_booking_delete');    
}) 
function mass_booking_delete(type,fn){
    var uids = '';
    $("#"+type+" input:checkbox:checked").each(function() {
            var id = $(this).val();
            uids += (uids == '') ? id : ("," + id);
    });

    console.log(uids);
    if (uids == '' || uids =='on'){
            Swal.fire(
              'No record selected ?',
              'Please select record first',
              'question'
            )
            return;
    }
    
    var url = '<?php echo base_url() ?>dashboard/'+fn+'?id='+uids;
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#48B5AC',
      cancelButtonColor: '#d6d6d6',
      confirmButtonText: 'Yes, delete it!',
      showLoaderOnConfirm: true,
      preConfirm: (res) => {
        return fetch(url)
          .then(response => {
             return response
          })
          .catch(error => {
            Swal.showValidationMessage(
              `Request failed: ${error}`
            )
          })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        console.log(result.value)
      if (result.value) {
           Swal.fire(
              'Deleted Successfully !',
              "you won't recover this item",
              'success'
            )
           window.location.reload();
        }
    }) 
}
 $('.no-oppertunity').click(function(){
        var id=$(this).attr('data-id');
         Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#48B5AC',
          cancelButtonColor: '#d6d6d6',
          confirmButtonText: 'Yes, Remove it!',
          showLoaderOnConfirm: true,
          preConfirm: (res) => {
            return $.ajax({
              method:"post",
              url:"<?php echo base_url()?>modules/delete_web_booking",
              data:{'id':id},
            });
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.value) {
               Swal.fire(
                  'Web Booking Removed Successfully !',
                  "you won't recover this item",
                  'success'
                )
                window.location.reload();
            }
        }) 
    })

$('.convert-lead').click(function(){
        var id=$(this).attr('data-id');
        $('#convert-lead-modal #web_id').val(id);
        $('#convert-lead-modal').modal();
})

$('#confirm-convert').click(function(){
        
        if(!$('#web_stype').val()){
            alert('Service Type is required')
        }else{

            $('#convert_lead_form').ajaxSubmit({
               
                beforeSend:function(){
                    $('#convert-lead-modal .loader').show()
                },
                success:function(res){
                    if(res=='error'){
                        Swal.fire(
                            'Convert to lead failed !',
                            'Something went wrong',
                            'warning'
                        )
                        $('#convert-lead-modal .loader').hide()
                    }else{
                        window.location.href="<?php echo base_url(); ?>modules/viewRecord/?cm=Leads&id="+res;
                    }
                }   
            })
        }

    })

</script>
