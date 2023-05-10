<!--dynamic table-->
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_page.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/advanced-datatable/css/demo_table.css" />
<link rel="stylesheet" href="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.css" />
<!--dynamic table-->
<script type="text/javascript" src="<?php echo base_url() ?>static/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>static/js/data-tables/DT_bootstrap.js"></script>

<link href="<?php echo base_url() ?>static/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>static/select2/dist/js/select2.min.js"></script>

<style>
	.ui-datepicker-header {
		background: #1FB5AD;
	}
	
.panel-heading div {
  display: inline-block;
}

.form-group label {
    font-weight: bold;
}

#modalContent .form-group {
    margin-bottom: 15px;
    background: #eaeaea;
    padding: 6px 6px 0px 6px;
    border-radius: 3px;
}

td.no-record {
    text-align: center;
    font-size: 16px;
}

.left {
    float: left;
    width: 50%;
    margin-bottom: 15px;
    margin-left: 75px;
}

.pagination {
	vertical-align:middle;
    display: inline-block;
    padding-left: 0;
    margin: 5px 0;
    border-radius: 4px;
}

.sel select {
    border: none;
    border-radius: 4px;
    height: 29px !important;
    background: #eeeeee;
}

.sel {
    position: absolute;
    top:138px;
    left: 30px;
}
.gmail_quote {display: none;}
.ques_tab {
    padding: 14px 15px 15px 62px;
    position: relative;
}
.repl_tab {
    padding: 0 0 15px;
}
.user-meta {
    color: #999;
    font-size: 12px;
    margin-bottom: 3px;
}
.user-meta b {
    color: #000;
    font-size: 18px;
}
.action-col {display: none;}

header {top:0;}
#main-content section.wrapper {display:block;}

td.details table tr td, .dataTable tr:last-child {background:#fff; border-bottom:1px solid #ddd;}
</style>
<section id="main-content">
	<section class="wrapper" style="width: auto; min-width: 100%;">

		<div class="row">
			<div class="col-sm-12">
				<h3 class="tab-title" style="margin-bottom:10px; font-size:24px;"> <span class="page-title">Emails </span></h3>
				<section class="panel">
					<header class="panel-heading">
						
						<?php if ($superAdmin == true) {  ?>
						<div>			
							
							<form name="frmDates" method="get" action="<?php echo base_url();?>reports/emails/1">

								Showing

								<select id="own" name="own" class="populate" style="max-width: 50%;margin-top: -2px;margin-left: 5px;min-width: 15%;">
									<option value="">All Users</option>
								<?php foreach ($users_list as $option_key => $option) { ?>
										<option <?php echo ($own == $option['id']) ? 'selected="selected"' : "" ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
								<?php } ?>
								</select>
								<script type="text/javascript">
									$(document).ready(function() {
											$("#own").select2();
									});
								</script>
								
								<label for="fromDate" style="padding:0 10px;">From </label>
								<input name="fromDate" id="fromDate" class="date-picker" value="<?php echo @$fromDate; ?>" style="padding:7px; border-radius:4px; border:1px solid #e2e2e4;" autocomplete="off">

								<label for="toDate" style="padding:0 10px;">To </label>
								<input name="toDate" id="toDate" class="date-picker" value="<?php echo @$toDate; ?>" style="padding:7px; border-radius:4px; border:1px solid #e2e2e4;" autocomplete="off">

								<button type="submit" id="go" class="btn btn-primary" style="padding:5.5px 12px; margin:-3px 0 0 3px;">Go</button>

							<div class="sel">
								<select name="sel" onchange="form.submit()">
									<option value="10" <?php if($sel == "10") echo "selected"; ?>>10</option>
									<option value="20" <?php if($sel == "20") echo "selected"; ?>>20</option>
									<option value="50"<?php if($sel == "50") echo "selected"; ?>>50</option>
									<option value="100"<?php if($sel == "100") echo "selected"; ?>>100</option>
								</select>
							</div>
								
							</form>	
						</div>							
						<?php } ?>

						<?php if(!empty($emails)) { ?>
						<a class="module_head" href="<?php echo base_url() ?>reports/emails_print/?own=<?php echo $own; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" target="_blank" style="float: right;">Print</a>
						
						<a class="module_head" href="<?php echo base_url() ?>reports/emails_export/?own=<?php echo $own; ?>&fromDate=<?php echo $fromDate; ?>&toDate=<?php echo $toDate; ?>" style="float: right;margin-right: 2px;">Export</a>					
						<?php } ?>
					
					</header>

				    	<div class="uper-total">
				    		<?php if($pagination){ ?>
							   <div style='margin-top: 10px; text-align: right; margin-right: 19px;'>
							   	<span style="padding:0 10px;">Total Records: <?php echo $total_record;?></span>
									<?= $pagination; ?>
								</div>
                      		<?php } else {?>
							   <div style='margin-top: 50px;text-align: right;margin-right: 19px;'>
							   	<span style="padding:0 10px; position:relative; top:-20px;">Total Records: <?php echo $total_record;?></span>
									<?= $pagination; ?>
								</div>
                      		<?php }?>
                 	</div>
					
					<div class="panel-body">

						<?php $this->load->view('common/alert'); ?>						

        		<div style="overflow:auto; width:100%;">
            		<table class="display table new-table table-striped table-condensed" id="dynamic-table">
							<thead>
								<tr>
									<th nowrap="nowrap">Sr No.</th>	
									<th nowrap="nowrap">Action</th>
									<th nowrap="nowrap">From</th>
									<th nowrap="nowrap">To</th>
									<!--th nowrap="nowrap">Cc</th>
									<th nowrap="nowrap">Bcc</th-->
									<th nowrap="nowrap">Subject</th>                    
									<!--th nowrap="nowrap">Content</th-->                    
									<th nowrap="nowrap">Created By</th>
									<th nowrap="nowrap">Created Time</th>
								</tr>
							</thead>
							<tbody>
								
							<?php
								$sno = $row+1;
								foreach ($result_data as $key => $val)
								{												
							?>							 
									<tr>              
										<td nowrap="nowrap"><?php echo $sno; ?></td>
										<td nowrap="nowrap">
											<textarea style="display:none;" class="content_<?php echo $val["id"]; ?>" ><?php echo $val["content"]; ?></textarea>
											<input type="hidden" class="file_<?php echo $val["id"]; ?>" value="<?php echo $val['attachment'];?>">
											<a class="list_link view_content" href="javascript:;" data-id="<?php echo $val["id"]; ?>">View</a>
										<!--			
											|
											<a class="list_link" href="<?php //echo base_url(); ?>reports/deleteEmail?id=<?php// echo $val["id"]; ?>" onclick="return confirm('Are you sure to delete permanently?')">Delete</a>\
										-->	
										</td>
										<td nowrap="nowrap" class="from_<?php echo $val["id"]; ?>"><?php echo $val["from"]; ?></td>
										<td nowrap="nowrap" class="to_<?php echo $val["id"]; ?>"><?php echo $val["to"]; ?></td>
										<!--td nowrap="nowrap"><?php echo $val["cc"]; ?></td>
										<td nowrap="nowrap"><?php echo $val["bcc"]; ?></td-->
										<td nowrap="nowrap" class="subject_<?php echo $val["id"]; ?>"><?php echo $val["subject"]; ?></td>
										<!--td nowrap="nowrap">
											
										</td-->
										<td nowrap="nowrap"><?php echo $val["first_name"].' '.$val["last_name"]; ?></td>
										<td nowrap="nowrap"><?php echo date("m/d/Y h:ia", strtotime($val["created_time"]));?></td>
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
   <div style='margin-top: 10px; text-align: right;'>

   <?= $pagination; ?>
   </div>
      
        
					</div>
				</section>
			</div>
		</div>

	</section>
</section>

	<!-- Modal -->
	<div class="modal fade" id="modalContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width: 900px; color:#73879C;">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" style="color:#73879C;"> <strong>Subject :</strong> <span class="msubject"></span></h4>
						</div>
						<div class="modal-body">
								<div >
									<label>From:</label> <span class="mfrom"></span>
								</div>
								<div>
									<label>To:</label> <span class="mto"></span>
								</div>

								<div style="margin-top:30px;">
									<div class="tab-title">
										<span>Notes</span>
									</div>
									<span class="mcontent"></span>
								</div>

								<div style="margin-top:30px;">
									<div class="tab-title">
										<span>Attachment:</span>
									</div>
								  <div class="attached_files" style="margin: 10px 0 20px;"></div>
								</div>
								<div class="clearfix"></div>
								<!-- <div class="email_replies">
									<h3> <i class="fa fa-comment"></i> Replies</h3>
									<div id="replies_data_feed"></div>
									<img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" class="ajax-loader" style="width: 100px;margin: -20px 15px 0 15px;" >
								</div> -->
						</div>
						<div class="modal-footer" style="text-align: center;">
								<button data-dismiss="modal" class="btn btn-success" type="button">Ok</button>
								<!--button class="btn btn-success" onclick="bulkActionOnUser('mOwner','change owner of');" type="button">Confirm</button-->
						</div>
				</div>
		</div>
	</div>
	<!-- modal -->

<script type="text/javascript">
	var base_url = "<?php echo base_url();?>";
	$(function()
	{
    $('.date-picker').datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'dd-mm-yy',        
    });

    $(".view_content").on("click",function()
    {
			var id = $(this).attr("data-id");
			var from = $(".from_"+id).html();
			var to = $(".to_"+id).html();
			var subject = $(".subject_"+id).html();
			var content = $(".content_"+id).val();
			var attachment = $(".file_"+id).val();

			$(".mfrom").html(from);
			$(".mto").html(to);
			$(".msubject").html(subject);
			$(".mcontent").html(content);
			if(attachment){
				var url = base_url + 'upload/emails/'+attachment;
				$(".attached_files").html('<i class="fa fa-download"></i> <a href="'+url+'"  name="attachment" class="btn-link" download title="Download file">'+attachment+'</a>');
			}else{
				$(".attached_files").html('');
			}
			
			

			$("#modalContent").modal("show");
			
		});
	});
	
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
        var t = $('#dynamic-table22').dataTable( {
					//"aaSorting": [[2,'desc']],
					//"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],					 
        });   
    
    } );

     /*Get all customer replies fetched from gmail */
 $(document).on("click",".list_link.view_content",function(){    
  var dataId =  $(this).attr('data-id');
  var fromEmail =  $(this).closest('tr').find('.to_'+dataId).text();
  var subject = $(this).closest('tr').find('.subject_'+dataId).text();
  var subjectCode = "Anbruch-"+dataId+": "+subject;
  $('.ajax-loader').show();
  $('#replies_data_feed').html('');
  $.ajax({
    type:'get',
    dataType:'JSON',
    url:base_url + 'reports/getInboxEmails/'+encodeURIComponent(subjectCode)+'/'+ encodeURIComponent(fromEmail),
    success:function(data){
    	$('.ajax-loader').hide();
      if(typeof data != 'undefined' && data != ''){
        var receiverMessage =  data.receiverMessage || '';
        if(receiverMessage){
          var replieshtml = '';

          $.each(receiverMessage,function(index2, value2){
            //console.log(value.sender);
            var messages2 = value2.body || '';
            attachment2 = value2.attachment || '';
             replieshtml += '<div class="ques_tab"><div class="repl_tab">';
             replieshtml += '<div class="user-meta"><b><i class="fa fa-mail-reply-all"></i> '+value2.sender+'</b> Responded '+value2.date+'</div><div class="questext">'+messages2+'</div>';
             /*if(attachment2)
            {
             $.each(attachment2,function(index2, filename)
             { 
             replieshtml += '<div class="attached-file"><i class="fa fa-download"></i> <a href="'+base_url+'upload/RFI/'+filename.filename+'" download>'+filename.filename+'</a></div>';
              });
            }*/

            replieshtml += '</div></div>';
          });
          console.log(replieshtml);
          $('#replies_data_feed').html(replieshtml);
        }
    
      }else
      {
      	 $('#replies_data_feed').html("<p class='alert alert-info fade in'>There are no received emails found.</p>");
      }
      
    },
    error:function(){
      $('.ajax-loader').hide();	
      console.log("There are some problem in display emails");
    }
  });
 }); 

</script>
