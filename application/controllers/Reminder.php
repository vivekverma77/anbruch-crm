<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';
class Reminder extends Base
{
	public function __construct()
	{
		parent::__construct();
		$this->redirectPublicUser();
		$this->load->model("LogsModel");
		$this->load->model("App_model");
	}
 public function save(){
 	if($this->input->post()){
 	  $postData = $this->input->post();
 	  $postArray = array('task' => $postData['task'],
 	  					'description' => $postData['description'],
 	  					'user_id' => $this->session->userdata['user_id'],
 	  					'record_id' => $postData['record_id'],
 	  					'remind_date' => !empty($postData['remind_date']) && !empty($postData['remind_time']) ? date("Y-m-d",strtotime($postData['remind_date'])).' '.date("H:i:s",strtotime($postData['remind_time'])) : NULL,
 	  					/*'remind_time' => !empty($postData['remind_time']) ? date("H:i",strtotime($postData['remind_time'])) : ''*/

 			);
 	  if(isset($postData['is_booking']) && !empty($postData['is_booking'])){
 	  	 $postArray['is_booking']=1;
 	  }
 	  $res = $this->App_model->rowInsert('anb_crm_reminder',$postArray);
	 $result = array();	 	  
 	  if($res > 0){
 	  	$result['success'] = true;
 	  	$result['message'] = 'Reminder Added';
 	  }else{
 	  	$result['success'] = false;
 	  }
 	}
 	echo json_encode($result);
 	die();
 }
 public function get(){
 	$user_id = $this->session->userdata['user_id'];
 	$record_id = $_GET['record_id'];
 	if($record_id){
 	 $join = array(
 	 	array(
 	 		"table" => "anb_crm_users_personal_info as upi",
 	 		"on" => "upi.user_id = rem.user_id"
 	 	)
 	 );
 	 $res = $this->App_model->getData('anb_crm_reminder as rem',array('rem.*','upi.first_name', 'upi.last_name'),array('record_id'=>$record_id),$join,'id','desc');
 	echo json_encode($res);
    }
 	die();
 }
 public function delete($id = 0){
 	if($id){
 	  $postArray = array('id' => $id);
 	  $res = $this->App_model->rowsDelete('anb_crm_reminder',$postArray);
	  $result = array();	 	  
 	  if($res > 0){
 	  	$result['success'] = true;
 	  	$result['message'] = 'Reminder Deleted';
 	  }else{
 	  	$result['success'] = false;
 	  }
 	  echo json_encode($result);
 	}
 	die();
 }
 public function response($id=0,$val = ''){
 	if($id){
 	  $postArray = array('id' => $id,'status' => $val);
 	  $res = $this->App_model->rowUpdate('anb_crm_reminder',$postArray,array('id' =>$id));
	  $result = array();	 	  
 	  if($res > 0){
 	  	$result['success'] = true;
 	  	$result['message'] = 'Reminder Updated';
 	  }else{
 	  	$result['success'] = false;
 	  }
 	  echo json_encode($result);
 	}
 	die();
 }
  public function getUpcoming(){
 	$user_id = $this->session->userdata['user_id'];
 	$role_id = $this->session->userdata['role_id'];
 	if($user_id){
 	 
 	 $join = array(
 	 	array(
 	 		"table" => "anb_crm_record_meta_value as mv",
 	 		"on" => "mv.record_id = rem.record_id"
 	 	),
 	 	array(
 	 		"table" => "anb_crm_users_personal_info as upi",
 	 		"on" => "upi.user_id = rem.user_id"
 	 	),
 	 	array(
 	 		"table" => "anb_crm_record as r",
 	 		"on" => "r.id = rem.record_id"
 	 	)
 	 );

 	 $join_booking=array(
 	 	array(
 	 		"table" => "anb_crm_bookings as mv",
 	 		"on" => "mv.id = rem.record_id",
 	 		"join"=>"inner join",
 	 	),
 	 	array(
 	 		"table" => "anb_crm_users_personal_info as upi",
 	 		"on" => "upi.user_id = rem.user_id"
 	 	)
 	 );

 	 $or_where=array(
 	 			array('or_where'=>"mv.record_meta_id",'value'=>31),
 	 			array('or_where'=>"mv.record_meta_id",'value'=>84),
 	 			array('or_where'=>"mv.record_meta_id",'value'=>197)
 	 		  );

 	 $c_date=date("Y-m-d H:i:s");

 	 if($role_id == 1 || $role_id == 7)
 	 {
 	 	$res = $this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.value','r.module_id','upi.first_name', 'upi.last_name'),array('rem.status'=>'new','rem.remind_date >=' => date("Y-m-d H:i:s", strtotime($c_date) - 50)),$or_where,$join,'rem.remind_date','ASC');


 	 	$book_rem = $this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.booking_title as value','upi.first_name', 'upi.last_name'),array('rem.status'=>'new','rem.remind_date >=' => date("Y-m-d H:i:s", strtotime($c_date) - 50)),false,$join_booking,'rem.remind_date','ASC');

		echo json_encode(array_merge($res,$book_rem));
 	 }
 	 else
 	 {
		$res = $this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.value','r.module_id','upi.first_name', 'upi.last_name'),array('rem.user_id'=>$user_id,'rem.status'=>'new','rem.remind_date >=' => date("Y-m-d H:i:s", strtotime($c_date) - 50)),$or_where,$join,'rem.remind_date','ASC');

		$book_rem = $this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.booking_title as value','upi.first_name', 'upi.last_name'),array('rem.user_id'=>$user_id,'rem.status'=>'new','rem.remind_date >=' => date("Y-m-d H:i:s", strtotime($c_date) - 50)),false,$join_booking,'rem.remind_date','ASC');

		echo json_encode(array_merge($res,$book_rem));
	 	
	 }

    }
 	die();
 }

 function loadReminder(){
 		
 		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            
        } else {
            $str_point=false;
            $lenght=false;
        }

 		$user_id = $this->session->userdata['user_id'];
	 	$role_id = $this->session->userdata['role_id'];
	 	if($user_id){
	 	 
	 	 $join = array(
	 	 	array(
	 	 		"table" => "anb_crm_record_meta_value as mv",
	 	 		"on" => "mv.record_id = rem.record_id"
	 	 	),
	 	 	array(
	 	 		"table" => "anb_crm_users_personal_info as upi",
	 	 		"on" => "upi.user_id = rem.user_id"
	 	 	),
	 	 	array(
	 	 		"table" => "anb_crm_record as r",
	 	 		"on" => "r.id = rem.record_id"
	 	 	)
	 	);

	 	$join_booking=array(
	 	 	array(
	 	 		"table" => "anb_crm_bookings as mv",
	 	 		"on" => "mv.id = rem.record_id",
	 	 		"join"=>"inner join",
	 	 	),
	 	 	array(
	 	 		"table" => "anb_crm_users_personal_info as upi",
	 	 		"on" => "upi.user_id = rem.user_id"
	 	 	)
	 	);

 	    $or_where=array(
	 		array('or_where'=>"mv.record_meta_id",'value'=>31),
	 		array('or_where'=>"mv.record_meta_id",'value'=>84),
	 		array('or_where'=>"mv.record_meta_id",'value'=>197)
 	 	);

	 	$c_date=date("Y-m-d H:i:s");

	 	$res=[];
	 	$book_rem=[];

		if($role_id == 1 || $role_id == 7)
	 		
	 		$where=array('rem.status'=>'new','rem.remind_date >=' => date("Y-m-d H:i:s", strtotime($c_date) - 50));
	 	else
	 		$where=array('rem.user_id'=>$user_id,'rem.status'=>'new','rem.remind_date >=' => date("Y-m-d H:i:s", strtotime($c_date) - 50));

		$reminder=$this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*'),$where,false,false,'rem.remind_date','ASC',$lenght,$str_point);

		foreach ($reminder as $key => $value) {

 			if($value['is_booking'])
 				
 				$rem = $this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.booking_title as value','upi.first_name', 'upi.last_name'),array('rem.id'=>$value['id']),false,$join_booking);
 			else	
 	 			$rem = $this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.value','r.module_id','upi.first_name', 'upi.last_name'),array('rem.id'=>$value['id']),$or_where,$join);

 	 		$res=array_merge($res,$rem);
		}

		$count=$this->App_model->getAllData('anb_crm_reminder as rem',array('rem.*'),$where,false,false,'rem.id','desc',false,false);

 		$output = array(
            "sEcho" => 0,
            "iTotalRecords" => count($count),
            "iTotalDisplayRecords" => count($count),
            "aaData" => array()
        );

       	function date_compare($a, $b)
		{
		    $t1 = strtotime($a['remind_date']);
		    $t2 = strtotime($b['remind_date']);
		    return $t1 - $t2;
		}    

       	if(!empty($res)){
        	
        usort($res, 'date_compare');	

	    foreach ($res as $key => $value) {

			$status = $value['status']	 == 'completed' ? 'checked' : '';
		     $status2 = $value['status'] == 'ignore' ? 'checked' : '';

	    	if($value['is_booking'] > 0){

	            $booking_url=base_url('booking?booking_id=').$value['record_id'];
	          
	            $html= '<div class="reminder-item" id="'.$value['id'].'"> <div class="left">  <p class="discription"><a class="description-link" href="'.$booking_url.'"><i class="icon icon-crm-calendar" style="font-size: 15px;color: #0288d1;"></i> '.$value['value'].'</a></p><h6>'.$value['task'].'</h6><p class="date" style="width:200px;">'.date('m/d/Y H:i',strtotime($value['remind_date'])).' by '.$value['first_name'].' '.$value['last_name'].'</p></div><div class="right"> <label id="'.$value['id'].'" class="ignore status r-status" title="Mark completed"><input type="radio"  name="status'.$value['id'].'" class="status-checkbox" value="ignore" '.$status2.'><span class="status-label"><span class="text"> Ignore</span></span></label> <label id="'.$value['id'].'" class="completed status r-status" title="Mark Ignore"><input type="radio" name="status'.$value['id'].'" class="status-checkbox" value="completed" '.$status.'><span class="status-label"><span class="text">Completed</span></span></label> </div></div>';

	            }else{
			
				if($value['module_id']==1){
	               $c_module='Leads';
	               $c_icon='<i class="icon icon-crm-user-out" style="font-size: 15px;color: #ff5252;"></i>';
	         	}
		         if($value['module_id']==2){
		            $c_module='Clients';
		            $c_icon='<i class="icon icon-crm-add-user-1" style="font-size: 15px;color: #ff5252;"></i>';
		         }
		         if($value['module_id']==3){
		            $c_module='Contracts';
		            $c_icon='<i class="icon icon-crm-bill" style="font-size: 15px;color:#43a047"></i>';
		         }
		       
				$html= '<div class="reminder-item" id="'.$value['id'].'"> <div class="left">  <p class="discription"><a class="description-link" href="'.base_url().'modules/viewRecord/?cm='.$c_module.'&id='.$value['record_id'].'&record_status=3">'.$c_icon.' '.$value['value'].'</a></p><h6>'.$value['task'].'</h6><p class="date" style="width:200px;">'.date('m/d/Y H:i',strtotime($value['remind_date'])).' by '.$value['first_name'].' '.$value['last_name'].'</p></div><div class="right"> <label id="'.$value['id'].'" class="ignore status r-status" title="Mark completed"><input type="radio"  name="status'.$value['id'].'" class="status-checkbox" value="ignore" '.$status2.'><span class="status-label"><span class="text"> Ignore</span></span></label> <label id="'.$value['id'].'" class="completed status r-status" title="Mark Ignore"><input type="radio" name="status'.$value['id'].'" class="status-checkbox" value="completed" '.$status.'><span class="status-label"><span class="text">Completed</span></span></label> </div></div>';
				}	

		      	$output['aaData'][] = array($html
					);	
			}
     	}
        
 	   echo json_encode($output);
       die;
	}	
}

}
