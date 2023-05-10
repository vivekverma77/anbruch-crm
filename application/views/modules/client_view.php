<?php
//echo '<pre>';print_r($record_data);

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

$phone = isset($record_data[$phone_key]) ? $record_data[$phone_key] : "No Phone Number Available";
$email = isset($record_data[$email_key]) ? $record_data[$email_key] : "No Email Available";
$company_name = isset($record_data[$company_name_key]) ? $record_data[$company_name_key] : "No Company Name Available";

$opener = (isset($record_data['__105']) && $record_data['__105']) ? $record_data['__105'] : "Not Available";
$closer = (isset($record_data['__104']) && $record_data['__104']) ? $record_data['__104'] : "Not Available";
$clientCategory =  (isset($record_data['__95']) && $record_data['__95']) ? $record_data['__95'] : "Cold";


foreach($users_list as $arr_usr)
									{
	if($arr_usr['id'] == $opener)
	{
		$opener_name = $arr_usr['title'];
	}
	if($arr_usr['id'] == $closer)
	{
		$closer_name = $arr_usr['title'];
	}
}
/*if($opener == 2)
	$opener = 'Bernadette Lucanas';
if($closer == 4)
	$closer = 'Pawel Krzemieniecki';*/
//$opener = $closer = '';
//echo $opener;

foreach($users_list as $arr_usr)
{
	if($arr_usr['id'] == $opener)
	{
		$opener = $arr_usr['title'];
	}
	if($arr_usr['id'] == $closer)
	{
		$closer = $arr_usr['title'];
	}
}
								
?>

<!--<img style="height: 42px; width: 42px;" alt="" src="<?php echo base_url() ?>static/images/boyAvatar.png">-->
<style type="text/css">
.contact-chip .card-title {margin-bottom: 10px;}
.contact-chip .card-content { margin-top:20px; }
.contact-chip .card-content li { font-size: 16px; }
#contact-2,#contact-3,#contact-4,#contact-5 { padding: 25px 10px;height:450px;background:white;}
i.yellow { color:#ffae00 !important;}
#client-info { height:450px;}
#client-info .card-footer { padding-top: 7px; }
.client-view #collapse-lead-info { height: 743px;}
#edit_general_start_division .select2-container{width: 200px !important;}
i.fa.fa-star.primary-contact-client:hover {color: #ffae02 !important;}

</style>

<div class="hero-row top-border client-view">

      <div id="l-info" class="collapsible-card card color-theme">

          <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-lead-info">
            <div class="col">
              <h4>Client Information</h4>
            </div>
            <div>
              <span class="toggle-card-btn bg-purple-50">
                <i class="icon-crm-angle-up"></i>
              </span>
            </div>
          </div>

<div id="collapse-lead-info" class="card-content collapse in collapsed-have-height-equalizer row">
	<div class="col-sm-7">
		<ul class="nav nav-tabs" id="contact-tabs" style="width: 100%;">
	        <li class="active"><a data-toggle="tab" href="#client-info" style="padding:10px 8px;margin: 0px;">Details</a></li>
	        <?php $flag = 2; switch($primary_contact){
	            case 128:
	              $flag = 2;
	            break;
	            case 137:
	              $flag = 3;
	            break;
	            case 141:
	              $flag = 4;
	            break;
	            case 148:
	              $flag = 5;
	            break;
	          }
	        ?>
	        <li><a data-toggle="tab" href="#contact-<?php echo $flag; ?>" style="padding:10px 8px;border-left: 1px solid #1fb5ad;margin: 0px;">Contact Person <?php echo $flag; ?></a></li>
	        <?php for($i = 2; $i<= 5; $i++){ 
	            if($i!= $flag){
	            ?>
	            <li><a data-toggle="tab" href="#contact-<?php echo $i; ?>" style="padding:10px 8px;border-left: 1px solid #1fb5ad;margin: 0px;">Contact Person <?php echo $i; ?></a></li>
	        <?php } } ?>
	    </ul>
	   <div class="tab-content">
		<div id="client-info" class="color-theme tab-pane fade in active">
      <div class="client-status">
                      <?php 

                            foreach ($notes as $key => $note) {
                                  if( $key == 0 ) {  
                                         
                                    $last_lead = date("m/d/Y H:i:s", $note['created_time']);                      
                                   }        
                                 }                       
                          if($clientCategory == 'Hot') {?>
                            <img src="<?php echo base_url()?>assets/images/hot.png">
                             <div><?php echo $last_lead; ?></div>
                          <?php }else{ ?>
                            <img src="<?php echo base_url()?>assets/images/cold.png">
                            <div><?php echo $last_lead; ?></div>
                          <?php } ?>
                          </div>
                            <div>
                              <h3 class="card-title"><?php echo $first_name . " " . $last_name; ?> </h3>
                              <span class="company-name"><?php echo $company_name ?></span>
                            </div>

                            <div style="padding:10px 0;margin-top: 8px">
                        <?php //if(!$openerRights){ ?>
                         <?php if($record_data['__95']=="Hot"){?>
                                <a href="#modalFollow" id="c_unfollow_id" class="btn btn-round btn-fill-theme"> <i class="icon-crm-user-plus"></i> Unfollow </a>
                              <!-- <span style="background:#1fb5ad; color:#fff; margin:0 8px; padding:1px 9px; border-radius:25px; display:inline-block; position:relative; top:2px; box-shadow:0 0 7px #ccc;" ><i class="icon-crm-user-plus"></i> Followed </span> -->
                            <?php } else{
                              ?>
                              <a href="#modalFollow" id="c_follow_id" class="btn btn-round btn-fill-theme"> <i class="icon-crm-user-plus"></i> Follow </a>
                            <?php } ?>

                            <button type="button" id="edit_details"  class="btn icon-btn btn-blue-o">
                                         <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Record</span></button>
                              
                              </div>
	        
            <div class="card-content">
             <div class="table-structure-info" id="edit_details_division">
               <table>
    <input type="hidden" class="tab_lead_name" value="<?php echo $record_data['__184'] ." ".$record_data['__183']; ?>">
     <input type="hidden" class="tab_lead_title" value="<?php echo $record_data['__83']; ?>">          
     <input type="hidden" class="tab_lead_email" value="<?php echo $record_data['__85']; ?>">                  
                  <tr>
                    <th nowrap>First Name </th>
                    <td><?= @$record_data['__184']?></td>
                  </tr>
                   <tr>
                    <th nowrap>Last Name </th>
                    <td><?=@$record_data['__183']?></td>
                  </tr>
                  <tr>
                    <th nowrap>Title</th>
                    <td><?= @$record_data['__83']?></td>
                  </tr>
                 
                  <tr>
                    <th nowrap>Direct Number</th>
                    <td><?= @$record_data['__100']?></td>
                  </tr>
                  <tr>
                    <th nowrap>Direct Number Extension</th>
                    <td><?=@$record_data['__96']?></td>
                  </tr>
                   <tr>
                    <th nowrap>Function</th>
                    <td><?= @$record_data['__89']?></td>
                  </tr>
                 <!--  <tr>
                    <th nowrap>Alternate Phone</th>
                    <td><?= @$record_data['__103']?></td>
                  </tr> -->
                  <tr>
                    <th nowrap>Email</th>
                    <td><?= @$record_data['__85']?></td>
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
                          <form  role="form" id="client_details_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                            <input type="hidden" name="detail_set" value="detail">
                               <!--  <tr>
                                   <th nowrap>Zoom Individual ID:</td>
                                   <td><?php //if(!empty($record_data['zoom_id'])) {echo $record_data['zoom_id']; } ?></td>
                                </tr> -->
                                <tr>
                                   <th nowrap>First Name</td>
                                   <td id="tab_main_name">
                                     <input type="text" required="" name="__184" value="<?=$record_data['__184']?>"></td>
                                </tr>
                                  <tr>
                                   <th nowrap>Last Name</td>
                                   <td id="tab_main_name">
                                     <input type="text" required="" name="__183" value="<?=$record_data['__183']?>">
                                     </td>
                                </tr>
                                <tr>
                                   <th nowrap>Title</td>
                                   <td id="tab_main_title">
                                    <input type="text" required="" name="__83" value="<?=$record_data['__83']?>">
                                    </td>
                                </tr>
                              
                                <tr>
                                   <th nowrap>Direct Number</td>
                                   <td id="tab_main_phone">
                                    <input type="text" required="" name="__100" value="<?=$record_data['__100']?>">
                                    </td>
                                </tr>
                                <tr>
                                   <th nowrap>Direct Number Extension</td>
                                   <td>
                                    <input type="text" required="" name="__96" value="<?=$record_data['__96']?>">
                                    </td>
                                </tr>
                                  <tr>
                                   <th nowrap>Function</td>
                                   <td id="tab_main_function">
                                    <input type="text" required="" name="__89" value="<?=$record_data['__89']?>">
                                    </td>
                                </tr>
                                <!-- <tr>
                                   <th nowrap>Alternate Phone</td>
                                   <td>
                                    <input type="text" required="" name="__103" value="<?=$record_data['__103']?>">
                                    </td>
                                </tr> -->
                                <tr>
                                  <th nowrap>Email</th>
                                  <td id="tab_main_email">
                                    <input type="text" required="" name="__85" value="<?=$record_data['__85']?>">                    
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
				<?php if ($user_role == 1 || $user_role == 3 || $user_role == 4 || $user_role == 8) { ?>
					<?php
					if(!empty($qualified))
					{ ?>

					<!-- <span><?php if($qualified[0]['questions']=='Are you selling goods to Canada' && $qualified[0]['answers']=='Yes') { echo 'Qualified'; } else { echo 'Not Qualified'; } ?></span> -->
					<?php } else { ?>	
					<!-- 	<a href="#modalQualifyNow" id="qualify_now" class="btn btn-theme-o" data-toggle="modal">Qualify Now</a> -->
				
					<?php } } ?>
				
				<a href="javascript:void(0)" id="send_email" class="btn btn-theme-o" data-email="<?php echo @$record_data['__85'] ?>">SEND EMAIL</a>
				
				<a href="#" class="btn btn-theme-o book_now" data-toggle="modal" data-target="#addClassSchedule">Book Now</a>

			<!-- 	<a class="btn btn-theme-o" data-toggle="modal" href="#modalQualified">Qualified Data</a> -->
            </div>
		</div>

		<div id="contact-2" class="contact-chip color-theme tab-pane fade">
                          
          <div>
            <h4 class="card-title">Contact Person 2 
               <button style="left:35px;"type="button" id="edit_person_two"  class="btn icon-btn btn-blue-o"><i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Contact Person 2</span></button> 
             <i class="fa fa-star primary-contact-client <?php echo $primary_contact == 128 ? 'yellow' : ''; ?>" data-id="128" style="float:right;color: #d3d3d3ba;"></i></h2>
          </div>
          <div class="card-content" id="edit_p2_division">
            <div class="table-structure-info">
              <table>
    <input type="hidden" class="tab_lead_name" value="<?php echo $record_data['__128'] ." ".$record_data['__127']; ?>">
     <input type="hidden" class="tab_lead_title" value="<?php echo $record_data['__130']; ?>">          
     <input type="hidden" class="tab_lead_email" value="<?php echo $record_data['__131']; ?>">                  
                <tr>
                  <th nowrap>First Name</th>
                  <td class="tab_first_name_client"><?=@$record_data['__128']?></td>
                </tr>
                <tr>
                  <th nowrap>Last Name</th>
                  <td class="tab_last_name_client"><?=@$record_data['__127']?></td>
                </tr>
                <tr>
                  <th nowrap>Title</th>
                  <td class="tab_title_client"> <?=@$record_data['__130']?></td>
                </tr>
                <tr>
                  <th nowrap>Direct Number</th>
                  <td class="tab_phone_client"><?=@$record_data['__132']?></td>
                </tr>
                <tr>
                  <th nowrap>Direct Number Extension</th>
                  <td class="tab_phone_ext_client"><?=@$record_data['__133']?></td>
                </tr>
                <tr>
                  <th nowrap>Function</th>
                  <td class="tab_function_client"><?=@$record_data['__129']?></td>
                </tr>
                <tr>
                  <th nowrap>Email</th>
                  <td class="tab_email_client"> <?=@$record_data['__131']?></td>
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
           
          </div>

<!--               contact person2 edit -->
                       <div class="table-structure-info" id="edit_p2_start_division" style="display: none;color: #455a64;">
                         <form  role="form" id="client_p2_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="person2" value="person2">
                               <table>
                                 <tr>
                                    <th nowrap>First Name</th>
                                    <td class="tab_first_name">
                                      <input type="text" required="" name="__128" value="<?=$record_data['__128']?>">          </td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Last Name</th>
                                    <td class="tab_last_name">   <input type="text" required="" name="__127" value="<?=$record_data['__127']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Title</th>
                                    <td class="tab_title"><input type="text" required="" name="__130" value="<?=$record_data['__130']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Direct Number</th>
                                    <td class="tab_phone"><input type="text" required="" name="__132" value="<?=$record_data['__132']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Direct Number Extension</th>
                                    <td class="tab_phone_ext"><input type="text" required="" name="__133" value="<?=$record_data['__133']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Function</th>
                                    <td class="tab_function"><input type="text" required="" name="__129" value="<?=$record_data['__129']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Email</th>
                                    <td class="tab_email"><input type="text" required="" name="__131" value="<?=$record_data['__131']?>"></td>
                                 </tr>
                                  <tr>
                                    <td colspan="2">
                                     <button type="button" name="Cancle_update_p2" id="Cancle_update_p2" class="btn btn-success">Cancel</button>
                                     <button type="button" name="update_p2" id="update_p2" class="btn btn-success">Update Details</button>
                                  </td>
                                 </tr>
                               </table>
                        </form>
                      </div>
<!--              contact person edit end -->    
                   <div style="margin-left: 50%">
                     <a href="#" id="c_book_p2" class="btn btn-theme-o book_now" data-toggle="modal" data-target="#addClassSchedule">Book Now</a>
                    </div>
  
        </div>

        <div id="contact-3" class="contact-chip color-theme tab-pane fade">
          
          <div>
            <h4 class="card-title">Contact Person 3
               <button style="left:35px;"type="button" id="edit_person_three"  class="btn icon-btn btn-blue-o"><i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Contact Person 3</span></button>  
             <i class="fa fa-star primary-contact-client <?php echo $primary_contact == 137 ? 'yellow' : ''; ?>" data-id="137" style="float:right;color: #d3d3d3ba;"></i></h2>
          </div>
          <div class="card-content" >
            <div class="table-structure-info" id="edit_p3_division">
              <table>
     <input type="hidden" class="tab_lead_name" value="<?php echo $record_data['__137'] ." ".$record_data['__135']; ?>">
     <input type="hidden" class="tab_lead_title" value="<?php echo $record_data['__134']; ?>">          
     <input type="hidden" class="tab_lead_email" value="<?php echo $record_data['__138']; ?>">                 
                <tr>
                  <th nowrap>First Name</th>
                  <td class="tab_first_name_client"><?=@$record_data['__137']?></td>
                </tr>
                <tr>
                  <th nowrap>Last Name</th>
                  <td class="tab_last_name_client"><?=@$record_data['__135']?></td>
                </tr>
                <tr>
                  <th nowrap>Title</th>
                  <td class="tab_title_client"><?=@$record_data['__134']?></td>
                </tr>
                <tr>
                  <th nowrap>Direct Number</th>
                  <td class="tab_phone_client"><?=@$record_data['__139']?></td>
                </tr>
                <tr>
                  <th nowrap>Direct Number Extension</th>
                  <td class="tab_phone_ext_client"><?=@$record_data['__140']?></td>
                </tr>
                <tr>
                  <th nowrap>Function</th>
                  <td class="tab_function_client"><?=@$record_data['__136']?></td>
                </tr>
                <tr>
                  <th nowrap>Email</th>
                  <td class="tab_email_client"><?=@$record_data['__138']?></td>
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
           
          </div>

<!--               contact person3 edit -->
                       <div class="table-structure-info" id="edit_p3_start_division" style="display: none;color: #455a64;">
                         <form  role="form" id="client_p3_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="person3" value="person3">
                               <table>
                                 <tr>
                                    <th nowrap>First Name</th>
                                    <td class="tab_first_name">
                                      <input type="text" required="" name="__137" value="<?=$record_data['__137']?>">          </td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Last Name</th>
                                    <td class="tab_last_name">   <input type="text" required="" name="__135" value="<?=$record_data['__135']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Title</th>
                                    <td class="tab_title"><input type="text" required="" name="__134" value="<?=$record_data['__134']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Direct Number</th>
                                    <td class="tab_phone"><input type="text" required="" name="__139" value="<?=$record_data['__139']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Direct Number Extension</th>
                                    <td class="tab_phone_ext"><input type="text" required="" name="__140" value="<?=$record_data['__140']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Function</th>
                                    <td class="tab_function"><input type="text" required="" name="__136" value="<?=$record_data['__136']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Email</th>
                                    <td class="tab_email"><input type="text" required="" name="__138" value="<?=$record_data['__138']?>"></td>
                                 </tr>
                                  <tr>
                                    <td colspan="2">
                                     <button type="button" name="Cancle_update_p3" id="Cancle_update_p3" class="btn btn-success">Cancel</button>
                                     <button type="button" name="update_p3" id="update_p3" class="btn btn-success">Update Details</button>
                                  </td>
                                 </tr>
                               </table>
                        </form>
                      </div>
<!--              contact person edit end -->
                   <div style="margin-left: 50%">
                     <a href="#" id="c_book_p3" class="btn btn-theme-o book_now" data-toggle="modal" data-target="#addClassSchedule">Book Now</a>
                    </div>
      </div>

      <div id="contact-4" class="contact-chip  color-theme tab-pane fade">
          
        <div>
            <h4 class="card-title">Contact Person 4 
              <button style="left:35px;"type="button" id="edit_person_four"  class="btn icon-btn btn-blue-o"><i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Contact Person 4</span></button> 
              <i class="fa fa-star primary-contact-client <?php echo $primary_contact == 141 ? 'yellow' : ''; ?>" data-id="141" style="float:right;color: #d3d3d3ba;"></i></h2>
          </div>
          <div class="card-content">
            <div class="table-structure-info" id="edit_p4_division">
              <table>
      <input type="hidden" class="tab_lead_name" value="<?php echo $record_data['__141'] ." ".$record_data['__143']; ?>">
     <input type="hidden" class="tab_lead_title" value="<?php echo $record_data['__142']; ?>">          
     <input type="hidden" class="tab_lead_email" value="<?php echo $record_data['__145']; ?>">                
                <tr>
                  <th nowrap>First Name</th>
                  <td class="tab_first_name_client"><?=@$record_data['__141']?></td>
                </tr>
                <tr>
                  <th nowrap>Last Name</th>
                  <td class="tab_last_name_client"><?=@$record_data['__143']?></td>
                </tr>
                <tr>
                  <th nowrap>Title</th>
                  <td class="tab_title_client"><?=@$record_data['__142']?></td>
                </tr>
                <tr>
                  <th nowrap>Direct Number</th>
                  <td class="tab_phone_client"><?=@$record_data['__146']?></td>
                </tr>
                <tr>
                  <th nowrap>Direct Number Extension</th>
                  <td class="tab_phone_ext_client"> <?=@$record_data['__147']?></td>
                </tr>
                <tr>
                  <th nowrap>Function</th>
                  <td class="tab_function_client"><?=@$record_data['__144']?></td>
                </tr>
                <tr>
                  <th nowrap>Email</th>
                  <td class="tab_email_client"><?=@$record_data['__145']?></td>
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
            
          </div>
<!--               contact person4 edit -->
                       <div class="table-structure-info" id="edit_p4_start_division" style="display: none;color: #455a64;">
                         <form  role="form" id="client_p4_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="person4" value="person4">
                               <table>
                                 <tr>
                                    <th nowrap>First Name</th>
                                    <td class="tab_first_name">
                                      <input type="text" required="" name="__141" value="<?=$record_data['__141']?>">          </td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Last Name</th>
                                    <td class="tab_last_name">   <input type="text" required="" name="__143" value="<?=$record_data['__143']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Title</th>
                                    <td class="tab_title"><input type="text" required="" name="__142" value="<?=$record_data['__142']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Direct Number</th>
                                    <td class="tab_phone"><input type="text" required="" name="__146" value="<?=$record_data['__146']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Direct Number Extension</th>
                                    <td class="tab_phone_ext"><input type="text" required="" name="__147" value="<?=$record_data['__147']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Function</th>
                                    <td class="tab_function"><input type="text" required="" name="__144" value="<?=$record_data['__144']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Email</th>
                                    <td class="tab_email"><input type="text" required="" name="__145" value="<?=$record_data['__145']?>"></td>
                                 </tr>
                                  <tr>
                                    <td colspan="2">
                                     <button type="button" name="Cancle_update_p4" id="Cancle_update_p4" class="btn btn-success">Cancel</button>
                                     <button type="button" name="update_p4" id="update_p4" class="btn btn-success">Update Details</button>
                                  </td>
                                 </tr>
                               </table>
                        </form>
                      </div>
<!--              contact person edit end -->       
                   <div style="margin-left: 50%">
                     <a href="#" id="c_book_p4" class="btn btn-theme-o book_now" data-toggle="modal" data-target="#addClassSchedule">Book Now</a>
                    </div>
      </div>
      <div id="contact-5" class="contact-chip color-theme tab-pane fade">
        <div>
            <h4 class="card-title">Contact Person 5 
                 <button style="left:35px;"type="button" id="edit_person_five"  class="btn icon-btn btn-blue-o"><i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Contact Person 5</span></button> 
              <i class="fa fa-star primary-contact-client <?php echo $primary_contact == 148 ? 'yellow' : ''; ?>" data-id="148" style="float:right;color: #d3d3d3ba;"></i></h2>
          </div>
          <div class="card-content">
            <div class="table-structure-info" id="edit_p5_division">
              <table>
     <input type="hidden" class="tab_lead_name" value="<?php echo $record_data['__148'] ." ".$record_data['__150']; ?>">
     <input type="hidden" class="tab_lead_title" value="<?php echo $record_data['__149']; ?>">          
     <input type="hidden" class="tab_lead_email" value="<?php echo $record_data['__151']; ?>">                 
                <tr>
                  <th nowrap>First Name</th>
                  <td class="tab_first_name_client"><?=@$record_data['__148']?></td>
                </tr>
                <tr>
                  <th nowrap>Last Name</th>
                  <td class="tab_last_name_client"><?=@$record_data['__150']?></td>
                </tr>
                <tr>
                  <th nowrap>Title</th>
                  <td class="tab_title_client"><?=@$record_data['__149']?></td>
                </tr>
                <tr>
                  <th nowrap>Direct Number</th>
                  <td class="tab_phone_client"><?=@$record_data['__152']?></td>
                </tr>
                 <tr>
                  <th nowrap>Direct Number Extension</th>
                  <td class="tab_phone_ext_client"> <?=@$record_data['__246']?></td>
                </tr>
                <tr>
                  <th nowrap>Function</th>
                  <td class="tab_function_client"><?=@$record_data['__247']?></td>
                </tr>
                <tr>
                  <th nowrap>Email</th>
                  <td class="tab_email_client"><?=@$record_data['__151']?></td>
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
            
          </div>
<!--               contact person5 edit -->
                       <div class="table-structure-info" id="edit_p5_start_division" style="display: none;color: #455a64;">
                         <form  role="form" id="client_p5_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="person5" value="person5">
                               <table>
                                 <tr>
                                    <th nowrap>First Name</th>
                                    <td class="tab_first_name">
                                      <input type="text" required="" name="__148" value="<?=$record_data['__148']?>">          </td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Last Name</th>
                                    <td class="tab_last_name">   <input type="text" required="" name="__150" value="<?=$record_data['__150']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Title</th>
                                    <td class="tab_title"><input type="text" required="" name="__149" value="<?=$record_data['__149']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Direct Number</th>
                                    <td class="tab_phone"><input type="text" required="" name="__152" value="<?=$record_data['__152']?>"></td>
                                 </tr>
                                  <tr>
                                    <th nowrap>Direct Number Extension</th>
                                    <td class="tab_phone_ext"><input type="text" required="" name="__246" value="<?=$record_data['__246']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Function</th>
                                    <td class="tab_function"><input type="text" required="" name="__247" value="<?=$record_data['__247']?>"></td>
                                 </tr>
                                 <tr>
                                    <th nowrap>Email</th>
                                    <td class="tab_email"><input type="text" required="" name="__151" value="<?=$record_data['__151']?>"></td>
                                 </tr>
                                  <tr>
                                    <td colspan="2">
                                     <button type="button" name="Cancle_update_p5" id="Cancle_update_p5" class="btn btn-success">Cancel</button>
                                     <button type="button" name="update_p5" id="update_p5" class="btn btn-success">Update Details</button>
                                  </td>
                                 </tr>
                               </table>
                        </form>
                      </div>
<!--              contact person edit end -->  
                 
                   <div style="margin-left: 50%">
                     <a href="#" id="c_book_p5" class="btn btn-theme-o book_now" data-toggle="modal" data-target="#addClassSchedule">Book Now</a>
                    </div>
                       
      </div>

		</div> <!-- tab content -->
	</div> <!-- /.col-sm-7 -->

	<div class="col-sm-5">
      <div id="notes-info" class="color-theme collapsible-card bordered-card notes">
        <div class="flex-row toggable-header">
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

        <div id="notes-LAI" class="card-content collapse panel-group additional-info-accordion collapse in" aria-expanded="true">
          <div id="collapse-notes1" class="collapse in  notes-body note_search_result_panel">
              <?php  if (isset($notes) && count($notes) > 0) {?>
                  <?php $id = 0; foreach ($notes as $key => $note) { $id ++; if($id == 1) { ?>
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 style='font-size:11px;'  class="panel-title " data-toggle="collapse" data-parent="#notes-LAI" href="#<?php echo $note['id'] ?>"> Note <?php echo $id ?>
                            <span style="margin-left: 5px;">|</span>   
                        <strong class="text-info" style="color:#444;margin-left: 5px;">Posted on: <?php echo date('m/d/Y H:i', $note["created_time"]); ?> by <?php echo $note["created_by"] ?></strong>
                                    <i class="fa fa-plus pull-right"  style="margin-top: 3px;"></i> </h4>
                      </div>
                    <div id="<?php echo $note['id'] ?>" class="panel-collapse collapse in">
                        <div class="well well-large" style="padding:10px;padding-top: 2px;padding-bottom: 7px;">
                            
                            <!-- <hr style="margin: 0;"/>
                            <h4 style="margin-top: 5px;color:#0098E3;font-size:12pt;font-weight:bold;"><?php //echo $note["note_title"] ?></h4>
 -->                            <?php echo $note["note"] ?>
                        </div>
                     </div>
                    </div>
                  <?php } else { ?>
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 style='font-size:11px;' class="panel-title" data-toggle="collapse" data-parent="#notes-LAI" href="#<?php echo $note['id'] ?>"> Note <?php echo $id ?>
                           <span style="margin-left: 5px;">|</span>
                          <strong class="text-info" style="color:#444;margin-left: 5px;">Posted on: <?php echo date('m/d/Y H:i', $note["created_time"]); ?> by <?php echo $note["created_by"] ?></strong>
                         <i class="fa fa-plus pull-right"  style="margin-top: 3px;"></i> </h4>
                      </div>
                    <div id="<?php echo $note['id'] ?>" class="panel-collapse collapse in">
                     
                        <div class="well well-large" style="padding:10px;padding-top: 2px;padding-bottom: 7px;">
                            
                           
                           <!--  <hr style="margin: 0;"/>
                            <h4 style="margin-top: 5px;color:#0098E3;font-size:12pt;font-weight:bold;"><?php //echo $note["note_title"] ?></h4> -->
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

<?php if (!isset($deletedRecord) || $deletedRecord != true) { ?>
		
	<div class="row section-row">
		<div class="col-xs-12">
			<?php require_once "contract.php"; ?>
		</div>
	</div>
<?php } ?>
		
<div class="section-row">
     
        <div class="collapsible-card card top-border" id="client-company-info">
            <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target=".other-info">
                <div class="col">
                   <h4>Company Infomation</h4>
                </div>
                <div>
                  <span class="toggle-card-btn bg-purple-50">
                  <i class="icon-crm-angle-down"></i>
                  </span>
                </div>
            </div>
            <div class="other-info collapsed-have-height-equalizer collapse in">
              <!-- <div id="client-additional-info" class="collapsible-card card bordered-card color-blue">
                <div class="card-header flex-row toggable-header" data-toggle="collapse" data-target="#accordion-CAI">
                  <div class="col">
                    <h4>Additional Client Information</h4>
                  </div>
                  <div>
                    <span class="toggle-card-btn bg-blue-50">
                      <i class="icon-crm-angle-down"></i>
                    </span>
                  </div>
                </div>

                <div id="accordion-CAI" class="card-content collapse panel-group additional-info-accordion">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion-CAI" href="#person-2"> Contact Person 2 <i class="fa fa-plus pull-right"></i> </h4>
                    </div>
                    <div id="person-2" class="panel-collapse collapse in">
                      <div class="panel-body content">
                        <ul>
                          <li> <b>First Name:</b> <?=@$record_data['__128']?> </li>
                          <li> <b>Last Name:</b> <?=@$record_data['__127']?> </li>
                          <li> <b>Title:</b> <?=@$record_data['__130']?> </li>
                          <li> <b>Phone:</b> <?=@$record_data['__132']?> </li>
                          <li> <b>Phone Extension:</b> <?=@$record_data['__133']?> </li>
                          <li> <b>Function:</b> <?=@$record_data['__129']?> </li>
                          <li> <b>Email:</b> <?=@$record_data['__131']?> </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion-CAI" href="#person-3"> Contact Person 3 <i class="fa fa-plus pull-right"></i> </h4>
                    </div>
                    <div id="person-3" class="panel-collapse collapse">
                      <div class="panel-body content">
                        <ul>
                          <li> <b>First Name:</b> <?=@$record_data['__137']?> </li>
                          <li> <b>Last Name:</b> <?=@$record_data['__135']?> </li>
                          <li> <b>Title:</b> <?=@$record_data['__134']?> </li>
                          <li> <b>Phone:</b> <?=@$record_data['__139']?> </li>
                          <li> <b>Phone Extension:</b> <?=@$record_data['__140']?> </li>
                          <li> <b>Function:</b> <?=@$record_data['__136']?> </li>
                          <li> <b>Email:</b> <?=@$record_data['__138']?> </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion-CAI" href="#person-4"> Contact Person 4 <i class="fa fa-plus pull-right"></i> </h4>
                    </div>
                    <div id="person-4" class="panel-collapse collapse">
                      <div class="panel-body content">
                        <ul>
                          <li> <b>First Name:</b> <?=@$record_data['__141']?> </li>
                          <li> <b>Last Name:</b> <?=@$record_data['__143']?> </li>
                          <li> <b>Title:</b> <?=@$record_data['__142']?> </li>
                          <li> <b>Phone:</b> <?=@$record_data['__146']?> </li>
                          <li> <b>Phone Extension:</b> <?=@$record_data['__147']?> </li>
                          <li> <b>Function:</b> <?=@$record_data['__144']?> </li>
                          <li> <b>Email:</b> <?=@$record_data['__145']?> </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion-CAI" href="#person-5"> Contact Person 5 <i class="fa fa-plus pull-right"></i> </h4>
                    </div>
                    <div id="person-5" class="panel-collapse collapse">
                      <div class="panel-body content">
                        <ul>
                          <li> <b>First Name:</b> <?=@$record_data['__148']?> </li>
                          <li> <b>Last Name:</b> <?=@$record_data['__150']?> </li>
                          <li> <b>Title:</b> <?=@$record_data['__149']?> </li>
                          <li> <b>Phone:</b> <?=@$record_data['__152']?> </li>
                          <li> <b>Email:</b> <?=@$record_data['__151']?> </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
      </div> --> <!-- /#client-additional-info -->
    <div class="col-md-6 l-border" style="min-height: 923px;">
      <div id="company-info" class="collapsible-card">
        <div class="card-header flex-row toggable-header">
        <div class="col">
          <h4 style="margin-bottom: 0px;">Company Information
             <ul style="display: inline-block;list-style-type: none;padding-left: 0px;">
              <li id="parent_general">
                <button style="left:35px;"type="button" id="edit_general_company"  class="btn icon-btn btn-blue-o">
                <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit General</span></button> 
            </li>
            <li style="display: none" id="parent_company">
                <button style="left:35px;"type="button" id="edit_parent_company"  class="btn icon-btn btn-blue-o">
                <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Parent/Affiliate Company Information</span></button> 
            </li>
            </ul>
          </h4>
        </div>
        
        </div>
        <?php 
        
        $head_office_status = '';
        if(strtolower(@$record_data['__119']) == 'false')
          $head_office_status = 'No';
        if(strtolower(@$record_data['__119']) == 'true')                                      
          $head_office_status = 'Yes';
        ?>
        <div id="collapse-company-info">
        <ul class="nav nav-tabs">
          <li class="active" id="general_li">
            <span class="tab-curv left"></span>
            <a data-toggle="tab" href="#general">General</a>
            <span class="tab-curv right"></span>
          </li>
          <li id="parent_li">
            <span class="tab-curv left"></span>
            <a data-toggle="tab" href="#affiliate-company">Parent/Affiliate Company Information</a>
            <span class="tab-curv right"></span>
          </li>
          
        </ul>

        <div class="tab-content">
          <div id="general" class="tab-pane fade in active">
            <div class="table-structure-info" id="edit_general_division">

          <table class="height-equalizer" data-equalizer="table2" > 
            <tbody>
            <tr>
              <th nowrap> Company</th>
              <td><?=@$record_data['__108']?></td>
            </tr>
            <tr>
              <th nowrap> Head Office Status</th>
              <td><?=$head_office_status?></td>
            </tr>
            <tr>
              <th nowrap> Address Line 1</th>
              <td><?=@$record_data['__115']?></td>
            </tr>
            <tr>
              <th nowrap> Address Line 2</th>
              <td><?=@$record_data['__116']?></td>
            </tr>
            <tr>
              <th nowrap> City</th>
              <td><?=@$record_data['__112']?></td>
            </tr>
            <tr>
              <th nowrap> Province</th>
              <td><?=@$record_data['__117']?></td>
            </tr>
            <tr>
              <th nowrap> Country</th>
              <td><?=@$record_data['__114']?></td>
            </tr>
            <tr>
              <th nowrap> Zip Code</th>
              <td><?=@$record_data['__113']?></td>
            </tr>
            <tr>
              <th nowrap> Phone</th>
              <td><?=@$record_data['__109']?></td>
            </tr>
            <tr>
              <th nowrap> Fax</th>
              <td><?=@$record_data['__110']?></td>
            </tr>
            <tr>
              <th nowrap> Website</th>
              <td><a href="http://<?=str_replace('http://', '', @$record_data['__111'])?>" target="_blank"><?=@$record_data['__111']?></a></td>
            </tr>
          </tbody>
        </table>  
        </div>   
      
<!--               general company edit start -->
                  <div class="table-structure-info" style="display: none" id="edit_general_start_division">
                     <form  role="form" id="client_general_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="general_company" value="general_company">
                  <table>
                    <tr> 
                      <th nowrap>Company:</th>
                       <td>  
                        <input type="text" required="" name="__108" value="<?=$record_data['__108']?>">
                      </td> 
                     </tr>
                    <tr> 
                      <th nowrap>Head Office Status:</th> 
                      <td><select id="head_status" name="__119">
                        <?php
                        if($head_office_status == "Yes")
                        { $select =  "selected"; }else{ $select =  ""; }
                        if($head_office_status == "No")
                        { $select1 =  "selected"; }else{ $select1 =  ""; }
                        ?>
                        <option <?php echo $select1; ?> value="false">No</option>
                        <option <?php echo $select; ?> value="true">Yes</option>
                      </select> </td> 
                    </tr>
                    <tr>
                     <th nowrap>Address Line 1:</th>
                      <td><input type="text" required="" name="__115" value="<?=$record_data['__115']?>"> 
                    </td> 
                  </tr>
                    <tr> 
                      <th nowrap>Address Line 2:</th>
                       <td><input type="text" required="" name="__116" value="<?=$record_data['__116']?>">  
                     </td>
                      </tr>
                    <tr>
                     <th nowrap>City:</th> <td>
                      <input type="text" required="" name="__112" value="<?=$record_data['__112']?>">
                       </td>
                        </tr>
                    <tr>
                     <th nowrap>Province:</th>
                      <td><input type="text" required="" name="__117" value="<?=$record_data['__117']?>"> 
                    </td>
                     </tr>
                    <tr>
                     <th nowrap>Country:</th>
                      <td>  
                        <select id="general_country" name="__114">
                                <?php 
                                   $already_selected =  isset($record_data['__114'])?$record_data['__114']:''; 
                                    foreach($country as $value)
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
                     <th nowrap>Zip Code:</th>
                      <td><input type="text" required="" name="__113" value="<?=$record_data['__113']?>"> 
                       </td>
                        </tr>
                    <tr> 
                      <th nowrap>Phone:</th> 
                      <td><input type="text" required="" name="__109" value="<?=$record_data['__109']?>"> 
                    </td> 
                  </tr>
                    <tr> 
                      <th nowrap>Fax:</th> <td> 
                        <input type="text" required="" name="__110" value="<?=$record_data['__110']?>">
                      </td>
                       </tr>
                    <tr>
                     <th nowrap>Website:</th>
                      <td> 
                        <input type="text" required="" name="__111" value="<?=$record_data['__111']?>"></td>
                         </tr>
                    <tr>
                      <td colspan="2">
                       <button type="button" name="Cancle_update_general" id="Cancle_update_general" class="btn btn-success">Cancel</button>
                       <button type="button" name="update_general" id="update_general" class="btn btn-success">Update Details</button>
                    </td>
                   </tr>
                  </table>
                </form>
                </div>
            </div>
<!--               general company edit end -->         
   

          <div id="affiliate-company" class="tab-pane fade">
              <div class="table-structure-info" id="edit_parent_division"> 
                <table class="height-equalizer" data-equalizer="table2">
                <tr>
                    <th nowrap>Company Name</th>
                    <td><?=@$record_data['__118']?></td>
                </tr>
                <tr>
                    <th nowrap>Address Line 1</th>
                    <td><?=@$record_data['__120']?></td>
                </tr>
                <tr>
                    <th nowrap>City</th>
                    <td><?=@$record_data['__122']?></td>
                </tr>
                <tr>
                    <th nowrap>Province</th>
                    <td><?=@$record_data['__121']?></td>
                </tr>
                <tr>
                    <th nowrap>Country</th>
                    <td><?=@$record_data['__123']?></td>
                </tr>
                <tr>
                    <th nowrap>Postal Code</th>
                    <td><?=@$record_data['__124']?></td>
                </tr>
                <tr>
                    <th nowrap>Phone</th>
                    <td><?=(isset($record_data['__186']))?$record_data['__186']:''?></td>
                </tr>
                <tr>
                    <th nowrap>Fax</th>
                    <td><?=(isset($record_data['__186']))?$record_data['__187']:''?></td>
                </tr>
                <tr>
                    <th nowrap>Website</th>
                    <td><?=(isset($record_data['__186']))?$record_data['__188']:''?></td>
                </tr>
                <tr>
                    <th nowrap>Year Established</th>
                    <td><?=(isset($record_data['__186']))?$record_data['__189']:''?></td>
                </tr>
                </table>
              </div>

<!-- parent company edit start -->
              <div class="table-structure-info" style="display: none;" id="edit_parent_start_division">
                 <form  role="form" id="client_parent_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="parent_company" value="parent_company">
                  <table>
                    <tr>
                      <th nowrap>Company Name</th>
                      <td>  <input type="text" required="" name="__118" value="<?=$record_data['__118']?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>Address Line 1</th>
                      <td>  <input type="text" required="" name="__120" value="<?=$record_data['__120']?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>City</th>
                      <td>  <input type="text" required="" name="__122" value="<?=$record_data['__122']?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>Province</th>
                      <td>  <input type="text" required="" name="__121" value="<?=$record_data['__121']?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>Country</th>
                      <td>
                          <select id="parent_country" name="__123">
                                <?php 
                                   $already_selected =  isset($record_data['__123'])?$record_data['__123']:''; 
                                    foreach($country as $value)
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
                      <th nowrap>Postal Code</th>
                      <td>  <input type="text" required="" name="__124" value="<?=$record_data['__124']?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>Phone</th>
                      <td>  <input type="text" required="" name="__186" value="<?=(isset($record_data['__186']))?$record_data['__186']:''?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>Fax</th>
                      <td>  <input type="text" required="" name="__187" value="<?=(isset($record_data['__187']))?$record_data['__187']:''?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>Website</th>
                      <td>  <input type="text" required="" name="__188" value="<?=(isset($record_data['__188']))?$record_data['__188']:''?>"></td>
                    </tr>
                    <tr>
                      <th nowrap>Year Established</th>
                      <td>  
                        <input type="number"  min="1900" required="" name="__189" value="<?=(isset($record_data['__189']))?$record_data['__189']:''?>"></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                       <button type="button" name="Cancle_update_parent" id="Cancle_update_parent" class="btn btn-success">Cancel</button>
                       <button type="button" name="update_parent" id="update_parent" class="btn btn-success">Update Details</button>
                    </td>
                   </tr>
                  </table>
                </form>
                </div>
<!-- parent company edit end -->          
          </div>
           </div>
        </div> <!-- /.tab-content -->
      </div> <!-- /#Company-info -->
     </div>

    <div class="col-md-6 l-border">
      <div id="add-company-info" class="collapsible-card">
              <div class="card-header flex-row toggable-header">
                <div class="col">
                  <h4>Additional Company Information
                    <button style="left:35px;"type="button" id="edit_additional_company"  class="btn icon-btn btn-blue-o">
                  <i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Additional Company Information</span></button> 
                  </h4>
                </div>
                
              </div>
              <div id="collapse-add-company-info">
                <div class="table-structure-info" id="edit_additional_division">
                <table class="height-equalizer" data-equalizer="table2">
            <tr> <th nowrap>Business Type:</th>  <td> <?=@$record_data['__125']?> </td> </tr>
            <tr> <th nowrap>Year Established:</th> <td> <?=@$record_data['__126']?> </td> </tr>
            <tr> <th nowrap>Estimated Sales:</th> <td> <?=@$record_data['__157']?> </td> </tr>
            <tr> <th nowrap>Reported Sales:</th> <td> <?=@$record_data['__159']?> </td> </tr>
            <tr> <th nowrap>No. of Employees:</th> <td> <?=@$record_data['__153']?> </td> </tr>
            <tr>
                <th nowrap>Primary NAICS Code</th>
                <td><?php echo isset($record_data['__218'])?$record_data['__218']:''; ?></td>
            </tr>
            <tr> <th nowrap>Primary NAICS <br> Description:</th>  <td> <?=@$record_data['__154']?> </td> </tr>
            <tr> <th nowrap>Primary SIC Code:</th> <td> <?=@$record_data['__155']?> </td> </tr>
            <tr> <th nowrap>Export Indicator:</th> <td> <?=@$record_data['__158']?> </td> </tr>
            <tr> <th nowrap>Export Country:</th> <td> <?=@$record_data['__79']?> </td> </tr>
            <tr>
                 <th nowrap>Sales Tax Registration <br/> GST (CAN):</th>
              <td>
                <?php if(!empty((array)@$record_data['__98'])) { echo implode(', </br> ',(array)@$record_data['__98']); } ?>
              </td>
            </tr>
            <tr>
                <th nowrap>Sales Tax Status:</th>
              <td>
                <?php if(!empty((array)@$record_data['__99'])) { echo implode(', </br> ',(array)@$record_data['__99']); } ?>
              </td>
            </tr> 
            <tr>
              <th nowrap>Service Type</th>
              <td>
                <?php if(!empty((array)@$record_data['__90'])) { echo implode(', </br> ',(array)@$record_data['__90']); } ?>
              </td>
            </tr>
                    <tr>
                      <th nowrap> Company Website 2:</th>
                      <td><?=(isset($record_data['__190']))?$record_data['__190']:''?> </td>
                    </tr>
                    <tr>
                      <th nowrap> Company Website 3:</th>
                      <td><?=(isset($record_data['__190']))?$record_data['__191']:''?> </td>
                    </tr>
                    <tr>
                      <th nowrap> Company Website 4:</th>
                      <td><?=(isset($record_data['__190']))?$record_data['__192']:''?> </td>
                    </tr>
                    <tr>
                      <th nowrap> Company Website 5:</th>
                      <td><?=(isset($record_data['__190']))?$record_data['__193']:''?> </td>
                    </tr>
                    <tr>
                      <th nowrap> Company Website 6:</th>
                      <td><?=(isset($record_data['__190']))?$record_data['__194']:''?> </td>
                    </tr>
                    <tr>
                      <th nowrap> Company Website 7:</th>
                      <td><?=(isset($record_data['__190']))?$record_data['__195']:''?> </td>
                    </tr>
                     <tr>
                  <th nowrap>Employees Range</th>
                  <td><?php echo isset($record_data['__221'])?$record_data['__221']:''; ?></td>
                 </tr>
                 <tr>
                  <th nowrap>Email Domain</th>
                  <td><?php echo isset($record_data['__222'])?$record_data['__222']:''; ?></td>
                </tr>
                </table>
                </div>

  <!-- Edit additional company start -->
      <div class="table-structure-info" style="display: none" id="edit_additional_start_division">
         <form  role="form" id="client_additional_form" method="post" action="<?php echo base_url('/modules/client_edit_by_individual_tab'); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="additional_company" value="additional_company">
            <table class="height-equalizer" data-equalizer="table2">
              <tr>
                <th nowrap>Business Type</th>
                <td> <input type="text" required="" name="__125" value="<?=$record_data['__125']?>"></td>
              </tr>
                <tr>
                  <th nowrap>Year Established</th>
                  <td> <input type="number" min="1900" required="" name="__126" value="<?=$record_data['__126']?>"></td>
                </tr>
                <tr>
                  <th nowrap>Estimated Sales</th>
                  <td> <input type="text" required="" name="__157" value="<?=$record_data['__157']?>"></td>
                </tr>
                <tr>
                  <th nowrap>Reported Sales</th>
                  <td> <input type="text" required="" name="__159" value="<?=$record_data['__159']?>"></td>
                </tr>
                <tr>
                  <th nowrap>No. of Employees</th>
                  <td> <input type="number" min="1" required="" name="__153" value="<?=$record_data['__153']?>"></td>
                </tr>
                 <tr>
                  <th nowrap>Primary NAICS Code</th>
                  <td> <input type="text" required="" name="__218" value="<?=(isset($record_data['__218']))?$record_data['__218']:''?>"></td>
                </tr>
                <tr>
                  <th nowrap>Primary NAICS <br/> Description</th>
                  <td> <input type="text" required="" name="__154" value="<?=$record_data['__154']?>"></td>
                </tr>
                <tr>
                  <th nowrap>Primary SIC Code</th>
                  <td> <input type="text" required="" name="__155" value="<?=$record_data['__155']?>"></td>
                </tr>
                <tr>
                  <th nowrap>Export Indicator</th>
                  <td>
                    <?php if(($record_data['__158']) == "yes") { $checked = "checked"; $value = "yes"; }if(($record_data['__158']) == "") { $checked =""; $value="";} ?>
                   <input type="checkbox" <?php echo $checked; ?> id="export_indicator" required="" name="__158" value="<?php echo $value; ?>"></td>
                </tr>
                <tr>
                  <th nowrap>Export Country</th>
                  <td>
                    <select id="additional_country" name="__79">
                                <?php 
                                   $already_selected =  isset($record_data['__79'])?$record_data['__79']:''; 
                                    foreach($country as $value)
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
                  <th nowrap>Sales Tax Registration <br/> GST (CAN)</th>
                  <td> 
                        <select class="multi-select" style="width: 100% !important; padding: 5px;" multiple id="salex_tax" name="__98[]">
                                <?php 
                                   $already_selected =  isset($record_data['__98'])?$record_data['__98']:'';

                                      //$selected = "";
                                    foreach($salex_tax as $value)
                                    {
                                       $flag = true;
                                      if(!is_array($already_selected))
                                      {
                                        if($already_selected == $value)
                                        {
                                          ?>

                                          <option selected value="<?php echo $value; ?>"><?php echo $value; ?></option>

                                  <?php  $flag=false;    }
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
                  <th nowrap>Sales Tax Status</th>
                  <td> 
                          <select class="multi-select" multiple id="salex_tax_status" name="__99[]">
                                <?php 
                                   $already_selected =  isset($record_data['__99'])?$record_data['__99']:''; 

                                    foreach($salex_tax_status as $value)
                                    {
                                        $flag = true;
                                     if(!is_array($already_selected))
                                      {
                                        if($already_selected == $value)
                                        {
                                          ?>

                                          <option selected value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                  <?php  $flag = false;     }
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
                  <th nowrap>Service Type</th>
                  <td>  
                
                          <select class="multi-select" multiple id="service_type" name="__90[]">
                                <?php 
                                   $already_selected =  isset($record_data['__90'])?$record_data['__90']:'';
                                    foreach($client_service as $value)
                                    {
                                       $flag = true;
                                     if(!is_array($already_selected))
                                      {
                                 // print_r($record_data['__90']);print_r($already_selected);die("test"); 

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
                  <th nowrap>Company Website 2 </th>
                  <td>  <input type="text" required="" name="__190" value="<?=(isset($record_data['__190']))?$record_data['__190']:''?> "></td>
                </tr>
                 <tr>
                  <th nowrap>Company Website 3 </th>
                  <td>  <input type="text" required="" name="__191" value="<?=(isset($record_data['__191']))?$record_data['__191']:''?> "></td>
                </tr>
                 <tr>
                  <th nowrap>Company Website 4 </th>
                  <td>  <input type="text" required="" name="__192" value="<?=(isset($record_data['__192']))?$record_data['__192']:''?> "></td>
                </tr>
                 <tr>
                  <th nowrap>Company Website 5 </th>
                  <td>  <input type="text" required="" name="__193" value="<?=(isset($record_data['__193']))?$record_data['__193']:''?> "></td>
                </tr>
                 <tr>
                  <th nowrap>Company Website 6 </th>
                  <td>  <input type="text" required="" name="__194" value="<?=(isset($record_data['__194']))?$record_data['__194']:''?> "></td>
                </tr>
                 <tr>
                  <th nowrap>Company Website 7 </th>
                  <td>  <input type="text" required="" name="__195" value="<?=(isset($record_data['__195']))?$record_data['__195']:''?> "></td>
                </tr>
                 <tr>
                  <th nowrap>Employees Range</th>
                  <td> 
                    <select id="employee_range" name="__221">
                      <?php
                        if($record_data['__221'] == "5000to9999")
                        { $one = "selected"; } else { $one = ""; }
                       if($record_data['__221'] == "10000to4999")
                        { $two = "selected"; } else { $two = ""; }
                       if($record_data['__221'] == "10000plus")
                        { $three = "selected"; } else { $three = ""; }
                      ?>
                      <option <?php echo $one;?> value="5000to9999">5000to9999</option>
                      <option <?php echo $two;?> value="10000to4999">10000to4999</option>
                      <option <?php echo $three;?> value="10000plus">10000plus</option>
                    </select>
                  </td>
                </tr>
                 <tr>
                  <th nowrap>Email Domain</th>
                  <td> <input type="text" required="" name="__222" value="<?=(isset($record_data['__222']))?$record_data['__222']:''?>"></td>
                </tr>
                 <tr>
                      <td colspan="2">
                       <button type="button" name="Cancle_update_additional" id="Cancle_update_additional" class="btn btn-success">Cancel</button>
                       <button type="button" name="update_addtional" id="update_addtional" class="btn btn-success">Update Details</button>
                    </td>
                   </tr>
              </table>
            </form>
           </div>

  <!-- Edit additional company end -->               
              </div>
        </div> <!-- /#Company-info -->  
            </div>
        </div>
    </div> 
</div>
<div class="section-row">
  <div id="client-processor-info" class="collapsible-card card top-border color-purple">
    <div class="custom-bord flex-row toggable-header" data-toggle="collapse" data-target="#collapse-client-processor-info" aria-expanded="true">
      <div class="col">
        <h4>Client Processor Information
           <button style="left:35px;"type="button" id="edit_lead_processor"  class="btn icon-btn btn-blue-o"><i class="fa fa-edit"></i> <span class="icn-txt" style="margin-left:-46px;">Edit Client Processor Information</span></button> 
        </h4>
      </div>
      <div>
        <span class="toggle-card-btn bg-purple-50">
        	<i class="icon-crm-angle-up"></i>
        </span>
      </div>
    </div>

    <div id="collapse-client-processor-info" class="card-content collapse in" aria-expanded="true">
        
      <div class="table-structure-info row" id="edit_lead_division">

    	<div class="col-sm-6 l-border">
    		<table class="height-equalizer" data-equalizer="table1">
			  <tr>
          
			  	<th nowrap>Client Owner</th>
			  	<td>
				       <?php 
                 $already_selected = isset($record_data['__104'])?$record_data['__104']:'';
                      foreach($lead_closer as $value)
                  { if($already_selected == $value['user_id'])
                  { echo $value['first_name'] . " " .$value['last_name']; } }
                ?>
			  	</td>
			  </tr>
               <tr> <th nowrap >Phone</th> <td> <?php echo $phone ?> </td> </tr>
              <tr> <th nowrap >Email</th> <td> <?php echo $email ?> </td> </tr>
              <tr> <th nowrap >Client Status</th> <td> <?php echo $status ?> </td> </tr>
              <tr> <th nowrap >Lead Category</th> <td> <?=@$record_data['__95']?> </td> </tr>
              <tr> <th nowrap ># Dial Attempts</th> <td> </td> </tr>                            
              <tr> <th nowrap >Opener</th> <td> <?=$opener?> </td> </tr>
              <tr> <th nowrap >Closer</th> <td> <!-- <?=$closer?>  -->
               <?php 
                 $already_selected = isset($record_data['__104'])?$record_data['__104']:'';
                      foreach($lead_closer as $value)
                  { if($already_selected == $value['user_id'])
                  { echo $value['first_name'] . " " .$value['last_name']; } }
                ?>
                                </td> </tr>
              <tr> <th nowrap >Proximity</th> <td><?=@$record_data['__97']?></td> </tr>
              <tr> <th nowrap >Service Type</th> <td><?php if(!empty((array)@$record_data['__90'])) { echo implode(', </br> ',(array)@$record_data['__90']); } ?></td> </tr>
    		</table>
    	</div>
      	
    	<div class="col-sm-6 l-border">
    		<table class="height-equalizer" data-equalizer="table1">
				<tr>
					<th nowrap>Lead Source</th> <td><?=@$record_data['__86']?></td>
				</tr>
				<tr>
					<th nowrap>ID Source</th> <td><?=@$record_data['__92']?></td>
				</tr>
				<tr>
					<th>Client ID</th><td><?=$current_record_id ?></td>
				</tr>
				<tr>
					<th nowrap>Lead Referred Partner</th> <td><?=@$record_data['__91']?></td>
				</tr>
				<tr>
					<th nowrap>Source ID</th> <td><?=str_replace('zcrm_', '', @$record_data['__93'])?></td>
				</tr>

				<tr>
					<th nowraps>Created By</th> 
					<td>
						<?php foreach ($users_list as $option_key => $option) 
						{ ?>
							<?php
							if ($option['id'] == $record_data["created_by"]) 
							{ ?>
								<span><?php echo $option['title']; ?></span>
							<?php 
							} ?>
							<?php 
						} ?>
					</td>
				</tr>
				<tr>
					<th>Created On</th>
					<td><?php echo date("m/d/Y", $record_data["created_time"]); ?></td>
				</tr>
				<tr>
					<th nowrap>Modified By</th>
					<td>
						<?php if ($record_data["modified_by"] != NULL)
						{
						foreach ($users_list as $option_key => $option) { ?>
								<?php if ($option['id'] == $record_data["modified_by"]) { ?>
										<span><?php echo $option['title']; ?></span>
								<?php } ?>
						<?php }
						} else { ?><span>Not Modified Yet</span><?php } ?></td>
				</tr>
				<tr>
					<th> Modified On </th>
					<td> <?php if ($record_data["modified_time"] != NULL) { ?>
							<span><?php echo date("m/d/Y", $record_data["modified_time"]); ?></span>
						<?php }?>
					</td>
				</tr>
    		</table>
    	</div>
      </div>
<!-- start edit client processor information -->
  <div class="table-structure-info row" style="display: none" id="edit_lead_start_division">

              <div class="col-sm-6 l-border">
               <form  role="form" id="client_form" method="post" action="<?php echo base_url("/modules/client_edit_by_individual_tab?cm=Clients"); ?>" >
                            <input type="hidden" name="record_id" value="<?php echo $current_record_id; ?>" >
                             <input type="hidden" name="lead_processor" value="lead_processor">  
                <table class="height-equalizer" data-equalizer="table1">
                 <!--  <tr> <th nowrap >Lead Owner</th> <td> Anbruch.Inc<?php //echo isset($lead_owner)? $lead_owner:"Not Available";?> </td> </tr>
                  <tr>  -->
                    <th nowrap >Phone</th> 
                    <td>
                      <input type="text" required="" name="__109" value="<?=(isset($record_data['__109']))?$record_data['__109']:''?> ">
                   </td> </tr>
                  <tr> <th nowrap >Email</th> <td> <input type="text" required="" name="__85" value="<?=$record_data['__85']?>"> </td> </tr>

                  <tr> <th nowrap >Client Status</th> <td>
                   
                    <select id="lead_call_status" name="__87">
                                <?php 
                                   $already_selected =  isset($record_data['__87'])?$record_data['__87']:''; 
                                    foreach($client_status as $value)
                                    {
                                       if($already_selected == $value)
                                       { $selected = "selected"; } else { $selected = ""; }
                                  
                                    ?>
                                      <option  <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                   <?php  }
                                  ?>
                          </select> 
                  </td> </tr>
              
                  <tr> <th nowrap >Lead Category</th> 
                    <td>
                        <select id="lead_category" name="__95">
                                <?php 
                                   $already_selected =  isset($record_data['__95'])?$record_data['__95']:''; 
                                    foreach($lead_category as $value)
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
                   <th nowrap ># Dial Attempts</th>
                    <td>
                     </td>
                   </tr>
                
                  <tr> <th nowrap >Opener</th>
                   <td>
<!-- 
                    <input type="text" required="" name="" value="<?php// echo isset($opener_name)?$opener_name: 'Not Available';?>"> -->
                     <select id="lead_opener" name="__105">
                                <?php 
                                   $already_selected = isset($record_data['__105'])?$record_data['__105']:'';
                                    foreach($lead_opner as $value)
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
                  <tr> <th nowrap >Closer</th>
                   <td>
                    
                     <select id="lead_closer" name="__104">
                                <?php 
                                   $already_selected = isset($record_data['__104'])?$record_data['__104']:'';
                                    foreach($lead_closer as $value)
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
                       <tr> <th nowrap >Proximity</th> <td>    <input type="text" required="" name="__97" value=" <?php echo $record_data['__97'] ?> "></td> </tr>
                  <tr> <th nowrap >Service Type</th> 
                    <td>
                    
                      <select class="multi-select" multiple id="l_service_type" name="__90[]">
                                <?php 
                                   $already_selected =  isset($record_data['__90'])?$record_data['__90']:''; 
                                    foreach($client_service as $value)
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
                 
                </table>
              </div>

              <div class="col-sm-6 l-border">
                <table class="height-equalizer" data-equalizer="table1">
                  <tr>
                    <th nowrap >Lead Source</th> <td>  
                       <select id="lead_source" name="__86">
                                <?php 
                                   $already_selected =  isset($record_data['__86'])?$record_data['__86']:''; 
                                    foreach($lead_source as $value)
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
                    <th nowrap >ID Source</th> <td>    
                       <select id="lead_id_source" name="__92">
                                <?php 
                                   $already_selected =  isset($record_data['__92'])?$record_data['__92']:''; 
                                    foreach($lead_id_source as $value)
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
                    <th nowrap >ID Number</th> <td>    <input type="number" min="1" required="" name="__88" value="<?php echo $record_data['__88'] ?>"></td>
                  </tr>
                  <tr>
                    <th nowrap >Lead Referred Partner</th> <td>    <input type="text" required="" name="__91" value="<?php echo $record_data['__91'] ?>"> </td>
                  </tr>
                  <tr>
                    <th nowrap >Source ID</th> <td>    <input type="text" required="" name="__93" value="<?=str_replace('zcrm_', '', $record_data['__93'])?>"></td>
                  </tr>                  
                   <tr>
                      <td colspan="2">
                       <button type="button" name="Cancle_update_lead" id="Cancle_update_lead" class="btn btn-success">Cancel</button>
                       <button type="button" name="update_lead" id="update_lead" class="btn btn-success">Update Details</button>
                    </td>
                   </tr>
                </table>

              </div>
            </form>
  <!-- End client processor information -->      
    </div>

  </div>
</div>


<?php if (!isset($deletedRecord) || $deletedRecord != true) { ?>
	<div class="row section-row" id="bookinglist">
		<div class="col-xs-12">
			<?php require_once "bookings.php"; ?>
		</div>
	</div>

	<div class="row section-row">
		<div class="col-xs-12">
			<?php require_once "new_activities1.php"; ?>
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
      //details
      $("#head_status").select2();
      $("#service_type").select2();

  $(document).on('click','#edit_details',function(){
          $('#edit_details_division').css('display','none');
          $('#edit_details_start_division').css('display','block');
          $(this).css('display','none');
          $('.card-footer').css('display','none');
          //alert('edit');
  });

   $(document).on('click','#update_details',function(){
                    $('#client_details_form').ajaxSubmit({
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
    //person two
     $(document).on('click','#edit_person_two',function(){
          $('#edit_p2_division').css('display','none');
          $('#edit_p2_start_division').css('display','block');
          $(this).css('display','none');
          $("#c_book_p2").css('display','none');
    });

   $(document).on('click','#update_p2',function(){
                    $('#client_p2_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_p2',function(){
          $('#edit_p2_start_division').css('display','none');
          $('#edit_p2_division').css('display','block');
          $('#edit_person_two').css('display','inline-block');
          $("#c_book_p2").css('display','inline-block');
    });

    //person three
     $(document).on('click','#edit_person_three',function(){
          $('#edit_p3_division').css('display','none');
          $('#edit_p3_start_division').css('display','block');
          $(this).css('display','none');
          $("#c_book_p3").css('display','none');
    });

   $(document).on('click','#update_p3',function(){
                    $('#client_p3_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_p3',function(){
          $('#edit_p3_start_division').css('display','none');
          $('#edit_p3_division').css('display','block');
          $('#edit_person_three').css('display','inline-block');
          $("#c_book_p3").css('display','inline-block');
    });

    //person four
     $(document).on('click','#edit_person_four',function(){
          $('#edit_p4_division').css('display','none');
          $('#edit_p4_start_division').css('display','block');
          $(this).css('display','none');
          $("#c_book_p4").css('display','none');
    });

   $(document).on('click','#update_p4',function(){
                    $('#client_p4_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_p4',function(){
          $('#edit_p4_start_division').css('display','none');
          $('#edit_p4_division').css('display','block');
          $('#edit_person_four').css('display','inline-block');
          $("#c_book_p4").css('display','inline-block');
    });

    //person five
     $(document).on('click','#edit_person_five',function(){
          $('#edit_p5_division').css('display','none');
          $('#edit_p5_start_division').css('display','block');
          $(this).css('display','none');
          $("#c_book_p5").css('display','none');
    });

   $(document).on('click','#update_p5',function(){
                    $('#client_p5_form').ajaxSubmit({
                        dataType:'json',
                        success:function(data)
                        { 
                          window.location.reload();
                        }
                    });
   });
    $(document).on('click','#Cancle_update_p5',function(){
          $('#edit_p5_start_division').css('display','none');
          $('#edit_p5_division').css('display','block');
          $('#edit_person_five').css('display','inline-block');
          $("#c_book_p5").css('display','inline-block');
    });
    $(document).on('click','#general_li',function(){
          if($(this).hasClass("active"))
          {   $("#parent_general").css("display",'block');
              $("#parent_company").css("display","none");   }
     });
    $(document).on('click','#parent_li',function(){
           if($(this).hasClass("active"))
          {   $("#parent_general").css("display",'none');
              $("#parent_company").css("display","block");  }
     });
    //General company
     $(document).on('click','#edit_general_company',function(){
          $('#edit_general_division').css('display','none');
          $('#edit_general_start_division').css('display','block');
          $(this).css('display','none');
    });

     $(document).on('click','#update_general',function(){
                      $('#client_general_form').ajaxSubmit({
                          dataType:'json',
                          success:function(data)
                          { 
                            window.location.reload();
                          }
                      });
     });
    $(document).on('click','#Cancle_update_general',function(){
          $('#edit_general_start_division').css('display','none');
          $('#edit_general_division').css('display','block');
          $('#edit_general_company').css('display','inline-block');
    });
    //parent company
     $(document).on('click','#edit_parent_company',function(){
          $('#edit_parent_division').css('display','none');
          $('#edit_parent_start_division').css('display','block');
          $(this).css('display','none');
    });

     $(document).on('click','#update_parent',function(){
                      $('#client_parent_form').ajaxSubmit({
                          dataType:'json',
                          success:function(data)
                          { 
                            window.location.reload();
                          }
                      });
     });
    $(document).on('click','#Cancle_update_parent',function(){
          $('#edit_parent_start_division').css('display','none');
          $('#edit_parent_division').css('display','block');
          $('#edit_parent_company').css('display','inline-block');
    });

    $(document).on("click","#export_indicator",function(){
            if($(this).prop("checked") == true){
              $(this).val("yes");
            }
            else if($(this).prop("checked") == false){
              $(this).val("");
            }
    });
       //Additional company
     $(document).on('click','#edit_additional_company',function(){
          $('#edit_additional_division').css('display','none');
          $('#edit_additional_start_division').css('display','block');
          $(this).css('display','none');
    });

     $(document).on('click','#update_addtional',function(){
                      $('#client_additional_form').ajaxSubmit({
                          dataType:'json',
                          success:function(data)
                          { 
                            window.location.reload();
                          }
                      });
     });
    $(document).on('click','#Cancle_update_additional',function(){
          $('#edit_additional_start_division').css('display','none');
          $('#edit_additional_division').css('display','block');
          $('#edit_additional_company').css('display','inline-block');
    });

    //Lead processor information
     $(document).on('click','#edit_lead_processor',function(){
          $('#edit_lead_division').css('display','none');
          $('#edit_lead_start_division').css('display','block');
          $(this).css('display','none');
                return false;

    });

     $(document).on('click','#update_lead',function(){
                      $('#client_form').ajaxSubmit({
                          dataType:'json',
                          success:function(data)
                          { 
                             window.location.reload();
                          }
                      });
     });
    $(document).on('click','#Cancle_update_lead',function(){
          $('#edit_lead_start_division').css('display','none');
          $('#edit_lead_division').css('display','block');
          $('#edit_lead_processor').css('display','inline-block');
    });

      $(".primary-contact-client").click(function(){

        var find = $(this).parent().parent().parent();
        var add = $(find).children().eq(1).children().children().children();
        var fname = $(add).find(".tab_first_name_client").text();
        var lname = $(add).find(".tab_last_name_client").text();
        var tab_title = $(add).find(".tab_title_client").text();
        var tab_email = $(add).find(".tab_email_client").text();

        // if(fname == "") { return; }
        // if(lname == "") { return; }
        // if(tab_title == "") { return; }
        // if(tab_email == "") { return; }
        //alert("ok");
        var primary_contact = $(this).attr('data-id');
        var record_id = "<?php echo $current_record_id; ?>";
        $.ajax({
          type:'post',
          url: base_url + 'modules/setPrimaryContact',
          data: { record_id : record_id, contact_meta_id : primary_contact },
          dataType: 'json',
          success: function(data)
          {
            window.location.reload();
          }
        });
      });

       $(".primary-contact-client").click(function(){
       var find = $(this).parent().parent().parent();
        var add = $(find).children().eq(1).children().children().children();
        var fname = $(add).find(".tab_first_name_client").text();
        var lname = $(add).find(".tab_last_name_client").text();
        var tab_title = $(add).find(".tab_title_client").text();
        var tab_email = $(add).find(".tab_email_client").text();

        // if(fname == "") { alert("First name is required"); return; }
        // if(lname == "") { alert("Last name is required"); return; }
        // if(tab_title == "") { alert("Title is required"); return; }
        // if(tab_email == "") { alert("Email is required"); return; }

        var primary_contact = $(this).attr('data-id');
         var record_id = "<?php echo $current_record_id; ?>";
        $.ajax({
          type:'post',
          url: base_url + 'modules/setPrimaryContact',
          data: { record_id : record_id, contact_meta_id : primary_contact },
          dataType: 'json',
          success: function(data)
          {
            //window.location.reload();
          }
        });

        var record_id = "<?php echo $current_record_id; ?>";
        $.ajax({
          type:'post',
          url: base_url + 'modules/update_tab_client',
          data: { record_id : record_id, contact_meta_id : primary_contact },
          dataType: 'json',
          success: function(data)
          {
            window.location.reload();
          }
        });
      });


  });
</script>