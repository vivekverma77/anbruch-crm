<?php
//echo '<pre>';print_r($record_data); die;

$company_name_key = "__" . CLIENTS_CLIENT_NAME_META_ID;										
$first_name_key = "__" . CLIENTS_FIRST_NAME_META_ID;
$last_name_key = "__" . CLIENTS_LAST_NAME_META_ID;

$status_key = "__" . CLIENTS_STATUS_META_ID;
$phone_key = "__" . CLIENTS_PHONE_NUMBER_META_ID;
$email_key = "__" . CLIENTS_EMAIL_META_ID;

$first_name = isset($record_data[$first_name_key]) ? $record_data[$first_name_key] : "";
$last_name = isset($record_data[$last_name_key]) ? $record_data[$last_name_key] : "";

$status = isset($record_data[$status_key]) ? $record_data[$status_key] : "No Status Available";
$call_status = isset($record_data['__27']) ? $record_data['__27'] : "No Status Available";

$contract_number = isset($record_data['__165']) ? $record_data['__165'] : "No Contract No. Available";
$signing_rate = isset($record_data['__164']) ? $record_data['__164'] : "No Singing Rate Available";
$preferred_number = isset($record_data['__166']) ? $record_data['__166'] : "No Preferred Number Available";
$visit_location = isset($record_data['__167']) ? $record_data['__167'] : "No Visit Location Available";

$phone = isset($record_data[$phone_key]) ? $record_data[$phone_key] : "No Phone Number Available";
$email = isset($record_data[$email_key]) ? $record_data[$email_key] : "No Email Available";
$company_name = isset($record_data[$company_name_key]) ? $record_data[$company_name_key] : "No Company Name Available";

$technical_consultant = (isset($record_data['__169']) && $record_data['__169']) ? $record_data['__169'] : "Not Available";
$accountant = (isset($record_data['__170']) && $record_data['__170']) ? $record_data['__170'] : "Not Available";
$contractCategory =  (isset($record_data['__223']) && $record_data['__223']) ? $record_data['__223'] : "Cold";
/*if($opener == 2)
	$opener = 'Bernadette Lucanas';
if($closer == 4)
	$closer = 'Pawel Krzemieniecki';*/
//$opener = $closer = '';
//echo $opener;

foreach($users_list as $arr_usr)
{
	if($arr_usr['id'] == $technical_consultant)
	{
		$technical_consultant = $arr_usr['title'];
	}
	if($arr_usr['id'] == $accountant)
	{
		$accountant = $arr_usr['title'];
	}
}								
?>

<style type="text/css">
  #edit_contract_info_start_division .select2-container{width: 178px !important;}
  #edit_contract_pro_info_start_division .select2-container{width: 178px !important;}
  
</style>
<!--<img style="height: 42px; width: 42px;" alt="" src="<?php echo base_url() ?>static/images/boyAvatar.png">-->

<div class="hero-row top-border contract-view">

      <div id="l-info" class="collapsible-card card color-theme">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-lead-info" id="contract_height">
            <div class="col">
              <h4>Contract Information</h4>
            </div>
            <div>
              <span class="toggle-card-btn bg-purple-50">
                <i class="icon-crm-angle-up"></i>
              </span>
            </div>
          </div>

<div id="collapse-lead-info" class="card-content collapse in collapsed-have-height-equalizer row" style="height: 550px;">

	<div class="col-sm-7">
		<div id="contract-info" class="color-theme">
	        <h3 class="card-title"><?php echo @$record_data["__160"]; ?> </h3>
        	 <div class="contract-status">
                      <?php 

                          foreach ($notes as $key => $note) {
                                  if( $key == 0 ) {  
                                         
                                    $last_lead = date("m/d/Y H:i:s", $note['created_time']);                      
                                   }        
                                 }                       
                          if($contractCategory == 'Hot') {?>
                            <img src="<?php echo base_url()?>assets/images/hot.png">
                             <div><?php echo $last_lead; ?></div>
                          <?php }else{ ?>
                            <img src="<?php echo base_url()?>assets/images/cold.png">
                            <div><?php echo $last_lead; ?></div>
                          <?php } ?>
                          </div>
                            

                            <div style="padding:10px 0;margin-top: 8px">
                        <?php //if(!$openerRights){ ?>
                         <?php if($record_data['__223']=="Hot"){?>
                                <a href="#modalFollow" id="c_unfollow_id" class="btn btn-round btn-fill-theme"> <i class="icon-crm-user-plus"></i> Unfollow </a>
                              <!-- <span style="background:#1fb5ad; color:#fff; margin:0 8px; padding:1px 9px; border-radius:25px; display:inline-block; position:relative; top:2px; box-shadow:0 0 7px #ccc;" ><i class="icon-crm-user-plus"></i> Followed </span> -->
                            <?php } else{
                              ?>
                              <a href="#modalFollow" id="c_follow_id" class="btn btn-round btn-fill-theme"> <i class="icon-crm-user-plus"></i> Follow </a>
                            <?php } ?>
                          	
                            <button type="button" id="edit_details"  class="btn icon-btn btn-blue-o"><i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Record</span></button>
                              
                              </div>
            <div class="card-content">
              <div class="table-structure-info" id="edit_details_division">
	              <table>
	                <tr>
	                  <th nowrap>Contract Owner</th>
		                  <td>
		                  	<?php foreach ($users_list as $option_key => $option) 
		                  	//echo "<pre>";print_r($users_list);die();
							{ ?>
									<?php if ($option['id'] == $record_data["__0"]) 
									{ $lead_owner = $option['title']?>
											<span><?php echo $option['title']; ?></span>
									<?php 
									} ?>
							<?php 
							} ?>
						</td>
	                </tr>
	                <tr>
	                  <th nowrap>Contract Client</th>
	                  <td>
	                  		<?php foreach ($active_clients_list as $option_key => $option) 
							{ ?>
									<?php if ($option['id'] == $record_data["__161"]) 
									{ ?>
											<span><?php echo $option['title']; ?></span>
									<?php 
									} ?>
							<?php 
							} ?>
	                  </td>
	                </tr>
	                <tr>
	                  <th nowrap>Contract Number</th>
	                  <td> <?php echo $contract_number ?></td>
	                </tr>
	                <tr>
	                  <th nowrap>Signing Rate</th>
	                  <td><?php echo $signing_rate."%" ?></td>
	                </tr>
	                <tr>
	                  <th nowrap>Preferred Number</th>
	                  <td><?php echo $preferred_number ?></td>
	                </tr>
	                <tr>
	                  <th nowrap>Visit Location</th>
	                  <td><?php echo $visit_location ?></td>
	                </tr>
	                 <tr>
                      <th nowrap>Last updated date</th>
                      <td>
                         <?php 
                         
                            if(!empty($record_data['modified_time']))
                               echo date('Y-m-d H:i',$record_data['modified_time']);
                            else
                               echo date('Y-m-d H:i',$record_data['created_time']); 
                          ?>
                      </td>
                    </tr>
	              </table>
			 </div>
<!--           DETEAILS EDIT START -->                
                  <div class="table-structure-info" id="edit_details_start_division" style="display: none">
                     <table>
                  <form  role="form" id="contract_details_form" method="post" action="<?php echo base_url('/modules/contract_edit_by_individual_tab/?cm=Contracts'); ?>" >
                    <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                    <input type="hidden" name="detail_set" value="detail">
                    <tr>
                  <th nowrap>Contract Owner</th>
	                  <td>
	                  	<select id="contract_owner" name="contract_owner">
                            <?php 
                                foreach ($users_list as $option_key => $option)
                                {
                                   if ($option['id'] == $record_data["__0"]) 
                                   { $selected = "selected"; } else { $selected = ""; }
                                
                                ?>
                                  <option  <?php echo $selected; ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
                               <?php  }
                              ?>
                        </select>
					</td>
                </tr>   
                      
                    <tr>
                       <th nowrap>Contract Client</td>
                       <td id="tab_main_name">
                          <select id="personal_country" name="__161">
                            <?php 
                               $already_selected =  isset($record_data['__161'])?$record_data['__161']:''; 
                                foreach($active_clients_list as $value)
                                {
                                   if($already_selected == $value['id'])
                                   { $selected = "selected"; } else { $selected = ""; }
                                
                                ?>
                                  <option  <?php echo $selected; ?> value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
                               <?php  }
                              ?>
                        </select>
                         </td>
                    </tr>
                    <tr>
                       <th nowrap>Contract Number</td>
                       <td id="tab_main_function">
                        <input type="text" readonly value="<?php echo $contract_number ?>">
                        </td>
                    </tr>
                    
                    <tr>
                      <th nowrap>Signing Rate</th>
                      <td id="tab_main_email">
                        <input type="number" min="1" required="" name="__164" value="<?=$record_data['__164']?>">                    
                        </td>
                    </tr>
                 
                    <tr>
                      <th nowrap>Preferred Number</th>
                      <td>
                        <input type="text" required="" name="__166" value="<?php echo isset($record_data['__166'])?$record_data['__166']:''; ?>">
                        </td>
                    </tr>
             
                    <tr>
                      <th nowrap>Visit Location	</th>
                      <td>
                      <input type="text" required="" name="__167" value="<?php echo isset($record_data['__167'])?$record_data['__167']:''; ?>">
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                         <button type="button" name="Cancle_update_details" id="Cancle_update_details" class="btn btn-success">Cancel</button>
                         <button type="button" name="update_details" id="update_details" class="btn btn-success">Update Details</button>
                      </td>
                    </tr>
               </form>  
                 </table>
              </div>
 <!--   DETEAILS EDIT END -->                            
            </div>
            <div class="card-footer">
				<?php if(!empty($invoice_data)) {  ?>
				<a href="<?php echo base_url()."modules/invoice"; ?>?cm=<?php echo $current_module; ?>&id=<?php echo $current_record_id; ?>&invoice_id=<?php echo $invoice_data["id"]; ?>" id="view_invoice" class="btn btn-theme-o">View Invoice</a>
				<?php } else { ?> 
				<a href="<?php echo base_url()."modules/create_invoice"; ?>?cm=<?php echo $current_module; ?>&ac=create_invoice&id=<?php echo $current_record_id; ?>" id="create_invoice" class="btn btn-theme-o">Create Invoice</a>
				<?php } ?>
				
				<a href="javascript:void(0)" id="send_email" class="btn btn-theme-o"  data-email="<?php echo @$record_data['__4'] ?>">SEND EMAIL</a>

				<!-- <a class="btn btn-theme-o" data-toggle="modal" href="#modalOwnerUpdate">Add Notes</a> -->
				<!-- <a class="btn btn-theme-o" data-toggle="modal" href="#modalQualified">Qualified Data</a> -->
				
            </div>
		</div>
	</div> <!-- /.col-sm-7 -->

	<div class="col-sm-5">
		  
	      <div id="notes-info" class="color-theme collapsible-card bordered-card notes">

	        <div class="flex-row toggable-header"  data-target="#notes-LAI"  aria-expanded="true">
	          <div class="col">
	            <h4 style="display:inline-block">Notes</h4>
	             <a class="reminder-btn" id="reminders" href="#reminder-modal" title="Reminders" data-toggle="modal" ><i class="fa fa-clock-o"></i><span class="reminder-count"></span></a>
	      
	        	</div>
	     	</div>
	        <div class="flex-row" style="padding: 15px 0px">
              <div class="col-sm-4">
                <select id="note-response" style="color:#41beb8 !important;font-weight:600 !important;background: #e0f7fa;border-color: #1fb5ad;border-radius:4px;margin-left: -12px;">
                  <option value="">Choose Response</option>
                  <option value="Voice mail">Voice mail</option>
                  <option value="Not interested">Not interested</option>
                  <option value="Call back">Call back</option>
                  <option value="Do not call">Do not call</option>
                  <option value="Send Email">Send Email</option>
                  <option value="Booked Appointment">Booked Appointment</option>
                  <option value="New Contact Req'd">New Contact Req'd</option>
                  <option value="Wrong Contact Info">Wrong Contact Info</option>
                  <option value="Gate Keeper Blocked">Gate Keeper Blocked</option>
                </select>
              </div>
               <div class="col-sm-4" style="left: 45px">
                <input type="search" class="form-control" placeholder="search" id="Notes_search">
              </div>
              <div class="col-sm-4">
                   <a class="btn btn-theme-o" id="add-note-btn" data-toggle="modal" href="#modalOwnerUpdate">Add Note</a>
                   <a class="btn btn-theme-o" id="save-note-btn" href="#">Save Note</a>
              </div>
              
            </div>	

	        <div id="notes-LAI" class="card-content collapse panel-group additional-info-accordion collapse in"  aria-expanded="true">

	          <div id="collapse-notes1" class="collapse in  notes-body note_search_result_panel">
	              <?php  if (isset($notes) && count($notes) > 0) {?>
	                  <?php $id = 0; foreach ($notes as $key => $note) { $id ++; if($id == 1) { ?>
	                  <div class="panel panel-default">
	                     <div class="panel-heading">
	                        <h4 style='font-size:11px;'  class="panel-title" data-toggle="collapse" data-parent="#notes-LAI" href="#<?php echo $note['id'] ?>"> Note <?php echo $id ?>
	                              <span style="margin-left: 5px;">|</span>
	                        <strong class="text-info" style="color:#444;margin-left: 5px;">Posted on: <?php echo date('m/d/Y H:i', $note["created_time"]); ?> by <?php echo $note["created_by"] ?></strong>
	                        <i class="fa fa-plus pull-right" style="margin-top: 3px;"></i> </h4>
	                      </div>
	                    <div id="<?php echo $note['id'] ?>" class="panel-collapse collapse in">
	                        <div class="well well-large" style="padding:10px;padding-top: 2px;padding-bottom: 7px;">
	                            
	                            <!-- <hr style="margin: 0;"/>
	                            <h4 style="margin-top: 5px;color:#0098E3;font-size:12pt;font-weight:bold;"><?php //echo $note["note_title"] ?></h4> -->
	                            <?php echo $note["note"] ?>
	                        </div>
	                     </div>
	                    </div>
	                  <?php } else { ?>
	                  <div class="panel panel-default">
	                     <div class="panel-heading">
	                        <h4 style='font-size:11px;'  class="panel-title" data-toggle="collapse" data-parent="#notes-LAI" href="#<?php echo $note['id'] ?>"> Note <?php echo $id ?>
	                              <span style="margin-left: 5px;">|</span>
	                         <strong class="text-info" style="color:#444;margin-left: 5px;">Posted on: <?php echo date('m/d/Y H:i', $note["created_time"]); ?> by <?php echo $note["created_by"] ?></strong>
	                        <i class="fa fa-plus pull-right" style="margin-top: 3px;"></i> </h4>
	                      </div>
	                    <div id="<?php echo $note['id'] ?>" class="panel-collapse collapse in">
	                     
	                        <div class="well well-large" style="padding:10px;padding-top: 2px;padding-bottom: 7px;">
	                            
	                            

	                            <!-- <hr style="margin: 0;"/>
	                            <h4 style="margin-top: 5px;color:#0098E3;font-size:12pt;font-weight:bold;"><?php// echo $note["note_title"] ?></h4> -->
	                            <?php echo $note["note"] ?>
	                        </div>
	                     </div>
	                    </div>
	                  <?php } ?>

	                  <?php } ?>
	              <?php } else { ?>
	                  <h3 class="text-center" style="margin: 0;">No notes available.</h3>
	              <?php } ?>
	              </div>
	        </div> <!-- /#notes-LAI -->

	      </div> <!-- /#lead-additional-info -->	
    
		</div> <!-- /.col-sm-4 -->
	</div>
</div>
	
</div> <!-- /.hero-row -->

<div class="section-row">
	
        <div class="collapsible-card card top-border" id="contract-company-info">
            <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target=".other-info">
                <div class="col">
                   <h4>Contract Company Infomation</h4>
                </div>
                <div>
                  <span class="toggle-card-btn bg-purple-50">
                  <i class="icon-crm-angle-down"></i>
                  </span>
                </div>
            </div>
            <div class="other-info collapsed-have-height-equalizer collapse in">
               <div class="col-md-4 l-border" style="min-height: 530px">
	            	<div id="contract-info1">	
						  <div class="card-header flex-row toggable-header">
							<div class="col">
							  <h4>Contract Information
                   <button style="left:35px;"type="button" id="edit_contract_info"  class="btn icon-btn btn-blue-o">
                  <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Contract Information</span></button> 
                </h4>
							</div>
							
						  </div>
						  <div id="collapse-contract-info">
						  	<div class="table-structure-info" id="edit_contract_info_division">
							  <table>
								<tr> <th nowrap>Contract Stage:</th> <td> <?=$record_data['__162']?>  </td></tr>
								<tr> <th nowrap>Service Type:</th> <td> <?php if(!empty((array)$record_data['__163'])) { echo implode(', </br> ',(array)$record_data['__163']); } ?> </td></tr>		
								<tr> <th nowrap>Title:</th> <td> <?= @$record_data['__83']?>  </td></tr>	
								<tr> <th nowrap>Function:</th> <td> <?= @$record_data['__89']?>  </td></tr>	
								<tr> <th nowrap>Direct Number:</th> <td> <?= @$record_data['__100']?>  </td></tr>	
								<tr> <th nowrap>Direct Number <br> Extension:</th> <td> <?=@$record_data['__96']?>  </td></tr>	
								<tr> <th nowrap>Alternate Phone:</th> <td> <?= @$record_data['__103']?>  </td></tr>	
								<tr> <th nowrap>Email:</th> <td> <?= @$record_data['__85']?>  </td></tr>	  
							  </table>
						  	</div>
 <!--                contract information edit start -->
                  <div class="table-structure-info" style="display: none" id="edit_contract_info_start_division">
                     <form  role="form" id="contract_info_form" method="post" action="<?php echo base_url('/modules/contract_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="contract_info" value="contract_info">
                  <table>
                    <tr> 
                      <th nowrap>Contract Stage:</th>
                       <td>  
                        <select id="contract_stage" name="__162" style="width: 178px;">
                                <?php 
                                   $already_selected =  isset($record_data['__162'])?$record_data['__162']:''; 
                                    foreach($contract_stage as $value)
                                    {
                                       if($already_selected == $value)
                                       { $selected = "selected"; } else { $selected = ""; }
                                  
                                    ?>
                                      <option  <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                   <?php  }
                                  ?>
                          </select> 
                      </td> 
                     </tr>
                    <tr> 
                      <th nowrap>Service Type:</th> 
                      <td>
                           
                           <select class="multi-select" multiple id="c_service_type" name="__163[]">
                                <?php 
                                   $already_selected =  isset($record_data['__163'])?$record_data['__163']:''; 
                                    foreach($contract_service_type as $value)
                                    {
                                       $flag = true;
                                     if(!is_array($already_selected))
                                      {
                                        if($already_selected == $value)
                                        {
                                          ?>

                                          <option selected value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                  <?php  $flag = false;    }
                                      }
                                      
                                      foreach ($already_selected as $multi) { 
                                        if($multi == $value)
                                           { 
                                ?>
                                            <option selected value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                     <?php
                                           $flag=false; 
                                              } 
                                          }
                                          if($flag)
                                          {                                 ?>                                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                   <?php   } }
                                  ?>
                          </select> 
                       </td> 
                    </tr>
                    <tr>
                     <th nowrap>Title:</th>
                      <td><input type="text" required="" name="__83" value="<?=$record_data['__83']?>"> 
                    </td> 
                  </tr>
                    <tr> 
                      <th nowrap>Function:</th>
                       <td><input type="text" required="" name="__89" value="<?=$record_data['__89']?>">  
                     </td>
                      </tr>
                   
                     <th nowrap>Direct Number:</th>
                      <td><input type="text" required="" name="__100" value="<?=$record_data['__100']?>"> 
                    </td>
                     </tr>
                    <tr>
                     <th nowrap>Direct Number Extension:</th>
                      <td><input type="text" required="" name="__96" value="<?=$record_data['__96']?>"> 
                       </td>
                        </tr>
                    <tr> 
                      <th nowrap>Alternate Phone:</th> 
                      <td><input type="text" required="" name="__103" value="<?=$record_data['__103']?>"> 
                    </td> 
                  </tr>
                    <tr> 
                      <th nowrap>Email:</th> <td> 
                        <input type="text" required="" name="__85" value="<?=$record_data['__85']?>">
                      </td>
                       </tr>
                    <tr>
                      <td colspan="2">
                       <button type="button" name="Cancle_update_contract_info" id="Cancle_update_contract_info" class="btn btn-success">Cancel</button>
                       <button type="button" name="update_contract_info" id="update_contract_info" class="btn btn-success">Update Details</button>
                    </td>
                   </tr>
                  </table>
                </form>
            </div>
<!--    contract information edit end -->               
						  </div>
					</div> <!-- /#contract-info -->
               	
               </div>
               <div class="col-md-4 l-border">
					<div id="contract-processor-info" class="collapsible-card">
					  <div class="card-header flex-row toggable-header">
						<div class="col">
					      <h4>Contract Processor Information
                   <button style="left:35px;"type="button" id="edit_contract_pro_info"  class="btn icon-btn btn-blue-o">
                  <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Contract Processor Information</span></button> 
                </h4>
						</div>
					  </div>

				  <div id="collapse-contract-processor-info">
				  	<div class="table-structure-info" id="edit_contract_pro_info_division">
					  <table>
             <tr><th>Contract ID</th><td><?=$current_record_id ?></td></tr> 
						<tr> <th nowrap>Technical Consultant:</th> <td><?=$technical_consultant?></td> </tr>
						<tr> <th nowrap>Technical Consultant Status:</th> <td><?= @$record_data['__171']?></td> </tr>
						<tr> <th nowrap>Accountant:</th> <td><?=$accountant?></td> </tr>
						<tr> <th nowrap>Accountant Status:</th> <td><?= @$record_data['__172']?></td> </tr>
						<tr> <th nowrap>Admin Status:</th> <td><?= @$record_data['__173']?></td> </tr>
						<tr>
					  	  <th nowrap>Accountants Expected <br> Start Date:</th>
					  	  <td><?= strtotime($record_data['__174']) != false ?  date("m/d/Y", strtotime($record_data['__174'])) :'';?></td>
						</tr>
						<tr>
					  	  <th nowrap>Technical Expected <br> Start Date:</th>
					  	  <td><?=  strtotime($record_data['__175']) != false ? date("m/d/Y", strtotime($record_data['__175'])) : '';?></td>
						</tr>
						<tr>
						  <th nowrap>Accountants Actual <br> Start Date:</th>
						  <td><?=  strtotime($record_data['__176']) != false ? date("m/d/Y", strtotime($record_data['__176'])) : '';?></td>
						</tr>
						<tr>
						  <th nowrap>Technical Actual <br> Start Date:</th>
						  <td><?=  strtotime($record_data['__177']) != false ? date("m/d/Y", strtotime($record_data['__177'])) : '';?></td>
						</tr>
					  </table>
				  	</div>
<!--                contract processor information edit start -->
                  <div class="table-structure-info" style="display: none" id="edit_contract_pro_info_start_division">
                     <form  role="form" id="contract_pro_info_form" method="post" action="<?php echo base_url('/modules/contract_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="contract_pro_info" value="contract_pro_info">
                  <table>
                    <tr> 
                      <th nowrap>Technical Consultant:</th>
                       <td>  
                        <select id="tech_con" name="__169" style="width: 178px;">
                                   <?php 
                                   $already_selected = isset($record_data['__169'])?$record_data['__169']:'';
                                    foreach($tech_const as $value)
                                    {
                                      $value1 = $value['first_name'] . " " .$value['last_name'];
                                       if($already_selected == $value['user_id'])
                                       { $selected = "selected"; } else { $selected = ""; }
                                    ?>
                                      <option  <?php echo $selected; ?> value="<?php echo $value['user_id']; ?>"><?php echo $value1; ?></option>
                                   <?php  }
                                  ?>
                          </select> 
                      </td> 
                     </tr>
                    <tr> 
                      <th nowrap>Technical Consultant Status:</th> 
                      <td>
                           <select id="tech_con_st" name="__171" style="width: 178px;">
                                <?php 
                                   $already_selected =  isset($record_data['__171'])?$record_data['__171']:''; 
                                    foreach($tech_consts as $value)
                                    {
                                       if($already_selected == $value)
                                       { $selected = "selected"; } else { $selected = ""; }
                                  
                                    ?>
                                      <option  <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                   <?php  }
                                  ?>
                          </select> 
                       </td> 
                    </tr>
                    <tr>
                     <th nowrap>Accountant:</th>
                      <td>   
                      
                           <select id="acc_sel" name="__170" style="width: 178px;">
                                   <?php 
                                   $already_selected = isset($record_data['__170'])?$record_data['__170']:'';
                                    foreach($accountants as $value)
                                    {
                                      $value1 = $value['first_name'] . " " .$value['last_name'];
                                       if($already_selected == $value['user_id'])
                                       { $selected = "selected"; } else { $selected = ""; }
                                    ?>
                                      <option  <?php echo $selected; ?> value="<?php echo $value['user_id']; ?>"><?php echo $value1; ?></option>
                                   <?php  }
                                  ?>
                          </select> 
                    </td> 
                  </tr>
                    <tr> 
                      <th nowrap>Accountant Status:</th>
                       <td>  
                        <select id="acc_sel_st" name="__172" style="width: 178px;">
                                <?php 
                                   $already_selected =  isset($record_data['__172'])?$record_data['__172']:'';
                                    foreach($acc_status as $value)
                                    { 
                                       if($already_selected == $value)
                                       { $selected = "selected"; } else { $selected = ""; }
                                    ?>
                                      <option  <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                   <?php  }
                                  ?>
                          </select> 
                     </td>
                      </tr>
                   
                     <th nowrap>Admin Status:</th>
                      <td><input type="text" required="" name="__173" value="<?=$record_data['__173']?>"> 
                    </td>
                     </tr>
                    <tr>
                     <th nowrap>Accountants Expected <br> Start Date:</th>
                      <td><input type="date" required="" name="__174" value="<?=$record_data['__174']?>"> 
                       </td>
                        </tr>
                    <tr> 
                      <th nowrap>Technical Expected <br> Start Date:</th> 
                      <td><input type="date" required="" name="__175" value="<?=$record_data['__175']?>"> 
                    </td> 
                  </tr>
                    <tr> 
                      <th nowrap>Accountants Actual <br> Start Date:</th> <td> 
                        <input type="date" required="" name="__176" value="<?=$record_data['__176']?>">
                      </td>
                       </tr>
                         <tr> 
                      <th nowrap>Technical Actual <br> Start Date:</th> <td> 
                        <input type="date" required="" name="__177" value="<?=$record_data['__177']?>">
                      </td>
                       </tr>
                    <tr>
                      <td colspan="2">
                       <button type="button" name="Cancle_update_contract_pro_info" id="Cancle_update_contract_pro_info" class="btn btn-success">Cancel</button>
                       <button type="button" name="update_contract_pro_info" id="update_contract_pro_info" class="btn btn-success">Update Details</button>
                    </td>
                   </tr>
                  </table>
                </form>
            </div>
<!--    contract processor information edit end -->                   
				  </div>
				</div>  <!-- /#contract-processor-info -->
               	
               </div>
               <div class="col-md-4 l-border" style="min-height: 530px">
					<div id="description-info" class="collapsible-card">
					  <div class="card-header flex-row toggable-header">
						<div class="col">
					      <h4>Description Information
                  <button style="left:35px;"type="button" id="edit_contract_d_info"  class="btn icon-btn btn-blue-o">
                  <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Contract Processor Information</span></button>
                </h4>
						</div>
					  </div>

					  <div id="collapse-description-info">
					  	<div class="table-structure-info" id="edit_contract_d_info_division">
					  	  <table>
							<tr>
							  <th nowrap>Final Invoice Number:</th>
							  <td><?=(isset($record_data['__178']))? "#".$record_data['__178']:''?></td>
							</tr>
							<tr>
							  <th nowrap>Invoice Date:</th>
							  <td><?=(isset($record_data['__179'])) && strtotime($record_data['__179']) != false ? date("m/d/Y", strtotime($record_data['__179'])):''?></td>
							</tr>
							<tr>
							  <th nowrap>Invoice Paid CAD:</th>
							  <td><?=(isset($record_data['__180']))?$record_data['__182']:''?></td>
							</tr>
							<tr>
							  <th nowrap>Total Recovery Amount CAD:</th>
							  <td><?=(isset($record_data['__181']))?$record_data['__181']:''?></td>
							</tr>
							<tr>
							  <th nowrap>Invoiced Amount CAD:</th>
							  <td><?=(isset($record_data['__182']))?$record_data['__182']:''?></td>
							</tr>
							<tr>
                  <th nowrap>Description:</th>
							  <td>
							  	<?=(isset($record_data['__196']))?$record_data['__196']:''?></td>
							</tr>
					  	  </table>
					  	</div>
<!--                contract processor information edit start -->
                  <div class="table-structure-info" style="display: none" id="edit_contract_d_info_start_division">
                     <form  role="form" id="contract_d_info_form" method="post" action="<?php echo base_url('/modules/contract_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="contract_d_info" value="contract_d_info">
                  <table>
                    <tr> 
                      <th nowrap>Total Recovery Amount CAD: </th>
                       <td>  
                       <input type="number" min="1" required="" name="__181" value="<?=$record_data['__181']?>">
                     </td>
                      </tr>
                    <tr>
                     <th nowrap>Description:</th>
                      <td>
                      <textarea name="__196">
                        <?=$record_data['__196']?>
                      </textarea> 
                       </td>
                        </tr>
                    <tr>
                      <td colspan="2">
                       <button type="button" name="Cancle_update_contract_d_info" id="Cancle_update_contract_d_info" class="btn btn-success">Cancel</button>
                       <button type="button" name="update_contract_d_info" id="update_contract_d_info" class="btn btn-success">Update Details</button>
                    </td>
                   </tr>
                  </table>
                </form>
            </div>
<!--    contract processor information edit end -->               
					  </div>
					</div> <!-- /#description-info -->	
               	
               </div>	
           	</div>
        </div>
   	
</div>

<?php if (!isset($deletedRecord) || $deletedRecord != true) { ?>
				
	<div class="row section-row" id="bookings-card">
		<div class="col-xs-12">
			<?php require_once "bookings.php"; ?>
		</div>
	</div>

	<div class="row section-row">
		<div class="col-xs-12" id="contract-activity">
			<?php  require_once "new_activities1.php"; ?>
		</div>
	</div> 

	<div class="row section-row">
		<div class="col-xs-12">
			<?php require_once "attachment.php"; ?>
		</div>
	</div>
		
		
<?php } ?>
<script type="text/javascript">
	$(document).ready(function(){
    $('#contract_owner').select2();
    $('#contract_stage').select2();
    $('#c_service_type').select2();
    $('#tech_con').select2();
    $('#tech_con_st').select2();
    $('#acc_sel').select2();
    $('#acc_sel_st').select2();
			 //details
     $(document).on('click','#contract_height',function(){
          setTimeout(function(){
            $('#collapse-lead-info').css('height','550px');
          },500);
     });  
  $(document).on('click','#edit_details',function(){
          $('#edit_details_division').css('display','none');
          $('#edit_details_start_division').css('display','block');
          $(this).css('display','none');
          $('.card-footer').css('display','none');
          //alert('edit');
  });

   $(document).on('click','#update_details',function(){
                    $('#contract_details_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_details',function(){
       $('#edit_details_start_division').css('display','none');
          $('#edit_details_division').css('display','block');
          $('#edit_details').css('display','inline-block');
          $('.card-footer').css('display','block');

    });

       //contract information
  $(document).on('click','#edit_contract_info',function(){
          $('#edit_contract_info_division').css('display','none');
          $('#edit_contract_info_start_division').css('display','block');
          $(this).css('display','none');
          $('.card-footer').css('display','none');
          //alert('edit');
  });

   $(document).on('click','#update_contract_info',function(){
                    $('#contract_info_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_contract_info',function(){
       $('#edit_contract_info_start_division').css('display','none');
          $('#edit_contract_info_division').css('display','block');
          $('#edit_contract_info').css('display','inline-block');
          $('.card-footer').css('display','block');

    });
//contract processor information
  $(document).on('click','#edit_contract_pro_info',function(){
          $('#edit_contract_pro_info_division').css('display','none');
          $('#edit_contract_pro_info_start_division').css('display','block');
          $(this).css('display','none');
          $('.card-footer').css('display','none');
          //alert('edit');
  });

   $(document).on('click','#update_contract_pro_info',function(){
                    $('#contract_pro_info_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_contract_pro_info',function(){
       $('#edit_contract_pro_info_start_division').css('display','none');
          $('#edit_contract_pro_info_division').css('display','block');
          $('#edit_contract_pro_info').css('display','inline-block');
          $('.card-footer').css('display','block');

    });
    //contract Description Information
  $(document).on('click','#edit_contract_d_info',function(){
          $('#edit_contract_d_info_division').css('display','none');
          $('#edit_contract_d_info_start_division').css('display','block');
          $(this).css('display','none');
          $('.card-footer').css('display','none');
          //alert('edit');
  });

   $(document).on('click','#update_contract_d_info',function(){
                    $('#contract_d_info_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_contract_d_info',function(){
       $('#edit_contract_d_info_start_division').css('display','none');
          $('#edit_contract_d_info_division').css('display','block');
          $('#edit_contract_d_info').css('display','inline-block');
          $('.card-footer').css('display','block');

    });



	});
</script>